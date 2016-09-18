 
 
 <script>
 
 * DEBUT DOCUMENT READY*/
   var btnenvoye= null;
   $(document).ready(function() {  
	
     
	verifcarte_date('03/2017');
	
	
	    function verifcarte_date(){
		  var num = $('#num_carte').val();
		  
			var nb = num.length;
			var num_cb=checkCC(num);
			var datev=$("#date_val").val();
		    var date_tape=getMoisAnnee_datecourant();
			 var regex = /^[0-9]{2}\/[0-9]{4}$/;
         var test = regex.test(datev); 
			
			 if((datev < date_tape) && datev!=''){
			   alert('erreur');
		  }else{
			alert('ok');
			}
				  
	    }
</script>