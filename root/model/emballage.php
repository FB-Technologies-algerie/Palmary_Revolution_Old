<?php
	require('model/bdConnect.php');


	function recupToutGroupeProd(){
		$rep= requette("SELECT * FROM `emb_groupe prod` ORDER BY `emb_groupe prod`.`nomGroupeProd` ASC;");

		return $rep->fetchAll(PDO::FETCH_CLASS);
	}

	function ajoutEmballageProd($donnee){
		$rep= requette("INSERT INTO `emb_produit` (`id_prod`, `nomProd`, `codeArticle`, `codeBarre`, `id_groupeProd`) VALUES (NULL, '".valid($donnee['nomProd'])."', '".valid($donnee['codeArticle'])."', '".valid($donnee['codeBarre'])."', ".valid($donnee['idGroupe']).");");

		$id_emballageProd= requette("SELECT `id_prod` FROM `emb_produit` WHERE `nomProd`= '".$donnee['nomProd']."' AND `codeBarre`= '".valid($donnee['codeBarre'])."' ORDER BY `id_prod` DESC LIMIT 1;")->fetch()['id_prod'];
		
		return $id_emballageProd;
	}

	function modifEmballageProd($id_prod,$donnee){
		$rep= requette("UPDATE `emb_produit` SET `nomProd`='".valid($donnee['nomProd'])."', `codeArticle`='".valid($donnee['codeArticle'])."', `codeBarre`='".valid($donnee['codeBarre'])."', `id_groupeProd`=".valid($donnee['idGroupe'])." WHERE `id_prod`= ".valid($id_prod)." ;");

		return true;
	}

	function supprimeEmballageProd($id_prod){
		$rep= requette("DELETE FROM `emb_produit` WHERE `id_prod`= ".valid($id_prod)." ;");

		return true;
	}

	function recupInfoEmballageProd($id_prod){
		$rep= requette("SELECT * FROM `emb_produit` WHERE `id_prod`= ".valid($id_prod)." ;");

		return $rep->fetch();
	}

	function recupListeVersionProd($id_prod){
		$rep= requette("SELECT `id_version`, `titreVersion`,`dateVersion`,`descriptionVersion` FROM `emb_version prod` WHERE `id_prod`= ".valid($id_prod)." ORDER BY `dateVersion` DESC ;");

		return $rep;
	}

	function recupListeMaquetteProd($id_version){
		$rep= requette("SELECT `id_maquette`,`titreMaquette`,`etatMaquette`,`extensionMaquette`, `typeMaquette` FROM `emb_maquette prod` WHERE `id_version`=".valid($id_version).";");
              
		return $rep;
	}

	function recupDetailVersionProd($id_version){
		$rep= requette("SELECT * FROM `emb_version prod` WHERE `id_version`= ".valid($id_version)." ;");

		return $rep->fetch();
	}

	function recupDetailMaquetteProd($id_maquette){
		$rep= requette("SELECT * FROM `emb_maquette prod` WHERE `id_maquette`= ".valid($id_maquette)." ;");

		return $rep->fetch();
	}

	function deleteMaquette($id_maquette){
		$rep= requette("DELETE FROM `emb_maquette prod` WHERE `id_maquette`= ".valid($id_maquette)." ;");

		return true;
	}

	function recupeReferMiniaVersion($id_version){
		$rep= requette("SELECT `maquetteProd`,`miniatureProd` FROM `emb_version prod` WHERE `id_version`=".valid($id_version)." ;");

		return $rep->fetch();
	}

	function recupProdVersion($id_version){
		$rep= requette("SELECT `emb_produit`.`id_prod`,`nomProd` FROM `emb_produit`,`emb_version prod` WHERE `emb_produit`.`id_prod`=`emb_version prod`.`id_prod` AND `id_version`= ".valid($id_version)." ;");

		return $rep->fetch();
	}

	function ajoutVersionProd($id_prod,$donnee){
		$rep= requette("INSERT INTO `emb_version prod`(`id_version`, `id_prod`, `titreVersion`, `dateVersion`, `listeIngredientFR`, `listeIngredientAR`, `listeIngredientEN`, `listeIngredientPT`, `listeIngredientES`, `maquetteProd`, `miniatureProd`, `descriptionVersion`) VALUES (NULL, ".valid($id_prod).", '".valid($donnee['titreVersion'])."', '".valid($donnee['dateVersion'])."','','','','','',NULL,NULL,'".valid($donnee['descriptionVersion'])."') ;");

		return true;
	}

	function modifVersionProd($donnee){
		$rep= requette("UPDATE `emb_version prod` SET `titreVersion`='".valid($donnee['titreVersion'])."',`dateVersion`='".valid($donnee['dateVersion'])."', `descriptionVersion`='".valid($donnee['descriptionVersion'])."' WHERE `id_version`= ".valid($donnee['id_version'])." ;");

		return true;
	}

	function traduireIngrediant($ingrediant){
		$rep= requette("SELECT * FROM `emb_dictionnaire` WHERE REPLACE(`termeFR`,' ','') LIKE REPLACE('".valid($ingrediant)."',' ','') ;");

		return $rep->fetch();
	}
	
	function saveListeIngrediants($id_version,$listeFR,$liste){
		$rep= requette("UPDATE `emb_version prod` SET `listeIngredientFR`='".valid($listeFR)."', `listeIngredientAR`='".valid($liste['AR'])."', `listeIngredientEN`='".valid($liste['EN'])."', `listeIngredientPT`='".valid($liste['PT'])."', `listeIngredientES`='".valid($liste['ES'])."' WHERE `id_version`=".valid($id_version).";");

		return true;
	}

	function addMaquette($id_version,$donnee,$maquette){
		$dateDepot= date('Y-m-d');
		$rep= requette("INSERT INTO `emb_maquette prod`(`id_maquette`, `id_version`, `titreMaquette`, `dateDepot`, `extensionMaquette`, `tailleSourceMaquette`, `dimensionMaquette`, `descriptionMaquette`, `remarqueMaquette`, `etatMaquette`,`typeMaquette`) VALUES (null,".valid($id_version).", '".valid($donnee['titreMaquette'])."', '".valid($dateDepot)."','".valid(substr(strrchr($maquette['name'],'.') ,1))."','".valid($maquette['size'])."','".valid($donnee['dimensionMaquette'])."','".valid($donnee['descriptionMaquette'])."','','enAttente','".valid($donnee['typeMaquette'])."');");

		$rep= requette("SELECT `id_maquette` FROM `emb_maquette prod` WHERE `dateDepot`='".valid($dateDepot)."' AND `titreMaquette`= '".valid($donnee['titreMaquette'])."' ORDER BY `id_maquette` DESC LIMIT 1;");

		return $rep->fetch()['id_maquette'];
	}

	function modifMaquette($id_maquette,$donnee){
		$rep= requette("UPDATE `emb_maquette prod` SET `titreMaquette`='".valid($donnee['titreMaquette'])."', `dimensionMaquette`='".valid($donnee['dimensionMaquette'])."', `descriptionMaquette`='".valid($donnee['descriptionMaquette'])."' , `typeMaquette`='".valid($donnee['typeMaquette'])."' WHERE `id_maquette`= ".valid($id_maquette)." ;");

		return true;
	}

	function remarqueMaquette($id_maquette,$donnee){
		$rep= requette("UPDATE `emb_maquette prod` SET `remarqueMaquette`='".valid($donnee['remarqueMaquette'])."',`etatMaquette`='".valid($donnee['etatMaquette'])."' WHERE `id_maquette`= ".valid($id_maquette)." ;");

		return true;
	}

	function recupListTraduction(){
		$rep= requette("SELECT * FROM `emb_dictionnaire` ORDER BY `termeFR`");

		return $rep;
	}

	function insertTraduction($donnee){
		$rep= requette("INSERT INTO `emb_dictionnaire`(`id_terme`, `termeFR`, `termeAR`, `termeEN`, `termePT`, `termeES`) VALUES (NULL,'".valid($donnee['french'])."','".valid($donnee['arabic'])."','".valid($donnee['english'])."','".valid($donnee['portuguese'])."','".valid($donnee['spanish'])."');");
		
		return true;
	}

	function modifTraduction($donnee){
		$rep= requette("UPDATE `emb_dictionnaire` SET `termeFR`='".valid($donnee['french'])."', `termeAR`='".valid($donnee['arabic'])."', `termeEN`='".valid($donnee['english'])."', `termePT`='".valid($donnee['portuguese'])."', `termeES`='".valid($donnee['spanish'])."' WHERE `id_terme`= ".valid($donnee['id_terme'])." ;");

		return true;
	}

	function supprimeTraduction($id_terme){
		$rep= requette("DELETE FROM `emb_dictionnaire` WHERE `id_terme`= ".$id_terme." ;");

		return true;
	}

	function saveConsigne($objet,$corp){
		$tempEnvoi= date('Y-m-d H:i:s');
		$rep= requette("INSERT INTO `message` (`id_message`, `id_sender`, `objetMsg`, `jointMsg`, `corpMsg`, `id_reponseMsg`, `tempEnvoiMsg`) VALUES (NULL, '-1', '".valid($objet)."', NULL, '".valid($corp)."', NULL, '".valid($tempEnvoi)."') ;");

		$rep= requette("SELECT `id_message` FROM `message` WHERE `id_sender`=-1 AND `objetMsg`='".valid($objet)."' AND `tempEnvoiMsg`='".valid($tempEnvoi)."' LIMIT 1;");
		return $rep->fetch()['id_message'];
	}

	function recupListeUserEmb($id_user){
		$cond= " `type`='emballage' ";
		$rep= requette("SELECT `id_user` FROM `user` WHERE (".$cond.") AND id_user <> ".$id_user." ;");

		return $rep;
	}

	function envoiConsigne($id_consigne,$id_recept){
		$rep= requette("INSERT INTO `reception message` (`id_message`, `id_recepteur`, `etatMsg`, `etatConsigne`) VALUES ('".valid($id_consigne)."', '".valid($id_recept)."', 'nonLu', 'terminer') ;");

		return true;
	}



	function recupValeurNutrition($id_version){
		$rep= requette("SELECT `emb_nutrition`.`id_nutrition`,`textNutrition`, `valeurNutrition` FROM `emb_nutrition`,`emb_valeurnutr` WHERE `emb_nutrition`.`id_nutrition` = `emb_valeurnutr`.`id_nutrition`and `emb_valeurnutr`.`id_version`='".valid($id_version)."' ");

		return $rep;
	}
	
	function recupListeNutrition(){
		$rep= requette("SELECT `textNutrition` ,`id_nutrition` FROM `emb_nutrition`");

		return $rep;
	}

	function saveValeurNutri($id_version,$id_nutrition,$valeurNutrition){
        $rep= requette(" INSERT INTO `emb_valeurnutr`(`id_version`, `id_nutrition`, `valeurNutrition`) VALUES ('".valid($id_version)."','".valid($id_nutrition)."','".valid($valeurNutrition)."') ON DUPLICATE KEY UPDATE `valeurNutrition` = '".valid($valeurNutrition)."'");

        return $rep;
	}
	function modifierMaquette($id_version,$maquetteProd){
		$rep= requette( " UPDATE `emb_version prod` SET `maquetteProd`='".valid($maquetteProd)."' WHERE `id_version` = '".valid($id_version)."'");
		return $rep;
		
	}

