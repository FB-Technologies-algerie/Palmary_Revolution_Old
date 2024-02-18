<?php
require('model/bdConnect.php');
 
//****** Equipement ******/

    function listeGroupeEq(){
        $rep= requette("SELECT * FROM `lab_groupe equip` WHERE `id_groupe` is null");
        return $rep;
    }
    
    function listeGroup(){
        $rep= requette("SELECT * FROM `lab_groupe equip`");
        return $rep;
    }

    function SousGroupeEq($idGroupeEquipement){
        $rep= requette("SELECT * FROM `lab_groupe equip` WHERE `id_groupe` ='".valid($idGroupeEquipement)."'");
        return $rep;
    }

    function listeEquipement($idGroupeEquipement){
        $rep= requette("SELECT * FROM `lab_equipement` WHERE `idGroupeEquipement`='".valid($idGroupeEquipement)."'");
        return $rep;
    }

    function listeEquipementLibre(){
        $rep= requette("SELECT * FROM `lab_equipement` WHERE  `idGroupeEquipement` is null ORDER BY `id_equipement`");
        return $rep;
    }

    function selectDetailEquipe($id_equipement){
        $rep= requette("SELECT `nomEquipement`,`descriptionEquipement`,`idGroupeEquipement` FROM `lab_equipement` WHERE `id_equipement` = '".valid($id_equipement)."'");
        return $rep->fetch();
    }

     function recupFicheDeVieEquipement($id_equipement){
        $rep= requette("SELECT * FROM `lab_equipement` WHERE `id_equipement` = '".valid($id_equipement)."'");
        return $rep->fetch();
    }


    function selectDetailGroupeEquipe($idGroupeEquipement){
        $rep= requette("SELECT * FROM `lab_groupe equip` WHERE `idGroupeEquipement` ='".valid($idGroupeEquipement)."'");
        return $rep->fetch();
    }

    function ajouterEquipement($nomEquipement,$descriptionEquipement,$idGroupeEquipement){
       $rep= requette("INSERT INTO `lab_equipement` (`id_equipement`, `nomEquipement`, `descriptionEquipement`, `idGroupeEquipement`, `marque`, `modele`, `nSerie`, `reference`, `dateReception`, `dateMisService`, `constructeur`, `lienConstructeur`, `fournisseur`, `lienFournisseur`, `affectation`, `nIdentification`) VALUES (NULL, '".valid($nomEquipement)."', '".valid($descriptionEquipement)."', ".valid($idGroupeEquipement).", '','','','',NULL,NULL,'','','','','',NULL)");
       
    }

    function modifierEquipement($id_equipement,$nomEquipement,$descriptionEquipement,$idGroupeEquipement="null"){
       $rep= requette("UPDATE `lab_equipement` SET `nomEquipement` = '".valid($nomEquipement)."', `descriptionEquipement` = '".valid($descriptionEquipement)."', `idGroupeEquipement` = '".valid($idGroupeEquipement)."' WHERE `lab_equipement`.`id_equipement` = '".valid($id_equipement)."'");
    }

    function supprimerEquipement($id_equipement){
        $rep= requette("DELETE FROM `lab_equipement` WHERE `lab_equipement`.`id_equipement` ='".valid($id_equipement)."'");
    }

    function ajouterGroupeEquipement($nomGroupeEquip,$descriptionGroupe,$id_groupe){
       $rep= requette("INSERT INTO `lab_groupe equip` (`idGroupeEquipement`, `nomGroupeEquip`, `descriptionGroupe`, `id_groupe`) VALUES (NULL, '".valid($nomGroupeEquip)."','".valid($descriptionGroupe)."', ".valid($id_groupe).")");
    }

    function supprimerGroupeEquipement($id_groupe){
        $rep= requette("DELETE FROM `lab_groupe equip` WHERE `lab_groupe equip`.`idGroupeEquipement` = '".valid($id_groupe)."'");

    }

    function modifierGroupeEquipement($idGroupeEquipement,$nomGroupeEquip,$descriptionGroupe,$id_groupe="null"){
       $rep= requette("UPDATE `lab_groupe equip` SET `nomGroupeEquip` = '".valid($nomGroupeEquip)."', `descriptionGroupe` = '".valid($descriptionGroupe)."', `id_groupe` = '".valid($id_groupe)."' WHERE `lab_groupe equip`.`idGroupeEquipement` = ".valid($idGroupeEquipement)."");
    }

 function listeAction($id_equipement){
        $rep= requette("SELECT * FROM `lab_action-equipement` WHERE `id_equipement`=".valid($id_equipement)."");
        return $rep;
 }


