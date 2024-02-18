<?php $title="modification de arrivage" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>

    <h1 class="display-block mt-3 display-5 text-white" style="text-align: center;"><?= $detailArrivage['nomMatiere'].' - '.$detailArrivage['fournisseurMatiere'] ?></h1>

    <div class="card">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">ARRIVAGE</span></div>
        <div class="card-body">
          <form action="" enctype="multipart/form-data" method="post">             
            <div class="row">
              <div class="col-md">
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Matière</label>
                  <div class="col-sm-9" style="align-self: center;"> 
                   <span class="detailArrivage"><?= $detailArrivage['nomMatiere'].' ⟾ '.$detailArrivage['fournisseurMatiere'] ?></span>
                      <select onchange ="listMatiere(this.value)" name="GroupeEqu" class="selectNormeForm custom-select custom-select-lg  d-none">
                          <option selected value="null" >Selectionner une matière</option>
                        <?php while ($groupe= $listeGroupeMatiere->fetch()){ ?>
                          <option value="<?= $groupe['idGroupeMatiere'] ?>" ><?= afficheGroupe($groupe['idGroupeMatiere'],null)?></option>
                        <?php } ?>
                          <option value="-1" >Autre</option>
                      </select>
                  </div>
                </div>
                <div class="form-group row inputMatiere d-none">
                  
                  <label for="" class="col-sm-3 col-form-label">Fournisseur matière</label>
                  <div class="col-sm-9" style="align-self: center;">
                     <select required name="groupeMatiere" id="groupeMatiere" class="selectNormeForm custom-select custom-select-lg ">
                     <option selected value="<?= $detailArrivage['id_matiere'] ?>" ><?= $detailArrivage['nomMatiere'].' ⟾ '.$detailArrivage['fournisseurMatiere'] ?></option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Qauntité</label>
                  <div class="col-sm-9" style="align-self: center;">
                   <input disabled id="quantite" name="quantite" class="form-control inputdetailArrivage" value="<?= $detailArrivage['quantite'] ?>">
                  </div>
                   
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">N° Lot</label>
                  <div class="col-sm-9" style="align-self: center;">
                   <input disabled id="numLot" name="numLot" class="form-control inputdetailArrivage" value="<?= $detailArrivage['numLot'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Date arrivage</label>
                  <div class="col-sm-9" style="align-self: center;">
                   <input disabled id="dateArrivage" name="dateArrivage" type ="date" class="form-control inputdetailArrivage" value="<?= $detailArrivage['dateArrivage'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Date fabrication</label>
                  <div class="col-sm-9" style="align-self: center;">
                   <input disabled id="dateFabrication" type ="date" name="dateFabrication" class="form-control inputdetailArrivage" value="<?= $detailArrivage['dateFabrication'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Date peremption</label>
                  <div class="col-sm-9" style="align-self: center;">
                   <input disabled id="datePeremption" type ="date" name="datePeremption" class="form-control inputdetailArrivage" value="<?= $detailArrivage['datePeremption'] ?>">
                  </div>
                </div>
              </div>
            </div>
          <div class=" text-center">
            <hr>
            <input type="button" id="btnModif" onclick="activeModif()" name="modifierArrivage" class="btn btn-primary" value="MODIFIER">
            <button onclick="annulModif()" class="btn btn-secondary ml-3 inputMatiere d-none">ANNULER</button>
          </div>
          </form> 
        </div>
    </div>


