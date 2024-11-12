<?php
session_start();
?>
<?php
include('database.php');
date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d");
$sqlgetmaxid = "SELECT max(mid) as midold FROM sales";
    $resultgetmaxid = $conn->query($sqlgetmaxid);
    if ($resultgetmaxid->num_rows > 0){
        while($rowgetmaxid = $resultgetmaxid->fetch_assoc()){
            $midold = $rowgetmaxid['midold'];
        }
        $mid = $midold + 1;
    }
    else{
        $mid = 1;
    }
if(isset($_SESSION["unpaid"])){

    
    $cash = $_SESSION["unpaid"];
    $sqlp = "SELECT * FROM tillsales";
    $resultp = $conn->query($sqlp);
    if ($resultp->num_rows > 0){
        $tillsum = 0;
        while($row = $resultp->fetch_assoc()){
            $id = $row['id'];
            $item = $row['item'];
            $sprice = $row['sprice'];
            $qty = $row['qty'];
            $discount = $row['discount'];
            $disprice = $row['disprice'];
            $tillsum += (($sprice * $qty) - $disprice);
            $sqli = "INSERT INTO sales(item,qty,price,discount,date,disprice,mid) VALUES({$item},{$qty},{$sprice},{$discount},'{$date}',{$disprice},$mid)";
            if($conn->query($sqli) === TRUE){
            }
            $sqla = "SELECT * FROM product WHERE id = {$item}";
            $resulta = $conn->query($sqla);
            if ($resulta->num_rows > 0){
                while($rowa = $resulta->fetch_assoc()){
                    $qtyOld = $rowa['qty'];
                }
            }
            $qtyNew = $qtyOld - $qty;
            $sqlu = "UPDATE product SET qty = {$qtyNew} WHERE id = {$item}";
            if($conn->query($sqlu) === TRUE){
                
            }  
        }
        $bal = $tillsum - $cash;
        $sqli = "INSERT INTO unpaid VALUES({$mid},{$tillsum},{$cash},{$bal},'{$date}')";
        if($conn->query($sqli) === TRUE){
            $sqli = "DELETE FROM tillsales";
            if($conn->query($sqli) === TRUE){
                $_SESSION['successsale'] = 0;
                //setcookie('selectedValue', '',time() - 3600);
                header("Location:addsales");
            }
        }
    }
}
else{
    $sqlp = "SELECT * FROM tillsales";
    $resultp = $conn->query($sqlp);
    if ($resultp->num_rows > 0){
        while($row = $resultp->fetch_assoc()){
            $id = $row['id'];
            $pid = $row['item'];
            $sqlt = "SELECT * FROM product WHERE id = {$pid}";
            $resultt = $conn->query($sqlt);
            if ($resultt->num_rows > 0){
                while($rowt = $resultt->fetch_assoc()){
                    $product = $rowt['item'];
                }
            }
                                                
            $sprice = $row['sprice'];
            if(isset($_SESSION["unpaid"])){
                $sprice = 0 - $sprice;
            }
            else{
                $sprice = $row['sprice'];
            }
            $discount = $row['discount'];
            $qty = $row['qty'];
            $disprice = $row['disprice'];
            $sqli = "INSERT INTO sales(item,qty,price,discount,date,disprice,type,mid) VALUES({$pid},{$qty},{$sprice},{$discount},'{$date}',{$disprice},1,{$mid})";
            if($conn->query($sqli) === TRUE){
                $sqla = "SELECT * FROM product WHERE id = {$pid}";
                $resulta = $conn->query($sqla);
                if ($resulta->num_rows > 0){
                    while($rowa = $resulta->fetch_assoc()){
                        $qtyOld = $rowa['qty'];
                    }
                }
                $qtyNew = $qtyOld - $qty;
                $sqlu = "UPDATE product SET qty = {$qtyNew} WHERE id = {$pid}";
                if($conn->query($sqlu) === TRUE){
                    
                }
            }
        }
        $sqli = "DELETE FROM tillsales";
        if($conn->query($sqli) === TRUE){
            $_SESSION['successsale'] = 0;
            //setcookie('selectedValue', '',time() - 3600);
            header("Location:addsales");
        }
    }
}
?>