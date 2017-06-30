<?php
require '../class/db_class.php';
$DB = new DB();

$cpf = $_GET['cpf'];

if(!$cpf) {
  return false;
}

  
    if ($cpf == 'false'){          
      $data_theme = $DB->query('SELECT distinct theme_formation_a from formation_atlas');
    }else{
      $data_theme = $DB->query('SELECT distinct theme_formation_a from formation_atlas, formation_cpf
                                WHERE formation_atlas.id_formation_a=formation_cpf.id_formation
                                AND cadre_cpf = \'oui\' ');
    }
      ?>
      <input type="hidden" value="<?= $_GET['cpf']; ?>" id="input-cpf">
    <label for="select_theme">Sélectionner un thème</label>
    <select name="select_theme" id="select_theme" class="select2js form-control">
      <option selected disabled>Choisir un thème</option>
      <?php if ($cpf == 'false'){ ?>
      <option value="tous">Tous les thèmes</option>
      <?php } ?>
      <?php foreach ($data_theme as $unTheme) {
         ?> <option value="<?php echo $unTheme->theme_formation_a ;?>"><?php echo $unTheme->theme_formation_a ;?></option> <?php
      } ?>

    </select>

<script type="text/javascript">
    $(document).ready(function(){
        $("select#select_theme").change(function(){
          var theme = $("select#select_theme option:selected").val();
          var cpf = $("#input-cpf").val();    
          $.ajax({
            type:"GET",
            url:"ajax/formation.php",
            data:{'theme':theme,
                  'cpf':cpf},
            async : true,
            success: function(html){
              $("#div-formation").html(html);
            }
          }); 
        });
    });
</script>
    <script type="text/javascript">
      $(document).ready(function() {
      $(".select2js").select2({minimumResultsForSearch: 5,theme: "bootstrap"});
      $(".select2js").on("change",function(){
          resetFields(3);

       });
      });
    </script>