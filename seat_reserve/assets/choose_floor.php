<?php
	session_start();
	include 'header.html' ;
?>
	<body>
		<div class="card" style="position: absolute;width:50%; left:27%; top:15%; box-shadow: 10px 10px;">
		    <img class="card-img-top" src="../images/flight.jpg" alt="Card image" style="width:100%">
		    <div class="card-body">

				<?php
					if(isset($_POST['aircrafts']) && isset($_POST['airways']) && isset($_POST['submit'])){
						$con=mysqli_connect("sql12.freemysqlhosting.net", "sql12264526", "8vVyVPKDVA", "sql12264526");
						$plane = $_POST['aircrafts'];
						$airway = $_POST['airways'];
						
						
						$planeidsql = "select aircraft_id  from aircraft join airway on aircraft.airway_id = airway.airway_id where name = '$plane' and awname = '$airway'";

						$plane_ids=mysqli_query($con,$planeidsql);
						$row_plane = mysqli_fetch_all($plane_ids);
						$plane_id = $row_plane[0][0];

						$date = $_SESSION['$date']  ; 
						$time = $_SESSION['$time'] ;

						$_SESSION['$plane_id'] = $plane_id;
						$route_id = $_SESSION['route_id'];
						$flight_id_sql = "select flight_id from flight where route_id = '$route_id' and date = '$date' and time = '$time' and aircraft_id = '$plane_id'" ;
						$f=mysqli_query($con,$flight_id_sql);
						$row_fid = mysqli_fetch_all($f);
						$flight_id = $row_fid[0][0];

						$_SESSION['$flight_id'] = $flight_id;

						$floor_sql = "select seat_floors from aircraft where name = '$plane' ";
						
						$floors=mysqli_query($con,$floor_sql);
						$row_floor = mysqli_fetch_all($floors);
						$floorss = $row_floor[0][0];

						echo "<form action='choose_seat.php' method = 'POST'>
						<select name = 'floor' >";
						
						
						for ($x = 1; $x<$floorss+1; $x++){
							echo '<option value='.$x.'>'.$x.'</option>';
						}
					}

				?>

				</select>
				<input type="submit" name = 'floor_number'>

				</form>


		    </div>
		</div>
	</body>
</html>