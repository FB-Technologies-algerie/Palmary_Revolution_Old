<?php
	
	require('model/reporting.php');

	function reporting($typeUser){
		if($typeUser=='admin'){
			$listUnite = recupListUnite();
		    $listProds= recupListProduits();

			$ValeurSaisieGraphe = [];

			if(isset($_POST['valider'])){ 
             	$_POST['dateF'] = strtotime("+1 day", strtotime("".valid($_POST['dateF']).""));
        		$_POST['dateF'] =  date("Y-m-d", $_POST['dateF']);
             if ($_POST['typeRecherche'] == 'passage') {
        		
             	$ValeurSaisie = recupValeurSaisieParPassage($_POST['dateD'],$_POST['dateF'],$_POST['Norme1'],$_POST['Norme2']);
             	$ValeurSaisieGraphe = recupValeurSaisieParPassage($_POST['dateD'],$_POST['dateF'],$_POST['Norme1'],$_POST['Norme2']);
 
             }elseif($_POST['typeRecherche'] == 'groupe'){
                  $ValeurSaisie = recupValeurSaisieParGroupe($_POST['dateD'],$_POST['dateF'],$_POST['Norme1'],$_POST['Norme2']);

                 $ValeurSaisieGraphe = recupValeurSaisieParGroupe($_POST['dateD'],$_POST['dateF'],$_POST['Norme1'],$_POST['Norme2']);
             }else { 
             	$ValeurSaisie = recupValeurSaisieParJour($_POST['dateD'],$_POST['dateF'],$_POST['Norme1'],$_POST['Norme2']); 
                $ValeurSaisieGraphe = recupValeurSaisieParJour($_POST['dateD'],$_POST['dateF'],$_POST['Norme1'],$_POST['Norme2']);
              }   
             	
             	$nomNorme1=recupNomNorme($_POST['Norme1']);
             	$nomNorme2=recupNomNorme($_POST['Norme2']);

             		$ValeurSaisieGraphe = json_encode($ValeurSaisieGraphe->fetchAll(PDO::FETCH_CLASS)); 
             		$ValeurSaisieGraphe = str_replace(',"val1":null', '', $ValeurSaisieGraphe);
             		$ValeurSaisieGraphe = str_replace(',"val2":null', '', $ValeurSaisieGraphe);
             	             
			}
		
		require('view/reporting/reporting.php');
		} 		


	}

	

	function listLignes($id_unite){
		$listLignes= recupListLignesOfUnite($id_unite);

		echo json_encode($listLignes->fetchAll());
	}

	 function listeNormeGroupeProduit($id_groupeN){
	 	
	 	$listeNormeGroupeProduit= recuplisteNormeGroupeProduit($id_groupeN);

		echo json_encode($listeNormeGroupeProduit->fetchAll());
	 }




	function listProduitsLigne($id_ligne){ 
		$listProds= recupListProdsOfLigne($id_ligne);

		echo json_encode($listProds->fetchAll());
	}
    

    function listeProdUnite($id_unite){ 
		$list= recupListProdsOfUnite($id_unite);

		echo json_encode($list->fetchAll());
	}
    





     function listeGroupeNorme($id_prod){ 
    
      $liste = listeGroupeProduit($id_prod);      
    
     	echo json_encode($liste);
    }




    function listeGroupeProduit($id_prod,$nomParant='',$id_groupe=null){ 
		$liste=array();
		$tab = selectGroupeNorme($id_prod,$id_groupe);
		 while ($groupe= $tab->fetch()) { 
           $groupe['nomNorme'] = $nomParant.$groupe['nomNorme'];
           $liste[]= $groupe;
           $liste = array_merge($liste, listeGroupeProduit($id_prod,$groupe['nomNorme'].' - ',$groupe['id_norme']));
            
		 }

           return  $liste;
	

	}

  
     function listeProduitComplet(){
	 	
	 	$listeProduitComplet= recupListProduits();

		echo json_encode($listeProduitComplet->fetchAll());
	 }











	