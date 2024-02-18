<?php
require('model/bdConnect.php');




 function ajouterMatiere($nomMatiere,$fournisseurMatiere,$descriptioncMatiere,$idGroupeMatiere){
    $rep =requette("INSERT INTO `lab_matiere` (`id_matiere`, `nomMatiere`, `fournisseurMatiere`, `cahierCharge`, `ficheTechnique`, `bulletinVierge`, `descriptioncMatiere`, `idGroupeMatiere`) VALUES (NULL, '".valid($nomMatiere)."', '".valid($fournisseurMatiere)."', '', '', '', '".valid($descriptioncMatiere)."', ".valid($idGroupeMatiere).")");

    $rep =requette("SELECT `id_matiere` FROM `lab_matiere` WHERE `nomMatiere`='".valid($nomMatiere)."' AND `fournisseurMatiere`='".valid($fournisseurMatiere)."' ORDER BY `id_matiere` DESC LIMIT 1;");
    
    return $rep->fetch()['id_matiere'];
 }
 
  function ajouterLienMatiere($id_matiere,$cahierCharge,$ficheTechnique,$bulletinVierge){
    if($cahierCharge) $cahierCharge= ",`cahierCharge` = '".valid($cahierCharge)."'";
        else $cahierCharge= "";
    if($ficheTechnique) $ficheTechnique= ",`ficheTechnique` = '".valid($ficheTechnique)."'";
        else $ficheTechnique= "";
    if($bulletinVierge) $bulletinVierge= ",`bulletinVierge` = '".valid($bulletinVierge)."'";
        else $bulletinVierge= "";

    $rep= requette("UPDATE `lab_matiere` SET `id_matiere`=`id_matiere` ".$cahierCharge." ".$ficheTechnique." ".$bulletinVierge." WHERE `id_matiere` = '".valid($id_matiere)."' ;");
}


function ajouterGroupeMatiere($donnee){
    $rep =requette("INSERT INTO `lab_groupe_matiere`(`id_groupe_mat`, `nomGroupeMat`, `descriptionGroupe`, `id_groupeParent`) VALUES (NULL,'".valid($donnee['nomGroupe'])."','".valid($donnee['DescGroupe'])."',".valid($donnee['idGroupeParent']).")");

    return true;
 }

  function modifierGroupeMatiere($id_groupe,$donnee){
    $rep =requette("UPDATE `lab_groupe_matiere` SET `nomGroupeMat`='".valid($donnee['nomGroupe'])."',`descriptionGroupe`='".valid($donnee['DescGroupe'])."',`id_groupeParent`=".valid($donnee['idGroupeParent'])." WHERE `id_groupe_mat`=".valid($id_groupe).";");

    return true;
 }

  function listeGroupeMatiere($id_groupeParent=''){
    $id_groupeParent= ($id_groupeParent=='')? 'IS NULL' : ' = '.$id_groupeParent;
    $rep= requette("SELECT * FROM `lab_groupe_matiere` WHERE `id_groupeParent` ".$id_groupeParent);
    
    return $rep;
 }  
  function listeToutGroupeMatiere(){
    $rep= requette("SELECT * FROM `lab_groupe_matiere`");
    
    return $rep->fetchAll(PDO::FETCH_CLASS);
 }

 function recupReactifParametre(){
    $rep= requette("SELECT * FROM `lab_reactif`");
    return $rep;
}
  
   function listeMatiereGroupe($id_groupe=''){
    $id_groupe= ($id_groupe=='')? 'IS NULL' : ' = '.$id_groupe;
    $rep= requette("SELECT * FROM `lab_matiere` WHERE `idGroupeMatiere` ".$id_groupe);
    
    return $rep;
 }  function parametreMatiere($id_matiere){
    $rep = requette("SELECT * FROM `lab_parametre-matiere`,`lab_parametre analyse` WHERE `id_matiere` =".valid($id_matiere)." and `lab_parametre analyse`.`id_paramAnal` =`lab_parametre-matiere`.`id_paramAnal` group by `lab_parametre analyse`.`id_paramAnal`");
    return $rep;
}


