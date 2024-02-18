<?php $title="Gestion des analyses" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
  <!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>
  
   
    <div class="card" style="width: 80%;margin: auto;margin-top: 100px">
      <div class="card-header">
        liste des analyses
      </div>
      <div class="card-body" >
        <div class="table-responsive">
          <table
            id="id_ligne"
            class="table  table-striped table-hover table-bordered table-sm"
            cellspacing="0"
            width="100%"
          >
            <thead>
              <th>Etat</th>
              <th>Date de prelevement</th>
              <th>Date Fin</th>
              <th>conclusion Analyse</th>
              <th style="width: 15%">Paramètres</th>
            </thead>
        <?php while ($liste= $listeAnalyseComplet->fetch()){ ?>
              <tr>
               <?php if ( $liste['etatAnalyse'] =="Valider"){ ?>    
                           <td title="valider" style="color:green;text-align: center;">
                              <i class="fas fa-check-circle"></i>
                            </td>
                        <?php }
                           elseif ($liste['etatAnalyse'] == "En cours"){ ?>    
                            <td title="En cours" style="color:#0070ff;text-align: center;">
                              <i class="fas fa-tasks"></i>
                            </td>
                        <?php }
                           elseif ($liste['etatAnalyse'] == "Refuser"){ ?>    
                            <td title="Refuser" style="color:red;text-align: center;">
                              <i class="fas fa-times-circle"></i>
                            </td>
                        <?php }
                           /*    */
                           else{ ?> 
                           <td title="En attente" style="color:orange;text-align: center;">
                              <i class="fas fa-hourglass-end"></i>   
                           
                        <?php } ?>
              <td>  <?= $liste['datePrelevement'] ?> </td>
              <td>  <?= $liste['dateFin'] ?> </td>
              <td>  <?= $liste['conclusionAnalyse'] ?> </td>

              <td class="d-flex justify-content-around">


 <a href="<?= $_SESSION['url'] ?>analyseMatiere/<?= $liste['id_analyseMat'] ?>"><i class="fas fa-list-alt""  style="color: royalblue; font-size: 25px;cursor: pointer;" ></i></a>
 
                 <!--  <i onclick="defineId(<?= $liste['id_analyseMat'] ?>)" class="fas fa-minus-circle" style="color: red; font-size: 25px;cursor: pointer;"data-toggle="modal" data-target="#supprim" ></i>  -->
              </td>
               </tr>
             
       <?php ; } ?>
     
          </table>
        </div>
      </div>
    </div>

  
<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
      var toggle = true;
     

     /******* analyse matieres    nabil ****/
 function defineId(id) {
        $('#supprimerMatiere').attr('onclick','supprimerAnalyseMatiere('+id+')');
    }
 
   function supprimerAnalyseMatiere(id){ 
      $.get("<?= $_SESSION['url'] ?>listeAnalyses/supprimer/"+id, function(data, status){
        window.location.reload(true);
      });
  }


  
   
</script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>