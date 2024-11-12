<?php
session_start();
?>
<?php
include('database.php');
date_default_timezone_set('Asia/Colombo');
$fromdate = date("Y-m-d");
if(!isset($_SESSION['remadminlogin'])){
    header("Location:login");
}


    $sqlp = "SELECT * FROM product";
	$resultp = $conn->query($sqlp);
	if ($resultp->num_rows > 0){
        $dlist = "";
		while($rowp = $resultp->fetch_assoc()){
			$idp = $rowp['id'];
			$itemcode = $rowp['itemcode'];
			$item = $rowp['item'];
			
		
            $dlist .= "<option value = {$idp}>{$itemcode} ({$item})</option>";
		}
	}
    else{
        $dlist = "";
    }
    
    if(isset($_COOKIE["selectedValue"])){
        $selectedValue = $_COOKIE["selectedValue"];
        $sqlc = "SELECT * FROM product where id = {$selectedValue}";
        $resultc = $conn->query($sqlc);
        if ($resultc->num_rows > 0){
            while($rowc = $resultc->fetch_assoc()){
                $itemcode = $rowc['itemcode'];
                $item = $rowc['item'];
                $bprice = $rowc['bprice'];
                $sprice = $rowc['sprice'];
                $sdiscount = $rowc['sdiscount'];
            }
        }
    }
    else{
        $bprice = "";
        $sprice = "";
        $sdiscount = "";
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

    <title>Add Sales</title>
    <link rel="icon" href="bgMultiservice.jpg" type="image/x-icon" />

    <!-- Custom fonts for this template -->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/dselect.js"></script>
    <link rel="stylesheet" href="css/dselect.scss" />
    <style>

/* Zebra striping */

@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	/*
	Label the data
	*/
	td:nth-of-type(1):before { content: "Product"; }
	td:nth-of-type(2):before { content: "Qty"; }
	td:nth-of-type(3):before { content: "Unit Price"; }
	td:nth-of-type(4):before { content: "Total"; }
	td:nth-of-type(5):before { content: "Action"; }
}
    </style>

</head>

<body id="page-top">
<script src="sweetalert.min.js"></script>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            //include('sidebar.php');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Topbar -->
            <?php
                include('topbar.php');
            ?>
