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
              <th>Numéro de Lot</th>
              <th>Date de prelevement</th>
              <th>Date Fin</th>
               <th>conclusion Analyse</th>
              <th style="width: 15%">Paramètres</th>
            </thead>

     
        <?php while ($liste= $listeAnalyseMatiere->fetch()){ ?>
              <tr>
              <td>  <?= $liste['numLot'] ?></td>
              <td>  <?= $liste['datePrelevement'] ?> </td>
              <td>  <?= $liste['dateFin'] ?> </td>
              <td>  <?= $liste['conclusionAnalyse'] ?> </td>

              <td class="d-flex justify-content-around">


 <a href="<?= $_SESSION['url'] ?>analyseMatiere/<?= $liste['id_analyseMat'] ?>"><i class="fas fa-list-alt""  style="color: royalblue; font-size: 25px;cursor: pointer;" ></i></a>
 
                  <!-- <i onclick="defineId(<?= $liste['id_analyseMat'] ?>)" class="fas fa-minus-circle" style="color: red; font-size: 25px;cursor: pointer;"data-toggle="modal" data-target="#supprim" ></i>-->  
              </td>
               </tr>
             
       <?php ; } ?>
     
          </table>
        </div>
      </div>
    </div>
   <!--<div
      class="modal fade"
      id="supprim"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
       <form  method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="">Supprimer</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span>Vous voulez vraiment supprimer ?</span>
          </div>
          <div class="modal-footer mx-auto">
            <span id="supprimerMatiere"   class="btn btn-primary">SUPPRIMER</span> 
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Annuler
            </button>
          </div>
        </div>
         </form>
      </div>
    </div>   -->
 
  
<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
      var toggle = true;
     

     /******* analyse matieres    nabil ****/
 function defineId(id) {
        $('#supprimerMatiere').attr('onclick','supprimerAnalyseMatiere('+id+')');
    }
 
   function supprimerAnalyseMatiere(id){ 
      $.get("<?= $_SESSION['url'] ?>gestionMatiere/listeAnalyses/supprimer/"+id, function(data, status){
        window.location.reload(true);
      });
  }
/******* analyse matieres    nabil ****/
     
  
 


  
   
</script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>