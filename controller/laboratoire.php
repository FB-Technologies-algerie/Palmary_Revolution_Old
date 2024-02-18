<?php
	require('model/laboratoire.php');
	
	function groupeLaboratoire(){
    require('view/laboratoire/laboMenu.php');
	}
	
	function listeGroupeLabo(){
	  if (isset($_POST['ajouterEquipe'])){
	  	ajouterEquipement($_POST['nomEquipement'],$_POST['descriptionEquipement'],$_POST['GroupeEqu']);

	  
	  }
	  if (isset($_POST['ajouterGroupe'])){
	  	ajouterGroupeEquipement($_POST['nomGroupe'],$_POST['DescGroupe'],$_POST['selectGroupe']);
	  }
       
       $listeG= listeGroupeEq();
       $equipementLibre = listeEquipementLibre();
       $listeGE=listeGroup();
	   $listGroupeE= listeGroup();
	   $listeGajout=listeGroup();
	   $listeGdetail=listeGroup();

       require('view/laboratoire/getionEquipement.php');
	}

    

	function detailEquipe($id_equipement){
	if (isset($_POST['modifer'])){ 
	  $obj= modifierEquipement($id_equipement,$_POST['nomEquipe'],$_POST['descriptionEquipe'],$_POST['GroupeEquipement']);
	 header('Location: '.$_SESSION['url'].'gestionEquipements');
    	}
	 $detailEquipment= selectDetailEquipe($id_equipement); 
	 	echo json_encode($detailEquipment);
	}


	function detailGroupeEquipe($idGroupeEquipement){
		if (isset($_POST['modiferGroupe'])){ 
		  	$obj=modifierGroupeEquipement($idGroupeEquipement,$_POST['nomGroupeEquipe'],$_POST['DiscgroupeEquipe'],$_POST['GroupeEquipement']);
	    	header('Location: '.$_SESSION['url'].'gestionEquipements');
    	}

		$detailGroupeEquipment= selectDetailGroupeEquipe($idGroupeEquipement); 
		echo json_encode($detailGroupeEquipment);
	}

    function deleteEquipement($id_equipement){
    	$obj= supprimerEquipement($id_equipement);
    }

    function deleteGroupeEquipe($id_groupe){
    	$obj= supprimerGroupeEquipement($id_groupe);
    }
	

	function ficheDeVie($id_equipement){
	    if(isset($_POST['ajouterAction'])){
	    	if (isset($_POST['freqAction'])) {
	    		$id_action= ajouterAction($id_equipement,$_POST['nomAction'],$_POST['dateAction'],$_POST['responsable'],$_POST['decision'],$_POST['numDocument'],$_POST['commentAvis'],$_POST['freqAction']);  
	    	}else{
                $id_action= ajouterAction($id_equipement,$_POST['nomAction'],$_POST['dateAction'],$_POST['responsable'],$_POST['decision'],$_POST['numDocument'],$_POST['commentAvis']);
	    	}
	    	if(isset($_POST['typeLienAction'])){
	     		$lienAction= ecrireLien('Action',$id_action);
	     	}else $lienAction=false;

	     	if(isset($_POST['typeLienDecision'])){
	     		$lienDecision= ecrireLien('Decision',$id_action);
	     	}else $lienDecision=false;

	     	if($lienAction || $lienDecision){
	     		ajouterLienActionDecision($id_action,$lienAction,$lienDecision);
	     	}

       		header('Location: '.$_SESSION['url'].'ficheDeVie/'.$id_equipement);
	    }
	    elseif(isset($_POST['modifierDetailEquipement'])){
	     	if(isset($_POST['typeLienConstructeur'])){
	     		$lienConstructeur= ecrireLien('Constructeur',$id_equipement);
	     	}else $lienConstructeur=false;

	     	if(isset($_POST['typeLienFournisseur'])){
	     		$lienFournisseur= ecrireLien('Fournisseur',$id_equipement);
	     	}else $lienFournisseur=false;

	     	if($lienConstructeur) dropFile('Constructeur',$id_equipement);
	     	if($lienFournisseur) dropFile('Fournisseur',$id_equipement);
	     	modifierFicheDeVieEquipement($id_equipement,$_POST['marque'],$_POST['modele'],$_POST['nSerie'],$_POST['reference'],$_POST['dateReception'],$_POST['dateMisService'],$_POST['constructeur'],$lienConstructeur,$_POST['fournisseur'],$lienFournisseur,$_POST['affectation'],$_POST['nIdentification']);
	    }


	    $ficheDeVie= recupFicheDeVieEquipement($id_equipement);
	    $ficheDeVie['lienConstructeur']= reecrireLien($ficheDeVie['lienConstructeur']);
	    $ficheDeVie['lienFournisseur']= reecrireLien($ficheDeVie['lienFournisseur']);
	    

	    $listeActionActive = listeActiveAction($id_equipement);
	    $listeAction = listeAction($id_equipement);

	    require('view/laboratoire/ficheDeVie.php');
	}

	function gestionVeille(){ 
   		if(isset($_POST['ajouterVeille'])){
     		ajouterVeille($_POST['nomVeille'],$_POST['lienVeille'],$_POST['descriptionVeille'],$_POST['dateVisite'],$_POST['Periode']);
     		header('Location: '.$_SESSION['url'].'gestionVeille');
   		}
   
     	$listeRetarderVeille = listeRetarderVeille();
     	$listeAttanteVeille = listeAttanteVeille();
	 	require('view/laboratoire/gestionVeille.php');	
	}

	function detailVeille($id_veille){
        if(isset($_POST['modifierVeille'])){
          modifierVeille($id_veille,$_POST['nomVeille'],$_POST['lienVeille'],$_POST['descriptionVeille'],$_POST['dateVisite'],$_POST['Periode']);
            header('Location: '.$_SESSION['url'].'gestionVeille');
        }
	 $detailVeille= selectDetailVeille($id_veille); 
	 echo json_encode($detailVeille);
	}

 function deleteVeille($id_veille){
     supprimerVeille($id_veille);
 }
 function modifierVisite($id_veille){
 	  supprimerVisite($id_veille);
 }





	function updateAction($id_action){
		if(isset($_POST['typeLienAction'])){
	    	$lienAction= ecrireLien('Action',$id_action);
	    }else $lienAction=false;

	    if(isset($_POST['typeLienDecision'])){
	    	$lienDecision= ecrireLien('Decision',$id_action);
	    }else $lienDecision=false;
            
        if($lienAction) dropFile('Action',$id_action);
		if($lienDecision) dropFile('Decision',$id_action);
        /*nabil modifier*/
        if(isset($_POST['freqAction'])) {
        	modifierAction($id_action,$_POST['nomAction'],$lienAction,$_POST['dateAction'],$_POST['responsable'],$_POST['decision'],$lienDecision,$_POST['freqAction'],$_POST['numDocument'],$_POST['commentAvis']);
        }else{
            modifierAction($id_action,$_POST['nomAction'],$lienAction,$_POST['dateAction'],$_POST['responsable'],$_POST['decision'],$lienDecision,$_POST['numDocument'],$_POST['commentAvis']);
        }          /*nabil modifier*/
	}

	function deleteAction($id_action){
    	dropFile('Action',$id_action);
		dropFile('Decision',$id_action);

    	supprimerAction($id_action);
    }
    
    

