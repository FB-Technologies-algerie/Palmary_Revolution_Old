<?php $title='choisir groupe' ?>
<?php ob_start(); ?>
  <div id="bodyAuth">
    <img src="<?= $_SESSION['url'] ?>public/img/palmarylogo.png" id="logoAuth" class="float-center"> <!--LOGO-->
    <div class="auth p-4 mx-auto" id="panelAuth" style="width:300px;"> <!--AUTHENTIFICATION-->
         <div class="container">
             <form id="form" action="" method="POST">
                <label for="groupe">Groupe:</label>
                <input required type="number" class="form-control" placeholder="saisire votre groupe" name="groupe" id="groupe">
                <input type="submit" class=" btn btn-primary btn-block mt-4">
             </form>
       </div>
    </div>
  </div> 
<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>
<script>
    $(function() {
  $('body').on('keydown', '.form-control', function(e) {
    console.log(this.value);
    if (e.which === 32 &&  e.target.selectionStart === 0) {
      return false;
    }  
  });
});
</script>
