<?php
	require('model/admin.php');

	function droitAdmin($id_user){
		$listUnite= recupListUniteAffect($id_user);
		$droitAdmin=',';
		while ($unite = $listUnite->fetch()) {
			$droitAdmin.= $unite['id_unite'].',';
		}
		return $droitAdmin;
	}

	function menuAdmin(){
		require('view/admin/menuAdmin.php');
	}

	function gestionUsers(){
		$listUsers = recupListUsers($_SESSION['droitAdmin']);
		require('view/admin/gestionUsers.php');
	}

	function gestionUnitesProd(){
		if(isset($_POST['valider'])){
			ajoutUniteP($_POST);
			header('Location: '.$_SESSION['url'].'gestionUnitesProd');
		}elseif (isset($_POST['modifier'])) {
			modifUniteP($_POST['idUniteP'],$_POST);
			header('Location: '.$_SESSION['url'].'gestionUnitesProd');
		}else{
			$listUnites = recupListUnite();
			require('view/admin/gestionUnitesP.php');
		}
	}

	function gestionLignesProd(){
		if(isset($_POST['valider'])){ 
			ajoutLigneP($_POST);
			header('Location: '.$_SESSION['url'].'gestionLignesProd');
		}
		elseif (isset($_POST['modifier'])) {
			modifLigneP($_POST['idLigneP'],$_POST);
			header('Location: '.$_SESSION['url'].'gestionLignesProd');
		}
		elseif(isset($_POST['validerCat'])){
			ajoutCategorie($_POST['nomCategorie']);
			header('Location: '.$_SESSION['url'].'gestionLignesProd');
		}
		elseif (isset($_POST['modifierCat'])) {
			modifCategorie($_POST['id_categorie'],$_POST['nomCategorie']);
			header('Location: '.$_SESSION['url'].'gestionLignesProd');
		}
		else{
			$listCategorie= recupListCategorie()->fetchAll();
			$listUnite = recupListUnite($_SESSION['droitAdmin']);
			
			require('view/admin/gestionLignesP.php');
		}
	}

	function gestionProd(){
		if(isset($_POST['valider'])){
			$idNouv = ajoutProd($_POST);
			header('Location: '.$_SESSION['url'].'gestionProd/modifier/'.$idNouv);
		}
		else{
			$listLignesP = recupListLignesP($_SESSION['droitAdmin']);
			$listProds = recupListProds($_SESSION['droitAdmin']);
			require('view/admin/gestionProds.php');
		}
	}

	function formUser($id_user){
		if($id_user){
			if(isset($_POST['valider'])){
				modifUser($id_user,$_POST);
				header('Location: '.$_SESSION['url'].'gestionUtilisateurs');
			}elseif(isset($_POST['confirmeLigne'])){
				affectUserLigne($id_user,$_POST['ligneP']);
			}elseif(isset($_POST['confirmeUnite'])){
				affectUserUnite($id_user,$_POST['unite']);
			}

			$user = recupInfoUser($id_user);
			if($user['type']=='control'){
				$listAffect = recupListLigneAffect($id_user);
				$listLignesP = recupListLignesP($_SESSION['droitAdmin']);
				$affectation= false;
			}
			elseif($user['type']=='admin'){
				$listAffect = recupListUniteAffect($id_user);
				$listUnite = recupListUnite();
				$affectation= false;
			}

			require('view/admin/formUser.php');
			
		}else {
			header('Location: '.$_SESSION['url'].'gestionUtilisateurs');	
		}
	}

	function formProd($id_prod){
		if(isset($_POST['valider'])){
			modifProd($id_prod,$_POST);
			header('Location: '.$_SESSION['url'].'gestionProd');
		}
		elseif(isset($_POST['dupliquer'])){
			$_POST['nomProd']= $_POST['nomProd'].' [copie]';
			$nouvProd= ajoutProd($_POST);
			$listeNorme= recupNormeProd($id_prod);
			global $listeFormule; $listeFormule=[];

			dupliqueTout($listeNorme,$nouvProd);
			reglageFormule($nouvProd,$listeFormule);

			header('Location: '.$_SESSION['url'].'gestionProd/modifier/'.$nouvProd);
		}	
		$listLignesP = recupListLignesP($_SESSION['droitAdmin']);
		$listGroupeN= recupGroupeNProd($id_prod);
		$prod = recupInfoProd($id_prod);
		$listNormCol1 = recupNormeProd($id_prod,1);
		$listNormCol2 = recupNormeProd($id_prod,2);
		$listeDocument = recuplisteDocument($id_prod);
		require('view/admin/formProd.php');
	}

    function detailDocument($id_document){
        $document= ($id_document!=-1)? recupDetailDoc($id_document) : array('nomDocument'=>'','fileDocument'=>'','typeDocument'=>'','descriptionDoc'=>'' );
		
		$document['fileDocument']= ($id_document!=-1)?reecrireLienA($document['fileDocument']):null;

        require('view/admin/detailDocument.php');
    }
