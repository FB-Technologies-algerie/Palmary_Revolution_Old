<?php
		// charger les controleurs
	require('controller/reporting.php');

		// créer les routes
	if( $_SESSION['type']=="admin"){  
	  if(isset($_GET['v1'])){
		if($_GET['v1']=='jour'){
			historiqueJour($_SESSION['type']);
		}
		elseif($_GET['v1']=='tablePassage' && isset($_GET['v2'])){
			tablePassage($_GET['v2']);
		}elseif($_GET['v1']=='listLignes' && isset($_GET['v2'])){
			listLignes($_GET['v2']);
		}elseif($_GET['v1']=='listProduitsLigne' && isset($_GET['v2'])){ 
			listProduitsLigne($_GET['v2']);
		}
		elseif($_GET['v1']=='listeProdUnite' && isset($_GET['v2'])){ 
			listeProdUnite($_GET['v2']);
		}elseif($_GET['v1']=='listeGroupeNorme' && isset($_GET['v2'])){ 
			listeGroupeNorme($_GET['v2']);
		}
      elseif($_GET['v1']=='listeNormeGroupeProduit' && isset($_GET['v2'])){ 
			listeNormeGroupeProduit($_GET['v2']);
		}elseif($_GET['v1']=='listeProduitComplet' ){ 
			listeProduitComplet();
		} 
		else header('Location: '.$_SESSION['url']);
	  }
	  else reporting($_SESSION['type']);
	}
	else header('Location: '.$_SESSION['url']);
	

