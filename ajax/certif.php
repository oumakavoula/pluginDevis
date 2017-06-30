<?php
require '../class/db_class.php';
$DB = new DB();

$certif = '';
if (isset($_GET['erreur'])){
	$erreur=$_GET['erreur'];
}
if (isset($erreur)){

$data_certif = $DB->query('SELECT distinct nom_certification from certification cn, certifier cr
					  WHERE cr.id_certification = cn.id_certification
					  AND id_formation_a = :id ',
					  array('id' => $_GET['erreur'])
					  );
?>
	<label for="select_certif">Sélectionner le type de certification</label>
	<select id="select_certif" name="select_certif" class="select2js form-control">
	<option value="" selected disabled>Choisir une certification</option>		
		<?php
			foreach($data_certif as $uneCertif) {
				?>
				<option value="<?php echo $uneCertif->nom_certification; ?>"> <?php echo $uneCertif->nom_certification; ?> </option>
				<?php 
			}
?>
	</select>
<?php
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("select#select_certif").change(function(){
			var certif = $("select#select_certif option:selected").val();
			$.ajax({
				type:"GET",
				url:"ajax/prix_certif.php",
				data:{
					'certif' : certif
				},
				success: function(html){
					$("#prix-certif").html(html);
					$(".nb_certif").trigger("change");
				}
			});

		});
	});
</script>
<script type="text/javascript">
	$(".select2js").select2({minimumResultsForSearch: 5, theme: "bootstrap"});
	$("#select_certif").on("select2:close",function(){
	   	  $(".afterSelectChange").show();
	   });
</script>