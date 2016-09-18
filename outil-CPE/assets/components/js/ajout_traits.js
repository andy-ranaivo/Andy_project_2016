function ajout_traitement(){

	var nouveau_source_traits = document.getElementById("nouveau_source_traits").value;
	var source_traits = document.getElementById("source_traits").value;
	var source_vrai;

	if(typeof nouveau_source_traits != undefined && typeof nouveau_source_traits != null && nouveau_source_traits != ''){
		source_vrai = nouveau_source_traits;
	}else{
		source_vrai = source_traits;		
	}

	// DONNEES DU FORMULAIRE
		var form_data = {
			libelle_traits : $('#libelle_traits').val(),
			source_traits : source_vrai,
			ajax : '1'
		};
		
		// TRAITEMENT AJAX DU FORMULAIRE
		$.ajax({
			url: url_js_traits,
			type: 'POST',
			data: form_data,
			success: function(data) {

				
				// TRAITEMENT DES ERREURS
				if(data == 'erreur'){
					
					$('#message_error').html('<div class="alert alert-danger" align="center">Veillez réessayer ulterieurement !</div>');

				}else if(data == 'success'){
					window.location.href = url_acc_traits;
				}else{

					$('#message_error').html(data);					
				}

			}
		});

		return true;
}