/************* consommable  *************/
function listeGroupeLaboConso(){ 
     if (isset($_POST['ajouterEquipeConso'])){
     	ajouterEquipeConsommable($_POST['nomEquipement'],$_POST['fournisseur'],$_POST['quantite'],$_POST['descriptionEquipement'],$_POST['GroupeConso']);
     }
      if (isset($_POST['ajouterGroupe'])){
	  	ajouterGroupeEquipeConso($_POST['nomGroupe'],$_POST['DescGroupe'],$_POST['selectGroupe']);
	  }
    
	   $listeGC= listeGroupeConsommable();
	   $listeDetailGroupe= listeGroupeEqConso();
	   $listeGConso=listeGroupeEqConso();
	   $listeGroupeConso=listeGroupeEqConso();
	   $GroupeD=listeGroupeEqConso();
       require('view/laboratoire/gestionConsommable.php');
	}

function detailConsommable($id_consommable){
	
	if (isset($_POST['modifer'])){ 
	 	$obj= modifierConsommable($id_consommable,$_POST['nomConso'],$_POST['fournisseur'],$_POST['quantite'],$_POST['DescriptionConso'],$_POST['GroupeConso']);

	 	header('Location: '.$_SESSION['url'].'gestionConsommables');
    }
    else{
	 	$detailConso= selectDetailConsom($id_consommable); 
	 	echo json_encode($detailConso);	
    }
}


	function detailGroupeConso($id_groupe){
		if (isset($_POST['modiferGroupe'])){ 
		  $obj=modifierGroupeConsomable($id_groupe,$_POST['nomGroupeConsommable'],$_POST['DiscgroupeC'],$_POST['GroupeEquipement']);
	      header('Location: '.$_SESSION['url'].'gestionConsommables');
    	}
	 	else{
	 		$detailGroupe= selectDetailGroupeConso($id_groupe); 
	 		echo json_encode($detailGroupe);
	 	}
	}

	function deleteEquipeConso($id_consommable){
    	$obj= supprimerEquipeConsommable($id_consommable);
    }

    function deleteGroupeEquipeConso($id_groupe){
    	$obj= supprimerGroupeEquipeConso($id_groupe);
    }


