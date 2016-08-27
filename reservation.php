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
	<script src="js/javascript.js"></script>
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
	?>
  </head>

<body>
<div class="container">
	<div class="row header">
	<div class="col-md-12">
		<div class="col-md-4">
			<nav class="second-nav-left">
	        	
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
			<li><h3><a href="chooseFlight.php">Odabir leta <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
			<li><h3><a href="personalDetails.php">Osobni podaci <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
			<li><h3><a href="reservation.php">Rezervacija <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
			<li><h3><a href="confirmation.php" class="not-active">Potvrda</a></h3></li>
		</nav>	
		</div>
	</div>
	<br/>
	
	<div class="row">
		<div class="col-md-12">

		<?php 
				if(isset($_POST['departureCity']))
				{
				    echo $_POST['departureCity']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["departureCity"] = $_POST['departureCity'];
				    echo $_SESSION["departureCity"]." stored in session <br />";;
				}
				else {
				    echo 'No, form submitted. Your old stored username was '.$_SESSION["departureCity"];
				};

				if(isset($_POST['arrivalCity']))
				{
				    echo $_POST['arrivalCity']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["arrivalCity"] = $_POST['arrivalCity'];
				    echo $_SESSION["arrivalCity"]." stored in session <br />";;
				}
				else {
				    echo 'No, form submitted. Your old stored username was '.$_SESSION["arrivalCity"];
				};

				if(isset($_POST['outGoingFlight']))
				{
				    echo $_POST['outGoingFlight']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["outGoingFlight"] = $_POST['outGoingFlight'];
				    echo $_SESSION["outGoingFlight"]." stored in session <br />";;
				}
				else {
				    echo 'No, form submitted. Your old stored outGoingFlight was '.$_SESSION["outGoingFlight"];
				};

				if(isset($_POST['returnFlight']))
				{
				    echo $_POST['returnFlight']." returnFlight found in form <br />";
				    // Set session variables
				    $_SESSION["returnFlight"] = $_POST['returnFlight'];
				    echo $_SESSION["returnFlight"]." stored in session <br />";;
				}
				else {
				    echo 'No, form submitted. Your old stored returnFlight was '.$_SESSION["returnFlight"];
				};

				if(isset($_POST['passengerName']))
				{
				    echo $_POST['passengerName']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["passengerName"] = $_POST['passengerName'];
				    echo $_SESSION["passengerName"]." stored in session <br />";;
				}
				else {
				    echo 'No, form submitted. Your old stored username was '.$_SESSION["passengerName"];
				};
				
					if(isset($_POST['passengerLastName']))
				{
				    echo $_POST['passengerLastName']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["passengerLastName"] = $_POST['passengerLastName'];
				    echo $_SESSION["passengerLastName"]." stored in session <br />";;
				}
				else {
				    echo 'No, form submitted. Your old stored username was '.$_SESSION["passengerLastName"];
				};

					if(isset($_POST['oib']))
				{
				    echo $_POST['oib']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["oib"] = $_POST['oib'];
				    echo $_SESSION["oib"]." stored in session <br />";;
				}
				else {
				    echo 'No, form submitted. Your old stored username was '.$_SESSION["oib"];
				};

					if(isset($_POST['telNo']))
				{
				    echo $_POST['telNo']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["telNo"] = $_POST['telNo'];
				    echo $_SESSION["telNo"]." stored in session <br />";;
				}
				else {
				    echo 'No, form submitted. Your old stored username was '.$_SESSION["telNo"];
				};

					if(isset($_POST['email']))
				{
				    echo $_POST['email']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["email"] = $_POST['email'];
				    echo $_SESSION["email"]." stored in session <br />";;
				}
				else {
				    echo 'No, form submitted. Your old stored username was '.$_SESSION["email"];
				};

		     ?>

			<h2>Datum polaska: </h2>		
		</div>		

		<div class="col-md-12">
				<?php 
					$idFlight = substr($_COOKIE['chosenFlight'], 0,1);
					$price = substr($_COOKIE['chosenFlight'], 2);
					

					if(strlen($idFlight)){
						
						$chosenFlight = ORM::for_table('flight')
						->raw_query('SELECT * FROM flight f 
							JOIN city depCity ON depCity.id = f.idDepartureCity
							JOIN city arrCity ON arrCity.id = f.idArrivalCity
							JOIN flight_seat ON f.id = flight_seat.idFlight
							JOIN seat ON flight_seat.idSeat = seat.id 
							JOIN flight_class ON seat.idFlightClass = flight_class.id
							WHERE f.id = :flightId', array('flightId' => $idFlight))->find_one();

						}

					if(strlen($price) > 0){
						
						if($chosenFlight->priceEconomy == $price){
							$chosenPrice = $price;
							
						}
						else if($chosenFlight->priceBusiness == $price){
							$chosenPrice = $price;
							
						}
					}
				 ?>
			<h3><b><?php echo $depCity->city ?> - <?php echo $arrCity->city ?></b></h3>
			<p><?php echo $chosenFlight->departureTime . ' - ' . $chosenFlight->arrivalTime ?></p>
			<p>Klasa: <?php echo strtoupper($chosenFlight->className) ?></p>
			<h4>CIJENA: <?php echo $chosenPrice .' kn ' ?></h4>
		</div>

		<div class="col-md-12">
		<br><br>
			<h2>Datum povratka: </h2>		
		</div>		

		<div class="col-md-12">
			<?php 
					$idFlight = substr($_COOKIE['chosenFlightReturn'], 0,1);
					$price = substr($_COOKIE['chosenFlightReturn'], 2);
					

					if(strlen($idFlight)){
						
						$chosenFlightReturn = ORM::for_table('flight')
						->raw_query('SELECT * FROM flight f 
							JOIN city depCity ON depCity.id = f.idDepartureCity
							JOIN city arrCity ON arrCity.id = f.idArrivalCity
							JOIN flight_seat ON f.id = flight_seat.idFlight
							JOIN seat ON flight_seat.idSeat = seat.id 
							JOIN flight_class ON seat.idFlightClass = flight_class.id
							WHERE f.id = :flightId', array('flightId' => $idFlight))->find_one();

						}

					if(strlen($price) > 0){
						
						if($chosenFlightReturn->priceEconomy == $price){
							$chosenPriceReturn = $price;
							
						}
						else if($chosenFlightReturn->priceBusiness == $price){
							$chosenPriceReturn = $price;
							
						}
					}
				 ?>

				<h3><b><?php echo $depCity->city ?> - <?php echo $arrCity->city ?></b></h3>
			<p><?php echo $chosenFlightReturn->departureTime . ' - ' . $chosenFlightReturn->arrivalTime ?></p>
			<p>Klasa: <?php echo strtoupper($chosenFlightReturn->className) ?></p>
			<h4>CIJENA: <?php echo $chosenPriceReturn .' kn ' ?></h4>
		</div>
		
		<div class="col-md-12">
		<br>
			<h2>UKUPNO: 770.00 kn </h2>
			<br>
		</div>
	
		
		<div class="col-md-12">
			<hr style="margin-bottom:5px !important; margin-top:5px !important; border-top: 3px solid #ccc !important;">
			<br>
			<h2>Osobni i kontakt podaci: </h2>		
		</div>

		<div class="col-md-12">
			<p>Ime:</p>
			<h4><?php echo $_SESSION['passengerName'] ?></h4>

			<p>Prezime:</p>
			<h4><?php echo $_SESSION['passengerLastName'] ?></h4>

			<p>OIB:</p>
			<h4><?php echo $_SESSION['oib'] ?></h4>

			<p>Broj telefona:</p>
			<h4><?php echo $_SESSION['telNo'] ?> </h4>

			<p>Email:</p>
			<h4><?php echo $_SESSION['email'] ?></h4>
			<br/><br/>
		</div>

		<div class="col-md-12">
			<h4>Ako su podaci ispravni, pritisnite tipku "Dalje".</h4>
		</div>

		<br/>

	</div>

	<div class="row buttonBooking">
			<div class="col-md-3">
				<form role="form" action="confirmation.php" method="POST">
				<br>
					<button type="submit" name="confirm" class="btn btn-primary">Dalje</button>
				</form>
			</div>
		</div>
	
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