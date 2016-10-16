<?php
$value=$_GET['id'];


$dboject=mysqli_connect("db-mysql.zenit","int322_161a27","@Pc897645","int322_161a27") or die ("could not connect".mysqli_error($dboject));

$sql_query = "update  form set day1='Unchecked',day2='Unchecked' where id = '$value'";
echo $sql_query;

/*$sql_query1 = "SELECT * from form";*/
                //Run our sql query
 $result = mysqli_query($dboject, $sql_query) or die('query failed'. mysqli_error($dboject));


// Get all records now in DB
$sql_query = "SELECT * from form";
//Run our sql query
 $result = mysqli_query($dboject, $sql_query) or die('query failed'. mysqli_error($dboject));

 //iterate through result printing each record
print "<br>Names in DB: <br>";

?>
<html>
<body>
<table border="1">
<tr>
<th>Title</th> <th>FirstName</th> <th> LastName</th> <th> Organization</th> <th>Email</th> <th>Phone</th> <th>Day1</th> <th>Day2</th> <th>Shirt</th><th>Uncheck</th>
<?php
   while($row=mysqli_fetch_assoc($result))
    {
?>
                <tr>
                 <td><?php print $row['title']; ?></td>
                <td><?php print $row['firstName']; ?></td>
                <td><?php print $row['lastName']; ?></td>
               <td><?php print $row['organization']; ?></td>
                <td><?php print $row['email']; ?></td>
                <td><?php print $row['phoneNumber']; ?></td>
                 <td><?php print $row['day1']; ?></td>
                  <td><?php print $row['day2']; ?></td>
                   <td><?php print $row['shirt']; ?></td>
                    <td> <a href="remove.php?id=<?php print $row['id']; ?>"> cancel</a></td>
                </tr>
<?php
     }
?>
