<?php
require '../class/db_class.php';
$DB = new DB();

$formation = $_GET['nom_formation'];
$cpf = $_GET['cpf'];

if(!$formation) {
	return false;
}

	if (isset($formation) && $cpf == 'false'){
		$data_niveau = $DB->query('SELECT distinct niveau_formation_a from formation_atlas where nom_formation_a = :formation',
                        array('formation' => $_GET['nom_formation'])
                        );
	}else{
		$data_niveau = $DB->query('SELECT distinct niveau_formation_a from formation_atlas fa, formation_cpf fc
								   where fa.id_formation_a = fc.id_formation
								   and nom_formation_a = :formation
								   and cadre_cpf = \'oui\' ',
                        array('formation' => $_GET['nom_formation'])
                        );
	}

?>
	
	<input type="hidden" value="<?= $_GET['nom_formation']; ?>" id="formation">
	<input type="hidden" value="<?= $_GET['cpf']; ?>" id="input-cpf">
	<label for="select_niveau">Sélectionner un niveau</label>
	<select id="select_niveau" name="select_niveau" class="select2js form-control">
		<option value="" selected disabled>Choisir un niveau</option>
		<?php
		foreach($data_niveau as $unNiveau) {
			?>
			<option value="<?php echo $unNiveau->niveau_formation_a; ?>"> <?php echo $unNiveau->niveau_formation_a; ?> </option>
			<?php 
		}
		?>
	</select>

<script type="text/javascript">
	$(document).ready(function(){
		$("select#select_niveau").change(function(){
			var niveau = $("select#select_niveau option:selected").val();
			var formation = $("#formation").val();
			var cpf = $("#input-cpf").val();
			$.ajax({
				type:"GET",
				url:"ajax/version.php",
				data:{
					'niveau' : niveau,
					'formation' : formation, 'cpf':cpf
				},
				success: function(html){
					$("#div-version").html(html);
				}
			});

		});
	});
</script>
    <script type="text/javascript">
      $(document).ready(function() {
      $(".select2js").select2({minimumResultsForSearch: 5, theme: "bootstrap"});
      $(".select2js").on("change",function(){
		   	  resetFields(1);

		   });
      });
    </script>