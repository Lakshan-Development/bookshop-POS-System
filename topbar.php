<?php
if(isset($_SESSION['remadminlogin']) || isset($_SESSION['remlogin'])){
    if(isset($_SESSION['remadminlogin'])){
        $id = $_SESSION['remadminlogin'];
    }
    else{
        $id = $_SESSION['remlogin'];
    }
}
else{
    //header("Location:login");
}
$remadminlogin = $_SESSION['remadminlogin'];

    $sql = "SELECT * FROM user WHERE id = {$remadminlogin}";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$type = $row['type'];
		}
	}
?>
<html>
    <head>
        <style>
            nav img{
                width:120px;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a href="adminpanel"><img src="bgMultiservice.jpg" style = "width:4em;" alt=""></a>
      </li>
      <li class="nav-item mt-3 ml-5">
        <a class="btn" href="addsales" style = "border:none;height:100%;padding-top:11%;background:#00f;font-weight:bold;color:#fff;">
        <i class="fas fa-fw fa-plus" style = "font-size:16px;"></i>
                    <span style = "font-size:16px;">Add Sale</span>
        </a>
      </li>
      <li class="nav-item mt-3">
      <a class="btn ml-3" href="add_product" style = "border:none;height:100%;padding-top:11%;background:#00f;font-weight:bold;color:#fff;">
        <i class="fas fa-fw fa-list" style = "font-size:16px;"></i>
                    <span style = "font-size:16px;">Item List</span>
        </a>
        </li>
        <?php
            if($type == 1){
            ?>
        <li class="nav-item mt-3">
        <a class="btn ml-3 ml-3" href="cost" style = "border:none;height:100%;padding-top:9%;background:#00f;font-weight:bold;color:#fff;">
                    <i class="fas fa-fw fa-share" style = "font-size:16px;"></i>
                    <span style = "font-size:16px;">Exchange</span>
                </a>
        </li>
        <li class="nav-item mt-3">
        <a class="btn ml-3 ml-3" href="unpaid" style = "border:none;height:100%;padding-top:11%;background:#00f;font-weight:bold;color:#fff;">
                    <i class="fas fa-fw fa-times" style = "font-size:16px;"></i>
                    <span style = "font-size:16px;">Unpaid</span>
                </a>
        </li>
        <li class="nav-item mt-3">
        <a class="nav-link ml-3" href="suppliers" style = "border:none;height:100%;padding-top:11%;background:#00f;font-weight:bold;color:#fff;">
                    <i class="fas fa-fw fa-users" style = "font-size:16px;"></i>
                    <span style = "font-size:16px;">Suppliers</span>
                </a>
        </li>
        <li class="nav-item mt-3">
        <a class="nav-link ml-3" href="income" style = "border:none;height:100%;padding-top:12%;background:#00f;font-weight:bold;color:#fff;">
                    <i class="fas fa-fw fa-credit-card" style = "font-size:16px;"></i>
                    <span style = "font-size:16px;">Income</span>
                </a>
        </li>
        <!--<li class="nav-item mt-3">
        <a class="nav-link ml-3" href="add_customer" style = "border:none;height:100%;padding-top:8%;background:#00f;font-weight:bold;color:#fff;">
                    <i class="fas fa-fw fa-plus" style = "font-size:16px;"></i>
                    <span style = "font-size:16px;">Add New User</span>
                </a>
        </li>-->
        <?php    
            }
            ?>
    </ul>

    <div class="form-inline my-2 my-lg-0">
    <li class="nav-item dropdown no-arrow">
            <!--<a class="nav-link dropdown-toggle" href="processing?logoutId=1"role="button"
            aria-haspopup="true" aria-expanded="false">
                
                <i class="fas fa-sign-out-alt ml-2 fa-sm fa-fw mr-2 text-gray-400" style = 'color:#fe0000;'></i>
            </a>-->
            <button class="nav-link dropdown-toggle" onclick = "logoutConfirm()" role="button"
            aria-haspopup="true" aria-expanded="false" style = "border:none;background:transparent;">
                
                <i class="fas fa-sign-out-alt ml-2 fa-sm fa-fw mr-2 text-gray-400" style = 'color:#fe0000;'></i>
        </button>
        </li>
    </form>
  </div>
</nav>
<br>
<script>
    const myPathName = window.location.pathname;
    let sidebarToggleTop = document.getElementById("sidebarToggleTop");
    if(myPathName == "/projects/kochchi/" || myPathName == "/projects/kochchi/main"){
        sidebarToggleTop.style.display = "none";
    }
    else {
        sidebarToggleTop.style.display = "block";
    }
    //console.log(myPathName);

    function logoutConfirm(){
        swal({
            title: "Are you sure?",
            text: "Are you sure that you are exit?",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = "processing?logoutId=1";
            } else {
                //swal("Your imaginary file is safe!");
            }
        });
    }
  </script>