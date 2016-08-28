<!DOCTYPE html>
<html lang="en">
<?php 
	if(isset($_POST['optradio']))
				{
				    echo $_POST['optradio']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["optradio"] = $_POST['optradio'];

				    setCookie('radioButton', $_SESSION['optradio']);
				    echo $_SESSION["optradio"]." stored in session <br />";
				    echo 'Cookie set value: ' . $_['radioButton'];
				    print_r($_COOKIE);
				}
				else {
				    echo '<br>No, form submitted. Your old stored username was '.$_SESSION["optradio"];
				};
 ?>
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
	<script src="js/javascript.js"></script>
	<script src="js/clickable-rows.js"></script>
	<script src="js/cookies.js"></script>
	<link rel="stylesheet" href="fonts/css/font-icons.css"/>
    <link href="css/style.css" rel="stylesheet">
    <style>
	  .carousel-inner > .item > img,
	  .carousel-inner > .item > a > img {
	      width: 100%;
	      margin: auto;
	  }
  </style>
  </head>

<body>
<?php
		session_start();
       	require_once 'idiorm/idiorm.php';
        ORM::configure('mysql:host=localhost;dbname=aircompany');
        ORM::configure('username','root');
        ORM::configure('password','root'); 
        ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')); 
        ORM::configure('logging', true);

        if(!isset($_COOKIE["chosenFlight"])) {
		  echo "Cookie named chosenFlight is not set!";
		} else {
		  echo "Cookie chosenFlight is set!<br>";
		  echo "Value is: " . $_COOKIE["chosenFlight"] .'<br>';
		}

		if(!isset($_COOKIE["chosenFlightReturn"])) {
		  echo "Cookie named chosenFlightReturn is not set!";
		} else {
		  echo "Cookie chosenFlightReturn is set!<br>";
		  echo "Value is: " . $_COOKIE["chosenFlightReturn"];
}


       /* $user = 'root';
        $pass = 'root';
        try {
		    $dbh = new PDO('mysql:host=localhost;dbname=aircompany', $user, $pass);
		    
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}  */
?>
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
			<li><h3><a href="chooseFlight.php" >Odabir leta <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
			<li><h3><a href="personalDetails.php" class="not-active">Osobni podaci <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
			<li><h3><a href="reservation.php" class="not-active">Rezervacija <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
			<li><h3><a href="confirmation.php" class="not-active">Potvrda</a></h3></li>
		</nav>	
		</div>
	</div>
	<br/>

	<div class="col-md-12 padding0">
		<p>Kliknite na tipku "Izaberi" za let koji biste htjeli rezervirati u tablici te stisnite tipku "Dalje".</p>	
		
		<?php 

			if(isset($_POST['departureCity']))
				{
				    echo $_POST['departureCity']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["departureCity"] = $_POST['departureCity'];
				    echo $_SESSION["departureCity"]." stored in session <br />";;
				}
				else {
				    echo '<br>No, form submitted. Your old stored username was '.$_SESSION["departureCity"];
				};

				if(isset($_POST['arrivalCity']))
				{
				    echo $_POST['arrivalCity']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["arrivalCity"] = $_POST['arrivalCity'];
				    echo $_SESSION["arrivalCity"]." stored in session <br />";;
				}
				else {
				    echo '<br>No, form submitted. Your old stored username was '.$_SESSION["arrivalCity"];
				};

				if(isset($_POST['outGoingFlight']))
				{
				    echo $_POST['outGoingFlight']." Username found in form <br />";
				    // Set session variables
				    $_SESSION["outGoingFlight"] = $_POST['outGoingFlight'];
				    echo $_SESSION["outGoingFlight"]." stored in session <br />";;
				}
				else {
				    echo '<br>No, form submitted. Your old stored outGoingFlight was '.$_SESSION["outGoingFlight"];
				};

				if(isset($_POST['returnFlight']))
				{
				    echo $_POST['returnFlight']." returnFlight found in form <br />";
				    // Set session variables
				    $_SESSION["returnFlight"] = $_POST['returnFlight'];
				    echo $_SESSION["returnFlight"]." stored in session <br />";;
				}
				else {
				    echo '<br>No, form submitted. Your old stored returnFlight was '.$_SESSION["returnFlight"];
				};

				



		 ?>

	</div>

	<div class="col-md-12 padding0">
		<h3>Popis svih letova <b><?php echo $_SESSION['departureCity'] ?></b> za <b><?php echo $_SESSION['arrivalCity'] ?></b> - <?php echo $_SESSION['outGoingFlight'] ?></h3>	
		<br/><br/>		
	</div>		

	<div class="row chooseFlightTable">
		<div class="col-md-12">
			<table class="table table-striped" id="chooseFlightTable">
				<thead>
					<tr>
						<th style="display:none;">ID</th>
						<th><h4><img src="img/black-plane.png"/>  <?php echo $_SESSION['departureCity'] ?> - <?php echo $_SESSION['arrivalCity'] ?></h4></th>
						<th>Economy</th>
						<th></th>
						<th>Business</th>
						<th></th>
						
					</tr>
				</thead>
				<tbody>
					<?php 	
		
					$sessionDepCity = $_SESSION['departureCity'];
					$sessionArrCity = $_SESSION['arrivalCity'];
					$sessionOutDate = $_SESSION['outGoingFlight'];

					echo $sessionDepCity .'</br>';
					echo $sessionArrCity . '</br>';
					echo $sessionOutDate .'</br>';
					/*$flights = ORM::for_table('flight')
						->select_many(array('depCity' => 'depCity.city', 'arrCity' => 'arrCity.city', 'depTime' => 'flight.departureTime', 'arrTime' => 'flight.arrivalTime', 'priceEco' => 'flight.priceEconomy', 'priceBus' => 'flight.priceBusiness', 'outGoingFlight' => 'flight.departureDate' ))
						->join('city', array('depCity.id', '=', 'flight.idDepartureCity'), 'depCity')
						->join('city', array('arrCity.id', '=', 'flight.idArrivalCity'), 'arrCity')
						->where('depCity.city' => $sessionDepCity)
						->find_many();	*/	
						

					$flights = ORM::for_table('flight')
						->select_many(array('depCity' => 'depCity.city', 'arrCity' => 'arrCity.city', 'depTime' => 'flight.departureTime', 'arrTime' => 'flight.arrivalTime', 'priceEco' => 'flight.priceEconomy', 'priceBus' => 'flight.priceBusiness', 'outGoingFlight' => 'flight.departureDate', 'idFlight' => 'flight.id' ))
						->join('city', array('depCity.id', '=', 'flight.idDepartureCity'), 'depCity')
						->join('city', array('arrCity.id', '=', 'flight.idArrivalCity'), 'arrCity')
						->where( array('depCity.city' => 'Zagreb', 'arrCity.city' => 'Berlin', 'flight.departureDate' => '2016-08-26'))
						->find_many();		

						foreach ($flights as $flight) {
							echo '<tr>';
							echo '<td style="display:none;">'. $flight->idFlight.'</td>'; #redak za ID pomoću kojeg će se izabrati let!!!!!#
							echo '<td>' . $flight->depCity . ' (' . $flight->depTime . ') - ' . $flight->arrCity . ' (' . $flight->arrTime . ') ' . $flight->idFlight .' </td>';
							echo '<td>' . $flight->priceEco . ' kn </td>';
							echo '<td><input type="submit" name="classBtn" id="classBtn" value="Izaberi" onclick = "setCookie(&#39;chosenFlight&#39;,&#39;'.$flight->idFlight. ',' . $flight->priceEco.'&#39;)" /></form></td>';
							echo '<td>' . $flight->priceBus . ' kn </td>';
							echo '<td><input type="submit" name="classBtn" id="classBtn" value="Izaberi" onclick = "setCookie(&#39;chosenFlight&#39;,&#39;'.$flight->idFlight . ',' . $flight->priceBus .'&#39;)" /></form></td>';
							echo '</tr>';
					};
						
						#onclick = "setCookie('shop',getCookie('shop')+','+'{{ row.id }}', 1)"
					?> 
		<!-- 			 <tr>
						<td style="display:none;">1</td>
						<td>ZAG (08:00) - BER (11:30) </td>
						<td>350.00 kn</td>
						<td>528.00 kn</td>
					</tr>
					<tr>
						<td style="display:none;">1</td>
						<td>ZAG (08:00) - BER (11:30) </td>
						<td>220.00 kn</td>
						<td>528.00 kn</td>
					</tr>
					<tr>
						<td style="display:none;">2</td>
						<td>ZAG (08:00) - BER (11:30) </td>
						<td>350.00 kn</td>
						<td>528.00 kn</td>
					</tr>
					<tr>
						<td style="display:none;">3</td>
						<td>ZAG (08:00) - BER (11:30) </td>
						<td>480.00 kn</td>
						<td>528.00 kn</td>
					</tr>
					<tr>
						<td style="display:none;">4</td>
						<td>ZAG (08:00) - BER (11:30) </td>
						<td>350.00 kn</td>
						<td>528.00 kn</td>
					</tr>
					<tr>
						<td style="display:none;">5</td>
						<td>ZAG (08:00) - BER (11:30) </td>
						<td>300.00 kn</td>
						<td>528.00 kn</td>
					</tr>  -->
				</tbody>
			</table>	
		</div>	
		<!-- <div class="col-md-12">
		<br><br>
			<p> Izaberite koju klasu leta želite: </p>
			<div class="radio">
			    <label>
			    	<input type="radio" name="radioclass" value="economy" required="true" checked="true"/>Economy
			    </label>
			</div>
			<div class="radio">
			    <label>
			    	<input type="radio" name="radioclass" value="business"/>Business
			    </label>
			</div>
		</div> -->
	</div>
	
	<br/><br/><br/><br/>

	 
	<div class="col-md-12 padding0" id="returnHeading">
		<h3>Popis svih letova iz <b><?php echo $_SESSION['arrivalCity'] ?></b> za <b><?php echo $_SESSION['departureCity'] ?></b> - <?php echo $_SESSION['returnFlight'] ?></h3>	
		<br/><br/>				
	</div>		

	<div class="row chooseReturnFlightTable">
		<div class="col-md-12">
			<table class="table table-striped" id="chooseReturnFlightTable">
				<thead>
					<tr>
					<th style="display:none;">ID</th>
					<th><h4><img src="img/black-plane-rotate.png"/>  <?php echo $_SESSION['arrivalCity'] ?> - <?php echo $_SESSION['departureCity'] ?></h4></th>
					<th>Economy</th>
					<th></th>
					<th>Business</th>
					<th></th>
					</tr>
				</thead>
				<tbody>

					<?php 		
					$flights = ORM::for_table('flight')
						->select_many(array('depCity' => 'depCity.city', 'arrCity' => 'arrCity.city', 'depTime' => 'flight.departureTime', 'arrTime' => 'flight.arrivalTime', 'priceEco' => 'flight.priceEconomy', 'priceBus' => 'flight.priceBusiness', 'outGoingFlight' => 'flight.departureDate', 'idFlight' => 'flight.id' ))
						->join('city', array('depCity.id', '=', 'flight.idDepartureCity'), 'depCity')
						->join('city', array('arrCity.id', '=', 'flight.idArrivalCity'), 'arrCity')
						->where( array('depCity.city' => 'Berlin', 'arrCity.city' => 'Zagreb', 'flight.departureDate' => '2016-08-28'))
						->find_many();		

						foreach ($flights as $flight) {
							echo '<tr>';
							echo '<td style="display:none;">'. $flight->idFlight.'</td>'; #redak za ID pomoću kojeg će se izabrati let!!!!!#
							echo '<td>' . $flight->depCity . ' (' . $flight->depTime . ') - ' . $flight->arrCity . ' (' . $flight->arrTime . ') ' . $flight->idFlight .' </td>';
							echo '<td>' . $flight->priceEco . ' kn </td>';
							echo '<td><input type="submit" name="classBtn" id="classBtn" value="Izaberi" onclick = "setCookie(&#39;chosenFlightReturn&#39;,&#39;'.$flight->idFlight. ',' . $flight->priceEco.'&#39;)" /></form></td>';
							echo '<td>' . $flight->priceBus . ' kn </td>';
							echo '<td><input type="submit" name="classBtn" id="classBtn" value="Izaberi" onclick = "setCookie(&#39;chosenFlightReturn&#39;,&#39;'.$flight->idFlight . ',' . $flight->priceBus .'&#39;)" /></form></td>';
							echo '</tr>';
					};

					?>
	

					<!-- <tr>
						<td>BER (09:30) - ZAG (12:15) </td>
						<td>350.00 kn</td>
						<td>528.00 kn</td>
					</tr>
					<tr>
						<td>BER (09:30) - ZAG (12:15) </td>
						<td>350.00 kn</td>
						<td>528.00 kn</td>
					</tr>
					<tr>
						<td>BER (09:30) - ZAG (12:15) </td>
						<td>350.00 kn</td>
						<td>528.00 kn</td>
					</tr>
					<tr>
						<td>BER (09:30) - ZAG (12:15) </td>
						<td>350.00 kn</td>
						<td>528.00 kn</td>
					</tr>
					<tr>
						<td>BER (09:30) - ZAG (12:15) </td>
						<td>350.00 kn</td>
						<td>528.00 kn</td>
					</tr>
					<tr>
						<td>BER (09:30) - ZAG (12:15) </td>
						<td>350.00 kn</td>
						<td>528.00 kn</td>
					</tr> -->
				</tbody>
			</table>	

		</div>	
	</div>

	<br/>
	<div class="row buttonBooking">
		<div class="col-md-3">
			<form role="form">
			<br>
				<a href="personalDetails.html"><button type="button" class="btn btn-primary">Dalje</button></a>
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
 <?php 
		if($_COOKIE["radioButton"] == 'jednosmjerni'){ ?>
		<script type="text/javascript">
			document.getElementById("returnHeading").style.display = "none";
			document.getElementById("chooseReturnFlightTable").style.display = "none";
		</script>

		<?php } else { ?>
			<script type="text/javascript">
			echo $_COOKIE["radioButton"];
				document.getElementById("returnHeading").style.display = "block";
				document.getElementById("chooseReturnFlightTable").style.display = "block";
				
			</script>
		<?php } ?> 

</body>
</html>