/***************** Reactif  *************/
	function listeReactif(){
      if(isset($_POST['ajouterEquipeReactif'])){ 
     	$id_reactif=ajouterEquipeReactif($_POST['nomEquipement'],$_POST['fournisseur'],$_POST['descriptionReactif'],$_POST['quantite'],$_POST['uniteReactif'],$_POST['GroupeReactif'],$_POST['mailFournisseur'],$_POST['numLot'],$_POST['dateOuverture']);

     	if(isset($_POST['typeLienFds'])){
	     	$lienFds= ecrireLien('Fds',$id_reactif);
	    }else $lienFds=false;
	    if(isset($_POST['typeLienDlc'])){
	     	$lienDlc= ecrireLien('Dlc',$id_reactif);
	    }else $lienDlc=false;
	    if($lienFds || $lienDlc) ajouterLienFdsDlc($id_reactif,$lienFds,$lienDlc);
      }
      elseif(isset($_POST['ajouterGroupe'])){
     	$obj=ajouterGroupeEquipeReactif($_POST['nomGroupe'],$_POST['DescGroupe'],$_POST['selectGroupe']);
      }
	  
	  $listeReactif = listeGroupeReactif();
	  $listeGReactif = listeGroupeReactif();
	  $listeGroupeReactif = listeGroupeReactif();
	  $GroupeD = listeGroupeReactif();
	  $listeDetailGroupe=listeGroupeReactif();
	  
	  require('view/laboratoire/gestionReactif.php');

	}


	function deleteReactif($idReactif){ 

		dropFile('Fds',$idReactif);
		dropFile('Dlc',$idReactif);

    	$obj= supprimerEquipeReactif($idReactif);
    }

    function deleteGroupeReactif($id_groupe){
    	$obj= supprimerGroupeEquipeReactif($id_groupe);
    }

    function detailReactif($id_reactif){ 
		if(isset($_POST['modifier'])){
		  	if(isset($_POST['typeLienFds'])){
		     	$lienFds= ecrireLien('Fds',$id_reactif);
		    }else $lienFds=false;
		    if(isset($_POST['typeLienDlc'])){
		     	$lienDlc= ecrireLien('Dlc',$id_reactif);
		    }else $lienDlc=false;
			
			if($lienFds) dropFile('Fds',$id_reactif);
			if($lienDlc) dropFile('Dlc',$id_reactif);
		 
		  	modifierReactif($id_reactif,$_POST['nomConso'],$_POST['fournisseur'],$_POST['descriptionReactif'],$_POST['quantite'],$_POST['uniteReactifI'],$_POST['mailFournisseurI'],$lienFds,$lienDlc,$_POST['numLotI'],$_POST['dateOuvertureI'],$_POST['groupeReactif']);

	 		header('Location: '.$_SESSION['url'].'gestionReactifs');
    	}
	 	else{
	 		$detailR= selectDetailReactif($id_reactif);
	 		$detailR['fds']=reecrireLienA($detailR['fds']);
	 		$detailR['dlc']=reecrireLienA($detailR['dlc']);
	 		
	 		echo json_encode($detailR);
	 	}
	}
	

	function detailGroupeReactif($id_groupe){
		if(isset($_POST['modifierGroupe'])){ 
		 
		  	$obj=modifierGroupeReactif($id_groupe,$_POST['nomGroupeConsommable'],$_POST['DiscgroupeC'],$_POST['GroupeEquipement']);
		    header('Location: '.$_SESSION['url'].'gestionReactifs');
    	}
    	else{
		 	$detailGroupe= selectDetailGroupeReactif($id_groupe); 
		 	echo json_encode($detailGroupe);
    	}
	}


