<?php 
  require 'db_class.php';
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
    <link rel="stylesheet" type="text/css" href="style/select2-bootstrap-theme-master/dist/select2-bootstrap.min.css">
    <link href="style/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<?php include('form_value.php'); ?>
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
        <div class="col-lg-5 form-left">
          <form action="#" method="POST" id="form_devis">

            <div class="form-group">
              <label for="nom_entreprise">Nom de l'entreprise </label>
              <input type="text" id="nom_entreprise" class="form-control" placeholder="Entreprise" name="nom_entreprise" <?php echo form_value('nom_entreprise','text'); ?> >
            </div>

            <div class="radio">
              <label for="radio-sexe-madame">
                <input type="radio" id="radio-sexe-madame" name="radio-sexe" value="madame" <?php echo form_value('radio-sexe', 'radio','madame') ;?> >
                Madame
                        <label for="radio-sexe-monsieur">
                          <input type="radio" id="radio-sexe-monsieur" name="radio-sexe" value="monsieur" <?php echo form_value('radio-sexe', 'radio','monsieur') ;?> >
                          Monsieur
                        </label>
              </label>
            </div>
            <div class="form-group">
              <label for="nom_contact">Nom du contact</label>
              <input type="text" id="nom_contact" class="form-control" placeholder="Nom" name="nom_contact" <?php echo form_value('nom_contact','text'); ?>>
            </div>

            <div class="form-group">
              <label for="prenom_contact">Prénom du contact</label>
              <input type="text" id="prenom_contact" class="form-control" placeholder="Prénom" name="prenom_contact" <?php echo form_value('prenom_contact','text'); ?>>
            </div>

            <div class="form-group">
              <label for="fonction_contact">En qualité de </label>
              <input type="text" id="fonction_contact" class="form-control" placeholder="Fonction dans l'entreprise" name="fonction_contact" <?php echo form_value('fonction_contact','text'); ?>>
            </div>

            <div class="form-group">
              <label for="email_contact">Adresse email</label>
              <input type="email" id="email_contact" class="form-control" placeholder="Email" name="email_contact" <?php echo form_value('email_contact','text'); ?>>
            </div>

            <div class="form-group">
              <label for="adresse_contact">Adresse</label>
              <input type="text" id="adresse_contact" class="form-control" placeholder="N° et nom de voie" name="adresse_contact" <?php echo form_value('adresse_contact','text'); ?>>
            </div>

            <div class="col-lg-4 col-cp">
              <div class="form-group">
                <label for="cp_contact">Code postal</label>
                <input type="text" id="cp_contact" class="form-control" placeholder="Code postal" name="cp_contact" <?php echo form_value('cp_contact','text'); ?>>
              </div>
            </div>

            <div class="col-lg-8 col-ville">
              <div class="form-group">
                    <label for="ville_contact">Ville</label>
                <input type="text" id="ville_contact" class="form-control" placeholder="Ville" name="ville_contact" <?php echo form_value('ville_contact','text'); ?>>
              </div>
            </div>


        </div> <!-- FIN COL FORM LEFT -->

            <div class="col-lg-offset-2 col-lg-5 form-right">

            <div class="form-group">
                  <?php                  
                      $data_theme = $DB->query('SELECT distinct theme_formation_a from formation_atlas');
                  ?>
              <label for="select_theme">Sélectionner un thème</label>
                <select id="select_theme" name="select_theme" class="form-control" onchange="funcSubmit()">
                  <option value="" selected>Tous les thèmes</option>
                  <?php foreach ($data_theme as $unTheme) {
                     ?> <option value="<?php echo $unTheme->theme_formation_a ;?>" <?php echo form_value('select_theme','select',$unTheme->theme_formation_a);  ?>><?php echo $unTheme->theme_formation_a ;?></option> <?php
                  } ?>

                </select>
            </div>

            <div class="form-group">
                  <?php
                    if (isset($_POST['select_theme']) AND !$_POST['select_theme'] =='' ){                  
                        $data_formation = $DB->query('SELECT distinct nom_formation_a from formation_atlas where theme_formation_a = :theme',
                          array('theme' => $_POST['select_theme'])
                          );
                    }
                    else {
                      $data_formation = $DB->query('SELECT distinct nom_formation_a from formation_atlas');
                    
                    }
                  ?>
              <label for="select_formation">Sélectionner une formation</label>
                <select id="select_formation" name="select_formation" class="form-control" onchange="funcSubmit()">
                  <option value="" selected disabled>Choisir une formation</option>
                  <?php foreach ($data_formation as $uneFormation) {
                     ?> <option value="<?php echo $uneFormation->nom_formation_a ;?>" <?php echo form_value('select_formation','select',$uneFormation->nom_formation_a);  ?>><?php echo $uneFormation->nom_formation_a ;?></option> <?php
                  } ?>
                </select>
            </div>

            <div class="form-group">
              <?php
                if (isset($_POST['select_formation'])){
                  $data_niveau = $DB->query('SELECT distinct niveau_formation_a from formation_atlas where nom_formation_a = :nom',
                    array('nom' => $_POST['select_formation'])
                    );
                }

              ?>
              <label for="select_niveau">Sélectionner un niveau</label>
                <select id="select_niveau" class="form-control" name="select_niveau" onchange="funcSubmit()">
                  <?php foreach ($data_niveau as $unNiveau) {
                    ?> <option value="<?php echo $unNiveau->niveau_formation_a ;?>"<?php echo form_value('select_niveau','select',$unNiveau->niveau_formation_a);  ?>><?php echo $unNiveau->niveau_formation_a ;?></option>
                    <?php
                  } ?>
                </select>
            </div>

            <div class="form-group">
              <?php 
                if (isset($_POST['select_niveau']) && isset($_POST['select_formation'])) {
                  $data_version = $DB->query('SELECT distinct version_formation_a from formation_atlas where nom_formation_a = :nom
                    and niveau_formation_a = :niveau',
                    array('nom' => $_POST['select_formation'],
                          'niveau' => $_POST['select_niveau']
                      )
                    );
                } ?>
              <label for="select_version">Sélectionner une version</label>
                <select id="select_version" class="form-control" name="select_version" onchange="funcSubmit()">
                  <?php foreach ($data_version as $uneVersion) { ?>
                    <option value="<?php echo $uneVersion->version_formation_a ;?>"<?php echo form_value('select_version','select',$uneVersion->version_formation_a); ?>><?php echo $uneVersion->version_formation_a ;?></option>
                  <?php 
                } ?>
                </select>
            </div>



            <button type="submit">test</button>
            </div> <!-- FIN COL FORM RIGHT -->
            
            <?php
              var_dump($_POST);
            ?>

          </form>

      </div> <!-- FIN ROW -->
    </div><!-- FIN CONTAINER -->

    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------- -->
    <script type="text/javascript" src="test.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="style/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <!-- Select 2 -->
    <script type="text/javascript" src="style/select2-4.0.1/dist/js/select2.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
      $(".select2js").select2();
      });
    </script>


  </body>
</html>
