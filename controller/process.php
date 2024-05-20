<?php
	
	require('model/process.php');
    include_once('config.php');


	function setGroupe(){
		if(isset($_POST['groupe']) && trim($_POST['groupe'], " \t.")!=''){
			$_SESSION["groupe"] = trim($_POST['groupe'], " \t.");
			header('Location: '.$_SESSION['url']);
		}
		else require('view/process/setGroupe.php');
	}

	function listeLigne(){
		$liste=recupToutProduit($_SESSION['id_user']);
		$listeProd=recupToutProduit($_SESSION['id_user']);
		require('view/process/listeLigne.php');
	}

	function ficheControle($idProd){
		global $id_prod; $id_prod=$idProd;

		$ligne= recupLigne($id_prod);
		if(!$ligne) header('Location: '.$_SESSION['url']);
		
		$listeProd = recupProduitsLigne($ligne['id_ligneP']);
		$nomProd= nomProduit($id_prod);
		$listeNormeP1 = $listeNormeP2 = null;
		global $passage;global $oldPassage;
		global $script; $script='';

		if(autorisation($ligne['id_ligneP'], $_SESSION['id_user'])){
			if($passage= ouvrirDernierPassage($id_prod, $_SESSION['id_user'])){
				$oldPassage = recupOldPassage($id_prod, $_SESSION['id_user']);
				$listeNormeP1 = recupNormeProduit($id_prod,null,1);
				$listeNormeP2 = recupNormeProduit($id_prod,null,2);
			}
			$listeDocument =  recuplisteDocument($id_prod);/*nabil*/
			require('view/process/ficheControle.php');
		}else{
			header('Location: '.$_SESSION['url']);
		}

	}


