<?php
    include ("/var/www.cache/dgconn.inc");
    include ("function_transaction.php");
 
    global $conn;
	$num_cb=array();
	$ref_com=array();
	$code_reponse=array();
	$sql_paybox="select num_cb,trim(ref_commande):: varchar(100) as ref_commande,codereponse from paybox";
	
	$query_paybox=pg_query($conn,$sql_paybox);
	while($res_paybox=pg_fetch_array($query_paybox)){
		 array_push($num_cb,$res_paybox['num_cb']);
		 array_push($ref_com,$res_paybox['ref_commande']);
		 array_push($code_reponse,$res_paybox['codereponse']);
	 }

    $refcomm=ExisteRefcommande($_REQUEST["reference"],$ref_com);
    $carte_bc=ExisteCartebancaire($_REQUEST["num_carte"],$num_cb);

	if(isset($_REQUEST["date_val"]) &&  isset($_REQUEST["num_carte"]) && isset($_REQUEST["reference"])){
		$ref=utf8_decode($_REQUEST["reference"]);
		$date_val=$_REQUEST["date_val"];
		$num_carte=$_REQUEST["num_carte"];
		$date_val = explode('/',$_REQUEST["date_val"]);
		$dateval=$date_val[1].'-'.$date_val[0];
	}
	if($_REQUEST["montant"] == '' && $_REQUEST["num_carte"] == '' && $_REQUEST["cvv"] == '' && $_REQUEST["date_val"] == '' && $_REQUEST["reference"] == '' && $_REQUEST["enseigne"] == ''){
		echo 'Connexion au serveur interrompue';
	}
	else{
		
		$cle  = '';
		$site = '';
		$date_val = explode('/',$_REQUEST["date_val"]);
		
		$add_zero_montant  = '';
		$montant 		   = floatval(str_replace(',', '.', $_REQUEST["montant"])) * 100;
		
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
	              'TYPE' 		=> '00003',
	              'SITE' 		=> $site,
	              'RANG'		=> '01',
	              'CLE'         => $cle,
	              'NUMQUESTION' => $add_zero_num_question.$num_question,
	              'MONTANT'		=> str_pad($montant,10,'0',STR_PAD_LEFT),
	              'DEVISE'		=> 978,
	              'REFERENCE'	=> 'C3-'.urlencode($_REQUEST["reference"]),
	              'PORTEUR'		=> $_REQUEST["num_carte"],
	              'DATEVAL'		=> $date_val[0].substr($date_val[1],2,2),
	              'CVV'		    => $_REQUEST["cvv"],
	              'DATEQ'		=> date('dmYHis'));
	    //echo '<pre>';print_r($data);echo '</pre>'; 
	  
	  //$url = 'https://preprod-ppps.paybox.com/PPPS.php';
		$url = 'https://ppps.paybox.com/PPPS.php';
		
		$defaults = array( 
	        CURLOPT_POST           => 1, 
	        CURLOPT_HEADER         => 0, 
	        CURLOPT_URL            => $url, 
	        CURLOPT_FRESH_CONNECT  => 1, 
	        CURLOPT_RETURNTRANSFER => 1, 
	        CURLOPT_FORBID_REUSE   => 1, 
	        CURLOPT_TIMEOUT 	   => 4, 
	        CURLOPT_POSTFIELDS     => http_build_query($data) 
	    ); 

	    $ch = curl_init(); 
	    curl_setopt_array($ch, ($defaults)); 
	    if( ! $result = curl_exec($ch)) 
	    { 
	        trigger_error(curl_error($ch)); 
	    } 
	    curl_close($ch); 
	//echo $result;
	    
	    $num_trans    = "";
	    $numero_trans = explode('NUMTRANS=',$result);
	    if(isset($numero_trans[1])){
			$arr_num_trans = explode('&',$numero_trans[1]);
			$num_trans = $arr_num_trans[0];
		}
	    
	    $code_rep     = explode('CODEREPONSE=',$result);
	    $code_reponse = explode('&',$code_rep[1]);
	    if($result == '')
	    	echo 'Connexion au PAYBOX interrompue';
		else{
	    	
			$resp     = explode('COMMENTAIRE=',$result);
		    $response = explode('&',$resp[1]);
		    if($response[0] == ''){
				$coderep  =$code_reponse[0];
				$numtrans =$num_trans;
				$codereps =ValideCodereponse($coderep);
				$array_id =array();
				$sql_id   ="";
				
				$sql_id.="select id_paybox_beta from paybox where num_cb='$num_carte' and ref_commande='$ref'";
				if($codereps == 0) {
					$sql_id .= "and 1=1";
				}else{
					$sql_id .= "and codereponse='$coderep'";
				}
				
				$query_id 		= pg_query($conn,$sql_id);
				$res_id   		= pg_fetch_assoc($query_id);
				$id_paybox_beta = $res_id['id_paybox_beta'];
				if($codereps == 1){
					$sql_delete = "delete from paybox where id_paybox_beta = ".$id_paybox_beta;
					pg_query($conn,$sql_delete);
				}
				/*
				while($res_id=pg_fetch_array($query_id)){
					array_push($array_id,$res_id['id_paybox_beta']);
				}
				
				if($codereps == 1){
					$sql_delete="delete from paybox where id_paybox_beta='$array_id[0]'";
					$query_delete=pg_query($conn,$sql_delete);
				}
				*/
				
			   date_default_timezone_set("Europe/Paris");

			   if($refcomm == 0 && $carte_bc == 0 && $codereps == 0){
				 
		 
			   }else{
				
				 $sql="insert into paybox(num_cb,ref_commande,codereponse,numtrans,date_validite,date_reg) values(
				 ".$num_carte.",'".pg_escape_string($ref)."','".$coderep."','".$numtrans."','".$dateval."','".date('Y-m-d H:i:s')."'
				 )";
				  //echo $sql;
				 $query=pg_query($conn,$sql);
				}
			
							echo $resp[1].'<br />Code reponse = '.$code_reponse[0].'<br />Numero transaction = '.$num_trans.'||'.$coderep; 
			}
				
		    else { 
			$coderep=$code_reponse[0]; 
			
			$numtrans=$num_trans;
			$codereps=ValideCodereponse($coderep);
			
			$array_id=array();
			$sql_id="";
			$sql_id.="select id_paybox_beta from paybox where num_cb='$num_carte' and ref_commande='$ref'";
			if($codereps == 0){
				$sql_id.="and 1=1";
			}else{
				$sql_id.="and codereponse='$coderep'";
			}
			$query_id=pg_query($conn,$sql_id);
			while($res_id=pg_fetch_array($query_id)){
				array_push($array_id,$res_id['id_paybox_beta']);
			}
			if($codereps == 1){
				$sql_delete="delete from paybox where id_paybox_beta='$array_id[0]'";
				$query_delete=pg_query($conn,$sql_delete);
			}
			
			date_default_timezone_set("Europe/Paris");

		    if($refcomm == 0 && $carte_bc == 0 && $codereps == 0){
			  
			echo '<input type="hidden" class="encaisse" value="encaisse1"/>';  
		   }else{
		
			 $sql="insert into paybox(num_cb,ref_commande,codereponse,numtrans,date_validite,date_reg) values(
			 ".$num_carte.",'".pg_escape_string($ref)."','".$coderep."','".$numtrans."','".$dateval."','".date('Y-m-d H:i:s')."'
			 )";
			 
			 $query=pg_query($conn,$sql);
		   }
		
			echo $response[0].'<br />Code reponse = '.$code_reponse[0].'<br />Numero transaction = '.$num_trans.'||'.$code_reponse[0];
		
			}
			 
		}
		
	}
	
	
		
	
		
	
 

 

	 

		
	
    
?>

