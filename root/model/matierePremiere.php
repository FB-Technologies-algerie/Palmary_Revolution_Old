<?php
require('model/bdConnect.php');
 

    function arrivageMatierePremiere(){
    	$rep= requette("SELECT * FROM `lab_arrivage`,`lab_matiere`,`lab_groupe_matiere` WHERE `lab_arrivage`.`id_matiere` = `lab_matiere`.`id_matiere` and `lab_matiere`.`idGroupeMatiere` = `lab_groupe_matiere`.`id_groupe_mat`");
    	return $rep;
	}
    function groupeMatiere(){
	    $rep= requette("SELECT `idGroupeMatiere` FROM `lab_matiere` where `idGroupeMatiere` is not null group by `idGroupeMatiere`");
     // SELECT * FROM `lab_matiere`,`lab_groupe_matiere` where `lab_groupe_matiere`.`id_groupeParent` = `lab_matiere`.`idGroupeMatiere` AND `idGroupeMatiere` is not null group by `id_groupe_mat`
    	return $rep;
   }

   function selectListeMatiere($id_groupe_mat){ 
	   $cond= ($id_groupe_mat==-1)? ' IS NULL ' : ' = '.$id_groupe_mat;
     $rep= requette("SELECT * FROM `lab_matiere` WHERE `idGroupeMatiere` ".$cond." ;");
    	return $rep-> fetchAll();

  }
  
  function ajouterArrivageMatiere($donnee){
	   $rep= requette("INSERT INTO `lab_arrivage` (`id_arrivage`, `id_matiere`, `quantite`, `numLot`, `dateArrivage`, `dateFabrication`, `datePeremption`) VALUES (null, '".valid($donnee['groupeMatiere'])."', '".valid($donnee['quantite'])."', '".valid($donnee['lot'])."', '".valid($donnee['dateArrivage'])."', '".valid($donnee['dateFabrication'])."', '".valid($donnee['datePeremption'])."');");
		
		return true;
  }

  function deleteArrivageMatiere($id_arrivage){
    	$rep= requette("DELETE FROM `lab_arrivage` WHERE `lab_arrivage`.`id_arrivage` = ".$id_arrivage."");
    	return true;

  }
    
  function updateArrivageMatiere($id_arrivage,$donnee){
    	 $rep= requette("UPDATE `lab_arrivage` SET `id_matiere` = '".valid($donnee['groupeMatiere'])."', `quantite` = '".valid($donnee['quantite'])."', `numLot` = '".valid($donnee['numLot'])."', `dateArrivage` = '".valid($donnee['dateArrivage'])."', `dateFabrication` = '".valid($donnee['dateFabrication'])."', `datePeremption` = '".valid($donnee['datePeremption'])."' WHERE `lab_arrivage`.`id_arrivage` = ".$id_arrivage.";");
  }

  function selectArrivage($id_arrivage){
      $rep= requette("SELECT * FROM `lab_arrivage`,`lab_matiere` WHERE `lab_arrivage`.`id_matiere` = `lab_matiere`.`id_matiere` AND `lab_arrivage`.`id_arrivage` = ".$id_arrivage."");
    	return $rep-> fetch();
  }

  function  listeAnalyseMatiereArrivage($id_arrivage){
      $rep= requette("SELECT * FROM `lab_analyse-matiere` WHERE `id_arrivage` = ".$id_arrivage."");
      return $rep;
  }


  function supprAnalyseArrivage($id_arrivage){
      $rep= requette("DELETE FROM `lab_analyse-matiere` WHERE `lab_analyse-matiere`.`id_analyseMat` = ".$id_arrivage."");
      return true;

  } 

  function ajouterAnalyseArrivage($id_arrivage,$donnee){
        $rep= requette("INSERT INTO `lab_analyse-matiere` (`id_analyseMat`, `id_arrivage`, `datePrelevement`, `dateFin`, `etatAnalyse`, `conclusionAnalyse`) VALUES (NULL, '".valid($id_arrivage)."', '".valid($donnee['datePrelevement'])."', NULL, 'En attente', NULL);");
        
        $rep= requette("SELECT `id_analyseMat` FROM `lab_analyse-matiere` WHERE `id_arrivage`=".valid($id_arrivage)." AND `datePrelevement`='".valid($donnee['datePrelevement'])."' AND `etatAnalyse`='En attente' ORDER BY `id_analyseMat` DESC LIMIT 1 ");

        return ($res=$rep->fetch())? $res['id_analyseMat'] : false;
  }

  function selectAnalyse($id_analyseMat){
      $rep= requette("SELECT * FROM `lab_analyse-matiere` WHERE `id_analyseMat` = '".$id_analyseMat."'");
      return $rep-> fetch();
  }

  function AnalyseMatiere($id_analyseMat){
    $rep= requette("SELECT * FROM `lab_analyse-matiere`, `lab_matiere`,`lab_arrivage` WHERE `lab_analyse-matiere`.`id_arrivage` = `lab_arrivage`.`id_arrivage` and `lab_matiere`.`id_matiere` = `lab_arrivage`.`id_matiere` and `id_analyseMat` = '".valid($id_analyseMat)."'");
    
    return $rep->fetch();
  }
  
  function resultatAnalyseMatiere($id_analyseMat){ 
    $rep= requette("SELECT * FROM `lab_parametre analyse`, `lab_parametre-matiere`, `lab_resultat-param` WHERE `id_analyseMat`='".valid($id_analyseMat)."' and `lab_resultat-param`.`id_paramMat` = `lab_parametre-matiere`.`id_paramMat` and `lab_parametre-matiere`.`id_paramAnal` = `lab_parametre analyse`.`id_paramAnal`");

    return $rep;
  }

  function selectgroupesParents($id){
            $rep= requette("SELECT * FROM `lab_groupe_matiere` where `id_groupe_mat` = '".valid($id)."' ORDER BY `id_groupe_mat`");
              return $rep->fetch();
  }

  function selectgroupesParentGroupeMatiere($id_groupe_mat){
            $rep= requette("SELECT * FROM `lab_groupe_matiere` where `id_groupe_mat` = '".valid($id_groupe_mat)."'");
            //  var_dump("SELECT * FROM `lab_groupe_matiere` where `id_groupe_mat` = '".valid($id)."'");die;
              return $rep->fetch();
  }

  