function modifierMiniature($id_version,$miniatureProd){
		 $rep= requette(" UPDATE `emb_version prod` SET `miniatureProd`='".valid($miniatureProd)."' WHERE `id_version` = '".valid($id_version)."'");
		return $rep;
	}




	function listeGroupeProd($id_groupeProd){
		 $rep= requette("SELECT * FROM `emb_groupe prod` WHERE `id_groupe` = ".valid($id_groupeProd)."");
		return $rep;
	}

	function listeProduitGroupe($id_groupeProd){
       $rep= requette("SELECT * FROM `emb_produit` WHERE `id_groupeProd` = ".valid($id_groupeProd)." ORDER BY `emb_produit`.`nomProd` ASC ");
		return $rep;
	}
	 function listeProduit(){
	 	$rep= requette("SELECT * FROM `emb_produit` WHERE `id_groupeProd` is null ORDER BY `emb_produit`.`nomProd` ASC");
		return $rep;
	 }

function listeGroupeProduit(){
	 $rep= requette("SELECT * FROM `emb_groupe prod` WHERE `id_groupe` is null ORDER BY `emb_groupe prod`.`nomGroupeProd` ASC");
		return $rep;
}

function insertGroupeProduit($donnee){

  $rep= requette("INSERT INTO  `emb_groupe prod` (`id_groupeProd`, `nomGroupeProd`, `id_groupe`) VALUES (NULL,'".valid($donnee['nomGroupeProd'])."', ".valid($donnee['id_groupeProd']).");");
 
    return $rep;
}

