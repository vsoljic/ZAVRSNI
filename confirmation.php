<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> 
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	

	   <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

	<script src="js/clickable-rows.js"></script>
	<link rel="stylesheet" href="fonts/css/font-icons.css"/>
    <link href="css/style.css" rel="stylesheet">
    <style>
	  .carousel-inner > .item > img,
	  .carousel-inner > .item > a > img {
	      width: 100%;
	      margin: auto;
	  }
  </style>

   <?php
        session_start();
        require_once 'idiorm/idiorm.php';
        ORM::configure('mysql:host=localhost;dbname=aircompany');
        ORM::configure('username','root');
        ORM::configure('password','root'); 
        ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));  

  

	function generateRandomString($length = 6) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	?>
  </head>

<body>
<div class="container">
	<div class="row header">
	<div class="col-md-12">
		<div class="col-md-4">
			<nav class="second-nav-left">
	        	<ul>
		      
	       		</ul>
	      	</nav>
		</div>

		<div class="col-md-8">
			<nav class="second-nav-right">
	        	<ul>
	        	 <li><a href="contact.html">Kontakt</a></li>
		          <li><a href="#">HR|ENG</a></li>
		          <li><p id="onclick"> Ulogiraj se</p></li>
	       		</ul>
	      	</nav>
		</div>
	</div>
	</div>

		<!--Login Form -->
    <div id="logindiv">
        <form action="administration.php" method="post" class="form form-inline" id="login" role="form">
        	<p> Ovom dijelu stranice mogu pristupiti samo admini. </p>
            <label> Username:</label>
            <br/>
            <input type="text" id="username" name="username" placeholder="Example: john123" class="form-control"/>
            <br/> <br/>
            <label> Password: </label>
            <br/>
            <input id="password" name="password" placeholder="************" type="password" class="form-control"/>
            <br/> <br/>
            <input id="loginbtn" type="submit" value="Login" class="btn btn-primary"></input>
            <button id="cancel" type="button" value="Cancel" class="btn btn-primary">Cancel</button>
            <br/>
        </form>
    </div>

	<div class="row header-2">
		<div class="col-md-4 logo">
			<h1><a href="index.php"> AVIOKOMPANIJA </a> </h1>
		</div>

		<div class="col-md-8">
			<nav class="main-nav">
	        	<ul>
		          <li><a href="booking.php">Rezerviraj let</a></li>
		          <li><a href="services.html">Naše usluge</a></li>
	       		</ul>
	      	</nav>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<nav class="booking-nav">
			<li><h3><a href="booking.php">Pretraga letova <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
			<li><h3><a href="chooseFlight.php" class="not-active">Odabir leta <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
			<li><h3><a href="personalDetails.php" class="not-active">Osobni podaci <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
			<li><h3><a href="reservation.php" class="not-active">Rezervacija <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
			<li><h3><a href="confirmation.php" class="not-active">Potvrda</a></h3></li>
		</nav>	
		</div>
	</div>
	<br/>
	
	<div class="row">
		<div class="col-md-12">
			<h1>Uspješno ste rezervirali kartu! <br>
				<?php 
			if(isset($_SESSION['passengerName']) && isset($_SESSION['passengerLastName']) && isset($_SESSION['oib'])
					&& isset($_SESSION['telNo']) && isset($_SESSION['email']) ){

			$dt = date('Y-m-d H:i:s');
			$passengerName = $_SESSION['passengerName'];
			$passengerLastName = $_SESSION['passengerLastName'];
			$oib = $_SESSION['oib'];
			$telNo = $_SESSION['telNo'];
			$email = $_SESSION['email'];

       		$passengers = ORM::for_table('passanger')->find_many();
       		$postoji = false;

       		foreach($passengers as $passenger){

       			if($passenger->oib == $_SESSION['oib']){
       				echo 'Putnik već postoji!!!!';
       				$postoji = true; 

       			} 
       		}

       		if($postoji = false){
       			$passenger = ORM::for_table('passanger')->create();

					$passenger->firstName = $passengerName;
					$passenger->lastName = $passengerLastName;
					$passenger->oib = $oib;
					$passenger->telNo = $telNo;
					$passenger->email = $email;

					$passenger->save();

					echo 'Passenger saved';
       		}

			$passenger = ORM::for_table('passanger')
		       ->raw_query('SELECT * FROM passanger 
		       	WHERE firstName = :passengerName AND oib = :passengerOib', 
		       	array('passengerName' => $passengerName, 'passengerOib' => $oib))
		       ->find_one();

	     	$passengerId = $passenger->id;

	       	$idFlight = substr($_COOKIE['chosenFlight'], 0,1);
	       	$flight_seat = ORM::for_table('flight_seat')
		       ->raw_query('SELECT * FROM flight_seat 
		       	WHERE idFlight = :flightId', 
		       	array('flightId' => $idFlight))
		       ->find_one();

       		$flightSeatId =  $flight_seat->id;
       		# TREBA DODATI U BOOKING I FLIGHTRETURN #
		
			$booking = ORM::for_table('booking')->create();
			$booking->idPassanger = $passengerId;
			$booking->bookingDateTime = $dt;

			$reservationCode= generateRandomString();
			$booking->bookingCode = $reservationCode;
			$booking->idFlightSeat = $flightSeatId;

			$booking->save();

			echo 'BOOKING SAVED';
			
			$lastInsertId = $booking->id();
					
		}

	?>


			</h1> <br>
			<h4>Rezervaciju možete potvrditi na šalteru aerodroma minimalno dva sata prije leta sa sljedećim kodom:</h4>
			<?php 
				$bookingSaved = ORM::for_table('booking')
					->raw_query('SELECT * FROM booking 
						WHERE id = :lastId', 
						array('lastId' => $lastInsertId))
					->find_one();
			 ?>
			<h2><b><?php echo $bookingSaved->bookingCode ?></b></h2>		
			<br><br>
		</div>		
	</div>

	<div class="row ">
		<div class="col-md-12 ">
			<h3>Informacije o letu: 	
			</h3>
		</div>
	</div>

	<div class="row informationFlight">
		<div class="col-md-12">
		<?php 
			$bookedFlight = ORM::for_table('booking')
				->raw_query('SELECT * FROM booking 
					JOIN flight_seat on booking.idFlightSeat = flight_seat.id
					JOIN flight on flight_seat.idFlight = flight.id
				    JOIN seat on flight_seat.idSeat = seat.id
				    JOIN flight_class on seat.idFlightClass = flight_class.id
				    JOIN city as depCity on depCity.id = flight.idDepartureCity
				    JOIN city as arrCity on arrCity.id = flight.idArrivalCity
				    WHERE booking.id = :lastId', array('lastId' => $lastInsertId))
				->find_one();

		?>
		<br>
			<h4>Datum polaska: </h4>		
		</div>		

		<div class="col-md-12">
			<h4><b><?php echo $bookedFlight->city . ' - ' . $bookedFlight->city  ?></b></h4>
			<p><?php echo $bookedFlight->departureTime . ' - ' . $bookedFlight->arrivalTime  ?> </p>
			<h4>Sjedalo: <b><?php echo $bookedFlight->seatNo ?></b> </h4>
			<br/>
		</div>


		<!-- TREBA DODATI U BOOKING I FLIGHTRETURN -->
		<div class="col-md-12">
			<h4>Datum povratka: </h4>		
		</div>		

		<div class="col-md-12">
			<h4><b><?php echo $bookedFlight->city . ' - ' . $bookedFlight->city  ?></b></h4>
			<p><?php echo $bookedFlight->departureTime . ' - ' . $bookedFlight->arrivalTime  ?> </p>
			<h4>Sjedalo: <b><?php echo $bookedFlight->seatNo ?></b> </h4>
			<br>
		</div>
	</div>

	<br><br><br>

<!-- 	<div class="row">
		<div class="col-md-12">
			<p><a href="index.html"> Povratak na početnu stranicu</a></p>
		</div>
	</div> -->

	<div class="row iconsSocialMedia">
		<div class="col-md-12">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<a href="#"><i class="icon-facebook-circled"></i></a>
				<a href="#"><i class="icon-twitter-circled"></i></a>
				<a href="#"><i class="icon-gplus-circled"></i></a>
				<a href="#"><i class="icon-youtube"></i></a>
				<a href="#"><i class="icon-instagram-1"></i></a>
			</div>
		
		</div>	
	</div>

	<div class="row search">
		<div class="col-md-3"></div>
		<div class="col-xs-6">
					<input type="search" id="search" name="search" placeholder="Search" class="form-control">
				</div>	
		<div class="col-xs-3">
					<button type="button" class="btn btn-primary">Traži</button>
				</div>	

	</div>
<br><br>
	<div class="row privileges">
		<div class="col-md-12">
			<h2>Privilegije poslovanja s nama:</h2>
			<br>
		</div>

		<div class="col-md-4">
		<!-- 	<img src="http://placehold.it/350x150"> -->
			<h4><b><i class="icon-info"></i>TRANSPARENCY</b></h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>

		<div class="col-md-4">
		<!-- 	<img src="http://placehold.it/350x150"> -->
			<h4><b><i class="icon-angle-double-right"></i>COLLECT MILES</b></h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>

		<div class="col-md-4">
			<!-- <img src="http://placehold.it/350x150"> -->
			<h4><b><i class="icon-flight-1"></i>ADVENTAGES OF BOOKING ONLINE</b></h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>

	</div>

	<div class="row payment">
				<div class="col-md-12">
			<h2>Opcije plaćanja</h2>
			<br>
		</div>

		<div class="col-md-3">
			<img src="img/mastercard-logo.png">
			<p>Mastercard</p>
		</div>

		<div class="col-md-3">
			<img src="img/visa.gif">
			<p>VISA</p>
		</div>

		<div class="col-md-3">
			<img src="img/paypal.png">
			<p>PayPal</p>
		</div>

		<div class="col-md-3">
			<img src="img/americanex70x70.png">
			<p>American Express</p>
			<br><br>
		</div>



		<div class="col-md-12">
			<h2>O nama</h2>
		</div>

		<div class="col-md-3">
			<p><a href="#">Naša tvrtka</a></p>
			<p><a href="#">Poslovi</a></p>
			<p><a href="contact.html">Kontaktirajte nas</a></p>
		</div>
	</div>



</div>
</body>
</html>