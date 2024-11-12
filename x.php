<?php
session_start();
?>
<?php
include('database.php');
require('vendor/autoload.php');
date_default_timezone_set('Asia/Colombo');
$datetoday = date("Y-m-d");
require("sms/send_sms_impl.php");
?>
<script src="sweetalert.min.js"></script>
<?php

//Items add to till sale
if(isset($_POST['saveProduct'])){
    
    if ($_POST['product'] == "#"){
        echo "<script>window.history.back()</script>";
    }
    else{
        $product = $_POST['product'];
        $sprice = $_POST['sprice'];
        $sdiscount = $_POST['sdiscount'];
        $qty = $_POST['qty'];
        $disprice = $sprice * (($sdiscount * $qty) / 100);
        $sqli = "INSERT INTO tillsales(item,sprice,discount,qty,disprice) VALUES({$product},{$sprice},{$sdiscount},{$qty},{$disprice})";
        if($conn->query($sqli) === TRUE){
            setcookie('selectedValue', '',time() - 3600);
            echo "<script>window.history.back()</script>";
        }
    }
    
}

//Delete Item Before sale
if(isset($_GET['deleteproduct'])){
    $deleteproductid = $_GET['deleteproduct'];
	$sqli = "DELETE FROM tillsales WHERE id = {$deleteproductid}";
	if($conn->query($sqli) === TRUE){
        echo "<script>window.history.back()</script>";
	}
}

//User Login
if(isset($_POST['loginAdmin'])){
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $sql = "SELECT * FROM user WHERE user = '{$username}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
            $pasword = $row['password'];
            $type = $row['type'];
            $verifypwd = password_verify($pwd, $pasword);
            if($verifypwd){
                $_SESSION['remadminlogin'] = $id;
                header("Location:adminpanel");
            }
            else{
                $_SESSION['wrongpwd'] = 100;
                echo "<script>window.history.back()</script>";
            }
        }
    }
    else{
        $_SESSION['wronguser'] = 100;
        echo "<script>window.history.back()</script>";
    }
    
}

//User Logout
if(isset($_GET['logoutId'])){
    session_destroy();
    header("Location:main");
}

//Delete User
if(isset($_GET['delCustomer'])){
	
    $delId = $_GET['delCustomer'];
	$sqli = "DELETE FROM user WHERE id = {$delId}";
	if($conn->query($sqli) === TRUE){
		echo "<script>window.history.back()</script>";
	}
}

//Delete Item
if(isset($_GET['delitem'])){
    $delId = $_GET['delitem'];
	$sqli = "DELETE FROM product WHERE id = {$delId}";
	if($conn->query($sqli) === TRUE){
		echo "<script>window.history.back()</script>";
	}
}

//Delete Supplier
if(isset($_GET['delsuplier'])){
    $delsuplier = $_GET['delsuplier'];
	$sqli = "DELETE FROM suplier WHERE id = {$delsuplier}";
	if($conn->query($sqli) === TRUE){
		echo "<script>window.history.back()</script>";
	}
}

//Delete Cost
if(isset($_GET['delcost'])){
    $delcost = $_GET['delcost'];
	$sqli = "DELETE FROM cost WHERE id = {$delcost}";
	if($conn->query($sqli) === TRUE){
		echo "<script>window.history.back()</script>";
	}
}

//Add User
if(isset($_POST['addCustomer'])){	
    $customername = $_POST['customername'];
    $type = $_POST['type'];
	$sqli = "INSERT INTO user(user,type) VALUES('{$customername}',{$type})";
	if($conn->query($sqli) === TRUE){
        echo "<script>window.history.back()</script>";
	}
}

//Add Item
if(isset($_POST['addItem'])){
    $itemcode = $_POST['itemcode'];
    $itemname = $_POST['itemname'];
    $supplier = $_POST['supplier'];
    $bprice = $_POST['bprice'];
    $bdiscount = $_POST['bdiscount'];
    $sprice = $_POST['sprice'];
    $sdiscount = $_POST['sdiscount'];
    if(isset($_POST['nop'])){
        $nop = $_POST['nop'];
    }
    else{
        $nop = $_POST['nop'] = 0;
    }
    if(isset($_POST['qop'])){
        $qop = $_POST['qop'];
    }
    else{
        $qop = $_POST['qop'] = 0;
    }
    $qty = $_POST['qty'];
	$sqli = "INSERT INTO product(itemcode,item,suplier,bprice,bdiscount,sprice,sdiscount,nop,qop,qty) 
    VALUES('{$itemcode}','{$itemname}','{$supplier}',{$bprice},{$bdiscount},{$sprice},{$sdiscount},{$nop},{$qop},{$qty})";
	if($conn->query($sqli) === TRUE){
        $_SESSION["successAddednewProduct"] = 0;
        /*$redColor = [0, 0, 0];
        $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        file_put_contents("barcode/{$itemcode}.jpg", $generator->getBarcode($itemcode, $generator::TYPE_CODE_128, 3, 50, $redColor));*/
        echo "<script>window.history.back()</script>";
	}
}

//Add Supplier
if(isset($_POST['addSupplier'])){
    $sname = $_POST['sname'];
    $scompany = $_POST['scompany'];
    $contact = $_POST['contact'];
	$sqli = "INSERT INTO suplier(name,company,contact) VALUES('{$sname}','{$scompany}','{$contact}')";
	if($conn->query($sqli) === TRUE){
        echo "<script>window.history.back()</script>";
	}
}

//Add Cost
if(isset($_POST['addCost'])){
    $name = $_POST['name'];
    $reason = $_POST['reason'];
    $price = $_POST['price'];
    $date = $_POST['date'];
	$sqli = "INSERT INTO cost(name,reason,price,date,type) VALUES('{$name}','{$reason}',{$price},'{$date}',1)";
	if($conn->query($sqli) === TRUE){
        echo "<script>window.history.back()</script>";
	}
}

//Add Income
if(isset($_POST['addIncome'])){
    $name = $_POST['name'];
    $reason = $_POST['reason'];
    $price = $_POST['price'];
    $date = $_POST['date'];
	$sqli = "INSERT INTO cost(name,reason,price,date,type) VALUES('{$name}','{$reason}',{$price},'{$date}',0)";
	if($conn->query($sqli) === TRUE){
        echo "<script>window.history.back()</script>";
	}
}

//Edit Item
if(isset($_POST["edititem"])){
    $idu = $_SESSION["itemid"];
    $bprice = $_POST["bprice"];
    $sprice = $_POST["sprice"];
    $sdiscount = $_POST["sdiscount"];
    $qty = $_POST["qty"];
    $sqli = "UPDATE product SET bprice = {$bprice},sprice = {$sprice},sdiscount = {$sdiscount}, qty = {$qty} WHERE id = {$idu}";
    if($conn->query($sqli) === TRUE){
        unset($_SESSION["itemid"]);
        echo "<script>window.history.back()</script>";
    }
}   

//set paid
if(isset($_GET["remminusid"])){
    $remminusid = $_GET["remminusid"];
    $sqli = "UPDATE sales SET type = 1 WHERE mid = {$remminusid}";
    if($conn->query($sqli) === TRUE){
        $sqli = "DELETE FROM unpaid WHERE id = {$remminusid}";
        if($conn->query($sqli) === TRUE){
            echo "<script>window.history.back()</script>";
        }
    }
}
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>