<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type="text/javascript" src="jquery-i18n/jquery.i18n.js"></script>
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

			    $users = ORM::for_table('user')
			    		->select('user.*')
			    		->where( array('username' => 'admin', 'password' => 'admin' ))
			    		->find_many();
				foreach($users as $user){
					$user->username = $_SESSION['username'];
					$user->password = $_SESSION['password'];
				};		
				
				
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
								
						if($_SESSION['username'] == $_POST['username'] && $_SESSION['password']==$_POST['password']){
							echo '<li><p> Dobro došli, ' .$_SESSION["username"] . '</p></li>';	
						}
						else{
							//header("location:index.php");
							echo $_POST['username'] . ' ' . $_POST['password'];
							echo $_SESSION['username'] . ' ' . $_SESSION['password'];
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
			<br><br>
		</div>

		<div class="col-md-12">
			<form action="administration.php" role="form" class="form-inline">
				<div class="form-group">
					<h4>Unesite novi grad:</h4>
					<label for="newCity">Grad:</label>
					<input type="text" name="newCity" id="newCity" class="form-control"/>
					<label for="newState">Država:</label>
					<input type="text" name="newState" id="newState" class="form-control"/>
					<input name="submit" type="submit" value="Dodaj grad" class="btn btn-primary" />
				</div>
			</form>
		</div>

				<br><br><br>
			<div class="col-md-12">
				<div class="form-group">
				<form action="administration.php" role="form" class="form-inline">
					<h4>Unesite novi avion:</h4>
					<label for="newPlaneName">Ime aviona:</label>
					<input type="text" name="newPlaneName" id="newPlaneName" class="form-control"/>

					<label for="newPlaneRef">Broj aviona:</label>
					<input type="text" name="newPlaneRef" id="newPlaneRef" class="form-control"/>
					
					<label for="newPlaneSeatsNo">Broj sjedala:</label>
					<input type="number" name="newPlaneSeatsNo" id="newPlaneSeatsNo" class="form-control"/>

					<input name="submit" type="submit" value="Dodaj avion" class="btn btn-primary" />
					</form>
				</div>
			</div>

			<div class="col-md-12">
				<br><br><br>
				<div class="form-group">
					<form action="administration.php" role="form" class="form-inline">
					<h4> Unesite novi let: </h4>
					<label for="departureCityNew">Departure city: </label><br>
					<input type="text" name="departureCity" id="departureCityNew" class="form-control" />

					<br><label for="arrivaleCityNew">Arrival city: </label><br>
					<input type="text" name="departureCity" id="arrivaleCityNew" class="form-control" />
					
					<br><label for="flightStartDate">Start date:</label><br>
					<input type="text" id="flightStartDate" data-provide="datepicker" name="flightStartDate" placeholder="Datum početka leta" class="form-control step datapicker" >
				
					<br><label for="flightEndDate">End date:</label><br>
					<input type="text" id="flightEndDate" data-provide="datepicker" name="flightEndDate" placeholder="Datum kraja leta" class="form-control step datapicker" >
					<br><br>
					<br><label for="everyNoDays">Svakih koliko dana:</label><br>
					<input type="number" id="everyNoDays" name="everyNoDays" placeholder="npr. Svaka tri dana" class="form-control step" >

					<br><label for="everyNoTimes">U danu, koliko puta:</label><br>
					<input type="number" id="everyNoTimes" name="everyNoTimes" placeholder="npr. U danu, 3 puta" class="form-control step" >
					<br><br>
					
					<br><label for="flightEveryHours">U koliko sati:</label><br>
					<input type="time" id="flightEveryHours1" name="flightEveryHours1" placeholder="npr. Svaka tri dana" class="form-control step" >
					<input type="time" id="flightEveryHours2" name="flightEveryHours2" placeholder="npr. Svaka tri dana" class="form-control step" >
					<input type="time" id="flightEveryHours3" name="flightEveryHours3" placeholder="npr. Svaka tri dana" class="form-control step" >
					<br><br>	
					<input name="submit" type="submit" value="Dodaj" class="btn btn-primary" />
					<br><br>
					</form>
				</div>	
			</div>
			
		<div class="col-md-12">
			<form action="administration.php" role="form" class="form-inline">
				<div class="form-group">
					<h4>Dodajte novo sjedalo:</h4>
					<label for="newSeat">Broj sjedala:</label>
					<input type="text" name="newSeat" id="newSeat" class="form-control" placeholder="U obliku 'brojSlovo'= 1A" />
					<input name="submit" type="submit" value="Dodaj sjedalo" class="btn btn-primary" />
				</div>
			</form>
		</div>

			<div class="col-md-12">
				<div class="form-group"><br><br>
					<h4> Izaberite grad koji želite izbrisati: </h4>
					<select class="selectpicker step" data-live-search="true" title="Popis gradova" data-header="Popis gradova iz baze" id="allCities">
						<option value=""></option>
						<option value="zagreb">Zagreb</option>
						<option value="split">Split</option>
						<option value="rijeka">Rijeka</option>
						<option value="berlin">Berlin</option>
					  	<option value="london">London</option>
						<option value="paris">Paris</option>
					</select>

					<input name="submit" type="submit" value="Izbriši iz baze" class="btn btn-primary" />
	
				</div>	
			</div>
				<br><br>
			
			<div class="col-md-12">
				<div class="form-group">
					<h4> Izaberite avion koji želite izbrisati: </h4>
					<select class="selectpicker step" data-live-search="true" title="Popis aviona" data-header="Popis aviona iz baze" id="allPlanes">
						<option value=""></option>
						<option value="zagreb">Croatia Airlines XKG03</option>
						<option value="split">German Wings</option>
						<option value="rijeka">Austrian Airlines</option>
						<option value="berlin">Lufthansa</option>
					  	<option value="london">Croatia Airlines GPA42</option>
					</select>

					<input name="submit" type="submit" value="Izbriši iz baze" class="btn btn-primary" />
				</div>	
				<br><br>
							
			</form>
			</div>

			<div class="col-md-12">
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
			</div>
			

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