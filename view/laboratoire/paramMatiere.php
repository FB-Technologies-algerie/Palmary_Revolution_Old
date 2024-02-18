<?php $title="modification du produit" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>

    <h1 class="display-block mt-3 display-5 text-white" style="text-align: center;"><?= $detailMatiere['nomMatiere'] ?></h1>

    <div class="card">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">MATIERE</span></div>
        <div class="card-body">
          <form action="" enctype="multipart/form-data" method="post">             
            <div class="row">
              <div class="col-md">
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Nom</label>
                  <div class="col-sm-9" style="align-self: center;"> 
                   <span class="detailMatiere"><?= $detailMatiere['nomMatiere'] ?></span>
                   <input type="text" class="form-control inputMatiere d-none" name="nomMatiere" id="nomMatiere" value="<?= $detailMatiere['nomMatiere'] ?>" />    
                  </div>
                </div>
                <div class="form-group row">
                  
                  <label for="" class="col-sm-3 col-form-label">Fournisseur</label>
                  <div class="col-sm-9" style="align-self: center;">
                    <span class="detailMatiere"><?= $detailMatiere['fournisseurMatiere'] ?></span>
                    <input type="text" class="form-control inputMatiere d-none" id="fournisseurMatiere" name="fournisseurMatiere" value="<?= $detailMatiere['fournisseurMatiere'] ?>"  />
                  </div>
                </div>
                  <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Cahier de charge</label>
                  <div class="col-sm-9" style="align-self: center;"> 
                   <span class="detailMatiere">
                  <?php if($detailMatiere['cahierCharge']['lien']!=''){ ?>
                    <a  target="_blank"
                        href="<?= ($detailMatiere['cahierCharge']['type']=='FILE')
                          ? $_SESSION['url'].'telecharger/CahierCharge/'.$id_matiere 
                          : $detailMatiere['cahierCharge']['lien'];?>"
                    />
                      ouvrir le cahier de charge 
                    </a>
                  <?php }else{ ?>
                    aucun fichier
                  <?php } ?>
                  </span>
                   <div class="inputMatiere d-none">
                  <div id="cahierCharge">
                      <div class="form-check" id="FILEcahierCahrge">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienCahierCharge"
                        value="FILE"
                        id="fileCahierCharge"
                        <?= ($detailMatiere['cahierCharge']['type']=='FILE')?'checked':'' ?>
                        onchange="toggleLien('cahierCharge')"
                      />
                      <label class="form-check-label" for="fileCahierCharge">
                        Importer un fichier
                        <input type="file" id="fichierCahierCharge" name="lienCahierCharge" class="fichier"
                          <?= ($detailMatiere['cahierCharge']['type']!='FILE')?'disabled':'' ?>
                         />
                      </label>
                    </div>

                    <div class="form-check" id="LINKcahierCharge">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienCahierCharge"
                        value="LINK"
                        id="linkCahierCharge"
                        <?= ($detailMatiere['cahierCharge']['type']=='LINK')?'checked':'' ?>
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
                          <?= ($detailMatiere['cahierCharge']['type']!='LINK')?'disabled':'value="'.$detailMatiere['cahierCharge']['lien'].'"' ?>
                        />
                      </label>
                    </div>
                    </div>
                  </div>    
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Fiche technique</label>
                  <div class="col-sm-9" style="align-self: center;"> 
                   <span class="detailMatiere">
                  <?php if($detailMatiere['ficheTechnique']['lien']!=''){ ?>
                    <a  target="_blank"
                        href="<?= ($detailMatiere['ficheTechnique']['type']=='FILE')
                          ? $_SESSION['url'].'telecharger/FicheTechnique/'.$id_matiere 
                          : $detailMatiere['ficheTechnique']['lien'];?>"
                    />
                      ouvrir la fiche technique 
                    </a>
                  <?php }else{ ?>
                    aucun fichier
                  <?php } ?>
                  </span>
                   <div class="inputMatiere d-none">
                  <div id="ficheTechnique">
                      <div class="form-check" id="FILEficheTechnique">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienFicheTechnique"
                        value="FILE"
                        id="fileFicheTechnique"
                        <?= ($detailMatiere['ficheTechnique']['type']=='FILE')?'checked':'' ?>
                        onchange="toggleLien('ficheTechnique')"
                      />
                      <label class="form-check-label" for="fileFicheTechnique">
                        Importer un fichier
                        <input type="file" id="fichierFicheTechnique" name="lienFicheTechnique" class="fichier"
                          <?= ($detailMatiere['ficheTechnique']['type']!='FILE')?'disabled':'' ?>
                         />
                      </label>
                    </div>

                    <div class="form-check" id="LINKficheTechnique">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienFicheTechnique"
                        value="LINK"
                        id="linkFicheTechnique"
                        <?= ($detailMatiere['ficheTechnique']['type']=='LINK')?'checked':'' ?>
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
                          <?= ($detailMatiere['ficheTechnique']['type']!='LINK')?'disabled':'value="'.$detailMatiere['ficheTechnique']['lien'].'"' ?>
                        />
                      </label>
                    </div>
                    </div>
                  </div>
                 </div>
                </div>
                 <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">model de bulletin d'analyse</label>
                  <div class="col-sm-9" style="align-self: center;"> 
                   <span class="detailMatiere">
                  <?php if($detailMatiere['bulletinVierge']['lien']!=''){ ?>
                    <a  target="_blank"
                        href="<?= ($detailMatiere['bulletinVierge']['type']=='FILE')
                          ? $_SESSION['url'].'telecharger/Bulletin/'.$id_matiere 
                          : $detailMatiere['bulletinVierge']['lien'];?>"
                    />
                      ouvrir le model 
                    </a>
                  <?php }else{ ?>
                    aucun fichier
                  <?php } ?>
                   </span>
                   <div class="inputMatiere d-none">
                  <div id="bulletin">
                      <div class="form-check" id="FILEbulletin">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienBulletin"
                        value="FILE"
                        id="fileBulletin"
                        <?= ($detailMatiere['bulletinVierge']['type']=='FILE')?'checked':'' ?>
                        onchange="toggleLien('bulletin')"
                      />
                      <label class="form-check-label" for="fileBulletin">
                        Importer un fichier
                        <input type="file" id="fichierBulletin" name="lienBulletin" class="fichier"
                          <?= ($detailMatiere['bulletinVierge']['type']!='FILE')?'disabled':'' ?>
                        />
                      </label>
                    </div>

                    <div class="form-check" id="LINKbulletin">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienBulletin"
                        value="LINK"
                        id="linkBulletin"
                        <?= ($detailMatiere['bulletinVierge']['type']=='LINK')?'checked':'' ?>
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
                          <?= ($detailMatiere['bulletinVierge']['type']!='LINK')?'disabled':'value="'.$detailMatiere['bulletinVierge']['lien'].'"' ?>
                        />
                      </label>
                    </div>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Description</label>
                  <div class="col-sm-9" style="align-self: center;">
                  <textarea disabled id="descriptioncMatiere" name="descriptioncMatiere" class="form-control inputDetailMatiere"><?= $detailMatiere['descriptioncMatiere'] ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-3 col-form-label">Groupe</label>
                    <div class="col-sm-9">
                        <select disabled id="idGroupeMatiere" name="idGroupeMatiere" class="inputDetailMatiere custom-select custom-select-lg">
                            <option value="null" selected>Aucun groupe</option>
                          <?php foreach ($listeToutGroupe as $groupe) { ?>
                            <option
                              value="<?= $groupe->id_groupe_mat ?>"
                              <?= ($groupe->id_groupe_mat==$detailMatiere['idGroupeMatiere'])?'selected':'' ?>
                            ><?= $groupe->nomGroupeMat ?></option>
                          <?php  } ?>
                        </select>
                    </div>
                </div>
              </div>
            </div>
          <div class=" text-center">
            <hr>
            <input type="button" id="btnModif" onclick="activeModif()" name="modifierMatiere" class="btn btn-primary" value="MODIFIER">
            <button onclick="annulModif()" class="btn btn-secondary ml-3 inputMatiere d-none">ANNULER</button>
          </div>
          </form> 
        </div>
    </div>
    
    <div class="card">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
         <span class="cardTitle" >GESTION DES PARAMETRES</span> 
          <a href="#" data-toggle="modal"  data-target="#ajoutModif" class="btn btn-primary float-right mt-2 ml-3 btnAlign" onclick="ajouterParametre()"><i class="fas fa-plus-circle" ></i> PARAMETRE</a>
          
      </div>
      <div class="card-body pt-1">
 


 <div class="table-responsive">
            <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0" >
              <thead class="w-100">
                <tr>
                  <th style="width: 20%">Nom</th>
                 <th style="width: 15%">Description</th>
                  <th style="width:10%;text-align:center;">Supprimer</th>

                </tr>
                 <?php while ($liste= $ListeParametreMatiere->fetch()){ ?>
              <tr>
              <td><a href="#" data-toggle="modal"  data-target="#modifParametre" onclick="ModifierParametre(<?= $liste['id_matiere'] ?>,<?= $liste['id_paramAnal'] ?>)" ><?= $liste['nomParamAnal'] ?></a></td>
              <td>  <?= $liste['descriptionParamMat'] ?> </td>  

              <td class="d-flex justify-content-around">
                  <i  class="fas fa-minus-circle" style="color: red; font-size: 25px;cursor: pointer;"data-toggle="modal" data-target="#supprim" onclick="supprimerParametre(<?= $liste['id_paramMat'] ?>)" ></i>  
              </td>
               </tr>
             
       <?php ; } ?>
              </thead>
            </table>

            </div>

    </div>
        </div>



        </div>
    </div>


   
    <!--Modal SUPPRIMER NORME-->
    <div class="modal fade" id="supprim" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="titleGroup">Suppression d'une norme</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p id="textGroup" style="font-size:20px;">Vous voulez vraiement supprimer ce paramètre ?</p>
                </div>
                <div class="modal-footer mx-auto">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirmSup" >Confirmer</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>  
                </div>
              </div>
            </div>
          </div>

        

          
           <!--Modal Ajout/modif NORME-->
    <div class="modal fade" id="ajoutModif" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm" style="max-width: 600px !important">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">PARAMÈTRE MATIÈRE</h5>
            <button type="button" class="close   Modal" onclick="refresh();" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                   <form method="post" id="formEquipement" action="" style="clear: both;">
                      <div id="LDP_modif" class="row"> 
                      <div  class="col-4">Paramètre</div>
                           <div class="col-8">
                                      <select required  id="id_paramAnal" name="id_paramAnal" class="selectNormeForm custom-select modif d-none" >
                                      <option selected value="" >Selectionner un paramètre </option>  
                                      <?php while ($groupe= $listeParametreAnalyse->fetch()){ ?>
                                       <option value="<?= $groupe['id_paramAnal'] ?>" ><?= $groupe['nomParamAnal'] ?></option>
                                      <?php } ?>

                                      </select>


                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Nom de version</div>
                            
                            <div class="col-8">
                                      <input type="text" id="nomVersion" name="nomVersion" class="form-control modif d-none" placeholder="">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Date de version</div>
                            
                            
                            <div class="col-8">
                                      <input type="date" id="datePicker1"" name="dateVersion" class="form-control modif d-none" placeholder="">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Norme</div>
                            
                            <div class="col-8">
                                      <input type="text" id="normeParam" name="normeParam" class="form-control modif d-none" placeholder="">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Utilisation</div>
                            
                            <div class="col-12 modif d-none" id="formule">
                              
                              <div style="display: inline;cursor: pointer;color: #007bff;font-size: 30px;"  onclick="addFormule(this)">
                                <i class="fas fa-plus-circle"></i>
                              </div> 
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Unité</div>
                            
                          
                            <div class="col-8">
                                      <input type="text" id="uniteParam" name="uniteParam" class="form-control modif d-none" placeholder="">
                            </div>
                    </div>
                    <br>
                   <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Description</div>
                            
                          
                            <div class="col-8">
                                      <textarea type="text" id="descriptionParamMat" name="descriptionParamMat" class="form-control modif d-none" placeholder=""
                                      ></textarea>
                            </div>
                    </div>
                    <br>
                     
                    <div class="modal-footer d-block text-center">       
                     <input id="submitBtn" type="submit" onclick="modifEquipment()" class="btn btn-primary" name="modifer" style="width:auto !important;margin-left: auto;" value="MODIFIER">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
                  </form>
          </div>
        </div>
      </div>
    </div>


 <div class="modal hide fade closeModal" id="modifParametre" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">PARAMÈTRE MATIÈRE</h5>
            <button type="button" class="close   Modal"  data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         
            <div class="modal-body">
              
            <div class="btn-group dropleft float-right mb-4">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Version
            </button>
            <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Ajouter une nouvelle version</a>
                  <a class="dropdown-item" href="#">Version 1</a>
                  <a class="dropdown-item" href="#">Version 2</a>
            </div>
          </div>
      <iframe id= "frameParametre" src="" height="400" frameborder="0" class="w-100" ></iframe>
 
        </div>
      </div>
    </div>


     

