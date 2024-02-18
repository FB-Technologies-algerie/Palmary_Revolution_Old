<?php $title='Gestion des lignes de production' ?>

<?php ob_start(); ?>

<div id="bodylignesP">
  <?php require('view/navbar.php') ?>
    
    <div class="card">
        <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
           <span  class="cardTitle">LIGNES DE PRODUCTIONS</span> 
            <a  onclick="clearLigne()" href="#" data-toggle="modal" data-target="#ajoutModifLigne" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> LIGNE DE PRODUCTION</a>
            <a  href="#" onclick="clearCat()" data-toggle="modal" data-target="#ajoutModifcategorie" class="btn btn-primary float-right btnAlign mr-1 mt-1"><i class="fas fa-plus-circle"></i> CATEGORIE</a>
            
        </div> 
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                    <thead class="w-100">
                        <tr>
                          <th style="width:70%;">Ligne de Production</th>
                          <th style="width:70%;">Unité affecté</th>
                          <th style="width:15%;text-align:center;">Supprimer</th>
                        </tr>
                    </thead>
                </table>
                      <?php 
                          foreach ($listCategorie as $categorie) {
                      ?>
                  <div class="card m-0" style="border:#333 solid 1px;border-radius: 5px">
                    <div class="card-header textTab" style="background-color:#333;color:white;padding-right: 0px">
                      <a href="#" id="<?= $categorie['id_categorie'] ?>" class="text-white" style="text-decoration: none;" data-toggle="modal" data-target="#ajoutModifcategorie" onclick="modifCat(this)"><?= $categorie['nomCategorie'] ?></a>
        
                      <div class="float-right" style="width: 15%;text-align: center;color: white">
                        <a><i class="fas fa-minus-circle text-white" data-toggle="modal" onclick="removeCat(<?= $categorie['id_categorie'] ?>)" data-target="#supprime"></i></a>
                      </div>
            
                    </div>
                    <div class="card-body p-0">
                      <div class="table-responsive">
                        <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                          <tbody>
                      <?php $listLignes= recupListLignesOfCategorie($categorie['id_categorie'],$_SESSION['droitAdmin']); ?>
                      <?php while($ligne= $listLignes->fetch()){ ?>
                              <tr>
                                <td><a id="<?= $ligne['id_ligneP'] ?>" onclick="updateLigne(<?= "'".$ligne['id_ligneP']."','".$ligne['nomLigneP']."','".$ligne['id_categorie']."','".$ligne['id_unite']."'" ?>)" href="#" data-toggle="modal" data-target="#ajoutModifLigne" class="ldp_table"><?= $ligne['nomLigneP'] ?></a></td>
                                <td><?= recupNomUnite($ligne['id_unite']) ?></td>
                                <td class="text-center"><a onclick="removeLigne(<?= $ligne['id_ligneP'] ?>)" href="" data-toggle="modal" data-target="#supprime"><i class="fas fa-minus-circle" ></i></a></td>
                              </tr>
                          <?php 
                            }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                        
    </div>
                      <?php } ?>
                  <div class="card m-0" style="border:#333 solid 1px;border-radius: 5px">
                    <div class="card-header textTab" style="background-color:#333;color:white;padding-right: 0px">
                      <a class="text-white" style="text-decoration: none;">Autre</a>
                    </div>
                    <div class="card-body p-0">
                      <div class="table-responsive">
                        <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                          <tbody>
                      <?php $listLignes= recupListLignesOfCategorie('',$_SESSION['droitAdmin']); ?>
                      <?php while($ligne= $listLignes->fetch()){ ?>
                              <tr>
                                <td><a id="<?= $ligne['id_ligneP'] ?>" onclick="updateLigne(<?= "'".$ligne['id_ligneP']."','".$ligne['nomLigneP']."','".$ligne['id_categorie']."','".$ligne['id_unite']."'" ?>)" href="#" data-toggle="modal" data-target="#ajoutModifLigne" class="ldp_table"><?= $ligne['nomLigneP'] ?></a></td>
                                <td><?= recupNomUnite($ligne['id_unite']) ?></td>
                                <td class="text-center"><a onclick="removeLigne(<?= $ligne['id_ligneP'] ?>)" href="" data-toggle="modal" data-target="#supprime"><i class="fas fa-minus-circle" ></i></a></td>
                              </tr>
                          <?php 
                            }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                        
    </div>
                    

   
    <!--Modal SUPPRIMER-->
	<div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
    	<div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="removeTitle">Suppression d'une ligne de production</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p id="removeBody" style="font-size:20px;">Vous voulez vraiement supprimer cette ligne de production ?</p>
              </div>
              <div class="modal-footer mx-auto">
                <a href="#" id="confirmSup" data-dismiss="modal" class="btn btn-primary">Oui</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>  
              </div>
            </div>
        </div>
    </div>
