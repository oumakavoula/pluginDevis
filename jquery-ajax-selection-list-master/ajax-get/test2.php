<?php 
//  require 'db_class.php';
//  $DB = new DB();
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
          <form action="#" method="POST" name="lol" id="form_devis">

                <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script> -->

                <script type="text/javascript" src="../jquery.js"></script>

                <script type="text/javascript">
                  jQuery(document).ready(function(){        
                    // when any option from country list is selected
                    jQuery("select[name='country']").change(function(){     
                      
                      // get the selected option value of country
                      var optionValue = jQuery("select[name='country']").val();   
                            
                      /**
                       * pass country value through GET method as query string
                       * the 'status' parameter is only a dummy parameter (just to show how multiple parameters can be passed)
                       * if we get response from data.php, then only the cityAjax div is displayed 
                       * otherwise the cityAjax div remains hidden
                       * 'beforeSend' is used to display loader image
                       * 'complete' is used to hide the loader image
                       */     
                      jQuery.ajax({
                        type: "GET",
                        url: "data.php",
                        data: "country="+optionValue+"&status=1",
                        success: function(response){
                          jQuery("#cityAjax").html(response);
                          jQuery("#cityAjax").show();
                        }
                      });      
                    });
                  });
                </script>

                <?php

                ?>

                Countries: 
                <select name="country">
                  <option value="">Please Select</option>
                  <option value="1">Nepal</option>
                  <option value="2">India</option>
                  <option value="3">China</option>
                  <option value="4">USA</option>
                  <option value="5">UK</option>
                </select>

                <div id="cityAjax" style="display:none">
                  <select name="city">
                    <option value="">Please Select</option>
                  </select>
                </div>
                <button type="submit">ok</button>
          </form>
<?php var_dump($_POST); ?>
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
