<?php
	require('model/magasin.php');
	
	function detailArrivage($id_arrivage){
        if(isset($_POST['modifier'])){ 
        	$listEmbProduit= recupListEmbProduit(); 
            $listEmbFournisseur= recupListEmbFournisseur();
		 	
		 	modifierArrivage($id_arrivage,$_POST['produit'],$_POST['fournisseur'],$_POST['quantite'],$_POST['dateArrivage'],$_POST['numLot']);
		}
		
		$listEmbProduit= recupListEmbProduit(); 
        $listEmbFournisseur= recupListEmbFournisseur();
		$detailArrivage= recupDetailArrivage($id_arrivage);
        
        require('view/magasin/detailArrivage.php');
	}
	
	function gestionArrivage(){ 

		$listArrivage= recupListArrivage(); 	

        $listEmbProduit= recupListEmbProduit(); 
        $listEmbFournisseur= recupListEmbFournisseur();

        require('view/magasin/magasinMenu.php');
	}
	
	
	function ajouArrivage(){ 
		$idProd= verifDetailProd($_POST['codeBarProd'])[0]->id_prod;
		$idArrivage= ajouterArrivage($idProd,$_POST['fournisseur'],$_POST['quantite'],$_POST['numLot']);
		// var_dump($idArrivage);die;

		if(isset($_FILES['imgEmballage']) && $_FILES['imgEmballage']['error']==0 && $_FILES['imgEmballage']['name']!='' && $extension=verifExtension(substr(strrchr($_FILES['imgEmballage']['name'],'.') ,1))){

			saveMaquette($idArrivage,$extension,$_FILES['imgEmballage']['tmp_name']);
			saveMaquetteBD($idArrivage,$extension);
		}

	}

	function verifCodeBarre($codeBarre){
		$detailP = verifDetailProd($codeBarre);
		if($detailP){
			$detailP[0]->miniatureProd= $_SESSION['url']."magasin/afficheMaquette/".$detailP[0]->id_version."-".$detailP[0]->miniatureProd."/".$detailP[0]->extensionMaquette;
			echo json_encode($detailP[0]);
		}
		else echo json_encode(null);
	}

	function verifIMG($idArrivage){
		if (isset($_POST['valideEtat'])) { 
            for($i=0;$i<8;$i++) $table[$i]= (isset($_POST['value'.$i]))? 1 : 0;
                        
            $etatMaquette= bindec(implode("", $table));
            
            if($_POST['etatMaquette']=='Refuser') $etatMaquette = -1 * $etatMaquette;
             elseif($_POST['etatMaquette']=='Valider') $etatMaquette= 255;

            modifierEtatArrivage($idArrivage,$etatMaquette,$_POST['remarqueMaquette']);
        }

		$detailArrivage= recupDetailArrivage($idArrivage);
		$listMention=array('logo','code a barre','code article','pictogramme','tableau nutritionnel','nomination produit','ingrédients (étiquetage)','adresse + numéro téléphone');
		$valMention= ($detailArrivage['etatMaquette']<0)?-1*$detailArrivage['etatMaquette']:$detailArrivage['etatMaquette'];
		$valMention= sprintf("%08d",decbin($valMention));
        
        require('view/magasin/imageArrivage.php');
	}

	function afficheIMG($idArrivage,$extension){
		$path ="archive/imgEmb-".$idArrivage.'.'.$extension;
	    if(!file_exists($path)) $path= "public/img/no-img.png";
	    
		header('Content-type:image/jpg');
	    readfile($path);
	}

	function afficheMaquette($name,$extension){
		$path ="archive/maquetteEmb".$name.'.'.$extension;
	    if(!file_exists($path)) $path= "public/img/no-img.png";
	    
		header('Content-type:image/jpg');
	    readfile($path);
	}

	function verifCouleurArrivage($idArrivage){
        $infoAllImages= recupInfoAllImages($idArrivage);
        $img1= $_SESSION['url'].'magasin/afficheIMG/'.$idArrivage.'/'.$infoAllImages['extentionIMG'];
        $img2= $_SESSION['url'].'magasin/afficheMaquette/'.$infoAllImages['id_version'].'-'.$infoAllImages['maquetteProd'].'/'.$infoAllImages['extensionMaquette'];

        require('view/magasin/verifCouleurArrivage.php');
	}

	function verifTextArrivage($idArrivage){
		$infoAllImages= recupInfoAllImages($idArrivage);
        $img1= $_SESSION['url'].'magasin/afficheIMG/'.$idArrivage.'/'.$infoAllImages['extentionIMG'];
        $img2= $_SESSION['url'].'magasin/afficheMaquette/'.$infoAllImages['id_version'].'-'.$infoAllImages['maquetteProd'].'/'.$infoAllImages['extensionMaquette'];
        
        require('view/magasin/verifTextArrivage.php');
	}


/******************************/
	function verifExtension($extension){
		$extensionsValides = array( 'png' , 'jpg' , 'jpeg' , 'gif' , 'csv' , 'tif' , 'tiff' );
		$extension= strtolower($extension);

		if (!in_array($extension,$extensionsValides)) return false;
		else return $extension;
	}

	function saveMaquette($idArrivage,$extension,$tmp_name){
		$nom = "-".$idArrivage.".".$extension;
		$chemin = "archive/imgEmb".$nom;
		
		move_uploaded_file($tmp_name,$chemin);
	}
	
	