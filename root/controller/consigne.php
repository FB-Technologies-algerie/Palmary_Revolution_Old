<?php
	require('model/consigne.php');

	function consigne($id_user){
		if($_SESSION['type']=='admin'){
			$p0['titre']='Consignes non vues';$p0['type']='reçu';
			$p1['titre']='Consignes en attentes';$p1['type']='envoyé';
			$p2['titre']='Consignes en cours';$p2['type']='reçu';
			$p3['titre']='Consignes terminées';$p3['type']='reçu';
			
			$p0['list']= recupConsigneNonLu($id_user);
			$p1['list']= recupConsigneOfEtat($id_user,'enAttente');
			$p2['list']= recupConsigneOfEtat($id_user,'enCours');
			$p3['list']= recupConsigneOfEtat($id_user,'terminer');
		}else{
			$p0['titre']='Consignes non vues';$p0['type']='reçu';
			$p1['titre']='Consignes à faire';$p1['type']='reçu';
			$p2['titre']='Consignes en cours';$p2['type']='reçu';
			$p3['titre']='Consignes terminées';$p3['type']='reçu';
			
			$p0['list']= recupConsigneNonLu($id_user);
			$p1['list']= recupConsigneOfEtat($id_user,'enAttente');
			$p2['list']= recupConsigneOfEtat($id_user,'enCours');
			$p3['list']= recupConsigneOfEtat($id_user,'terminer');
		}

		require('view/consigne/index.php');
	}

	function afficheMsg($id_user,$id_message,$content='',$reponse=false){
		if(autorisationMsg($id_user,$id_message)){
			$msg = recupInfoMsg($id_message);
			$usersMsgRecev= recupUsersRecept($id_message);
			
			if($msg['jointMsg']!=''){
            	$file['stock']='file'.$msg['id_sender'].'-'.$id_message;
            	$file['extension']=substr(strrchr($msg['jointMsg'],'.') ,1);
            	$file['origine']=$msg['jointMsg'];

            	$_SESSION['file'][]=$file;
            }
				require('view/consigne/message.php');
				rendrLu($id_user,$id_message);
            if($msg['id_reponseMsg']!=null) $content=afficheMsg($id_user,$msg['id_reponseMsg'],$content,true);
		}
		
		return $content;
	}

	function lireMessage($id_user,$id_message){
		$title="Lire Message";
		$style='<link rel="stylesheet" href="'.$_SESSION['url'].'public/css/consigne.css">';

		$_SESSION['file']=[];
		$content= afficheMsg($id_user,$id_message);

		require('view/gabarit.php');
		  ?>
			<script type="text/javascript">
    			function openModal(){
        			$('#nouveauMsg', window.parent.document).click();
        			$('#iframeFormMsg', window.parent.document).attr('src','<?= $_SESSION['url'] ?>consigne/envoiMsg/<?= $id_message ?>');
    			}
			</script>
		  <?php
	}

	function envoiMessage($id_user,$donnee,$joint,$id_reponseMsg='NULL'){
		$tempEnvoiMsg= date('Y-m-d H:i:s');
		if($id_reponseMsg!='NULL'){
			$etatConsigne= $donnee['etatConsigne'];
		}
		else{
		 	$etatConsigne= "enAttente";
		}

		enregistrMsg($id_user,$donnee,$tempEnvoiMsg,$joint['name'],$id_reponseMsg);

		$id_message= recupIdLastMsg($id_user,$donnee['objetMsg'],$tempEnvoiMsg);
		
		$donnee['listRecept']=explode(';', $donnee['listRecept']);
		foreach ($donnee['listRecept'] as $recept) affectMsg($id_message, $recept,$etatConsigne);

		if($joint['error']==0 && $joint['name']!=''){
			saveFile($id_user,$id_message,$joint);
		}
		  ?>
			<div style="text-align: center;">
              <h3>Votre message a était envoyé avec succée</h3>
         	  <script>window.onload = function () {parent.location.href="<?= $_SESSION['url'] ?>consigne";}</script>
            </div>
		  <?php
	}

	function saveFile($id_user,$id_message,$joint){
		$extension= verifExtension(substr(strrchr($joint['name'],'.') ,1));

		$nom = $id_user."-".$id_message.".".$extension;
		$chemin = "archive/file".$nom;
		
		move_uploaded_file($joint['tmp_name'],$chemin);
	}

	function telechargementFichier($file){
  		header('Content-Transfer-Encoding: binary'); 		//Transfert en binaire (fichier)
 		header('Content-Disposition: attachment; filename="'.$file['origine'].'"'); //Nom du fichier

 		$extension= verifExtension($file['extension']);
  		readfile('archive/'.$file['stock'].'.'.$extension); //envoie du fichier
	}

	function verifExtension($extension){
		$extensionsNonValides = array( 'sql' , 'php' , 'js' , 'html' , 'css' , 'exe' );
		$extension= strtolower($extension);

		if (in_array($extension,$extensionsNonValides)) $extension= $extension.".file";

		return $extension;
	}

	function notificationMsg($id_user){
		echo recupNbrMsgNonLu($id_user);
	}

	function formMsg($id_user,$typeUser,$id_reponseMsg=false){
		if(!$id_reponseMsg){
			$listRecept= recupListAutoriseUser($id_user,$typeUser);
		}else{	
			$msg = recupInfoMsg($id_reponseMsg);
			if($id_user==$msg['id_sender']) $usersMsgRecev= recupUsersRecept($id_reponseMsg);
			else $usersMsgRecev=false;
		}
		
		require('view/consigne/formMsg.php');
	}

	function recupListAutoriseUser($id_user,$typeUser){
		if($typeUser=="admin") return recuprListUser($id_user);
		else return recuprListUser($id_user,"admin");
	}


