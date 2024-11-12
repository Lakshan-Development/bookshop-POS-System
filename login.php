<?php
session_start();
if(isset($_SESSION['remlogin'])){
    header("Location:main");
}
if(isset($_SESSION['remadminlogin'])){
  header("Location:adminpanel");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>Login</title>
	
	<link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="bgMultiservice.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style>
    body{
        background:#3059D9;
        height:90vh;
        overflow: hidden;
    }
	
    @media (max-width: 739px) {
        .contact{
            margin-top:0;display: flex;min-height: 80%;align-items: center;justify-content: center;
        }
	    .header-1 img{width:80%;}
	    .inputBox .selectplant{width:100%}
    } 
    </style>
</head>
<body>
<script src="sweetalert.min.js"></script>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-white text-dark" style="border-radius: 1rem;">
          <div class="card-body px-5">
            <div class="mb-md-5 mt-md-4">
            <center>
              <img src="bgMultiservice.jpg"
                alt="login form" class="img-fluid" style="width:35%; border-radius: 1rem 0 0 1rem;" />
                </center>
                <br>
                <form action='processing' method = 'post' style = 'border:none;'>

                  <h5 class="fw-normal fs-1 mb-3 pb-3 text-center" style="letter-spacing: 1px;">Login</h5>

                  <div class="form-group">
                    <div class="">
                      <label for="exampleInputEmail1" class  = "h3">Username</label>
                      <input type="text" name = "username" class="h1 form-control form-control-lg" style = "font-size:16px;" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
                    </div>
                    <br>
                  </div>
                  <div class="form-group">
                    <div class="">
                      <label for="exampleInputEmail1" class  = "h3">Password</label>
                      <input type="password" name = "pwd" class="h1 form-control form-control-lg" style = "font-size:16px;" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Password">
                    </div>
                  </div>
                  <br>
                  <center>
                    <button type="submit" name = "loginAdmin" class="btn btn-primary btn-lg" style = "width:100%; background:#3059D9;border:none;font-size:18px;">Login</button>
                  </center>
                <br>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Pickup section ends -->
<br><br>
<!-- custom js file link  -->
<script src="script.js"></script>
<?php
if(isset($_SESSION['wrongpwd'])){
    echo "<script>
        swal({
        title: 'Wrong Password',
            text: 'Please Check Your Password',
            icon: 'error',
        });
    </script>";
    session_destroy();
}

if(isset($_SESSION['wronguser'])){
    echo "<script>
        swal({
        title: 'Wrong Username',
            text: 'Please Check Your Username',
            icon: 'error',
        });
    </script>";
    session_destroy();
}


?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>