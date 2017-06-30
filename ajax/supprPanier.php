<?php 
	session_start();
	$id = $_GET['idPanier'];
	unset($_SESSION['panier'][$id]);
	if (count($_SESSION["panier"]) == 0){
		?>
		<input id="vide" type="hidden" value="0"></input>
		<?php
	}
 ?>