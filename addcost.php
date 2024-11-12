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
}
?>
<script src="sweetalert.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Add Cost</title>

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
                    <h1 class="h2 mb-0" style = "color:#000;font-family: 'Impact', sans-serif;letter-spacing: 1px;">Add cost</h1>
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
                                    <div class="form-group col">
                                        <label for="inputEmail4">Name</label>
                                        <input type="text" class="form-control" id="inputEmail4" name = "name" placeholder="Name" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputPassword4">Reason</label>
                                        <input type="text" class="form-control" id="inputPassword4" name = "reason" placeholder="Reason" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputPassword4">Price</label>
                                        <input type="text" class="form-control" id="inputPassword4" name = "price" placeholder="Price" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputPassword4">Select Date</label>
                                        <input type="date" class="form-control" id="inputPassword4" name = "date" placeholder="Date" required>
                                    </div>
                                </div>

                                <button type="submit" name = "addCost" class="btn btn-primary">Add cost</button>
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

 
</body>
</html>