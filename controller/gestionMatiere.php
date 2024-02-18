<?php
	require('model/gestionMatiere.php');
      
 
	function gestionMatiere(){ 
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
        header('Location: '.$_SESSION['url'].'gestionMatiere');
   		}

   		if(isset($_GET['v1']) && isset($_POST['modifierGroupe'])){
   			modifierGroupeMatiere($_GET['v1'],$_POST);
   		}

        $listeGroupeMatiere=listeGroupeMatiere();
        $listeToutGroupe= listeToutGroupeMatiere();
		$listeMatiere = listeMatiereGroupe();
		
		require('view/gestionMatiere/gestionMatiere.php');
	}

  function deleteGroupeMatiere($id_groupeMat){
    supprimerGroupeMatiere($id_groupeMat);
  } 

    function deleteMatiere($id_matiere){
     
        dropFile('CahierCharge',$id_matiere,'cahierCharge');
        dropFile('FicheTechnique',$id_matiere,'ficheTechnique');
        dropFile('Bulletin',$id_matiere,'bulletinVierge');
       supprimerMatiere($id_matiere);
  }


 function dropFile($type,$id,$fileDocument){
    $file= recupInfoFile($type,$id,$fileDocument);
     if(file_exists($file['path'])) unlink($file['path']);
  }




function recupInfoFile($type,$id,$fileDocument){
    if($type=='Document')
      $file['nom']= explode('!:!',recupNomFileDocument($id,$fileDocument))[1];
    else return null;

    if(is_null($file['nom']) || $file['nom']=='') return null;
    else{
      $file['ext']= substr(strrchr($file['nom'],'.') ,1);
      $file['securite']= verifExtension($file['ext']);
      $file['typeFile']=defineTypeDocument($file['ext']);

      $file['path'] ="archive/process".$type.'-'.$id.'_'.$file['nom'].$file['securite'];
      return $file;
    }
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
          
          header('Location: '.$_SESSION['url'].'gestionMatiere/detailMatiere/'.$id_matiere);
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
    function traiteFormuleAnal($donnee){
        $formule="";
        $i=0;
        while(isset($donnee['reactif'.$i]) && isset($donnee['valReactif'.$i])){
            if($donnee['reactif'.$i]!='') $formule.= $donnee['reactif'.$i].'@'.$donnee['valReactif'.$i].'!:!';
            $i++;
        }
 
        return $formule;
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

  function listeVersionParame($id_matiere,$id_paramAnal){
    $listeVersion = listeVersionParametre($id_matiere,$id_paramAnal);  
      echo json_encode($listeVersion);
  }
  function deleteParametreMatiere($id_paramMat){
      supprParametreMatiere($id_paramMat);
  }

  function detailGroupeEquipe($idGroupeEquipement){ 

    if (isset($_POST['modiferGroupe'])){ 
        $obj=modifierGroupeEquipement($idGroupeEquipement,$_POST['nomGroupe'],$_POST['DescGroupe'],$_POST['idGroupeParent']);
        header('Location: '.$_SESSION['url'].'gestionMatiere');
      }

    $detailGroupeEquipment= selectDetailGroupeEquipe($idGroupeEquipement); 
    echo json_encode($detailGroupeEquipment);
  }
