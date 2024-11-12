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
    $sqla = "SELECT * FROM user WHERE id = {$remadminlogin}";
	$resulta = $conn->query($sqla);
	if ($resulta->num_rows > 0){
		while($rowa = $resulta->fetch_assoc()){
			$type = $rowa['type'];
		}
	}
}
    if(isset($_POST["sbmitBtn"])){
        $month = $_POST["monthselect"];
        $tomonth = $_POST["tomonthselect"];
        $sql = "SELECT * FROM cost WHERE date BETWEEN '{$month}' and '{$tomonth}'";
    }
    else{
        $month = date("Y-m");
        $sql = "SELECT * FROM cost WHERE date LIKE '{$month}%'";
    }
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
        $tot = 0;
        $tot_cost = 0;
        $tot_income = 0;
        $dlist = "";
		while($row = $result->fetch_assoc()){
			$idu = $row['id'];
			$name = $row['name'];
			$reason = $row['reason'];
			$price = $row['price'];
            $tot += $price;
			$date = $row['date'];
			$type = $row['type'];
            if($type == 1){
                $tot_cost += $price;
                $color = "red";
            }
            else{
                $tot_income += $price;
                $color = "green";
            }
            $dlist .= "<tr><td style = 'color:{$color}'>{$name}</td>
            <td style = 'color:{$color}'>{$reason}</td>
            <td style = 'color:{$color}'>Rs. {$price}</td>
            <td style = 'color:{$color}'>Rs. {$date}</td>";
            
                $dlist .= "<td>
                <a href = 'processing?delcost={$idu}'><i class=\"fas fa-fw fa-trash\"></i></a>";
            
            $dlist .= "</tr>";
		}
        $dlist .= "<tr><td colspan ='2' style = 'color:red;'>Total cost</td><th style = 'color:red'>Rs. {$tot_cost}</th></tr>";
        $dlist .= "<tr><td colspan ='2' style = 'color:green;'>Total income</td><th style = 'color:green'>Rs. {$tot_income}</th></tr>";
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

    <title>Exchange</title>

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
                            Exchange
                            <?php
                            //if($type == 1){
                            echo "<a href=\"addcost\" class = \"btn btn-primary ml-4\" style = \"font-family: sans-serif;\">Add cost</a>";
                            echo "<a href=\"addincome\" class = \"btn btn-primary ml-4\" style = \"font-family: sans-serif;\">Add income</a>";
                            //}
                            
                            ?>
                        </h1>
                    </div>

                    <div id="content">
                <!-- Begin Page Content -->
                <div class="">
                    
                    
                    <!-- DataTales Example -->
                    <div class="card shadow">
                    <form action="#" method = "post" class = "m-3">
                        <div class="row">
                            <div class="col">
                            <label for="">Select From Date</label>
                            <input type="date" class="form-control" placeholder="select month" name = "monthselect" required>
                            </div>
                            <div class="col">
                            <label for="">Select To Date</label>
                            <input type="date" class="form-control" placeholder="select month" name = "tomonthselect" required>
                            </div>
                            <div class="col">
                            <label for=""><br></label>
                            <input type="submit" style = "background:#3059D9;color:#fff;border:none;" class="form-control" value="Search" name = "sbmitBtn">
                            </div>
                            <div class="col">
                            <label for=""><br></label>
                            </div>
                            <div class="col">
                            <label for=""><br></label>
                            </div>
                        </div>
                    </form>
                        <div class="card-body" id='invoice'>
                            <div class="table-responsive">
                                <form action="processing" method = "post">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Reason</th>
                                            <th>Price</th>
                                            <th>Date</th>
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