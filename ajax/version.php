<?php
require '../class/db_class.php';
$DB = new DB();
if (isset($_GET['formation'])) {
	$formation = $_GET['formation'];
}
if (isset($_GET['niveau'])) {
	$niveau = $_GET['niveau'];
}

$cpf = $_GET['cpf'];

if(!$formation) {
	return false;
}

	if (isset($formation) && isset($niveau) && $cpf =='false'){
		$data_version = $DB->query('SELECT version_formation_a from formation_atlas where nom_formation_a = :formation and niveau_formation_a = :niveau',
                        array('formation' => $_GET['formation'],
                        	  'niveau' => $_GET['niveau'])
                        );
	}else{
		$data_version = $DB->query('SELECT version_formation_a from formation_atlas fa, formation_cpf fc 
									where fa.id_formation_a = fc.id_formation
									and nom_formation_a = :formation and niveau_formation_a = :niveau and cadre_cpf = \'oui\' ',
                        array('formation' => $_GET['formation'],
                        	  'niveau' => $_GET['niveau'])
                        );
	}

?>
	<input type="hidden" value="<?= $_GET['cpf']; ?>" id="input-cpf">
	<label for="select_version">Sélectionner une version</label>
	<select id="select_version" name="select_version" class="select2js form-control">
	<option value="" selected disabled>Choisir une version</option>		
		<?php
		if ($data_version[0]->version_formation_a != null || count($data_version) > 1){

			foreach($data_version as $uneVersion) {
				?>
				<option value="<?php echo $uneVersion->version_formation_a; ?>"> <?php echo $uneVersion->version_formation_a; ?> </option>
				<?php 
			}
		}
		else{
			?><option value="aucune">Aucune version spécifique pour cette formation</option>
		<?php
		}
		?>
	</select>

    <script type="text/javascript">
      $(document).ready(function() {
	      $(".select2js").select2({minimumResultsForSearch: 5, theme: "bootstrap"});
	      $(".select2js").on("select2:close",function(){
				$("#valider").show();
					var theme = $('#select_theme').val();
					var formation = $('#select_formation').val();
					var niveau = $('#select_niveau').val();
					var version = $('#select_version').val();
					var cpf = ($('#my-checkbox').bootstrapSwitch('state'));
					var erreur = $('#input-id-formation').val();

					$.ajax({
					type:"GET",
					url:"ajax/verif-select.php",
					data:{
						'theme':theme,
						'formation':formation,
						'niveau':niveau,
						'version':version,
						'cpf':cpf
					},
						success: function(html){
							$(".div-verif").html(html);	
						}
					});
				});

      });
    </script>