function ajouterAction($id_equipement,$nomAction,$dateAction,$responsable,$decision,$numDocument,$commentAvis,$freqAction="null"){  /*nabil modifier */
    $rep =requette(" INSERT INTO `lab_action-equipement` (`id_action`, `nomAction`, `lienAction`, `dateAction`, `responsable`, `decision`, `lienDecision`, `id_equipement`,`freqAction`,`numDocument`,`commentAvis`) VALUES (NULL, '".valid($nomAction)."', '', '".valid($dateAction)."', '".valid($responsable)."', '".valid($decision)."', '','".valid($id_equipement)."','".valid($freqAction)."','".valid($numDocument)."','".valid($commentAvis)."')");
  /*nabil modifier */

    $rep= requette("SELECT `id_action` FROM `lab_action-equipement` WHERE `id_equipement`=".valid($id_equipement)." AND `nomAction`='".valid($nomAction)."' AND `dateAction`='".valid($dateAction)."' ORDER BY `id_action` DESC LIMIT 1");
    return $rep->fetch()['id_action'];
}

function ajouterLienActionDecision($id_action,$lienAction,$lienDecision){
    if($lienAction) $lienAction= ",`lienAction` = '".valid($lienAction)."'";
        else $lienAction= "";
    if($lienDecision) $lienDecision= ",`lienDecision` = '".valid($lienDecision)."'";
        else $lienDecision= "";

    $rep= requette("UPDATE `lab_action-equipement` SET `id_action`=`id_action` ".$lienAction." ".$lienDecision." WHERE `id_action` = '".valid($id_action)."'");
}

function modifierAction($id_action,$nomAction,$lienAction,$dateAction,$responsable,$decision,$lienDecision,$freqAction="null",$numDocument,$commentAvis){
    if($lienAction) $lienAction= "`lienAction` = '".valid($lienAction)."',";
        else $lienAction= "";
    if($lienDecision) $lienDecision= ",`lienDecision` = '".valid($lienDecision)."'";
        else $lienDecision= "";
/*nabil modifier */
    $rep= requette("UPDATE `lab_action-equipement` SET `nomAction` = '".valid($nomAction)."', ".$lienAction." `dateAction` = '".valid($dateAction)."' , `responsable` = '".valid($responsable)."', `decision` = '".valid($decision)."' ".$lienDecision.",`freqAction` = ".valid($freqAction).",`numDocument` = '".valid($numDocument)."', `commentAvis` = '".valid($commentAvis)."' WHERE `lab_action-equipement`.`id_action` = '".valid($id_action)."'");
/*nabil modifier */
}

function supprimerAction($id_action){ 
    $rep= requette("DELETE FROM `lab_action-equipement` WHERE `id_action`='".valid($id_action)."'");

}
 function idEquipementAction($id_action){ 
    $rep= requette("SELECT `id_equipement` FROM `lab_action-equipement` WHERE `id_action` ='".valid($id_action)."'");
    return $rep->fetch();
} 
 function listeActiveAction($id_equipement){
        $rep= requette("SELECT * FROM `lab_action-equipement` WHERE ADDDATE(`dateAction`, INTERVAL `freqAction` month)<= CURDATE() and `id_equipement` = '".valid($id_equipement)."'");
        return $rep;
 }

function modifierFicheDeVieEquipement($id_equipement,$marque,$modele,$nSerie,$reference,$dateReception,$dateMisService,$constructeur,$lienConstructeur,$fournisseur,$lienFournisseur,$affectation,$nIdentification){
    
    if($lienConstructeur) $lienConstructeur= "`lienConstructeur` = '".valid($lienConstructeur)."',";
        else $lienConstructeur= "";
    if($lienFournisseur) $lienFournisseur= "`lienFournisseur` = '".valid($lienFournisseur)."',";
        else $lienFournisseur= "";

    $dateReception= ($dateReception=='')? "NULL" : "'".valid($dateReception)."'";
    $dateMisService= ($dateMisService=='')? "NULL" : "'".valid($dateMisService)."'";

    $rep= requette("UPDATE `lab_equipement` SET   `marque` = '".valid($marque)."', `modele` = '".valid($modele)."', `nSerie` = '".valid($nSerie)."', `reference` = '".valid($reference)."', `dateReception` = ".$dateReception.", `dateMisService` = ".$dateMisService.", `constructeur` = '".valid($constructeur)."', ".$lienConstructeur." `fournisseur` = '".valid($fournisseur)."', ".$lienFournisseur." `affectation` = '".valid($affectation)."', `nIdentification` = '".valid($nIdentification)."' WHERE `lab_equipement`.`id_equipement` = '".valid($id_equipement)."'");
}

function recupNomFileEquipement($type,$id_equipement){
    $rep= requette("SELECT `lien".valid($type)."` FROM `lab_equipement` WHERE `id_equipement`= '".valid($id_equipement)."' ");
    $result=$rep->fetch();
    if($result && !empty( $result["lien".valid($type)])) return $result["lien".valid($type)];
    else return '!:!';
}

