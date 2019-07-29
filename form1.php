<html>
	<body>
		<h1>Search VIP</h1>
		<?php
			//Connecting to the server
			$con = mysqli_connect('localhost','root','','hw4');
			
			//Query
			$qry = "SELECT DISTINCT Broadcaster FROM TV_CHANNEL";
			$result = mysqli_query($con,$qry);
		?>
		
		<form action="processform1.php" method="GET">
			First three letters of VIP surname:
			<input type="text" name="VIPsurname">
			<br><br>
			
			Broadcaster:
			<select name="broadcaster">
			<?php
			while ($row = mysqli_fetch_assoc($result))
			{
				echo "<option value=".$row['Broadcaster'].">" . $row['Broadcaster'] ."</option>";
			}
			?>
			</select>
			<br><br>
			<input type="reset" value="Cancel">
			<input type="submit" value="Send">
		</form>
		
		<?php mysqli_close($con) ?>
		
	</body>
</html>