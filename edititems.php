<?php
session_start();
?>
<?php
include('database.php');
date_default_timezone_set('Asia/Colombo');
    $fromdate = date("Y-m-d");
    $fromdate = strtotime("{$fromdate}");
if(isset($_SESSION['remadminlogin'])){
    $remadminlogin = $_SESSION['remadminlogin'];
    $sqlr = "SELECT * FROM user WHERE id = {$remadminlogin}";
	$resultr = $conn->query($sqlr);
	if ($resultr->num_rows > 0){
		while($rowr = $resultr->fetch_assoc()){
			$statusr = $rowr['type'];
        }
    }
    if(isset($_GET["delitem"])){
        $itemid = $_GET["delitem"];
        $_SESSION["itemid"] = $itemid;
    }
    
    $sql = "SELECT * FROM product WHERE id = {$itemid} ORDER BY id DESC";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
        $dlist = "";
		while($row = $result->fetch_assoc()){
			$id = $row['id'];
			$item = $row['item'];
			$suplier = $row['suplier'];
            $sqls = "SELECT * FROM suplier WHERE id = {$suplier}";
            $results = $conn->query($sqls);
            if ($results->num_rows > 0){
                while($rows = $results->fetch_assoc()){
                    $id = $rows['id'];
                    $name = $rows['name'];
                    $company = $rows['company'];
                    $suplier = "{$name} ({$company})";
                }
            }
            else{
                $suplier = "";
            }
			$qty = $row['qty'];
			$bprice = $row['bprice'];
			$sprice = $row['sprice'];
			$sdiscount = $row['sdiscount'];
		}
	}
    else{
        $dlist = "";
    }
}
else{
    header("Location:../login");
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
    <link rel="icon" href="trojalogo.png" type="image/x-icon" />
    <title>Edit Items</title>

    <!-- Custom fonts for this template -->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<script src="sweetalert.min.js"></script>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            include('sidebar.php');
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
                    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-pen"></i> Edit Item
                    
                    </h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <td><?php echo $item;?></td>
                                    </tr>
                                    <tr>
                                        <th>Supplier</th>
                                        <td><?php echo $suplier;?></td>
                                    </tr>
                                </thead>
</table>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                            <form action='processing' method = 'post'>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <th>QTY</th>
                                        <td><input type="text" name="qty" class="form-control" value = <?php echo $qty;?>></td>
                                    </tr>
                                    <?php
                                    if($statusr != 0){
                                    ?>
                                    <tr>
                                        <th>Buying Price (Rs.)</th>
                                        <td><input type="text" name="bprice" class="form-control" value = <?php echo $bprice;?>></td>
                                    </tr>
                                    <tr>
                                        <th>Selling Price (Rs.)</th>
                                        <td><input type="text" name="sprice" class="form-control" value = <?php echo $sprice;?>></td>
                                    </tr>
                                    <tr>
                                        <th>Selling Discount (%)</th>
                                        <td><input type="text" name="sdiscount" class="form-control" value = <?php echo $sdiscount;?>></td>
                                    </tr>
                                    <?php
                                    }
                                    else{
                                    ?>
                                    <tr style = "display:none;">
                                        <th>Buying Price (Rs.)</th>
                                        <td><input type="text" name="bprice" class="form-control" value = <?php echo $bprice;?>></td>
                                    </tr>
                                    <tr style = "display:none;">
                                        <th>Selling Price (Rs.)</th>
                                        <td><input type="text" name="sprice" class="form-control" value = <?php echo $sprice;?>></td>
                                    </tr>
                                    <tr style = "display:none;">
                                        <th>Selling Discount (%)</th>
                                        <td><input type="text" name="sdiscount" class="form-control" value = <?php echo $sdiscount;?>></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <th><button type="submit" class="btn btn-primary" name = "edititem" style = "background:#3059D9;border:none;">Edit Item</button></th>
                                    </tr>
                                </tbody>
                            </table>
                            </form>
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

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
<?php
if(isset($_SESSION['sussessReg'])){
    $txt = 'Successfully Edit the Item.';
    echo "<script>
        swal({
        title: 'Successfully',
            text: '$txt',
            icon: 'success',
        });
    </script>";
    unset($_SESSION['sussessReg']);
}

?>
<script>
    function displayExcelInput() {
        let excelForm = document.getElementById("excelForm");
        excelForm.style.display="inline-block"; 
    }
</script>
</body>

</html>