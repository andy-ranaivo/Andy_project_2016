 /* DEBUT DOCUMENT READY*/
   var btnenvoye= null;
   $(document).ready(function() {  
	
     
	$('#num_carte').keyup(function(){ 
	    verif();
	});
		
    $('#date_val').change(function(){
		   verifdate();
	})
	 
	verifcarte_date();
	/*Mois grisé inférieur mois courante*/
	  var today = new Date();
      $('#date_val').datepicker({
	  autoclose: true,
      minViewMode: 1,
      format: 'mm/yyyy',
    	language : 'fr',
       startDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())
      })
	/* fin Mois grisé inférieur mois courante*/
	
    /*CONTROLE NUMERO BANCAIRE*/
	$('#num_carte').keypress(validateNumber);
	$('#cvv').keypress(validateNumber);
	$('#montant').keypress(validateNumberDecimal);
	
		
	/* FIN CONTROLE NUMERO BANCAIRE*/	
     btnenvoye=$('#envoyer');
	
	/* click sur boutton envoyer*/
	btnenvoye.click(function(){
		btnenvoye.attr('disabled','disabled');
		//alert($.inArray('00105',['00000','00105','00108']));
		var datev=$("#datevalide").val();
		var coderep=$("#coderep").val();
		var ref=$("#ref").val();
		var numcb=$("#num_cb").val();
		var datevalide=datev.split(',');
		var codereponse=coderep.split(',');
		var ref_com=ref.split(',');
		var num_cb=numcb.split(',');
		//alert(coderep);
		var num=$("#num_carte").val();
		var datevalidite=$("#date_val").val();
		var dateval=datevalidite.split('/');
		var date_validite=dateval[1]+'-'+dateval[0];
		var refc=$("#reference").val();
		//var datecurrent=new Date();
		
	    var coderpvalide;
		var encaisse=0;
			for(var i=0;i<num_cb.length;i++){
				if( num == num_cb[i] && date_validite == datevalide[i] && refc == ref_com[i])
				{
					encaisse= encaisse+1;
					coderpvalide=codereponse[i];
					break;
				}
			}
			
	    if(encaisse ==1 && $.inArray(coderpvalide,['00000','00100','00105','00108','00151'])!=-1){
		
			$.Zebra_Dialog('<strong>'+'Carte bancaire déja encaissée pour la reférence commande<span style="color:red">'+' '+refc+' '+'</span></strong>', {
					    'type':     'error',
					    'title':    'Error',
						'buttons':  [
						{caption:'OK',callback:function(){ document.location.href="http://192.168.10.24/gpao2/paybox";}}
						]
					});
			
		}else{
			var input_type = $(".form-control.pull-right");
			var error = 0;
			
			$.each(input_type,function(){
			     if( $(this).val() =='')
				 {
				    $(this).css('border-color','red');
					 error = 1;		 
				 }else
				 {
				      $(this).css('border-color','');
				 }
			});
			if( error == 1 ) 
			{
			   $(".msg").html("Veuillez remplir le(s) champ(s) encadr\351(s) en rouge.");
			   return false;
			}else{ $(".msg").html("");}
			
			$.ajax({
				type : "POST",
				url  : "fonction.php",
				data : {
					num_carte : $('#num_carte').val(),
					date_val  : $('#date_val').val(),
					cvv       : $('#cvv').val(),
					montant   : $('#montant').val(),
					reference : $('#reference').val(),
					enseigne  : $('#enseigne').val()
				},
				success: function(res){
					//alert(res);
					var resultat;
					var type;
					var result = res.split('||');
					var val = result[1] * 1;
					if(val == '00000'*1 || val =='00108'*1 || val=='00100'*1){
						resultat="Transaction réussie";
						type='confirmation';
					}else if(val =='00105'*1 || val =='00151'*1){
						resultat="Carte à représenter";
						type='confirmation';
					}else{
						resultat="Transaction refusée, demander une nouvelle carte";
						type="warning";
					btnenvoye.attr('disabled',false);
						}
					$.Zebra_Dialog('<strong>'+resultat+'</strong>', {
					    'type':     type,
					    'title':    'Reponse'
					});
					
					if(result[1] == '00004'){
						$('.form-control.pull-right').css('border-color','');
						$('#num_carte').css('border-color','red');
					}else if(result[1] == '00008'){
						$('.form-control.pull-right').css('border-color','');
						$('#date_val').css('border-color','red');
					}
					else if(result[1] == '00000'){
						$('#num_carte').val('');
						$('#date_val').val('');
						$('#cvv').val('');
						$('#montant').val('');
						$('#reference').val('');
						$("#enseigne :selected").prop('selected', false);
						
						$('.form-control.pull-right').css('border-color','');
					}
					
				}
				
			})
			
			}
	})
	/* fin click sur boutton envoyer*/
	/* vider les champs*/
	$('#vider').click(function(){
		$('#num_carte').val('');
		$('#date_val').val('');
		$('#cvv').val('');
		$('#montant').val('');
		$('#reference').val('');
		$("#enseigne :selected").prop('selected', false);
		$('.form-control.pull-right').css('border-color','');
	})
	
	
	
	/* fin vider les champs*/
});
/* FIN DOCUMENT READY*/
		function fermer(){
			alert(1);
			window.close();
			
		}
		function validateNumberDecimal(event) {		
			var key = window.event ? event.keyCode : event.which;
			if (event.keyCode == 8 /*|| event.keyCode == 46*/ 
			 ||event.keyCode == 9 || event.keyCode == 116
			 || event.keyCode == 37 || event.keyCode == 39) {
				return true;
			}
			else if ( key < 45 || key > 57 ) {
				return false;
			}
			else return true;
		};

		function validateNumber(event) {		
			var key = window.event ? event.keyCode : event.which;
			if (event.keyCode == 8 || event.keyCode == 46
			 ||event.keyCode == 9 || event.keyCode == 116
			 || event.keyCode == 37 || event.keyCode == 39) {
				return true;
			}
			else if ( key < 48 || key > 57 ) {
				return false;
			}
			else return true;
		};
		function checkCC(n) {
			  var i;
			  n = n+"";
			  var sum = [];
			  var fsum = 0;
			  if(n.length==16){
				  for (i=0;i<n.length-1;i+=2) {
			   sum.push(parseInt(n.substr(i,1))*2);
			  }
			  for (i=1;i<n.length;i+=2) {
			   fsum += parseInt(n.substr(i,1));
			  }
			  for (i=0;i<sum.length;i++) {
			   
			   if (sum[i] > 9) {
				fsum += (sum[i]-(Math.floor(sum[i]/10)*10))+Math.floor(sum[i]/10);
			   } else {
				fsum += sum[i];
			   }
			  }
			  return fsum%10==0?true:false;
			  return true;
			 }else{return false;}
		}
         function getMoisAnnee_datecourant(){
			 var today=new Date();
			 var mois=today.getMonth()+1;
			 var annee=today.getFullYear();
			 if(mois<10){
				 mois='0'+mois;
			 }
			 return annee+'/'+mois+'/01';
 
		}
	    function verifcarte_date(){
		  var num = $('#num_carte').val();
		  
			var nb = num.length;
			var num_cb=checkCC(num);
			var datev=$("#date_val").val();
			var dat_tape=datev.split('/');
			var dat= dat_tape[1]+'/'+ dat_tape[0]+'/01';
			
		    var date_tape=getMoisAnnee_datecourant();
			var date_jour = Date.parse(date_tape);
			var date_validite = Date.parse(dat);
		  
			 var regex = /^[0-9]{2}\/[0-9]{4}$/;
         var test = regex.test(datev); 
			
			 if((date_jour > date_validite) && datev!=''){
			   $('#date_val').css('border-color','red');
				$("#envoyer").attr('disabled','disabled');
		  }else{
				$('#date_val').css('border-color','');
				$("#envoyer").attr('disabled',false);
			}
			if(num_cb == false && num != ''){
				$('#num_carte').css('border-color','red');
				$("#envoyer").attr('disabled','disabled');
			}else{
					
				$('#num_carte').css('border-color','');
				$("#envoyer").attr('disabled',false);
			}
		  
	    }
	    function verif(){	
			var num = $('#num_carte').val();
			var nb = num.length;
			var num_cb=checkCC(num);
			 
			if(num_cb == false && num != ''){
				$('#num_carte').css('border-color','red');
				$("#envoyer").attr('disabled','disabled');
			}else{
					
				$('#num_carte').css('border-color','');
				$("#envoyer").attr('disabled',false);
			}
			
		}
		/*function datesup_courantedate(){
			var datev=$("#date_val").val();
		    var date_tape=getMoisAnnee_datecourant();
		  if((datev < date_tape) && datev!=''){
			   $('#date_val').css('border-color','red');
				$("#envoyer").attr('disabled','disabled');
		  }else{
				$('#date_val').css('border-color','');
				$("#envoyer").attr('disabled',false);
			}
	    }*/
	    function verifdate(){
		 var datev=$("#date_val").val();
	     var regex = /^[0-9]{2}\/[0-9]{4}$/;
         var test = regex.test(datev);
	 // alert(test);
	     if(test == false && datev!='' ){
		        $('#date_val').css('border-color','red');
				$("#envoyer").attr('disabled','disabled');
			}else{
				$('#date_val').css('border-color','');
				$("#envoyer").attr('disabled',false);
			}
	    }