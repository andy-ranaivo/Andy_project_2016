<?php
	if($_REQUEST["montant"] == '' && $_REQUEST["num_carte"] == '' && $_REQUEST["cvv"] == '' && $_REQUEST["date_val"] == '' && $_REQUEST["reference"] == '' && $_REQUEST["enseigne"] == ''){
		echo 'Connexion au serveur interrompue';
	}
	else{
		
		$cle  = '';
		$site = '';
		$date_val = explode('/',$_REQUEST["date_val"]);
		
		$add_zero_montant  = '';
		$test_float = explode('.',$_REQUEST["montant"]);
		if($test_float[1] != ''){
			$montant = $_REQUEST["montant"] * 100;
		}else{
			$montant = $_REQUEST["montant"];
		}
		if(strlen($montant) < 10){
			for($i=1;$i<=(10-strlen($montant));$i++)
				$add_zero_montant .= '0'; 
		}
		
		$num_question = mt_rand(1,1000000000);
		if(strlen($num_question) < 10){
			for($i=1;$i<=(10-strlen($num_question));$i++)
				$add_zero_num_question .= '0'; 
		}
		
		if($_REQUEST["enseigne"] == 1){
			$cle  = 'CFLKFIIB';
			$site = '8751776';
		} 
		if($_REQUEST["enseigne"] == 2){
			$cle  = 'CFLKFHHB';
			$site = '8751781';
		} 
		if($_REQUEST["enseigne"] == 4){
			$cle  = 'CFLKFJJB';
			$site = '8751782';
		} 
		if($_REQUEST["enseigne"] == 8){
			$cle  = 'CFLKFHHB';
			$site = '8751781';
		}
		
		$data = array(
				  'VERSION' 	=> '00103',
	              'TYPE' 		=> '0003',
	              'SITE' 		=> $site,
	              'RANG'		=> '01',
	              'CLE'         => $cle,
	              'NUMQUESTION' => $add_zero_num_question.$num_question,
	              'MONTANT'		=> $add_zero_montant.$montant,
	              'DEVISE'		=> 978,
	              'REFERENCE'	=> urlencode($_REQUEST["reference"]),
	              'PORTEUR'		=> $_REQUEST["num_carte"],
	              'DATEVAL'		=> $date_val[0].substr($date_val[1],2,2),
	              'CVV'			=> $_REQUEST["cvv"],
	              'DATEQ'		=> date('dmYHis'));
	    //echo '<pre>';print_r($data);echo '</pre>'; 
	  
		$url = 'https://preprod-ppps.paybox.com/PPPS.php';
		
		$defaults = array( 
	        CURLOPT_POST           => 1, 
	        CURLOPT_HEADER         => 0, 
	        CURLOPT_URL            => $url, 
	        CURLOPT_FRESH_CONNECT  => 1, 
	        CURLOPT_RETURNTRANSFER => 1, 
	        CURLOPT_FORBID_REUSE   => 1, 
	        CURLOPT_TIMEOUT 	   => 4, 
	        CURLOPT_POSTFIELDS     => http_build_query($data, '', '&amp;') 
	    ); 

	    $ch = curl_init(); 
	    curl_setopt_array($ch, ($defaults)); 
	    if( ! $result = curl_exec($ch)) 
	    { 
	        trigger_error(curl_error($ch)); 
	    } 
	    curl_close($ch); 
	  //  echo $result;
	    
	    $code_rep = explode('CODEREPONSE=',$result);
	    $code_reponse = explode('&',$code_rep[1]);
	    
	    if($result == '')
	    	echo 'Connexion au PAYBOX interrompue';
	    /*elseif($code_reponse[0] == '00001' ||  $code_reponse[0] == '00097' || $code_reponse[0] == '00098'){
		    $url = '195.101.99.73';
		    $result = curl_post($url,$data);
		    if($result)
		    $resp = explode('COMMENTAIRE=',$result);
		    $response = explode('&',$resp[1]);
		    echo $response[0];
		}*/
		else{
			$resp = explode('COMMENTAIRE=',$result);
		    $response = explode('&',$resp[1]);
		    echo $response[0];
		}
	}
	
	function curl_post($url,$data){
		$defaults = array( 
	        CURLOPT_POST           => 1, 
	        CURLOPT_HEADER         => 0, 
	        CURLOPT_URL            => $url, 
	        CURLOPT_FRESH_CONNECT  => 1, 
	        CURLOPT_RETURNTRANSFER => 1, 
	        CURLOPT_FORBID_REUSE   => 1, 
	        CURLOPT_TIMEOUT 	   => 4, 
	        CURLOPT_POSTFIELDS     => http_build_query($data, '', '&amp;') 
	    ); 

	    $ch = curl_init(); 
	    curl_setopt_array($ch, ($defaults)); 
	    if( ! $result = curl_exec($ch)) 
	    { 
	        trigger_error(curl_error($ch)); 
	    } 
	    curl_close($ch); 
	    return $result;
	}
	 
?>