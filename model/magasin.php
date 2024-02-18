<?php
require('model/bdConnect.php');
    function recupListArrivage(){
    	$rep= requette("SELECT `emb_arrivage`.`id_arrivage` ,`nomGroupeProd`,`nomProd`,`nomFournisseur`,`quantite`,`dateArrivage`,`numLot`,`etatMaquette` FROM `emb_arrivage`, `emb_produit`LEFT JOIN `emb_groupe prod` on `emb_groupe prod`.`id_groupeProd` = `emb_produit`.`id_groupeProd` , `emb_fournisseur` WHERE `emb_arrivage`.`id_prod`=`emb_produit`.`id_prod`and `emb_fournisseur`.`id_fournisseur`= `emb_arrivage`.`id_fournisseur` ORDER BY `dateArrivage` DESC");
    	return $rep;
	}

	function recupListEmbProduit(){
    	$rep= requette("SELECT `id_prod`,`nomProd` FROM `emb_produit`");
     
    	return $rep;
	}

	function recupListEmbFournisseur(){
    	$rep= requette("SELECT * FROM `emb_fournisseur`");
     
    	return $rep;
	}
	
	function ajouterArrivage($id_prod,$id_fournisseur,$quantite,$numLot){	
	    $dateArv= date('Y-m-d');
	    $rep=  requette("INSERT INTO `emb_arrivage` (`id_arrivage`, `id_prod`, `id_fournisseur`, `quantite`, `dateArrivage`, `numLot`, `etatMaquette`, `extentionMaquette`, `remarque`) VALUES (NULL,'".valid($id_prod)."', '".valid($id_fournisseur)."', '".valid($quantite)."', '".valid($dateArv)."', '".valid($numLot)."','0','','')");
	 	  
	    $rep2= requette("SELECT `id_arrivage` FROM `emb_arrivage` WHERE `id_prod`=".valid($id_prod)." AND `numLot`='".valid($numLot)."' AND `dateArrivage`='".valid($dateArv)."'  ORDER BY `emb_arrivage`.`id_arrivage` DESC ");
                 //  var_dump("SELECT `id_arrivage` FROM `emb_arrivage` WHERE `id_prod`=".valid($id_prod)." AND `numLot`='".valid($numLot)."' AND `dateArrivage`='".valid($dateArv)."' ");die;
	 	return $rep2->fetch()['id_arrivage'];
	} 
	
	function recupDetailArrivage($id_arrivage){
    	$rep= requette("SELECT `emb_arrivage`.`id_arrivage` ,`nomProd`,`nomFournisseur`,`quantite`,`dateArrivage`,`numLot`,`etatMaquette`,`extentionMaquette`,`remarque` FROM `emb_arrivage`,`emb_produit`, `emb_fournisseur` WHERE `emb_arrivage`.`id_prod`=`emb_produit`.`id_prod`and `emb_fournisseur`.`id_fournisseur`= `emb_arrivage`.`id_fournisseur` and  `id_arrivage` ='".valid($id_arrivage)."'");
	    
	    return $rep->fetch();
	}
	

	function modifierArrivage($id_arrivage,$id_prod,$id_fournisseur,$quantite,$dateArrivage,$numLot){
		$rep= requette("UPDATE `emb_arrivage` SET `id_prod`= '".valid($id_prod)."',`id_fournisseur`='".valid($id_fournisseur)."',`quantite`='".valid($quantite)."',`dateArrivage`='".valid($dateArrivage)."',`numLot`= '".valid($numLot)."' WHERE `id_arrivage`= '".valid($id_arrivage)."'");
         
	    return true;
	}

	function recupInfoAllImages($id_arrivage){
		$rep= requette("SELECT `emb_version prod`.`id_version`,`dateVersion`,`maquetteProd`,`emb_maquette prod`.`extensionMaquette`, `emb_arrivage`.`extentionMaquette` AS 'extentionIMG' FROM `emb_version prod`,`emb_arrivage`,`emb_maquette prod` WHERE `emb_arrivage`.`id_prod`=`emb_version prod`.`id_prod` AND `emb_version prod`.`maquetteProd`=`emb_maquette prod`.`id_maquette` AND `maquetteProd` IS NOT NULL AND `id_arrivage`=".$id_arrivage." ORDER BY `dateVersion` DESC LIMIT 1");
   
	    return $rep->fetch();
	}

	function saveMaquetteBD($id_arrivage,$extension){
		$rep= requette("UPDATE `emb_arrivage` SET `etatMaquette`='0',`extentionMaquette`= '".valid($extension)."' WHERE `id_arrivage`= '".valid($id_arrivage)."'");
         
	    return true;
	}

	function modifierEtatArrivage($id_arrivage,$etatMaquette,$remarque){
        $rep= requette("UPDATE `emb_arrivage` SET `etatMaquette`= '".valid($etatMaquette)."',`remarque`='".valid($remarque)."' WHERE `id_arrivage`= '".valid($id_arrivage)."'");

        return true;
    }

    function verifDetailProd($codeBarre){
    	$rep= requette("SELECT `emb_version prod`.`id_version`, `emb_produit`.`id_prod`, `emb_produit`.`nomProd`,`emb_version prod`.`miniatureProd`,`extensionMaquette` FROM `emb_produit`,`emb_version prod`,`emb_maquette prod` WHERE `emb_produit`.`id_prod` = `emb_version prod`.`id_prod` AND `emb_version prod`.`miniatureProd`=`emb_maquette prod`.`id_maquette` and `emb_produit`.`codeBarre` = '".valid($codeBarre)."' ORDER BY `emb_version prod`.`dateVersion` DESC LIMIT 1");

    	return $rep->fetchAll(PDO::FETCH_CLASS);
    }

/********************************/
	function valid($chaine){
		$char= array("'", "\"", "`");
		$remp= array("\'", "\\\"", "\`");
		return htmlspecialchars(str_replace($char, $remp, $chaine));
	}