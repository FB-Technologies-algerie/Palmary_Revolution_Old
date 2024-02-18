<?php 
	require('controller/gestionMatiere.php');
    if ( $_SESSION['type']=="matierePremiere"  || $_SESSION['type']=="laboratoire" ) {
       if (isset($_GET['v1']) ) {
       if( $_GET['v1'] =='GroupeMatiereSupprimer' ){                  
              if (isset($_GET['v2']) ) {
              deleteGroupeMatiere($_GET['v2']);
              } 
       }elseif($_GET['v1'] =='matiereSupprimer' ) {
            if (isset($_GET['v2']) ) { 
             deleteMatiere($_GET['v2']);
             }
         }elseif ($_GET['v1']=='detailMatiere' && isset($_GET['v2'])) {
              detailMatiere($_GET['v2']);
          }elseif($_GET['v1']=='listeAnalyses' && isset($_GET['v2']) ) { 
                     if ($_SESSION['type']=="laboratoire") {
                      if ($_GET['v2']=='supprimer' && isset($_GET['v3'])) {
                        daleteAnalyseMatiere($_GET['v3']);
                    }else{
                        listeAnalyseMatiere($_GET['v2']);    
                    }
                     }else  header('Location: '.$_SESSION['url']);
                    
         }elseif ($_GET['v1']=='detailVersionParam' && isset($_GET['v2']) && isset($_GET['v3'])) {
                        detailParamMat($_GET['v2'],$_GET['v3']);

         }elseif ($_GET['v1']=='listeVersionParam' && isset($_GET['v2']) && isset($_GET['v3'])) {
                         listeVersionParame($_GET['v2'],$_GET['v3']);
                
        }elseif ($_GET['v1']=='parametreMatiereSupprimer' && isset($_GET['v2'])) {
                        deleteParametreMatiere($_GET['v2']);
        }elseif($_GET['v1']=='detailGroupe' && isset($_GET['v2'])) {
              detailGroupeEquipe($_GET['v2']);

        }
         
    }
      else{                   
      gestionMatiere(); 
      
  }
    }else  header('Location: '.$_SESSION['url']);
     

