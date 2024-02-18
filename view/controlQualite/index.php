<?php $title="Contrôle Qualité" ?>

<?php ob_start(); ?> 
<style type="text/css">
  body{
    overflow:hidden;
  }
</style>
<div id="bodylignesP" style="overflow:hidden;">
<?php require('view/navbar.php') ?>
  
  <iframe style="height: 91vh;width: 100vw;" src="<?= $_SESSION['url'] ?>traitementImage"></iframe>

</div>
<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php'); ?>