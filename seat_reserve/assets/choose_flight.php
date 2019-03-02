<?php
	session_start();
	include 'header.html' ;
?>

<body>
	<div class="card" style="position: absolute;width:50%; left:27%; top:15%; box-shadow: 10px 10px;">
	    <img class="card-img-top" src="../images/flight.jpg" alt="Card image" style="width:100%">
	    <div class="card-body">
	    	
		    	<h3>available flights</h3>
				<?php
					$con=mysqli_connect("sql12.freemysqlhosting.net", "sql12264526", "8vVyVPKDVA", "sql12264526");
					if (isset($_POST['submit1'])){
						$destination = $_POST['destination'];
						$start = $_POST['origin'];
 						$date = date("Y-m-d", strtotime($_POST['date']));
 						$_SESSION['$date'] = $date ; 

					}
					$sqld = "select airport_code from airport where name = '$destination'";
					$resultd=mysqli_query($con,$sqld);
					$rowd = mysqli_fetch_all($resultd);
					$destination_id = $rowd[0][0];
					$sqls = "select airport_code from airport where name = '$start'";
					$results=mysqli_query($con,$sqls);
					$rows = mysqli_fetch_all($results);
					$origin_id = $rows[0][0];

					$sqlr = "select route_id from route where  destination_id= '$destination_id' and origin_id = '$origin_id'";
					$resultr=mysqli_query($con,$sqlr);
					$rowr = mysqli_fetch_all($resultr);
					
							$route_id = $rowr[0][0];

							$_SESSION['destination'] = $destination_id;
							$_SESSION['origin'] = $origin_id;
							$_SESSION['route_id'] = $route_id;



							$sqlf = "select distinct time from flight join route join aircraft on flight.route_id = route.route_id and flight.aircraft_id =  aircraft.aircraft_id where origin_id = '$origin_id' and destination_id = '$destination_id' and date = '$date'";
							$result=mysqli_query($con,$sqlf);
							$row = mysqli_fetch_all($result);
							$time = Array();
							for ($x = 0; $x<sizeof($row); $x++){
								$time[$x] = $row[$x][0];
							}
							echo '<form action="choose_plane.php" method="POST" name = "form1">' ;
							echo '<select name="times" size="1"  onchange="search_seat()">
							<option value="">Select time:</option>';
							for ($x = 0; $x<sizeof($row); $x++){
								echo '<option value='.$time[$x].'>'.$time[$x].'</option>';
							}
							echo"</select></br>";

				?>
				<input type="submit" value="Submit" name = "submit2">
			</form>

			<p id="firstP">&nbsp;</p>

			 <script >

			    function search_seat(){
			    	var time = form1.times;
			    	var firstP = document.getElementById('firstP');
			    	if (time[time.selectedIndex].value == ""){

			    	}
			    	else{
			    	firstP.innerHTML = ('Its value is: ' + time[time.selectedIndex].value);
			    	}
			    }

			</script>
	 </div>
</body>
