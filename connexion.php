<?php
session_start();
require 'class/db_class.php';
$DB = new DB();
?><!DOCTYPE html>
<html lang="fr">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Réalisation de devis</title>

	<!-- Bootstrap -->
	<link href="style/bootstrap-3.3.6/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/select2-4.0.1/dist/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="style/select2-bootstrap/dist/select2-bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.min.css">
	<link rel="stylesheet" type="text/css" href="style/jquery-ui/jquery-ui.min.css">
	<link href="style/style.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
  </head>
  <body class="body-admin">
  <div class="container">
  	<div class="row">
  		<div class="col-xs-12 text-center titre">Connexion au panneau d'administration</div>					
  	</div>
  	<div class="row">
  		<div class="col-xs-12 div-login text-center">
  			<div class="form-group">
  				<label>Login
  				<input type="text" id="login" class="form-control">
  			</div>
  			<div class="form-group">
  				<label>Mot de passe
  				<input type="password" id="mdp" class="form-control">
  			</div>
  			<button type="button" id="validerCo" class="btn btn-success">Valider</button>
  			<div class="fail"></div>
  		</div>
  	</div>		
  </div>
</div>
	<!-- --------------------------------------------------- -->
	<script src="js/jquery-1.12.0.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="style/jquery-ui/jquery-ui.min.js"></script>
	<script src="style/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
	<!-- Select 2 -->
	<script type="text/javascript" src="style/select2-4.0.1/dist/js/select2.js"></script>
	<!-- SWITCH RADIO -->
    <script type="text/javascript" src="style/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>
    <script type="text/javascript" src="js/scripts2.js"></script>
	<script type="text/javascript" src="js/plus-minus.js"></script>


  </body>
</html>
