<?php
	require('model/bdConnect.php');

	function recupListTraduction(){
		$rep= requette("SELECT * FROM `emb_traduction` ;");

		return $rep;
	}

	function ajoutTraduction($donnee){
		$rep= requette("INSERT INTO `emb_traduction`(`id_traduction`, `frTraduction`, `arTraduction`, `enTraduction`, `ptTraduction`, `esTraduction`) VALUES (NULL,'".$donnee['french']."','".$donnee['arabic']."','".$donnee['english']."','".$donnee['portuguese']."','".$donnee['spanish']."');");
		
		return true;
	}

	function modifTraduction($donnee){
		$rep= requette("UPDATE `emb_traduction` SET `frTraduction`='".$donnee['french']."', `arTraduction`='".$donnee['arabic']."', `enTraduction`='".$donnee['english']."', `ptTraduction`='".$donnee['portuguese']."', `esTraduction`='".$donnee['spanish']."' WHERE `id_traduction`= ".$donnee['id_traduction']." ;");

		return true;
	}

	function supprimeTraduction($id_traduction){
		$rep= requette("DELETE FROM `emb_traduction` WHERE `id_traduction`= ".$id_traduction." ;");

		return true;
	}

	function recupListEmballageProd(){
		$rep= requette("SELECT * FROM `emb_produit` ;");

		return $rep;
	}

	function ajoutEmballageProd($donnee){
		$rep= requette("INSERT INTO `emb_produit` (`id_emballageProd`, `nomEmballage`, `codeArticle`, `codeBarre`, `listeIngrediants`) VALUES (NULL, '".$donnee['nomEmballage']."', '".$donnee['codeArticle']."', '".$donnee['codeBarre']."', '');");

		$id_emballageProd= requette("SELECT `id_emballageProd`, `nomEmballage`, `codeArticle`, `codeBarre`, `listeIngrediants` FROM `emb_produit` WHERE `nomEmballage`= '".$donnee['nomEmballage']."' ORDER BY `id_emballageProd` DESC LIMIT 1;")->fetch()['id_emballageProd'];
		
		return $id_emballageProd;
	}

	function modifEmballageProd($id_emballageProd,$donnee){
		$rep= requette("UPDATE `emb_produit` SET `nomEmballage`='".$donnee['nomEmballage']."', `codeArticle`='".$donnee['codeArticle']."', `codeBarre`='".$donnee['codeBarre']."' WHERE `id_emballageProd`= ".$id_emballageProd." ;");

		return true;
	}

	function supprimeEmballageProd($id_emballageProd){
		$rep= requette("DELETE FROM `emb_produit` WHERE `id_emballageProd`= ".$id_emballageProd." ;");

		return true;
	}

	function recupInfoEmballageProd($id_emballageProd){
		$rep= requette("SELECT * FROM `emb_produit` WHERE `id_emballageProd`= ".$id_emballageProd." ;");

		return $rep->fetch();
	}

	function saveListeIngrediants($id_emballageProd,$listeIngrediants){
		$rep= requette("UPDATE `emb_produit` SET `listeIngrediants`='".valid($listeIngrediants)."' WHERE `id_emballageProd`= ".$id_emballageProd." ;");

		return true;
	}

	function traduireIngrediant($ingrediant){
		$rep= requette("SELECT * FROM `emb_traduction` WHERE REPLACE(`frTraduction`,' ','') LIKE REPLACE('".valid($ingrediant)."',' ','') ;");

		return $rep->fetch();
	}


/***************************/
	function valid($chaine){
		$char= array("'", "\"", "`");
		$remp= array("\'", "\\\"", "\`");
		return htmlspecialchars(str_replace($char, $remp, $chaine));
	}