/************ gestionMatiere  *********/

/**--------------------------------------------*/
	/*function gestionMatiere(){ 
 		if(isset($_POST['ajouterMatiere'])){
    		$id_matiere= ajouterMatiere($_POST['nomMatiere'],$_POST['fournisseurMatiere'],$_POST['descriptioncMatiere'],$_POST['idGroupeMatiere']);

    		if(isset($_POST['typeLienCahierCharge'])){
	     		$cahierCharge= ecrireLien('CahierCharge',$id_matiere);
	     	}else $cahierCharge=false;

    		if(isset($_POST['typeLienFicheTechnique'])){
	     		$ficheTechnique= ecrireLien('FicheTechnique',$id_matiere);
	     	}else $ficheTechnique=false;

	     	if(isset($_POST['typeLienBulletin'])){
	     		$bulletinVierge= ecrireLien('Bulletin',$id_matiere);
	     	}else $bulletinVierge=false;

    		if($cahierCharge || $ficheTechnique || $bulletinVierge) ajouterLienMatiere($id_matiere,$cahierCharge,$ficheTechnique,$bulletinVierge);
    		
       		header('Location: '.$_SESSION['url'].'gestionMatiere');
   		}

   		if(isset($_POST['ajouterGroupe'])){
   			ajouterGroupeMatiere($_POST);
   		}

   		if(isset($_GET['v1']) && isset($_POST['modifierGroupe'])){
   			modifierGroupeMatiere($_GET['v1'],$_POST);
   		}

        $listeGroupeMatiere=listeGroupeMatiere();
        $listeToutGroupe= listeToutGroupeMatiere();
		$listeMatiere = listeMatiereGroupe();
		
		require('view/laboratoire/gestionMatiere.php');
	}*/

	function deleteMatiere($id_matiere){
   		dropFile('CahierCharge',$id_matiere);
		dropFile('FicheTechnique',$id_matiere);
		dropFile('Bulletin',$id_matiere);
		
		supprimerMatiere($id_matiere);
	}

	function deleteGroupeMatiere($id_groupeMat){
		supprimerGroupeMatiere($id_groupeMat);
	}

	function traiteFormuleAnal($donnee){
        $formule="";
        $i=0;
        while(isset($donnee['reactif'.$i]) && isset($donnee['valReactif'.$i])){
            if($donnee['reactif'.$i]!='') $formule.= $donnee['reactif'.$i].'@'.$donnee['valReactif'.$i].'!:!';
            $i++;
        }
 
        return $formule;
    }

	function detailMatiere($id_matiere){
        if(isset($_POST['modifierMatiere'])){
    		if(isset($_POST['typeLienCahierCharge'])){
	     		$cahierCharge= ecrireLien('CahierCharge',$id_matiere);
	     	}else $cahierCharge=false;

    		if(isset($_POST['typeLienFicheTechnique'])){
	     		$ficheTechnique= ecrireLien('FicheTechnique',$id_matiere);
	     	}else $ficheTechnique=false;

	     	if(isset($_POST['typeLienBulletin'])){
	     		$bulletinVierge= ecrireLien('Bulletin',$id_matiere);
	     	}else $bulletinVierge=false;

   			if($cahierCharge) dropFile('CahierCharge',$id_matiere);
			if($ficheTechnique) dropFile('FicheTechnique',$id_matiere);
			if($bulletinVierge) dropFile('Bulletin',$id_matiere);

            modifierMatiere($id_matiere,$_POST['nomMatiere'],$_POST['fournisseurMatiere'],$cahierCharge,$ficheTechnique,$bulletinVierge,$_POST['descriptioncMatiere'],$_POST['idGroupeMatiere']);
       		
    		header('Location: '.$_SESSION['url'].'detailMatiere/'.$id_matiere);
        }
        elseif(isset($_POST['ajouterParametreAnalyse'])){
          $formule = traiteFormuleAnal($_POST);
   			ajouterParametreMatiere($id_matiere,$_POST['id_paramAnal'],$_POST['nomVersion'],$_POST['dateVersion'],$_POST['normeParam'],$formule,$_POST['uniteParam'],$_POST['descriptionParamMat']);
   		    
   		    header('Location: '.$_SESSION['url'].'detailMatiere/'.$id_matiere);
   		}
   		else{
	 		$detailMatiere= selectDetailMatiere($id_matiere);
	 		$detailMatiere['cahierCharge']= reecrireLienA($detailMatiere['cahierCharge']);
	 		$detailMatiere['ficheTechnique']= reecrireLienA($detailMatiere['ficheTechnique']);
	 		$detailMatiere['bulletinVierge']= reecrireLienA($detailMatiere['bulletinVierge']); //var_dump($detailMatiere['ficheTechnique']);die;

	 		$ListeParametreMatiere = parametreMatiere($id_matiere); 
	 		$listeParametreAnalyse = parametreAnalyse();
	 		$listeToutGroupe= listeToutGroupeMatiere();
	 		$ReactifParametre = recupReactifParametre();
	 		require('view/laboratoire/paramMatiere.php');
   		}
	}

	function ParamètresAnalyse(){ 
       	if(isset($_POST['valider'])){
      		ajouterParametre($_POST['nomParam'],$_POST['descriptionParam']);
    
       		header('Location: '.$_SESSION['url'].'gestionParametresAnalyse');
   		}

		$listeParametre =listeParametre();
		require('view/laboratoire/gestionParametresAnalyse.php');
	}
	
	function deleteParametre($id_param){
    	supprimerParametre($id_param);

    	header('Location: '.$_SESSION['url'].'gestionParametresAnalyse');
	}

	function detailParametre($id_param){  
    	if(isset($_POST['validerModif'])){
      		modifierParametre($id_param,$_POST['nomParam'],$_POST['descriptionParam']);
              
        	header('Location: '.$_SESSION['url'].'detailParametre/'.$id_param);
		} 
		
		$listeDocument= recupListeDoc($id_param);
 		$Parametre = detailParametreAnalyse($id_param);
		
		require('view/laboratoire/detailParametre.php');
	}

	function detailDocument($id_param,$id_document){
		$document= ($id_document!=-1)? recupDetailDocument($id_document) : array('nomDocument'=>'','fileDocument'=>'','typeDocument'=>'','descriptionDoc'=>'' );

		$document['fileDocument']=reecrireLienA($document['fileDocument']);
		
		require('view/laboratoire/detailDocument.php');
	}

	function ajoutDocument($id_param,$donnee){
		$id_document= ajouterDocument($id_param,$donnee);

		if(isset($_POST['typeLienDocument'])){
	     	$document= ecrireLien('Document',$id_document);
	     	if($_POST['typeLienDocument']=='FILE')
				$donnee['typeDocument']= defineTypeDocument(substr(strrchr($document,'.') ,1));
	    }else $document=false;

    	if($document) ajouterLienDocument($id_document,$document,$donnee['typeDocument']);
       	
       	echo "<script>window.onload = function(){window.parent.location.href=window.parent.location.href;}</script>";
	}

	function modifDocument($id_document,$donnee){
		modifierDocument($id_document,$donnee);

		if(isset($_POST['typeLienDocument'])){
	     	$document= ecrireLien('Document',$id_document);
	     	if($_POST['typeLienDocument']=='FILE')
				$donnee['typeDocument']= defineTypeDocument(substr(strrchr($document,'.') ,1));
	    }else $document=false;

    	if($document){
    		dropFile('Document',$id_document);
    		ajouterLienDocument($id_document,$document,$donnee['typeDocument']);
    	}
       	
       	echo "<script>window.onload = function () {window.parent.location.href=window.parent.location.href;}</script>";
	}

	function supprimeDocument($id_document){
		dropFile('Document',$id_document);

	    deleteDocument($id_document);

	    echo"<script>window.onload = function(){parent.location.href=parent.location.href;}</script>";
	}

	function listeAnalyseMatiere($id_matiere){
     	if(isset($_POST['ajouterAnalyse'])){
     		$idAnal= ajouterAnalyseMatiere($id_matiere,$_POST);

     		header('Location: '.$_SESSION['url'].'analyseMatiere/'.$idAnal);
     	}

     	$listeAnalyseMatiere=recupAnalyseMatiere($id_matiere);
       	require('view/laboratoire/listeAnalyses.php');
	}

	function daleteAnalyseMatiere($id_analyseMat){
       supprimerAnalyseMatiere($id_analyseMat);
       require('view/laboratoire/listeAnalyses.php');
  	}

  	function detailParametreMatieres($id_analyseMat){
    	if(isset($_POST['ajoutParamAnalyse'])){ 
	      if(!verifExistParam($_POST['parametreAnalyse'],$id_analyseMat)){
	        ajouterParametreAnalyse($_POST['parametreAnalyse'],$id_analyseMat);
	        $formul= explode("!:!", recupFromulParam($_POST['parametreAnalyse']));

    		for($i=0; $i<count($formul)-1; $i++){
       		  $react = explode("@", $formul[$i]);
       		  if(sizeof($react)==2) demenuReactif($react[0],$react[1]);
    		}
	      }
	      header('Location: '.$_SESSION['url'].'analyseMatiere/'.$id_analyseMat);
    	}
    	elseif(isset($_POST['modifierAnalyseMatiere'])){ 
	        modifierAnalyseMatiere($id_analyseMat,$_POST['datePrelevement']);
	        header('Location: '.$_SESSION['url'].'analyseMatiere/'.$id_analyseMat);
    	}

        $AnalyseMatiere =  AnalyseMatiere($id_analyseMat);
        $listeParamMatiere= recupListeParamMatiere($id_analyseMat);
        $resultatAnalyseMatieres  = resultatAnalyseMatiere($id_analyseMat);

        if(isset($_POST['termineAnalyse'])){ 
	        termineAnalyse($id_analyseMat,$_POST['dateFin'],$_POST['etatAnalyse'],$_POST['conclusionAnalyse']);
	        
	        $objet="une analyse de la matière '".$AnalyseMatiere['nomMatiere']."' est terminé.";
            $corp="l'analyse du lot ".$AnalyseMatiere['numLot']." de la matière <b>'".$AnalyseMatiere['nomMatiere'].' - '.$AnalyseMatiere['fournisseurMatiere']."'</b> a été ".$_POST['etatAnalyse'].".<br><br><b>Conclusion:</b><p>".$_POST['conclusionAnalyse']."</p><a class='btn btn-outline-primary btn-sm ml-3' target='_blank' href='../analyseMatiere/".$id_analyseMat."'>Accéder au resultat</a> <a class='btn btn-outline-primary btn-sm ml-3' target='_blank' href='../detailArrivage/".$AnalyseMatiere['id_arrivage']."#id_ligne'>Accéder à l'arrivage</a>";
            consigneAuto($objet,$corp);

	        header('Location: '.$_SESSION['url'].'analyseMatiere/'.$id_analyseMat);
    	}

        require('view/laboratoire/AnalyseMatiere.php');
    }

    function detailResultat($id_analyseMat,$id_paramMat){
	 	$detailAnalyse= selectdetailAnalyse($id_analyseMat,$id_paramMat);  
	 	$listeDocument= recupListeDoc($id_paramMat);
	    $TableParamMat= explode('!:!', $detailAnalyse['formuleParam']);
	    		 $formuleTest='';
	  
	    foreach ($TableParamMat as $formule) { 
	    	$formule=explode('@', $formule);
	    	if (sizeof($formule) == 2) {
	    		$Reactif = recupReactif($formule[0]); 
          $formuleTest.= $Reactif['nomReactif'].'('.$formule[1].$Reactif['uniteReactif'].'), ';
	    		//addFormule($formule[0],$formule[1]);
	    	}
           
           }

	  	require('view/laboratoire/detailResultatAnalyse.php');
	}
     
	







	function modifierResultatAnalyse($id_analyseMat,$id_paramMat){
		if(isset($_POST['modifierAnalyse'])){
          	modifierResulatatAnalyseDB($id_analyseMat,$id_paramMat,$_POST['resultParam'],$_POST['dateAnal'],$_POST['descriptionAnal']);          

          	echo "<script>window.parent.location.href ='".$_SESSION['url']."analyseMatiere/'+".$id_analyseMat."; </script>";
        }
	}

	function deleteParametreMatiere($id_paramMat){
     	supprParametreMatiere($id_paramMat);
	}


	function listeVersionParame($id_matiere,$id_paramAnal){
	 	$listeVersion = listeVersionParametre($id_matiere,$id_paramAnal);  
	    echo json_encode($listeVersion);
	}

	function detailParamMat($id_matiere,$id_paramMat){
		if(isset($_POST['modifierParameMatiere'])){
			$formule = traiteFormuleAnal($_POST);
			updateParametreMat($id_paramMat,$_POST['nomVersion'],$_POST['dateVersion'],$_POST['normeParam'],$formule,$_POST['uniteParam'],$_POST['descriptionParamMat']);
	 		//echo "<script>window.parent.location.href ='".$_SESSION['url']."detailMatiere/'+".$id_matiere."; </script>";
		}
		$ParamMat = selectParamMat($id_paramMat);
		$TableParamMat= explode('!:!', $ParamMat['formuleParam']);

		$listeParametreAnalyse = parametreAnalyse();
		$ReactifParametre = recupReactifParametre();
    	require('view/laboratoire/detailVersionParam.php');
	}

	function suppResultatParametre($id_paramMat,$id_analyseMat){
		deleteResultatParametre($id_paramMat,$id_analyseMat);
		
		header('Location: '.$_SESSION['url'].'analyseMatiere/'.$id_analyseMat.'/'.$id_paramMat);
	}

	function listeAnalyseComplet(){ 
		if(isset($_POST['ajouterAnalyse'])){ 
     		$idAnal= ajouterAnalyseMatiere($_POST['idMatiere'],$_POST);
     		header('Location: '.$_SESSION['url'].'analyseMatiere/'.$idAnal);
     	}
		$listeMatiere = listeMatiereModel();
     	$listeAnalyseComplet=recuplisteAnalyseComplet();
       	
       	require('view/laboratoire/ListeAnalyseComplet.php');
	}



