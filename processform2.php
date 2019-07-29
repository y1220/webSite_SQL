<html>
	<body>
	
		<?php
			//Connecting to the server
			$con = mysqli_connect('localhost','root','','hw4');
		?>
		
		<?php
			//Calling the needed variables
			$SSN = $_GET["SSN"];
			$name = $_GET["name"];
			$surname = $_GET["surname"];
			$employment = $_GET["employment"];
			
			$msg = "";
			if (empty($SSN) or empty($name) or empty($surname) or empty($employment)) {
				if (empty($SSN)){
					$msg = $msg . "SSN is missing.<br>";
				} 
				if (empty($name)) {
					$msg = $msg . "Name is missing.<br>";
				}
				if (empty($surname)) {
					$msg = $msg . "Surname is missing.<br>";
				}
				if (empty($employment)){
					$msg = $msg . "Employment is missing.<br>";
				}
				echo $msg;
				echo "<br>Failed to insert a new VIP.";
			} else {
				//Query
				$qry = "INSERT INTO VIP VALUES (?,?,?,?)";
				$stmt = mysqli_prepare($con,$qry);
				mysqli_stmt_bind_param($stmt,"ssss",$SSN, $name, $surname, $employment);
				$res = mysqli_stmt_execute($stmt);
				
				//Error checking
				if ($res) {
					echo "Data inserted in the DB";
				} else {
					echo "Error: " . $qry . "<br>" . $con->error;
				}
			}
		?>
		
		<?php mysqli_close($con) ?>
		
		<br><br>
		<form action="form2.php" method="GET">
			<input type="submit" value="New insertion">
		</form>
		
	</body>
</html>