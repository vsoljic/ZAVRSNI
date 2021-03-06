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

	<div class="row hero">
		<?php 		
			$cityId = $_GET['id'];
			$selectedCity = ORM::for_table('city')
				->raw_query('SELECT * from city 
						join pictures on city.id = pictures.idCity where city.id = :id', array('id' =>$cityId))
				->find_one();

		?>

		<img src="<?php echo $selectedCity->img1170x500 ?>">
	</div>

	<div class="row">
		<div class="col-md-11 formIndex">
			<form action="booking.php" role="form" class="form-inline">
				
				<div class="form-group">
					<select class="selectpicker" data-live-search="true" title="Departure City" data-header="Select a departure airport">
					  <option>Zagreb</option>
					  <option>Split</option>
					  <option>Rijeka</option>
					</select>

				</div>	
				<div class="form-group">
					<select class="selectpicker" data-live-search="true" title="Arrival City" data-header="Select an arrival airport">
					  <option>Berlin</option>
					  <option>London</option>
					  <option>Paris</option>
					</select>
				</div>	
				<div class="form-group">
					<input type="date" id="outGoingFligt" name="outGoingFligt" placeholder="Outgoing Flight" class="form-control">
				</div>	
				<div class="form-group">
					<input type="date" id="returnFlight" name="returnFlight" placeholder="Return Flight" class="form-control">
				</div>	
		
				
				<button type="button" class="btn btn-primary">Traži</button>
					
			
			</form>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12 padding0">
			<h1>Rezerviraj letove za <?php echo $selectedCity->city ?></h1> <br>
			<p>Zagreb je glavni grad Republike Hrvatske, i najveći grad u Hrvatskoj po broju stanovnika. Povijesno gledajući, grad Zagreb je izrastao iz dva naselja na susjednim brežuljcima, Gradeca i Kaptola, koji čine jezgru današnjeg Zagreba, njegovo povijesno središte.Zagreb danas predstavlja upravno, gospodarsko, kulturno, prometno i znanstveno središte Hrvatske. Položajem spada u gradove Srednje Europe.Grad Zagreb je posebna teritorijalna, upravna i samoupravna jedinica koja ima položaj županije.</p>
		</div>
	</div>
	<br><br>

	<div class="row detailsCheapFlight">
		<h2> Letovi za <?php echo $selectedCity->city ?> </h2> <br>
		<form role="form" class="form-inline">
				
				<div class="form-group">
					<input type="date" id="month" name="month" placeholder="Mjesec" class="form-control">
				</div>	
				<div class="form-group">
					<input type="text" id="state" name="state" placeholder="State" class="form-control">
				</div>	<br><br><br>

	</div>

	<div class="row tableCheapFlight">
			<table class="table table-striped">
				<thead>
					<tr>
					<th><h4><a href="#">Letovi iz Njemačke u Zagreb</a></h4></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th><a href="booking.html">Let Berlin-Tegel za Zagreb</a></th>
						<th><a href="booking.html">od 300kn*</a></th>
					</tr>
					<tr>
						<th><a href="booking.html">Let Berlin-Tegel za Zagreb</a></th>
						<th><a href="booking.html">od 300kn*</a></th>
					</tr>
					<tr>
						<th><a href="booking.html">Let Berlin-Tegel za Zagreb</a></th>
						<th><a href="booking.html">od 300kn*</a></th>
					</tr>
					<tr>
						<th><a href="booking.html">Let Berlin-Tegel za Zagreb</a></th>
						<th><a href="booking.html">od 300kn*</a></th>
					</tr>
				</tbody>
			</table>	

	</div>

	<div class="row imagesCity">
		<div class="col-md-4">
			<img src="img/zagrebPogled.jpg"/>
		</div>
		
		<div class="col-md-4">
			<img src="img/zagrebHNK.jpg"/>
		</div>

		<div class="col-md-4">
		<img src="img/zagrebCrkva.jpg"/>
		</div>
	</div>
	<br><br>
		<div class="row ">
		<div class="col-md-12 padding0">
			<h1>Rezerviraj letove za Zagreb -> kultura i noćni život</h1> <br>
		</div>
		<div class="col-md-6 padding0">
			<p>The Croatian city's sights are great for art and culture lovers in particular. Book your Zagreb (ZAG) flights now and discover the city's many highlights. Start your city tour in the centre and continue on foot. The Dolac, the biggest market in Zagreb (ZAG), is not far away. This is where you'll find fresh foods such as vegetables, fruit, pastries, meat and cheese. Just a few steps away you'll find a little flower market, bars and restaurants. Another attraction is the city's Stone Gate, which was built in the 13th century. Zagreb (ZAG) Cathedral, which is 105 metres high, is also well worth a visit.</p>
		</div>
		<div class="col-md-6">
			<p>There are of course many other beautiful sights. Book your Zagreb (ZAG) flights now and visit the romantic Ban-Jelačić Square, a central meeting point for the locals and home to historical statues and fountains. Tourists will find a little peace and quiet in the botanical gardens, just minutes away from Zrinjevac. Families with children can visit Zagreb (ZAG) Zoo, located in the north-east of the city. In the evenings, night owls flock to Tkalciceva ulica, the city's party street. It is filled with bars, cafés and restaurants that are also open late into the night.</p>
		</div>
	</div>
	<br><br>
	<div class="row iconsSocialMedia">
		<div class="col-md-12">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<a href="#"><i class="icon-facebook-circled-1"></i></a>
				<a href="#"><i class="icon-twitter-circled"></i></a>
				<a href="#"><i class="icon-gplus-circled"></i></a>
				<a href="#"><i class="icon-youtube"></i></a>
				<a href="#"><i class="icon-instagram-1"></i></a>
			</div>
		
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