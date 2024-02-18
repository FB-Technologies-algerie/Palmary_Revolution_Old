<?php $title='menu concepteur' ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
 <?php require('view/navbar.php') ?>

    <section id="btnList" class="mt-5 mx-auto">
        <div class="d-flex flex-column justify-content-center ">
            <a href="<?= $_SESSION['url'] ?>controleQualite" class="btn btn-primary pt-2 pb-2 m-3">
              <strong>CONTRÔLE QUALITÉ<br>DES CONCEPTIONS</strong>
            </a>  
            <a href="<?= $_SESSION['url'] ?>gestionTraduction" class="btn btn-primary pt-4 pb-4 m-3">
              <strong>GESTION DE TRADUCTION</strong>
            </a>
            <a href="<?= $_SESSION['url'] ?>gestionEmballage" class="btn btn-primary pt-2 pb-2 m-3">
              <strong>GESTION DES EMBALLAGES<br>DES PRODUITS</strong>
            </a>
    </section>
</div>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>