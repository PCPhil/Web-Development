<html>
<title></title>
<head></head>
<body>

<?php 
$postalcodeErr = "";
$datavalid = true;
if($_GET){
	if (preg_match("/^(\s|.)?[a-zA-Z]\d[a-zA-Z](\s|.)?\d[a-zA-Z]\d(\s|.)?/" ,$_GET['postalcode']) == 0){
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
<h2>__X9X_9X9__</h2>
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