<div class="card" style="width: 80%;margin: auto;margin-top: 100px">
      <div class="card-header">
        liste des analyses de l'arrivage
        <button 
          class="btn btn-primary float-right"
          data-toggle="modal"
          data-target="#action" 
        >
          Ajouter une Analyse
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
               <th>Etat</th>
              <th>Date de prelevement</th>
              <th>Date Fin</th>
               <th>conclusion Analyse</th>
              <th style="width: 15%">Paramètres</th>
            </thead>

     
        <?php while ($liste= $listeAnalyseMatiere->fetch()){ ?>
              <tr>
               <?php if ( $liste['etatAnalyse'] =="En attente"){ ?>    
                            <td title="En attente" style="color:orange;text-align: center;">
                              <i class="fas fa-hourglass-end"></i>
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
                           
                           else{ ?>    
                           <td title="valider" style="color:green;text-align: center;">
                              <i class="fas fa-check-circle"></i>
                        <?php } ?>

              <td>  <?= $liste['datePrelevement'] ?> </td>
              <td>  <?= $liste['dateFin'] ?> </td>
              <td>  <?= $liste['conclusionAnalyse'] ?> </td>

              <td class="d-flex justify-content-around">
                <i onclick="detailAnalyse(<?= $liste['id_analyseMat'] ?>)" class="fas fa-list-alt" style="color: royalblue; font-size: 25px;cursor: pointer;" data-toggle="modal" data-target="#detailAnalyse" ></i>
                <i onclick="defineId(<?= $liste['id_analyseMat'] ?>)" class="fas fa-minus-circle" style="color: red; font-size: 25px;cursor: pointer;"data-toggle="modal" data-target="#supprim" ></i>  
              </td>
               </tr>
             
       <?php ; } ?>
     
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
      <div class="modal-dialog modal-lg" role="document" style="width: 600px;">
       
        <form method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titre">Nouvelle analyse</h5>
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
               
                    
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Date de prélèvement</div>
                            <div class="col-8">
                              <input type="date" id="datePrelevement"  name="datePrelevement" class="form-control" placeholder="" value="">
                            </div>
                    </div>
              </div>  
            </div>
           
          </div>
          <div class="modal-footer mx-auto">
            <input type="submit" class="btn btn-primary w-auto" name="ajouterAnalyse"  value="VALIDER">
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
      id="detailAnalyse"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document" style="width: 2000px;">
       
        <form method="post" action="">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titre">Detail analyse</h5>
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
             <iframe id= "frameParametreAnalyse" src="" height="400" frameborder="0" class="w-100" ></iframe>
           
          </div>
        </div>
         </form>
      </div>
    </div>


    <div class="modal fade" id="supprim" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="titleGroup">Suppression d'analyse</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p id="textGroup" style="font-size:20px;">Voulez-vous vraiment supprimer cette analyse ?</p>
                </div>
                <div class="modal-footer mx-auto">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirmSup" >Confirmer</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>  
                </div>
              </div>
            </div>
          </div>
   </div>  
 

<script type="text/javascript">

  document.getElementById('datePrelevement').valueAsDate = new Date();
  function activeModif(){
    if($("#btnModif").val()=='MODIFIER'){
      $("#btnModif").val('VALIDER');
      $('.inputMatiere').removeClass("d-none");
      $('.selectNormeForm').removeClass("d-none");
      $('.detailArrivage').addClass("d-none");
      $('.inputdetailArrivage').removeAttr('disabled');
    }else{
      $("#btnModif").attr('type','submit');
    }
  }
function listMatiere(id_groupe_mat) {  
     
         $.get("<?= $_SESSION['url'] ?>listMatiere/"+id_groupe_mat, function(data, status){
        var obj =JSON.parse(data);
        console.log(data);
        var mySelect = $('#groupeMatiere');
         mySelect.find('option').remove();
         $.each(obj, function(i, obj) {
          mySelect.append('<option value="'+obj.id_matiere+'">'+obj.nomMatiere+' ⟾ '+obj.fournisseurMatiere+'</option>');
          });     
       
      }); 
      
      
 }

 function defineId(id){ 
      $('#confirmSup').attr('onclick','confirmSupprAnalyse('+id+')');
  }

  function confirmSupprAnalyse(id){ 
      $.get("<?= $_SESSION['url'] ?>analyseSupprimer/"+id, function(data, status){
        window.location.reload(true);
      });
  }

  
function detailAnalyse(id_analyseMat) {
     $('#frameParametreAnalyse').attr('src',"<?= $_SESSION['url'] ?>analyseMatiere/"+id_analyseMat);

    /*  $.get("<?= $_SESSION['url'] ?>analyseMatiere/"+id_analyseMat, function(data, status){
        var obj =JSON.parse(data);
        $('#datePrele').text(obj.datePrelevement);
        $('#etatAnalyse').text(obj.etatAnalyse);
        $('#conclusionAnalyse').text(obj.conclusionAnalyse);
      //  $('#GroupeEquipe').val(obj.idGroupeEquipement);
        
        
      });
  */
  }
  
</script>


<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>


