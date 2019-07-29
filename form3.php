<html>
	<body>
		<h2>Insert a new VIP appearace</h2>
		<h3>Data of the new VIP appearance</h3>
		<?php
			//Connecting to the server
			$con = mysqli_connect('localhost','root','','hw4');
			//SQL 1
			$qry1 = "SELECT SSN, NAME, SURNAME FROM VIP";
			$result1 = mysqli_query($con,$qry1);
			//SQL 2
			$qry2 = "SELECT CODC, NAME FROM TV_CHANNEL";
			$result2 = mysqli_query($con,$qry2);
		?>
		
		<form action="processform3.php" method="GET">
			VIP:<br>
			<select name="VIP">
				<?php
					while($row1 = mysqli_fetch_row($result1)){
						echo "<option value=" . $row1[0] . ">" . $row1[1] . " " . $row1[2] . "</option>";
					}
				?>
			</select>
			<br><br>
			
			Channel:<br>
			<select name="channel">
				<?php
					while($row2 = mysqli_fetch_row($result2)){
						echo "<option value=" . $row2[0] . ">" . $row2[1] . "</option>";
					}
				?>
			</select>
			<br><br>
			
			Date:<br>
			<input type="text" name="date">
			<br><br>
			
			Start time:<br>
			<input type="text" name="starttime">
			<br><br>
			
			End time:<br>
			<input type="text" name="endtime">
			<br><br><br>
			
			<input type="submit" value="Send">
			<input type="reset" value="Cancel">
		</form>
		
		<?php mysqli_close($con) ?>
		
	</body>
</html>