<?php

require('model/bdConnect.php');

	function recupListUsers($droitAdmin=','){
		if($droitAdmin!=',') $droitAdmin= " AND `type`<> 'admin' "; else $droitAdmin="";

		$rep= requette("SELECT * FROM `user` WHERE `active`= 1 ".$droitAdmin." ;");

		return $rep;
	}

	function recupListLignesP($droitAdmin=','){
		if($droitAdmin!=',') $droitAdmin= " AND '".$droitAdmin."' LIKE CONCAT('%,',`id_unite`,',%') ";
		else $droitAdmin="";
		$rep= requette("SELECT * FROM `ligne production`  WHERE `active`= 1 AND `id_unite` IN (SELECT `id_unite` FROM `unite production` WHERE `active`=1 ".$droitAdmin.") ORDER BY `id_categorie` DESC;");

		return $rep;
	}

	function recupListLignesOfCategorie($categorie,$droitAdmin=','){
		if($droitAdmin!=',') $droitAdmin= " AND '".$droitAdmin."' LIKE CONCAT('%,',`id_unite`,',%') ";
		else $droitAdmin="";

		if($categorie=='') $categorie= " IS NULL"; else $categorie= " = ".valid($categorie);

		$rep= requette("SELECT * FROM `ligne production`  WHERE `active`= 1 AND `id_categorie`".valid($categorie)." AND `id_unite` IN (SELECT `id_unite` FROM `unite production` WHERE `active`=1 ".$droitAdmin.");");

		return $rep;
	}

	function recupNomCategorie($id_categorie){
		$rep= requette("SELECT `nomCategorie` FROM `categorie` WHERE `id_categorie` = '".valid($id_categorie)."';");

		if($result=$rep->fetch())return $result['nomCategorie'];
		 else return 'Autre';
	}

	function recupListCategorie(){
		$rep= requette("SELECT * FROM `categorie` WHERE 1;");

		return $rep;
	}

	function ajoutCategorie($nomCategorie){
		$rep= requette("INSERT INTO `categorie` (`id_categorie`, `nomCategorie`) VALUES (NULL, '".valid($nomCategorie)."');");

		return true;
	}

	function modifCategorie($id_categorie,$nomCategorie){
		$rep= requette("UPDATE `categorie` SET `nomCategorie` = '".valid($nomCategorie)."' WHERE `id_categorie` = '".valid($id_categorie)."';");

		return true;
	}

	function supprimeCategorie($id_categorie){
		$rep= requette("DELETE FROM `categorie` WHERE `categorie`.`id_categorie` = '".valid($id_categorie)."';");

		return true;
	}
	
	function recupListProds($droitAdmin=','){
		if($droitAdmin!=',') $droitAdmin= " AND '".$droitAdmin."' LIKE CONCAT('%,',`id_unite`,',%') ";
		else $droitAdmin="";

		$rep= requette("SELECT * FROM `produit`  WHERE `active`= 1 AND `id_ligneP` IN (SELECT `id_ligneP` FROM `ligne production`  WHERE `active`= 1 AND `id_unite` IN (SELECT `id_unite` FROM `unite production` WHERE `active`=1 ".$droitAdmin.")) ORDER BY `id_ligneP`;");

		return $rep;
	}

	function recupInfoUser($id_user){
		$rep= requette("SELECT `nomComplet`,`login`,`type` FROM `user` WHERE `id_user`= ".valid($id_user)." ;");

		return ($rep)? $rep->fetch() : null;
	}

	function recupListLigneAffect($id_user){
		$rep= requette("SELECT `id_ligneP`,`nomLigneP`,`nomUnite` FROM `ligne production`,`unite production` WHERE `ligne production`.`active`=1 AND `unite production`.`active`=1 AND `ligne production`.`id_unite`=`unite production`.`id_unite` AND `id_ligneP` IN (SELECT `id_ligneP` FROM `affectation control` WHERE `id_user` = ".valid($id_user).") ;");

		return $rep;
	}

	function recupListUniteAffect($id_user){
		$rep= requette("SELECT * FROM `unite production` WHERE `unite production`.`active`=1 AND `id_unite` IN (SELECT `id_unite` FROM `affectation admin` WHERE `id_user` = ".valid($id_user).") ;");

		return $rep;
	}

	function affectUserLigne($id_user,$id_ligneP){
		$rep= requette("INSERT INTO `affectation control`(`id_user`, `id_ligneP`) VALUES (".valid($id_user).",".valid($id_ligneP).") ;");

		return true;
	}

	function affectUserUnite($id_user,$id_unite){
		$rep= requette("INSERT INTO `affectation admin`(`id_user`, `id_unite`) VALUES (".valid($id_user).",".valid($id_unite).") ;");

		return true;
	}

	function suprAffectLigne($id_user,$id_ligneP){
		$rep= requette("DELETE FROM `affectation control` WHERE `id_user`= ".valid($id_user)." AND `id_ligneP`= ".valid($id_ligneP)." ;");

		return true;
	}

	function suprAffectUnite($id_user,$id_unite){
		$rep= requette("DELETE FROM `affectation admin` WHERE `id_user`= ".valid($id_user)." AND `id_unite`= ".valid($id_unite)." ;");

		return true;
	}

	function supprUser($id_user){
		$rep= requette("DELETE FROM `user` WHERE `id_user`= ".valid($id_user)." ;");

		return $rep;
	}

	function desactiveUser($id_user){
		$rep= requette("UPDATE `user` SET `active` = 0 WHERE `user`.`id_user` = ".valid($id_user)." ;");

		return $rep;
	}

	function modifUser($id_user,$info){
		$mdp = (isset($info['mdp']))? ", `mdp`= SHA1('".valid($info['mdp'])."') " : '';

		$rep= requette("UPDATE `user` SET `nomComplet`='".valid($info['nomUser'])."', `login`='".valid($info['login'])."', `type`='".valid($info['type'])."' ".$mdp." WHERE `id_user`= ".valid($id_user)." ;");

		return true;
	}

	function ajoutUser($info){
		$rep= requette("INSERT INTO `user` (`id_user`, `nomComplet`, `login`, `mdp`, `type`, `active`) VALUES (NULL, '".valid($info['nomUser'])."', '".valid($info['login'])."', SHA1('".valid($info['mdp'])."'), '".valid($info['type'])."', 1) ON DUPLICATE KEY UPDATE `active`=1 ;");

		$user= requette("SELECT `id_user` FROM `user` WHERE `nomComplet` = '".valid($info['nomUser'])."' ORDER BY `id_user` DESC LIMIT 1")->fetch();
		return $user['id_user'];
	}

	function recupNomLigne($id_ligneP){
		$rep= requette("SELECT `nomLigneP` FROM `ligne production` WHERE `id_ligneP` IN (SELECT `id_ligneP` FROM `produit` WHERE `id_ligneP` = ".valid($id_ligneP).");");

		if($ligne=$rep->fetch()) return $ligne['nomLigneP'];
		else return null;
	}

	function recupInfoProd($id_prod){
		$rep= requette("SELECT * FROM `produit` WHERE `id_prod` = ".valid($id_prod).";");

		if($prod=$rep->fetch()) return $prod;
		else return false;
	}

	function recupNormeProdNotGBT($id_prod){  // recupérer la liste des normes sans Groupe,Booleen,Texte.
		$rep= requette("SELECT * FROM `norme` WHERE `typeNorme` <> 'groupe' AND `typeNorme` <> 'booleen' AND `typeNorme` <> 'texte' AND `active`= 1 AND `id_prod` = ".valid($id_prod)." ORDER BY `ordreNorme`");

		return $rep;
	}

	function recupNormeProd($id_prod,$colone=""){
		if($colone!="") $colone = 'AND `colone` = '.$colone;
		$rep= requette("SELECT * FROM `norme` WHERE `id_groupeN` IS NULL ".$colone." AND `active`= 1 AND `id_prod` = ".valid($id_prod)." ORDER BY `ordreNorme`");

		return $rep;
	}

	function recupNormeProdByNom($id_prod,$nomNorme){
		$rep= requette("SELECT `id_norme` FROM `norme` WHERE `nomNorme`= '".valid($nomNorme)."' AND `id_prod`= ".valid($id_prod)." ;");

		return $rep->fetch()['id_norme'];
	}

	function recupNormeGroupeN($id_groupeN){
		$rep= requette("SELECT * FROM `norme` WHERE `id_groupeN` = ".valid($id_groupeN)." AND `active`= 1 ORDER BY `ordreNorme`");

		return $rep;
	}

	function modifLigneP($id_ligneP,$donnee){
		if($donnee['categorie']=='')$donnee['categorie']='NULL';
		$rep= requette("UPDATE `ligne production` SET `nomLigneP` = '".valid($donnee['nomLigneP'])."', `id_categorie`=".valid($donnee['categorie']).", `id_unite` = '".valid($donnee['unite'])."' WHERE `ligne production`.`id_ligneP` = ".valid($id_ligneP).";");

		return true;
	}

	function modifProd($id_prod,$donnee){
		$rep= requette("UPDATE `produit` SET `nomProd` = '".valid($donnee['nomProd'])."', `id_ligneP` = '".valid($donnee['ligne'])."' WHERE `produit`.`id_prod` = ".valid($id_prod).";");

		return true;
	}

	function recupNorme($id_norme){
		$rep= requette("SELECT * FROM `norme` WHERE `id_norme` = ".valid($id_norme).";");

		return $rep->fetch();
	}

	function modifNorme($id_norme,$donnee,$lienNorme){
		$lienNorme= ($lienNorme)? ",`lienNorme`='".valid($lienNorme)."' " : '';

		$rep= requette("UPDATE `norme` SET `nomNorme`='".valid($donnee['nomNorme'])."',`Abreviation`='".valid($donnee['Abreviation'])."',`typeNorme`='".valid($donnee['typeNorme'])."' ".$lienNorme.",`formuleNorme`='".valid($donnee['formuleNorme'])."',`uniteMesure`='".valid($donnee['uniteMesure'])."',`messageErreur`='".valid($donnee['messageErreur'])."',`isReset`=".valid($donnee['isReset'])." ,`parTime`='".valid($donnee['parTime'])."' ,`ordreNorme`=".valid($donnee['ordreNorme']).",`id_groupeN`=".valid($donnee['groupeN'])." ,`colone`=".valid($donnee['colone'])." WHERE `id_norme` = ".valid($id_norme)." ;");

		return true;
	}

	function modifFormuleNorme($id_norme,$formule){
		$rep= requette("UPDATE `norme` SET `formuleNorme` = '".valid($formule)."' WHERE `id_norme` = ".valid($id_norme)." ;");

		return true;
	}

	function ajoutNorme($id_prod,$donnee,$lienNorme){
		$rep= requette("INSERT INTO `norme`(`id_norme`, `nomNorme` ,`Abreviation`, `typeNorme`, `lienNorme`, `formuleNorme`, `uniteMesure`, `messageErreur`, `isReset`, `parTime`, `ordreNorme`, `id_groupeN`, `colone`, `id_prod`, `active`) VALUES (null,'".valid($donnee['nomNorme'])."','".valid($donnee['Abreviation'])."','".valid($donnee['typeNorme'])."','".valid($lienNorme)."','".valid($donnee['formuleNorme'])."','".valid($donnee['uniteMesure'])."','".valid($donnee['messageErreur'])."',".valid($donnee['isReset']).",'".valid($donnee['parTime'])."','".valid($donnee['ordreNorme'])."',".valid($donnee['groupeN']).",'".valid($donnee['colone'])."','".valid($id_prod)."', 1 );");

		$result= requette("SELECT `id_norme` FROM `norme` WHERE `id_prod`='".valid($id_prod)."' AND `nomNorme`='".valid($donnee['nomNorme'])."' ORDER BY `id_norme` DESC LIMIT 1");
		return $result->fetch()['id_norme'];
	}

	function ajoutLigneP($donnee){
		if($donnee['categorie']=='')$donnee['categorie']='NULL';
		
		$rep= requette("INSERT INTO `ligne production`(`id_ligneP`, `nomLigneP`, `id_categorie`, `id_unite`, `active`) VALUES (null,'".valid($donnee['nomLigneP'])."',".valid($donnee['categorie']).",".valid($donnee['unite']).", 1);");
		return true;
	}

	function ajoutUniteP($donnee){
		$rep= requette("INSERT INTO `unite production`(`id_unite`, `nomUnite`, `adresseUnite`) VALUES (null,'".valid($donnee['nomUniteP'])."', '".valid($donnee['adresseUniteP'])."');");
	}

	function modifUniteP($id_unite,$donnee){
		$rep= requette("UPDATE `unite production` SET `nomUnite` = '".valid($donnee['nomUniteP'])."', `adresseUnite` = '".valid($donnee['adresseUniteP'])."' WHERE `unite production`.`id_unite` = ".valid($id_unite).";");
	}

	function recupListUnite($droitAdmin=','){
		if($droitAdmin!=',') $droitAdmin= " AND '".$droitAdmin."' LIKE CONCAT('%,',`id_unite`,',%') ";
		else $droitAdmin="";
		
		$rep= requette("SELECT * FROM `unite production` WHERE `active`=1 ".$droitAdmin.";");
		
		return $rep;
	}

	function recupNomUnite($id_unite){
		$rep= requette("SELECT `nomUnite` FROM `unite production` WHERE `id_unite` = ".valid($id_unite)." ;");
		
		if($result=$rep->fetch())return $result['nomUnite'];
		 else return false;
	}

	function supprNorm($id_norme){
		$rep= requette("DELETE FROM `norme` WHERE `id_norme` = ".valid($id_norme)." ;");

		return $rep;
	}
	
	function desactiveNorm($id_norme){
		$rep= requette("UPDATE `norme` SET `active` = 0 WHERE `norme`.`id_norme` = ".valid($id_norme)." ;");

		return $rep;
	}

	function ajoutProd($donnee){
		$rep= requette("INSERT INTO `produit`(`id_prod`, `nomProd`, `id_ligneP`, `active`) VALUES (null,'".valid($donnee['nomProd'])."',".valid($donnee['ligne']).", 1);");

		$prod= requette("SELECT `id_prod` FROM `produit` WHERE `nomProd` = '".valid($donnee['nomProd'])."' ORDER BY `id_prod` DESC LIMIT 1")->fetch();
		return $prod['id_prod'];
	}

	function supprProd($id_prod){
		$rep= requette("DELETE FROM `produit` WHERE `id_prod` = ".valid($id_prod)." ;");

		return $rep;
	}
	
	function desactiveProd($id_prod){
		$rep= requette("UPDATE `produit` SET `active` = 0 WHERE `produit`.`id_prod` = ".valid($id_prod)." ;");

		return $rep;
	}

	function supprLigneP($id_ligneP){
		$rep= requette("DELETE FROM `ligne production` WHERE `id_ligneP` = ".valid($id_ligneP)." ;");

		return $rep;
	}
	
	function desactiveLigneP($id_ligneP){
		$rep= requette("UPDATE `ligne production` SET `active` = 0 WHERE `ligne production`.`id_ligneP` = ".valid($id_ligneP)." ;");

		return $rep;
	}

	function supprUniteP($id_unite){
		$rep= requette("DELETE FROM `unite production` WHERE `unite production`.`id_unite` = ".valid($id_unite)." ;");

		return $rep;
	}
	
	function desactiveUniteP($id_unite){
		$rep= requette("UPDATE `unite production` SET `active` = 0 WHERE `unite production`.`id_unite` = ".valid($id_unite)." ;");

		return $rep;
	}

	function recupGroupeNProd($id_prod){
		$rep= requette("SELECT `id_norme` AS 'id_groupeN',`nomNorme` AS 'nomGroupeN' FROM `norme` WHERE `typeNorme`='groupe' AND `id_prod` = ".valid($id_prod)." ;");
		
		return $rep;
	}

	function modifGroupeN($id_groupeN,$donnee,$lienGroupe){
		$lienGroupe= ($lienGroupe)? ",`lienNorme`='".valid($lienGroupe)."' " : '';
		$rep= requette("UPDATE `norme` SET `nomNorme`='".valid($donnee['nomGroupeN'])."' ".$lienGroupe." ,`ordreNorme`=".valid($donnee['ordreGroupeN']).", `id_groupeN`=".valid($donnee['groupeN']).", `colone`=".valid($donnee['colone'])." WHERE `id_norme` = ".valid($id_groupeN)." ;");

		return true;
	}

	function ajoutgroupeN($id_prod,$donnee,$lienGroupe){
		$rep= requette("INSERT INTO `norme`(`id_norme`, `nomNorme`, `typeNorme`, `lienNorme`, `formuleNorme`, `uniteMesure`, `messageErreur`, `isReset`, `parTime`, `ordreNorme`, `id_groupeN`, `colone`, `id_prod`, `active`) VALUES (null,'".valid($donnee['nomGroupeN'])."','groupe','".valid($lienGroupe)."', '','','','','0','".valid($donnee['ordreGroupeN'])."',".valid($donnee['groupeN']).",".valid($donnee['colone']).",".valid($id_prod).", 1 );");
	}