/******** les fonctions *********/

	function saveFile($nom,$id){
    	$securite= verifExtension(substr(strrchr($_FILES['lien'.$nom]['name'],'.') ,1));

		$nameFile = $nom."-".$id."_".$_FILES['lien'.$nom]['name'].$securite;
		$chemin = "archive/lab".$nameFile;
		
		move_uploaded_file($_FILES['lien'.$nom]['tmp_name'],$chemin);
    }

    function verifExtension($extension){
		$extensionsNonValides = array( 'sql' , 'php' , 'js' , 'html' , 'css' , 'exe' );
		$extension= strtolower($extension);

		if(in_array($extension,$extensionsNonValides)) return ".file";
		else return '';
	}

	function defineTypeDocument($extension){
		switch ($extension) {
			case 'doc': case 'docx': return 'word';
			case 'xlsx':case 'xlsm':case 'xlsb':case 'xltm': return 'excel';
			case 'pptx':case 'pptm':case 'ppt': return 'powerPoint';
			case 'pdf': return 'pdf';
			case 'bmp':case 'tif':case 'tiff':case 'gif':case 'jpeg':case 'jpg':case 'png': return 'image';
			case 'mp3':case 'wav':case 'ogg': return 'audio';
			case 'avi':case 'wmv':case 'mp4':case 'wmf': return 'video';
			
			default: return 'autre';
		}
	}

	function dropFile($type,$id){
		$file= recupInfoFile($type,$id);

	    if(file_exists($file['path'])) unlink($file['path']);
	}

	function recupInfoFile($type,$id){
		if($type=='Constructeur' || $type=='Fournisseur')
			$file['nom']= explode('!:!',recupNomFileEquipement($type,$id))[1];
		elseif($type=='Action' || $type=='Decision')
			$file['nom']= explode('!:!',recupNomFileAction($type,$id))[1];
		elseif($type=='Document')
			$file['nom']= explode('!:!',recupNomFileDocument($id))[1];
		elseif($type=='Fds' || $type=='Dlc')

			$file['nom']= explode('!:!',recupNomFileReactif($type,$id))[1]; 
		elseif($type=='CahierCharge' || $type=='FicheTechnique' || $type=='Bulletin')
			$file['nom']= explode('!:!',recupNomFileMatiere($type,$id))[1];
		else return null;

		if(is_null($file['nom']) || $file['nom']=='') return null;
		else{
			$file['ext']= substr(strrchr($file['nom'],'.') ,1);
			$file['securite']= verifExtension($file['ext']);
			$file['typeFile']=defineTypeDocument($file['ext']);

			$file['path'] ="archive/lab".$type.'-'.$id.'_'.$file['nom'].$file['securite'];
			return $file;
		}
	
	}

	function telechargeFichier($type,$id){
		$file= recupInfoFile($type,$id);
		
	    if(!file_exists($file['path']) || is_null($file)){
	    	$file['path']= "public/img/no-img.png";
	    	$file['typeFile']='image'; $file['ext']='png';
	    }
	    
		if($file['typeFile']=='image'){
			//header('Content-Type: image/png');
			header('Content-Type: image/'.(($file['ext']=='jpg')?'jpeg':$file['ext']).' ');
		}
		elseif($file['typeFile']=='pdf'){
			header('Content-Type: application/pdf');
		}
		elseif($file['typeFile']=='word'){
			header('Content-Type: application/octet-stream');
			//header("Content-Type: application/vnd.ms-word; charset=utf-8");
			header('Content-Disposition: attachment; filename="'.$file['nom'].'"');
		}
		elseif($file['typeFile']=='excel'){
			header("Content-Type: application/vnd.ms-excel; charset=utf-8");
			header('Content-Disposition: attachment; filename="'.$file['nom'].'"');
		}
		elseif($file['typeFile']=='powerPoint'){
			header("Content-Type: application/vnd.ms-powerpoint; charset=utf-8");
			header('Content-Disposition: attachment; filename="'.$file['nom'].'"');
		}
		elseif($file['typeFile']=='video'){
			header('Content-type: video/'.$file['ext']);
			header('Content-disposition: inline');
			header("Content-Transfer-Encoding:­ binary");
		}
		elseif($file['typeFile']=='audio'){
			header("Content-Type: audio/".$file['ext']);
			echo 	'<audio controls="controls" autoplay>
    					<source src="'.$file['path'].'"  />
					</audio>';
		}
		else {
			header('Content-Transfer-Encoding: binary');
			header('Content-Disposition: attachment; filename="'.$file['nom'].'"');
		}
	    readfile($file['path']);
	}

    function ecrireLien($nom,$id){
		if($_POST['typeLien'.$nom]=='FILE'){
		  if($_FILES['lien'.$nom]['error']==0){
			saveFile($nom,$id);
    		return $_POST['typeLien'.$nom].'!:!'.$_FILES['lien'.$nom]['name'];
		  }
		  else return false;
		}
		else return $_POST['typeLien'.$nom].'!:!'.$_POST['lien'.$nom];
    }

	function reecrireLien($lien){
		$nouv['FILE']=$nouv['LINK']="";
		if($lien!=''){
			$lien= explode('!:!', $lien);
			if(sizeof($lien)==2){
				if($lien[0]=='FILE') $nouv['FILE']=$lien[1];
				elseif($lien[0]=='LINK') $nouv['LINK']=$lien[1];
			}
		}
		
		return $nouv;
	}

	function reecrireLienA($lien){
		$nouv['type']=$nouv['lien']="";
		if($lien!=''){
			$lien= explode('!:!', $lien);
			if(sizeof($lien)==2){
				if($lien[0]=='FILE'){
					$nouv['type']=$lien[0];
					$nouv['lien']=$lien[1];
				}
				elseif($lien[0]=='LINK'){
					$nouv['type']=$lien[0];
					$nouv['lien']=$lien[1];
				}
			}
		}
		
		return $nouv;
	}




	/********************** CONSIGNE AUTO ****************************/
  function consigneAuto($objet,$corp){
    $dateTime= date('Y-m-d H:i:s');
    $id_consigne= saveConsigne($objet,$corp);
    
    $listRecepteur= recupListeUserMat($_SESSION['id_user']);
    while ($recept=$listRecepteur->fetch()) {
      envoiConsigne($id_consigne,$recept['id_user']);
    }
  }
/**************************************************/
