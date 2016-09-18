 
 <?php
 ?>
 <html>
  <head>
	<title>
	</title>
  </head>
  <body>
  <script type="text/javascript">
 
 /* DEBUT DOCUMENT READY*/
   var btnenvoye= null;

	
			verifcarte_date();
			
	
     

	
	
	    function verifcarte_date(){
		 
		  
		var date_courante=getMoisAnnee_datecourant();
		var daty_test = '2017/03/01';
					
			var date_jour = Date.parse(date_courante);
			var date_validite = Date.parse(daty_test);
      
		//alert(date_tape+" ?"+daty_test);	
		if(( date_jour > date_validite)){
			   alert(date_courante+">"+daty_test);
		  }else{
			 alert(date_courante+"<"+daty_test);
			}
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
	  
</script>
</body>
</html>