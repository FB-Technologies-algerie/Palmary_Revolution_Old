<?php $title='les lignes de productions' ?>

<?php ob_start(); ?>
  <div id="bodylignesP" >
  	<?php require('view/navbar.php') ?>

  <!--HISTORIQUE JOURNALIERE-->
    <button class="btn btn-primary float-right mt-3" data-toggle="modal" data-target="#historique" id="historiqueBTN">MON HISTORIQUE</button>

    <div class="modal fade" id="historique">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">MON HISTORIQUE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <iframe style="height: 80vh;" src="<?= $_SESSION['url'] ?>historique/jour" class="embed-responsive-item" frameborder="0"></iframe>
        </div>
      </div> 
    </div>

		<!--LES LIGNES-->
  	<div class="mx-auto" id="appSummary">
          <div class="d-flex align-content-end justify-content-center flex-wrap">
          <?php $prod = $listeProd->fetch();
            if(!$prod){ ?>
                        <h3 class="mb-0 text-white text-center mt-5">
                          <strong>VOUS N'ETES AFFECTEZ A AUCUNE LIGNE DE PRODUCTION</strong><br>
                          Veuillez contactez l'administrateur.
                        </h3>
                    </div0>
          <?php }else
              while ($prod){ ?>
                <div class="card mt-5 mr-1 ml-1 mb-3" style="height: fit-content;">
                  <div class="card-header text-center" style="color:black;font-weight: bold;font-size:25px">
                    <?= recupNomCategorie($prod['id_categorie']) ?>
                  </div>
                  <div class="card-body">
                <?php $categorie=$prod['id_categorie']; ?>
                <?php while($prod && $prod['id_categorie']==$categorie){ ?>
                    <div id="accordion">
                      <div class="card m-0 mb-2">
                        <div class="card-header" id="1" style="border: 0;background-color: #007bff;border-radius: 15px">
                          <h5 class="mb-0">
                            <button class="btn btn-link" style="text-decoration: none;color: white;text-align: center;width: 100%;" data-toggle="collapse" data-target="#collapse<?= $prod['id_ligneP'] ?>" aria-expanded="true" aria-controls="collapseOne">
                              <?= $prod['nomLigneP'] ?>
                            </button>
                          </h5>
                        </div>
                        <div id="collapse<?= $prod['id_ligneP'] ?>" class="collapse" aria-labelledby="1" data-parent="#accordion">
                          <div class="card-body p-0">
                            <div class="list-group">
                      <?php $ligne=$prod['id_ligneP']; ?>
                      <?php while($prod && $prod['id_ligneP']==$ligne){ ?>
                              <div class="list-group-item" href="#">
                                <a href="<?= $_SESSION['url'] ?>ficheControle/<?= $prod['id_prod'] ?>" style="text-decoration: none;"><?= $prod['nomProd'] ?></a> 
                              </div>
                        <?php $prod = $listeProd->fetch(); ?>
                      <?php } ?>
<!------>
               </div>
             </div>
           </div>
         </div>
       </div>
      <?php } ?>
    <!--/////////////////////////////////////////////////-->
    </div>
  </div>
  <?php } ?>
</div>
<!----------------------------------------------
        <div class="d-flex flex-column">
          <?php $ligne = $liste->fetch();
            if(!$ligne){ ?>
                        <h3 class="mb-0 text-white text-center mt-5">
                          <strong>VOUS N'ETES AFFECTEZ A AUCUNE LIGNE DE PRODUCTION</strong><br>
                          Veuillez contactez l'administrateur.
                        </h3>
                    </div>
          <?php }else
              while ($ligne){ ?>
            
            <div class="accordion" id="accordion">
                <div class="card bg-primary">
                    <div class="card-header bg-primary" id="<?= $ligne['id_ligneP'] ?>">
                        <h5 class="mb-0">
                          	<button class=" ligneBTN btn btn-link collapsed btn-block text-center text-white" type="button" data-toggle="collapse" data-target="#l<?= $ligne['id_ligneP'] ?>" aria-expanded="false" aria-controls="l<?= $ligne['id_ligneP'] ?>" >
                               <strong><?= $ligne['nomLigneP'] ?></strong> 
                            </button>
                        </h5>
                    </div>
                	<div id="l<?= $ligne['id_ligneP'] ?>" class="collapse" aria-labelledby="l<?= $ligne['id_ligneP'] ?>" data-parent="#accordion">
                        <div class="card-body p-0 bg-light"> 
                            <ul class="list-group">
                              <?php $lin=$ligne['id_ligneP']; ?>
                              <?php while($ligne['id_ligneP']==$lin){ ?>
                                <a href="<?= $_SESSION['url'] ?>ficheControle/<?= $ligne['id_prod'] ?>"  style="text-decoration: none"> <li class="list-group-item"><?= $ligne['nomProd'] ?></li></a> 
                              <?php $ligne = $liste->fetch(); ?>
                          	  <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
          	</div>
          <?php } ?>
        </div>
    </div>
  </div>-->
<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>