function editer(idtraitement){
	
	var pont_data = {
			id_traitement : idtraitement,
			ajax : '1'
	};


	$.ajax({
		url: pont_editer,
		type: 'POST',
		data: pont_data,
		success: function(data) {
			window.location.href = data;	
		}
	});

	return true;
}    

function insert_nouveau_bouton(){
	libelle_in = document.getElementById("libelle_traits").value;
	redir_in = document.getElementById("proccs").value;
	var btn_data = {
		"txt_libelle" : libelle_in
		,"procid" : idbout_processus
		,"procred" : redir_in
	};

	$.ajax({
		url: url_add_btn,
		type: 'POST',
		data: btn_data,
		success: function(data) {
			window.location.href = data;	
		}
	});
	return true;
} 

function nouveau_bouton(ibtnp) {
	idbout_processus = ibtnp;
}      



