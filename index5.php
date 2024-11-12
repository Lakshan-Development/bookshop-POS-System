<?php
require('vendor/autoload.php');
if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$redColor = [0, 0, 0];
	$generator = new Picqer\Barcode\BarcodeGeneratorJPG();
	file_put_contents("barcode/{$name}.jpg", $generator->getBarcode($name, $generator::TYPE_CODE_128, 3, 50, $redColor));
}

?>

<form method="post">
	<input type="text" name="name" required/>
	<input type="submit" name="submit"/>
</form>