<!-- End of Topbar -->

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h2 mb-0" style = "color:#000;font-family: 'Impact', sans-serif;letter-spacing: 1px;">Add Sales</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow my-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <form action = "processing" method = "post">
                                    <div class="row form-group">
                                        <div class="col">
                                        <label for="item">Select Item</label>
                                        <select class="" name = "product" id="item" data-live-search="true">
                                            <?php
                                            if(isset($_COOKIE["selectedValue"])){
                                                echo "<option value = {$selectedValue}>{$itemcode} ({$item})</option>";
                                            }
                                            else{
                                                echo "<option value='#'>Select Item</option>";
                                            }
                                            echo $dlist;?>
                                        </select>
                                        </div>
                                        <div class="col">
                                        <label for="bPriceVisible">Buying price</label> <input type="checkbox" name="" id="bPriceVisible" onclick = "isChecked()">
                                        <input type="text" class="form-control" id = "bpricev" name = "bprice" placeholder="Buying Price" readonly style = "display:none;" value = <?php echo $bprice;?> >
                                        <input type="text" class="form-control" id = "bpriceh" name = "bprice" placeholder="Buying Price" readonly>
                                        </div>

                                        <div class="col">
                                        <label for="sprice">Selling price</label>
                                        <input type="text" class="form-control" id = "sprice" name = "sprice" placeholder="Selling Price" required value = <?php echo $sprice;?>>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col">
                                        <label for="sdiscount">Discount</label>
                                        <input type="text" class="form-control" id = "sdiscount" name = "sdiscount" placeholder="Discount" value = <?php echo $sdiscount;?>>
                                        </div>

                                        <div class="col">
                                        <label for="Qty">QTY</label>
                                        <input type="number" class="form-control" id = "Qty" name = "qty" placeholder="Enter Quantity" value = "1">
                                        </div>
                                        
                                    </div>
                                    <center>
                                        <button type="submit" class="btn btn-primary" name = "saveProduct" style = "background:#3059D9;border:none;width:40%;">Add to List</button>
                                    </center>
                                </form>
                                </div>
                                <br>
                                <div class="col">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                        $sql = "SELECT * FROM tillsales";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0){
                                            $tot = 0;
                                            $sumdis = 0;
                                            echo "<thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
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
                                                $disprice = $row['disprice'];
                                                $qty = $row['qty'];
                                                //$sumdiscount = $discount * $qty;
                                                $sumdiscount = $disprice;
                                                $sumdis += $sumdiscount;
                                                $sum = ($sprice * $qty) - $sumdiscount;
                                                $tot += $sum;
                                                $_SESSION["tot"] = $tot;
                                                echo "<tr>
                                                    <td>{$product}</td>
                                                    <td>{$sprice}</td>
                                                    <td>{$qty}</td>
                                                    <td>{$sumdiscount}</td>
                                                    <td>{$sum}</td>
                                                    <td><a href = 'processing?deleteproduct={$id}'>Delete</a></td>
                                                </tr>";
                                            }
                                            echo "<tr>
                                                <th colspan = '3'>Total</th>
                                                <th>Rs. {$sumdis}</th>
                                                <th>Rs. {$tot}</th>
                                                </tr>
                                                </tbody>
                                                </table>
                                                <br>
                                                <form action=\"processing\" method = \"post\">
                                                <div class=\"form-row\">
                                                    <div class=\"form-group col\">
                                                        <label for=\"inputEmail4\">Price</label>
                                                        <input type=\"text\" class=\"form-control\" id=\"giveprice\" name = \"giveprice\" placeholder=\"Price\" required>
                                                    </div>
                                                    <div class=\"form-group col\">
                                                        <label for=\"inputEmail4\">Balance</label>
                                                        <input type=\"text\" class=\"form-control\" id=\"balance\" name = \"giveprice\" placeholder=\"Balance\" readonly style = 'font-size:20px;background:transparent;font-weight:bold;color:#f00;'>
                                                    </div>
                                                    <div class=\"form-group col\">
                                                        <label for=\"inputPassword4\"><br><br></label>
                                                        <button type = 'button' id = \"withreceipt\" onclick = 'isPrintPill()' name = 'saveid' class=\"btn btn-primary mt-4\" style = \"background:#3059D9;border:none;\">Add Sale</button>
                                                    </div>
                                                    <div class=\"form-group col\">
                                                        
                                                    </div>
                                                </div>
                                                </form>";
                                        }
                                    ?>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
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
        //setcookie('giveprice', '',time() - 3600);
        unset($_SESSION["unpaid"]);
        unset($_SESSION['successsale']);
    }
    ?>
    <script>
        let selection = document.getElementById("item");
        selection.addEventListener("change",()=> {
            let selectedValue = selection.options[selection.selectedIndex].value;
            document.cookie = "selectedValue = " + selectedValue;
            location.reload();
        });

        function loadreceipt(){
            document.cookie = "giveprice = " + document.getElementById("giveprice").value;
            window.location.href = 'receipt.php';
        }
        function loadwithoutprint(){
            window.location.href = "deletetillsales";
        }

        dselect(document.querySelector('#item'),{
        search: true
        });

        function isChecked(){
            if (document.getElementById("bPriceVisible").checked){
                document.getElementById("bpricev").style.display = "block";
                document.getElementById("bpriceh").style.display = "none";
            }
            else{
                document.getElementById("bpriceh").style.display = "block";
                document.getElementById("bpricev").style.display = "none";
            }
        }

        function isPrintPill(){
        swal({
            title: "Print?",
            text: "Are you sure that you are exprint the bill?",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                loadreceipt();
            } else {
                loadwithoutprint();
            }
        });
    }

    </script>
    <script>
        var tot = <?php echo json_encode($tot); ?>;
    </script>
    <script>
        var tot = <?php echo json_encode($tot); ?>;
        let balance = document.getElementById("balance");
        let giveprice = document.getElementById("giveprice");
        giveprice.addEventListener("change", ()=>{
        let bal = Number(giveprice.value) - Number(tot)
        let numb = bal.toFixed(2);
        document.getElementById("balance").value = numb;
        });
        
    </script>
</body>

</html>