/******************* consigne auto ************/
  function saveConsigne($objet,$corp){
    $tempEnvoi= date('Y-m-d H:i:s');
    $rep= requette("INSERT INTO `message` (`id_message`, `id_sender`, `objetMsg`, `jointMsg`, `corpMsg`, `id_reponseMsg`, `tempEnvoiMsg`) VALUES (NULL, '-1', '".valid($objet)."', NULL, '".valid($corp)."', NULL, '".valid($tempEnvoi)."') ;");

    $rep= requette("SELECT `id_message` FROM `message` WHERE `id_sender`=-1 AND `objetMsg`='".valid($objet)."' AND `tempEnvoiMsg`='".valid($tempEnvoi)."' LIMIT 1;");
    return $rep->fetch()['id_message'];
  }

  function recupListeUserLab($id_user){
    $cond= " `type`='laboratoire' ";//$cond= " `type`='emballage' OR `type`='admin' ";
    $rep= requette("SELECT `id_user` FROM `user` WHERE (".$cond.") AND id_user <> ".$id_user." ;");

    return $rep;
  }

  function envoiConsigne($id_consigne,$id_recept){
    $rep= requette("INSERT INTO `reception message` (`id_message`, `id_recepteur`, `etatMsg`, `etatConsigne`) VALUES ('".valid($id_consigne)."', '".valid($id_recept)."', 'nonLu', 'terminer') ;");

    return true;
  } 
 


/********************************/
	function valid($chaine){
		$char= array("'", "\"", "`");
		$remp= array("\'", "\\\"", "\`");
		return htmlspecialchars(str_replace($char, $remp, $chaine));
	}