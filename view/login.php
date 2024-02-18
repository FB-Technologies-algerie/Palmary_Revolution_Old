<?php $title='Authentification' ?>

<?php ob_start(); ?>
  <div id="bodyAuth">
    <img src="<?= $_SESSION['url'] ?>public/img/palmarylogo.png" id="logoAuth" class="float-center"> <!--LOGO-->
    <div class="auth p-4 mx-auto" id="panelAuth" style="width:300px;"> <!--AUTHENTIFICATION-->
         <div class="container">
             <form id="form" action="" method="POST">
                <?php if(isset($erreur)){ echo '<div id="errorLogin" style="margin-bottom:5px;" >Erreur d\'authentification, votre nom ou mot de passe est incorrecte</div>'; } ?>
                 <div class="form-group has-error">
                     <label for="user">Nom d'utilisateur</label>
                     <input required type="text" class="form-control" placeholder="Nom d'utilisateur" name="user" id="user" <?php if(isset($erreur)){ echo 'style0="border: #800000 solid 2px" data-toggle="popover"  data-content="Erreur d\'authentification, votre nom ou mot de passe sont incorrecte" '; } ?> >
                     <script>$('#user').popover('show');</script>
                 </div>
                 <div class="form-group required">
                     <label for="password">Mot de passe</label>
                     <input required type="password" class="form-control" placeholder="Mot de passe" id="password" name="password">
                  </div>
                 <input type="submit" class=" btn btn-primary btn-block mt-4">
             </form>
       </div>
    </div>
  </div> 
<?php $content= ob_get_clean(); ?>
<?php require('gabarit.php') ?>
