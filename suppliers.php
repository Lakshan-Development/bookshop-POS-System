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

    $month = date("Y-m");
    $sql = "SELECT * FROM suplier";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
        $dlist = "";
		while($row = $result->fetch_assoc()){
			$idu = $row['id'];
			$name = $row['name'];
			$company = $row['company'];
			$contact = $row['contact'];
            $dlist .= "<tr><td>{$name}</td>
            <td>{$company}</td>
            <td>{$contact}</td>";
            if($type == 1){
                $dlist .= "<td>
                <a href = 'processing?delsuplier={$idu}'><i class=\"fas fa-fw fa-trash\"></i></a>";
            }
            $dlist .= "</tr>";
		}
	}
    else{
        $dlist = "";
    }

?>
<script src="sweetalert.min.js"></script>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Suppliers</title>

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

                    <h1 class="h2 mb-0" style = "color:#000;font-family: 'Impact', sans-serif;letter-spacing: 1px;">
                            Supplier List
                            <?php
                            if($type == 1){
                            echo "<a href=\"addsuppliers\" class = \"btn btn-primary ml-4\" style = \"font-family:sans-serif;\">Add New Supplier</a>";
                            }
                            ?>
                        </h1>
                    </div>

                    <div id="content">
                <!-- Begin Page Content -->
                <div class="">

                    
                    <!-- DataTales Example -->
                    <div class="card shadow">
                        <div class="card-body" id='invoice'>
                            <div class="table-responsive">
                                <form action="processing" method = "post">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>Contact</th>
                                            <?php
                                            if($type == 1){
                                                ?>
                                                <th>Action</th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php echo $dlist;?>
                                    </tbody>
                                </table>
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