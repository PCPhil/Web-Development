<?php
session_start();
if(isset($_SESSION['user'])){
	//setcookie("PHPSESSID", "", time() - 61200,"/");
	echo "You're logged in! ";
	echo $_SESSION['user']."<br>";
}
else{
    header('location:http://zenit.senecac.on.ca:19350/login.php');
}
?>
<html>
 <style>
  	body{background-color:66FFCC;font-family:tahoma;}
 </style>
<body>
<a href="http://zenit.senecac.on.ca:19350/login.php?logout">Logout</a>
</body>
</html>

