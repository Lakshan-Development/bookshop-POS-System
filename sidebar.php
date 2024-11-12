<?php
if(isset($_SESSION['remadminlogin'])){
    include('database.php');
    $remadminlogin = $_SESSION['remadminlogin'];

    $sql = "SELECT * FROM user WHERE id = {$remadminlogin}";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$type = $row['type'];
		}
	}
}
else{
    header("Location:login");
}

?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style = "background:#3059D9;">

            <!-- Sidebar - Brand -->
           
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminpanel">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="logoremovebg.png" alt="logo" style = "border-radius:10px;width:75%;-webkit-transform: rotate(15deg);margin-left:-20%;margin-top:50%;" >
                </div>
            </a>
            <br><br><br>
            <br>
            <hr  class="sidebar-divider d-none d-md-block">
            <li class="nav-item active">
                <a class="nav-link" href="addsales">
                    <i class="fas fa-fw fa-plus" style = "font-size:16px;color:#fff;"></i>
                    <span style = "font-size:16px;color:#fff;">Add Sale</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="add_product">
                    <i class="fas fa-fw fa-list" style = "font-size:16px;color:#fff;"></i>
                    <span style = "font-size:16px;color:#fff;">Item List</span>
                </a>
            </li>
            <?php
            if($type == 1){
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="cost">
                    <i class="fas fa-fw fa-share" style = "font-size:16px;color:#fff;"></i>
                    <span style = "font-size:16px;color:#fff;">Exchange</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="suppliers">
                    <i class="fas fa-fw fa-users" style = "font-size:16px;color:#fff;"></i>
                    <span style = "font-size:16px;color:#fff;">Suppliers</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="income">
                    <i class="fas fa-fw fa-credit-card" style = "font-size:16px;color:#fff;"></i>
                    <span style = "font-size:16px;color:#fff;">Income</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="add_customer">
                    <i class="fas fa-fw fa-plus" style = "font-size:16px;color:#fff;"></i>
                    <span style = "font-size:16px;color:#fff;">Add New User</span>
                </a>
            </li>

            <?php    
            }
            ?>
            <hr class="sidebar-divider my-4">
        </ul>
