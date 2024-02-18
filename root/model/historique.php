<?php

require('model/bdConnect.php');

	function defineCondition($donnee,$id_user=false){
   $date = strtotime("+1 day", strtotime("".valid($donnee['dateF']).""));
        $date =  date("Y-m-d", $date);
	  
		if($donnee['prod']!='') $cond="`produit`.`id_prod`=".valid($donnee['prod']);
		elseif($donnee['ligne']!='') $cond="`produit`.`id_prod` IN (SELECT `id_prod` FROM `produit` WHERE `id_ligneP`=".valid($donnee['ligne']).")"; 
		elseif(isset($donnee['unite']) && $donnee['unite']!='') $cond="`produit`.`id_prod` IN (SELECT `id_prod` FROM `produit` WHERE `id_ligneP` IN (SELECT `id_ligneP` FROM `ligne production` WHERE `id_unite`=".$donnee['unite'].") )";
		else $cond='1';

		if($donnee['groupe']!='') $cond.= " AND `groupeUser`='".valid($donnee['groupe'])."' ";

		if($id_user) $cond.= " AND `passage`.`id_user` = ".valid($id_user);
		elseif($donnee['control']!='') $cond.= " AND `passage`.`id_user`='".valid($donnee['control'])."' ";

		$cond.= " AND `dateHeure` >= '".valid($donnee['dateD'])." 07:00:00' AND `dateHeure` < '".$date." 07:00:00 '";

		return $cond;
	}

	function recupProdSearch($cond){
		$rep= requette("SELECT `produit`.`id_prod`,`nomProd` FROM `passage`, `produit` WHERE ".$cond." AND `produit`.`id_prod`= `passage`.`id_prod` GROUP BY `id_prod`;");

		return $rep;
	}

	function recupPassagesSearch($cond){
		$rep= requette("SELECT `id_passage`,`groupeUser`,`produit`.`id_prod`,`dateHeure`,`etatPassage`,`observation`,`nomComplet` FROM `passage`, `user`,`produit` WHERE ".$cond." AND `user`.`id_user`= `passage`.`id_user` AND `produit`.`id_prod`= `passage`.`id_prod` ORDER BY `produit`.`id_prod`;");

		return $rep;
	}

	function recupPassagesJour($id_user){ 
        if(date('H') >= 7){
			$debut=date('Y-m-d');
			$fin= date('Y-m-d',strtotime($debut.' +1 day'));
		}else{
			$fin=date('Y-m-d');
			$debut= date('Y-m-d',strtotime($fin.' -1 day'));
		}

		$rep= requette("SELECT * FROM `passage` WHERE `dateHeure` >= '".$debut." 07:00:00' AND `dateHeure` < '".$fin." 07:00:00'  AND  `id_user` = ".valid($id_user)." ORDER BY `id_prod`;");

		return $rep;
	}

	function nomProduit($id_prod){
		$rep= requette("SELECT `nomProd` FROM `produit` WHERE `id_prod` = ".valid($id_prod).";");
		
		 return $rep->fetch()['nomProd'];
	}

	function recupNormeProduit($id_prod,$id_groupeN=null,$colone=null){
		$condG= ($id_groupeN==null)? 'IS NULL' : '= '.$id_groupeN;
		$condCol= ($colone==null)? '' : ' AND `colone`='.$colone;

		$rep= requette("SELECT * FROM `norme` WHERE `active`= 1 AND `id_groupeN` ".$condG.$condCol." AND `id_prod`= ".valid($id_prod)." ORDER BY `ordreNorme`;");
		
		return $rep;
	}

	function recupValNorm($id_passage,$id_norme,$id_oldPassage=false){
		$rep= requette("SELECT `valeurSaisie` FROM `saisie` WHERE `id_passage`= ".valid($id_passage)." AND `id_norme`= ".valid($id_norme)." ;");
		
		if($a=$rep->fetch()) return $a['valeurSaisie'];
		elseif($id_oldPassage) return recupValNorm($id_oldPassage,$id_norme);
		else return null;
	}

	function recupListUnite($droitAdmin=','){
		if($droitAdmin!=',') $droitAdmin= " AND '".$droitAdmin."' LIKE CONCAT('%,',`id_unite`,',%') ";
		else $droitAdmin="";
		
		$rep= requette("SELECT * FROM `unite production` WHERE `active`=1 ".$droitAdmin.";");
		
		return $rep;
	}

	function recupListLignesP($id_user){
		$rep= requette("SELECT `id_ligneP`,`nomLigneP` FROM `ligne production` WHERE `id_ligneP` IN (SELECT `id_ligneP` FROM `affectation control` WHERE `id_user`= ".valid($id_user).");");

		return $rep;
	}

	function recupListLignesOfUnite($id_unite){
		$rep= requette("SELECT `id_ligneP`,`nomLigneP` FROM `ligne production`  WHERE `active`= 1 AND `id_unite` = ".valid($id_unite)." ;");

		return $rep;
	}

	function recupListProdsOfLigne($id_ligneP){
		$rep= requette("SELECT `id_prod`,`nomProd` FROM `produit`  WHERE `active`= 1 AND `id_ligneP` =".valid($id_ligneP)." ;");

		return $rep;
	}

	function recupListGroupe(){
		$rep= requette("SELECT `groupeUser` FROM `passage` GROUP BY `groupeUser` ;");

		return $rep;
	}

	function recupListControleur(){
		$rep= requette("SELECT `id_user`,`nomComplet` FROM `user` WHERE `active`= 1 AND `type`= 'control' ;");

		return $rep;
	}

/****-------------------______-______-------------------****/
	function valid($chaine){
		$char= array("'", "\"", "`");
		$remp= array("\'", "\\\"", "\`");
		return htmlspecialchars(str_replace($char, $remp, $chaine));
	}