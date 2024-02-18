<?php $title="modification du produit" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>

    <h1 class="display-block mt-3 display-5 text-white" style="text-align: center;"><?= $prod['nomProd'] ?></h1>

    <div class="card">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">PRODUIT</span></div>
        <div class="card-body">
            <form method="post" action="">
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Nom</label>
                            <input required type="text" name="nomProd" class="input form-control ml-2" value="<?= $prod['nomProd'] ?>">
                    </div>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2">Ligne de production</label>
                            <select required name="ligne" class="hirarchieUser custom-select custom-select-lg "> 
                                  <option value="">choisir une ligne</option>
                                <?php while ($ligne = $listLignesP->fetch()) { ?>
                                  <option <?php if($prod['id_ligneP']==$ligne['id_ligneP']) echo 'selected'; ?> value="<?= $ligne['id_ligneP'] ?>" ><?= $ligne['nomLigneP'] ?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="text-center">
                       <input type="submit" class="btn btn-primary mx-auto" name="valider" value="ENREGISTRER">
                    <input type="submit" class="btn btn-primary mx-auto" name="dupliquer" value="ENREGISTRER UNE COPIE">
                    <a href="<?= $_SESSION['url'] ?>gestionProd" class="btn btn-secondary mx-auto">RETOUR</a>
                    </div>
                   
            </form>
               
        </div>
    </div>



<div id="listeDocument">
     <div class="card">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">LISTE DES DOCUMENTS</span>
        </div>
<div id="collapseMaquette" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       <div class="d-flex flex-wrap">
            <button class="m-2 btnAdd" onclick="detailDocument(-1,'Nouveau document')">
              <i class="fas fa-plus iconAdd" style="line-height: 150px;"></i>
            </button>
    <?php while(!is_null($listeDocument) && $document = $listeDocument->fetch()){ ?>
            <div onclick="detailDocument(<?= $document['id_docProd'] ?>,'<?= $document['nomDocument'] ?>')" class="m-2 btnMaquette <?= $document['typeDocument'] ?>" href="#" style="cursor: pointer;position:relative;background: rgb(218,218,218);">
              <div style="height: 80%"></div>
              <div class="text-center bottomMaquette"><?= $document['nomDocument'] ?></div>
            </div>
    <?php } ?>
       </div>
      </div>
    </div>

  </div>
  </div>






    
    <div class="card">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
         <span class="cardTitle" >GESTION DES NORMES</span> 
          <a href="#" data-toggle="modal" onclick="getNewNorme()" data-target="#ajoutModif" class="btn btn-primary float-right mt-2 ml-3 btnAlign"><i class="fas fa-plus-circle"></i> NORME</a>
            <a  href="#" data-toggle="modal" onclick="clearGroup()"; data-target="#ajoutModifGroup" class="btn btn-primary float-right mt-2 ml-3 btnAlign"><i class="fas fa-plus-circle"></i> GROUPE</a>
      </div>
      <div class="card-body pt-1">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="colonne1-tab" data-toggle="tab" href="#colonne1" role="tab" aria-controls="home" aria-selected="true">Colonne 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="colonne2-tab" data-toggle="tab" href="#colonne2" role="tab" aria-controls="profile" aria-selected="false">Colonne 2</a>
        </li>
    </ul>
  
  


  <div class="tab-content" id="myTabContent">
<div id="colonne1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="colonne1-tab">
    <div class="table-responsive">
            <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0" >
              <thead class="w-100">
                <tr>
                  <th style="width: 20%">Normes</th>
                  <th style="width: 10%">Type</th>
                 <th style="width: 15%">Valeur</th>
                  <th style="width: 15%">Alerte</th>
                  <th style="width: 15%">Unité de mesure</th>
                  <th style="width: 5%">Ordre</th>
                  <th style="width:20%;text-align:center;">Supprimer</th>
                </tr>
              </thead>
            </table>
            <div id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
              <?php while ($norme = $listNormCol1->fetch()){ 
                      afficheNorme($norme);
               } ?> 
            </div>
          </div>
    </div>


      <div id="colonne2" class="tab-pane fade" role="tabpanel" aria-labelledby="colonne2-tab">
        <div class="table-responsive">
            <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0" >
              <thead class="w-100">
                <tr>
                  <th style="width: 20%">Normes</th>
                  <th style="width: 10%">Type</th>
                 <th style="width: 15%">Valeur</th>
                  <th style="width: 15%">Alerte</th>
                  <th style="width: 15%">Unité de mesure</th>
                  <th style="width: 5%">Ordre</th>
                  <th style="width:20%;text-align:center;">Supprimer</th>
                </tr>
              </thead>
            </table>
            <div id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
              <?php while ($norme = $listNormCol2->fetch()){ 
                      afficheNorme($norme);
               } ?>  
            </div>
          </div>
              
      </div>

    </div>

     

        </div>
        </div>
    </div>


   
    <!--Modal SUPPRIMER NORME-->
    <div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="titleGroup">Suppression d'une norme</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p id="textGroup" style="font-size:20px;">Vous voulez vraiement supprimer cette norme ?</p>
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
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">NORME PRODUIT</h5>
            <button type="button" class="close Modal" onclick="refresh();" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <iframe id="iframe" style="height: 80vh;width: 100%;" src="" class="embed-responsive-item" frameborder="0"></iframe>
          </div>
        </div>
      </div>
    </div>


            <!--Modal Ajout/modif Groupe-->
      <div class="modal fade" id="ajoutModifGroup" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">GROUPE DE NORME</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="" method="post" id="formGroup" enctype="multipart/form-data">
              <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="number" class="ldpLabel justify-content-middle text-left" >Nom du groupe</label>
                <input required id="nameGroup" name="nomGroupeN" type="text" value="" class="input form-control ml-2">
              </div>
              <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="number" class="ldpLabel justify-content-middle text-left" >document du groupe</label>
              <!--------------->
                <div id="lienGroupe">
                      <div class="form-check" id="FILEgroupe">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienGroupe"
                        value="FILE"
                        id="fileGroupe"
                        onchange="toggleLien('lienGroupe')"
                      />
                      <label class="form-check-label" for="fileGroupe">
                        Importer un fichier
                        <input type="file" id="fichierGroupe" name="lienGroupe" class="fichier" />
                      </label>
                    </div>

                    <div class="form-check" id="LINKgroupe">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienGroupe"
                        value="LINK"
                        id="linkGroupe"
                        onchange="toggleFichier('lienGroupe')"
                      />
                      <label class="form-check-label" for="linkGroupe">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienGroupe"
                          name="lienGroupe"
                          placeholder="https://"
                        />
                      </label>
                    </div>
                    </div>
              <!--------------->
              </div>
                <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                  <label for="text" class="ldpLabel justify-content-middle text-left" >Ordre</label>
                  <input required id="ordreGroup" name="ordreGroupeN" type="number" class="input form-control ml-2">
                </div>
                <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                  <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-3" >Affecter à une Colonne</label>
                  <select required name="groupeN" class="selectNormeForm custom-select custom-select-lg ">
                    <optgroup label = "selectionner une colonne">
                      <option value="-1">Colonne 1</option>
                      <option value="-2">Colonne 2</option>
                    </optgroup>
                    <optgroup label = "ou un groupe">
                    <?php while ($groupe= $listGroupeN->fetch()){ ?>
                      <option value="<?= $groupe['id_groupeN'] ?>" ><?= $groupe['nomGroupeN'] ?></option>
                    <?php } ?>
                    </optgroup>
                  </select>
                </div>

          
          <div class="modal-footer d-block text-center mx-auto">
                <input name="valider" type="submit" class="btn btn-primary w-auto" id="confirmSup" value="VALIDER" >
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>  
                </div>
                </form>
        </div>
      </div>
    </div>

</div>

<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" style="width: 620px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titreR">Nouveau document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="<?= $_SESSION['url'].'detailDocument/' ?>" height="400" frameborder="0" class="w-100"></iframe>
      </div>
    </div>
   </div>
  </div>


<style type="text/css">
  .btnMaquette:before {
    content: "\f15b";  /* this is your text. You can also use UTF-8 character codes as I do here */
    font-family: "Font Awesome 5 Free";
    left:-5px;
    font-size: 80px;
    font-weight: 900;
    position: absolute;
    left: 30%;
    color: #263238;
 }

 .btnMaquette.word:before {content: "\f1c2";}
 .btnMaquette.excel:before {content: "\f1c3";}
 .btnMaquette.powerPoint:before {content: "\f1c4";}
 .btnMaquette.pdf:before {content: "\f1c1";}
 .btnMaquette.image:before {content: "\f1c5";}
 .btnMaquette.audio:before {content: "\f1c7";}
 .btnMaquette.video:before {content: "\f1c8";}

 .firstCard .firstCard{
    margin: 7px 16px 3px 16px !important;
  }
  .firstCard{
    margin-top: 7px !important;
  }
</style>
<?php $content= ob_get_clean(); ?>
<?php ob_start(); ?> 
<script type="text/javascript">


function detailDocument(idDoc,titreDoc) {
    $('#documentModal #titreR').text(titreDoc);
    $('#documentModal').modal('toggle');
    $('#documentModal iframe').attr('src','<?= $_SESSION['url'] ?>detailDocument/<?= $id_prod ?>/'+idDoc);

  }



  function getLDPNorme(value){
    document.getElementById('iframe').setAttribute("src",`<?= $_SESSION['url'] ?>formNorme/${value.id}`);
  }
  function getNewNorme(){
    document.getElementById('iframe').setAttribute("src",`<?= $_SESSION['url'] ?>formNorme/addP/<?= $prod['id_prod'] ?>`);
  }
  function refresh() {
    window.location.href = window.location.href;
  }
  async function supprimeNorme(id_norme) {
           var xhttp;
            xhttp = new XMLHttpRequest();
            
            xhttp.open("GET", "<?= $_SESSION['url'] ?>formNorme/supprimer/"+id_norme, true);
            await xhttp.send(); 
    await refresh();
  }
  function getID(id) {
    document.getElementById('confirmSup').setAttribute("onclick","supprimeNorme("+id+")");

    document.getElementById('titleGroup').textContent= "Supression norme";
    document.getElementById('textGroup').textContent= "Vous voulez vraiement supprimer cette norme ?";
  }
  
function getGroup(id,name,ordre,groupeN,colone,lien){
    document.getElementById('nameGroup').value =name;
    document.getElementById('ordreGroup').value =ordre;

    lien= lien.split("!:!");
    $('#'+lien[0]+'groupe input[name="typeLienGroupe"]').prop('checked', true);
    $('#'+lien[0]+'groupe input[name="lienGroupe"]').attr('value',lien[1]);
    if(lien[0]=='FILE') toggleLien('lienGroupe');
    else if(lien[0]=='LINK') toggleFichier('lienGroupe');
    
    var selectList =document.querySelector('.selectNormeForm');
    for (var i = 0; i < selectList.length; i++) {
      if(name == selectList[i].textContent){
        selectList[i].disabled = true;
      }
      else{
        selectList[i].disabled = false;

      }
    }
    if(groupeN=='') document.querySelector('.selectNormeForm').value = -colone; 
      else{
        document.querySelector('.selectNormeForm').value = groupeN;
        //si même nom disabled
      }

    document.getElementById('formGroup').setAttribute("action", '<?= $_SESSION['url'] ?>groupeN/modif/'+id);
  }




  function getSuprimGroup(id_groupeN){
    document.getElementById('titleGroup').textContent= "Supression groupe";
    document.getElementById('textGroup').textContent= "Vous voulez vraiement supprimer ce groupe ?";

    document.getElementById('confirmSup').setAttribute("onclick","supprimeNorme("+id_groupeN+")");
  }

  function clearGroup(){
    document.getElementById('nameGroup').value ="";
    document.getElementById('ordreGroup').value ="";
    document.getElementById('formGroup').setAttribute("action", '<?= $_SESSION['url'] ?>groupeN/ajout/<?= $prod['id_prod'] ?>');
    $('input[name="lienGroupe"]').attr('value','');
   var selectList =document.querySelector('.selectNormeForm');

     for (var i = 0; i < selectList.length; i++) {
        selectList[i].disabled = false;
    }

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

<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>


<?php
function afficheNorme($norme){
  if($norme['typeNorme']=='groupe') { ?>
    <div class="card m-0 firstCard" style="border:#333 solid 1px;border-radius: 5px">
        <div class="card-header textTab" style="background-color:#333;color:white;padding-right: 0px">
          <a href="#" class="text-white" style="text-decoration: none;" data-toggle="modal" data-target="#ajoutModifGroup" onclick="getGroup(<?= "'".$norme['id_norme']."','".valid($norme['nomNorme'])."','".$norme['ordreNorme']."','".$norme['id_groupeN']."','".$norme['colone']."','".$norme['lienNorme']."'" ?>)" id="<?= $norme['id_norme'] ?>"><?= $norme['nomNorme'] ?></a>
        
          <div class="float-right" style="width: 20%;text-align: center;color: white">
             <a><i class="fas fa-minus-circle text-white" data-toggle="modal" data-target="#supprime" onclick="getID(<?= $norme['id_norme'] ?>)"></i></a>
          </div>
          <div class="float-right" style="width: 5%;text-align: left;color: white">
            <?= $norme['ordreNorme'] ?>
          </div>
        </div>
    <div class="card-body p-0">
      <?php $listNormGroup= recupNormeGroupeN($norme['id_norme']) ?>
      <?php while($normeG= $listNormGroup->fetch()){ 
              afficheNorme($normeG);
            } ?>

        </div>
    </div>
    <?php }else{ ?>
              <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
                <tr>
                  <td style="width: 20%"><a id="<?= $norme['id_norme'] ?>" class="textTab" href="#" data-toggle="modal" data-target="#ajoutModif" onclick="getLDPNorme(this)"><?= $norme['nomNorme'] ?></a></td>
                  <td style="width: 10%"><?= $norme['typeNorme'] ?></td>
                  <td style="width: 15%"><?= reFormule($norme['formuleNorme']); ?></td>
                  <td style="width: 15%"><?= $norme['messageErreur'] ?></td>
                  <td style="width: 15%"><?= $norme['uniteMesure'] ?></td>
                  <td style="width: 5%"><?= $norme['ordreNorme'] ?></td>
                    
                  <td style=" text-align: center;width: 20%">
                    <a><i class="fas fa-minus-circle" data-toggle="modal" data-target="#supprime" onclick="getID(<?= $norme['id_norme'] ?>)"></i></a>
                  </td>
                </tr>
              </table>
                <?php } 
}
