<?php
	
	require('model/process.php');


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
		terminePassageBD($id_passage,$comment);
		upload_passage($id_passage);
		header('Location: '.$_SESSION['url']);
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
	}
	
	
	function upload_passage($id_passage){
		$remote_server = '193.70.112.49';
		$port = '22';
		$ssh_user = 'debian';
		$ssh_password = 'vz6SenfrKNQN';
	 
	
	// Parcourir chaque passage et générer un fichier CSV
		 // Utiliser l'ID de passage pour récupérer les valeurs du passage
		 $passage_values = get_passage_values($id_passage);
		// Chemin du fichier CSV sur le serveur distant
		$remote_csv_file = "/tmp/passage_" . $id_passage. '.csv';
		// Créer le contenu CSV dans une variable temporaire
		$csv_content = "Nom de la norme,Valeur saisie\n";
		foreach ($passage_values as $row) {
			$csv_content .= $row['nomNorme'] . ',' . $row['valeurSaisie'] . "\n";
		}
	   $file_handler  = streamRemoteFile($remote_server,$port,$ssh_user,$ssh_password,$remote_csv_file,"w");
	
	   // Vérification de la ressource de fichier
	   if (!is_resource($file_handler)) {
		$donnee['objetMsg'] = "envoi fichier csv";
        $donnee['corpMsg'] = "Impossible d'établir une connexion SFTP ou d'ouvrir le fichier distant ".$remote_csv_file;
		$donnee['etatConsigne'] = "enAttente";
		envoiMessage($_SESSION['id_user'],$donnee,'NULL');
	   } else {
		   // Écrire le contenu du fichier CSV sur le serveur distant
		   if (fwrite($file_handler, $csv_content) === false) {
			$donnee['corpMsg'] = "Impossible d'écrire le contenu dans le fichier distant sur".$remote_csv_file;
			envoiMessage($_SESSION['id_user'],$donnee,'NULL');
		   } else {
			$donnee['corpMsg'] = "Fichier CSV enregistré avec succès sur le serveur SFTP sur ".$remote_csv_file;
			envoiMessage($_SESSION['id_user'],$donnee,'NULL');
		   }
		   // Fermer le gestionnaire de fichier
		   fclose($file_handler);
		   return true;
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

			affectMsg($id_message,'33' ,$etatConsigne);

		}		