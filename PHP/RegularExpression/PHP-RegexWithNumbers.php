<html>
<title></title>
<head></head>
<body>

<?php 
$postalcodeErr = "";
$datavalid = true;
if($_GET){
	if (preg_match("/^[a-zA-Z]{3}\d{3}[a-zA-Z]{1,3}$/" ,$_GET['postalcode']) == 0){
		$postalcodeErr = "Error";
		$datavalid = false;

	}
	
}
if ($_GET && $datavalid) {
?>

<?php
$postalcode = $_GET['postalcode'];
echo "postalcode: $postalcode<br>";
?>
<?php
}else{
?>
<h1>Postal Code </h1>
<h2>XXX999X<br>XXX999XX<br>XXX999XXX</h2>
<form method="GET" action="">
<table>
<tr>
<td>Postal Code:</td>
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
