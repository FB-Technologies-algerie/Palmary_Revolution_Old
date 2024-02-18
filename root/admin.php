<?php 
		// charger les controleurs
	require('controller/admin.php');

		// initialisation des prévillèges
	if(!isset($_SESSION['droit'])) $_SESSION['droitAdmin']= droitAdmin($_SESSION['id_user']);
		// créer les routes
	if(isset($_GET['action'])){
		if($_GET['action']=='gestionUtilisateurs'){
			if(isset($_GET['v1'])){
				if($_GET['v1']=="supprimer" && isset($_GET['v2'])){
					supprimeUser($_GET['v2']);
				}
				elseif ($_GET['v1']=="modifier" && isset($_GET['v2'])){  //formulaire de modification
					formUser($_GET['v2']);
				}
				elseif ($_GET['v1']=="ajouter" && isset($_POST['valider'])){  //l'ajout sur la base de données
					$idUser= ajoutUser($_POST);
					if($idUser && $_POST['type']=='control') header('Location: '.$_SESSION['url'].'gestionUtilisateurs/modifier/'.$idUser);
					else header('Location: '.$_SESSION['url'].'gestionUtilisateurs');
				}
			}
			else gestionUsers();
		}
		elseif($_GET['action']=='gestionUnitesProd' && $_SESSION['droitAdmin']==','){
			if(isset($_GET['v1']) && $_GET['v1']=="supprimer" && isset($_GET['v2'])){
				supprimeUniteP($_GET['v2']);
			}
			else gestionUnitesProd();
		}
		elseif($_GET['action']=='gestionLignesProd'){
			if(isset($_GET['v1']) && $_GET['v1']=="supprimer" && isset($_GET['v2'])){
				supprimeLigneP($_GET['v2']);
			}
			elseif(isset($_GET['v1']) && $_GET['v1']=="supprimeCat" && isset($_GET['v2'])){
				supprimeCategorie($_GET['v2']);
			}
			else gestionLignesProd();
		}
		elseif($_GET['action']=='gestionProd'){
			if(isset($_GET['v1'])){
				if($_GET['v1']=="supprimer" && isset($_GET['v2'])){
					supprimeProd($_GET['v2']);
				}
				elseif ($_GET['v1']=="modifier" && isset($_GET['v2'])){  //formulaire de modification
					formProd($_GET['v2']);
				}
				else gestionProd();
			}
			else gestionProd();
		}
		elseif($_GET['action']=='formNorme'){ // revolution/formNorme/5 or revolution/formNorme/addP/3
			if(isset($_GET['v1'])){
			  if($_GET['v1']=='supprimer'){  // revolution/formNorme/supprimer/1
			  	if(isset($_GET['v2'])) supprimeNorme($_GET['v2']);
			  	 else header('Location: '.$_SESSION['url']);
			  }elseif($_GET['v1']=='addP'){
			  	if(isset($_GET['v2'])){
					formNorme($_GET['v1'],$_GET['v2']);
			  	}else{
			  		header('Location: '.$_SESSION['url']);
			  	}
			  }else formNorme('modif',$_GET['v1']);
			 
			}
			else header('Location: '.$_SESSION['url']);
		}
		elseif($_GET['action']=='groupeN'){  // revolution/groupeN/modif/1 or revolution/groupeN/ajout/4 or revolution/groupeN/suppr/1
			if(isset($_GET['v1']) && isset($_GET['v2'])){
				if(($_GET['v1']=='modif' || $_GET['v1']=='ajout') && isset($_POST['valider']))
					formGroupeN($_GET['v1'],$_GET['v2'],$_POST);
				elseif($_GET['v1']=='suppr') formGroupeN($_GET['v1'],$_GET['v2']);		
			}else header('Location: '.$_SESSION['url']);
		}
		elseif($_GET['action']=='suprAffectLigne' && isset($_GET['v1']) && isset($_GET['v2'])) {  // revolution/suprAffectLigne/1/3 
			suprAffectLigne($_GET['v1'],$_GET['v2']);
		}
		elseif($_GET['action']=='suprAffectUnite' && isset($_GET['v1']) && isset($_GET['v2'])) {  // revolution/suprAffectUnite/1/3 
			suprAffectUnite($_GET['v1'],$_GET['v2']);
		}
		elseif($_GET['action']=='detailDocument' && isset($_GET['v1']) && isset($_GET['v2'])){
			if(isset($_POST['valideAjout'])) ajoutDocument($_GET['v1'],$_POST); 
			elseif(isset($_POST['valideModif'])) modifDocument($_GET['v2'],$_POST);
			else detailDocument($_GET['v2']);
		}
		elseif($_GET['action']=='supprimeDocument' && isset($_GET['v1'])) {
        	supprimeDocument($_GET['v1']);
        }
		elseif($_GET['action']=='telecharger' && isset($_GET['v1']) && isset($_GET['v2'])){
           	telechargeFichier($_GET['v1'],$_GET['v2']);
        }
		else {
			header('Location: '.$_SESSION['url']);
		}
	}
	else {
		menuAdmin();
	}