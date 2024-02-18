<?php 
		// charger les controleurs
	require('controller/conception.php');

		// créer les routes
	if(isset($_GET['action'])){						
		if($_GET['action']=='controleQualite'){
			if(isset($_GET['v1']) && $_GET['v1']=="traitementImage") traitementImage();
			else controleQualite();
		}
		elseif($_GET['action']=='gestionTraduction'){
			if(isset($_POST['valider'])){
				if($_POST['id_traduction']=='') ajoutTraduction($_POST);
					else modifTraduction($_POST);
				header('Location: '.$_SESSION['url'].'gestionTraduction');
			}
			if(isset($_GET['v1']) && $_GET['v1']=="supprimer" && isset($_GET['v2'])){
				supprimeTraduction($_GET['v2']);
			}
			gestionTraduction();
		}
		elseif($_GET['action']=='gestionEmballage'){
			if(isset($_POST['valider'])){
				$id_prod= ajoutEmballageProd($_POST);
				header('Location: '.$_SESSION['url'].'formEmballage/'.$id_prod);
			}
			if(isset($_GET['v1']) && $_GET['v1']=="supprimer" && isset($_GET['v2'])){
				supprimeEmballageProd($_GET['v2']);
			}
			gestionEmballageProd();
		}
		elseif($_GET['action']=='formEmballage' && isset($_GET['v1'])){
			if($_GET['v1']=='traduire' && isset($_POST['listeIngrediants']) && isset($_POST['id_emballageProd'])){
				traduireListe($_POST['id_emballageProd'],$_POST['listeIngrediants']);
			}
			else{
				if(isset($_POST['valider'])) modifEmballageProd($_GET['v1'],$_POST);
			
				formEmballageProd($_GET['v1']);
			}
		} 
		else header('Location: '.$_SESSION['url']);		
	}
	else conception();