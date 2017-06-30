<?php 
	session_start();
	require '../class/db_class.php';
	$DB = new DB();

	if (isset($_POST)) {
		extract($_POST);

		if (!isset($_SESSION['panier'])){
			$_SESSION['panier'] = array();
		}

		$taillePanier = count($_SESSION['panier']);

		if ($session == 'prix_inter_a'){
			$typeSession = 'inter-entreprises';
			$nomSession = 'inter';
			$lieu = 'atlas';
		}
		elseif($session == 'prix_intra_a_client'){
			$typeSession = 'intra-entreprise dans vos locaux';
			$nomSession = 'intra';
			$lieu = 'atlas';
		}
		else{
			$typeSession = 'intra-entreprise dans nos locaux';
			$nomSession = 'intra';
			$lieu = 'client';
		}

		if($cpf == 'true'){
			$queryCertif = $DB->query('select id_certification from certification where nom_certification = :nom',
						array('nom'=>$certif));
			$test = get_object_vars($queryCertif['0']);
			$idCertif = implode($test);
		}

		if ($cpf=='false'){
			$tabloTemporaire = array(
			'id' => $id,
			'cpf' => $cpf,
			'nbcertif' => null,
			'certif' => null,
			'theme' => $theme,
			'formation' => $formation,
			'niveau' => $niveau,
			'version' => $version,
			'session' => $typeSession,
			'nbStagiaires' => $nbStagiaires,
			'nomSession' => $nomSession,
			'lieu' => $lieu,
			'idCertif' => null
			);
		}
		else{
			$tabloTemporaire = array(
			'id' => $id,
			'cpf' => $cpf,
			'nbcertif' => $nbcertif,
			'certif' => $certif,
			'theme' => $theme,
			'formation' => $formation,
			'niveau' => $niveau,
			'version' => $version,
			'session' => $typeSession,
			'nbStagiaires' => $nbStagiaires,
			'nomSession' => $nomSession,
			'lieu' => $lieu,
			'idCertif' => $idCertif
			);
		}

		$_SESSION['panier'][$taillePanier] = $tabloTemporaire;

	}

if (isset($_SESSION['panier'])){
	$i = 0;
	foreach($_SESSION['panier'] as $key => $value){
			if ($value['cpf'] == 'false'){
				?>
					<div id="panier<?php echo $i;?>" class="row">
						<div class="col-lg-12">
							<div class="well"><b>Formation</b> : <span class="span-blue"><?php echo $value['formation']; ?> </span>
											  <b>Type de session</b> : <span class="span-blue"><?php echo $value['session']; ?></span>
											  <b>Nombre de stagiaires</b> : <span class="span-blue"><?php echo $value['nbStagiaires']; ?></span>
											  <button value="<?php echo $key;?>" class="suppr btn btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
							</div>
						</div>
					</div>
				<?php
			} // FIN IF
			else { 
			?>
			<div id="panier<?php echo $i;?>" class="row">
				<div class="col-lg-12">
					<div class="well"><b>Formation</b> : <span class="span-blue"><?php echo $value['formation']; ?> </span>
									  <b>Type de session</b> : <span class="span-blue"><?php echo $value['session']; ?></span>
									  <b>Nombre de stagiaires</b> : <span class="span-blue"><?php echo $value['nbStagiaires']; ?></span>
									  <b>Certification</b> : <span class="span-blue"><?php echo $value['certif']; ?></span>
									  <b>Nombre de certifications</b> : <span class="span-blue"><?php echo $value['nbcertif']; ?></span>
									  <button value="<?php echo $key;?>" class="suppr btn btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>

					</div>
				</div>
			</div>
			<?php
			} // FIN ELSE 
	$i++;
	}// FIN FOREACH
	?>
	<button class="fin-devis btn btn-success" type="button">Finaliser votre devis</button>
	<?php  
}// FIN IF ISSET SESSION
 ?>

