<?php
session_start();
?>
<?php
include('database.php');
date_default_timezone_set('Asia/Colombo');
$fromdate = date("Y-m-d");
if(!isset($_SESSION['remlogin'])){
    if(!isset($_SESSION['remadminlogin'])){
        header("Location:login");
    }
    else{
        header("Location:adminpanel");
    }
}
else{
    $userId = $_SESSION['remlogin'];
    $date = date("Y-m-d");
}
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    $dlist = "";
    if(isset($_SESSION['shpName'])){
        $shp = $_SESSION['shpName'];
        $sqlc = "SELECT * FROM customers WHERE id = {$shp}";
        $resultc = $conn->query($sqlc);
        if ($resultc->num_rows > 0){
            while($rowc = $resultc->fetch_assoc()){
                $namec = $rowc['name'];
            }
        }
        $dlist = "<option value = {$shp}>{$namec}</option>";
    }
    else{
        $dlist = "<option value = ''>වෙළෙදසැල තෝරන්න</option>";
    }
	while($row = $result->fetch_assoc()){
		$idu = $row['id'];
		$name = $row['name'];
          
        $dlist .= "<option value = {$idu}>{$name}</option>";
	}
}
else{
    $dlist = "";
}

$sqlp = "SELECT * FROM product";
	$resultp = $conn->query($sqlp);
	if ($resultp->num_rows > 0){
        $dlistp = "";
		while($rowp = $resultp->fetch_assoc()){
			$idp = $rowp['id'];
			$namep = $rowp['name'];
			$pricep = $rowp['price'];
		
            $dlistp .= "<option value = {$idp}>{$namep}</option>";
		}
	}
    else{
        $dlist = "";
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

    <title>Add Sales - RAMBO BEEDI</title>
    <link rel="icon" href="../troja/trojalogo.png" type="image/x-icon" />

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
                    <h1 class="h4 mb-2 text-gray-800">විකිනුම් ඇතුලත් කරන්න</h1>
                    <h1 class="h4 mb-2 text-gray-800"><a href = "unpaid" class = "btn" style = "background:#fe2121;border:none;color:#fff;">ණය ලබාගැනීමට ඇති වෙළෙදසැල්</a></h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action = "processing" method = "post">
                                    <div class="form-group">
                                        <label for="shopName">වෙළෙදසැල</label>
                                        <select class="form-control" id="shopName" name = "shop">
                                            <?php echo $dlist;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="productName">නිෂ්පාදනය</label>
                                        <select class="form-control" id="productName" name = "product">
                                            <option value = "">නිෂ්පාදනය තෝරන්න</option>
                                            <?php echo $dlistp;?>
                                        </select>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col">
                                        <label for="Qty">ප්‍රමාණය</label>
                                        <input type="number" class="form-control" id = "Qty" name = "qty" placeholder="Enter Quantity">
                                        </div>
                                        <div class="col">
                                        <label for="price">මුදල</label>
                                        <input type="text" class="form-control" id = "price" name = "price" placeholder="Enter Price">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <button type="submit" class="btn btn-primary" name = "saveProduct" style = "background:#fe2121;border:none;width:100%;">ලයිස්තුවට ඇතුලත් කරන්න</button>
                                    </div>
                                </form>
                                <br>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <?php
                                            $sql = "SELECT * FROM tillsales";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0){
                                                $tot = 0;
                                                echo "<thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>qty</th>
                                                            <th>Unit Price</th>
                                                            <th>Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";
                                                while($row = $result->fetch_assoc()){
                                                    $id = $row['id'];
                                                    $product = $row['id'];
                                                    $product = $row['product'];
                                                    $sqlt = "SELECT * FROM product WHERE id = {$product}";
                                                    $resultt = $conn->query($sqlt);
                                                    if ($resultt->num_rows > 0){
                                                        while($rowt = $resultt->fetch_assoc()){
                                                            $product = $rowt['name'];
                                                        }
                                                    }
                                                
                                                    $price = $row['price'];
                                                    $qty = $row['qty'];
                                                    $sum = $price * $qty;
                                                    $tot += $sum;
                                                    echo "<tr>
                                                        <td>{$product}</td>
                                                        <td>{$qty}</td>
                                                        <td>{$price}</td>
                                                        <td>{$sum}</td>
                                                        <td><a href = 'processing?deleteproduct={$id}'>Delete</a></td>
                                                    </tr>";
                                                }
                                                echo "<tr>
                                                    <th colspan = '3'>Total</th>
                                                    <th>Rs. {$tot}</th>
                                                    </tr>
                                                    </tbody>
                                                    </table>
                                                    <form action = 'processing' method = 'post'>
                                                    <div class=\"row form-group\">
                                                        <div class=\"col\">
                                                        <label for=\"Qty\">ගෙවීම් ක්‍රමය</label><br>
                                                        <input type=\"radio\" class=\"\" id = \"Qty\" name = \"peymenttype\" value = \"1\" checked> මුදල්<br>
                                                        <input type=\"radio\" class=\"\" id = \"Qty\" name = \"peymenttype\" value = \"0\"> ණයට
                                                        </div>
                                                        <div class=\"col\" id = 'hdn' style = \"display:none;\">
                                                        <label for=\"dte\">ගෙවීම් දිනය</label><br>
                                                        <input type=\"date\" class=\"form-control\" id = \"dte\" name = \"cdate\" placeholder=\"Enter Date\">
                                                        </div>
                                                        
                                                    </div>
                                                        <input type = 'submit' name = 'saveid' class=\"btn btn-primary\" style = \"background:#fe2121;border:none;\" value = 'සුරකින්න'>
                                                    </div>
                                                    </form>";
                                            }
                                        ?>
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
    <script>
        let radioBtns = document.querySelectorAll("input[name='peymenttype']");
        let hdn = document.getElementById("hdn");
        
        let findSelected = () => {
            let selected = document.querySelector("input[name='peymenttype']:checked").value;
            if(selected == 1){
                hdn.style.display="none";
            }
            else{
                hdn.style.display="block";
            }
        }
        radioBtns.forEach(radioBtn => {
            radioBtn.addEventListener("change",findSelected);
        });
    </script>
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
</body>

</html>