function parametreAnalyse(){
    $rep= requette("SELECT * FROM `lab_parametre analyse`");
    return $rep;
}

function supprimerMatiere($id_matiere){
    $rep= requette("DELETE FROM `lab_matiere` WHERE `id_matiere` = ".valid($id_matiere)."");
        
}

function supprimerGroupeMatiere($id_groupeMat){
    $rep= requette("DELETE FROM `lab_groupe_matiere` WHERE `id_groupe_mat`=".valid($id_groupeMat)."; ");
}

function selectDetailMatiere($id_matiere){
     $rep= requette("SELECT * FROM `lab_matiere` WHERE `id_matiere` =".valid($id_matiere)."; ");
        return $rep->fetch();
}

function recupNomFileMatiere($type,$id_matiere){
    if($type=='Bulletin')$type='BulletinVierge';
    $rep= requette("SELECT `".$type."` FROM `lab_matiere` WHERE `id_matiere`= '".valid($id_matiere)."' ");

    if($result=$rep->fetch()) return $result[$type];
    else return '!:!';
}

function modifierMatiere($id_matiere,$nomMatiere,$fournisseurMatiere,$cahierCharge,$ficheTechnique,$bulletinVierge,$descriptioncMatiere,$idGroupeMatiere){
    
    if($cahierCharge) $cahierCharge= ",`cahierCharge` = '".valid($cahierCharge)."'";
        else $cahierCharge= "";
    if($ficheTechnique) $ficheTechnique= ",`ficheTechnique` = '".valid($ficheTechnique)."'";
        else $ficheTechnique= "";
    if($bulletinVierge) $bulletinVierge= ",`bulletinVierge` = '".valid($bulletinVierge)."'";
        else $bulletinVierge= "";

    $rep= requette("UPDATE `lab_matiere` SET `nomMatiere` = '".valid($nomMatiere)."', `fournisseurMatiere` = '".valid($fournisseurMatiere)."' ".$cahierCharge." ".$ficheTechnique." ".$bulletinVierge.", `descriptioncMatiere` = '".valid($descriptioncMatiere)."', `idGroupeMatiere` = ".valid($idGroupeMatiere)." WHERE `lab_matiere`.`id_matiere` = ".valid($id_matiere)."");
}

function ajouterAnalyseMatiere($id_matiere,$donnee){
    $rep= requette("INSERT INTO `lab_analyse-matiere` (`id_analyseMat`, `id_matiere`, `numLot`, `dateFabrication`, `datePeremption`, `datePrelevement`, `dateFin`, `conclusionAnalyse`) VALUES (NULL, '".valid($id_matiere)."', '".valid($donnee['numLot'])."', '".valid($donnee['dateFabrication'])."', '".valid($donnee['datePeremption'])."', '".valid($donnee['datePrelevement'])."', NULL, NULL);");

    $rep= requette("SELECT `id_analyseMat` FROM `lab_analyse-matiere` WHERE `id_matiere`='".valid($id_matiere)."' AND `numLot`='".valid($donnee['numLot'])."' AND `datePrelevement`='".valid($donnee['datePrelevement'])."' ORDER BY `id_analyseMat` DESC");

    return $rep->fetch()['id_analyseMat'];
}
 

 function recupAnalyseMatiere($id_matiere){
    $rep= requette(" SELECT * FROM `lab_analyse-matiere`,`lab_arrivage` WHERE `lab_analyse-matiere`.`id_arrivage` =`lab_arrivage`.`id_arrivage` and `id_matiere` ='".valid($id_matiere)."' ORDER BY `id_analyseMat` DESC ;");
             
    return $rep;   
}
 function supprimerAnalyseMatiere($id_analyseMat){
    $rep= requette("DELETE FROM `lab_analyse-matiere` WHERE `lab_analyse-matiere`.`id_analyseMat` = '".valid($id_analyseMat)."'");
}