function recupNomFileAction($type,$id_action){
    $rep= requette("SELECT `lien".valid($type)."` FROM `lab_action-equipement` WHERE `id_action`= '".valid($id_action)."' ");
     $result=$rep->fetch();
    if($result && !empty( $result["lien".valid($type)])) return $result["lien".valid($type)];
    else return '!:!';
}




//***************Consommable****************//

    function SousGroupeConsommable($idGroupeConsommable){
        $rep= requette("SELECT * FROM `lab_groupe conso` WHERE `id_groupe` ='".valid($idGroupeConsommable)."'");
        return $rep;
    }

    function listeGroupeConsommable(){
        $rep= requette("SELECT * FROM `lab_groupe conso` WHERE `id_groupe` is null");
        return $rep;
    }

    function listeGroupeEqConso(){
        $rep= requette("SELECT * FROM `lab_groupe conso`");
        return $rep;
    }

    function listeConsommable($idGroupeConsommable){
        $rep= requette("SELECT * FROM `lab_consommable` WHERE `idGroupeConsommable`='".valid($idGroupeConsommable)."'");
        return $rep;
    }

    function listeConsommableLibre(){
        $rep= requette("SELECT * FROM `lab_consommable` WHERE  `idGroupeConsommable` is null ORDER BY `idGroupeConsommable`");
        return $rep;
    }

    function selectDetailConsom($id_consommable){
        $rep= requette("SELECT * FROM `lab_consommable` WHERE `id_consommable` = '".valid($id_consommable)."'");
        
        return $rep->fetch();
    }

    function ajouterEquipeConsommable($nomConsommable,$fournisseur,$quantiteConsommable,$descriptioncConsommable,$idGroupeConsommable){
        $rep= requette("INSERT INTO `lab_consommable` (`id_consommable`, `nomConsommable`, `fournisseur`, `quantiteConsommable`, `descriptioncConsommable`, `idGroupeConsommable`) VALUES (NULL, '".valid($nomConsommable)."', '".valid($fournisseur)."', '".valid($quantiteConsommable)."', '".valid($descriptioncConsommable)."', ".valid($idGroupeConsommable).")");
    }

    function ajouterGroupeEquipeConso($nomGroupeConso,$descriptionGroupe,$id_groupe){
       $rep= requette("INSERT INTO `lab_groupe conso` (`idGroupeConsommable`, `nomGroupeConso`, `descriptionGroupe`, `id_groupe`) VALUES (NULL, '".valid($nomGroupeConso)."','".valid($descriptionGroupe)."', ".valid($id_groupe).")");
    }

    function supprimerEquipeConsommable($id_consommable){
        $rep= requette("DELETE FROM `lab_consommable` WHERE `lab_consommable`.`id_consommable` = '".valid($id_consommable)."'");
    }
    
    function supprimerGroupeEquipeConso($id_groupe){
        $rep= requette("DELETE FROM `lab_groupe conso` WHERE `lab_groupe conso`.`idGroupeConsommable` ='".valid($id_groupe)."'");
    }



    function modifierGroupeConsomable($idGroupeConsommable,$nomGroupeConso,$descriptionGroupe,$id_groupe="null"){
       $rep= requette("UPDATE `lab_groupe conso` SET `nomGroupeConso` = '".valid($nomGroupeConso)."', `descriptionGroupe` = '".valid($descriptionGroupe)."', `id_groupe` = ".valid($id_groupe)." WHERE `lab_groupe conso`.`idGroupeConsommable` = '".valid($idGroupeConsommable)."'");


}

    function selectDetailGroupeConso($idGroupeConsommable){
            $rep= requette("SELECT * FROM `lab_groupe conso` WHERE `idGroupeConsommable` ='".valid($idGroupeConsommable)."'");
            return $rep->fetch();
}
function modifierConsommable($id_consommable,$nomConsommable,$fournisseur,$quantiteConsommable,$descriptioncConsommable,$idGroupeConsommable="null"){
       $rep= requette("UPDATE `lab_consommable` SET `nomConsommable` = '".valid($nomConsommable)."', `fournisseur` = '".valid($fournisseur)."', `quantiteConsommable` = '".valid($quantiteConsommable)."', `descriptioncConsommable` = '".valid($descriptioncConsommable)."', `idGroupeConsommable` = ".valid($idGroupeConsommable)." WHERE `lab_consommable`.`id_consommable` = ".valid($id_consommable)."");


}
/******************* Reactif *****************/

    function listeGroupeReactif(){
        $rep= requette("SELECT * FROM `lab_groupe reactif` WHERE `id_Groupe` is null ORDER BY `NomGroupe` ASC");
        return $rep;
    }

    function SousGroupeReactif($idGroupeReactif){ 
       $rep= requette("SELECT * FROM `lab_groupe reactif` WHERE `id_Groupe` ='".valid($idGroupeReactif)."'  ORDER BY `NomGroupe` ASC");
        return $rep;
    }

    function liste_Reactifs($idGroupeReactif){
        $rep= requette("SELECT * FROM `lab_reactif` WHERE `idGroupeReactif` ='".valid($idGroupeReactif)."' ORDER BY `nomReactif` ASC");
        return $rep;
    }


    function listeReactifLibre(){
        $rep= requette("SELECT * FROM `lab_reactif` WHERE `idGroupeReactif` is null ORDER BY  `fournisseur` ASC");
        return $rep;
    }


     function ajouterEquipeReactif($nomReactif,$fournisseur,$descriptionReactif,$quantiteReactif,$uniteReactif,$idGroupeReactif,$mailFournisseur,$numLot,$dateOuverture){
        $dateOuverture= ($dateOuverture)? "'".valid($dateOuverture)."'" : "NULL";

        $rep= requette("INSERT INTO `lab_reactif` (`id_reactif`, `nomReactif`, `fournisseur`, `descriptionReactif`, `quantiteReactif`,`uniteReactif`, `idGroupeReactif`,`mailFournisseur`, `fds`, `dlc`, `numLot`, `dateOuverture`) VALUES (NULL, '".valid($nomReactif)."', '".valid($fournisseur)."', '".valid($descriptionReactif)."', '".valid($quantiteReactif)."','".valid($uniteReactif)."', ".valid($idGroupeReactif)." ,'".valid($mailFournisseur)."', '', '', '".valid($numLot)."', ".$dateOuverture.")");
             
        $rep2= requette("SELECT `id_reactif` FROM `lab_reactif` WHERE `nomReactif`='".valid($nomReactif)."' AND `numLot`='".valid($numLot)."' ORDER BY `id_reactif` DESC LIMIT 1;");
        return $rep2->fetch()['id_reactif'];
    }

    function ajouterLienFdsDlc($id_reactif,$lienFds,$lienDlc){
       $lienFds= ($lienFds)? "`fds`='".valid($lienFds)."'," : "";
       $lienDlc= ($lienDlc)? "`dlc`='".valid($lienDlc)."'," : "";
       $rep= requette("UPDATE `lab_reactif` SET ".$lienFds." ".$lienDlc." `id_reactif`=`id_reactif` WHERE `id_reactif`=".$id_reactif." ;");
    }

