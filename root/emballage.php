<?php 
		// charger les controleurs
	require('controller/emballage.php');

		// créer les routes
	if(isset($_GET['action'])){						
		if($_GET['action']=='controleQualite'){
			if(isset($_GET['v1']) && $_GET['v1']=="traitementImage") traitementImage();
			else controleQualite();
		}
		elseif($_GET['action']=='gestionTraduction'){
			if(isset($_POST['valider'])){
				if($_POST['id_terme']=='') ajoutTraduction($_POST);
					else updateTraduction($_POST); 
				header('Location: '.$_SESSION['url'].'gestionTraduction');
			}

			elseif(isset($_GET['v1']) && $_GET['v1']=="supprimer" && isset($_GET['v2'])){
				supprimeTraduction($_GET['v2']);
			}
			gestionTraduction();
		}
		elseif($_GET['action']=='gestionEmballage'){
			if(isset($_POST['valider'])){
				ajoutEmbProd($_POST);
			}elseif(isset($_POST['validerGroupe'])){
               ajouterGroupaProduit($_POST);
               header('Location: '.$_SESSION['url'].'gestionEmballage');
			}
			if(isset($_GET['v1']) ){
				if ($_GET['v1']=="supprimer") { 
					if (isset($_GET['v2'])) {
						supprimeEmbProd($_GET['v2']);
					}
					
				}elseif($_GET['v1']=="supprimerGroupe"){
					if (isset($_GET['v2'])) {
						supprimeGroupeProd($_GET['v2']);
					}	
				}else{
			     modifierGroupe($_GET['v1']);
		     	}	
		     	 header('Location: '.$_SESSION['url'].'gestionEmballage');
			}
			gestionEmballageProd();
		}elseif($_GET['action']=='formEmballage' && isset($_GET['v1'])){
			if($_GET['v1']=='traduire' && isset($_POST['listeIngrediants']) && isset($_POST['id_emballageProd'])){
				traduireListe($_POST['id_emballageProd'],$_POST['listeIngrediants']);
			}
			elseif(isset($_GET['v2'])) formEmballageProd($_GET['v1'],$_GET['v2']);
			else formEmballageProd($_GET['v1']);
			
		}
		elseif($_GET['action']=='detailVersion'){
			if(isset($_GET['v1'])){
				if($_GET['v1']=='traduire' && isset($_POST['id_version'])){
					traduction($_POST['id_version'],$_POST['listeIngrediantFR']);	//traduction
				} 
				elseif ($_GET['v1']=='saveNutrition' && isset($_GET['v2'])) { //sauvegarde des nutrition
                	$idProdVers = explode("-", $_GET['v2']);
                	saveNutrition($idProdVers[0],$idProdVers[1]);
            	}
				else detailVersion($_GET['v1']);			//detail d'une version existante 	
				
			}else detailVersion();							//une nouvelle version
		}elseif($_GET['action']=='detailMaquette'&& isset($_GET['v1'])){		// revolution/detailMaquette/id_version
			if(isset($_GET['v2'])) detailMaquette($_GET['v1'],$_GET['v2']);	// revolut.../id_version/id_maquette
			 else detailMaquette($_GET['v1']);
		}
		elseif($_GET['action']=='afficheMaquette'&& isset($_GET['v1'])&& isset($_GET['v2'])){
			afficheMaquette($_GET['v1'],$_GET['v2']);	// revolution/afficheMaquette/idVersion-idMaquette/extension
		}
		elseif($_GET['action']=='supprimeMaquette'&& isset($_GET['v1'])&& isset($_GET['v2'])){
			supprimeMaquette($_GET['v1'],$_GET['v2']);	// revolution/supprimeMaquette/idVersion-idMaquette/extension
		}
		elseif($_GET['action']=='compareMaquetteText'&& isset($_GET['v1'])&& isset($_GET['v2'])){
			compareMaquetteText($_GET['v1'],$_GET['v2']);  // ...teText/idVersion-idMaquette/extension
		}
		elseif($_GET['action']=='compareMaquetteCouleur' && isset($_GET['v1'])&& isset($_GET['v2'])){
			compareMaquetteCouleur($_GET['v1'],$_GET['v2']);  // ...tteCouleur/idVersion-idMaquette/extension
		}elseif ($_GET['action']=='gestionFournisseuer') {
		    if (isset($_POST['valider'])) {
		       ajouterFournisseur();
		    }
	       gestionFournisseur();
		}elseif ($_GET['action']=='supprimerFournisseur' && isset($_GET['v1']) ) {
		     supprimerFournissuer($_GET['v1']);
		     header('Location: '.$_SESSION['url'].'gestionFournisseuer');
		}elseif ($_GET['action']=='modifFournissuer' && isset($_GET['v1']) ) {
		     modifFournissuer($_GET['v1']);
		     header('Location: '.$_SESSION['url'].'gestionFournisseuer');
		}
		else header('Location: '.$_SESSION['url']);		
	}
	else emballage();