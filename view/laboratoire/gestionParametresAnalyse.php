<?php $title='gestion des parametres' ?>

<?php ob_start(); ?>

<div id="bodylignesP">
  <?php require('view/navbar.php') ?>
    
    <div class="card">
        <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
           <span class="cardTitle" >GESTION DES PARAMETRES D'ANALYSE</span>         
            <a  href="#" data-toggle="modal" data-target="#ajoutProd" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> PARAMETRE</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                    <thead class="w-100">
                        <tr>
                          <th>Nom paramètre</th>
                          <th>Description</th>
                          <th style="text-align:center;">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while ($parametre = $listeParametre->fetch()) { ?>
                        <tr>
                          <td><a href="<?= $_SESSION['url'] ?>detailParametre/<?= $parametre['id_paramAnal'] ?>" class="ldp_table"><?= $parametre['nomParamAnal'] ?></a></td>
                          <td><?= $parametre['descriptionParamAnal'] ?></td>
                          <td style=" text-align: center;">
                  <a onclick="defineId(<?= $parametre['id_paramAnal'] ?>)" href="" data-toggle="modal" data-target="#supprime"><i class="fas fa-minus-circle"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">SUPPRESSION D'UN PARAMETRE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p style="font-size:20px;">Vous voulez vraiement supprimer ce parametre, avec ces documents et informations ?</p>
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
    <div class="modal fade" id="ajoutProd" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" style="width: 500px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN NOUVEAU  PARAMETRE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="">
                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="nomParam" id="nomParam" class="form-control"  placeholder="">
                                    </div>
                    </div>
                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                      <textarea type="text" name="descriptionParam" id="descriptionParam" class="form-control"  placeholder=""></textarea>
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
     

        function defineId(id) {
        $('#confirmSup').attr('href',"<?= $_SESSION['url'] ?>supprimerParametresAnalyse/"+id+"");
    }
 
   function supprimerParametre(id){ 
      $.get("<?= $_SESSION['url'] ?>supprimerParametresAnalyse/"+id, function(data, status){
        window.location.reload(true);
      });
  }

       function refresh() {
    	setTimeout(function () {
    	  window.location.reload()
    	}, 500);
  	  }
    </script>
<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>