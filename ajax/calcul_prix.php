<?php
require '../class/db_class.php';
$DB = new DB();
$prix=null;
if (isset ($_GET['idformation'])){
	$idformation = $_GET['idformation'];
}

if (isset($_GET['stagiaire'])){
	$stagiaire = $_GET['stagiaire'];
}

if (isset($_GET['session'])){
	$session = $_GET['session'];
}

if(isset($idformation) && isset($stagiaire) && isset($session)){
	if($session == 'prix_inter_a'){
		$prix = $DB->query('select prix_inter_a from tarif_atlas where id_formation_a = :id and nb_pers_a = :nb',
			array('id' => $_GET['idformation'],
				  'nb' => $_GET['stagiaire'])
		);
	}
	if($session == 'prix_intra_a_atlas'){
		$prix = $DB->query('select prix_intra_a_atlas from tarif_atlas where id_formation_a = :id and nb_pers_a = :nb',
			array('id' => $_GET['idformation'],
				  'nb' => $_GET['stagiaire'])
		);
	}
	if($session == 'prix_intra_a_client'){
		$prix = $DB->query('select prix_intra_a_client from tarif_atlas where id_formation_a = :id and nb_pers_a = :nb',
			array('id' => $_GET['idformation'],
				  'nb' => $_GET['stagiaire'])
		);
	}
	$duree= $DB->query('select nb_jours_formation_a from formation_atlas where id_formation_a = :id',
		array('id' => $_GET['idformation'])
		);
	$max= $DB->query('select pers_maxi_a from formation_atlas where id_formation_a = :id',
		array('id' => $_GET['idformation'])
		);
		?>

			<?php if($session =='prix_inter_a'){ 

				if ($prix[0]->prix_inter_a != null){
					?> <input type="hidden" id="prix-jour" value ="<?php echo $prix[0]->prix_inter_a  ;  ?>"> <?php
				}
				else{
					?> <input type="hidden" id="prix-jour" value ="non"> <?php
					}

 				} 
 				elseif($session == 'prix_intra_a_atlas'){ 
				?> <input type="hidden" id="prix-jour" value="<?php echo $prix[0]->prix_intra_a_atlas ; ?>"> <?php
			 	}
			 	elseif($session == 'prix_intra_a_client'){ 

				?> <input type="hidden" id="prix-jour" value="<?php echo $prix[0]->prix_intra_a_client ; ?> "> <?php

   				} ?>

			<input type="hidden" id="duree-formation" value="<?php echo $duree[0]->nb_jours_formation_a ?>" >

			<input type="hidden" id="maxi-pers" value="<?php echo $max[0]->pers_maxi_a ?>">

<?php
} // FIN DU IF ISSET
?>

