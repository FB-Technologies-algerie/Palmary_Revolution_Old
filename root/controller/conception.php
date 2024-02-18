<?php
	require('model/conception.php');

	function controleQualite(){
		require('view/conception/controleQualite.php');
	}
	function traitementImage(){
		require('view/conception/traitementImage.php');
	}
	function conception(){
		require('view/conception/index.php');
	}

	function gestionTraduction(){
		$listTraduction= recupListTraduction();

		require('view/conception/gestionTraduction.php');
	}

	function gestionEmballageProd(){
		$listEmballage= recupListEmballageProd();

		require('view/conception/gestionEmballageProd.php');
	}

	function formEmballageProd($id_emballageProd){
		$emballage= recupInfoEmballageProd($id_emballageProd);

		require('view/conception/formEmballage.php');
	}
	
	function traduireListe($id_emballageProd,$listeIngrediants){
		saveListeIngrediants($id_emballageProd,$listeIngrediants);

		traduireListeIngrediants($listeIngrediants);
	}

	function traduireListeIngrediants($listeIngrediants){
		$tabIngrediants= separIngrediants($listeIngrediants);
		$listeAR=$listeEN=$listePT=$listeES="";

		foreach ($tabIngrediants as $ingrediant) {
			$traduction= traduireIngrediant($ingrediant);
			$listeAR.=$traduction['arTraduction'].'، ';
			$listeEN.=$traduction['enTraduction'].', ';
			$listePT.=$traduction['ptTraduction'].', ';
			$listeES.=$traduction['esTraduction'].', ';
		}

		echo $listeEN.';@;'.$listeAR.';@;'.$listePT.';@;'.$listeES;
	}

	function separIngrediants($chaine){
			$regex = array ('#[\(]([^\)]*),(.*)[\)]#');
			$replace = array ('($1@$2)');
			
			$chaine2=preg_replace($regex,$replace,$chaine);
			while($chaine!=$chaine2){
				$chaine=$chaine2;
				$chaine2=preg_replace($regex,$replace,$chaine);
			}

			$chaine2=preg_replace('#,#',';',$chaine2);
			$chaine2= preg_replace('#@#',',',$chaine2);
	
			$chaine2=explode(';', $chaine2);
			return $chaine2;
		}

