<?php
	
	if(isset($_POST['user']) && isset($_POST['password'])){ 
		require('model/login.php');
		$rep= login($_POST['user'], $_POST['password']);

		if($rep!=null){
			$_SESSION["id_user"] = $rep['id_user'];
			$_SESSION["nom"] = $rep['nomComplet'];
			$_SESSION["type"] = $rep['type'];
			$_SESSION["login"] = $rep['login'];

			
			header('Location: '.$_SESSION['url']);

		}else{
			$erreur=true;
			require('view/login.php');
		}
	}
	else{
		require('view/login.php');
	}


