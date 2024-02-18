<?php $title='gestion des produits' ?>

<?php ob_start(); ?>

<div id="bodylignesP">
  <?php require('view/navbar.php') ?>
    
    <div class="card">
        <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
           <span class="cardTitle" >GESTION DES PRODUITS</span>         
            <a  href="#" data-toggle="modal" data-target="#ajoutProd" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> PRODUIT</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                    <thead class="w-100">
                        <tr>
                          <th style="width:70%;">Produit</th>
                          <th style="width:70%;">Ligne de production</th>
                          <th style="width:15%;text-align:center;">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while ($prod = $listProds->fetch()) { ?>
                        <tr>
                          <td><a href="<?= $_SESSION['url'] ?>gestionProd/modifier/<?= $prod['id_prod'] ?>" class="ldp_table"><?= $prod['nomProd'] ?></a></td>
                          <td><?= recupNomLigne($prod['id_ligneP']) ?></td>
                          <td style=" text-align: center;">
                  <a onclick="getID(<?= $prod['id_prod'] ?>)" href="" data-toggle="modal" data-target="#supprime"><i class="fas fa-minus-circle"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">SUPPRESSION D'UN PRODUIT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p style="font-size:20px;">Vous voulez vraiement supprimer ce produit ?</p>
              </div>
              <div class="modal-footer mx-auto">
                <button type="button" id="confirmSup" class="btn btn-primary">Oui</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>  
              </div>
            </div>
        </div>
    </div>
</div>

       <!--Modal Ajout/modif PROD-->
    <div class="modal fade" id="ajoutProd" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN NOUVEAU PRODUIT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="">
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Nom</label>
                            <input required type="text" name="nomProd" class="input form-control ml-2" value="">
                    </div>

                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2" >Ligne de production</label>
                            <select required name="ligne" class="selectNormeForm custom-select custom-select-lg "> 
                                  <option value="">choisir une ligne</option>
                                <?php while ($ligne = $listLignesP->fetch()) { ?>
                                  <option value="<?= $ligne['id_ligneP'] ?>" ><?= $ligne['nomLigneP'] ?></option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="modal-footer d-block mx-auto text-center">
                    <input type="submit" class="btn btn-primary w-auto" name="valider"  value="VALIDER">
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
      function supprimeProd(id_prod) {
        var xhttp;
          xhttp = new XMLHttpRequest();
            
          xhttp.open("GET", "<?= $_SESSION['url'] ?>gestionProd/supprimer/"+id_prod, true);
          xhttp.send(); 
        refresh();
      }

      function refresh() {
        window.location.href = window.location.href;
      }
      function getID(id) {
        document.getElementById('confirmSup').setAttribute("onclick","supprimeProd("+id+")");
      }
    </script>
<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>