<?php
	
	function connect(){
// paramètre de connexion de la base de données
/*$host_name = "localhost";
$database = "revolution2";
$user_name = "revolutionAdmin";
$password = "palmaryAdmin";*/

$host_name = "127.0.0.1:3307";
$database = "revolution2";
$user_name = "root";
$password = "";

		try{ // On se connecte à MySQL
			return $bdd = new PDO('mysql:host='.$host_name.';dbname='.$database.';charset=utf8', $user_name, $password);
		}catch(Exception $e){// En cas d'erreur, on affiche un message et on arrête tout
    	    die('Erreur : '.$e->getMessage());
		}
	}

	function requette($req){ // elle execute la requette en entré et elle retourne l'objet result non fetché
		$bdd = connect();

		$result = $bdd->query($req);

		return $result;
	}

	function testText($text){
		$filename = "public/test.txt"; 
		$fp = fopen($filename, "r") or die("Couldn't create new file");
		$fl = fread ($fp, filesize($filename)).' | 
		'.$text;
		
		$fp = fopen($filename, 'w+');
		fwrite($fp, $fl);
		fclose($fp);
		$fp=$fl=null;
	}
   function modifierUserMotp($iduser,$login,$mdp=''){ 
        // require('model/conception.php');
		if( $mdp != ''){
			$rep = requette("UPDATE `user` SET  `login` = '".valide($login)." ', `mdp` = '".valide(sha1($mdp))."'  WHERE  `id_user` = '".valide($iduser)."'");    
		}else{
			$rep = requette("UPDATE `user` SET  `login` = '".valide($login)." ' WHERE `id_user` = '".valide($iduser)."'");
		
		}
		
	}
function valide($chaine){
		$char= array("'", "\"", "`");
		$remp= array("\'", "\\\"", "\`");
		return htmlspecialchars(str_replace($char, $remp, $chaine));
	}
	
