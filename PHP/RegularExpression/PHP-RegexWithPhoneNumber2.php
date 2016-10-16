<html>
<title></title>
<head></head>
<body>

<?php 
$postalcodeErr = "";
$datavalid = true;
if($_GET){//         OUTPUT:_999- or _ or _(123)_123- or _1234_      
	if (preg_match("/^(\s*\d{3}(-|\s*)|\s*\(\d{3}\)\s*)\d{3}(-|\s*)\d{4}\s*$/" ,$_GET['postalcode']) == 0){
		$postalcodeErr = "Error";
		$datavalid = false;

	}
	
}
if ($_GET && $datavalid) {
?>

<?php
$postalcode = $_GET['postalcode'];
echo "Phone: $postalcode<br>";
?>
<?php
}else{
?>
<h1>phone</h1>
<h2>999-999-9999</h2>
<form method="GET" action="">
<table>
<tr>
<td>Phone Number:</td>
<td><input type="text"  name=postalcode value="<?php if (isset($_GET['postalcode'])) echo $_GET['postalcode']; ?>"><?php echo $postalcodeErr;?></td>
        </tr>
<tr>
<td><input type="submit" name "submit"></td>
</tr>
</table>
</form>
<?php 
}
?>
</body>
</html>