/* ------------------ function ----------------------- */
	function verifNorme($norme){
		//$formNorm= formuleNorme($id_norme);
		if($norme['typeNorme']=='intervalle') return $norme['formuleNorme'];
		elseif ($norme['typeNorme']=='valeur') return $norme['formuleNorme']."-".$norme['formuleNorme'];
		return 'null';
	}

	function verifValNorme($valNorm,$minMax){
		if($minMax!="null"){
			$minMax= explode('-', $minMax);
			if($valNorm<$minMax[0] || $valNorm>$minMax[1]) return "background-color: #ffc107;";
			 else return ""; //"background-color: #58fb7e;";	
		}
	}

	function saveNorme($entree){
		saveNormeBD($entree['id_passage'],$entree['id_norme'],$entree['valueNorme']);
	}

	function inserScriptChange($id_form,$formul){
		$tab= explode('@',$formul);
		$script='';
		for($i=0;$i<sizeof($tab);$i++){
    		if(strpos($tab[$i],"]")!='') $script = $script."
    			var obj= document.querySelector('#n".explode(']',$tab[$i])[0]."');
				var old = obj.getAttribute('onchange');
				obj.setAttribute('onchange', old + '; calcul(".$id_form.",`".$formul."`)');
			";
		}
		return $script;
	}

	function terminePassage($id_passage,$comment){
		terminePassageBD($id_passage, $comment);
		header('Location: ' . $_SESSION['url']);
		try {
			upload_passage($id_passage);
		} catch (Exception $e) {
			error_log("Erreur lors de l'upload du passage : " . $e->getMessage(). PHP_EOL, 3, ROOT_PATH . '/error.log');
			header('Location: ' . $_SESSION['url']);
		}
	}

	function reecrireLienA($lien){
		$nouv['type']=$nouv['lien']="";
		if($lien!==''){
			$lien= explode('!:!', $lien);
			if(sizeof($lien)==2){
				if($lien[0]=='FILE'){
					$nouv['type']=$lien[0];
					$nouv['lien']=$lien[1];
				}
				elseif($lien[0]=='LINK'){
					$nouv['type']=$lien[0];
					$nouv['lien']=$lien[1];
				}
			}
		}
		
		return $nouv;
	}

	function telechargeFichier($type,$id){
		$file= recupInfoFile($type,$id);
		
	    if(!file_exists($file['path']) || is_null($file)){
	    	$file['path']= "public/img/no-img.png";
	    	$file['typeFile']='image'; $file['ext']='png';
	    }
	    
		if($file['typeFile']=='image'){
			//header('Content-Type: image/png');
			header('Content-Type: image/'.(($file['ext']=='jpg')?'jpeg':$file['ext']).' ');
		}
		elseif($file['typeFile']=='pdf'){
			header('Content-Type: application/pdf');
		}
		elseif($file['typeFile']=='word'){
			header('Content-Type: application/octet-stream');
			//header("Content-Type: application/vnd.ms-word; charset=utf-8");
			header('Content-Disposition: attachment; filename="'.$file['nom'].'"');
		}
		elseif($file['typeFile']=='excel'){
			header("Content-Type: application/vnd.ms-excel; charset=utf-8");
			header('Content-Disposition: attachment; filename="'.$file['nom'].'"');
		}
		elseif($file['typeFile']=='powerPoint'){
			header("Content-Type: application/vnd.ms-powerpoint; charset=utf-8");
			header('Content-Disposition: attachment; filename="'.$file['nom'].'"');
		}
		elseif($file['typeFile']=='video'){
			header('Content-type: video/'.$file['ext']);
			header('Content-disposition: inline');
			header("Content-Transfer-Encoding:­ binary");
		}
		elseif($file['typeFile']=='audio'){
			header("Content-Type: audio/".$file['ext']);
			echo 	'<audio controls="controls" autoplay>
    					<source src="'.$file['path'].'"  />
					</audio>';
		}
		else {
			header('Content-Transfer-Encoding: binary');
			header('Content-Disposition: attachment; filename="'.$file['nom'].'"');
		}
	    readfile($file['path']);
	}

	function recupInfoFile($type,$id){
		if($type=='Document')
			$file['nom']= explode('!:!',recupNomFileDocumentProd($id))[1];
		elseif($type=='Norme' || $type=='Groupe'){
			$file['nom']= explode('!:!',recupNomFileDocumentNorme($id))[1];
			$id='';
		}
		else return null;

		if(is_null($file['nom']) || $file['nom']=='') return null;
		else{
			$file['ext']= substr(strrchr($file['nom'],'.') ,1);
			$file['securite']= verifExtension($file['ext']);
			$file['typeFile']=defineTypeDocument($file['ext']);

			$file['path'] ="archive/process".$type.'-'.$id.'_'.$file['nom'].$file['securite'];
			return $file;
		}
	}

	function verifExtension($extension){
		$extensionsNonValides = array( 'sql' , 'php' , 'js' , 'html' , 'css' , 'exe' );
		$extension= strtolower($extension);

		if(in_array($extension,$extensionsNonValides)) return ".file";
		else return '';
	}

	function defineTypeDocument($extension){
		switch ($extension) {
			case 'doc': case 'docx': return 'word';
			case 'xlsx':case 'xlsm':case 'xlsb':case 'xltm': return 'excel';
			case 'pptx':case 'pptm':case 'ppt': return 'powerPoint';
			case 'pdf': return 'pdf';
			case 'bmp':case 'tif':case 'tiff':case 'gif':case 'jpeg':case 'jpg':case 'png': return 'image';
			case 'mp3':case 'wav':case 'ogg': return 'audio';
			case 'avi':case 'wmv':case 'mp4':case 'wmf': return 'video';
			
			default: return 'autre';
		}
	}


	function streamRemoteFile($remote_server,$port,$ssh_user,$ssh_password,$remote_file_path,$mode)
	{
		try {
			// Tentative de connexion au serveur distant
			if (!($connection = ftp_connect($remote_server))) {
				throw new Exception("Impossible de se connecter au serveur distant");
				
			}
		
			// Tentative d'authentification sur le serveur distant
			if (!ftp_login($connection, $ssh_user, $ssh_password)) {
				throw new Exception("Impossible de s'authentifier sur le serveur");
				
			}
		
		
			// Retourner le gestionnaire de fichier
			return fopen("ftp://$ssh_user:$ssh_password@$remote_server$remote_file_path", $mode);
		} catch (Exception $e) {
			// Attraper et afficher les exceptions
			var_dump($e->getMessage());
			return false;
		}
		
	}
	/*
	function streamRemoteFile($remote_server,$port,$ssh_user,$ssh_password,$remote_file_path,$mode)
	{
		if (!($connection = ssh2_connect($remote_server, $port)))
		{
			var_dump("Impossible de se connecter au serveur distant");
			//sendMail("<h1>Impossible de se connecter au serveur distant</h1>");
			return false;
		}
	
		if (!ssh2_auth_password($connection, $ssh_user, $ssh_password))
		{
			var_dump("Impossible de s'authentifier sur le serveur");
			//sendMail("<h1>Impossible de s'authentifier sur le serveur</h1>");
			return false;
		}
	
		if(!($sftp = ssh2_sftp($connection)))
		{
			var_dump("sftp connection failed");
			return false;
		}
		return fopen("ssh2.sftp://$sftp$remote_file_path", $mode);
	}*/
	
	
	function upload_passage($id_passage){
		try{
		$remote_server = REMOTE_SERVER;
		$port = PORT;
		$ssh_user = SSH_USER;
		$ssh_password = SSH_PASSWORD;
		$path = PATH_FILE;
	
	// Parcourir chaque passage et générer un fichier CSV
		 // Utiliser l'ID de passage pour récupérer les valeurs du passage
		 $passage_values = get_passage_values($id_passage);
		// Chemin du fichier CSV sur le serveur distant
		$remote_csv_file = $path."/passage-" . $id_passage . '-' .date('Y-m-d_H-i-s'). '.csv';
		// Créer le contenu CSV dans une variable temporaire
		$csv_content = "Tag Name;Value;State\n";
		$tagsToCheck = [
			'Poids_Total_g',
			'Poids_Chocolat_g',
			'Poids_Fourrage1_g',
			'Poids_Fourrage2_g',
			'Poids_Inclusions1_g',
			'Poids_Inclusions2_g',
			'Poids_Biscuit_Seul_g'
		];
		
        // Initialiser un tableau pour stocker les valeurs trouvées
        $tagValues = array_fill_keys($tagsToCheck, '0');
        $tagNames = array_fill_keys($tagsToCheck, '');

        // Remplir le tableau avec les valeurs trouvées dans $passage_values
        foreach ($passage_values as $row) {
            $tagName = trim($row['TagName']); // Supprimer les espaces en début et fin
            $uniteMesure = $row['uniteMesure'];
            $valeurSaisie = $row['valeurSaisie'];
			$abreviation = $row['Abreviation'];

            // Debug: Afficher les valeurs actuelles
            error_log("TagName: $tagName, UniteMesure: $uniteMesure, ValeurSaisie: $valeurSaisie" . PHP_EOL, 3, ROOT_PATH . '/error.log');

            foreach ($tagsToCheck as $tag) {
                if (strpos($abreviation, $tag) !== false) {
                   // $tag = $tagName; // Affecter $tag à $tagName pour utiliser le nom de tag original
                    // Convertir en grammes en fonction de l'unité de mesure
                    switch ($uniteMesure) {
                        case 'kg':
                            $valeurSaisie *= 1000;
                            break;
                        case 'dg':
                            $valeurSaisie *= 0.1;
                            break;
                        case 'cg':
                            $valeurSaisie *= 0.01;
                            break;
                        case 'mg':
                            $valeurSaisie *= 0.001;
                            break;
                        case '%':
                                $valeurSaisie *= 100;
                            
                            break;
                    }

                    // Remplacer le point par une virgule dans la valeur saisie
                    $valeurSaisie = str_replace('.', ',', $valeurSaisie);
                    // Stocker la valeur dans le tableau
                    $tagValues[$tag] = $valeurSaisie;

                }
				$tagNames[$tag] = $tagName.$tag; // Stocker le nom complet du tag
				error_log("TagName:$tagNames[$tag], UniteMesure: $uniteMesure, ValeurSaisie: $valeurSaisie" . PHP_EOL, 3, ROOT_PATH . '/error.log');

            }
        }

        // Calculer Poids_Chocolat_g si nécessaire
        if ($tagValues['Poids_Chocolat_g'] == '0') {
            $poidsTotal = str_replace(',', '.', $tagValues['Poids_Total_g']);
            $poidsFourrage1 = str_replace(',', '.', $tagValues['Poids_Fourrage1_g']);
            $poidsFourrage2 = str_replace(',', '.', $tagValues['Poids_Fourrage2_g']);
            $poidsInclusions1 = str_replace(',', '.', $tagValues['Poids_Inclusions1_g']);
            $poidsInclusions2 = str_replace(',', '.', $tagValues['Poids_Inclusions2_g']);
            $poidsBiscuit = str_replace(',', '.', $tagValues['Poids_Biscuit_Seul_g']);

            $poidsChocolat = $poidsTotal - $poidsFourrage1 - $poidsFourrage2 - $poidsInclusions1 - $poidsInclusions2 - $poidsBiscuit;
            $tagValues['Poids_Chocolat_g'] = str_replace('.', ',', $poidsChocolat);
        }

        // Générer le contenu du CSV en utilisant les noms complets des tags
        foreach ($tagsToCheck as $tag) {
			error_log($tagNames[$tag]. PHP_EOL, 3, ROOT_PATH . '/error.log');
            $tagName =$tagNames[$tag]; 
            $csv_content .= $tagName . ';' . $tagValues[$tag] . ";OK \n";
        }
		try{
	     $file_handler  = streamRemoteFile($remote_server,$port,$ssh_user,$ssh_password,$remote_csv_file,"w");
	
	   // Vérification de la ressource de fichier
	   if (!is_resource($file_handler)) {
		$donnee['objetMsg'] = "envoi fichier csv";
        $donnee['corpMsg'] = "Impossible d'établir une connexion SFTP ou d'ouvrir le fichier distant ".$remote_csv_file."\n";
		$donnee['etatConsigne'] = "enAttente";
		envoiMessage($_SESSION['id_user'],$donnee,'NULL');
		error_log($donnee['corpMsg']. PHP_EOL, 3, ROOT_PATH . '/error.log');
		throw new Exception("Impossible d'établir une connexion SFTP ou d'ouvrir le fichier distant ".$remote_csv_file."\n");
        //return true;
	   } else {
		   // Écrire le contenu du fichier CSV sur le serveur distant
		   if (fwrite($file_handler, $csv_content) === false) {
			$donnee['corpMsg'] = "Impossible d'écrire le contenu dans le fichier distant sur".$remote_csv_file."\n";
			envoiMessage($_SESSION['id_user'],$donnee,'NULL');
			error_log($donnee['corpMsg'] . PHP_EOL, 3, ROOT_PATH . '/error.log');
			throw new Exception("Impossible d'écrire le contenu dans le fichier distant sur".$remote_csv_file."\n");
			//return true;
		   } else {
			$donnee['corpMsg'] = "Fichier CSV enregistré avec succès sur le serveur SFTP sur ".$remote_csv_file."\n";
			//envoiMessage($_SESSION['id_user'],$donnee,'NULL');
			error_log($donnee['corpMsg']. PHP_EOL, 3, ROOT_PATH . '/error.log');
		   }
		   // Fermer le gestionnaire de fichier
		   fclose($file_handler);
		   return true;
	   }
	} catch (Exception $e) {
		// Attraper et afficher les exceptions
		$message = $e->getMessage();
		error_log($message, 3, ROOT_PATH . '/error.log');
		return false;
	}
	}catch (Exception $e) {
		// Attraper et afficher les exceptions
		$message = $e->getMessage();
		error_log($message, 3, ROOT_PATH . '/error.log');
		// Retourner false pour indiquer un échec
		return false;
	}
	}

	function envoiMessage($id_user,$donnee,$id_reponseMsg = 'NULL'){
		$tempEnvoiMsg= date('Y-m-d H:i:s');
		$etatConsigne = "enAttente"; // Défaut

        if(isset($donnee['etatConsigne'])){
        	$etatConsigne = $donnee['etatConsigne'];
         }

		(enregistrMsg($id_user,$donnee,$tempEnvoiMsg,$id_reponseMsg));


			$id_message= recupIdLastMsg($id_user,isset($donnee['objetMsg']) ? $donnee['objetMsg'] : '',$tempEnvoiMsg);
			$liste_admin =recupAdminId();
			

            foreach($liste_admin as $admin){
				affectMsg($id_message,$admin['id_user'] ,$etatConsigne);
			}

		}		