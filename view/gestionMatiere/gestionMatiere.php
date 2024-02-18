<?php $title="Gestion d'analyse" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
  <!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>
  
   
    <div class="card" style="width: 80%;margin: auto;margin-top: 100px">
      <div class="card-header">
        <span class="cardTitle">Liste des matieres premières</span>
        <button 
          class="btn btn-primary float-right"
          data-toggle="modal"
          data-target="#action"  onclick="ajouterMatiere()" 
        >
          <i class="fas fa-plus-circle"></i> MATIÈRE
        </button>
        <button data-toggle="modal"  data-target="#ajoutegroupe" onclick="ajoutGroupe()" class="btn btn-primary float-right mr-3 btnAlign"><i class="fas fa-plus-circle"></i> GROUPE</button>
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
              <th>Nom </th>
              <th>Fournisseur</th>
             
             
              <th style="width: 15%">Paramètres</th>
            </thead>
          </table>
          <div id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
              <?php while ($groupe = $listeGroupeMatiere->fetch()){ 
                  afficheGroupe($groupe);
               }
              ?>
            <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
              <?php
                while ($matiere= $listeMatiere->fetch()){ 
                  afficheMatiere($matiere);
               }
              ?>
            </table>
          </div>

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
       
        <form method="post" action="" id="formMatiere" enctype="multipart/form-data">
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
                  <div class="col-sm-8" style="align-self: center;"> 
                  
                   <input type="text" class="form-control detailMatiere" name="nomMatiere" id="nomMatiere" />
                  </div>
                </div>
                <div class="form-group row">
                  
                  <label for="" class="col-sm-3 col-form-label">Fournissuer</label>
                  <div class="col-sm-8" style="align-self: center;">
                    <input type="text" class="form-control detailMatiere" id="fournisseurMatiere" name="fournisseurMatiere"  />
                  </div>
                </div>
                  <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Cahier de charge</label>
                  <div class="col-sm-8" style="align-self: center;"> 
                   <div>
                  <div id="cahierCharge">
                      <div class="form-check" id="FILEcahierCharge">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienCahierCharge"
                        value="FILE"
                        id="fileCahierCharge"
                        onchange="toggleLien('cahierCharge')"
                      />
                      <label class="form-check-label" for="fileCahierCharge">
                        Importer un fichier
                        <input type="file" id="fichierCahierCharge" name="lienCahierCharge" class="fichier" />
                      </label>
                    </div>

                    <div class="form-check" id="LINKcahierCharge">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienCahierCharge"
                        value="LINK"
                        id="linkCahierCharge"
                        onchange="toggleFichier('cahierCharge')"
                      />
                      <label class="form-check-label" for="linkCahierCharge">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienCahierCharge"
                          name="lienCahierCharge"
                          placeholder="http://"
                        />
                      </label>
                    </div>
                    </div>
                  </div>    
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Fiche technique</label>
                  <div class="col-sm-8" style="align-self: center;"> 
                   <div>
                  <div id="ficheTechnique">
                      <div class="form-check" id="FILEficheTechnique">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienFicheTechnique"
                        value="FILE"
                        id="fileFicheTechnique"
                        onchange="toggleLien('ficheTechnique')"
                      />
                      <label class="form-check-label" for="fileFicheTechnique">
                        Importer un fichier
                        <input type="file" id="fichierFicheTechnique" name="lienFicheTechnique" class="fichier" />
                      </label>
                    </div>

                    <div class="form-check" id="LINKficheTechnique">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienFicheTechnique"
                        value="LINK"
                        id="linkFicheTechnique"
                        onchange="toggleFichier('ficheTechnique')"
                      />
                      <label class="form-check-label" for="linkFicheTechnique">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienFicheTechnique"
                          name="lienFicheTechnique"
                          placeholder="http://"
                        />
                      </label>
                    </div>
                    </div>
                  </div>
                 </div>
                </div>
                 <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">model de bulletin d'analyse</label>
                  <div class="col-sm-8" style="align-self: center;"> 
                   <div>
                  <div id="bulletin">
                      <div class="form-check" id="FILEbulletin">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienBulletin"
                        value="FILE"
                        id="fileBulletin"
                        onchange="toggleLien('bulletin')"
                      />
                      <label class="form-check-label" for="fileBulletin">
                        Importer un fichier
                        <input type="file" id="fichierBulletin" name="lienBulletin" class="fichier" />
                      </label>
                    </div>

                    <div class="form-check" id="LINKbulletin">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienBulletin"
                        value="LINK"
                        id="linkBulletin"
                        onchange="toggleFichier('bulletin')"
                      />
                      <label class="form-check-label" for="linkBulletin">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienBulletin"
                          name="lienBulletin"
                          placeholder="http://"
                        />
                      </label>
                    </div>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Description</label>
                  <div class="col-sm-8" style="align-self: center;">
                  <textarea id="descriptioncMatiere" name="descriptioncMatiere" class="form-control detailMatiere"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Groupe</label>
                    <div class="col-sm-8">
                        <select id= "idGroupeMatiere" name="idGroupeMatiere" class="selectNormeForm custom-select custom-select-lg">
                            <option value="null" >Aucun groupe</option>
                          <?php foreach ($listeToutGroupe as $groupe) { ?>
                            <option value="<?= $groupe->id_groupe_mat ?>" ><?= $groupe->nomGroupeMat ?></option>
                          <?php } ?>
                        </select>
                    </div>
                </div>
              </div>
            </div>
           
          </div>
          <div class="modal-footer mx-auto">
            <input id="matiereAjouter" type="submit" class="btn btn-primary w-auto" name="ajouterMatiere"  value="VALIDER">
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
            <span id="btnSupprimer"   class="btn btn-primary">SUPPRIMER</span> 
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

    <div class="modal fade" id="ajoutegroupe" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog " style="width: 700px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">AJOUTER GROUPE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formGroupe" method="post" action="">
                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Nom du groupe</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="nomGroupe" name="nomGroupe" class="form-control"  placeholder="">
                                    </div>
                            </div>
                    <div class="form-group row">
                                    <label  class="col-sm-4 col-form-label">Discription du groupe</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="DescGroupe" name="DescGroupe" class="form-control" placeholder="">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label  class="col-sm-4 col-form-label">Groupe parent</label>
                                    <div class="col-sm-8">
                                      <select id="groupeParent" name="idGroupeParent" class="selectNormeForm custom-select custom-select-lg">
                                          <option value="null" >Aucun groupe</option>
                                        <?php foreach ($listeToutGroupe as $groupe) { ?>
                                          <option value="<?= $groupe->id_groupe_mat ?>" ><?= $groupe->nomGroupeMat ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                            </div>
                    
                    <div class="modal-footer d-block mx-auto text-center">
                    <input type="submit" class="btn btn-primary w-auto" id="submitGroupe" name="ajouterGroupe" value="VALIDER">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
            </form>
          </div>
          <div class="modal-footer mx-auto"> 
          </div>
        </div>
      </div>
    </div>

<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
      var toggle = true;
     

/********/
        function defineId(id) {
        $('#btnSupprimer').attr('onclick','supprimerMatiere('+id+')');
    }
 
  function supprimerMatiere(id){  
    
      $.get("<?= $_SESSION['url'] ?>gestionMatiere/matiereSupprimer/"+id, function(data, status){
           console.log(data);
       window.location.reload(true);
      });
  }

  function supprimerGroupeMatiere(id){ 
      $('#btnSupprimer').attr('onclick','confirmSupprGroupeMatiere('+id+')');
  }

  function confirmSupprGroupeMatiere(id){ 
      $.get("<?= $_SESSION['url'] ?>gestionMatiere/GroupeMatiereSupprimer/"+id, function(data, status){
        window.location.reload(true);
      });
  }

  function modifierMatiere(id_matiere){ 
    $(".detailMatiere").addClass("d-none");
    $.get("<?= $_SESSION['url'] ?>gestionMatiere/detailMatiere/"+id_matiere, function(data, status){
      var obj =JSON.parse(data);
      $('#nomMatiere').val(obj.nomMatiere); 
      $('#descriptioncMatiere').val(obj.descriptioncMatiere);
      $('#fournisseurMatiere').val(obj.fournisseurMatiere);

      $('#idGroupeMatiere').val(""+obj.idGroupeMatiere+""); 
      $('#titre').text('MODIFIER MATIERE');
      $('#matiereAjouter').attr('name','modifierMatiere');
      $('#formMatiere').attr('action','<?= $_SESSION['url'] ?>gestionMatiere/detailMatiere/'+obj.id_matiere);

      if(obj.cahierCharge!=null){
        cahierCharge= obj.cahierCharge.split('!:!');
        $('#'+cahierCharge[0]+'cahierCharge input[name="typeLienCahierCharge"]').attr('checked','checked');
        $('#'+cahierCharge[0]+'cahierCharge input[name="lienCahierCharge"]').attr('value',cahierCharge[1]);
        if(cahierCharge[0]=='FILE') toggleLien('cahierCharge');
         else if(cahierCharge[0]=='LINK') toggleFichier('cahierCharge');
      }

      if(obj.ficheTechnique!=null){
        ficheTechnique= obj.ficheTechnique.split('!:!');
        $('#'+ficheTechnique[0]+'ficheTechnique input[name="typeLienFicheTechnique"]').attr('checked','checked');
        $('#'+ficheTechnique[0]+'ficheTechnique input[name="lienFicheTechnique"]').attr('value',ficheTechnique[1]);
        if(ficheTechnique[0]=='FILE') toggleLien('ficheTechnique');
         else if(ficheTechnique[0]=='LINK') toggleFichier('ficheTechnique');
      }

      if(obj.bulletinVierge!=null){
        bulletin= obj.bulletinVierge.split('!:!');
        $('#'+bulletin[0]+'bulletin input[name="typeLienBulletin"]').attr('checked','checked');
        $('#'+bulletin[0]+'bulletin input[name="lienBulletin"]').attr('value',bulletin[1]);
        if(bulletin[0]=='FILE') toggleLien('bulletin');
         else if(bulletin[0]=='LINK') toggleFichier('bulletin');
      }

      $(".detailMatiere").removeClass("d-none");
    });
 
  }
function modifierVisite(id_veille){
  $.get("<?= $_SESSION['url'] ?>MatiereModifierVisite/"+id_veille, function(data, status){
      window.location.reload(true);
    });
}

  function ajouterMatiere(){
      
      $('.modal-body input:not([type=radio],[type=checkbox],[type=submit])').val('');
      $('.modal-body #descriptioncMatiere').val('');
      $('.modal-body #idGroupeMatiere').val('null');

      $('#titre').text('AJOUTER MATIERE');
      $('#matiereAjouter').attr('name','ajouterMatiere'); 
      $('#formMatiere').attr('action','#');
    }
   

      function toggleLien(className){
        $('#'+className+" .lien").prop("disabled", true)
        $('#'+className+" .fichier").prop("disabled", false)

      }

      function toggleFichier(className){
        $('#'+className+" .fichier").prop("disabled", true);
        $('#'+className+" .lien").prop("disabled", false);
      }

      function ajoutGroupe(){
         $('#formGroupe').attr('action','');
         $('#exampleModalLabel').text('AJOUTER GROUPE');
        $('#submitGroupe').attr('value','VALIDER');
        $('#submitGroupe').attr('name','ajouterGroupe');
        $('#nomGroupe').val('');
        $('#DescGroupe').val('');
         $('#groupeParent option').removeAttr('disabled');
      }

      function modifGroupe(idGroupe,nomGroupe,descGroupe,groupeParent) { 
         $('#formGroupe').attr('action','<?= $_SESSION['url'] ?>gestionMatiere/detailGroupe/'+idGroupe);
         $('#exampleModalLabel').text('MODIFIER GROUPE');
        $('#submitGroupe').attr('value','MODIFIER');
        $('#submitGroupe').attr('name','modiferGroupe');
        $('#nomGroupe').val(nomGroupe);
        $('#DescGroupe').val(descGroupe);
        groupeParent= (groupeParent!='')?groupeParent : 'null';
        $('#groupeParent').val(""+groupeParent+""); 
        if ( idGroupe!='null') {
          $('#groupeParent option').removeAttr('disabled');
          $('#groupeParent option[value="'+idGroupe+'"]').attr("disabled", true);
        }
        
      
        //$(".detailGroupe").removeClass("d-none");
      }

</script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>

<?php 
/******* analyse metieres    nabil ****/
      function afficheMatiere($matiere){ ?>
          <tr>
            <td><a><?= $matiere['nomMatiere'] ?></a></td>
            <td><?= $matiere['fournisseurMatiere'] ?></td>
              
            <td class="d-flex justify-content-around">
             <?php  if ($_SESSION['type']=='laboratoire') {  ?>
              <a href="<?= $_SESSION['url'] ?>gestionMatiere/listeAnalyses/<?= $matiere['id_matiere'] ?>"><i  class="fas fa-tasks"></i></a>
             <?php }  ?>
             <a href="<?= $_SESSION['url'] ?>gestionMatiere/detailMatiere/<?= $matiere['id_matiere'] ?>"><i  class="fas fa-pen"></i></a>

              <i onclick="defineId(<?= $matiere['id_matiere'] ?>)" class="fas fa-minus-circle" style="color: red; font-size: 25px;cursor: pointer;"data-toggle="modal" data-target="#supprim" ></i>   
            </td>
          </tr>
<?php }/******* analyse metieres    nabil ****/

  function afficheGroupe($groupeMat,$sousGrp=false){
    $listeGroupe = listeGroupeMatiere($groupeMat['id_groupe_mat']);
    $listeMatiereG= listeMatiereGroupe($groupeMat['id_groupe_mat']);
  ?>
    <div class="card <?=($sousGrp)?'m-2':'m-0 mb-2' ?> firstCard" style="border:#333 solid 1px;border-radius: 5px">
      <div class="card-header textTab" style="background-color:#333;color:white;padding-right: 0px">
        <a href="#" data-toggle="modal" data-target="#ajoutegroupe" class="text-white"
          onclick="modifGroupe(<?= $groupeMat['id_groupe_mat'].",'".$groupeMat['nomGroupeMat']."','".$groupeMat['descriptionGroupe']."','".$groupeMat['id_groupeParent']."'" ?>)">
          <?= $groupeMat['nomGroupeMat'] ?>
        </a>
        <div class="float-right" style="width: 10%;text-align: left;color: white">
          <a href="" onclick="supprimerGroupeMatiere(<?= $groupeMat['id_groupe_mat'] ?>)"  data-toggle="modal" data-target="#supprim"> <i class="fas fa-minus-circle"  style="color:rgb(190, 190, 190);" ></i></a>
        </div>
      </div>

      <div class="card-body p-0">
        <?php while ($groupe= $listeGroupe->fetch()){
          afficheGroupe($groupe,true);
        } ?>

        <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
          <?php while ($matiere= $listeMatiereG->fetch()){
            afficheMatiere($matiere);
          } ?>
        </table>
      </div>
    </div>
  
  <?php }