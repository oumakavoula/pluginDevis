<?php 
	session_start();
	require '../class/db_class.php';
	$DB = new DB();

	extract($_GET);

	$lastInsert = $DB->insertDemandeFunc('INSERT INTO demande (nom_entreprise,nom_contact,prenom_contact,email_contact,adresse_contact,cp_contact,ville_contact,sexe_contact,fonction_contact) 
		VALUES (:entreprise, :nom, :prenom, :email, :adresse, :cp, :ville, :sexe, :fonction)',
		array('entreprise' => $entreprise,
			  'nom' => $nom,
			  'prenom' => $prenom,
			  'email' => $email,
			  'adresse' => $adresse,
			  'cp' => $cp,
			  'ville' => $ville,
			  'sexe' => $sexe,
			  'fonction' => $fonction
			));

	foreach ($_SESSION['panier'] as $key => $value) {
		$t=time();
		$date=(date("Y-m-d H:i:s",$t));
		$DB->noReturnQuery('INSERT INTO devis_formation_atlas 
							VALUES (:idFormation, :idDemande, :dateCrea, :session, :lieu, :nbPers, :cpf, :idCertif, :nbCertif)',
							array('idFormation'=> $value["id"],
								  'idDemande'=> $lastInsert,
								  'dateCrea' => $date,
								  'session' => $value["nomSession"],
								  'lieu' => $value["lieu"],
								  'nbPers' => $value["nbStagiaires"],
								  'cpf' => $value["cpf"],
								  'idCertif' => $value["idCertif"],
								  'nbCertif' => $value["nbcertif"]
								  ));
		sleep(1);
	}


 ?>