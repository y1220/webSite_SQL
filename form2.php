<html>
	<body>
		<h2>Insert a new VIP</h2>
		<h3>Data of the new VIP</h3>
		<?php
			//Connecting to the server
			$con = mysqli_connect('localhost','root','','hw4');
		?>
		
		<form action="processform2.php" method="GET">
			SSN:<br>
			<input type="text" name="SSN">
			<br><br>
			
			Name:<br>
			<input type="text" name="name">
			<br><br>
			
			Surname:<br>
			<input type="text" name="surname">
			<br><br>
			
			Employment:<br>
			<input type="text" name="employment">
			<br><br>
			
			<input type="submit" value="Send">
			<input type="reset" value="Cancel">
		</form>
		
		<?php mysqli_close($con) ?>
		
	</body>
</html>