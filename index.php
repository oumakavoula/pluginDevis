<?php
session_start();
require 'class/form_class.php';
require 'class/db_class.php';
$DB = new DB();
$form = new Form();
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
  <body>


	<div class="container">
		<div class="row row-header">

		  <div class="col-lg-12"><img src="img/header.png" class="img-responsive img-header"></div>

		</div> <!-- FIN ROW-HEADER -->
	</div> <!-- FIN CONTAINER -->

	<div class="row row-sub-header">
	  <div class="col-lg-12 col-sub-header">
		<div class="container">
		  <img src="img/puzzle-atlas-formations.png" class="img-responsive img-sub-header">
		</div><!-- FIN CONTAINER -->
	  </div><!-- FIN COL sub header -->
	</div><!-- FIN ROW sub header --> 

	<div class="container">
	  <div class="row">
		<form action="#" method="post" name="form_devis" id="form_devis">
			<?php include 'modal.php'; ?>
				<div class="cssload-loader-inner">
					<div class="cssload-cssload-loader-line-wrap-wrap">
						<div class="cssload-loader-line-wrap"></div>
					</div>
					<div class="cssload-cssload-loader-line-wrap-wrap">
						<div class="cssload-loader-line-wrap"></div>
					</div>
					<div class="cssload-cssload-loader-line-wrap-wrap">
						<div class="cssload-loader-line-wrap"></div>
					</div>
					<div class="cssload-cssload-loader-line-wrap-wrap">
						<div class="cssload-loader-line-wrap"></div>
					</div>
					<div class="cssload-cssload-loader-line-wrap-wrap">
						<div class="cssload-loader-line-wrap"></div>
					</div>
				</div>
		<div class="apresEnvoi alert">
			Votre devis a bien été pris en compte.
		</div>
		<div class="col-lg-5 form-left">
		<div class="erreur-fin-devis alert">
		<span class="glyphicon glyphicon-alert"></span> Veuillez remplir les champs marqués en rouge.
		</div>
		  <?php  
		 echo $form->text("nom_entreprise","nom_entreprise","Nom de l'entreprise","Entreprise"); ?>

		  <div class="radio radio-sexe">
			  <label for="radio-sexe-madame">
			  <input required type="radio" id="radio-sexe-madame" name="radio-sexe" value="madame">Madame</label>
						
			  <label for="radio-sexe-monsieur">
			  <input required type="radio" id="radio-sexe-monsieur" name="radio-sexe" value="monsieur">Monsieur</label>
		  </div>

   <?php echo $form->text("nom_contact","nom_contact","Nom du contact","Nom","required");

		 echo $form->text("prenom_contact","prenom_contact","Prénom du contact","Prénom","required");

		 echo $form->text("fonction_contact","fonction_contact","En qualité de","Fonction dans l'entreprise");

		 echo $form->email("email_contact","email_contact","Adresse email","Email","required");

		 echo $form->text("adresse_contact","adresse_contact","Adresse du contact","N° et nom de voie","required");
		 ?>
		 <div class="col-lg-4 col-cp">
		 <?php
		 echo $form->text("cp_contact","cp_contact","Code postal","Code Postal","required");
		 ?>
		 </div>

		 <div class="col-lg-8 col-ville">
		 <?php
		 echo $form->text("ville_contact","ville_contact","Ville","Ville","required");
		 ?>
		 </div>

		</div><!-- FIN COL LEFT -->

		<div class="col-lg-offset-2 col-lg-5 form-right">

			<div class="erreur-sql alert">
				<span class="glyphicon glyphicon-alert"></span> Une erreur est survenue, veuillez réessayer.
			</div>
			<div class="radio form-group tooltip-radio" data-toggle="tooltip" data-placement="right" title="Le compte personnel de formation permet de choisir une formation qualifiante ou certifiante favorisant l'évolution professionnelle.">
			  <p class="p-radio-cpf">Souhaitez-vous effectuer une formation dans le cadre du cpf ?
			  <input data-label-text="Choisir" data-handle-width="80" data-off-color="warning" data-indeterminate="true" type="checkbox" id="my-checkbox" name="cpf" value="oui" checked> <span class="link-cpf"><a target="_blank" href="http://www.moncompteformation.gouv.fr/"><u>Qu'est ce que le CPF ?</u></a></span>
		  </div>

			<div id="div-theme" class="form-group">
			</div>

				<div id="div-formation" class="form-group">
				</div>
				<div id="div-niveau" class="form-group">
				</div>
				<div id="div-version" class="form-group">
				</div>
				<div class="div-verif">
				</div>		
				 <button type="button" class="btn btn-primary" id="valider">Continuer</button>
			</div><!-- FIN COL RIGHT -->

	  </div> <!-- FIN ROW -->
	  <div id="tempo">
	  <?php include 'affPanier.php'; ?>
	  </div>
	  <div class="panier"></div>
		  </form>
	</div><!-- FIN CONTAINER -->
	<div id="div-vide"></div>
	<!-- --------------------------------------------------- -->
	<script src="js/jquery-1.12.0.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="style/jquery-ui/jquery-ui.min.js"></script>
	<script src="style/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
	<!-- Select 2 -->
	<script type="text/javascript" src="style/select2-4.0.1/dist/js/select2.js"></script>
	<!-- SWITCH RADIO -->
    <script type="text/javascript" src="style/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="js/plus-minus.js"></script>


  </body>
</html>
