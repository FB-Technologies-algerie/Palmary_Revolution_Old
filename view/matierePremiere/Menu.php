<?php $title='Menu Emballage' ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
 <?php require('view/navbar.php') ?>

    <section id="btnList" class="mt-5 mx-auto">
        <div class="d-flex flex-column justify-content-center ">

                   <a href="<?= $_SESSION['url'] ?>gestionArchivage" class="btn btn-primary pt-3 pb-4 m-3">
              <strong>gestion d'arrivage</strong>
               </a>
            <!---->
              <a href="<?= $_SESSION['url'] ?>gestionMatiere" class="btn btn-primary pt-3 pb-4 m-3">
              <strong>gestion des matières</strong>
                     </a>
           
              </section>
                    </div>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>