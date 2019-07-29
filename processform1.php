<html>
	<body>
		
		<?php
			$surname = $_GET["VIPsurname"]."%";
			$broadcaster = $_GET["broadcaster"];
			
			echo "<h1>TV appearances of VIPs</h1><br>";
			
			//Connecting to the server and submiting the query
			$con = mysqli_connect('localhost','root','','hw4');
			$sql = "SELECT AP.CodC as ChannelCode, AP.Date, AP.StartTime, VIP.Surname, VIP.Name FROM VIP INNER JOIN APPEARANCE AP ON VIP.SSN = AP.SSN INNER JOIN TV_CHANNEL TVC ON TVC.CodC = AP.CodC WHERE VIP.Surname LIKE ? and TVC.Broadcaster = ? ORDER BY TVC.CodC DESC, AP.Date DESC, AP.StartTime DESC";
			$stmt = mysqli_prepare($con,$sql);
			mysqli_stmt_bind_param($stmt,"ss",$surname,$broadcaster);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			
			$sql2 = "SELECT AP.CodC as ChannelCode, AP.Date, AP.StartTime, VIP.Surname, VIP.Name FROM VIP INNER JOIN APPEARANCE AP ON VIP.SSN = AP.SSN INNER JOIN TV_CHANNEL TVC ON TVC.CodC = AP.CodC WHERE VIP.Surname LIKE ? and TVC.Broadcaster = ? ORDER BY TVC.CodC DESC, AP.Date DESC, AP.StartTime DESC";
			$stmt2 = mysqli_prepare($con,$sql2);
			mysqli_stmt_bind_param($stmt2,"ss",$surname,$broadcaster);
			mysqli_stmt_execute($stmt2);
			$result2 = mysqli_stmt_get_result($stmt2);
			$row2 = mysqli_fetch_row($result2);
			
			if (empty($row2[0])==FALSE) {
				//Building the structure of the table
				echo "<table border=1>";
				echo "<tr>";
				
				// Buiding the very first row with the name of the columns
				for($i=0;$i<mysqli_num_fields($result);$i++)
				{
					$col = mysqli_fetch_field($result);
					$name = $col->name;
					echo "<th>" . $name . "</th>";
				}
				echo "</tr>";
				
				//Building the following rows with the gathered information
				
				while($row = mysqli_fetch_assoc($result))
				{
					echo "<tr>";
					foreach($row as $key=>$value)
					{
						echo "<td>" . $value . "</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			} else {
				echo "The database has brought no results";
			}
		?>
		<br>
	</body>
</html>