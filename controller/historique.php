<?php
	
	require('model/historique.php');

	function historique($typeUser){
		if($typeUser=='admin'){
			$listUnite = recupListUnite($_SESSION['droitAdmin']);
			$listGroupe = recupListGroupe();
			$listControl = recupListControleur();

			if(isset($_POST['valider'])){ 
			
				$_SESSION['cond']= defineCondition($_POST);
				$listeProd= recupProdSearch($_SESSION['cond']);
			}
		}
		else{
			$listLigne = recupListLignesP($_SESSION['id_user']);
			$listGroupe = recupListGroupe();

			if(isset($_POST['valider'])){ 
				$_SESSION['cond']= defineCondition($_POST,$_SESSION['id_user']);
				$listeProd= recupProdSearch($_SESSION['cond']); 
			}

		}
	    //	var_dump($listeProd);die;
		require('view/historique/historique.php');
	}

	function tablePassage($id_prod){
		$listePassage= recupPassagesSearch($_SESSION['cond']." AND `passage`.`id_prod`=".valid($id_prod));
		$typeUser= $_SESSION['type'];
		$nomProduit = nomProduit($id_prod);

		require('view/historique/tablePassage.php');
	}

	function csvPassage($id_prod){
		$listePassage= recupPassagesSearch($_SESSION['cond']." AND `passage`.`id_prod`=".valid($id_prod));
		$typeUser= $_SESSION['type'];
		$nomProduit = nomProduit($id_prod);

		require('view/historique/tablePassage.php');
	}

	function historiqueJour(){
		$listePassage= recupPassagesJour($_SESSION['id_user']);
    
		require('view/historique/historiqueJour.php');
	}

	function listLignes($id_unite){
		$listLignes= recupListLignesOfUnite($id_unite);

		echo json_encode($listLignes->fetchAll());
	}

	function listProduits($id_ligne){
		$listProds= recupListProdsOfLigne($id_ligne);

		echo json_encode($listProds->fetchAll());
	}

/* ------------------ function ----------------------- */
	function verifNorme($norme){
		//$formNorm= formuleNorme($id_norme);
		if($norme['typeNorme']=='intervalle') return $norme['formuleNorme'];
		elseif ($norme['typeNorme']=='valeur') return $norme['formuleNorme']."-".$norme['formuleNorme'];
		elseif ($norme['typeNorme']=='formule') return explode('#=#', $norme['formuleNorme'])[1];
		return 'null';
	}

	function verifValNorme($valNorm,$minMax){
		if($minMax!="null"){
			$minMax= explode('-', $minMax);
			if($valNorm<$minMax[0] || $valNorm>$minMax[1]) return "background-color: #ffc107;";
			 else return ""; //"background-color: #58fb7e;";	
		}
	}

	function array2csv(array &$array){
   		if (count($array) == 0) {
     		return null;
   		}
   		ob_start();
   		$df = fopen("php://output", 'w');
   		fputcsv($df, array_keys(reset($array)), ';');
   		foreach ($array as $row) {
    		fputcsv($df, $row, ';');
   		}
   		fclose($df);
   		return ob_get_clean();
	}

	function download_send_headers($filename) {
      // disable caching
    	$now = gmdate("D, d M Y H:i:s");
    	header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    	header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    	header("Last-Modified: {$now} GMT");

      // force download  
    	header("Content-Type: application/force-download");
    	header("Content-Type: application/octet-stream");
    	header("Content-Type: application/download");

      // disposition / encoding on response body
    	header("Content-Disposition: attachment;filename={$filename}");
    	header("Content-Transfer-Encoding: binary");
	}