<script>
  function activeModif(){
    if($("#btnModif").val()=='MODIFIER'){
      $("#btnModif").val('VALIDER');
      $('.inputMatiere').removeClass("d-none");
      $('.detailMatiere').addClass("d-none");
      $('.inputDetailMatiere').removeAttr('disabled');
    }else{
      $("#btnModif").attr('type','submit');
    }
  }

  function removeFormule(val){
    val.parentElement.remove()
  }

    var i= 0; /* modifier nabil */
  function addFormule(val){  
        val.insertAdjacentHTML('beforebegin', `
           <div class="row" style="padding:15px 0 0 0" >
                                <div class="col-7" style="padding-right: 0">
                                   <select onchange="changeUnite(`+i+`)" id="selectFormule`+i+`" name="reactif`+i+`" class=" custom-select" >
                                      <option selected value="" >Selectionner un réactif</option>
                                        <?php while ($groupe= $ReactifParametre->fetch()){ ?>
                                        <option unite="<?= $groupe['uniteReactif']?>" value="<?= $groupe['id_reactif'] ?>" ><?= $groupe['nomReactif'] ?></option>
                                      <?php } ?>
                                      </select>
                                </div>
                                <div class="col-4" style="padding-left: 0">
                                  <div class="input-group ">
                                  <input type="number" name="valReactif`+i+`" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="id_Unite`+i+`">Unité</span>
                                  </div>
                                </div>
                                </div>
                                <div class="col-1 p-0" style="align-self: center;" onclick="removeFormule(this)">
                                  <i style="font-size: 30px" class="fas fa-minus-circle"></i>
                                </div>
                              </div>
          `);

        i++;
  }

