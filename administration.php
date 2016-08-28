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

	<div class="col-md-12 adminNav">
		<nav>
			<ul>
				<li><a href="#cities">Gradovi</a></li>
				<li><a href="#planes">Avioni</a></li>
				<li><a href="#seats">Sjedala</a></li>
				<li><a href="administrationFlights.php">Letovi</a></li>
			</ul>
		</nav>

	</div>

	</div>

	<div class="row">
		
		<div class="col-md-12"><br><br>
			<a name="cities"><h3>Popis gradova koji su u bazi:</h3></a> <br>
			<h4>Promijenite grad:</h4>
			<form action="administrationPost.php" method="POST" role="form" class="form-inline">
			<select class="selectpicker step" data-live-search="true" title="Popis gradova" id="allCitiesForUpdate" name="allCitiesForUpdate">
						<option value=""></option>
						<?php 
							$cities = ORM::for_table('city')->find_many();
							foreach ($cities as $city) {
								$state= $city->state;
			    				echo '<option value=' . $city->id;
			    				echo '>' . $city->city . ', ' .$state .'</option>';
							}

						?>
			</select> 
			<label for="updateCity">Naziv:</label>
			<input type="text" name="updateCity" id="updateCity" class="form-control"/>
			<label for="updateState">Država:</label>
			<input type="text" name="updateState" id="updateState" class="form-control"/>
			<input name="submitCityForUpdate" type="submit" value="Promijeni grad" class="btn btn-primary" />
			</form>
		</div>

		<div class="col-md-12">
		<br>
		<br>
	
			<form action="administrationPost.php" method="POST" role="form" class="form-inline">
				<div class="form-group">
					<h4>Unesite novi grad:</h4>
					<label for="newCity">Grad:</label>
					<input type="text" name="newCity" id="newCity" class="form-control"/>
					<label for="newState">Država:</label>
					<input type="text" name="newState" id="newState" class="form-control"/>
					<input name="submitCity" type="submit" value="Dodaj grad" class="btn btn-primary" />
				</div>
			</form>
		</div>


		<div class="col-md-12">
		<div class="form-group"><br><br>
			<h4> Izaberite grad koji želite izbrisati: </h4>
			<form action="administrationPost.php" method="POST" role="form" class="form-inline">
				<select class="selectpicker step" data-live-search="true" title="Popis gradova" data-header="Popis gradova iz baze" id="allCitiesForDelete" name="allCitiesForDelete">
					<option value=""></option>
							<?php 
								$cities = ORM::for_table('city')->find_many();
								foreach ($cities as $city) {
									$state= $city->state;
				    				echo '<option value=' . $city->id;
				    				echo '>' . $city->city . ', ' .$state .'</option>';
								}
							?>
				</select>
				<input name="submitCityForDelete" type="submit" value="Izbriši grad" class="btn btn-primary" />
			</form>
		</div>	
	</div>

	</div>
	<br><br><br><hr>
	<div class="row">
			<br>

		<div class="col-md-12">
			<a name="planes"><h3>Popis aviona koji su u bazi:</h3></a> <br>
			<select class="selectpicker step" data-live-search="true" title="Popis aviona" id="listOfPlanes" name="listOfPlanes">
						<option value=""></option>
						<?php 
							$planes = ORM::for_table('plane')->find_many();
							foreach ($planes as $plane) {
			    				echo '<option value=' . $plane->name;
			    				echo '>' . $plane->name . ', ' .$plane->referenceNo .', br. sjedala = ' . $plane->seatsNo .'</option>';
							}

						?>
			</select> 
		</div>

		<div class="col-md-12">
			<div class="form-group"> <br><br>
			<form action="administrationPost.php" method="POST" role="form" class="form-inline">
				<h4>Unesite novi avion:</h4>
				<label for="newPlaneName">Ime aviona:</label>
				<input type="text" name="newPlaneName" id="newPlaneName" class="form-control"/>

				<label for="newPlaneRef">Broj aviona:</label>
				<input type="text" name="newPlaneRef" id="newPlaneRef" class="form-control"/>
				
				<label for="newPlaneSeatsNo">Broj sjedala:</label>
				<input type="number" name="newPlaneSeatsNo" id="newPlaneSeatsNo" class="form-control"/>

				<input name="submitPlane" type="submit" value="Dodaj avion" class="btn btn-primary" />
				</form>
			</div>
		</div>


		<div class="col-md-12">
			<div class="form-group"> <br><br>
				<h4> Izaberite avion koji želite izbrisati: </h4>
				<form  action="administrationPost.php" method="POST" role="form" class="form-inline">
				<select class="selectpicker step" data-live-search="true" title="Popis aviona" data-header="Popis aviona iz baze" id="allPlanesForDelete" name="allPlanesForDelete">
					<option value=""></option>
						<?php 
							$planes = ORM::for_table('plane')->find_many();
							foreach ($planes as $plane) {
			    				echo '<option value=' . $plane->id;
			    				echo '>' . $plane->name . ', ' .$plane->referenceNo .', br. sjedala = ' . $plane->seatsNo .'</option>';
							}
						?>
				</select>

				<input name="submitPlaneForDelete" type="submit" value="Izbriši avion" class="btn btn-primary" />
				</form>
			</div>	
			
									
		</div>


	</div>

