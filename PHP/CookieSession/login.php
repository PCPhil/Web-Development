<?php	
	
	//SENDS A VARIABLE TO BE USED FOR DESTROYING SESSION
	session_start();
	if(isset($_GET['logout'])){
	session_unset();
	session_destroy();
	setcookie("PHPSESSID", "", time() - 61200,"/");
	$logout="You logged out!";
	unset($_GET['logout']); 
	}
	//CHECK FOR EXISTING SESSION!
	if(isset($_SESSION['user'])){
	//Connect to the script specified
	header('location:http://zenit.senecac.on.ca:19350/protectedstuff.php');
	}
//Error variables
$userErr;
$passErr;
$loginErr;

//Variables to store values
$user;
$pass;
$valid = true;
$logout;
//Post Method
if($_POST){
	$logout="";
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$salt="p";
	$hashedpass= crypt($pass,$salt);
	//Check empty strings
	/*if($_POST['user']==""){
		$userErr = "Fill in field!";
		$valid = false;
	}
	if($_POST['pass']==""){

		$passErr = "Fill in field!";
		$valid = false;
	}
*/
	// get database servername, username, password, and database name
          	//  from local file not on web accessible path (remove newline/blanks)
		$lines = file('/home/int322_161a27/secret/topsecret.txt');
		$dbserver = trim($lines[0]);
		$uid = trim($lines[1]);
		$pw = trim($lines[2]);
		$dbname = trim($lines[3]);
	//Connect to the mysql server and get back our link_identifier
 		$link = mysqli_connect($dbserver, $uid, $pw, $dbname)
         			or die('Could not connect: ' . mysqli_error($link));
		

	//This Query will look for matching values of user and password
		$sql_query = 'select * from users where username ="'.$user.'" AND password="'.$hashedpass.'"';
		$result = mysqli_query($link,$sql_query) or die ('Failed').mysqli_error($link); 

	//Checks if the statement above returned any rows
		$count = (mysqli_num_rows($result));

	//Checks if row count is less than one, set invalid login than
		if($count < 1){
			$loginErr = "Invalid User or Password";
			$valid = false;	
		}
		else{
		$loginErr = "";
		$_SESSION['user'] = $user;
		



		}
	//Close connection to database
		mysqli_close($link);


}


if($_POST && $valid){
//Connect to the script specified
header('location:http://zenit.senecac.on.ca:19350/protectedstuff.php');
}

//EMAIL
else if(isset($_GET['i'])){
	$email=$_POST['email'];
	$eErr;
	$valid2=true;
	if($_POST){
		
	 if($_POST['email']==""){
		$eErr = "Enter an Email";
		$valid2 = false;
	 }
	 else{
		// get database servername, username, password, and database name
          	//  from local file not on web accessible path (remove newline/blanks)
		$lines = file('/home/int322_161a27/secret/topsecret.txt');
		$dbserver = trim($lines[0]);
		$uid = trim($lines[1]);
		$pw = trim($lines[2]);
		$dbname = trim($lines[3]);
		//Connect to the mysql server and get back our link_identifier
 		$link = mysqli_connect($dbserver, $uid, $pw, $dbname)
         			or die('Could not connect: ' . mysqli_error($link));

		//This Query will look for matching values of Email
		$sql_query = 'select * from users where username ="'.$email.'"';
		$result = mysqli_query($link,$sql_query) or die ('Failed').mysqli_error($link); 
		

		
		//Checks if the statement above returned any rows
		$count2 = (mysqli_num_rows($result));
		
		//Retrieval rows for password hint
		$row = mysqli_fetch_assoc($result);

		//Close connection to database
		mysqli_close($link);
		if($count2 < 1){
			header('location:http://zenit.senecac.on.ca:19350/login.php');	
		}	
	 }
	}	
	if($_POST && $valid2 && isset($_REQUEST['email'])){
	if($count2){
	//Email information
 	 $to = $_REQUEST['email'];
	 $subject = "Password Retrieval";
	 $message = "Your password hint is ".$row['passwordHint'];
 	 $from = "int322_161a27@noreply.ca";
	mail($to,$subject,$message, "From:".$from);
	}
	 header('location:http://zenit.senecac.on.ca:19350/login.php');
	}
	else{

?>	
	<html>
	<style>
	body{background-color:66FFCC;font-family:tahoma;}
	fieldset{width:350px;margin:auto;}
	</style>
	<body>
		<form method="post" action="">
	<fieldset>
	<legend>Password Recovery</legend>
	<p>Please enter your email.</p>
	<table>
	<tr>
    	<td>Email:</td>
	<td><input name="email" type="text" value=""><?php echo $eErr;?></td>
	</tr>
	<tr><td><br></td></tr>
	<tr>
	<td></td>
	<td><input name="submit" type="submit" value="Submit"></td>
	</tr>
	</table>
	</fieldset>
	</body>
	</html>
<?php
	}
}
else{
?>
<html>
<style>
fieldset{width:400px;margin:0 auto;text-align:left;}
body{background-color:66FFCC;font-family:tahoma;text-align:center;}
</style>
<body>
<h1>INT322_161A27 SERVICES</h1>
	<form method="post" action="">
	<p><?php echo $logout;?></p>
	<fieldset>
	<legend>Login</legend>
	<p>Please fill in the fields.</p>
	<table>
	<tr>
	<p><?php echo $loginErr; ?></p>
    	<td>Username:</td>
	<td><input name="user" type="text" value=""><?php echo $userErr;?></td>
	</tr>
	<tr>
    	<td>Password:</td>
	<td><input name="pass" type="password" value=""><?php echo $passErr;?></td>
	</tr>
	<tr><td><br></td></tr>
	<tr>
	<td></td>
	<td><input name="submit" type="submit"></td>
	</tr>
	</table>
	
	<a href="http://zenit.senecac.on.ca:19350/login.php?i">Forgot your password?</a><br>
	<a href="http://zenit.senecac.on.ca:19350/register.php?i">Sign up</a>
	
	</fieldset>
  </form>
  </body>
</html>
<?php
}
?>