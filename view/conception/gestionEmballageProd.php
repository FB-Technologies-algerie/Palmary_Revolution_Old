<?php $title='gestion des produits' ?>

<?php ob_start(); ?>

<div id="bodylignesP">
  <?php require('view/navbar.php') ?>
    
    <div class="card">
        <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
           <span class="cardTitle" >GESTION DES EMBALLAGES</span>         
            <a  href="#" data-toggle="modal" data-target="#ajoutProd" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> PRODUIT</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                    <thead class="w-100">
                        <tr>
                          <th>Produit</th>
                          <th>Code article</th>
                          <th>Code à barre</th>
                          <th style="text-align:center;">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while ($emballage = $listEmballage->fetch()) { ?>
                        <tr>
                          <td><a href="<?= $_SESSION['url'] ?>formEmballage/<?= $emballage['id_emballageProd'] ?>" class="ldp_table"><?= $emballage['nomEmballage'] ?></a></td>
                          <td><?= $emballage['codeArticle'] ?></td>
                          <td><?= $emballage['codeBarre'] ?></td>
                          <td style=" text-align: center;">
                  <a onclick="getID(<?= $emballage['id_emballageProd'] ?>)" href="" data-toggle="modal" data-target="#supprime"><i class="fas fa-minus-circle"></i></a>
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
            <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN NOUVEAU EMBALLAGE PRODUIT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="">
                    <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nom du Produit</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="nomEmballage" class="form-control"  placeholder="">
                                    </div>
                            </div>
                    <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Code article</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="codeArticle" class="form-control" placeholder="">
                                    </div>
                    </div>
                    <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Code à barre</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="codeBarre" class="form-control" placeholder="">
                                    </div>
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
      function supprimeEmballageProd(id_emballageProd) {
        var xhttp;
          xhttp = new XMLHttpRequest();
            
          xhttp.open("GET", "<?= $_SESSION['url'] ?>gestionEmballage/supprimer/"+id_emballageProd, true);
          xhttp.send(); 
        refresh();
      }
      function getID(id) {
        document.getElementById('confirmSup').setAttribute("onclick","supprimeEmballageProd("+id+")");
      }

       function refresh() {
    	setTimeout(function () {
    	  window.location.reload()
    	}, 500);
  	  }
    </script>
<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>