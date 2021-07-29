<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<style>
		table{
			border: 1px solid black;
		}
		td{
			padding: 20px;
			border: 1px solid black;
		}
		.bgcolor{
			background-color: #000;
		}
	</style>
</head>
<body>
	<form method="POST">
		<input type="number" name="cb">
		<input type="submit" name="submit" value="Enter your value" required>
	</form>	<br>
	<table>
		<?php
			if (isset($_POST['submit'])) {
				$data = $_POST['cb'];

				for($row=1; $row<=$data; $row++) { 
					echo "<tr>";
						for($col=1; $col<=$data; $col++) { 
							if (($row + $col)% 2 == 0) {
								echo "<td class='bgcolor'></td>";
							}else{
								echo "<td> </td>";
							}
						}
					echo "</tr>";
				}
			}
		 ?>
	</table>
</body>
</html>