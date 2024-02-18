<?php 
		// charger les controleurs
	require('controller/consigne.php');

		// créer les routes	
	if(isset($_GET['v1'])){							
		if($_GET['v1']=='envoiMsg'){		// revolution/consigne/envoiMsg ou revolution/consigne/envoiMsg/4
			if(isset($_GET['v2'])){
				if(isset($_POST['valider'])){ 
					envoiMessage($_SESSION['id_user'],$_POST,$_FILES['jointMsg'],$_GET['v2']);
				}else
					formMsg($_SESSION['id_user'],$_SESSION['type'],$_GET['v2']);
			}else{
				if(isset($_POST['valider'])){
					envoiMessage($_SESSION['id_user'],$_POST,$_FILES['jointMsg']);
				}else
					formMsg($_SESSION['id_user'],$_SESSION['type']);
			}
		}
		elseif($_GET['v1']=='telechargement'){ 			// revolution/consigne/telechargement/5
			if(isset($_GET['v2']) && isset($_SESSION['file'][$_GET['v2']])){
				telechargementFichier($_SESSION['file'][$_GET['v2']]);
			}else header('Location: '.$_SESSION['url'].'consigne');

		}elseif($_GET['v1']=='notificationMsg'){			// revolution/consigne/notificationMsg
			notificationMsg($_SESSION['id_user']);
		}else
			lireMessage($_SESSION['id_user'],$_GET['v1']);		// revolution/consigne/id_message
	}
	else{											// revolution/consigne
		consigne($_SESSION['id_user']);
	}