</div>

       <!--Modal Ajout/modif LIGNE-->
    <div class="modal fade" id="ajoutModifLigne" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelModif">Ajouter une nouvelle ligne de production</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="">
                    <input type="text" id="idLigneP" name="idLigneP" class="input form-control ml-2 d-none" value="" >
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Nom</label>
                            <input required type="text" id="nomLigneP" name="nomLigneP" class="input form-control ml-2" value="">
                    </div>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="text" class="ldpLabel justify-content-middle text-left display-inline">Catégorie</label>
                            <select required name="categorie" id="categorie" class="selectNormeForm custom-select custom-select-lg ml-2"> 
                                <?php foreach ($listCategorie as $cat) { ?>
                                  <option value="<?= $cat['id_categorie'] ?>" ><?= $cat['nomCategorie'] ?></option>
                                <?php } ?>
                                  <option value="">Autre</option>
                            </select>
                    </div>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="text" class="ldpLabel justify-content-middle text-left display-inline">Unité de production</label>
                            <select required name="unite" id="uniteLigneP" class="selectNormeForm custom-select custom-select-lg ml-2"> 
                                  <option value="">choisir unité</option>
                                <?php while ($unite = $listUnite->fetch()) { ?>
                                  <option value="<?= $unite['id_unite'] ?>" ><?= $unite['nomUnite'] ?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="text-center">
                    <input id="submitBtn" type="submit" class="btn btn-primary" name="valider" style="width:auto !important;margin-left: auto;" value="VALIDER">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
                    
            </form>
          </div>
          <div class="modal-footer mx-auto"> 
          </div>
        </div>
      </div>
    </div>

    <!--Categorie-->
     <div class="modal fade" id="ajoutModifcategorie" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelModif">Ajouter une nouvelle catégorie</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="">
                    <input type="text" id="idCat" name="id_categorie" class="input form-control ml-2 d-none" value="" >
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Nom de la catégorie</label>
                            <input required type="text" id="nomCat" name="nomCategorie" class="input form-control ml-2" value="">
                    </div>
                    
                    <div class="text-center">
                    <input id="submitBtnCat" type="submit" class="btn btn-primary" name="validerCat" style="width:auto !important;margin-left: auto;" value="VALIDER">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
                    
            </form>
          </div>
          <div class="modal-footer mx-auto"> 
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      
      function supprimeLigne(id_ligne) {
        var xhttp;
          xhttp = new XMLHttpRequest();
            
          xhttp.open("GET", "<?= $_SESSION['url'] ?>gestionLignesProd/supprimer/"+id_ligne, true);
          xhttp.send(); 
        refresh();
      }
      function supprimeCat(id_categorie) {
        var xhttp;
          xhttp = new XMLHttpRequest();
            
          xhttp.open("GET", "<?= $_SESSION['url'] ?>gestionLignesProd/supprimeCat/"+id_categorie, true);
          xhttp.send(); 
        refresh();
      }

      function refresh() {
        window.location.href = window.location.href;
      }
      function updateLigne(idLigneP,nomLigneP,categorie,unite){
        document.getElementById('exampleModalLabelModif').innerHTML= 'MODIFIER LA LIGNE DE PRODUCTION';
        document.getElementById('submitBtn').value='MODIFIER';
        document.getElementById('submitBtn').name='modifier';

        document.getElementById('idLigneP').value = idLigneP;
        document.getElementById('nomLigneP').value = nomLigneP;
        document.getElementById('categorie').value = categorie;
        document.getElementById('uniteLigneP').value = unite;
      }

      function clearLigne(){
        document.getElementById('exampleModalLabelModif').innerHTML= 'AJOUTER UNE NOUVELLE LIGNE DE PRODUCTION';
        document.getElementById('submitBtn').value='VALIDER';
        document.getElementById('submitBtn').name='valider';

        document.getElementById('idLigneP').value = "";
        document.getElementById('nomLigneP').value = "";
        document.getElementById('categorie').value = "";
        document.getElementById('uniteLigneP').value = "";
      }
      
      function modifBTN(){
        document.getElementById('nomLigneP').value = "";
        document.getElementById('submitBtn').value='VALIDER';
        document.getElementById('submitBtn').name='valider';
        document.getElementById('exampleModalLabelModif').innerHTML= 'AJOUTER UNE NOUVELLE LIGNE DE PRODUCTION';

        var sel = document.getElementById('uniteLigneP');  
        sel.selectedIndex = 0;  
      }

      function modifCat(val){
        document.getElementById('nomCat').value = val.textContent;
        document.getElementById('idCat').value = val.id;
        document.getElementById('submitBtnCat').value='MODIFIER';
        document.getElementById('submitBtnCat').name='modifierCat';
      }

      function clearCat(){
        document.getElementById('nomCat').value ='';
        document.getElementById('idCat').value = '';
        document.getElementById('submitBtnCat').value='VALIDER';
        document.getElementById('submitBtnCat').name='validerCat';
      }

      function removeCat(id){
        document.getElementById('removeTitle').textContent = "Suppression d'une catégorie";
        document.getElementById('removeBody').textContent = "Vous voulez vraiment supprimer cetter catégorie ?";
        document.getElementById('confirmSup').setAttribute("onclick","supprimeCat("+id+")");
      }

      function removeLigne(id){
        document.getElementById('removeTitle').textContent = "Suppression d'une ligne de production";
        document.getElementById('removeBody').textContent = "Vous voulez vraiement supprimer cette ligne de production ?";
        document.getElementById('confirmSup').setAttribute("onclick","supprimeLigne("+id+")");
      }
    </script>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>