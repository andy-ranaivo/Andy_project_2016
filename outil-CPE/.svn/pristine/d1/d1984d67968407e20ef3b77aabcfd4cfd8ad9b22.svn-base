function modifier_traitement(id){

	// DONNEES DU FORMULAIRE
	var form_data = {
		id_traitement_modif : $('#id_traitement_modif'+id).val(),
		libelle_traits_modif : $('#libelle_traits_modif'+id).val(),
		source_traits_modif : $('#source_traits_modif'+id).val(),
		flag_traits_modif : $('#flag_traits_modif'+id).val(),
		ajax : '1'
	};
	
	// TRAITEMENT AJAX DU FORMULAIRE
	$.ajax({
		url: url_js_modif_traits,
		type: 'POST',
		data: form_data,
		success: function(data) {

			
			// TRAITEMENT DES ERREURS
			if(data == 'erreur'){
				
				$('#message_error_modif'+id).html('<div class="alert alert-danger" align="center">Veillez réessayer ulterieurement !</div>');

			}else if(data == 'success'){
				window.location.href = url_acc_traits;
			}else{

				$('#message_error_modif'+id).html(data);					
			}

		}
	});

	return true;
}