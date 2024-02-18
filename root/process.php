<?php
		// charger les controleurs
	require('controller/process.php');

		// créer les routes
  if(!isset($_SESSION['groupe'])) setGroupe();
  else{
	if(isset($_GET['action'])){
		if($_GET['action']=='listeLigne'){
			listeLigne();
		}
		elseif ($_GET['action']=='ficheControle' && isset($_GET['v1'])) { 
			if($_GET['v1']=="ajoutPassage"){
				if(isset($_GET['v2'])){
					ajoutPassage($_GET['v2'], $_SESSION['id_user'], $_SESSION['groupe']);
					header('Location: '.$_SESSION['url'].'ficheControle/'.$_GET['v2']);
				}
				else header('Location: '.$_SESSION['url']);
			}
			elseif($_GET['v1']=="saveNorme"){
				if(isset($_POST['id_passage'])){
					saveNorme($_POST);
				}
			}
			elseif($_GET['v1']=="terminePassage"){
				if(isset($_GET['v2']) && isset($_POST['comment'])){
					terminePassage($_GET['v2'],$_POST['comment']);
				}
			}
			else ficheControle($_GET['v1']);
		}
		elseif($_GET['action']=='telecharger' && isset($_GET['v1']) && isset($_GET['v2'])){
           	telechargeFichier($_GET['v1'],$_GET['v2']);
        }
		else header('Location: '.$_SESSION['url']);
	}else {
		listeLigne();
	}
  }

