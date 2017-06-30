<?php 
	session_start();
	require '../class/db_class.php';
	$DB = new DB();


	foreach ($_SESSION["panier"] as $key => $value) {
		var_dump($value["idCertif"]);
	}


	$t=time();
	$lol=(date("Y-m-d H:i:s",$t));
	var_dump($lol);


	$certif = 'tosa';
	$idCertif = $DB->query('select id_certification from certification where nom_certification = :nom',
						array('nom'=>$certif));

	$test = get_object_vars($idCertif['0']);
	$lol = implode($test);
	var_dump($lol);
?>