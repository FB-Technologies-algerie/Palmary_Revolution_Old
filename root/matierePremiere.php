<?php
require('controller/matierePremiere.php');

	if(isset($_GET['action'])){ 
         if ($_GET['action']=='gestionArchivage' ) {
           gestionArrivageMP();      
        }
		elseif($_GET['action']=='listMatiere' && isset($_GET['v1']) ){
			 listMatiere($_GET['v1']);
            
		} elseif ($_GET['action']=='supprimerArrivageMatiere' && isset($_GET['v1'])) {
			suppArrivageMatiere($_GET['v1']);

		}elseif ($_GET['action']=='detailArrivage' && isset($_GET['v1'])) {
			definitionArrivage($_GET['v1']);

		}elseif ($_GET['action']=='analyseSupprimer' && isset($_GET['v1'])) {
			deleteAnalyse($_GET['v1']);

		}elseif ($_GET['action']=='analyseMatiere' && isset($_GET['v1'])) {
		  detailAnalyse($_GET['v1']);

		}elseif ($_GET['action']=='groupeParent' && isset($_GET['v1'])) {
	  //	sleep(1);
			groupesParents($_GET['v1']);
		}
		else{
            header('Location: '.$_SESSION['url']);
        }
		
	}
	else menuMatierePremier();