<?php
session_start();
?>
<?php
include('database.php');
date_default_timezone_set('Asia/Colombo');
$fromdate = date("Y-m-d / h:i");
if(!isset($_SESSION['remadminlogin'])){
    header("Location:login");
}
if(isset($_COOKIE["giveprice"])){
    $giveprice = $_COOKIE["giveprice"];
}
else{
    echo "<script>window.history.back()</script>";
}
    //header("Location:deletetillsales");
    $sqlgetmaxid = "SELECT max(mid) as midold FROM sales";
    $resultgetmaxid = $conn->query($sqlgetmaxid);
    if ($resultgetmaxid->num_rows > 0){
        while($rowgetmaxid = $resultgetmaxid->fetch_assoc()){
            $midold = $rowgetmaxid['midold'];
        }
        $mid = $midold + 1;
    }
    else{
        $mid = 1;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Receipt</title>
    <link rel="icon" href="logo.png" type="image/x-icon" />

    <!-- Custom fonts for this template -->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        th,td{font-weight:bold;font-size:13.7px;color:#000;}
        img{display:none;}
        @media print {
            body *{visibility:hidden;}
            #content-wrapper, #content-wrapper *{visibility:visible;}
            #content-wrapper{position: absolute;left:-10.5px;top:0px;}
        }
    </style>
</head>

<body id="page-top">
<script src="sweetalert.min.js"></script>
    <div>
        <div id="content-wrapper">
            <div>
                <div>
                    <div class="card-body">
                        <div class="">
                        <center>
                            <h1 class="h5" style = "font-size:27px;color:#000;"><b>B & G MULTI SERVICE - GALWANGUWA</h1>
                            <p style = "font-size:14px; margin: 0;color:#000;">077 491 4807 / 071 311 6949 | Kuliyapitiya Road , Galwanguwa.</b></p>
                        </center>
                        <table class="table" id="dataTable" cellspacing="0">
                            <tr>
                                <th style = "font-size:10px"><?php echo $fromdate;?></th>
                                <th style = "font-size:10px"><?php echo $mid;?></th>
                            </tr>
                            </table>
                        <hr style = "border: 0.1px dotted #000;">
                        
                            <table class="table" id="dataTable" cellspacing="0">
                                    <?php
                                        $sql = "SELECT * FROM tillsales";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0){
                                            $tot = 0;
                                            $sumdis= 0;
                                            echo "<thead>
                                                    <tr style = 'border-bottom:1px dotted #000;'>
                                                        <th style = 'border-bottom:1px dotted #000;'>Unit_Price</th>
                                                        <th style = 'border-bottom:1px dotted #000;'>QTY</th>
                                                        <th style = 'border-bottom:1px dotted #000;'>Discount</th>
                                                        <th style = 'border-bottom:1px dotted #000;'>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>";
                                                while($row = $result->fetch_assoc()){
                                                    $id = $row['id'];
                                                    $pid = $row['item'];
                                                    $sqlt = "SELECT * FROM product WHERE id = {$pid}";
                                                    $resultt = $conn->query($sqlt);
                                                    if ($resultt->num_rows > 0){
                                                        while($rowt = $resultt->fetch_assoc()){
                                                            $product = $rowt['item'];
                                                        }
                                                    }
                                                
                                                    $sprice = $row['sprice'];
                                                    $discount = $row['discount'];
                                                    $qty = $row['qty'];
                                                    $disprice = $row['disprice'];
                                                    //$sumdiscount = $discount * $qty;
                                                    $sumdiscount = $disprice;
                                                    $sumdis += $sumdiscount;
                                                    $sum = ($sprice * $qty) - $sumdiscount;
                                                    $tot += $sum;
                                                    echo "<tr>
                                                        <td colspan = '5' style = 'font-family: \'basil_gothic_nbp\', sans-serif;'>{$product}</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td style = 'font-family: \'basil_gothic_nbp\', sans-serif;'>Rs.{$sprice}</td>
                                                        <td style = 'font-family: \'basil_gothic_nbp\', sans-serif;'>x{$qty}</td>
                                                        <td style = 'font-family: \'basil_gothic_nbp\', sans-serif;'>Rs.{$sumdiscount}</td>
                                                        <td style = 'font-family: \'basil_gothic_nbp\', sans-serif;'>Rs.{$sum}</td>
                                                    </tr>";
                                                }
                                                if($giveprice < $tot){
                                                    $giveprices = $giveprice . " Need Rs." . ($tot - $giveprice);
                                                    $bal = "-";
                                                    $_SESSION["unpaid"] = $giveprice;
                                                }
                                                else{
                                                    $giveprices = $giveprice;
                                                    $bal = $giveprice - $tot;
                                                }
                                                
                                            echo "<tr>
                                             
                                                </tbody>
                                                </table>
                                               ";
                                        }
                                    ?>
                            </table>
                            <br>
                            <div style = "border-top:1px dashed #000;border-bottom:1px dashed #000; width:100%;">
                                <table style = "border:none;width:100%;">
                                <tr>
                                    <td><font style = "font-size:18px; font-family: 'Beer', sans-serif;">Sub Total</font></td>
                                    <td style = "text-align: right;"><font style = 'font-size:18px; width:50%;text-align:right;'><?php echo "Rs.{$tot}"; ?></font></td>
                                </tr>
                                <tr>
                                    <td><font style = "font-size:18px; font-family: 'Beer', sans-serif;">Discount</font></td>
                                    <td style = "text-align: right;"><font style = 'font-size:18px; width:50%;text-align: right;'><?php echo "Rs.{$sumdis}"; ?></font></td>
                                </tr>
                                <tr>
                                    <td><font style = 'font-size:16px;font-weight:500;'>Cash Payment</font></td>
                                    <td style = "text-align: right;"><font style = 'font-size:16px;font-weight:500; width:50%;text-align:right;'><?php echo "Rs.{$giveprices}"; ?></font></td>
                                </tr>
                                <tr>
                                    <td><font style = 'font-size:16px;font-weight:500;'>Cash Balance</font></td>
                                    <td style = "text-align: right;"><font style = 'font-size:16px;font-weight:500; width:50%;text-align:right;'><?php echo "Rs.{$bal}"; ?></font></td>
                                </tr>
                                </table>
                            </div>
                            <p style = "font-size:22px;color:#000;font-weight:bold; text-align:center;margin-top:20px;">- Thank you...  Visit again -</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->
    
    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin/js/demo/datatables-demo.js"></script>
    <?php
if(isset($_SESSION['successsale'])){
    echo "<script>
        swal({
        title: 'Success',
            text: 'Successfully Added the sale',
            icon: 'success',
        });
    </script>";
    unset($_SESSION['successsale']);
}
?>
<script>
window.onload = function () {
        window.print()
        setTimeout(readdsale, 1000);
        }
    function readdsale(){
        window.location.href = "deletetillsales";
    }
</script>
</body>

</html>