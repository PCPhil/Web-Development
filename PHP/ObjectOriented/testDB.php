<html>
<?php
/*
Philip Chung
071-790-141
Anthony Austin
March 18th,2016*/

//INCLUDE MY CLASS
require_once('myClasses.php');

//CREATE DATABASE OBJECT WITH CONNECTION TO MY DATABASE
$db = new DBLink("int322_161a27");

if($_GET['id']==1){ //DEFINES OBJECT FOR QUERY
		$result = $db->query("Select * from users");



?>
		<style>
			h1{text-align:center;}
			body{background-color:66FFCC;font-family:tahoma;text-align:center;}
			table{margin:0 auto;}
			
		</style>
		<h1>Query using OOP</h1>
		<body>
			<table border="1">	
			<tr>
			<th>email</th><th>pass</th><th>role</th><th>passH</th>
			<?php

 			while($row = mysqli_fetch_assoc($result))
 			{
			?>
			<tr>
			<td><?php print $row['username']; ?></td>
			<td><?php print $row['password']; ?></td>
			<td><?php print $row['role']; ?></td>
			<td><?php print $row['passwordHint']?></td>
			</tr>
			<?php
 			}
			?>
		</table>
		<a href = "http://zenit.senecac.on.ca:19350/lab6/testDB.php">Go back</a>
		</body>
		

<?php
}else if($_GET['id']==2){//DEFINES OBJECT FOR INSERTION
	
	$sent="";
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$passH = substr($pass,-1);

	
	if($_POST){

//CHECK FOR EMPTY STRING
		$valid = $db->validate($user,$pass);

//PREVENTS EMPTY STRING FROM ENTERING NEXT VALIDATION, CHECK FOR EXISTING USERS/EMAIL TO AVOID DUPLICATE USERS
		if($valid){
			$valid = $db->exists($user);
			
			
		}

//CHECK FOR EMPTY STRING ,INSERT DATA, AND EXISTING USER ACCOUNTS
		if($valid!=true && $pass == ""){
			$sent = "Please fill in all fields!";	
		}
		else if($_POST&&$valid){
			$db->register($user,$pass,$passH);
			$sent = "User has been registered!";
		}
		else{
			$sent = "This user has already been registered!";
		}

	}

	
?>
	<style>
	h1{text-align:center;}
	fieldset{width:400px;margin:0 auto;text-align:left;}
	a:link{text-align:left; text-decoration:none;}
	body{background-color:66FFCC;font-family:tahoma;}
	a:link{border:solid 2px;font-size:16;background:gray;}
	a:hover{background-color:white;}
	</style>
	<body>
	<h1>INSERT using OOP</h1>
		<form method="post" action="">
	
		<fieldset>
		<legend>Insert</legend>
		<p>Fill in all fields! </p>
		<table>
		<tr>
    		<td>Username:</td>
		<td><input name="user" type="email" value=""></td>
		</tr>
		<tr>
    		<td>Password:</td>
		<td><input name="pass" type="password" value=""></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
		<td></td>
		<td><input name="submit" type="submit"></td>
		</tr>
		</table>
		<a href = "http://zenit.senecac.on.ca:19350/lab6/testDB.php?id=1">Check Query</a><br><br>
		<a href = "http://zenit.senecac.on.ca:19350/lab6/testDB.php">Go back</a>
		<p><?php echo $sent;?></p>
		</fieldset>
  	</form>
  	</body>
<?php
}else if($_GET['id']==3){//DEFINES OBJECT FOR MODIFICATIONS
	$sent="";
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$nuser = $_POST['nuser'];
	$npass = $_POST['npass'];
	$nhint = $_POST['nhint'];
	$valid = true;
	$isEmpty=true;
	if($_POST){

		//CHECK EMPTY FIELDS
		$valid = $db->validate($user,$pass);

		if($valid){
			$db->set($user,$pass);
			$isEmpty=$db->emptyResult();
		}
		//Check if no records found is true
		if($isEmpty){
			$sent = "Invalid username or password";
		}
		else{
			$count=$db->update($nuser,$npass,$nhint);
			$sent = $count." change(s) were made in the record";
		}
			
	}

?>
		<style>
		h1{text-align:center;}
		fieldset{width:400px;margin:0 auto;text-align:left;}
		a:link{text-align:left; text-decoration:none;}
		body{background-color:66FFCC;font-family:tahoma;}
		a:link{border:solid 2px;font-size:16;background:gray;}
		a:hover{background-color:white;}
		</style>
		<body>
			<h1>UPDATE using OOP</h1>
			<form method="post" action="">
	
			<fieldset>
			<legend>Update</legend>
			<p>Enter current username and password. </p>
			<table>
			<tr>
	    		<td>Username:</td>
			<td><input name="user" type="email" value=""></td>
			</tr>
			<tr>
	    		<td>Password:</td>
			<td><input name="pass" type="password" value=""></td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
	    		<td>New User:</td>
			<td><input name="nuser" type="email" value=""></td>
			</tr>
			<tr>
    			<td>New Pass:</td>
			<td><input name="npass" type="password" value=""></td>
			</tr>
			<tr>
    			<td>New Hint:</td>
			<td><input name="nhint" type="password" value=""></td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
			<td></td>
			<td><input name="submit" type="submit"></td>
			</tr>
			</table>
			<a href = "http://zenit.senecac.on.ca:19350/lab6/testDB.php?id=1">Check Query</a><br><br>
			<a href = "http://zenit.senecac.on.ca:19350/lab6/testDB.php">Go back</a>
			<p><?php echo $sent;?></p>
			</fieldset>
  	</form>
  	</body>
<?php
}else{
?>


<style>
h1{text-align:center;}
fieldset{width:100px;margin:0 auto;text-align:left;}
a:link{text-align:left; text-decoration:none;}
body{background-color:66FFCC;font-family:tahoma;}
a:link{border:solid 2px;font-size:20;background:gray;}
a:hover{background-color:white;}
</style>
<body>
<h1>Object Oriented Testing</h1>
	<form method="POST" action="">
	
	<fieldset>
	<legend>Test Options</legend>
	<p>Select an option </p>
	<table>
	<tr>
	<td><a href="http://zenit.senecac.on.ca:19350/lab6/testDB.php?id=1">Select</a></td>
    	</tr>
	<tr>
	<td><a href="http://zenit.senecac.on.ca:19350/lab6/testDB.php?id=2">Insert</a></td>
	</tr>
	<tr>
	<td><a href="http://zenit.senecac.on.ca:19350/lab6/testDB.php?id=3">Update</a></td>
	</tr>
	<tr>
	<td><a href="http://zenit.senecac.on.ca:19350/login.php">Login</a></td>
	</tr>
	<tr><td><br></td></tr>
	<tr>
	<td></td>
	</tr>
	</table>
	</fieldset>
  </form>
  </body>
</html>

<?php
}
?>
