<?php 
date_default_timezone_set('Africa/Algiers');
 try {
	session_start();
	
		// envoyer vers la bonne route selon la session
	if(isset($_GET['action']) && $_GET['action']=='deconnexion'){
		session_destroy();
		header('Location: '.str_replace("index.php", "", $_SERVER['PHP_SELF']));die;
	}
	elseif(isset($_GET['action']) && $_GET['action']=='modifierLoginMot' && isset($_POST['valider'])) { 
          require('model/bdConnect.php');
		  if (isset($_POST['mdpUser'])) {
		   modifierUserMotp($_SESSION['id_user'],$_POST['nomUser'],$_POST['mdpUser']);
		  }else{
          modifierUserMotp($_SESSION['id_user'],$_POST['nomUser']);
		  }
          $_SESSION['login'] = $_POST['nomUser'];
          header('Location: '.$_SERVER['HTTP_REFERER']);
		
			
		}
	elseif(isset($_SESSION['type'])){
		if (isset($_GET['action']) && $_GET['action']=='consigne') require('root/consigne.php');
		elseif (isset($_GET['action']) && $_GET['action']=='historique') require('root/historique.php');
		elseif (isset($_GET['action']) && $_GET['action']=='reporting') require('root/reporting.php');
		elseif (isset($_GET['action']) && $_GET['action']=='gestionMatiere') require('root/gestionMatiere.php');
		elseif (isset($_GET['action']) && $_GET['action']=='magasin') require('root/magasin.php');
        
		elseif($_SESSION['type']=='control'){
			require('root/process.php');
		}
		elseif($_SESSION['type']=='admin'){
			require('root/admin.php');
		}
		elseif($_SESSION['type']=='designer'){
			require('root/consigne.php');
		}
		elseif($_SESSION['type']=='concept'){
			require('root/conception.php');
		}
		elseif($_SESSION['type']=='controlQualite'){
			require('root/conception.php');
		}
		elseif($_SESSION['type']=='emballage'){
			require('root/emballage.php');
		}
		elseif($_SESSION['type']=='magasinier'){
			require('root/magasin.php');
		}elseif($_SESSION['type']=='laboratoire'){
			require('root/laboratoire.php');
		}elseif ($_SESSION['type']=='matierePremiere') {
			require('root/matierePremiere.php');
		}
		else{
			echo 'pas encore!... <a href="'.$_SESSION['url'].'deconnexion">déconnexion</a>';
		}
	}else{
		$_SESSION['url']= str_replace("index.php", "", $_SERVER['PHP_SELF']);
		require('controller/login.php');
	}
 }catch(Exception $e) { // S'il y a eu une erreur, alors...
  	echo 'Erreur : ' . $e->getMessage();
 }
// throw new Exception("c'est pour créer une exception");

?>