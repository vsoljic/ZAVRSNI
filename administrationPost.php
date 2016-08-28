<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  	<script type="text/javascript" src="bower_components/moment/min/moment.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="datepicker/js/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="datepicker/css/datepicker.css"/>
  	<link rel="stylesheet" href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="fonts/css/font-icons.css"/>
    <script src="js/javascript.js"></script>
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

			    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
			    
			    	$username= $_SESSION['username'];
			    	$password = $_SESSION['password'];
 
			    }

			    $user = ORM::for_table('user')
			    		->raw_query('SELECT * FROM user where username = :username AND password = :password',
			    			array('username' => $username, 'password' => $password ))
			    		->find_one();
		
				
	?>

  </head>

<body>
<div class="container">
	<div class="row header">
	<div class="col-md-12">
		<div class="col-md-4">
			<nav class="second-nav-left">
	        	<ul>
		         	<li><a href="index.php">Povratak na glavne stranice</a>
	       		</ul>
	      	</nav>
		</div>

		<div class="col-md-8">
			<nav class="second-nav-right">
	        	<ul>
		          <form method="post" action="index.php">
		        	<?php 
						

						if($username == 'admin' && $password == 'admin'){
							echo '<li><p> Dobro došli, ' .$username . '</p></li>';	
						}
						else{
							//header("location:index.php");
							echo '<li><p> Dobro došli, ' .$username . '</p></li>';
						}
				
					?>
     
      			<li><input type="submit" name="login" value="Odjava" class="btn btn-primary"></li>
  			</form>
		   
	       		</ul>
	      	</nav>
		</div>
	</div>
	</div>

	<div class="row header-2">
		<div class="col-md-4 logo" id="index_logo_name">
			<h1><a href="index.html">AVIOKOMPANIJA</a> </h1>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<br>
			<h2> Administracijska stranica "AVIOKOMPANIJE" </h2>
			<br>
		</div>

		<div class="col-md-12">
			<?php 
				date_default_timezone_set('UTC');
 
				if(isset($_POST['submitNewFlight'])){
					$departureCityId = $_POST['departureCityFlight'];
					$arrivalCityId = $_POST['arrivalCityFlight'];
					$flightEveryHoursDep = $_POST['flightEveryHoursDeparture'];
					$flightEveryHoursArr = $_POST['flightEveryHoursArrival'];
					$priceEco = $_POST['priceEcoFlight'];
					$priceBus = $_POST['priceBusFlight'];
					$planeId = $_POST['planeFlight'];


					$date = $_POST['flightStartDate'];
					$end_date = $_POST['flightEndDate'];

					echo $departureCity . ' ' . $arrivalCity . ' ' . $date . ' ' . $end_date ;
					echo '<br>';
					echo $flightEveryHours;
					echo '<br>';

					$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday',	'Friday', 'Saturday', 'Sunday');
					$chosenDay = $_POST['days'];

					foreach($days as $key=>$day){
				 	if($key == $chosenDay){
				 		
				 	$endDate = strtotime($end_date);
						for($i = strtotime($day, strtotime($date)); $i <= $endDate; $i = strtotime('+1 week', $i)){
					    	$formattedDate = date('Y-m-d', $i);
					    
					    	$newFlight = ORM::for_table('flight')->create();
							echo 'ušli smo yay2';
							echo '<br>';
						
							$newFlight->idPlane = $planeId;
							$newFlight->idDepartureCity = $departureCityId;
							$newFlight->idArrivalCity = $arrivalCityId;
							$newFlight->departureDate = $formattedDate;
							$newFlight->arrivalDate = $formattedDate;
							$newFlight->departureTime = $flightEveryHoursDep;
							$newFlight->arrivalTime = $flightEveryHoursArr;
							$newFlight->priceEconomy = $priceEco;
							$newFlight->priceBusiness = $priceBus;

							echo  $planeId .'<br>';
							echo  $departureCityId .'<br>';
							echo  $arrivalCityId .'<br>';
							echo  $formattedDate .'<br>';
							echo  $flightEveryHoursDep .'<br>';
							echo  $flightEveryHoursArr .'<br>';
							echo  $priceEco .'<br>';
							echo  $priceBus .'<br>';

							echo  $newFlight->idPlane .'<br>';
							echo  $newFlight->idDepartureCity .'<br>';
							echo  $newFlight->idArrivalCity .'<br>';
							echo  $newFlight->departureDate .'<br>';
							echo  $newFlight->arrivalDate .'<br>';
							echo  $newFlight->departureTime .'<br>';
							echo  $newFlight->arrivalTime .'<br>';
							echo  $newFlight->priceEconomy .'<br>';
							echo  $newFlight->priceBusiness .'<br>';

							
							$newFlight->save();
							echo 'Flight saved!!!!!!!';

						}

				 	} else {
				 		'<h3> Neuspješno spremanje leta u bazu. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
				 	}
				 }

					
					
				}

			 ?>


		</div>

		<div class="col-md-12">
			<?php
	
			if($_POST['submitCity']){
				echo 'ušli smo yay';
			$city = ORM::for_table('city')->create();

			$cityPost = $_POST['newCity'];
			$statePost = $_POST['newState'];
			echo 'ušli smo yay2';
			$city->city = $cityPost;
			$city->state = $statePost;
			
			echo $cityPost;
			echo $statePost;
			
			$city->save();
			echo 'City saved';

			echo '<h3> Uspješno ste spremili grad u bazu. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		} else {
			echo '<h3> Neuspješno spremanje grada u bazu. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		}


		if($_POST['submitCityForDelete']){

			$selectedCityId = $_POST['allCitiesForDelete'];
			
			$city = ORM::for_table('city')
				->raw_query('SELECT * FROM city WHERE city.id = :idSelected', array('idSelected' => $selectedCityId))
				->find_one();

			$city->delete();

			echo '<h3> Uspješno ste izbrisali grad iz baze. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';

		} else {
			echo '<h3> Neuspješno brisanje grada. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		}

		if($_POST['submitCityForUpdate']){
			$selectedCityId = $_POST['allCitiesForUpdate'];
			$updateCity = $_POST['updateCity'];
			$updateState = $_POST['updateState'];
			
			$city = ORM::for_table('city')
				->raw_query('SELECT * FROM city WHERE city.id = :idSelected', array('idSelected' => $selectedCityId))
				->find_one();

			$city->set('city', $updateCity);
			$city->set('state', $updateState);

			$city->save();

			echo '<h3> Uspješno ste promijenili grad iz baze. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';

		} else {
			echo '<h3> Neuspješna promjena grada. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		}

		?>

		
		</div>

	</div>

	<div class="row">
				<br><br>
			<div class="col-md-12">
		<?php
	
			if($_POST['submitPlane']){
				echo 'ušli smo yay';
				$plane = ORM::for_table('plane')->create();

				$namePost = $_POST['newPlaneName'];
				$refPost = $_POST['newPlaneRef'];
				$seatsNoPost = $_POST['newPlaneSeatsNo'];
				echo 'ušli smo yay2';

				$plane->name = $namePost;
				$plane->referenceNo = $refPost;
				$plane->seatsNo = $seatsNoPost;

				echo $namePost;
				echo $refPost;
				echo $seatsNoPost;

				echo '<br>';

				echo $plane->name;
				echo $plane->referenceNo;
				echo $plane->seatsNo;
				
				$plane->save();
				echo 'Plane saved';

			echo '<h3> Uspješno ste spremili avion u bazu. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		} else {
			echo '<h3> Neuspješno spremanje aviona u bazu. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		}


		if($_POST['submitPlaneForDelete']){
			echo 'ušli smo yay';
				$selectedPlaneId = $_POST['allPlanesForDelete'];

				$plane = ORM::for_table('plane')
				->raw_query('SELECT * FROM plane WHERE plane.id = :idSelected', array('idSelected' => $selectedPlaneId))
				->find_one();

				$plane->delete();

			echo '<h3> Uspješno ste izbrisali avion iz baze. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		} else {
			echo '<h3> Neuspješno brisanje aviona. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		}


	?>
	</div>
	</div>


	<div class="row">
			
		<div class="col-md-12"><br><br>
		<?php
	
			if($_POST['submitSeat']){
				echo 'ušli smo yay';
				$seat = ORM::for_table('seat')->create();

				$seatNoPost = $_POST['newSeat'];
				$seatClassPost = $_POST['newSeatClass'];
				
				echo 'ušli smo yay2';

				$seat->seatNo = $seatNoPost;
				$seat->idFlightClass = $seatClassPost;
				

				echo $seatNoPost;
				echo $seatClassPost;

				echo '<br>';

				echo $seat->seatNo;
				echo $seat->idFlightClass;
				
				$seat->save();
				echo 'Seat saved';

			echo '<h3> Uspješno ste spremili sjedalo u bazu. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		} else {
			echo '<h3> Neuspješno spremanje sjedala u bazu. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		}


		if($_POST['submitSeatForDelete']){
				$selectedSeatId = $_POST['allSeatsForDelete'];

				$seat = ORM::for_table('seat')
				->raw_query('SELECT * FROM seat WHERE seat.id = :idSelected', array('idSelected' => $selectedSeatId))
				->find_one();

				$seat->delete();

			echo '<h3> Uspješno ste izbrisali sjedalo iz baze. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		} else {
			echo '<h3> Neuspješno brisanje sjedala. <a href="administration.php">Povratak na administracijsku stranicu</a></h3>';
		}
	?>


	</div>
	</div>

	<br><br>
			
	<div class="row safeBuy">
		<div class="col-md-12">
			<div class="col-md-4"><img src="img/car-seat2.png">
			<h3>Udobnost sjedala</h3></div>
			<div class="col-md-4"><img src="img/travelling-suitcase.png">
			<h3>Sigurnost prtljage</h3></div>
			<div class="col-md-4"><img src="img/planeicon.png">
			<h3>Siguran i brz let</h3></div>
		</div>
	</div>
	<br><br>

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
			<h4><b><i class="icon-info"></i>TRANSPARENTNOST</b></h4>
			<p>Kupnja kod nas je vrlo jednostavna, poštena i bez ikakvih skrivenih troškova! Takva će i ostati.</p>
		</div>

		<div class="col-md-4">
		<!-- 	<img src="http://placehold.it/350x150"> -->
			<h4><b><i class="icon-angle-double-right"></i>SKUPLJAJ BODOVE</b></h4>
			<p>Svaki put kad nakon online rezerervacije kupite kartu na aerodromu, ostvarujete bodove jer ste putovali s nama! Skupljajući bodove, otvaraju Vam se mnoge nove mogućnosti kao i popusti.</p>
		</div>

		<div class="col-md-4">
			<!-- <img src="http://placehold.it/350x150"> -->
			<h4><b><i class="icon-flight-1"></i>PREDNOSTI ONLINE REZERVACIJE</b></h4>
			<p>Bez redova i čekanja... Rezerviraj svoje mjesto online uz svega par klikova!</p>
		</div>

	</div>

	<div class="row payment">
				<div class="col-md-12">
			<h2>Naši partneri:</h2>
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