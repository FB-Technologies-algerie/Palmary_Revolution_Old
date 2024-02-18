<?php $title='menu administrateur' ?>

<?php ob_start(); ?>

<div id="bodylignesP">
  <?php require('view/navbar.php') ?>
    
    <div class="card">
        <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
           <span  class="cardTitle">UNITÉS DE PRODUCTIONS</span> 
            <a  onclick="modifBTN()" href="#" data-toggle="modal" data-target="#ajoutModifLigne" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> UNITÉ DE PRODUCTION</a>
            
        </div> 
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                    <thead class="w-100">
                        <tr>
                          <th style="width:70%;">Unité de Production</th>
                          <th style="width:70%;">Adresse de l'unité</th>
                          <th style="width:15%;text-align:center;">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while ($unite = $listUnites->fetch()) { ?>
                        <tr>
                          <td><a id="<?= $unite['id_unite'] ?>" onclick="getName(this)" href="#" data-toggle="modal" data-target="#ajoutModifLigne" class="ldp_table"><?= $unite['nomUnite'] ?></a></td>
                          <td><?= $unite['adresseUnite'] ?></td>
                          <td class="text-center"><a onclick="getID(<?= $unite['id_unite'] ?>)" href="" data-toggle="modal" data-target="#supprime"><i class="fas fa-minus-circle" ></i></a>
                          </td>
                        </tr>
                      <?php } ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Suppression d'une unité de production</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p style="font-size:20px;">Vous voulez vraiement supprimer cette unité de production ?</p>
              </div>
              <div class="modal-footer mx-auto">
                <a href="" id="confirmSup" class="btn btn-primary">Oui</a>
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
            <h5 class="modal-title" id="exampleModalLabelModif">Ajouter une nouvelle unité de production</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="">
                    <input type="text" id="idUniteP" name="idUniteP" class="input form-control ml-2 d-none" value="" >
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Nom</label>
                            <input required type="text" id="nomUniteP" name="nomUniteP" class="input form-control ml-2" value="">
                    </div>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="text" class="ldpLabel justify-content-middle text-left display-inline">Adresse de l'unité de production</label>
                            <input required type="text" id="adresseUniteP" name="adresseUniteP" class="input form-control ml-2" value="">
                    </div>
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
    <script type="text/javascript">
      function getID(id) {
        document.getElementById('confirmSup').setAttribute("onclick","supprimeUnite("+id+")");
      }
      function supprimeUnite(id_unite) {
        var xhttp;
          xhttp = new XMLHttpRequest();
            
          xhttp.open("GET", "<?= $_SESSION['url'] ?>gestionUnitesProd/supprimer/"+id_unite, true);
          xhttp.send(); 
        refresh();
      }
      function refresh() {
        window.location.href = window.location.href;
      }
      
      function getName(val){
        document.getElementById('nomUniteP').value = val.textContent;
        document.getElementById('submitBtn').value='MODIFIER';
        document.getElementById('submitBtn').name='modifier';
        document.getElementById('idUniteP').value = val.id;
        document.getElementById('exampleModalLabelModif').innerHTML= 'MODIFIER LA LIGNE DE PRODUCTION';
        document.getElementById('adresseUniteP').value = val.parentElement.parentElement.getElementsByTagName('td')[1].textContent
      }

      
      function modifBTN(){
        document.getElementById('nomUniteP').value = "";
        document.getElementById('submitBtn').value='VALIDER';
        document.getElementById('submitBtn').name='valider';
        document.getElementById('exampleModalLabelModif').innerHTML= 'AJOUTER UNE NOUVELLE LIGNE DE PRODUCTION';

        var sel = document.getElementById('uniteLigneP');  
        sel.selectedIndex = 0;  
      }
    </script>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>
