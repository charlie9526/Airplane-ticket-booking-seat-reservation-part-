<?php
	session_start();
	include 'header.html' ;
?>
	<body>
		<div class="card" style="position: absolute;width:50%; left:27%; top:15%; box-shadow: 10px 10px;">
		    <img class="card-img-top" src="../images/flight.jpg" alt="Card image" style="width:100%">
		    <div class="card-body">

		    	<table>
				  <tr>
				    <td align="center">row number</td>
				    <td align="center">seat number</td>
				    <td align="center">class</td>
				    <td align="center">description</td>

				  </tr>
				  <?php
				  	$floor = $_POST['floor'];
		    		$_SESSION['floor'] = $floor;
				  $con=mysqli_connect("sql12.freemysqlhosting.net", "sql12264526", "8vVyVPKDVA", "sql12264526");
				  $pid = $_SESSION['$plane_id'];
				  $u = "select *  from seat where aircraft_id = '$pid' and  seat_id not in (select seat_id from seat_reservation where aircraft_id = '$pid');";

				  $flight_id = $_SESSION['$flight_id'];

				  $seats = "select seat_id  from seat where aircraft_id = '$pid' and  seat_id not in (select seat_id from seat_reservation where aircraft_id = '$pid' and flight_id = '$flight_id');";
			  	$result_seat=mysqli_query($con,$seats);
				$row_seat = mysqli_fetch_all($result_seat);
				$seats = Array();
				for ($x = 0; $x<sizeof($row_seat); $x++){
					$seats[$x] = $row_seat[$x][0];
				}
				  $records = mysqli_query($con,$u);

				  
				     while ($course = mysqli_fetch_assoc($records)){

				           echo "<tr>";
				           	echo "<td>".$course['seat_id']."</td>";
				               echo "<td>".$course['row_num']."</td>";
				               echo "<td>".$course['seat_num']."</td>";
				               echo "<td>".$course['class']."</td>";
				               echo "<td>".$course['description']."</td>";
				           echo "</tr>";

				     }
				     echo "</table>";

				    echo '<form action="pasenger_form.php" method="POST" name = "form2">';
				    for ($x = 0; $x<sizeof($row_seat); $x++){
						echo '<input type="checkbox" name="check_list[]" value='.$seats[$x].'><label>'.$seats[$x].'</label><br/>';
					}
					echo '<input type="submit" name="submitx" value="Submit"/></form>';

				?>
				



		    </div>
		</div>
	</body>
</html>