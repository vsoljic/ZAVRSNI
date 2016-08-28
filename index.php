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

<!--     <link href="css/bootstrap.min.css" rel="stylesheet">
      	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css" />
     -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
	
	<link rel="stylesheet" href="fonts/css/font-icons.css"/>
    <script src="js/javascript.js"></script>
    <script src="js/dateRange.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <style>
	  .carousel-inner > .item > img,
	  .carousel-inner > .item > a > img {
	      width: 100%;
	      margin: auto;
	  }
  </style>

<!--   <script>
  	var my_dictionary = {
    'AVIOKOMPANIJA':      'AIRCOMPANY',
    'Kontakt': 'Contact Us'
}
	$.i18n.load(my_dictionary);

	$('#index_logo_name').text($.i18n._('AVIOKOMPANIJA'));

  </script> -->

<?php
     	session_start();
       	require_once 'idiorm/idiorm.php';
        ORM::configure('mysql:host=localhost;dbname=aircompany');
        ORM::configure('username','root');
        ORM::configure('password','root'); 
        ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));   
        ORM::configure('logging', true); 
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
		<div class="col-md-4 logo" id="index_logo_name">
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

	<div class="row">
		<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="8000">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
		    <li data-target="#myCarousel" data-slide-to="3"></li>
		  </ol>

  		<!-- Wrapper for slides -->
  		<div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="img/plane.jpg" alt="Plane">
   			</div>

		    <div class="item">
		      <img src="img/plane2.jpg" alt="Plane2">
		    </div>

		    <div class="item">
		      <img src="img/planeArena.jpg" alt="PlaneArena">
		    </div>

		    <div class="item">
		      <img src="img/plane.jpg" alt="Plane">
		    </div>
	  	</div>

	  <!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-11 formIndex">
			<form action="booking.php" method="post" role="form" class="form-inline">
				
				<div class="form-group">
					<select class="selectpicker step" data-live-search="true" title="Departure City" data-header="Select a departure airport" id="departureCity" name="departureCity">
						<option value=""></option>
						<?php 
							$cities = ORM::for_table('city')->find_many();
							foreach ($cities as $city) {
								$nameDepCity = $city->city;
								$state= $city->state;
			    				echo '<option value=' . $nameDepCity; 
			    				/*if($nameDepCity == $_SESSION['departureCity']){
			    					echo ' selected';
			    				}*/
			    				echo '>' . $nameDepCity . ', ' .$state .'</option>';

							}

						?>
					</select>

				</div>	
				<div class="form-group">
					<select class="selectpicker step" data-live-search="true" title="Arrival City" data-header="Select an arrival airport" id="arrivalCity" name="arrivalCity">
						<option value=""></option>
					<?php 
					$cities = ORM::for_table('city')->find_many();
					foreach ($cities as $city) {
	    				echo '<option value=' . $city->city. '>' . $city->city .'</option>';
					}

					?>
						<!-- <option value=""></option>
					  	<option value="berlin">Berlin</option>
					  	<option value="london">London</option>
						<option value="paris">Paris</option> -->
					</select>
				</div>	
				<div class="form-group">
					<input type="text" id="outGoingFlight"  name="outGoingFlight" placeholder="Outgoing flight Date" class="form-control step datapicker" disabled>
					<!--  <div class="input-group-addon">
			        	<span class="glyphicon glyphicon-th"></span>
			    	</div> -->
					
				</div>	
				<div class="form-group">
					<input type="text" id="returnFlight" data-provide="datepicker" name="returnFlight" placeholder="Return Flight" class="form-control step datapicker" disabled>
				</div>	
		
				<div class="form-group">
					<input name="submit" name="findFlightBtn" id="findFlightBtn" type="submit" value="Traži" class="btn btn-primary" disabled />
				</div>	
			
			</form>
			

  ?>
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
	<div class="row cheapFlights">
		<div class="col-md-12 cheapFlightsNaslov">
			<h2>Nađi jeftine letove:</h2>
		</div>
		<!--<div class="col-md-4">
			<a href="bookCheapFlight.html"> <img src="img/paris370x300.jpg"> -->
			<?php 		
					$cities = ORM::for_table('city')
						->select_many(array('path' => 'pictures.img370x300', 'city' => 'city.city', 'id' => 'city.id'))
						->join('pictures', array('city.id', '=', 'pictures.idCity'))
						->limit(9)
						->find_many();		

			 
					foreach ($cities as $city) {
						echo '<div class="col-md-4">';
						echo '<a href="bookCheapFlight.php?id='. $city->id . '">';

	    				echo '<img src="'. $city->path .'">';
	    				echo '<h4>'. $city->city .'<i class="icon-right-open-1"></i> </a></h4>';
	    				echo '</div>';
					}

					?>
			<!-- <h4>PARIS od 300* kn <i class="icon-right-open-1"></i> </a></h4> 
		</div>-->

		<!-- <div class="col-md-4">
			<a href="bookCheapFlight.html"><img src="img/paris370x300.jpg">
			<h4>PARIS od 300* kn <i class="icon-right-open-1"></i> </a></h4>
		</div>

		<div class="col-md-4">
			<a href="bookCheapFlight.html"><img src="img/paris370x300.jpg">
			<h4>PARIS od 300* kn <i class="icon-right-open-1"></i> </a></h4>
		</div>
		<div class="col-md-4">
			<a href="bookCheapFlight.html"><img src="img/paris370x300.jpg">
			<h4>PARIS od 300* kn <i class="icon-right-open-1"></i> </a></h4>
		</div>

		<div class="col-md-4">
			<a href="bookCheapFlight.html"><img src="img/paris370x300.jpg">
			<h4>PARIS od 300* kn <i class="icon-right-open-1"></i> </a></h4>
		</div>

		<div class="col-md-4">
			<a href="bookCheapFlight.html"><img src="img/paris370x300.jpg">
			<h4>PARIS od 300* kn <i class="icon-right-open-1"></i> </a></h4>
		</div> -->

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