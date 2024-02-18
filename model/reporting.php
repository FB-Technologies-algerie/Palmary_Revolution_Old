<?php

require('model/bdConnect.php');

   
   function recupListUnite(){
		
		$rep= requette("SELECT * FROM `unite production` WHERE `active`=1");
		
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

	function recupListProdsOfUnite($id_unite){
		$rep= requette("SELECT `id_prod`,`nomProd` FROM `produit`, `ligne production`,`unite production`  WHERE `produit`.`active`= 1 AND `produit`.`id_ligneP`= `ligne production`.`id_ligneP` and `ligne production`.`id_unite` =`unite production`.`id_unite`   and `unite production`.`id_unite` =".valid($id_unite)." ;");

		return $rep;
	} 

   function recupListProduits(){
		$rep= requette("SELECT `id_prod`,`nomProd` FROM `produit`  WHERE `active`= 1  ;");

		return $rep;
	}

 
     function selectGroupeNorme($id_prod,$id_groupe=null){
        
        if($id_groupe==null) $modif =  "id_groupeN is null";
         else $modif= "id_groupeN  = ".valid($id_groupe)."";
           
        $rep= requette("select id_norme, nomNorme FROM `norme` where `typeNorme`= 'groupe' and ".$modif." and id_prod =  ".valid($id_prod)." ");
              
        return $rep;
       } 

     function recuplisteNormeGroupeProduit($id_groupeN){ 
            $rep= requette("SELECT  id_norme,`nomNorme` FROM `norme` where (`typeNorme`='valeur' or `typeNorme`='intervalle' or `typeNorme`='formule')  and id_groupeN  = ".valid($id_groupeN)." ");

		return $rep;
     }

    function recupValeurSaisieParPassage($dateD,$dateF,$idNorme1,$idNorme2){ 
		$rep= requette("SELECT `passage`.`id_passage`,(SELECT `valeurSaisie` FROM `saisie` WHERE `passage`.`id_passage`=`saisie`.`id_passage` AND `saisie`.`id_norme`='".valid($idNorme1)."') AS 'val1', (SELECT `valeurSaisie` FROM `saisie` WHERE `passage`.`id_passage`=`saisie`.`id_passage` AND `saisie`.`id_norme`='".valid($idNorme2)."') AS 'val2', DATE_FORMAT(`dateHeure`,'%Y-%m-%d') AS `jour` ,`nomProd` FROM `saisie`,`passage`,`produit` WHERE '_".valid($idNorme1)."_".valid($idNorme2)."_' LIKE CONCAT('%\_',`saisie`.`id_norme`,'\_%') and `passage`.`id_passage` IN(SELECT `passage`.`id_passage` FROM `passage` where `id_prod` IN (SELECT `id_prod` FROM `norme` WHERE '_".valid($idNorme1)."_".valid($idNorme2)."_' LIKE CONCAT('%\_',`saisie`.`id_norme`,'\_%') group by `id_prod`) and `dateHeure` BETWEEN '".valid($dateD)." 07:00:00' AND '".valid($dateF)." 07:00:00') and `passage`.`id_passage` = `saisie`.`id_passage` and `passage`.`id_prod` =`produit`.`id_prod` ORDER BY `passage`.`id_passage`;");

		return $rep;
	}

	function recupValeurSaisieParGroupe($dateD,$dateF,$idNorme1,$idNorme2){ 
		$rep= requette("SELECT concat(`groupeUser`,', ', DATE_FORMAT(`dateHeure`,'%Y-%m-%d') ) AS `groupe`, `groupeUser`, ROUND(AVG((SELECT `valeurSaisie` FROM `saisie` WHERE `passage`.`id_passage`=`saisie`.`id_passage` AND `saisie`.`id_norme`='".valid($idNorme1)."')), 2) AS 'val1', ROUND(AVG((SELECT `valeurSaisie` FROM `saisie` WHERE `passage`.`id_passage`=`saisie`.`id_passage` AND `saisie`.`id_norme`='".valid($idNorme2)."')), 2) AS 'val2', DATE_FORMAT(`dateHeure`,'%Y-%m-%d') AS `jour` FROM `saisie`,`passage`,`produit` WHERE '_".valid($idNorme1)."_".valid($idNorme2)."_' LIKE CONCAT('%\_',`saisie`.`id_norme`,'\_%') and `passage`.`id_passage` IN(SELECT `passage`.`id_passage` FROM `passage` where `id_prod` IN (SELECT `id_prod` FROM `norme` WHERE '_".valid($idNorme1)."_".valid($idNorme2)."_' LIKE CONCAT('%\_',`saisie`.`id_norme`,'\_%') group by `id_prod`) and `dateHeure` BETWEEN '".valid($dateD)." 07:00:00' AND '".valid($dateF)." 07:00:00') and `passage`.`id_passage` = `saisie`.`id_passage` and `passage`.`id_prod` =`produit`.`id_prod` GROUP BY `jour`,`groupeUser` ORDER BY `jour`;");

		return $rep;
	}

	function recupValeurSaisieParJour($dateD,$dateF,$idNorme1,$idNorme2){ 
		$rep= requette("SELECT ROUND(AVG((SELECT `valeurSaisie` FROM `saisie` WHERE `passage`.`id_passage`=`saisie`.`id_passage` AND `saisie`.`id_norme`='".valid($idNorme1)."')), 2) AS 'val1', ROUND(AVG((SELECT `valeurSaisie` FROM `saisie` WHERE `passage`.`id_passage`=`saisie`.`id_passage` AND `saisie`.`id_norme`='".valid($idNorme2)."')), 2) AS 'val2', DATE_FORMAT(`dateHeure`,'%Y-%m-%d') AS `jour` FROM `saisie`,`passage`,`produit` WHERE '_".valid($idNorme1)."_".valid($idNorme2)."_' LIKE CONCAT('%\_',`saisie`.`id_norme`,'\_%') and `passage`.`id_passage` IN(SELECT `passage`.`id_passage` FROM `passage` where `id_prod` IN (SELECT `id_prod` FROM `norme` WHERE '_".valid($idNorme1)."_".valid($idNorme2)."_' LIKE CONCAT('%\_',`saisie`.`id_norme`,'\_%') group by `id_prod`) and `dateHeure` BETWEEN '".valid($dateD)." 07:00:00' AND '".valid($dateF)." 07:00:00') and `passage`.`id_passage` = `saisie`.`id_passage` and `passage`.`id_prod` =`produit`.`id_prod` GROUP BY `jour` ORDER BY `jour`;");

		return $rep;
	}

	function recupNomNorme($idNorme){
		$rep= requette("SELECT `nomNorme` FROM `norme` WHERE `id_norme`=".valid($idNorme).";");
		
		if($res= $rep->fetch()) return $res['nomNorme'];
	}



/*********************************************************************/
	function valid($chaine){
		$char= array("'", "\"", "`");
		$remp= array("\'", "\\\"", "\`");
		return htmlspecialchars(str_replace($char, $remp, $chaine));
	}