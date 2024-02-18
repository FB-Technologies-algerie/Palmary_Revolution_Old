<?php
require('controller/laboratoire.php');

	if(isset($_GET['action'])){
		
		if($_GET['action']=='gestionEquipements'){
			if (isset($_GET['v1']) && $_GET['v1']=='supprimer' && isset($_GET['v2'])) {
				deleteEquipement($_GET['v2']);
			}
			elseif(isset($_GET['v1']) && $_GET['v1']=='supprimergroupe' && isset($_GET['v2'])){
				deleteGroupeEquipe($_GET['v2']);
			}
			listeGroupeLabo();
		}
		elseif($_GET['action']=='detailEquipe' && isset($_GET['v1'])){
			detailEquipe($_GET['v1']);

		}
		elseif($_GET['action']=='detailGroupe' && isset($_GET['v1'])) {
			detailGroupeEquipe($_GET['v1']);

		}
		elseif($_GET['action']=='gestionConsommables'){
			if(isset($_GET['v1']) && $_GET['v1']=='supprimer' && isset($_GET['v2'])) {
				deleteEquipeConso($_GET['v2']);
			}
			elseif(isset($_GET['v1']) && $_GET['v1']=='supprimergroupe' && isset($_GET['v2'])){
				deleteGroupeEquipeConso($_GET['v2']);
			}

			listeGroupeLaboConso();
                }
                elseif ($_GET['action']=='detailGroupeConsommable' && isset($_GET['v1'])){  
			detailGroupeConso($_GET['v1']);
            
                }
                elseif($_GET['action']=='detailConsommables' && isset($_GET['v1'])){
			detailConsommable($_GET['v1']);

                }
                elseif($_GET['action']=='ficheDeVie' && isset($_GET['v1'])){
        	       if($_GET['v1'] =='supprimer' && isset($_GET['v2'])){
                        deleteAction($_GET['v2']);
        	       }
        	       elseif(isset($_GET['v2']) && isset($_POST['modifAction'])){
        	       	   updateAction($_GET['v2']);
        	       	   header('Location: '.$_SESSION['url'].'ficheDeVie/'.$_GET['v1']);
        	       }
        	       else{
        	       	ficheDeVie($_GET['v1']);
        	       }
                }
                elseif($_GET['action']=='telecharger' && isset($_GET['v1']) && isset($_GET['v2'])){
                	telechargeFichier($_GET['v1'],$_GET['v2']);
                }
                elseif($_GET['action']=='gestionReactifs'){
                	if(isset($_GET['v1']) && $_GET['v1']=='supprimer' && isset($_GET['v2'])){
	       			deleteReactif($_GET['v2']);
	       		}
	       		elseif(isset($_GET['v1']) && $_GET['v1']=='supprimergroupe' && isset($_GET['v2'])){
	       			deleteGroupeReactif($_GET['v2']);
	       		}
                	listeReactif();
                }
                elseif($_GET['action']=='detailReactifs' && isset($_GET['v1'])){
                	detailReactif($_GET['v1']);
                }
                elseif($_GET['action']=='detailGroupeReactif' && isset($_GET['v1'])) {
                	detailGroupeReactif($_GET['v1']);
                }
                
                elseif($_GET['action']=='MatiereSupprimer' && isset($_GET['v1'])) {
	       		deleteMatiere($_GET['v1']);
                }
                elseif($_GET['action']=='GroupeMatiereSupprimer' && isset($_GET['v1'])) {
                        deleteGroupeMatiere($_GET['v1']);
                }
                elseif ($_GET['action']=='detailMatiere' && isset($_GET['v1'])) {
	       		detailMatiere($_GET['v1']);
                }
                elseif ($_GET['action']=='gestionParametresAnalyse') {
                	ParamètresAnalyse();
                }
                elseif ($_GET['action']=='supprimerParametresAnalyse' && isset($_GET['v1'])) {
	       		deleteParametre($_GET['v1']);
                }
                elseif ($_GET['action']=='detailParametre' && isset($_GET['v1'])) {
                	detailParametre($_GET['v1']);
                }
                elseif ($_GET['action']=='detailDocument' && isset($_GET['v1']) && isset($_GET['v2'])) {
	       		  if(isset($_POST['valideAjout']) && $_GET['v2']==-1) ajoutDocument($_GET['v1'],$_POST);
	       		  elseif(isset($_POST['valideModif'])) modifDocument($_GET['v2'],$_POST);
	       		  else detailDocument($_GET['v1'],$_GET['v2']);
                }
                elseif ($_GET['action']=='supprimeDocument'&& isset($_GET['v1'])) {
                    supprimeDocument($_GET['v1']);
                }
                elseif ($_GET['action']=='gestionVeille') {
                    gestionVeille();
                }
                elseif ($_GET['action']=='VeilleSupprimer' && isset($_GET['v1'])) {
	              deleteVeille($_GET['v1']);
                }
                elseif ($_GET['action']=='VeilleModifier' && isset($_GET['v1'])){
	              detailVeille($_GET['v1']);
                }
                elseif ($_GET['action']=='VeilleModifierVisite' && isset($_GET['v1'])) {  
	       	       modifierVisite($_GET['v1']);
                }
                elseif ($_GET['action']=='gestionArchivage') {
                	echo "gestionArchivage";
                }
                elseif($_GET['action']=='analyseMatiere' && isset($_GET['v1']))  {
                        if(isset($_GET['v2'])){
                            detailResultat($_GET['v1'],$_GET['v2']);
                        }else{
                            detailParametreMatieres($_GET['v1']);   
                        }
                }elseif ($_GET['action']=='modifierResultatAnalyse' && isset($_GET['v1'])) {
                        if (isset($_GET['v2'])) {
                                modifierResultatAnalyse($_GET['v1'],$_GET['v2']);
                        }else{
                                AnalyseMatieres($_GET['v1']);   
                        }
                }elseif ($_GET['action']=='parametreMatiereSupprimer' && isset($_GET['v1'])) {
                        deleteParametreMatiere($_GET['v1']);
                }elseif ($_GET['action']=='listeVersionParam' && isset($_GET['v1']) && isset($_GET['v2'])) {
                         listeVersionParame($_GET['v1'],$_GET['v2']);
                
                }elseif ($_GET['action']=='detailVersionParam' && isset($_GET['v1']) && isset($_GET['v2'])) {
                        detailParamMat($_GET['v1'],$_GET['v2']);

                }elseif($_GET['action']=='supprimerResultAnalyse' && isset($_GET['v1']) && isset($_GET['v2'])) {
                       suppResultatParametre($_GET['v1'],$_GET['v2']);

                }elseif ($_GET['action']=='listeDesAnalyse') {
                    listeAnalyseComplet();

                }
                else{
                    header('Location: '.$_SESSION['url']);
                }
	}
	else groupeLaboratoire();