function deleteGroupeProd($id_groupeProd){
	 $rep= requette("DELETE FROM `emb_groupe prod` WHERE `emb_groupe prod`.`id_groupeProd` = ".valid($id_groupeProd)."");
   
}
function updateGroupe($id_groupeProd,$donnee){
	$rep= requette("UPDATE `emb_groupe prod` SET `nomGroupeProd` = '".valid($donnee['nomGroupeProd'])."', `id_groupe` = ".valid($donnee['id_groupeProd'])." WHERE `emb_groupe prod`.`id_groupeProd` = ".valid($id_groupeProd).";");
    return $rep;
}  
function recupListFournisseur(){
		$rep= requette("SELECT * FROM `emb_fournisseur`");
		return $rep;
	}
 function deleteFournissuer($id_fournisseur){
 	 $rep= requette("DELETE FROM `emb_fournisseur` WHERE `id_fournisseur` = ".valid($id_fournisseur)."");
 } 
  function insertFournisseur($nom){  
  	$rep= requette("INSERT INTO `emb_fournisseur` (`id_fournisseur`, `nomFournisseur`) VALUES (NULL,'".valid($nom)."');");
    return $rep;
  	
  }   

  function updateFournissuer($id_fournisseur,$nomFournisseur){
   $rep= requette(" UPDATE `emb_fournisseur` SET `nomFournisseur` = '".valid($nomFournisseur)."' WHERE `id_fournisseur` = ".valid($id_fournisseur).";");
		return $rep;
  }

  
/***************************/
	function valid($chaine){
		$char= array("'", "\"", "`");
		$remp= array("\'", "\\\"", "\`");
		return htmlspecialchars(trim(str_replace($char, $remp, $chaine)));
	}