/***** imadModif ******/
    function ajoutDocument($id_prod,$donnee){
		$id_document= ajouterDocument($id_prod,$donnee);

		if(isset($_POST['typeLienDocument'])){
	     	$document= ecrireLien('Document',$id_document);
	     	if($_POST['typeLienDocument']=='FILE')
				$donnee['typeDocument']= defineTypeDocument(substr(strrchr($document,'.') ,1));
	    }else $document=false;

    	if($document) ajouterLienDocument($id_document,$document,$donnee['typeDocument']);
       	
       	echo "<script>window.onload = function(){window.parent.location.href=window.parent.location.href;}</script>";
	}

	function modifDocument($id_document,$donnee){
		modifierDocument($id_document,$donnee);

		if(isset($_POST['typeLienDocument'])){
	     	$document= ecrireLien('Document',$id_document);
	     	if($_POST['typeLienDocument']=='FILE')
				$donnee['typeDocument']= defineTypeDocument(substr(strrchr($document,'.') ,1));
	    }else $document=false;

    	if($document){
    		dropFile('Document',$id_document);
    		ajouterLienDocument($id_document,$document,$donnee['typeDocument']);
    	}
       	
       	echo "<script>window.onload = function () {window.parent.location.href=window.parent.location.href;}</script>";
	}

	function supprimeDocument($id_document){
		dropFile('Document',$id_document);

	    deleteDocument($id_document);

	    echo "<script>window.onload = function(){parent.location.href=parent.location.href;}</script>";
	}

