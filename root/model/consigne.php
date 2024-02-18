<?php
	require('model/bdConnect.php');

	function recupListMsgRecu($id_user){
		$rep= requette("SELECT `reception message`.`id_message`, `reception message`.`etatMsg`, `nomComplet`,`login`,`objetMsg`,`tempEnvoiMsg` FROM `message`,`user`,`reception message` WHERE `id_sender`=`id_user` AND `message`.`id_message`=`reception message`.`id_message` AND `id_recepteur` = ".valid($id_user)." ORDER BY `tempEnvoiMsg` DESC ;");

		return $rep;
	}

	function recupListMsgEnvoye($id_user){
		$rep= requette("SELECT * FROM `message` WHERE `id_sender` = ".valid($id_user)." ORDER BY `tempEnvoiMsg` DESC ;");

		return $rep;
	}

	function recupUsersRecept($id_message,$limite=''){
		if($limite!='') $limite= "LIMIT ".$limite." ";
		$rep= requette("SELECT id_user,`login` FROM `user` WHERE `id_user` IN (SELECT `id_recepteur` FROM `reception message` WHERE `id_message`= ".valid($id_message).") ".$limite.";");

		return $rep;
	}

	function recupInfoMsg($id_message){
		$rep= requette("SELECT `message`.`id_message`, `message`.`id_sender`, `nomComplet`, `login`, `objetMsg`, `jointMsg`, `corpMsg`, `id_reponseMsg`, `tempEnvoiMsg`, `reception message`.`etatConsigne` FROM `message`, `user`, `reception message` WHERE `message`.`id_sender` = `user`.`id_user` AND `reception message`.`id_message`= `message`.`id_message` AND `message`.`id_message`= ".valid($id_message).";");

		return $rep->fetch();
	}

	function autorisationMsg($id_user,$id_message){
		$rep= requette("SELECT `id_message` FROM `message` WHERE (`id_sender`=".valid($id_user)." OR `id_message` IN (SELECT `id_message` FROM `reception message` WHERE `id_recepteur`=".valid($id_user).") ) AND `id_message`= ".valid($id_message).";");

		if($rep->fetch()) return true; else return false;
	}

	function rendrLu($id_user,$id_message){
		$rep= requette("UPDATE `reception message` SET `etatMsg` = 'lu' WHERE `reception message`.`id_message` = ".valid($id_message)." AND `reception message`.`id_recepteur` = ".valid($id_user).";");
	}

	function recupIdLastMsg($id_sender,$objetMsg,$tempEnvoiMsg){
		$rep= requette("SELECT `id_message` FROM `message` WHERE `id_sender`=".valid($id_sender)." AND `objetMsg`='".valid($objetMsg)."' AND `tempEnvoiMsg`='".valid($tempEnvoiMsg)."' ;");
		
		return $rep->fetch()['id_message'];
	}

	function enregistrMsg($id_user,$donnee,$tempEnvoi,$jointName,$id_reponseMsg){
		$rep= requette("INSERT INTO `message` (`id_message`, `id_sender`, `objetMsg`, `jointMsg`, `corpMsg`, `id_reponseMsg`, `tempEnvoiMsg`) VALUES (NULL, '".valid($id_user)."', '".valid($donnee['objetMsg'])."', '".valid($jointName)."', '".valid($donnee['corpMsg'])."', ".valid($id_reponseMsg).", '".valid($tempEnvoi)."');");
	}

	function affectMsg($id_message,$id_recepteur,$etatConsigne="NULL"){
		$etatConsigne= ($etatConsigne!="NULL")? "'".$etatConsigne."'" : $etatConsigne; 

		$rep= requette("INSERT INTO `reception message` (`id_message`, `id_recepteur`, `etatMsg`, `etatConsigne`) VALUES ('".valid($id_message)."', '".valid($id_recepteur)."', 'nonLu', ".$etatConsigne.");");
	}

	function recupNbrMsgNonLu($id_user){
		$rep= requette("SELECT COUNT(`id_message`) AS 'nbrMsgNonLu' FROM `reception message` WHERE `etatMsg` = 'nonLu' AND `id_message` NOT IN (SELECT `id_reponseMsg` FROM `message` WHERE `id_reponseMsg`IS NOT NULL) AND `id_recepteur` = ".valid($id_user).";");

		return $rep->fetch()['nbrMsgNonLu'];
	}

	function recuprListUser($id_user,$cond='1'){
		if($cond!='1') $cond="`type`='".$cond."'";
		$rep= requette("SELECT `id_user`,`nomComplet`,`login` FROM `user` WHERE `id_user` != ".$id_user." AND `id_user` != -1 AND ".$cond.";");

		return $rep;
	}

	function recupConsigneNonLu($id_user){
		$rep= requette("SELECT `reception message`.`id_message`, `reception message`.`etatMsg`, `nomComplet`,`login`,`objetMsg`,`tempEnvoiMsg` FROM `message`,`user`,`reception message` WHERE `id_sender`=`id_user` AND `message`.`id_message`=`reception message`.`id_message`  AND `etatMsg`= 'nonLu' AND `message`.`id_message` NOT IN (SELECT `id_reponseMsg` FROM `message` WHERE `id_reponseMsg`IS NOT NULL) AND `id_recepteur` = ".valid($id_user)." ORDER BY `tempEnvoiMsg` DESC ;");

		return $rep;
	}

	function recupConsigneOfEtat($id_user,$etatConsigne){
		$rep= requette("SELECT `reception message`.`id_message`, `reception message`.`etatMsg`, `nomComplet`,`login`,`objetMsg`,`tempEnvoiMsg` FROM `message`,`user`,`reception message` WHERE `id_sender`=`id_user` AND `message`.`id_message`=`reception message`.`id_message` AND `etatConsigne`= '".valid($etatConsigne)."' AND (`id_recepteur` = ".valid($id_user)." OR `id_sender`= ".valid($id_user)." ) AND `reception message`.`id_message` NOT IN (SELECT `id_reponseMsg` FROM `message` WHERE `id_reponseMsg`IS NOT NULL) ORDER BY `tempEnvoiMsg` DESC ;");

		return $rep;
	}

/***************************/
	function valid($chaine){
		$char= array("'", "\"", "`");
		$remp= array("\'", "\\\"", "\`");
		return htmlspecialchars(str_replace($char, $remp, $chaine));
	}

