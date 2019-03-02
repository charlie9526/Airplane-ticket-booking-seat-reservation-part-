<?php
	session_start();
	include 'assets/header.html' ;
?>

<body>
	<div class="card" style="position: absolute;width:50%; left:27%; top:15%; box-shadow: 10px 10px;">
	    <img class="card-img-top" src="images/flight.jpg" alt="Card image" style="width:100%">
	    <div class="card-body">
	    	<form action="assets/choose_flight.php" method="post">
		    	<h4 class="card-title" >Seat reservation</h4>
		    	<label for="start">Flight date:</label>
		    	<input type="date" id="start" name="date"
				       min="2018-01-01" max="2018-12-31" /><br/>

				Start location:<br>
				<?php
					$con=mysqli_connect("sql12.freemysqlhosting.net", "sql12264526", "8vVyVPKDVA", "sql12264526");

					$sql="select name from airport where airport_code in (select distinct origin_id from flight left join route on flight.route_id = route.route_id)" ;
					$result=mysqli_query($con,$sql);
					$row = mysqli_fetch_all($result);
					$start = Array();
					for ($x = 0; $x<sizeof($row); $x++){
						$start[$x] = $row[$x][0];
					}
					
					echo '<select name="origin" size="1">';
					for ($x = 0; $x<sizeof($row); $x++){
						echo '<option value='.$start[$x].'>'.$start[$x].'</option>';
					}
					echo"</select></br>";
				?>

  				End location:<br>
  				<?php

					$sql2="select name from airport where airport_code in (select distinct destination_id from flight left join route on flight.route_id = route.route_id)" ;
					$result2=mysqli_query($con,$sql2);
					$row2 = mysqli_fetch_all($result2);
					$desti = Array();
					for ($x = 0; $x<sizeof($row2); $x++){
						$desti[$x] = $row2[$x][0];
					}
					
					echo '<select name="destination" size="1">';
					for ($x = 0; $x<sizeof($row2); $x++){
						echo '<option value='.$desti[$x].'>'.$desti[$x].'</option>';
					}
					echo"</select></br>";
				?>

				<input type="submit" value="Submit1" name = "submit1">

	  		</form>

	    </div>
	 </div>
</body>
</html>