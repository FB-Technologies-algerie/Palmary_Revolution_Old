<?php
		// charger les controleurs
	require('controller/historique.php');

		// créer les routes
	if($_SESSION['type']=="control" || $_SESSION['type']=="admin"){  
	  if(isset($_GET['v1'])){
		if($_GET['v1']=='listLignes' && isset($_GET['v2'])){       // /revolution/historique/listLignes/1
			listLignes($_GET['v2']);
		}
		elseif($_GET['v1']=='listProduits' && isset($_GET['v2'])){
			listProduits($_GET['v2']);
		}
		elseif($_GET['v1']=='jour'){
			historiqueJour($_SESSION['type']);
		}
		elseif($_GET['v1']=='tablePassage' && isset($_GET['v2'])){
			tablePassage($_GET['v2']);
		}
		elseif($_GET['v1']=='csvPassage' && isset($_GET['v2'])){
			csvPassage($_GET['v2']);
		}
		else header('Location: '.$_SESSION['url']);
	  }
	  else historique($_SESSION['type']);
	}
	else header('Location: '.$_SESSION['url']);
	

