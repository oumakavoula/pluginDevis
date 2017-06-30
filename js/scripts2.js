$(document).ready(function(){

	$(document).on("click", "#validerCo", function () {
		var login = $("#login").val();
		var mdp = $("#mdp").val();
        console.log(login + mdp);

    	$.ajax({
    		type : 'POST',
    		url : 'ajax/validCo.php',
    		data : { 
    			'login':login,
    			'mdp' :mdp
    		},
    		success : function(html){
    			$(".fail").html(html);
    		}
    	});// FIN AJAX

    });

});