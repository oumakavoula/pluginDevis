// RESET X SELECT 
function resetFields(x){
	if(x == 1){
		$('#select_version').prop('selectedIndex',0);
		$('.display-none').css('display','none');
	}
	else if(x == 2){
		$('#select_niveau').prop('selectedIndex',0);
		$('#select_version').prop('selectedIndex',0);
		$('.display-none').css('display','none');
	}
	else if(x == 3){
		$('#select_formation').prop('selectedIndex',0);
		$('#select_niveau').prop('selectedIndex',0);
		$('#s elect_version').prop('selectedIndex',0);
		$('.display-none').css('display','none');
	}
	else{
		$('#select_theme').prop('selectedIndex',0);
		$('#select_formation').prop('selectedIndex',0);
		$('#select_niveau').prop('selectedIndex',0);
		$('#select_version').prop('selectedIndex',0);
		$('.display-none').css('display','none');
	}
}

function redFields(){
	$(".radio-sexe").css('color','red');
	$(".required").css('color','red');
}

function blackFields(){
	$(".radio-sexe").css('color','black');
	$(".required").css('color','black');
}

$(document).ready(function(){
	// ACTIVE SELECT2, CHANGE LE THEME PR BOOTSTRAP ET AFFICHE LA BARRE DE RECHERCHE A PARTIR DE 5 <option>
	$(".select2js").select2({minimumResultsForSearch: 5, theme: "bootstrap"});
	// ACTIVE LES TOOLTIP
	$('[data-toggle="tooltip"]').tooltip();
	// ACTIVE LE BOUTON CPF 
	$("#my-checkbox").bootstrapSwitch();

	// ENVOIE LE THEME A FORMATION.PHP
	$("select#select_theme").change(function(){
		var theme = $("select#select_theme option:selected").attr('value');

		$.ajax({
			type:"GET",
			url:"ajax/formation.php",
			data:"theme="+theme,
			async : true,
			success: function(html){
				$("#div-formation").html(html);
			}
		});	
	});
	// VARIABLES 
	var session = 'prix_inter_a';
  	var stagiaire = null;
  	var idformation = null;

    
  	// BOUTON CONTINUER
	$('#valider').click(function(){
		var theme = $('#select_theme').val();
		var formation = $('#select_formation').val();
		var niveau = $('#select_niveau').val();
		var version = $('#select_version').val();
		var cpf = $('#my-checkbox').bootstrapSwitch('state');
		var erreur = $('#input-id-formation').val();
		
		//TRIGGER DU NOMBRE DE STAGIAIRES 
		$("#nb_stagiaires").trigger("change");

		// AFFICHE SOIS LE MODAL SOIS UNE ERREUR
		if(theme != null && formation != null && niveau != null && version != null && 
			typeof theme != 'undefined' && typeof formation != 'undefined' && typeof niveau != 'undefined' && typeof version != 'undefined' 
			&& erreur != 'erreur'){
			$('.erreur-sql').slideUp(1000);
			$('.display-none').css('display','block');
			$('#myModal').modal('show');


		// ICI LA REQUETE SENVOIE SI SUR LE FORMULAIRE LE CPF EST A 'OUI'
			if (cpf == true){
				$.ajax({
					type:"GET",
					url:"ajax/certif.php",
					data:{
						'erreur':erreur
					},
					success: function(html){
						$(".div-certif").html(html);
					}
				});
				$('.modal-cpf').show();
				$("#div-duree").removeClass("col-lg-offset-7");
				$(".afterSelectChange").hide();
			}
			else{ $('.modal-cpf').hide();
				  $("#div-duree").addClass("col-lg-offset-7");
			}

		}
		else{
			$('.erreur-sql').slideDown(1000);
			$('.display-none').css('display','none');
		}

	});
	// CHANGE LA VALEUR DE SESSION EN FONCTION DU BOUTON RADIO
	$('input:radio[name=session]').change(function() {
        if (this.value == 'inter') {
        	session = 'prix_inter_a';
        	resetNbStagiaires();

        }
        else if (this.value == 'intratlas') {
        	session = 'prix_intra_a_atlas';
        	resetNbStagiaires();

        }
        else if (this.value == 'intraclient'){
        	session = 'prix_intra_a_client';
        	resetNbStagiaires();

        }
        else{
        	session = 'prix_inter_a';
        	resetNbStagiaires();
        }
        // TRIGGER DE LA REQUETE AJAX VERS CALCUL_PRIX.PHP
        triggerAjaxPrix();
    });
	
	// ENVOIE L'ID DE LA FORMATION ET LE NOMBRE DE STAGIAIRE POUR CALCULER LE PRIX (CALCUL_PRIX.PHP)
    $("#nb_stagiaires").change(function(){
    	idformation = $('#input-id-formation').val();
    	stagiaire = $("#nb_stagiaires").val();
    	var maxi = $("#maxi-pers").val();
		$("#nb_stagiaires").attr("max",maxi);
    	triggerAjaxPrix();
    	if ($("#nb_stagiaires").val() !=1 ){
				$('#td-prix').animate({backgroundColor : "#78909c"},200, function(){$('#td-prix').css('background-color','transparent');});
			}

	});
    // AJAX VERS CALCUL_PRIX.PHP, RETOURNE LE PRIX ET LA DUREE DE LA FORMATION CHOISIE
	function triggerAjaxPrix(){
		$.ajax({
    		type:"GET",
    		url:"ajax/calcul_prix.php",
    		data :{
    			'stagiaire' : stagiaire,
    			'idformation' : idformation,
    			'session' : session
    		},
    		success: function(html){
    			$("#prix").html(html);
    			if($("#prix-jour").val() != "non" ){
    				$("#td-prix").text($("#prix-jour").val() + " € HT");
    			}
    			else{
    				$("#td-prix").text("Formation non disponible pour ce type de session.");
    			}
    			var duree = $("#duree-formation").val();
    			$("#td-duree").text(duree);
    			$('#td-maxi-pers').text($("#maxi-pers").val());
    			$('#td-prix-total').text( ($("#prix-jour").val() * $("#duree-formation").val()).toFixed(2) + " € HT" );
    			if ( duree == 1 ){
    				$('#span-jour-formation').text(duree + " jour");
    			}
    			else{
    				$('#span-jour-formation').text(duree + " jours");
    			}
    			calculTotal();
    		}
    	});
	}
	// RESET LES CHAMPS QUAND LE MODAL EST FERME
    $("#close-modal").click(function(){
    	$('#total-certif').empty();
    	$('#p-prix-certif').empty();
    	resetNbStagiaires();
    });

    // RECUPERE LE PRIX UNITAIRE DE LA CERTIF CHOISIE, LE MULTIPLIE PAR LE NOMBRE DE CERTIF DESIRE ET L'AFFICHE
	$(".nb_certif").change(function(){
		$("#td-prix-certif").text($("#prix_unit_certif").val() + " € HT");
		$("#input-attr").attr("max",$("#maxi-pers").val());
		var certif = $('#select_certif').val();
		if( typeof certif != undefined && certif != null){
			$("#div-prix-certif").show();
			var prix = $('#prix_unit_certif').val();
			var nbcertif = $(".nb_certif").val();
			$('#td-total-certif').text((nbcertif * prix).toFixed(2) + " € HT");

			if ($(".nb_certif").val() !=1 ){
				$('#td-total-certif').animate({backgroundColor : "#fb8c00"},200, function(){$('#td-total-certif').css('background-color','transparent');});
			}
		}
		calculTotal();
	});

      

	// ENVOIE A THEME.PHP SI LA FORMATION EST CPF OU PAS, RESET TOUS LES SELECT
	$('#my-checkbox').on('switchChange.bootstrapSwitch', function () {
		var cpf = ($('#my-checkbox').bootstrapSwitch('state'));
		resetFields(4);

		$.ajax({
			type:"GET",
			url:"ajax/theme.php",
			data:"cpf="+cpf,
			async : true,
			success: function(html){
			  $("#div-theme").html(html);
			}
		}); 
	});

	function resetNbStagiaires(){
		$("#nb_stagiaires").val("1");
		$("#input-attr").val("1");
		$("#nb_stagiaires").trigger("change");
		$(".nb_certif").trigger("change");
	}

	function calculTotal(){
		var prixJour = $("#prix-jour").val();
		var duree = $("#duree-formation").val();
		var tva = 1.2;
		var totalCertif = $('#prix_unit_certif').val() * $(".nb_certif").val();
		var cpf = ($('#my-checkbox').bootstrapSwitch('state'));
		var total = 0;
		if (cpf == false){
			total = (prixJour * duree)
		}
		else{
			total = ((prixJour * duree) + totalCertif)
		} 
		$("#td-total-ht").text( total.toFixed(2) + " € HT");
		$("#td-total-ttc").text( (total * tva).toFixed(2) + " € TTC");
	}
	var i = 0;
	// BOUTON POST MODAL
	$('#post-modal').click(function(){
		$(".fin-devis").show();
		var cpf = ($('#my-checkbox').bootstrapSwitch('state'));
		var nbcertif = $(".nb_certif").val();
		var certif = $('#select_certif').val();
		var id = $('#input-id-formation').val();
		var theme = $('#select_theme').val();
		var formation = $('#select_formation').val();
		var niveau = $('#select_niveau').val();
		var version = $('#select_version').val();
		var nbStagiaires = $('#nb_stagiaires').val();

		$.ajax({
			type:"POST",
			url:"ajax/ajoutPanier.php",
			data : {
				'cpf' : cpf,
				'nbcertif':nbcertif,
				'certif':certif,
				'id':id,
				'theme':theme,
				'formation':formation,
				'niveau':niveau,
				'version':version,
				'i':i,
				'session':session,
				'nbStagiaires':nbStagiaires

			},
			success : function(html){
				$('#tempo').hide();
				$('.panier').html(html);
				$('.fin-devis').show();
			}
		}); // FIN AJAX
		i = i + 1;
	});

	$(document).on("click", ".fin-devis", function () {
		console.log("lol");
		var nom = $("#nom_contact").val();
		var prenom = $("#prenom_contact").val();
		var entreprise = $("#nom_entreprise").val();
		var fonction = $("#fonction_contact").val();
		var email = $("#email_contact").val();
		var adresse = $("#adresse_contact").val();
		var cp = $("#cp_contact").val();
		var ville = $("#ville_contact").val();
		var sexe = $('input[name=radio-sexe]:checked', '#form_devis').val();

		if(nom == 'undefined' || nom == '' || prenom == 'undefined' || prenom == '' || email == 'undefined' || email == '' || adresse == 'undefined' || adresse == '' || 
			cp == 'undefined' || cp == '' || ville == 'undefined' || ville == '' || sexe == 'undefined' || sexe == '' ){
			$(".erreur-fin-devis").slideDown(1000);
			redFields();
		}
		else{
			$(".erreur-fin-devis").slideUp(1000);
			blackFields();
			$(".cssload-loader-inner").show();
			$.ajax({
				type : 'GET',
				url : 'ajax/finDevis.php',
				data : {
					'nom' : nom,
					'prenom' : prenom,
					'entreprise' : entreprise,
					'fonction' : fonction,
					'email' : email,
					'adresse' : adresse,
					'cp' : cp,
					'ville' : ville,
					'sexe' : sexe
				},
				success : function(html){
					$(".apresEnvoi").slideDown(1000);
					$(".cssload-loader-inner").hide();
					$.ajax({
						type : 'GET',
						url : 'ajax/viderPanier.php',
						success : function(){
						location.reload();	
						}
					})
					
				}
			});
		}

	});

	$(document).on("click", ".suppr", function () {
    	$(this).parent('div').fadeOut();
    	var idPanier = $(this).val();

    	$.ajax({
    		type : 'GET',
    		url : 'ajax/supprPanier.php',
    		data : { 'idPanier':idPanier},
    		success : function(html){
    			$("#div-vide").html(html);
    			console.log($("#vide").val());
    			if($("#vide").val()=='0'){
    				$(".fin-devis").hide();
    				$("#vide").remove();
    			}
    		}
    	});// FIN AJAX
	});


}); // FIN DOCUMENT.READY
