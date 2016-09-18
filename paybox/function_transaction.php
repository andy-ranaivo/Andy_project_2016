<?php

//fonction pour tester si la transaction est accepté
function ValideCodereponse($coderp){
	//$coderep=substr($coderp,-2,2);
	switch($coderep){
		case '00100':
		$codeacceppte=0;
		break;

		case '00105':
		$codeacceppte=0;
		break;

		case '00108':
		$codeacceppte=0;
		break;

		case '00151':
		$codeacceppte=0;
		break;

		default:
		$codeacceppte=1;
		break;
	}
	
	return $codeacceppte;
}
//fonction pour tester si la reference commande tapée existe dans la base
function ExisteRefcommande($ref_com,$ref_base){
	if(in_array($ref_com,$ref_base)){
		$existe_ref_com=0;
	}else{
		$existe_ref_com=1;
	}
	return $existe_ref_com;
}
//fonction pour tester si la carte bancaire tapée existe dans la base
function ExisteCartebancaire($cart_banc,$cart_base){
	if(in_array($cart_banc,$cart_base)){
		$existe_cart_banc=0;
	}else{
		$existe_cart_banc=1;
	}
	return $existe_cart_banc;
}
function Blocagesecurite($coderep,$ref,$cart){
	if($coderep == 1 && $ref == 0 && $cart == 0){
	$msg="transaction erreur";
    }else{
	$msg="transaction effectu&eacute";
   }
   return $msg;
}
//fonction pour tester si la carte bancaire est valide
function test_cb($num){
  if(strlen($num) == 16){ // 16 caractères
   // Séparation de tous les caractères
   $c = array();
   for($i=0; $i<16; $i++){
    if(is_numeric(substr($num,$i,1))){ // Uniquement des chiffres
     $c[$i] = substr($num,$i,1);
    }else{
     return false;
    }
   }
   // Contrôle
   $m1 = 0;
   for($i=0; $i<16; $i++){
    if(($i%2)==0){
     $x = $c[$i]*2;
     if($x>9){
      $m1 += $x-9;
     }else{
      $m1 += $x;
     }
    }else{
     $m1 += $c[$i];
    }
   }
   if(($m1%10)!=0){ // Doit être multiple de 10
    return false;
   }
   // Pas d'erreur
   return true;
  }else{
   return false;
  }
 }
