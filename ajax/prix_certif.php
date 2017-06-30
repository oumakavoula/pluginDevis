<?php
require '../class/db_class.php';
$DB = new DB();

if (isset($_GET['certif'])){

		$prix_certif = $DB->query('SELECT prix_unit_certif from certification where nom_certification = :nom',
		array('nom' => $_GET['certif'])
		);
?>

			<input type="hidden" id="prix_unit_certif" value="<?php echo $prix_certif[0]->prix_unit_certif ; ?>">

<?php
} // FIN IF ISSET

?>