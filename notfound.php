<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Troja</title>

    <!-- font awesome cdn link  -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
-->
    <!-- custom css file link  -->
	
	<link href="/projects/Election/assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="/projects/Election/assets/css/style.css">
    <style>
    .header-1 img{width:30%;}
    .contact{margin-top:6%;}
    .ntfoundgif{width:20%;}
    .link{text-decoration:none;background:#E62E2D;padding:1% 2%;color:#fff;border-radius:20px;font-size:15px;}
    .link:hover{color:#fff;}
    @media (max-width: 739px) {
        .contact{mergin-top:0;
            display: flex;min-height: 80%;align-items: center;justify-content: center;
        }
        h1{font-size:22px;}
        .link{text-decoration:none;background:#f00;padding:3% 5%}
        .ntfoundgif{width:50%;}
	    .header-1 img{width:80%;}
	    .inputBox .selectplant{width:100%}
    } 
    </style>
</head>
<body>
<script src="sweetalert.min.js"></script>

<!-- header section starts  -->

<header>

    <div class="header-1">

        <center><a href="#" class="logo" style = 'color:#fe2121;'>
        <img src = '/projects/reminder/logo1.png'></a>

    </div>

    

</header>
<!-- Pickup section starts  -->

<section class="contact">
	<center><img src = '/projects/reminder/logo.png' class = 'ntfoundgif'><br>
    <h1>Page Not Found</h1><br>
    <a class = 'link' href="/projects/reminder">Go Home</a>
</section>

<!-- Pickup section ends -->
<br><br>
<!-- custom js file link  -->
<script src="script.js"></script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>