function ajouterGroupeEquipeReactif($NomGroupe,$DescriptionGroupe,$id_groupe){
       $rep= requette("INSERT INTO `lab_groupe reactif` (`idGroupeReactif`, `NomGroupe`, `DescriptionGroupe`, `id_Groupe`) VALUES (NULL, '".valid($NomGroupe)."', '".valid($DescriptionGroupe)."', ".valid($id_groupe).")");
    }



function supprimerEquipeReactif($id_reactif){
        $rep= requette("DELETE FROM `lab_reactif` WHERE `lab_reactif`.`id_reactif` = '".valid($id_reactif)."'");
    }
    
    function supprimerGroupeEquipeReactif($idGroupeReactif){
        $rep= requette("DELETE FROM `lab_groupe reactif` WHERE `lab_groupe reactif`.`idGroupeReactif` = '".valid($idGroupeReactif)."'");
    }
 function selectDetailReactif($id_reactif){
        $rep= requette("SELECT * FROM `lab_reactif` WHERE `id_reactif` = '".valid($id_reactif)."'");
        
        return $rep->fetch();
    }

    function modifierReactif($id_reactif,$nomReactif,$fournisseur,$descriptionReactif,$quantiteReactif,$uniteReactif,$mailFournisseur,$lienFds,$lienDlc,$numLot,$dateOuverture,$idGroupeReactif="null"){
       $lienFds= ($lienFds)? "`fds`='".valid($lienFds)."'," : "";
       $lienDlc= ($lienDlc)? "`dlc`='".valid($lienDlc)."'," : "";
       $dateOuverture= ($dateOuverture)? "`dateOuverture`='".valid($dateOuverture)."'," : "";

       $rep= requette("UPDATE `lab_reactif` SET `nomReactif` = '".valid($nomReactif)."', `fournisseur` = '".valid($fournisseur)."', `descriptionReactif` = '".valid($descriptionReactif)."', `quantiteReactif` = '".valid($quantiteReactif)."',`uniteReactif` = '".valid($uniteReactif)."', `idGroupeReactif` = ".valid($idGroupeReactif).",`mailFournisseur` = '".valid($mailFournisseur)."', ".$lienFds." ".$lienDlc." ".$dateOuverture." `numLot` = '".valid($numLot)."' WHERE `lab_reactif`.`id_reactif` = '".valid($id_reactif)."'");
       
    }


    function selectDetailGroupeReactif($idGroupeReactif){
            $rep= requette("SELECT * FROM `lab_groupe reactif` WHERE `idGroupeReactif` ='".valid($idGroupeReactif)."'");
            return $rep->fetch();
}

