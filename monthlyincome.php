<?php
session_start();
?>
<?php
include('database.php');
date_default_timezone_set('Asia/Colombo');

if(!isset($_SESSION['remadminlogin'])){
    header("Location:login");
}
if(isset($_POST["sbmitBtn"])){
    $date = $_POST["monthselect"];
}
else{
    $date = date("Y-m");
}
$remadminlogin = $_SESSION['remadminlogin'];

    $sql = "SELECT * FROM user WHERE id = {$remadminlogin}";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$type = $row['type'];
		}
	}
    $tot = 0;
    $dlist = "";
$sql = "SELECT price, sum(qty) as sqty,sum(disprice) as sdiscount, item FROM sales WHERE date LIKE '{$date}%' and type = 1 GROUP BY item";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $sqty = $row['sqty'];
        $dis = $row['sdiscount'];
        $dissp = number_format((float)$dis, 2, '.', '');
        $price = $row['price'];
        $pid = $row['item'];
        $sum = $price * $sqty;
        $sums = $sum - $dis;
        $sqlp = "SELECT * FROM product WHERE id = {$pid}";
        $resultp = $conn->query($sqlp);
        if ($resultp->num_rows > 0){
            while($rowp = $resultp->fetch_assoc()){
                $itemcode = $rowp['itemcode'];
                $product = $rowp['item'];
            }
        }
        else{
            $itemcode = "Deleted";
            $product = "Item";
        }
        $tot += $sums;
        $sump = number_format((float)$sums, 2, '.', '');
        $dlist .= "<tr><td>{$itemcode} {$product}</td><td>{$sqty}</td><td>Rs. {$price}</td><td>Rs. {$sum}</td><td>Rs. {$dissp}</td><td>Rs. {$sump}</td></tr>";
    }
    //$dlist .= "<tr><th colspan = '5'>Total</th><th>Rs. {$tot}</th></tr>";
}
else{
    $dlist = "";
}
$totsgive = 0;
    $sqlunpaid = "SELECT sum(give_price) as sgive FROM unpaid";
	$resultunpaid = $conn->query($sqlunpaid);
	if ($resultunpaid->num_rows > 0){
		while($rowunpaid = $resultunpaid->fetch_assoc()){
			$sgive = $rowunpaid['sgive'];
            $tot += $sgive;
            $totsgive += $sgive;
        }
        if($totsgive > 0){
            $dlist .= "<tr><td colspan = '5'>From Unpaid</td><td>Rs. {$sgive}</td></tr>";
        }
        $totsp = number_format((float)$tot, 2, '.', '');
        $dlist .= "<tr><th colspan = '5' style = 'color:#000;'>Total</th><th style = 'color:#000;'>Rs. {$totsp}</th></tr>";
    }
?>
<script src="sweetalert.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Monthly Income</title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="icon" href="logo.png" type="image/x-icon" />
        <!-- Custom styles for this template-->
        <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="icon" href="bgMultiservice.jpg" type="image/x-icon" />
        <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <noscript>
      <style type='text/css'>
        [data-aos] {
            opacity: 1 !important;
            transform: translate(0) scale(1) !important;
        }
      </style>
    </noscript>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            //include('sidebar.php');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                    include('topbar.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h2 mb-0" style = "color:#000;font-family: 'Impact', sans-serif;letter-spacing: 1px;">Monthly Income
                            <a href="income" class = "btn btn-primary ml-3" style = "background:#3059D9;font-family:sans-serif;">View Daily Income</a>
                        </h1>
                    </div>

                    <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <form action="#" method = "post">
                            <div class="row">
                                <div class="col">
                                <label for="">Select Month</label>
                                <input type="month" class="form-control" placeholder="select month" name = "monthselect">
                                </div>
                                <div class="col">
                                <label for=""><br></label>
                                <input type="submit" style = "background:#3059D9;color:#fff;border:none;" class="form-control" value="Search" name = "sbmitBtn">
                                </div>
                                <div class="col">
                                <label for=""><br></label>
                                </div>
                                <?php
                                if($type == 1){
                                ?>
                                <div class="col">
                                    <label for=""><br></label>
                                    <button type = "button" style = "background:#3059D9;color:#fff;border:none;" class="form-control" id = "download">Download</button>
                                </div>
                                <?php    
                                }
                                ?>
                            </div>
                    </form>
                    <center>
                        <h4><?php echo $date; ?></h4>
                    </center>
                        </div>
                        <div class="card-body" id='invoice'>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>QTY</th>
                                            <th>unit price</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php echo $dlist;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin/js/demo/datatables-demo.js"></script>

    <script>
        window.onload = function () {
            //console.log("invoice");
            document.getElementById("download")
            .addEventListener("click", () => {
                const invoice = this.document.getElementById("invoice");
                console.log("invoice");
                var opt = {
                    margin: 0.2,
                    filename: '<?php echo $date;?> Monthly Income.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
                };
                html2pdf().from(invoice).set(opt).save();
            })
        }
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>