function changeUnite(i){
//console.log($("#selectFormule"+i+" option:selected").attr('unite'));
var test = $("#selectFormule"+i+" option:selected").attr('unite');
 $("#id_Unite"+i).text(test);
}
/* modifier nabil */


    document.getElementById('datePicker1').valueAsDate = new Date();

   function modifEquipment(){
  if($('#submitBtn').attr('value')=='MODIFIER'){
      $(".detail").addClass("d-none");
      $(".modif").removeClass("d-none");
      $('#submitBtn').attr('value','VALIDER');
      $('#submitBtn').attr('type','submit');
    }else{
      var listFormule = document.getElementById('formule');
      var strFormule ='';
      for (var i = 0; i < listFormule.getElementsByClassName('row').length; i++) {
        strFormule += listFormule.getElementsByTagName('select')[i].options[listFormule.getElementsByTagName('select')[i].selectedIndex].value+"@"+listFormule.getElementsByTagName('input')[i].value+"!@!";
      }
       console.log(strFormule)

   
    }

  }
  function ajouterParametre(){
      $(".detail").addClass("d-none");
      $(".modif").removeClass("d-none"); 
      $('#submitBtn').attr('value','AJOUTER');
      $('#submitBtn').attr('name','ajouterParametreAnalyse');
  }
  function ModifierParametre(id_matiere,id_paramAnal){ 

    $('.dropdown-item').remove();
    $.get("<?= $_SESSION['url'] ?>gestionMatiere/listeVersionParam/"+id_matiere+"/"+id_paramAnal, function(data, status){
        console.log(data);
      var obj =JSON.parse(data);
      console.log(obj);
      var mySelect = $('.dropdown-menu');
      var paramMat;
     $.each(obj, function(i, obj) {
       mySelect.append(
         $('<a class="dropdown-item" ></a>').attr('onclick','detailVersion('+id_matiere+','+obj.id_paramMat+')').html(obj.nomVersion)
        );
        paramMat  = obj.id_paramMat;
    });

    detailVersion(id_matiere,paramMat);
    
    });

  }

  function  detailVersion(id_matiere,id_paramMat){
   $('#frameParametre').attr('src',"<?= $_SESSION['url'] ?>gestionMatiere/detailVersionParam/"+id_matiere+"/"+id_paramMat);

  }
 function supprimerParametre(id){ 
      $('#confirmSup').attr('onclick','confirmSupprParametre('+id+')');
  }

  function confirmSupprParametre(id){ 
      $.get("<?= $_SESSION['url'] ?>gestionMatiere/parametreMatiereSupprimer/"+id, function(data, status){
        window.location.reload(true);
      });
  }

  function toggleLien(className){
    $('#'+className+" .lien").prop("disabled", true)
    $('#'+className+" .fichier").prop("disabled", false)
  }

  function toggleFichier(className){
    $('#'+className+" .fichier").prop("disabled", true);
    $('#'+className+" .lien").prop("disabled", false);
  }



</script>


<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>


