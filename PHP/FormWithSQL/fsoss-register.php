
<html>
  <head>
    <title>FSOSS Registration</title>
  </head>
  <body>
	<?php
	$firstNameErr = "";
	$lastNameErr = "";
	$orgErr = "";
	$emailErr = "";
	$phoneErr = "";
	$daysErr = "";
	$shirtErr = "";
	$dataValid = true;
	if ($_POST) { 
        // Test for nothing entered in field
	if ($_POST['firstName'] == "") {
		$firstNameErr = "Error - you must fill in a first name";
		$dataValid = false;
	}
	if ($_POST['lastName'] == "") {
		$lastNameErr = "Error - you must fill in a last name";
		$dataValid = false;		
	}
	if ($_POST['organization'] == "") {
		$orgErr = "Error - you must fill in a organization name";
		$dataValid = false;
	}
	if ($_POST['email'] == "") {
		$emailErr = "Error - you must fill in a email name";
		$dataValid = false;
	}
	if ($_POST['phone'] == "") {
		$phoneErr = "Error - you must fill in a phone number";
		$dataValid = false;
	}
	if (empty($_POST['monday']) &&  empty($_POST['tuesday'])){
		$daysErr = " Error - you must select atleast one day";
		$dataValid = false;
	}
	if($_POST['t-shirt'] == "--Please choose--"){
		$shirtErr = "Error - you must select a size";
		$dataValid = false;
	}
}
	$title = $_POST['title'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$organization = $_POST['organization'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$day1 = $_POST['monday'];
	$day2 = $_POST['tuesday'];
	$shirt = $_POST['t-shirt'];
	
	if($_POST && $dataValid){
		/*echo "Title: $title <br>";
		echo "FirstName: $firstName <br>";
		echo "LastName: $lastName <br>";
		echo "Organization $organization <br>";
		echo "Email: $email <br>";
		echo "Phone: $phone <br>";
		echo "Days attending: ";
		echo $day1;
		if($day1!=''&&$day2!=''){
		echo ',';
		}
		echo $day2;
		echo '<br>';*/

		//Connect to the mysql server and get back our link_identifier
 		$lines = file('/home/int322_161a27/secret/topsecret.txt');
		$dbserver = trim($lines[0]);
		$uid = trim($lines[1]);
		$pw = trim($lines[2]);
		$dbname = trim($lines[3]);
		
		
		
		$this->link = mysqli_connect($dbserver,$uid,$pw,$dbname) or die("Failed");
		
		$sql_query = 'INSERT INTO form set title="' . $title . '", firstName="' . $firstName . '", lastName="' . $lastName . '", organization="' . $organization . '", email="' . $email . '", phone="' . $phone . '", day1="' . $day1 . '", day2="' . $day2 . '", shirt="' . $shirt . '"';
		$result = mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));
		$sql_query = "SELECT * from form";
		$result = mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));
		$sql_update = "UPDATE form SET day1='Unchecked',day2='Unchecked' WHERE day1='monday' AND day2='tuesday'";
		

	?>
	<html>
		<body>
			<table border="1">	
			<tr>
			<th>Title</th><th>First Name</th><th>Last Name</th><th>Organization</th><th>Email</th><th>Phone</th><th>Day1</th><th>Day2</th><th>T-shirt</th><th>Uncheck</th>
			<?php

 			while($row = mysqli_fetch_assoc($result))
 			{
			?>
			<tr>
			<td><?php print $row['title']; ?></td>
			<td><?php print $row['firstName']; ?></td>
			<td><?php print $row['lastName']; ?></td>
			<td><?php print $row['organization']; ?></td>
			<td><?php print $row['email']; ?></td>
			<td><?php print $row['phone']; ?></td>
			<td><?php print $row['day1']; ?></td>
			<td><?php print $row['day2']; ?></td>
			<td><?php print $row['shirt']; ?></td>
			<td><a href="remove.php?id=<?php print $row['id'];?>">Cancel</a></td>
			</tr>


		<?php
 		}

		?>
		</table>
		</body>
		</html>
		<?php
 
		// Free resultset (optional)
		mysqli_free_result($result);
  
		//Close the MySQL Link
 		mysqli_close($link);
		// print "Name entered: " . $_POST['firstName'] . ' ' . $_POST['lastName'];
		}
	else{
	?>
	<h1>FSOSS Registration</h1>
		<form method="post" action="">
	<table>
	<tr>
    	<td valign="top">Title:</td>
	<td>
		<table>
		<tr>
		<td><input type="radio" name="title" value="mr" <?php if ($_POST['title'] == "mr") echo "CHECKED";?>>Mr</td>
		</tr>
		<tr>
		<td><input type="radio" name="title" value="mrs" <?php if ($_POST['title'] == "mrs") echo "CHECKED";?>>Mrs</td>
		</tr>
		<tr>
		<td><input type="radio" name="title" value="ms"<?php if ($_POST['title'] == "ms") echo "CHECKED";?>>Ms</td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
    	<td>First name:</td>
	<td><input name="firstName" type="text" value="<?php if ($_POST['firstName']) echo $_POST['firstName']; ?>"><?php echo $firstNameErr;?></td>
	</tr>
	<tr>
    	<td>Last name:</td>
	<td><input name="lastName" type="text" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>"><?php echo $lastNameErr;?></td>
	</tr>
	<tr>
    	<td>Organization:</td>
	<td><input name="organization" type="text" value="<?php if(isset($_POST['organization'])) echo $_POST['organization']; ?>"><?php echo $orgErr;?></td>
	</tr>
	<tr>
    	<td>Email address:</td>
	<td><input name="email" type="text" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"><?php echo $emailErr;?></td>
	</tr>
	<tr>
    	<td>Phone number:</td>
	<td><input name="phone" type="text" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>"><?php echo $phoneErr;?></td>
	</tr>
	<tr>
    	<td>Days attending:</td>
	<td>
		<input name="monday" type="checkbox" value="monday"<?php if ($_POST['monday']) echo "CHECKED"; ?>>Monday
		<input name="tuesday" type="checkbox" value="tuesday"<?php if ($_POST['tuesday']) echo "CHECKED"; ?>>Tuesday<?php echo $daysErr?><td/>
	</tr>
	<tr>
	<td>T-shirt size:</td>
	<td>
	<select name="t-shirt">
	<option>--Please choose--</option>
	<option name="small" value="s"<?php if ($_POST['t-shirt']=="s") echo "SELECTED"; ?>>Small</option>
	<option value="m"<?php if ($_POST['t-shirt']=="m") echo "SELECTED"; ?>>Medium</option>
	<option value="l"<?php if ($_POST['t-shirt']=="l") echo "SELECTED"; ?>>Large</option>
	<option value="xl"<?php if ($_POST['t-shirt']=="xl") echo "SELECTED"; ?>>X-Large</option>
	</select><?php echo $shirtErr?>
	</td>
	</tr>
	<tr><td><br></td></tr>
	<tr>
	<td></td>
	<td><input name="submit" type="submit"></td>
	</tr>
  </form>
  <?php
	}
	?>
	
  
  </body>
</html>