<br><br><hr>
	<div class="row">
		<div class="col-md-12">
			<a name="seats"><h3>Popis sjedala koja su u bazi:</h3> </a><br>
			<select class="selectpicker step" data-live-search="true" title="Popis sjedala" id="listOfSeats" name="listOfSeats">
						<option value=""></option>
						<?php 
							$seats = ORM::for_table('seat')
							->select_many(array('seatNo' => 'seat.seatNo', 'class' => 'flight_class.className', 
								'id' => 'seat.id'))
							->join('flight_class', array('seat.idFlightClass', '=', 'flight_class.id'))
							->find_many();

							foreach ($seats as $seat) {
			    				echo '<option value=' . $seat->id;
			    				echo '>' . $seat->seatNo . ', ' .$seat->class .'</option>';
							}

						?>
			</select> 
		</div>
		<div class="col-md-12"> <br><br>
			<form action="administrationPost.php" method="POST" role="form" class="form-inline">
				<div class="form-group">
					<h4>Dodajte novo sjedalo:</h4>
					<label for="newSeat">Broj sjedala:</label>
					<input type="text" name="newSeat" id="newSeat" class="form-control" placeholder="U obliku 'brojSlovo'= 1A" />
					<label for="newSeatClass">Klasa sjedala:</label>
					<input type="number" name="newSeatClass" id="newSeatClass" class="form-control" placeholder="1 ili 2" />
					<input name="submitSeat" type="submit" value="Dodaj sjedalo" class="btn btn-primary" />
				</div>
			</form>
		</div>

		<div class="col-md-12">
			<div class="form-group"> <br><br>
				<h4> Izaberite sjedalo koji želite izbrisati: </h4>
				<form  action="administrationPost.php" method="POST" role="form" class="form-inline">
					<select class="selectpicker step" data-live-search="true" title="Popis sjedala" data-header="Popis sjedala iz baze" id="allSeatsForDelete" name="allSeatsForDelete">
						<option value=""></option>
							<?php 
							$seats = ORM::for_table('seat')
							->select_many(array('seatNo' => 'seat.seatNo', 'class' => 'flight_class.className', 
								'id' => 'seat.id'))
							->join('flight_class', array('seat.idFlightClass', '=', 'flight_class.id'))
							->find_many();

							foreach ($seats as $seat) {
			    				echo '<option value=' . $seat->id;
			    				echo '>' . $seat->seatNo . ', ' .$seat->class .'</option>';
							}
							?>
					</select>
					<input name="submitSeatForDelete" type="submit" value="Izbriši sjedalo" class="btn btn-primary" />

				</form>
			</div>	

		</div>

	</div>

	<div class="row">

	
	</div>

				<br><br>
			
	<div class="row">
		

	</div>

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