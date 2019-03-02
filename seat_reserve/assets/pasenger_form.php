<?php
	session_start();
	include 'header.html' ;
?>

	<body>
		<div class="card" style="position: absolute;width:50%; left:27%; top:15%; box-shadow: 10px 10px;">
		    <img class="card-img-top" src="../images/flight.jpg" alt="Card image" style="width:100%">
		    <div class="card-body">

		    	<?php

		    	if (isset($_POST['submitx'])){

		    		$seats = Array();

		    		$name = $_POST['check_list'];
		    		echo '<form action="action_seat.php" method = "post">';
		    		$count = 0;
					foreach ($name as $color){ 
						$seats[$count] = $color ;
					    $seat_id = $color;
					    $count++;
					    echo "<h1>for seat id -".$color."</h1></br>";
					    echo'
							  passport_ip:<br>
							  <input type="text" name="passport'.$seat_id.'" >
							  <br>
							  price:<br>
							  <input type="text" name="price'.$seat_id.'">
							  <br>
							  age:<br>
							  <input type="text" name= "age'.$seat_id.'">
							  <br>
							   ';
					}

		    	}

		    	$_SESSION['seats'] = $seats;

				?>
				<input type="submit" name="Submit12">
							</form>

		    </div>
		</div>
	</body>
</html>