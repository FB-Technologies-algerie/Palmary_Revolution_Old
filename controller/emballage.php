<?php
	require('model/emballage.php');

	function emballage(){
		require('view/emballage/mainMenu.php');
	}
	function controleQualite(){
		require('view/emballage/controleQualite.php');
	}
	function traitementImage(){
		require('view/emballage/traitementImage.php');
	}

	function gestionTraduction(){
		$listTraduction= recupListTraduction();

		require('view/emballage/gestionTraduction.php');
	}

	function gestionEmballageProd(){ 

		$listeGroupeProduit =listeGroupeProduit();
		$listeProduit = listeProduit();
		$listeToutGroupe= recupToutGroupeProd();

		require('view/emballage/gestionEmballageProd.php');
	}
function ajouterGroupaProduit($donnee){
		insertGroupeProduit($donnee);

	}








 	function saveNutrition($id_prod,$id_version){
          if(isset($_POST['validerValeur'])){
			  $IdNut= recupListeNutrition();
		       while($IdN = $IdNut->fetch()){
                   if(!isset($_POST[$IdN['id_nutrition'].'ar']) && !isset($_POST[$IdN['id_nutrition'].'fr']))
                   		$_POST[$IdN['id_nutrition']]=0;
                   	else $_POST[$IdN['id_nutrition']]=$_POST[$IdN['id_nutrition'].'ar'].'!i!'.$_POST[$IdN['id_nutrition'].'fr'];
                   saveValeurNutri($id_version,$IdN['id_nutrition'],$_POST[$IdN['id_nutrition']]);
			    }
		    }
    
    	header('Location: '.$_SESSION['url'].'formEmballage/'.$id_prod.'/'.$id_version);
	}
	
 	function formEmballageProd($id_prod,$idSelect=null){
		$produit= recupInfoEmballageProd($id_prod);
     
		if(isset($_POST['validerVersion'])){
			if($_POST['id_version']!=-1){
				modifVersionProd($_POST);
				
				$objet="une version du produit '".$produit['nomProd']."' a était modifier";
				$corp="la version '".$_POST['titreVersion']."'' du produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$produit['nomProd']."</a> a était modifier par '".$_SESSION['nom']."'.";
				consigneAuto($objet,$corp);
			}else{
				ajoutVersionProd($id_prod,$_POST);
				
				$objet="une nouvelle version du produit a était créer";
				$corp="une nouvelle version du produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$produit['nomProd']."</a> a était créer par '".$_SESSION['nom']."'.";
				consigneAuto($objet,$corp);
			}
		}
		if(isset($_POST['validerProd'])){ 
			modifEmballageProd($id_prod,$_POST);
              
			header('Location: '.$_SESSION['url'].'formEmballage/'.$id_prod);
		}

    	$listeVersion= recupListeVersionProd($id_prod);
    	$listeNutrition= recupListeNutrition();
    	$listeToutGroupe= recupToutGroupeProd();

		require('view/emballage/formEmballage.php');
	}

	function ajoutEmbProd($donnee){
		$id_prod= ajoutEmballageProd($donnee);

		$objet="un nouveau produit a était ajouter";
		$corp="un nouveau produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$donnee['nomProd']."</a> a était ajouter par '".$_SESSION['nom']."'.";
		consigneAuto($objet,$corp);
		
		header('Location: '.$_SESSION['url'].'formEmballage/'.$id_prod);
	}

	function supprimeEmbProd($id_prod){
		$produit= recupInfoEmballageProd($id_prod);
		$objet="un produit a était supprimer";
		$corp="le produit ".$produit['nomProd']." a était supprimer par '".$_SESSION['nom']."'.";
		consigneAuto($objet,$corp);
		
		supprimeEmballageProd($id_prod);
	}


	function supprimeGroupeProd($id_groupeProd){
        deleteGroupeProd($id_groupeProd);

	}

	function modifierGroupe($id_groupeProd){
		updateGroupe($id_groupeProd,$_POST);
	}

	function detailVersion($id_version=-1){
	  if($id_version!=-1){
		$version= recupDetailVersionProd($id_version);

		$listeMaquette= recupListeMaquetteProd($id_version);
		//var_dump($listeMaquette);die;
		$listNutrition= recupValeurNutrition($id_version);
		$tab=null;
	  
	  }else{
	  	$version=$listeMaquette=null;
	  }

		require('view/emballage/detailVersionProd.php');
	}

	function detailMaquette($id_version,$id_maquette=-1){
	  if($id_maquette!=-1){
		if(isset($_POST['valideDetail'])){
			if (isset($_POST['miniatureProd'])) modifierMiniature($id_version,$id_maquette);
			if (isset($_POST['referenceProd'])) modifierMaquette($id_version,$id_maquette);
			$_POST['dimensionMaquette']=$_POST['dimensionPasCoupe'].'!-!'.$_POST['dimensionLese'].'!-!'.$_POST['dimensionHauteur'];

			modifMaquette($id_maquette,$_POST);
         	$prod= recupProdVersion($id_version);
			$objet="une maquette a était modifier";
			$corp="la maquette '".$_POST['titreMaquette']."' du produit <a target='_blank' href='../formEmballage/".$prod['id_prod']."'>".$prod['nomProd']."</a> a était modifier par '".$_SESSION['nom']."'.";
			consigneAuto($objet,$corp);
		}elseif(isset($_POST['valideRemarque'])){
			remarqueMaquette($id_maquette,$_POST);
		}
		$maquette= recupDetailMaquetteProd($id_maquette);
		$maquette['dimensionMaquette']= explode('!-!', $maquette['dimensionMaquette']);

		$refMin=recupeReferMiniaVersion($id_version);
		$maquette['referenceProd']= ($refMin['maquetteProd']==$id_maquette)?true:false;
		$maquette['miniatureProd']= ($refMin['miniatureProd']==$id_maquette)?true:false;

		if(isset($_POST['valideRemarque'])){
			$prod= recupProdVersion($id_version);
			$objet="une nouvelle remarque sur la maquette '".$maquette['titreMaquette']."'";
			$corp="une remarque sur la maquette '".$maquette['titreMaquette']."' du produit <a target='_blank' href='../formEmballage/".$prod['id_prod']."'>".$prod['nomProd']."</a> a était ajouter par '".$_SESSION['nom']."'.";
			consigneAuto($objet,$corp);
		}
	  }else{
	  	$maquette=null;
	  	if(isset($_POST['valider'])){
	  	  if(isset($_FILES['maquette']) && $_FILES['maquette']['error']==0 && $_FILES['maquette']['name']!='' && $extension=verifExtension(substr(strrchr($_FILES['maquette']['name'],'.') ,1))){
			$_POST['dimensionMaquette']=$_POST['dimensionPasCoupe'].'!-!'.$_POST['dimensionLese'].'!-!'.$_POST['dimensionHauteur'];
	  		$id_maquette= addMaquette($id_version,$_POST,$_FILES['maquette']);

	  		if (isset($_POST['miniatureProd'])) modifierMiniature($id_version,$id_maquette);
			if (isset($_POST['referenceProd'])) modifierMaquette($id_version,$id_maquette);
			
			saveMaquette($id_version,$id_maquette,$extension,$_FILES['maquette']['tmp_name']);
			
			$prod= recupProdVersion($id_version);
			$objet="une nouvelle la maquette du produit '".$prod['nomProd']."'";
			$corp="une nouvelle maquette '".$_POST['titreMaquette']."' du produit <a target='_blank' href='../formEmballage/".$prod['id_prod']."'>".$prod['nomProd']."</a> a était insérer par '".$_SESSION['nom']."'.";
			consigneAuto($objet,$corp);
		  }
		  echo "<script>window.onload = function (){parent.location.href=parent.location.href;}</script>";
	  	}
	  }
	  
	  require('view/emballage/detailMaquette.php');
	}

	function afficheMaquette($name,$extension){
		$path ="archive/maquetteEmb".$name.'.'.$extension;
	    if(!file_exists($path)) $path= "public/img/no-img.png";
	    
		header('Content-type:image/jpg');
	    readfile($path);
	}

	function supprimeMaquette($name,$extension){
		$path ="archive/maquetteEmb".$name.'.'.$extension;
	    if(file_exists($path)) unlink($path);

	    $id_maquette= explode("-", $name)[1];
	    deleteMaquette($id_maquette);

	    echo"<script>window.onload = function(){parent.location.href=parent.location.href;}</script>";
	}

	function compareMaquetteText($name,$extension){
		$image =$name.'/'.$extension;

		require('view/emballage/compareMaquetteText.php');
	}

	function compareMaquetteCouleur($name,$extension){
		$image =$name.'/'.$extension;

		require('view/emballage/compareMaquetteCouleur.php');
	}

