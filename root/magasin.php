<?php
require('controller/magasin.php');
    if ($_SESSION['type']=="magasinier"  || $_SESSION['type']=="emballage" ) {
    if(isset($_GET['v1'])){
		if($_GET['v1']=='gestionArrivage'){ 
		
			if(isset($_GET['v1']) && $_GET['v2']=='ajouter' && isset($_POST['valider'])){
				ajouArrivage();
			}
            header('Location:' . $_SESSION['url'].'magasin');
		}
		elseif($_GET['v1']=='detailArrivage' && isset($_GET['v2'])){
			detailArrivage($_GET['v2']);
		}
		elseif($_GET['v1']=='verifIMG' && isset($_GET['v2'])){
			verifIMG($_GET['v2']);
		}
		elseif($_GET['v1']=='afficheIMG' && isset($_GET['v2']) && isset($_GET['v3'])){
			afficheIMG($_GET['v2'],$_GET['v3']);
		}
		elseif($_GET['v1']=='afficheMaquette' && isset($_GET['v2']) && isset($_GET['v3'])){
			afficheMaquette($_GET['v2'],$_GET['v3']);
		}
		elseif($_GET['v1']=='verifCouleurArrivage' && isset($_GET['v2'])){
			verifCouleurArrivage($_GET['v2']);
		}
		elseif($_GET['v1']=='verifTextArrivage' && isset($_GET['v2'])){
			verifTextArrivage($_GET['v2']);
		}
		elseif ($_GET['v1']=='detailProd' && isset($_POST['codeBarre'])) {
		    verifCodeBarre($_POST['codeBarre']);
        }
        else{
            header('Location: '.$_SESSION['url']);
        }
	}
	else gestionArrivage();
    }else  header('Location: '.$_SESSION['url']);

	