/*nabil*/
function recuplisteDocument($id_prod){
	  $rep= requette("SELECT * FROM `document_prod` WHERE `id_prod` = ".valid($id_prod)."");
    return $rep;
}

function recupDetailDoc($id_docProd){
	  $rep= requette("SELECT * FROM `document_prod` WHERE `id_docProd` = ".valid($id_docProd)."");
   return $rep->fetch();
}

function ajouterDocument($id_prod,$donnee){
    $rep= requette("INSERT INTO `document_prod`(`id_docProd`, `id_prod`, `nomDocument`, `fileDocument`, `typeDocument`, `descriptionDoc`) VALUES (NULL,'".valid($id_prod)."','".valid($donnee['nomDocument'])."', '','','".valid($donnee['descriptionDoc'])."') ;");

    $result= requette("SELECT `id_docProd` FROM `document_prod` WHERE `nomDocument`='".valid($donnee['nomDocument'])."' AND `descriptionDoc`='".valid($donnee['descriptionDoc'])."' AND `id_prod`='".valid($id_prod)."' ORDER BY `id_docProd` DESC LIMIT 1;");
    
    return $result->fetch()['id_docProd'];
}

function ajouterLienDocument($id_document,$document,$typeDocument){
    $rep= requette("UPDATE `document_prod` SET `fileDocument`='".valid($document)."',`typeDocument`='".valid($typeDocument)."' WHERE `id_docProd`='".valid($id_document)."' ;");
    
    return true;
}

function recupNomFileDocumentProd($id_document){
    $rep= requette("SELECT `fileDocument` FROM `document_prod` WHERE `id_docProd`= '".valid($id_document)."' ");
    $result=$rep->fetch();
    if($result && !empty($result["fileDocument"])) return $result["fileDocument"];
    else return '!:!';

}

function modifierDocument($id_document,$donnee){
    $rep= requette("UPDATE `document_prod` SET `nomDocument`='".valid($donnee['nomDocument'])."',`descriptionDoc`='".valid($donnee['descriptionDoc'])."' WHERE `id_docProd`='".valid($id_document)."' ;");
    
    return true;
}

function deleteDocument($id_document){
    $rep= requette("DELETE FROM `document_prod` WHERE `id_docProd`='".valid($id_document)."' ;");
    
    return true;
}


/*nabil*/


/**************************************/
	
	function valid($chaine){
		$char= array("'", "\"", "`");
		$remp= array("\'", "\\\"", "\`");
		return htmlspecialchars(str_replace($char, $remp, $chaine));
	}