/****** fin imad ******/	

	function formNorme($action,$id){
		$norme= array('id_norme' =>'','nomNorme' =>'','Abreviation' =>'','typeNorme' =>'','lienNorme' =>array('type' =>'','lien' =>''),'formuleNorme' =>'','uniteMesure' =>'','messageErreur' =>'','ordreNorme' =>'', 'isReset'=>'', 'parTime'=>'','time'=>0, 'id_groupeN'=>'', 'colone'=>'');
		$min=$max=$formule=$reFormule=$valeur='';
		$listGroupeN= null; 

	  if(isset($_POST['valider'])){

	  	if($_POST['typeNorme']=='valeur'){
	  		$_POST['formuleNorme']= $_POST['valeur'];
	  		$_POST['messageErreur']= $_POST['messageAlert1'];
	  		$_POST['uniteMesure']= $_POST['uniteMesureV'];

	  	}elseif($_POST['typeNorme']=='intervalle'){
	  		$_POST['formuleNorme']= $_POST['min'].'-'.$_POST['max'];
	  		$_POST['messageErreur']= $_POST['messageAlert2'];
	  		$_POST['uniteMesure']= $_POST['uniteMesureI'];

	  	}elseif($_POST['typeNorme']=='formule'){
	  		$_POST['formuleNorme']=$_POST['formule'].'#=#'.$_POST['minF'].'-'.$_POST['maxF'];
	  		$_POST['messageErreur']=$_POST['messageAlert3'];
	  		$_POST['uniteMesure']= $_POST['uniteMesureF'];
	  	}else{
	  		$_POST['formuleNorme']= '';
	  		$_POST['messageErreur']= '';
	  		$_POST['uniteMesure']= '';
	  	}
	  	if(isset($_POST['isReset']))$_POST['isReset']='1'; else $_POST['isReset']='0';

	  	if(isset($_POST['parTime'])) 
	  		$_POST['parTime']= explode(':', $_POST['time'])[0]*3600+explode(':', $_POST['time'])[1]*60;
	  	else $_POST['parTime']='0';

	  	if($_POST['groupeN']<0){
	  		$_POST['colone']= -$_POST['groupeN'];
	  		$_POST['groupeN']='null';
	  	}else{
	  		$_POST['colone']=1;
	  	}

	  	if(isset($_POST['typeLienNorme'])){
	     	$lienNorme= ecrireLien('Norme');
	    }else $lienNorme=false;

	  	if($action=='addP'){
	  		ajoutNorme($id,$_POST,$lienNorme);
	  	}elseif($action=='modif'){
	  		modifNorme($id,$_POST,$lienNorme);
	  	}
	  	echo '<script>window.onload = function () {
    			parent.location.href= parent.location.href;
			}</script>';
	  }else{
		if($action=='addP'){
			$listNorme= recupNormeProdNotGBT($id);
			$listGroupeN= recupGroupeNProd($id);

			require('view/admin/formNorme.php');
		}elseif($action=='modif'){
			$norme = recupNorme($id);
			$norme['lienNorme']=reecrireLienA($norme['lienNorme']);

			$listNorme= recupNormeProdNotGBT($norme['id_prod']);
			$listGroupeN= recupGroupeNProd($norme['id_prod']);

			$norme['time']= gmdate("H:i", $norme['parTime']);
			
			if($norme['typeNorme']=='valeur'){
				$valeur= $norme['formuleNorme'];
			}elseif($norme['typeNorme']=='intervalle'){
				$min= explode('-', $norme['formuleNorme'])[0];
				$max= explode('-', $norme['formuleNorme'])[1];
			}elseif($norme['typeNorme']=='formule'){
				$formule = explode('#=#', $norme['formuleNorme'])[0];
				$reFormule = reFormule($formule);

				$min= explode('-', explode('#=#', $norme['formuleNorme'])[1])[0];
				$max= explode('-', explode('#=#', $norme['formuleNorme'])[1])[1];
			}
			require('view/admin/formNorme.php');	
		}else header('Location: '.$_SESSION['url']);
	  }
	}

	function supprimeUser($id_user){
		if(!supprUser($id_user)) desactiveUser($id_user); 
	}

	function supprimeNorme($id_norme){
		if(!supprNorm($id_norme)) desactiveNorm($id_norme); 
	}
	
	function supprimeProd($id_prod){
		if(!supprProd($id_prod)) desactiveProd($id_prod); 
	}
	function supprimeLigneP($id_ligneP){
		if(!supprLigneP($id_ligneP)) desactiveLigneP($id_ligneP); 
	}
	function supprimeUniteP($id_unite){
		if(!supprUniteP($id_unite)) desactiveUniteP($id_unite); 
	}

	function formGroupeN($action,$id,$donnee=null){ 
		if($donnee!=null){
			if($donnee['groupeN']<0){
	  			$donnee['colone']= -$donnee['groupeN'];
	  			$donnee['groupeN']='null';
	  		}else{
	  			$donnee['colone']=1;
	  		}

	  		if($action=='modif'){
				if(isset($donnee['typeLienGroupe'])){
	     			$lienGroupe= ecrireLien('Groupe');
	     		}else $lienGroupe=false;
				modifGroupeN($id,$donnee,$lienGroupe);

				$id_prod= recupNorme($id)['id_prod'];
				header('Location: '.$_SESSION['url'].'gestionProd/modifier/'.$id_prod);
			}elseif($action=='ajout'){
				if(isset($donnee['typeLienGroupe'])){
	     			$lienGroupe= ecrireLien('Groupe');
	     		}else $lienGroupe=false;
				ajoutGroupeN($id,$donnee,$lienGroupe);

				header('Location: '.$_SESSION['url'].'gestionProd/modifier/'.$id);
			}
		}elseif($action=='suppr'){
			if(!supprNorm($id)) desactiveNorm($id); 
		}else{
			
		}
	}

