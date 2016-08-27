<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="js/jqueryValidationMessages.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <script src="js/validatePersonalDetailsForm.js"></script>
    <script src="js/options.js"></script>
    <script src="js/javascript.js"></script>
    <link rel="stylesheet" href="fonts/css/font-icons.css" />
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
                        <ul>
                         
                        </ul>
                    </nav>
                </div>
                <div class="col-md-8">
                    <nav class="second-nav-right">
                        <ul>
                            <li><a href="contact.html">Kontakt</a></li>
                            <li><a href="#">HR|ENG</a></li>
                            <li>
                                <p id="onclick"> Ulogiraj se</p>
                            </li>
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
            <li><h3><a href="personalDetails.php" >Osobni podaci <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
            <li><h3><a href="reservation.php" class="not-active">Rezervacija <i class="icon-minus"></i> <i class="icon-flight"></i><i class="icon-minus"></i></a></h3></li>
            <li><h3><a href="confirmation.php" class="not-active">Potvrda</a></h3></li>
        </nav>  
        </div>
    </div>
        <div class="row formPassengerDetail">
            <div class="col-md-12">
                <form action="reservation.php" method="POST" role="form" class="form-inline" id="personalDetailsForm" data-toggle="validator">
                    <div class="row">
                        <div class="col-md-12 padding0">
                            <h1>Detalji putnika</h1>
                            <br>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="passengerName">Ime: * </label>
                            <br>
                        </div>
                        <div class="col-md-9 form-group has-feedback">
                            <input type="text" name="passengerName" id="passengerName" class="form-control" placeholder="Ime" required>
                            <br>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="passengerLastName">Prezime: *</label>
                        </div>
                        <div class="col-md-9 form-group has-feedback">
                            <input type="text" name="passengerLastName" id="passengerLastName" class="form-control" placeholder="Prezime" required>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="oib">OIB: * </label>
                        </div>
                        <div class="col-md-9 form-group has-feedback">
                            <input type="text" name="oib" id="oib" class="form-control" placeholder="OIB" required>
                        </div>
                        <!-- 
            		<div class="col-md-3 form-group">
            			<label for="street">Ulica: * </label>
            		</div>

            		<div class="col-md-9 form-group has-feedback">
            			<input type="text" name="street" id= "street" class="form-control" placeholder="Ulica" required>
            		</div>
            		
            		<div class="col-md-3 form-group has-feedback">
            			<label for="city">Grad i poštanski broj: * </label>
            		</div>

            		<div class="col-md-3 form-group has-feedback">
            			<input type="text" name="city" id= "city" class="form-control" placeholder="Grad" required>
            		</div>

            		<div class="col-md-6 form-group has-feedback">
            			<input type="text" name="zipcode" id= "zipcode" class="form-control"  placeholder="Poštanski broj" required>
            		</div>
            		
            		<div class="col-md-12"></div>
            		<div class="col-md-3 form-group">
            			<label for="state">Država: * </label>
            		</div>

            		<div class="col-md-9 form-group has-feedback">
            			<input type="text" name="state" id= "state" class="form-control" placeholder="Država" required>
            		</div> -->
                        <div class="col-md-12 padding0">
                            <br>
                            <h2> Kontakt podaci: </h2>
                            <br>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="telNo">Broj telefona: *</label>
                        </div>
                        <div class="col-md-9 form-group has-feedback">
                            <input type="tel" name="telNo" id="telNo" class="form-control" placeholder="Telefonski broj" required>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="email">Email: *</label>
                        </div>
                        <div class="col-md-9 form-group has-feedback">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-md-2 form-group">
                            <br>
                            <br>
                            <button type="submit" class="btn btn-primary" id="personalDtBt" disabled> Pošalji </button>
                            
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
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
        <br>
        <br>
        <div class="row privileges">
            <div class="col-md-12">
                <h2>Privilegije poslovanja s nama:</h2>
                <br>
            </div>
            <div class="col-md-4">
                <!-- 	<img src="http://placehold.it/350x150"> -->
                <h4><b><i class="icon-info"></i>TRANSPARENCY</b></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-md-4">
                <!-- 	<img src="http://placehold.it/350x150"> -->
                <h4><b><i class="icon-angle-double-right"></i>COLLECT MILES</b></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-md-4">
                <!-- <img src="http://placehold.it/350x150"> -->
                <h4><b><i class="icon-flight-1"></i>ADVENTAGES OF BOOKING ONLINE</b></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
                <br>
                <br>
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
