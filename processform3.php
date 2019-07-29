<html>
	<body>
	
		<?php
			//Connecting to the server
			$con = mysqli_connect('localhost','root','','hw4');
		?>
		
		<?php
			//Calling the needed variables
			$VIP = $_GET["VIP"];
			$date = $_GET["date"];
			$starttime = $_GET["starttime"];
			$endtime = $_GET["endtime"];
			$channel = $_GET["channel"];
			
			//Check for the same SSN and Date if any overlap can happen
			$qrychk = "SELECT StartTime, EndTime FROM APPEARANCE WHERE SSN = ? and Date = ? and StartTime < ? and EndTime > ?";
			$stmtchk = mysqli_prepare($con,$qrychk);
			mysqli_stmt_bind_param($stmtchk,"ssss",$VIP,$date,$endtime,$starttime);
			mysqli_stmt_execute($stmtchk);
			$resultchk = mysqli_stmt_get_result($stmtchk);
			$rowchk = mysqli_fetch_row($resultchk);	
			
			$msg = "";
			if (empty($VIP) or empty($date) or empty($starttime) or empty($endtime) or empty($channel)) {
				
				if (empty($VIP)){
					$msg = $msg . "VIP is missing.<br>";
				} 
				if (empty($date)) {
					$msg = $msg . "Date is missing.<br>";
				}
				if (empty($starttime)) {
					$msg = $msg . "Start time is missing.<br>";
				}
				if (empty($endtime)){
					$msg = $msg . "End time is missing.<br>";
				}
				if (empty($channel)){
					$msg = $msg . "Channel is missing.<br>";
				}
				echo "<h3 style='background-color:Tomato;color:White;'>Failed insertion</h3>";
				echo $msg;
			} else {
				if(is_null($rowchk[0])){
					//Inserting the data in the table
					$qry = "INSERT INTO APPEARANCE VALUES (?,?,?,?,?)";
					$stmt = mysqli_prepare($con,$qry);
					mysqli_stmt_bind_param($stmt,"sssss",$VIP, $date, $starttime, $endtime, $channel);
					$res = mysqli_stmt_execute($stmt);
					
					//Error checking
					if ($res) {
						echo "<h3 style='background-color:MediumSeaGreen;color:White;'>Successful insertion</h3>";
						echo "Data correctly inserted in the database.<br>";
					} else {
						echo "Error: " . $qry . "<br>" . $con->error;
					}
				} else {
					echo "<h3 style='background-color:Tomato;color:White;'>Failed insertion</h3>";
					echo "It's not allowed to insert two overlapped appearances for the same VIP.<br>";
				}
			}
			

		?>
		
		<?php mysqli_close($con) ?>
		
		<br>
		<form action="form3.php" method="GET">
			<input type="submit" value="New insertion">
		</form>
		
	</body>
</html>