<?php $title='gestion des parametres' ?>

<?php ob_start(); ?>

<div id="bodylignesP">
  <?php require('view/navbar.php') ?>
    
    <div class="card">
        <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
           <span class="cardTitle" >GESTION DES FOURNISSEURS</span>         
            <a  href="#" data-toggle="modal" data-target="#ajoutFournissuer" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle" onclick="ajouterFournisseur()" ></i> AJOUTER</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                    <thead class="w-100">
                        <tr>
                          <th>Nom fournisseur</th>
                          <th style="text-align:center;">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while ($fournisseur = $listFourniseur->fetch()) { ?>
                        <tr>
                          <td><a href="#" class="ldp_table"  data-toggle="modal" data-target="#modifFournissuer" onclick="modiferFournisseur(<?= $fournisseur['id_fournisseur'].",'".$fournisseur['nomFournisseur']."'" ?>)" ><?= $fournisseur['nomFournisseur'] ?></a>
                          </td>
                          <td style=" text-align: center;">
                          <a onclick="defineId(<?= $fournisseur['id_fournisseur'] ?>)" href="" data-toggle="modal" data-target="#supprime"><i class="fas fa-minus-circle"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">SUPPRESSION D'UN FOURNISSEUR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p style="font-size:20px;">Vous voulez vraiement supprimer ce fournisseur?</p>
              </div>
              <div class="modal-footer mx-auto">
                <a id="confirmSup" class="btn btn-primary">Confirmer</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>  
              </div>
            </div>
        </div>
    </div>
</div>

       <!--Modal Ajout/modif PROD-->
    <div class="modal fade" id="ajoutFournissuer" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" style="width: 500px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titre" >AJOUTER UN NOUVEAU  FOURNISSUER</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="">
                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="nomFournisseur" id="nomFournisseur" class="form-control"  placeholder="">
                                    </div>
                    </div>
                    <div class="modal-footer d-block mx-auto text-center">
                    <input type="submit" id="submitFourni" class="btn btn-primary w-auto" name="valider"  value="VALIDER">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
            </form>
          </div>
          <div class="modal-footer mx-auto"> 
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modifFournissuer" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" style="width: 500px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titre" >MODIFIER LE FOURNISSUER</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" id ="formModif" action="">
                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="nomFournisseurModif" id="nomFournisseurModif" class="form-control"  placeholder="">
                                    </div>
                    </div>
                    <div class="modal-footer d-block mx-auto text-center">
                    <input type="submit" id="submitFourniModif" class="btn btn-primary w-auto" name="modifier"  value="MODIFIER">
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
    <script type="text/javascript">
     

        function defineId(id) {
        $('#confirmSup').attr('href',"<?= $_SESSION['url'] ?>supprimerFournisseur/"+id+"");
        }
      function ajouterFournisseur(){
      $('#nomFournisseur').val('');
      }
     
     function modiferFournisseur(id,nom){ 
     $('#formModif').attr('action','<?= $_SESSION['url'] ?>modifFournissuer/'+id);
     $('#nomFournisseurModif').val(''+nom);
      }

       function refresh() {
      setTimeout(function () {
        window.location.reload()
      }, 500);
      }

    </script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>