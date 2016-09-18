<!DOCTYPE html>
<html>
	<head>
		
		<title>PAYBOX</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Informations</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
		<link rel="stylesheet" href="css/style.css">
		
		<link rel="stylesheet" href="css/flat/zebra_dialog.css">
		
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/fonction.js" charset="UTF-8"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="bootstrap/js/bootstrap.validator.js"></script>
		<script src="plugins/datepicker/bootstrap-datepicker.js" charset="UTF-8"></script>
		
		<script src="js/zebra_dialog.js"></script>
	
		
	</head>
	<body>
	<?php
	 include ("/var/www.cache/dgconn.inc");
	 //include ("function_transaction.php");
	  global $conn;
	$num_cb=array();
	$ref_com=array();
	$code_reponse=array();
	$date_valide=array();
	$sql_paybox="select num_cb,trim(ref_commande):: varchar(100) as ref_commande,codereponse:: varchar(100),trim(date_validite) as date_validite from paybox";
	
	  $query_paybox=pg_query($conn,$sql_paybox);
	 while($res_paybox=pg_fetch_array($query_paybox)){
		 array_push($num_cb,$res_paybox['num_cb']);
		 array_push($ref_com,$res_paybox['ref_commande']);
		 array_push($code_reponse,$res_paybox['codereponse']);
		 array_push($date_valide,$res_paybox['date_validite']);
	 }
	/* print_r($code_reponse);
	 echo '<br>';
	 print_r($num_cb);
	  echo '<br>';
	   print_r($ref_com);*/
	 $num_carte=join(',',$num_cb);
	 $ref=join(',',$ref_com);
	 $coderep=join(',',$code_reponse);
	 $datevalide=join(',',$date_valide);
	 
	 function validateDate($daty) {
    $strregexdate = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
    return preg_match($strregexdate, $daty);
    }

	// $numcb_valide=test_cb('4568689145');
	?>
	<input type="hidden" id="num_cb" value="<?php echo $num_carte;?>"/>
	<input type="hidden" id="ref" value="<?php echo $ref;?>"/>
	<input type="hidden" id="coderep" value="<?php echo $coderep;?>"/>
	<input type="hidden" id="datevalide" value="<?php echo $datevalide;?>"/>
	<div class="wrapper">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="carte row">
					<div style="background-color:#f5f5f5;"class="box box-info">
						<div class="box-header with-border">
						  <h3 class="box-title">Informations</h3>
						</div>
						<!-- /.box-header -->
						<!-- form start -->
						<form role="form"  data-toggle="validator" method="POST" action="" id="form">
					
							<div class="box-body">
							
								<div class="col-md-12">
									
									<div class="row">
									
									   <div class="col-md-12">
											<div style="display:none;"class="form-group">
												<div class="input-group">
												  <div class="input-group-addon">
													<i class="fa fa-folder"></i>
												  </div>
												   <input type="text" id="enseigne" class="form-control pull-right" value="<?php echo $_GET['enseigne'];?>"/>
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
												  <div class="input-group-addon">
													<i class="fa fa-folder"></i>
												  </div>
												 
												   <input type="text"  class="form-control pull-right" id="enseign" placeholder="enseigne"  readonly value="<?php 
												  if ($_GET['enseigne'] == 1){
													   echo 'LES DELICES D&apos;ANNIE';
												   }
												   if ($_GET['enseigne'] == 2){
													   echo 'DELICES ET GOURMANDISES';
												   }
												   if ($_GET['enseigne'] == 4){
													   echo 'EDITIONS NATUR&apos;SANT&Eacute; ';
												   }
												    if ($_GET['enseigne'] == 8){
													   echo 'LA CAVE DE D&Eacute;LICES ET GOURMANDIS';
												   }
												  
												   ?>" />
												  
												  
												  
												<!--<option value="">-- S&eacute;lectionner une enseigne --</option>
												  		<option value="1">LES DELICES D&apos;ANNIE</option>
												  		<option value="2">DELICES ET GOURMANDISES</option>
												  		<option value="4">EDITIONS NATUR&apos;SANT&Eacute;</option>
												  		<option value="8">LA CAVE DE D&Eacute;LICES ET GOURMANDIS</option>-->
												  <!--</select>-->
												</div>
												<!-- /.input group -->
											</div>
										</div>
										<!--<div class="col-md-3">
											<i style="font-size:0.8em; text-align:left;">(19 chiffres)</i>
										</div>-->
									</div>
									
									<div class="row">
									   <div class="col-md-12">
											<div class="form-group">
												<div class="input-group">
												  <div class="input-group-addon">
													<i class="fa fa-credit-card"></i>
												  </div>
												  <input type="text" autocomplete="off" class="form-control pull-right" id="num_carte" placeholder="Numero de la carte" maxlength="19"  required="required" value="<?php echo $_GET['num_carte'];?>" />
												
												</div>
												<!-- /.input group -->
											</div>
										</div>
										<!--<div class="col-md-3">
											<i style="font-size:0.8em; text-align:left;">(19 chiffres)</i>
										</div>-->
									</div>
									<div class="row">
									   <div class="col-md-12">
											<div class="form-group">
												<div class="input-group">
												  <div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												  </div>
												
												  <input  style="<?php  if($dat=validateDate($_GET['date_validite']) == 1){ echo'';  }else{echo 'border-color:red;';}?>background-color:#fff!important;" type="text" class="form-control pull-right" id="date_val" readonly  value="<?php  $date_val=$_GET['date_validite']; $now = date('Y-m-d');  if($dat=validateDate($date_val) == 1) {  $date=explode('-',$date_val); echo $date[1].'/'.$date[0];}else{ echo  '';}?>" placeholder="Date de validit&eacute; de la carte" >
												
												 <!--<input  style="background-color:#fff!important;"type="text" class="form-control pull-right" id="date_val" readonly  value="<?php  echo $_GET['date_validite'];?>" placeholder="Date de validit&eacute; de la carte" >
												 <input style="display:none;"type="text" value="<?php echo ""; ?>" class="form-control pull-right" readonly id="dateval"/>-->
												
													 
												 
												</div>
												<!-- /.input group -->
											</div>
										</div>
										
									</div>
									<div class="row">
									   <div class="col-md-12">
											<div class="form-group">
												<div class="input-group">
												  <div class="input-group-addon">
													<i class="fa fa-code"></i>
												  </div>
												  <input type="text" class="form-control pull-right" id="cvv" placeholder="Cryptogramme"  value="<?php echo $_GET['crypto'];?>"maxlength="4">
												</div>
												<!-- /.input group -->
											</div>
										</div>
										<!--<div class="col-md-3">
											<i style="font-size:0.8em; text-align:left;">(3 ou 4 chiffres)</i>
										</div>-->
									</div>
									<div class="row">
									   <div class="col-md-12">
											<div class="form-group">
												<div class="input-group">
												  <div class="input-group-addon">
													<i class="fa fa-money"></i>
												  </div>
												  <input type="text" class="form-control pull-right" id="montant" placeholder="Montant" required pattern="[0-9]*.?[0-9]{0,2}|[0-9]*,?[0-9]{0,2}|[0-9]*" value="<?php echo $_GET['montant'];?>"onblur="if (!this.checkValidity()){val = this.value;res = val.match(/[0-9]*.?[0-9]{0,2}|[0-9]*,?[0-9]{0,2}|[0-9]*/g);this.value = res[0];}" readonly>
												</div>
												<!-- /.input group -->
											</div>
										</div>
										
									</div>
									
									<div class="row">
									   <div class="col-md-12">
											<div class="form-group"> 
											  <input type="text" class="form-control pull-right" id="reference" placeholder="R&eacute;f&eacute;rence commande" readonly value="<?php echo $_GET['ref_com']; ?>"/>
												 
											</div>
										</div>
									</div>
									
								</div>
								
							</div>
							<div class="box-footer" >
								<button type="button"  class="btn btn-info" disabled="" id="envoyer">Envoyer</button>
								<button type="button" class="btn btn-info" id="vider">Vider</button>
								<!--<button type="button" onclick="fermer()" class="btn btn-info" >Fermer</button>-->
							</div>
							
						</form>
				    </div>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>
