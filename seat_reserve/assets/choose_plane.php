<?php
	session_start();
	include 'header.html' ;
?>

	<body>
		<div class="card" style="position: absolute;width:50%; left:27%; top:15%; box-shadow: 10px 10px;">
		    <img class="card-img-top" src="../images/flight.jpg" alt="Card image" style="width:100%">
		    <div class="card-body">
		    	<?php

		    		$con=mysqli_connect("sql12.freemysqlhosting.net", "sql12264526", "8vVyVPKDVA", "sql12264526");
					if (isset($_POST['submit2'])){
						$time = $_POST['times'];
						$origin_id = $_SESSION['origin'];
						$destination_id = $_SESSION['destination'];
						$date = $_SESSION['$date']  ; 
 						$_SESSION['$time'] = $time ;
 						 
 						
					}
					$sql = "select distinct name from flight join route join aircraft on flight.route_id = route.route_id and flight.aircraft_id =  aircraft.aircraft_id where origin_id = '$origin_id' and destination_id = '$destination_id' and date = '$date' and time = '$time'";
					$awnamesql = "select distinct awname from flight join route join aircraft join airway on flight.route_id = route.route_id and flight.aircraft_id =  aircraft.aircraft_id and aircraft.airway_id = airway.airway_id where origin_id = '$origin_id' and destination_id = '$destination_id' and date = '$date' and time = '$time'";






					$result=mysqli_query($con,$sql);
					$resultaw=mysqli_query($con,$awnamesql);
					$row = mysqli_fetch_all($result);
					$rowaw = mysqli_fetch_all($resultaw);
					$aircrafts = Array();
					$airways = Array();

					for ($x = 0; $x<sizeof($rowaw); $x++){
						$airways[$x] = $rowaw[$x][0];
					}

					for ($x = 0; $x<sizeof($row); $x++){
						$aircrafts[$x] = $row[$x][0];
					}
					echo '<form action="choose_floor.php" method="POST" name = "form1">' ;
					echo '<select name="airways" size="1"  onchange="search_airway()">
					<option value="">Select airway:</option>';
					for ($x = 0; $x<sizeof($rowaw); $x++){
						echo '<option value='.$airways[$x].'>'.$airways[$x].'</option>';
					}
					echo"</select></br>";


					echo '<select name="aircrafts" size="1"  onchange="search_plane()">
					<option value="">Select plane:</option>';
					for ($x = 0; $x<sizeof($row); $x++){
						echo '<option value='.$aircrafts[$x].'>'.$aircrafts[$x].'</option>';
					}
					echo"</select></br>";

				?>
				<input type="submit" value="Submit" name = "submit">
			</form>
		    </div>
		</div>
	</body>
</html>