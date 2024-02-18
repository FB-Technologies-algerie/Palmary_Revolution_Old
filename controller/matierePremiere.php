<?php
	require('model/matierePremiere.php');
	

  function menuMatierePremier(){
      require('view/matierePremiere/Menu.php');
    }


	function gestionArrivageMP(){ 
	  if(isset($_POST['ajouterArrivage'])){
	  	  ajouterArrivageMatiere($_POST);

	  	  header('Location: '.$_SESSION['url'].'gestionArchivage');
	  }
       $listeArrivage = arrivageMatierePremiere();
      $listeGroupeMatiere = groupeMatiere();
	  
      
      require('view/matierePremiere/matierePremiere.php');
	}

	function listMatiere($id_groupe_mat){
       $listMatiere= selectListeMatiere($id_groupe_mat); 
	 	echo json_encode($listMatiere); 	
	}
	
	function suppArrivageMatiere($id_arrivage){
		deleteArrivageMatiere($id_arrivage);
		header('Location: '.$_SESSION['url'].'gestionArchivage');
	}
    
    function definitionArrivage($id_arrivage){       
             if(isset($_POST['modifierArrivage'])) {
                 updateArrivageMatiere($id_arrivage,$_POST);
                 header('Location: '.$_SESSION['url'].'detailArrivage/'.$id_arrivage);
             }
             elseif(isset($_POST['ajouterAnalyse'])){
                $idAnal= ajouterAnalyseArrivage($id_arrivage,$_POST);
                $detailArrivage = selectArrivage($id_arrivage);
        
                $objet="Nouvelle analyse pour '".$detailArrivage['nomMatiere'].' - '.$detailArrivage['fournisseurMatiere']."' .";
                $corp="une nouvelle analyse a était créer pour la matière <b>".$detailArrivage['nomMatiere'].' - '.$detailArrivage['fournisseurMatiere']."</b>. <a class='btn btn-outline-primary btn-sm ml-3' target='_blank' href='../analyseMatiere/".$idAnal."'>Accéder</a>";
                consigneAuto($objet,$corp);

                //header('Location: '.$_SESSION['url'].'detailArrivage/'.$id_arrivage);
             }

          $detailArrivage = selectArrivage($id_arrivage);
          $listeGroupeMatiere = groupeMatiere();
    	    $listeAnalyseMatiere = listeAnalyseMatiereArrivage($id_arrivage);
	 		require('view/matierePremiere/detailArrivage.php');
    }




    function deleteAnalyse($id_analyseMat){
      supprAnalyseArrivage($id_analyseMat);
    }
    
    function detailAnalyse($id_analyseMat){
          $AnalyseMatiere =  AnalyseMatiere($id_analyseMat);
          $resultatAnalyseMatieres  = resultatAnalyseMatiere($id_analyseMat);   
       require('view/matierePremiere/analyseMatiere.php');
           // $analyse= selectAnalyse($id_analyseMat); 
	 	  //  echo json_encode($analyse);
    }


    function groupesParents($id){
      $groupes= selectgroupesParents($id); 
      echo json_encode($groupes);
    }


   function afficheGroupe($id,$chaine){ 
      if ($chaine == null) {
       $char ='';
      }else{
        $char =' ► ' ;
      }
      $parent= selectgroupesParentGroupeMatiere($id);   
if ($parent['id_groupeParent'] != null && $parent['id_groupeParent'] != $id ) { 
               $ru =  afficheGroupe($parent['id_groupeParent'],$parent['nomGroupeMat']).$char.$chaine;
           } else{ 
             $ru = $parent['nomGroupeMat'].$char.$chaine;
           } 

           
           return $ru;
    }












    /********************** CONSIGNE AUTO ****************************/
  function consigneAuto($objet,$corp){
    $dateTime= date('Y-m-d H:i:s');
    $id_consigne= saveConsigne($objet,$corp);
    
    $listRecepteur= recupListeUserLab($_SESSION['id_user']);
    while ($recept=$listRecepteur->fetch()) {
      envoiConsigne($id_consigne,$recept['id_user']);
    }
  }
/**************************************************/
  