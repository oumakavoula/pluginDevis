<?php
require '../class/db_class.php';
$DB = new DB();

if (isset($_GET['theme'])){
$theme = $_GET['theme'];}

if (isset($_GET['formation'])){
$formation = $_GET['formation'];}

if (isset($_GET['niveau'])){
$niveau = $_GET['niveau'];}

if (isset($_GET['version'])){
$version = $_GET['version'];}

if (isset($_GET['cpf'])){
$cpf = $_GET['cpf'];}

$sql='';
$res = null;
if (isset($theme) && isset($formation) && isset($niveau) && isset($version) && isset($cpf)){
	if ( $version != 'aucune' && $cpf='false' ){
$res = $DB->query( 'SELECT id_formation_a 
					FROM formation_atlas 
					WHERE nom_formation_a = :formation 
					AND niveau_formation_a = :niveau 
					AND version_formation_a = :version',
	                array('formation' => $_GET['formation'],
	                	 'niveau' => $_GET['niveau'],
	                	 'version' => $_GET['version']
	                ));
	}
	elseif ( $version != 'aucune' && $cpf == 'true' ){
$res = $DB->query( 'SELECT id_formation_a 
					FROM formation_atlas,formation_cpf
					WHERE formation_atlas.id_formation_a = formation_cpf.id_formation
					AND nom_formation_a = :formation 
					AND niveau_formation_a = :niveau 
					AND version_formation_a = :version
					AND cadre_cpf=\'oui\' ',
					array('formation' => $_GET['formation'],
	                	 'niveau' => $_GET['niveau'],
	                	 'version' => $_GET['version']
	                ));
		}
	elseif ( $version == 'aucune' && $cpf =='false' ){
$res = $DB->query( 'SELECT id_formation_a 
					FROM formation_atlas 
					WHERE nom_formation_a = :formation 
					AND niveau_formation_a = :niveau ',
					array('formation' => $_GET['formation'],
	                	 'niveau' => $_GET['niveau']
	                ));
	}
	elseif ( $version == 'aucune' && $cpf == 'true' ){
$res = $DB->query( 'SELECT id_formation_a 
					FROM formation_atlas,formation_cpf
					WHERE formation_atlas.id_formation_a = formation_cpf.id_formation
					AND nom_formation_a = :formation 
					AND niveau_formation_a = :niveau 
					AND cadre_cpf=\'oui\' ',
					array('formation' => $_GET['formation'],
	                	 'niveau' => $_GET['niveau']
	                ));
	}

}


if (count($res) == 1) {
?>
	<input type="hidden" id="input-id-formation" value="<?php echo $res[0]->id_formation_a; ?>">
<?php
}
else{
	?>
	<input type="hidden" id="input-id-formation" value="erreur">
<?php } ?>




