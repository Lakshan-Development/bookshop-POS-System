<?php
session_start();
?>
<?php
include('database.php');
date_default_timezone_set('Asia/Colombo');

if(!isset($_SESSION['remadminlogin'])){
    header("Location:login");
}
else{
    $remadminlogin = $_SESSION['remadminlogin'];
    $sql = "SELECT * FROM user WHERE id = {$remadminlogin}";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$type = $row['type'];
		}
	}
    $sql = "SELECT * FROM suplier";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
        $dlist = "";
		while($row = $result->fetch_assoc()){
			$id = $row['id'];
			$name = $row['name'];
			$company = $row['company'];
            $dlist .= "<option value = '{$id}'>{$name} ({$company})</option>";
        }
    }
    else{
        $dlist = "";
    }
}
?>
<script src="sweetalert.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Add new item</title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script src="html2pdf.js"></script>
    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" href="trojalogo.png" type="image/x-icon" />
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="icon" href="bgMultiservice.jpg" type="image/x-icon" />
    <!-- Custom styles for this template -->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/dselect.js"></script>
    <link rel="stylesheet" href="css/dselect.scss" />
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
                        <h1 class="h3 mb-0 text-gray-800">Add new Item</h1>
                    </div>

                    <div id="content">
                <!-- Begin Page Content -->
                <div class="">

                    
                    <!-- DataTales Example -->
                    <div class="card shadow">
                        <div class="card-body" id='invoice'>
                            <div class="">
                                <form action="processing" method = "post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Item code</label>
                                        <input type="text" class="form-control" id="itemcode" name = "itemcode" placeholder="Item Code" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Item Name</label>
                                        <input type="text" class="form-control" id="itemname" name = "itemname" placeholder="Item Name" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputEmail4">Supplier</label>
                                        <select name="supplier" id = "supervisor" class="" required>
                                            <option value="#">Select Supplier</option>
                                            <?php echo $dlist;?>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputPassword4">Buying Price</label>
                                        <input type="text" class="form-control" id="bprice" name = "bprice" placeholder="Buying Price" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputPassword4">Buying Discount (%)</label>
                                        <input type="text" class="form-control" id="bdiscount" name = "bdiscount" placeholder="Buying Discount" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputEmail4">Selling Price</label>
                                        <input type="text" class="form-control" id="sprice" name = "sprice" placeholder="Selling Price">
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputPassword4">Selling Discount (%)</label>
                                        <input type="text" class="form-control" id="sdiscount" name = "sdiscount" placeholder="Selling Discount">
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputnop">No of Packages</label>
                                        <input type="text" class="form-control" id="inputnop" name = "nop" placeholder="No of Packages">
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputqop">QTY of Package</label>
                                        <input type="text" class="form-control" id="inputqop" name = "qop" placeholder="QTY of Package">
                                    </div>
                                    <div class="form-group col">
                                        <label for="inpuQty">QTY</label>
                                        <input type="text" class="form-control" id="inpuQty" name = "qty" placeholder="QTY">
                                    </div>
                                </div>

                                <button type="submit" name = "addItem" class="btn btn-primary">Add Item</button>
                                </form>
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

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin/js/demo/datatables-demo.js"></script>
    <script>
        dselect(document.querySelector('#supervisor'),{
        search: true
        });
    </script>
    <script>
        let inputnop = document.getElementById("inputnop");
        let inputqop = document.getElementById("inputqop");
        inputqop.addEventListener("change", ()=>{
            document.getElementById("inpuQty").value = Number(inputqop.value) * Number(inputnop.value);
        });
        
    </script>

    <?php
        if(isset($_SESSION["successAddednewProduct"])){
            echo "<script>
                document.getElementById(\"itemcode\").value = '';
                document.getElementById(\"itemname\").value = '';
                document.getElementById(\"bprice\").value = '';
                document.getElementById(\"bdiscount\").value = '';
                document.getElementById(\"sprice\").value = '';
                document.getElementById(\"sdiscount\").value = '';
                document.getElementById(\"inputnop\").value = '';
                document.getElementById(\"inputqop\").value = '';
                document.getElementById(\"inpuQty\").value = '';
                swal({
                title: 'Success',
                    text: 'Successfully Added new Item',
                    icon: 'success',
                });
            </script>";
            unset($_SESSION['successAddednewProduct']);
        }
    ?>
 
</body>
</html>