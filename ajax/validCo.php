<?php 
	session_start();
	require '../class/db_class.php';
	$DB = new DB();

	extract($_POST);

	if(isset($login) && isset($mdp)){
		$verif = $DB->query('select * from admin');
		var_dump($verif);

		foreach ($verif as $uneVerif){
			if($uneVerif->login == $login && $uneVerif->mdp == $mdp){
				$_SESSION["login_user"]= $login;
			}
			else{
				?>
				<div class="erreur-login alert">Mauvais combo login / mot de passe</div>
				<?php
			}
		}

	}