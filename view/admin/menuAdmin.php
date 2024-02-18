<?php $title='menu administrateur' ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
 <?php require('view/navbar.php') ?>
    <section id="btnList" class="mt-5 mx-auto">
        <div class="d-flex flex-column justify-content-center ">
            <a href="<?= $_SESSION['url'] ?>gestionUtilisateurs" class="btn btn-primary pt-4 pb-4 m-3">
            	<strong>GESTION DES UTILISATEURS</strong>
            </a>
        <?php if($_SESSION['droitAdmin']==','){ ?>
            <a href="<?= $_SESSION['url'] ?>gestionUnitesProd" class="btn btn-primary pt-4 pb-4 m-3">
                <strong>GESTION DES UNITÉS DE PRODUCTION</strong>
            </a>
        <?php } ?>
            <a href="<?= $_SESSION['url'] ?>gestionLignesProd" class="btn btn-primary pt-2 pb-2 m-3">
            	<strong>GESTION DES <br> LIGNES DE PRODUCTIONS</strong>
            </a>
            <a href="<?= $_SESSION['url'] ?>gestionProd" class="btn btn-primary pt-4 pb-4 m-3">
            	<strong>GESTION DES PRODUITS</strong>
            </a>  
    </section>
</div>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>