<?php $title='Menu Emballage' ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
 <?php require('view/navbar.php') ?>

    <section id="btnList" class="mt-5 mx-auto">
        <div class="d-flex flex-column justify-content-center ">

          <div class="accordion m-3" id="accordion1">
            <div class="card m-0 p-0 bg-primary">
              <div class="card-header p-0" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-primary p-3 w-100" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                   <strong>Gestion de laboratoire </strong>
                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion1">
                <div class="card-body p-0">
                  <ul class="list-group">
            <li class="list-group-item">
               <a href="<?= $_SESSION['url'] ?>gestionEquipements" class="pt-3 pb-4 m-3">
                        <strong>Gestion des équipements</strong>
                      </a>
            </li>
            <li class="list-group-item">
               <a href="<?= $_SESSION['url'] ?>gestionConsommables" class="pt-3 pb-4 m-3">
                      <strong>Gestion des consommables</strong>
                    </a>
            </li>
            <li class="list-group-item">
              <a href="<?= $_SESSION['url'] ?>gestionReactifs" class="pt-3 pb-4 m-3">
                        <strong>Gestion reactifs</strong>
                      </a>
            </li>

          </ul>       
                </div>
              </div>
            </div>
            
            </div>
            <!--<a href="<?= $_SESSION['url'] ?>gestionArchivage" class="btn btn-primary pt-3 pb-4 m-3">
              <strong>Archivage</strong>
            </a>-->




            <div class="accordion m-3" id="accordion2">
            <div class="card m-0 p-0 bg-primary">
              <div class="card-header p-0" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-primary p-3 w-100" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                   <strong> Gestion des analyses </strong>
                  </button>
                </h5>
              </div>

              <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion1">
                <div class="card-body p-0">
                  <ul class="list-group">
            <li class="list-group-item">
               <a href="<?= $_SESSION['url'] ?>gestionMatiere" class="pt-3 pb-4 m-3">
                        <strong>gestion des matières</strong>
                      </a>
            </li>
            <li class="list-group-item">
               <a href="<?= $_SESSION['url'] ?>gestionParametresAnalyse" class="pt-3 pb-4 m-3">
                      <strong>Gestion des paramètres d'analyse</strong>
                    </a>
            </li>
            <li class="list-group-item">
               <a href="<?= $_SESSION['url'] ?>listeDesAnalyse" class="pt-3 pb-4 m-3">
                      <strong>Liste des analyses</strong>
                    </a>
            </li>
        
          </ul>       
                </div>
              </div>
            </div>
           </div>
            <a href="<?= $_SESSION['url'] ?>gestionVeille" class="btn btn-primary pt-3 pb-4 m-3">
              <strong>Veille réglementaire</strong>
            </a>
         
    </section>
</div>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>