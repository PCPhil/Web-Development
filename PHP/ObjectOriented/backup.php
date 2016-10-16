<html>
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
		</body>
		</html>