/* ------------- les fonctions --------------------- */

	function reFormule($formule){
		$nouv='';
		$formule= explode('#=#', $formule);
		$tab= explode('@', $formule[0]);

		for($i=0;$i<sizeof($tab);$i++){
			if(strpos($tab[$i], ']')!== false){
				$t=explode(']', $tab[$i]);
				//chercher la norme t[0]
				if($t[0]!='' && $norme= recupNorme($t[0])) $nouv.= $norme['nomNorme'];
				$nouv.= $t[1];
			}else{
				$nouv.= $tab[$i];
			}//echo $nouv;
		}
		if(sizeof($formule)>1) $nouv.=' ['.$formule[1].']';
		return $nouv;
	}

	function dupliqueTout($listeNorme,$nouvProd,$nouvG='NULL'){
				$listGroupeN=$listeNouvG=[];
				global $listeFormule;

				while ($norme= $listeNorme->fetch()) {
					$norme['groupeN']= $nouvG;
					$nouvN= ajoutNorme($nouvProd,$norme,$norme['lienNorme']);
					if($norme['typeNorme']=='groupe'){
						array_push($listGroupeN,$norme['id_norme']);
						array_push($listeNouvG,$nouvN);
					}
					elseif ($norme['typeNorme']=='formule') {
						$listeFormule[]=$nouvN.'~'.$norme['formuleNorme'];
					}
				}

				for($i=0;$i<sizeof($listGroupeN);$i++){
					$listeNorme= recupNormeGroupeN($listGroupeN[$i]);
					dupliqueTout($listeNorme,$nouvProd,$listeNouvG[$i]);
				}
			}

	function reglageFormule($id_prod,$listeFormule){
		for($i=0;$i<sizeof($listeFormule);$i++){
			$formule= explode('~', $listeFormule[$i]);
			$formule[1]= regleFormule($id_prod,$formule[1]);

			modifFormuleNorme($formule[0],$formule[1]);
		}
		//recupNomNorme()
	}

	function regleFormule($id_prod,$formule){
		$nouv='';
		$tab= explode('@', $formule);

		for($i=0;$i<sizeof($tab);$i++){
			if(strpos($tab[$i], ']')!== false){
				$t=explode(']', $tab[$i]);
				//chercher la norme t[0] 
				
				$nouv.= '@'.recupNormeProdByNom($id_prod,recupNorme($t[0])['nomNorme']).']';
				$nouv.= $t[1];
			}else{
				$nouv.= $tab[$i];
			}//echo $nouv;
		}
		return $nouv;
	}

	function ecrireLien($nom,$id=''){
		if($_POST['typeLien'.$nom]=='FILE'){
		  if($_FILES['lien'.$nom]['error']==0){
			saveFile($nom,$id);
    		return $_POST['typeLien'.$nom].'!:!'.$_FILES['lien'.$nom]['name'];
		  }
		  else return false;
		}
		else return $_POST['typeLien'.$nom].'!:!'.$_POST['lien'.$nom];
    }

    function reecrireLienA($lien){
		$nouv['type']=$nouv['lien']="";
		if($lien!=''){
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

    function saveFile($nom,$id){
    	$securite= verifExtension(substr(strrchr($_FILES['lien'.$nom]['name'],'.') ,1));

		$nameFile = $nom."-".$id."_".$_FILES['lien'.$nom]['name'].$securite;
		$chemin = "archive/process".$nameFile;
		
		move_uploaded_file($_FILES['lien'.$nom]['tmp_name'],$chemin);
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

	function dropFile($type,$id){
		$file= recupInfoFile($type,$id);

	    if(file_exists($file['path'])) unlink($file['path']);
	}

	function recupInfoFile($type,$id){
		if($type=='Document')
			$file['nom']= explode('!:!',recupNomFileDocumentProd($id))[1];
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

	function telechargeFichier($type,$id){
		$file= recupInfoFile($type,$id);
		
	    if(!file_exists($file['path']) || is_null($file)){
	    	$file['path']= "public/img/no-img.png";
	    	$file['typeFile']='image'; $file['ext']='png';
	    }
	    
		if($file['typeFile']=='image'){
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


