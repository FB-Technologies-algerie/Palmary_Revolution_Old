<?php $title='Menu Emballage' ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
 <?php require('view/navbar.php') ?>

    <section id="btnList" class="mt-5 mx-auto">
        <div class="d-flex flex-column justify-content-center ">
            <!--<a href="<?= $_SESSION['url'] ?>controleQualite" class="btn btn-primary pt-2 pb-2 m-3">
              <strong>CONTRÔLE QUALITÉ<br>DES CONCEPTIONS</strong>
            </a>  
            <a href="<?= $_SESSION['url'] ?>gestionTraduction" class="btn btn-primary pt-4 pb-4 m-3">
              <strong>GESTION DE TRADUCTION</strong>
            </a>
            <a href="<?= $_SESSION['url'] ?>gestionEmballage" class="btn btn-primary pt-2 pb-2 m-3">
              <strong>GESTION DES EMBALLAGES<br>DES PRODUITS</strong>
            </a>--
            <div id="accordion">
              <div class="card m-0 mb-2">
                <div class="card-header" id="1" style="border: 0;background-color: #007bff;border-radius: 15px">
                  <h5 class="mb-0">
                    <button class="btn btn-link" style="text-decoration: none;color: white;text-align: center;width: 100%;" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapseOne">
                        <strong>CONTRÔLE QUALITÉ<br>DES MAQUETTES</strong>
                    </button>
                  </h5>
                </div>
                <div id="collapse-1" class="collapse" aria-labelledby="1" data-parent="#accordion">
                  <div class="card-body p-0">
                    <div class="list-group">
                      <div class="list-group-item" href="#">
                        <a href="#" style="text-decoration: none;">OCR 1</a> 
                      </div>
                      <div class="list-group-item" href="#">
                        <a href="#" style="text-decoration: none;">OCR 2</a> 
                      </div>
                      <div class="list-group-item" href="#">
                        <a href="#" style="text-decoration: none;">Controle Couleur</a> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div id="accordion">
              <div class="card m-0 mb-2">
                <div class="card-header" id="1" style="border: 0;background-color: #007bff;border-radius: 15px">
                  <h5 class="mb-0">
                    <button class="btn btn-link" style="text-decoration: none;color: white;text-align: center;width: 100%;" data-toggle="collapse" data-target="#collapse-2" aria-expanded="true" aria-controls="collapseOne">
                        <strong>GESTION DE TRADUCTION</strong>
                    </button>
                  </h5>
                </div>
                <div id="collapse-2" class="collapse" aria-labelledby="1" data-parent="#accordion">
                  <div class="card-body p-0">
                    <div class="list-group">
                      <div class="list-group-item" href="#">
                        <a href="#" style="text-decoration: none;">Dictionnaire des ingrédiants</a> 
                      </div>
                      <div class="list-group-item" href="#">
                        <a href="#" style="text-decoration: none;">Traduction</a> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>-->
          <a href="<?= $_SESSION['url'] ?>gestionTraduction" class="btn btn-primary pt-4 pb-4 m-3">
              <strong>DICTIONNAIRE DE TRADUCTION</strong>
            </a>
          <a href="<?= $_SESSION['url'] ?>gestionEmballage" class="btn btn-primary pt-2 pb-2 m-3">
            <strong>GESTION DES EMBALLAGES<br>DES PRODUITS</strong>
          </a>
          <a href="<?= $_SESSION['url'] ?>magasin" class="btn btn-primary pt-4 pb-4 m-3">
            <strong>GESTION DES ARRIVAGES </strong>
          </a> 
           <a href="<?= $_SESSION['url'] ?>gestionFournisseuer" class="btn btn-primary pt-4 pb-4 m-3">
            <strong>GESTION DES FOURNISSEURS </strong>
          </a>
    </section>
</div>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>