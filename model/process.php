<?php

require('model/bdConnect.php');

	function recupToutProduit($id_user){
		$rep= requette("SELECT `produit`.`id_ligneP`,`nomLigneP`,`id_prod`,`nomProd`,`ligne production`.`id_categorie` FROM `produit`, `ligne production`  WHERE `produit`.`active`= 1 AND `ligne production`.`active`= 1 AND `ligne production`.`id_unite` IN (SELECT `id_unite` FROM `unite production` WHERE `active`=1) AND `produit`.`id_ligneP` = `ligne production`.`id_ligneP` AND `produit`.`id_ligneP` IN ( SELECT `id_ligneP` FROM `affectation control` WHERE `id_user` = ".valid($id_user)." ) ORDER BY `id_ligneP`");

		return $rep;
	}

	function recupProduitsLigne($id_ligneP){
		$rep= requette("SELECT * FROM `produit` WHERE `active`= 1 AND `id_ligneP` = ".valid($id_ligneP)." ;");

		return $rep;
	}

	function recupNomCategorie($id_categorie){
		$rep= requette("SELECT `nomCategorie` FROM `categorie` WHERE `id_categorie` = '".valid($id_categorie)."';");

		$result=$rep->fetch();
		if($result && $result!='')return $result['nomCategorie'];
		 else return 'Autre';
	}

	function recupNormeProduit($id_prod,$id_groupeN=null,$colone=null){
		$condG= ($id_groupeN==null)? 'IS NULL' : '= '.$id_groupeN;
		$condCol= ($colone==null)? '' : ' AND `colone`='.$colone;

		$rep= requette("SELECT * FROM `norme` WHERE `active`= 1 AND `id_groupeN` ".$condG.$condCol." AND `id_prod`= ".valid($id_prod)." ORDER BY `ordreNorme`;");
		
		return $rep;
	}

	function recupNomFileDocumentNorme($id_norme){
    	$rep= requette("SELECT `lienNorme` FROM `norme` WHERE `id_norme`= '".valid($id_norme)."' ");
        $result=$rep->fetch();
    	if($result &&  !empty($result["lienNorme"])) return $result["lienNorme"];
    	else return '!:!';
	}	

	function recupLigne($id_prod){
		$rep= requette("SELECT `id_ligneP`,`nomLigneP` FROM `ligne production` WHERE `id_ligneP` IN (SELECT `id_ligneP` FROM `produit` WHERE `id_prod` = ".valid($id_prod).");");

		if($ligne=$rep->fetch()) return $ligne;
			else return false;
	}

	function autorisation($id_ligneP, $id_user){
		$rep= requette("SELECT * FROM `affectation control` WHERE `id_user`= ".valid($id_user)." AND `id_ligneP` = ".valid($id_ligneP).";");
		
		if($rep->fetch()) return true;
			else return false;
	}

	function ouvrirDernierPassage($id_prod, $id_user){
		$rep= requette("SELECT `id_passage`,`dateHeure` FROM `passage` WHERE `id_prod` = ".valid($id_prod)." AND `id_user` = ".valid($id_user)." AND `etatPassage` <> 'terminé'  ORDER BY `dateHeure` DESC LIMIT 1;");
		
		if($passage=$rep->fetch()) return $passage;
			else return null;
	}

	function nomProduit($id_prod){
		$rep= requette("SELECT `nomProd` FROM `produit` WHERE `id_prod` = ".valid($id_prod).";");
		
		 return $rep->fetch()['nomProd'];
	}

	function ajoutPassage($id_prod, $id_user, $groupe){
		$rep= requette("INSERT INTO `passage` (`id_passage`, `id_user`, `groupeUser`, `id_prod`, `dateHeure`, `etatPassage`, `observation`) VALUES (NULL, '".valid($id_user)."', '".valid($groupe)."', '".valid($id_prod)."', '".date('Y-m-d H:i:s')."', 'en-cours', '');");

		return true;
	}

	function recupOldPassage($id_prod, $id_user){
		$rep= requette("SELECT `id_passage` FROM `passage` WHERE `id_prod` = ".valid($id_prod)." AND `id_user` = ".valid($id_user)." AND `etatPassage` = 'terminé'  ORDER BY `dateHeure` DESC LIMIT 1;");

		//return $rep->fetch()['id_passage'];
		// Vérifier si la requête a renvoyé des résultats
		if ($rep && $row = $rep->fetch()) {
			return $row['id_passage'];
		} else {
			// Gérer le cas où aucune ligne n'a été trouvée
			return null; 
		}
	}

	function recupValNorm($id_passage,$id_norme,$id_oldPassage=false){
		$rep= requette("SELECT `valeurSaisie` FROM `saisie` WHERE `id_passage`= ".valid($id_passage)." AND `id_norme`= ".valid($id_norme)." ;");
		
		if($a=$rep->fetch()) return $a['valeurSaisie'];
		elseif($id_oldPassage) return recupValNorm($id_oldPassage,$id_norme);
		else return null;
	}

	function saveNormeBD($id_passage,$id_norme,$valeurSaisie){
		$rep= requette("INSERT INTO `saisie` (`id_passage`, `id_norme`, `valeurSaisie`) VALUES ('".valid($id_passage)."', '".valid($id_norme)."', '".valid($valeurSaisie)."')  ON DUPLICATE KEY UPDATE `valeurSaisie`='".valid($valeurSaisie)."' ;");
		

		// $rep= requette("UPDATE `passage` SET `etatPassage` = 'en-cours' WHERE `id_passage` = ".valid($id_passage)." AND `etatPassage` = 'vide' ;");
	}

	function terminePassageBD($id_passage,$comment){
		$rep= requette("UPDATE `passage` SET `etatPassage` = 'terminé', `observation` = '".valid($comment)."' WHERE `passage`.`id_passage` = ".valid($id_passage)." ;");
	}

	function recupLastTimeNorme($id_norme, $id_user){
		$rep= requette("SELECT `dateHeure`, `saisie`.`id_passage` FROM `passage`,`saisie` WHERE `id_norme`= ".$id_norme." AND `id_user` = ".$id_user." AND `passage`.`etatPassage`='terminé' AND `passage`.`id_passage` = `saisie`.`id_passage` ORDER BY `id_passage` DESC LIMIT 1");

		//return $rep->fetch()['dateHeure'];
		// Vérifier si la requête a renvoyé des résultats
		if ($rep && $row = $rep->fetch()) {
			return $row['dateHeure'];
		} else {
			// Gérer le cas où aucune ligne n'a été trouvée
			return null; 
		}
	}

	function recuplisteDocument($id_prod){
		$rep= requette("SELECT * FROM `document_prod` WHERE `id_prod` = ".valid($id_prod)."");
    	return $rep;
	}

	function recupNomFileDocumentProd($id_document){
    	$rep= requette("SELECT `fileDocument` FROM `document_prod` WHERE `id_docProd`= '".valid($id_document)."' ");
          
           $result=$rep->fetch();
         if($result && !empty($result["fileDocument"])) return $result["fileDocument"];
            else return '!:!'; 

	}

	
	