function modifierGroupeReactif($idGroupeReactif,$NomGroupe,$DescriptionGroupe,$id_Groupe="null"){
       $rep= requette("UPDATE `lab_groupe reactif` SET `NomGroupe` = '".valid($NomGroupe)."', `DescriptionGroupe` = '".valid($DescriptionGroupe)."', `id_Groupe` = ".valid($id_Groupe)." WHERE `lab_groupe reactif`.`idGroupeReactif` = ".valid($idGroupeReactif)."");
}

function recupNomFileReactif($type,$id_reactif){ 
    $rep= requette("SELECT `".$type."` FROM `lab_reactif` WHERE `id_reactif`= '".valid($id_reactif)."' ");

      $result=$rep->fetch();
    if($result && !empty($result[$type])) return $result[$type];
    else return '!:!';
   
}

/***************** gestion de Veille *********************/
function listeRetarderVeille(){
        $rep= requette("SELECT * FROM `lab_veille` WHERE ADDDATE(`dateVisite`, INTERVAL `periode` DAY)<= CURDATE()");
        return $rep;
 }

 function listeAttanteVeille(){
        $rep= requette("SELECT * FROM `lab_veille` WHERE ADDDATE(`dateVisite`, INTERVAL `periode` DAY)> CURDATE()");
        return $rep;
 }


 function ajouterVeille($nomVeille,$lienVeille,$descriptionVeille,$dateVisite,$periode){
    $rep= requette("INSERT INTO `lab_veille` (`id_veille`, `nomVeille`, `lienVeille`, `descriptionVeille`, `dateVisite`, `periode`) VALUES (NULL, '".valid($nomVeille)."', '".valid($lienVeille)."', '".valid($descriptionVeille)."', '".valid($dateVisite)."', '".valid($periode)."')");
        
 }
 function modifierVeille($id_veille,$nomVeille,$lienVeille,$descriptionVeille,$dateVisite,$periode){ 
    $rep= requette("UPDATE `lab_veille` SET `nomVeille` = '".valid($nomVeille)."', `lienVeille` = '".valid($lienVeille)."', `descriptionVeille` = '".valid($descriptionVeille)."', `dateVisite` = '".valid($dateVisite)."', `periode` = '".valid($periode)."' WHERE `lab_veille`.`id_veille` = ".valid($id_veille)."");
 }
 function supprimerVeille($id_veille){
    $rep= requette("DELETE FROM `lab_veille` WHERE `lab_veille`.`id_veille` = ".valid($id_veille)."");
 }
 function selectDetailVeille($id_veille){
    $rep= requette("SELECT * FROM `lab_veille` WHERE `id_veille`=".valid($id_veille)."");
        return $rep->fetch();
 }

 function supprimerVisite($id_veille){
    $rep= requette("UPDATE `lab_veille` SET `dateVisite`= CURDATE() WHERE `id_veille`=".valid($id_veille)."");
 }


 /************Matieres premieres*****************/
   
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
  
   function listeMatiereGroupe($id_groupe=''){
    $id_groupe= ($id_groupe=='')? 'IS NULL' : ' = '.$id_groupe;
    $rep= requette("SELECT * FROM `lab_matiere` WHERE `idGroupeMatiere` ".$id_groupe);
    
    return $rep;
 } 