function ajouterParametreMatiere($id_matiere,$id_paramAnal,$nomVersion,$dateVersion,$normeParam,$formuleParam,$uniteParam,$descriptionParamMat){

    $rep = requette("INSERT INTO `lab_parametre-matiere` (`id_paramMat`, `id_paramAnal`, `id_matiere`, `nomVersion`, `dateVersion`, `normeParam`, `formuleParam`, `uniteParam`, `descriptionParamMat`) VALUES (NULL, '".valid($id_paramAnal)."', '".valid($id_matiere)."', '".valid($nomVersion)."', '".valid($dateVersion)."', '".valid($normeParam)."', '".valid($formuleParam)."', '".valid($uniteParam)."', '".valid($descriptionParamMat)."');");
} 

function updateParametreMat($id_paramMat,$nomVersion,$dateVersion,$normeParam,$formule,$uniteParam,$descriptionParamMat){
    $rep = requette("UPDATE `lab_parametre-matiere` SET `nomVersion` = '".valid($nomVersion)."', `dateVersion` = '".valid($dateVersion)."', `normeParam` = '".valid($normeParam)."', `formuleParam`= '".$formule."', `uniteParam` = '".valid($uniteParam)."', `descriptionParamMat` = '".valid($descriptionParamMat)."' WHERE `lab_parametre-matiere`.`id_paramMat` = ".valid($id_paramMat).";");
}

function selectParamMat($id_paramMat){
    $rep= requette("SELECT * FROM `lab_parametre-matiere`, `lab_parametre analyse` WHERE `id_paramMat` =".valid($id_paramMat)." and `lab_parametre analyse`.`id_paramAnal` =`lab_parametre-matiere`.`id_paramAnal`");
    return $rep->fetch();
}

function listeVersionParametre($id_matiere,$id_paramAnal){
    $rep= requette("SELECT `lab_parametre-matiere`.`id_paramMat`, `lab_parametre-matiere`.`nomVersion` FROM `lab_parametre-matiere`,`lab_parametre analyse` WHERE `id_matiere` =".valid($id_matiere)." and `lab_parametre analyse`.`id_paramAnal` =`lab_parametre-matiere`.`id_paramAnal` and `lab_parametre-matiere`.`id_paramAnal` =".valid($id_paramAnal)."");
    
    return $rep->fetchAll(PDO::FETCH_CLASS);
}

function supprParametreMatiere($id_paramMat){
    $rep= requette("DELETE FROM `lab_parametre-matiere` WHERE `id_paramMat` = ".valid($id_paramMat)."");
}

    function modifierGroupeEquipement($idGroupeEquipement,$nomGroupeEquip,$descriptionGroupe,$id_groupe="null"){
       $rep= requette("  UPDATE `lab_groupe_matiere` SET `nomGroupeMat`= '".valid($nomGroupeEquip)."',`descriptionGroupe`= '".valid($descriptionGroupe)."',`id_groupeParent`= ".valid($id_groupe)." WHERE `lab_groupe_matiere`.`id_groupe_mat` = ".valid($idGroupeEquipement)."");


    }

    function selectDetailGroupeEquipe($idGroupeEquipement){
        $rep= requette("SELECT * FROM `lab_groupe equip` WHERE `idGroupeEquipement` ='".valid($idGroupeEquipement)."'");
        return $rep->fetch();
    }




    function recupNomFileDocument($id_document,$fileDocument){
    $rep= requette("SELECT `".valid($fileDocument)."` AS fileDocument FROM `document_prod` WHERE `id_docProd`= '".valid($id_document)."' ");
    $result=$rep->fetch();
    if($result && !empty($result["fileDocument"])) return $result["fileDocument"];
    else return '!:!';
 }

  function valid($chaine){
        $char= array("'", "\"", "`");
        $remp= array("\'", "\\\"", "\`");
        return htmlspecialchars(str_replace($char, $remp, $chaine));
    }