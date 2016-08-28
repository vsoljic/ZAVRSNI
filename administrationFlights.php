<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

  	<script type="text/javascript" src="bower_components/moment/min/moment.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript" src="datepicker/js/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="datepicker/css/datepicker.css"/> -->
  	<link rel="stylesheet" href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="fonts/css/font-icons.css"/>
    <script src="js/dateRange.js"></script>
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

			    if(isset($_POST['username']) && isset($_POST['password'])){
			    	$_SESSION['username'] = $_POST['username'];
			    	$_SESSION['password'] = $_POST['password'];
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

	<!-- 	<div class="col-md-8">
			<nav class="main-nav">
	        	<ul>
		          <li><a href="booking.html">Rezerviraj let</a></li>
		          <li><a href="letovi.html">Letovi</a></li>
		          <li><a href="services.html">Naše usluge</a></li>
	       		</ul>
	      	</nav>
		</div> -->
	</div>

	<div class="row">

	<div class="col-md-12">
			<br>
			<h2> Administracijska stranica "AVIOKOMPANIJE" </h2>
			<br>
		</div>
	</div>

 	<div class="row">
		 <div class="col-md-12">
	
		</div>
 
		<div class="col-md-12">
			<form action="administrationPost.php" method= "POST" role="form" class="form-inline">
				<br><br><h4> Unesite novi let: </h4>

				<div class="col-md-3 form-group">
				<label for="planeFlight">Odaberite avion: </label>
				<select class="selectpicker step" data-live-search="true" title="Popis aviona" id="planeFlight" name="planeFlight">
					<option value=""></option>
					<?php 
						$planes = ORM::for_table('plane')->find_many();
						foreach ($planes as $plane) {
		    				echo '<option value=' . $plane->id;
		    				echo '>' . $plane->name . ', ' .$plane->referenceNo . ', ' . $plane->seatsNo .'</option>';
						}

					?>
				</select> 
			</div>

			<div class="col-md-12"> <br><br></div>


				<div class="col-md-3 form-group">
					<label for="departureCityFlight">Departure city: </label>
					<select class="selectpicker step" data-live-search="true" title="Departure City" id="departureCityFlight" name="departureCityFlight">
						<option value=""></option>
						<?php 
							$depCities = ORM::for_table('city')->find_many();
							foreach ($depCities as $depCity) {
								$state= $depCity->state;
			    				echo '<option value=' . $depCity->id;
			    				echo '>' . $depCity->city . ', ' .$state .'</option>';
							}

						?>
					</select> 
				</div>
				<div class="col-md-3 form-group">
					<label for="arrivalCityFlight">Arrival city: </label>
					<select class="selectpicker step" data-live-search="true" title="Arrival City" id="arrivalCityFlight" name="arrivalCityFlight">
						<option value=""></option>
						<?php 
							$arrCities = ORM::for_table('city')->find_many();
							foreach ($arrCities as $arrCity) {
								$state= $arrCity->state;
			    				echo '<option value=' . $arrCity->id;
			    				echo '>' . $arrCity->city . ', ' .$state .'</option>';
							}

						?>
					</select> 
				</div>

				<div class="col-md-12 form-group">
					<br><br>
				</div>

				<div class="col-md-3 form-group">
					<label for="flightStartDate">Start date:</label>
					<input type="text" id="flightStartDate" data-provide="datepicker" name="flightStartDate" placeholder="Datum početka leta" class="form-control step datapicker" >
				</div>
			
				<div class="col-md-3">
					<label for="flightEndDate">End date:</label>
					<input type="text" id="flightEndDate" data-provide="datepicker" name="flightEndDate" placeholder="Datum kraja leta" class="form-control step datapicker" >
				</div>
				<br><br>

				<div class="col-md-12 form-group">
					
				</div>

				<div class="col-md-3 form-group">
					<br><label for="everyNoDays">Svaki:</label><br>
				<!-- <input type="number" id="everyNoDays" name="everyNoDays" placeholder="npr. Svaka tri dana" class="form-control step" >-->

					<select class="selectpicker step" data-live-search="true" title="Dani u tjednu" id="days" name="days">
						<option value=""></option>
						<option value="0">Ponedjeljak</option>
						<option value="1">Utorak</option>
						<option value="2">Srijeda</option>
						<option value="3">Četvrtak</option>
						<option value="4">Petak</option>
						<option value="5">Subota</option>
						<option value="6">Nedjelja</option>
					</select>

					<br><br>
				</div> 
				
				<!-- <div class="col-md-3 form-group">
				<br><label for="everyNoTimes">U danu, koliko puta:</label><br>
				<input type="number" id="everyNoTimes" name="everyNoTimes" placeholder="npr. U danu, 3 puta" class="form-control step" >
				</div>
				</div> -->
				<br><br>

				<div class="col-md-12"></div>
				<div class="col-md-3 form-group">
					<br>
					<label for="flightEveryHoursDeparture">Sati - polazak:</label>
					<input type="time" id="flightEveryHoursDeparture" name="flightEveryHoursDeparture" class="form-control step" >
				</div>

				<div class="col-md-3 form-group">
				<br>
					<label for="flightEveryHoursArrival">Sati - dolazak:</label>
					<input type="time" id="flightEveryHoursArrival" name="flightEveryHoursArrival" class="form-control step" >
					<!--<input type="time" id="flightEveryHours3" name="flightEveryHours3" class="form-control step" > -->
					<br><br>
				</div>

				<div class="col-md-12 "></div>

				<div class="col-md-3 form-group">
					<label for="priceEcoFlight">Cijena - economy:</label>
					<input type="number" step="0.01" id="priceEcoFlight" name="priceEcoFlight" class="form-control step" >
				</div>

				<div class="col-md-3 form-group">
					<label for="priceBusFlight">Cijena - business:</label>
					<input type="number" step="0.01" id="priceBusFlight" name="priceBusFlight" class="form-control step" >
				</div>
				

				<div class="col-md-12 form-group">	<br><br>
					<input name="submitNewFlight" type="submit" value="Dodaj" class="btn btn-primary" />

				</div>
				
				<br><br>
			</form>
				
		</div>

	</div> 

<br><br>

	<div class="row">

			<!-- <div class="col-md-12">
				<div class="form-group"><br><br>
					<h4> Izaberite let koji želite izbrisati: </h4>
					<select class="selectpicker step" data-live-search="true" title="Popis letova" data-header="Popis letova iz baze" id="allFlights">
						<option value=""></option>
						<option value="zagreb-split">Zagreb - Split</option>
						<option value="london-split">London - Split</option>
						<option value="rijeka-paris">Rijeka - Paris</option>
					</select>

					<input name="submit" type="submit" value="Izbriši iz baze" class="btn btn-primary" />
	
				</div>	
			</div> -->
	
	</div>	



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