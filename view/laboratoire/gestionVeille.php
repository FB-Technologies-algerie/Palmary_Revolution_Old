<?php $title="Gestion d'equipement" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
  <!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>
  
   
    <div class="card" style="width: 80%;margin: auto;margin-top: 100px">
      <div class="card-header">
        Tableau des actions
        <button 
          class="btn btn-primary float-right"
          data-toggle="modal"
          data-target="#action"  onclick="ajouterVeille()" 
        >
          Ajouter une Veille
        </button>
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
              <th>Nom veille</th>
              <th>Description de veille</th>
              <th>Date visite</th>
             
              <th style="width: 15%">Paramètres</th>
            </thead>

            
        <?php while ($site= $listeRetarderVeille->fetch()){ ?>
              <tr>
              <td>  <a target="_blank" href="<?=$site['lienVeille']?>" onclick="modifierVisite(<?= $site['id_veille'] ?>)" ><i class="fas fa-greater-than"></i>  <?= $site['nomVeille'] ?></a>
                
              </td>
              <td>  <?= $site['descriptionVeille'] ?> </td>
              <td>  <?= $site['dateVisite'] ?> </td>
              <td class="d-flex justify-content-around">
                <i  onclick="modifierVeille(<?= $site['id_veille'] ?>)" 
                  class="fas fa-pen"
                  style="color: royalblue;
                        font-size: 25px;cursor: pointer;"
                  data-toggle="modal"
                  data-target="#action"
                ></i>
                  <i onclick="defineId(<?= $site['id_veille'] ?>)" class="fas fa-minus-circle" style="color: red; font-size: 25px;cursor: pointer;"data-toggle="modal" data-target="#supprim" ></i>
                
              </td>
               </tr>
             
       <?php ; } ?>
       <?php while ($site= $listeAttanteVeille->fetch()){ ?>
              <tr>
              <td> <a target="_blank" href="<?=$site['lienVeille']?>"><?= $site['nomVeille'] ?></a>
              </td>
              <td>  <?= $site['descriptionVeille'] ?> </td>
              <td>  <?= $site['dateVisite'] ?> </td>
              <td class="d-flex justify-content-around">
                <i  onclick="modifierVeille(<?= $site['id_veille'] ?>)" 
                  class="fas fa-pen"
                  style="color: royalblue;
                        font-size: 25px;cursor: pointer;"
                  data-toggle="modal"
                  data-target="#action"
                ></i>
                  <i onclick="defineId(<?= $site['id_veille'] ?>)" class="fas fa-minus-circle" style="color: red; font-size: 25px;cursor: pointer;"data-toggle="modal" data-target="#supprim" ></i>
                
              </td>
               </tr>
             
       <?php ; 
} ?>

           
          </table>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="action"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
       
        <form method="post" action="" id="formVeille" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titre">Modal title</h5>
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
            
            <div class="row">
              <div class="col-md">
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Nom</label>
                  <div class="col-sm-9" style="align-self: center;"> 
                  
                   <input type="text" class="form-control detailVeille" name="nomVeille" id="nomVeille" />
                  </div>
                </div>
                <div class="form-group row">
                  
                  <label for="" class="col-sm-3 col-form-label">Lien</label>
                  <div class="col-sm-9" style="align-self: center;">
                    <input type="text" class="form-control detailVeille" id="lienVeille" name="lienVeille" placeholder="http://" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Description</label>
                  <div class="col-sm-9" style="align-self: center;">
            
                    <textarea id="descriptionVeille" name="descriptionVeille" class="form-control detailMatiere"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Date</label>
                  <div class="col-sm-9" style="align-self: center;">
                    <input type="date" class="form-control detailVeille" id="dateVisite" name="dateVisite" />
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Periode</label>
                  <div class="col-sm-9" style="align-self: center;">
                    <input type="number" class="form-control detailVeille" id="Periode" name="Periode" />
                  </div>
                </div>
                
              </div>
            </div>
           
          </div>
          <div class="modal-footer mx-auto">
            <input id="VeilleAjouter" type="submit" class="btn btn-primary w-auto" name="ajouterVeille"  value="VALIDER">
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
    </div>

    <div
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
            <span id="supprimerAction"   class="btn btn-primary">SUPPRIMER</span> 
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
    </div> 
<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
      var toggle = true;
     

/********/
        function defineId(id) {
        $('#supprimerAction').attr('onclick','supprimerVeille('+id+')');
    }
 
   function supprimerVeille(id){ 
      $.get("<?= $_SESSION['url'] ?>/VeilleSupprimer/"+id, function(data, status){
        window.location.reload(true);
      });
  }

  function modifierVeille(id_veille){ 
    $(".detailVeille").addClass("d-none");
    $.get("<?= $_SESSION['url'] ?>VeilleModifier/"+id_veille, function(data, status){
      var obj =JSON.parse(data);
     console.log(data);
      $('#nomVeille').val(obj.nomVeille); 
      $('#descriptionVeille').val(obj.descriptionVeille);
      $('#lienVeille').val(obj.lienVeille);
      $('#dateVisite').val(obj.dateVisite);
      $('#Periode').val(obj.periode);
      $('#titre').text('MODIFIER VEILLE');
      $('#VeilleAjouter').attr('name','modifierVeille');
     $('#formVeille').attr('action','<?= $_SESSION['url'] ?>VeilleModifier/'+obj.id_veille);
      $(".detailVeille").removeClass("d-none");
    });
 
  }
function modifierVisite(id_veille){
  $.get("<?= $_SESSION['url'] ?>VeilleModifierVisite/"+id_veille, function(data, status){
      window.location.reload(true);
    });
}

  function ajouterVeille(){
      $('#nomVeille').val('');
      $('#lienVeille').val('');
      $('#descriptionVeille').val('');
      $('#dateVisite').val('');
      $('#Periode').val('');
      $('#titre').text('AJOUTER VEILLE');
      $('#VeilleAjouter').attr('name','ajouterVeille'); 
      $('#formVeille').attr('action','#');
    }
   
</script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>