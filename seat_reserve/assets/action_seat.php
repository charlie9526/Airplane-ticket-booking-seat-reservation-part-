<?php
	session_start();
	include 'header.html' ;
?>

	<body>
		<div class="card" style="position: absolute;width:50%; left:27%; top:15%; box-shadow: 10px 10px;">
		    <img class="card-img-top" src="../images/flight.jpg" alt="Card image" style="width:100%">
		    <div class="card-body">
		    	<?php

		    	if(isset($_POST['Submit12'])){
		    		$flight_id = $_SESSION['$flight_id'];
		    		$aircraft_id = $_SESSION['$plane_id'];
		    		$seats = $_SESSION['seats'];
		    		for ($x = 0; $x<sizeof($seats); $x++){
		    			$p = $seats[$x];
		    			$age = $_POST["age".$p];
		    			$price = $_POST["price".$p];
		    			
		    			$passport = $_POST["passport".$p];

		    			$con=mysqli_connect("sql12.freemysqlhosting.net", "sql12264526", "8vVyVPKDVA", "sql12264526");
		    			$sql = "call add_passenger('{$passport}','{$price}','{$aircraft_id}','{$flight_id}','{$p}')";
		    			$resultd=mysqli_query($con,$sql);

		    			
						$rowd = mysqli_fetch_all($resultd);
						$error = $rowd[0][0];
						echo $error." in ".$p." id ";}


		    		
		    	}
		    	?>

			</div>
		</div>
	</body>
</html>