function supprimerMatiere($id_matiere){
    $rep= requette("DELETE FROM `lab_matiere` WHERE `lab_matiere`.`id_matiere` = ".valid($id_matiere)."; ");
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
     $result=$rep->fetch();
    if($result  && !empty($result[$type])) return $result[$type];
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


function listeParametre(){
    $rep =requette("SELECT * FROM `lab_parametre analyse`"); 
    return $rep;
}

    

function ajouterParametre($nomParam,$descriptionParam){
    $rep= requette("INSERT INTO `lab_parametre analyse`(`id_paramAnal`, `nomParamAnal`, `descriptionParamAnal`) VALUES (NULL, '".valid($nomParam)."', '".valid($descriptionParam)."');");
}
function supprimerParametre($id_param){ 
     $rep= requette("DELETE FROM `lab_parametre analyse` WHERE `id_paramAnal` = ".valid($id_param)."; ");
}
function detailParametreAnalyse($id_param){
    $rep= requette("SELECT * FROM `lab_parametre analyse` WHERE `id_paramAnal` =".valid($id_param)."");
        return $rep->fetch();
}
function modifierParametre($id_param,$nomParam,$descriptionParam){
    $rep= requette("UPDATE `lab_parametre analyse` SET `nomParamAnal` = '".valid($nomParam)."', `descriptionParamAnal` = '".valid($descriptionParam)."' WHERE `lab_parametre analyse`.`id_paramAnal` = ".valid($id_param)."");
}

function recupListeDoc($id_param){
    $rep= requette("SELECT * FROM `lab_document param` WHERE `id_param`=".valid($id_param)."; ");
    
    return $rep;
}

function recupDetailDocument($id_document){
    $rep= requette("SELECT * FROM `lab_document param` WHERE `id_docParam`=".valid($id_document)." ;");
    
    return $rep->fetch();
}

function ajouterDocument($id_param,$donnee){
    $rep= requette("INSERT INTO `lab_document param`(`id_docParam`, `nomDocument`, `fileDocument`, `typeDocument`, `descriptionDoc`, `id_param`) VALUES (NULL,'".valid($donnee['nomDocument'])."', '','','".valid($donnee['descriptionDoc'])."','".valid($id_param)."') ;");

    $result= requette("SELECT `id_docParam` FROM `lab_document param` WHERE `nomDocument`='".valid($donnee['nomDocument'])."' AND `descriptionDoc`='".valid($donnee['descriptionDoc'])."' AND `id_param`='".valid($id_param)."' ORDER BY `id_docParam` DESC LIMIT 1;");
    
    return $result->fetch()['id_docParam'];
}

function modifierDocument($id_document,$donnee){
    $rep= requette("UPDATE `lab_document param` SET `nomDocument`='".valid($donnee['nomDocument'])."',`descriptionDoc`='".valid($donnee['descriptionDoc'])."' WHERE `id_docParam`='".valid($id_document)."' ;");
    
    return true;
}

function deleteDocument($id_document){
    $rep= requette("DELETE FROM `lab_document param` WHERE `id_docParam`='".valid($id_document)."' ;");
    
    return true;
}

function ajouterLienDocument($id_document,$document,$typeDocument){
    $rep= requette("UPDATE `lab_document param` SET `fileDocument`='".valid($document)."',`typeDocument`='".valid($typeDocument)."' WHERE `id_docParam`='".valid($id_document)."' ;");
    
    return true;
}

function recupNomFileDocument($id_document){
    $rep= requette("SELECT `fileDocument` FROM `lab_document param` WHERE `id_docParam`= '".valid($id_document)."' ");

    $result=$rep->fetch();
    if($result && !empty($result["fileDocument"])) return $result["fileDocument"];
    else return '!:!';
}

function recupAnalyseMatiere($id_matiere){
    $rep= requette("SELECT * FROM `lab_analyse-matiere`,`lab_arrivage` WHERE `lab_analyse-matiere`.`id_arrivage` =`lab_arrivage`.`id_arrivage` and `id_matiere` ='".valid($id_matiere)."' ORDER BY `id_analyseMat` DESC ;");
             
    return $rep;   
}

function supprimerAnalyseMatiere($id_analyseMat){
    $rep= requette("DELETE FROM `lab_analyse-matiere` WHERE `lab_analyse-matiere`.`id_analyseMat` = '".valid($id_analyseMat)."'");
}

function ajouterAnalyseMatiere($id_matiere,$donnee){
    $rep= requette("INSERT INTO `lab_analyse-matiere` (`id_analyseMat`, `id_matiere`, `numLot`, `dateFabrication`, `datePeremption`, `datePrelevement`, `dateFin`, `conclusionAnalyse`) VALUES (NULL, '".valid($id_matiere)."', '".valid($donnee['numLot'])."', '".valid($donnee['dateFabrication'])."', '".valid($donnee['datePeremption'])."', '".valid($donnee['datePrelevement'])."', NULL, NULL);");

    $rep= requette("SELECT `id_analyseMat` FROM `lab_analyse-matiere` WHERE `id_matiere`='".valid($id_matiere)."' AND `numLot`='".valid($donnee['numLot'])."' AND `datePrelevement`='".valid($donnee['datePrelevement'])."' ORDER BY `id_analyseMat` DESC");

    return $rep->fetch()['id_analyseMat'];
}

function recupListeParamMatiere($id_analyseMat){
    $rep= requette("SELECT `lab_parametre-matiere`.`id_paramMat`,`nomParamAnal`,`uniteParam`
                    FROM `lab_parametre analyse`, `lab_parametre-matiere`
                    WHERE `lab_parametre-matiere`.`id_paramAnal`=`lab_parametre analyse`.`id_paramAnal`
                    AND `id_paramMat` IN (
                        SELECT MAX(`id_paramMat`) AS `id_paramMat`
                        FROM `lab_parametre-matiere`
                        WHERE `id_matiere` IN (
                            SELECT `id_matiere`
                            FROM `lab_arrivage`, `lab_analyse-matiere`
                            WHERE `lab_arrivage`.`id_arrivage` =`lab_analyse-matiere`.`id_arrivage`
                            AND `id_analyseMat`='".valid($id_analyseMat)."'
                        )
                        GROUP BY `id_paramAnal`
                    ) 
                    ORDER BY `nomParamAnal`;    
                ");

    return $rep;
}

function AnalyseMatiere($id_analyseMat){
    $rep= requette("SELECT * FROM `lab_analyse-matiere`, `lab_matiere`,`lab_arrivage` WHERE `lab_analyse-matiere`.`id_arrivage` = `lab_arrivage`.`id_arrivage` and `lab_matiere`.`id_matiere` = `lab_arrivage`.`id_matiere` and `id_analyseMat` = '".valid($id_analyseMat)."'");
         
    return $rep->fetch();
}

function resultatAnalyseMatiere($id_analyseMat){ 
    $rep= requette("SELECT * FROM `lab_parametre analyse`, `lab_parametre-matiere`, `lab_resultat-param` WHERE `id_analyseMat`='".valid($id_analyseMat)."' and `lab_resultat-param`.`id_paramMat` = `lab_parametre-matiere`.`id_paramMat` and `lab_parametre-matiere`.`id_paramAnal` = `lab_parametre analyse`.`id_paramAnal`");

    return $rep;
}

function selectdetailAnalyse($id_analyseMat,$id_paramMat){
    $rep= requette("SELECT * FROM `lab_resultat-param` ,`lab_parametre-matiere`,`lab_parametre analyse` WHERE `id_analyseMat` = '".valid($id_analyseMat)."' and `lab_resultat-param`.`id_paramMat` = '".valid($id_paramMat)."' and `lab_resultat-param`.`id_paramMat` = `lab_parametre-matiere`.`id_paramMat` and `lab_parametre-matiere`.`id_paramAnal` = `lab_parametre analyse`.`id_paramAnal`");

      return $rep->fetch();
}

function verifExistParam($id_paramMat,$id_analyseMat){
    $rep= requette("SELECT `id_paramMat` FROM `lab_resultat-param` WHERE `id_analyseMat`='".valid($id_analyseMat)."' AND `id_paramMat`= ".valid($id_paramMat)." ;");

      return $rep->fetch();
}

function ajouterParametreAnalyse($id_paramMat,$id_analyseMat){
    $date=date('Y-m-d');
    $rep= requette("INSERT INTO `lab_resultat-param` (`id_paramMat`, `id_analyseMat`, `resultParam`, `dateAnal`, `descriptionAnal`) VALUES ('".valid($id_paramMat)."', '".valid($id_analyseMat)."', '', '".valid($date)."', '');");
    
    $reps= requette("UPDATE `lab_analyse-matiere` SET `etatAnalyse` = 'En cours' WHERE `id_analyseMat` = '".valid($id_analyseMat)."' ;");

    return true;
}

function recupFromulParam($id_paramMat){
    $rep= requette("SELECT `formuleParam` FROM `lab_parametre-matiere` WHERE `id_paramMat` = '".valid($id_paramMat)."' ;");

    return ($result= $rep->fetch()['formuleParam'])? $result : '!:!';
}

function demenuReactif($id_reactif,$demenuQte){
    $rep= requette("UPDATE `lab_reactif` SET `quantiteReactif` = `quantiteReactif`-".valid($demenuQte)." WHERE `id_reactif` = ".valid($id_reactif)." ;");
}


function modifierResulatatAnalyseDB($id_analyseMat,$id_paramMat,$resultParam,$dateAnal,$descriptionAnal){
     $rep= requette("UPDATE `lab_resultat-param` SET `resultParam` = '".valid($resultParam)."', `dateAnal` = '".valid($dateAnal)."', `descriptionAnal` = '".valid($descriptionAnal)."' WHERE `lab_resultat-param`.`id_paramMat` = ".valid($id_paramMat)." AND `lab_resultat-param`.`id_analyseMat` = ".valid($id_analyseMat).";");
    
    return true;
}

function modifierAnalyseMatiere($id_analyseMat,$datePrelevement){
    $rep= requette("UPDATE `lab_analyse-matiere` SET `datePrelevement` = '".valid($datePrelevement)."' WHERE `lab_analyse-matiere`.`id_analyseMat` = ".valid($id_analyseMat).";");

}

function termineAnalyse($id_analyseMat,$dateFin,$etatAnalyse,$conclusionAnalyse){
    $rep = requette("UPDATE `lab_analyse-matiere` SET `dateFin` = '".valid($dateFin)."', `etatAnalyse` = '".valid($etatAnalyse)."', `conclusionAnalyse` = '".valid($conclusionAnalyse)."' WHERE `lab_analyse-matiere`.`id_analyseMat` = ".valid($id_analyseMat).";");

}

function parametreMatiere($id_matiere){
    $rep = requette("SELECT * FROM `lab_parametre-matiere`,`lab_parametre analyse` WHERE `id_matiere` =".valid($id_matiere)." and `lab_parametre analyse`.`id_paramAnal` =`lab_parametre-matiere`.`id_paramAnal` group by `lab_parametre analyse`.`id_paramAnal`");
    return $rep;
}

function ajouterParametreMatiere($id_matiere,$id_paramAnal,$nomVersion,$dateVersion,$normeParam,$formuleParam,$uniteParam,$descriptionParamMat){

    $rep = requette("INSERT INTO `lab_parametre-matiere` (`id_paramMat`, `id_paramAnal`, `id_matiere`, `nomVersion`, `dateVersion`, `normeParam`, `formuleParam`, `uniteParam`, `descriptionParamMat`) VALUES (NULL, '".valid($id_paramAnal)."', '".valid($id_matiere)."', '".valid($nomVersion)."', '".valid($dateVersion)."', '".valid($normeParam)."', '".valid($formuleParam)."', '".valid($uniteParam)."', '".valid($descriptionParamMat)."');");
}

function parametreAnalyse(){
    $rep= requette("SELECT * FROM `lab_parametre analyse`");
    return $rep;
}

function recupReactifParametre(){
    $rep= requette("SELECT * FROM `lab_reactif`");
    return $rep;
}
    function recupReactif($id_reactif){
    $rep= requette("SELECT nomReactif , uniteReactif FROM `lab_reactif` WHERE `id_reactif` = '".valid($id_reactif)."'");

    return $rep->fetch();
   }
function supprParametreMatiere($id_paramMat){
    $rep= requette("DELETE FROM `lab_parametre-matiere` WHERE `id_paramMat` = ".valid($id_paramMat)."");
}

function listeVersionParametre($id_matiere,$id_paramAnal){
    $rep= requette("SELECT `lab_parametre-matiere`.`id_paramMat`, `lab_parametre-matiere`.`nomVersion` FROM `lab_parametre-matiere`,`lab_parametre analyse` WHERE `id_matiere` =".valid($id_matiere)." and `lab_parametre analyse`.`id_paramAnal` =`lab_parametre-matiere`.`id_paramAnal` and `lab_parametre-matiere`.`id_paramAnal` =".valid($id_paramAnal)."");
    
    return $rep->fetchAll(PDO::FETCH_CLASS);
}

function selectParamMat($id_paramMat){
    $rep= requette("SELECT * FROM `lab_parametre-matiere`, `lab_parametre analyse` WHERE `id_paramMat` =".valid($id_paramMat)." and `lab_parametre analyse`.`id_paramAnal` =`lab_parametre-matiere`.`id_paramAnal`");
    return $rep->fetch();
}

function updateParametreMat($id_paramMat,$nomVersion,$dateVersion,$normeParam,$formule,$uniteParam,$descriptionParamMat){
    $rep = requette("UPDATE `lab_parametre-matiere` SET `nomVersion` = '".valid($nomVersion)."', `dateVersion` = '".valid($dateVersion)."', `normeParam` = '".valid($normeParam)."', `formuleParam`= '".$formule."', `uniteParam` = '".valid($uniteParam)."', `descriptionParamMat` = '".valid($descriptionParamMat)."' WHERE `lab_parametre-matiere`.`id_paramMat` = ".valid($id_paramMat).";");
}

function deleteResultatParametre($id_paramMat,$id_analyseMat){
    $rep = requette("DELETE FROM `lab_resultat-param` WHERE `lab_resultat-param`.`id_paramMat` = ".valid($id_paramMat)." AND `lab_resultat-param`.`id_analyseMat` = ".valid($id_analyseMat)."");
}

function recuplisteAnalyseComplet(){
    $rep= requette(" SELECT * FROM `lab_analyse-matiere` ORDER BY `id_analyseMat` DESC ;");
    return $rep;  
}

function listeMatiereModel(){
    $rep= requette("SELECT * FROM `lab_matiere`");
    return $rep; 
}

/******************* consigne auto ************/
  function saveConsigne($objet,$corp){
    $tempEnvoi= date('Y-m-d H:i:s');
    $rep= requette("INSERT INTO `message` (`id_message`, `id_sender`, `objetMsg`, `jointMsg`, `corpMsg`, `id_reponseMsg`, `tempEnvoiMsg`) VALUES (NULL, '-1', '".valid($objet)."', NULL, '".valid($corp)."', NULL, '".valid($tempEnvoi)."') ;");

    $rep= requette("SELECT `id_message` FROM `message` WHERE `id_sender`=-1 AND `objetMsg`='".valid($objet)."' AND `tempEnvoiMsg`='".valid($tempEnvoi)."' LIMIT 1;");
    return $rep->fetch()['id_message'];
  }

  function recupListeUserMat($id_user){
    $cond= " `type`='matierePremiere' ";//$cond= " `type`='emballage' OR `type`='admin' ";
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