/***************************************/
	function valid($chaine){
		$char= array("'", "\"", "`");
		$remp= array("\'", "\\\"", "\`");
		if($chaine)
		return htmlspecialchars(str_replace($char, $remp, $chaine));
	}
/*********************** */
function get_passage_values($id_passage){
    $req = requette("SELECT CONCAT('CQ_', l.AbreviationLigne, '_Recette_') AS TagName, n.Abreviation,s.valeurSaisie,n.uniteMesure FROM saisie s INNER JOIN norme n ON s.id_norme = n.id_norme 
	INNER JOIN passage p ON s.id_passage = p.id_passage
	INNER JOIN produit pr ON pr.id_prod = p.id_prod
	INNER JOIN `ligne production` l ON pr.id_ligneP = l.id_ligneP 
	WHERE n.`Abreviation` in 
	('Poids_Total_g','Poids_Chocolat_g','Poids_Fourrage1_g','Poids_Fourrage2_g','Poids_Inclusions1_g','Poids_Inclusions2_g','Poids_Biscuit_Seul_g')
	AND p.id_passage = ".valide($id_passage).";");
      return $req;
}

function recupIdLastMsg($id_sender,$objetMsg,$tempEnvoiMsg){
	$rep= requette("SELECT `id_message` FROM `message` WHERE `id_sender`=".valid($id_sender)." AND `objetMsg`='".valid($objetMsg)."' AND `tempEnvoiMsg`='".valid($tempEnvoiMsg)."' ;");
	
	return $rep->fetch()['id_message'];
}

function enregistrMsg($id_user,$donnee,$tempEnvoi,$id_reponseMsg){
	$donnee['objetMsg'] = isset($donnee['objetMsg']) ? $donnee['objetMsg'] : '';
	$rep= requette("INSERT INTO `message` (`id_message`, `id_sender`, `objetMsg`, `corpMsg`, `id_reponseMsg`, `tempEnvoiMsg`) VALUES (NULL, '".valid($id_user)."', '".valid($donnee['objetMsg'])."',  '".valid($donnee['corpMsg'])."', ".valid($id_reponseMsg).", '".valid($tempEnvoi)."');");
}

function affectMsg($id_message,$id_recepteur,$etatConsigne="NULL"){
	$etatConsigne= ($etatConsigne!="NULL")? "'".$etatConsigne."'" : $etatConsigne; 

	$rep= requette("INSERT INTO `reception message` (`id_message`, `id_recepteur`, `etatMsg`, `etatConsigne`) VALUES ('".valid($id_message)."', '".valid($id_recepteur)."', 'nonLu', ".$etatConsigne.");");
}

function recupAdminId(){
	$type = valide('admin');
	$rep= requette("SELECT `id_user` FROM `user` WHERE `type` = '".$type."';");
	
	return $rep;
}