/**************************************************/
	function consigneAuto($objet,$corp){
		$dateTime= date('Y-m-d H:i:s');
		$id_consigne= saveConsigne($objet,$corp);
		
		$listRecepteur= recupListeUserEmb($_SESSION['id_user']);
		while ($recept=$listRecepteur->fetch()) {
			envoiConsigne($id_consigne,$recept['id_user']);
		}
	}

	function objetCorpAuto($type){
		if($type= 'modifProd'){
			$objet="un produit à était modifier";
			$corp="le produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$_POST['nomProd']."</a> à était modifier par '".$_SESSION['nom']."'.";
		}
		elseif($type= 'modifVersion'){
			$objet="un produit à était modifier";
			$corp="le produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$_POST['nomProd']."</a> à était modifier par '".$_SESSION['nom']."'.";
		}
		elseif($type= 'newVersion'){
			$objet="un produit à était modifier";
			$corp="le produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$_POST['nomProd']."</a> à était modifier par '".$_SESSION['nom']."'.";
		}
		elseif($type= 'newMaquette'){
			$objet="un produit à était modifier";
			$corp="le produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$_POST['nomProd']."</a> à était modifier par '".$_SESSION['nom']."'.";
		}
		elseif($type= 'modifMaquette'){
			$objet="un produit à était modifier";
			$corp="le produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$_POST['nomProd']."</a> à était modifier par '".$_SESSION['nom']."'.";
		}
		elseif($type= 'remarqueMaquette'){
			$objet="un produit à était modifier";
			$corp="le produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$_POST['nomProd']."</a> à était modifier par '".$_SESSION['nom']."'.";
		}
		elseif($type= '777777'){
			$objet="un produit à était modifier";
			$corp="le produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$_POST['nomProd']."</a> à était modifier par '".$_SESSION['nom']."'.";
		}
		elseif($type= '77777'){
			$objet="un produit à était modifier";
			$corp="le produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$_POST['nomProd']."</a> à était modifier par '".$_SESSION['nom']."'.";
		}
		elseif($type= '777777'){
			$objet="un produit à était modifier";
			$corp="le produit <a target='_blank' href='../formEmballage/".$id_prod."'>".$_POST['nomProd']."</a> à était modifier par '".$_SESSION['nom']."'.";
		}
		else {}

	}

	function traduction($id_version,$listeFR){
		$tabIngrediants= separIngrediantsNb($listeFR);
		$liste['AR']=$liste['EN']=$liste['PT']=$liste['ES']=$liste['FR']="";

		foreach ($tabIngrediants as $ingrediant) {
		  $ingrediant= explode('*#',$ingrediant);
		  if(sizeof($ingrediant)==2){	
			$traduction= traduireIngrediant($ingrediant[0]);
			$liste['AR'].=$traduction['termeAR'].$ingrediant[1].' ';//.'، ';
			$liste['EN'].=$traduction['termeEN'].$ingrediant[1].' ';
			$liste['PT'].=$traduction['termePT'].$ingrediant[1].' ';
			$liste['ES'].=$traduction['termeES'].$ingrediant[1].' ';

			$liste['FR'].=$traduction['termeFR'].$ingrediant[1].' ';
		  }
		}

		$liste['AR']=str_replace(',','،',$liste['AR']);
		saveListeIngrediants($id_version,$listeFR,$liste);

		echo json_encode($liste);

	}


		function separIngrediantsNb($chaine){ // les séparateur *# et @*

			$origin = array(":", ".", ",","/","(",")");
			$replace= array("*#:@*", "*#.@*", "*#,@*","*#/@*","*#(@*","*#)@*");
         
			$chaine2=str_replace($origin,$replace,$chaine); 

			return explode('@*',$chaine2);
		}

	function saveMaquette($id_version,$id_maquette,$extension,$tmp_name){
		$nom = $id_version."-".$id_maquette.".".$extension;
		$chemin = "archive/maquetteEmb".$nom;
		
		move_uploaded_file($tmp_name,$chemin);
	}


	function verifExtension($extension){
		$extensionsValides = array( 'png' , 'jpg' , 'jpeg' , 'gif' , 'csv' , 'tif' , 'tiff' );
		$extension= strtolower($extension);

		if (!in_array($extension,$extensionsValides)) return false;
		else return $extension;
	}

   function gestionFournisseur(){
		$listFourniseur= recupListFournisseur();
		require('view/emballage/gestionFournissuer.php');
	} 

	function supprimerFournissuer($id_Fournissuer){
    deleteFournissuer($id_Fournissuer);
     }
 
     function ajouterFournisseur(){ 

     	insertFournisseur($_POST['nomFournisseur']);

     }
   
   function modifFournissuer($id_Fournissuer){ 
  
   	if (isset($_POST['modifier'])) {
   	 updateFournissuer($id_Fournissuer,$_POST['nomFournisseurModif']);
   	}
     
   }

   function ajoutTraduction($donnee){
	 
            $donnee['french'] = rtrim(ltrim($donnee['french']));
            $donnee['arabic'] = rtrim(ltrim($donnee['arabic']));
            $donnee['english'] =  rtrim(ltrim($donnee['english']));
            $donnee['portuguese'] =  rtrim(ltrim($donnee['portuguese']));
            $donnee['spanish'] = rtrim(ltrim($donnee['spanish']));
	        insertTraduction($donnee); 
		
	}
	  function updateTraduction($donnee){
	     
            $donnee['french'] = rtrim(ltrim($donnee['french']));
            $donnee['arabic'] = rtrim(ltrim($donnee['arabic']));
            $donnee['english'] =  rtrim(ltrim($donnee['english']));
            $donnee['portuguese'] =  rtrim(ltrim($donnee['portuguese']));
            $donnee['spanish'] = rtrim(ltrim($donnee['spanish']));
         
	        modifTraduction($donnee); 
		
	}