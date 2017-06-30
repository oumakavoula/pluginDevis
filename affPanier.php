<?php 

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
	if(count($_SESSION["panier"]) != 0){
		?>
		<button id="fin-devis" type="button" class="fin-devis btn btn-success">Finaliser votre devis</button>
		<?php 
	}// FIN IF
}// FIN IF ISSET SESSION
?>