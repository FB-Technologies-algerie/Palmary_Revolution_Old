<?php $title="detail maquette" ?>

<?php ob_start(); ?>
<div style="width: 98%">
  <div class="row">
    <div class="col p-0 pt-1">
      <div class="btn-group float-right">
  <div class="btn-group dropleft" role="group">
    <button type="button" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-bars"></i>

    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" target="_blank" href="<?= $_SESSION['url'].'magasin/afficheIMG/'.$idArrivage.'/'.$detailArrivage['extentionMaquette'] ?>">Télécharger</a>
      <a class="dropdown-item" target="_blank" href="<?= $_SESSION['url'].'magasin/verifCouleurArrivage/'.$idArrivage ?>">Comparaisons couleur</a>
      <a class="dropdown-item" target="_blank" href="<?= $_SESSION['url'].'magasin/verifTextArrivage/'.$idArrivage ?>">Comparaisons texte</a>
    </div>
  </div>

</div>
    </div>
  </div>
<div style="width: 95%;">

<form action="" method="post" enctype="multipart/form-data" class="remarqueForm">
  <div class="row">
    <div class="col-8">
      <div style="width: 100%;border: #263238 solid 1px;text-align: center;">
    <img style=" width:  100%;"  src="<?= $_SESSION['url'].'magasin/afficheIMG/'.$idArrivage.'/'.$detailArrivage['extentionMaquette'] ?>">
  </div>
    </div>
    <div class="col-4">
        <div class="text-center">
   <?php for($i=0;$i<8;$i++){ ?>
       <div class="d-inline-block m-0">
      <div id="LDP_modif" class="input-group form-group mx-left m-0"> 
          <label for="<?= $i ?>" class="label justify-content-middle text-center my-auto" style="width:200px !important" ><?= $listMention[$i] ?></label>
          <div class="onoffswitch d-inline-block" style="width: 100px">
              <input type="checkbox" name="value<?= $i ?>" class="onoffswitch-checkbox" id="<?= $i ?>" <?php if($valMention[$i]) echo "checked"; ?>>
              <label style="text-align: center;" class="onoffswitch-label" for="<?= $i ?>">
                  <span class="onoffswitch-inner"></span>
                  <span class="onoffswitch-switch" style="right: 50px"></span>
              </label>
          </div>
      </div>
      </div>
      <hr class="m-1">

   <?php } ?>
    </div>
    </div>
  </div>

  

<hr>


   <div class="form-group row mt-3">
    <label for="" class="col-sm-2 col-form-label">Remarque</label>
    <div class="col-sm-10">
      <textarea name="remarqueMaquette" class="form-control detail"><?= $detailArrivage['remarque'] ?></textarea>
    </div>
  </div>

   <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Etat maquette</label>
    <div class="col-sm-10">
      <select name="etatMaquette" class="form-control detail">
       <option <?= ($detailArrivage['etatMaquette']==0)?'selected':'' ?>>En attente</option>
       <option <?= ($detailArrivage['etatMaquette']>0 && $detailArrivage['etatMaquette']<255)?'selected':'' ?>>En validation</option>
       <option <?= ($detailArrivage['etatMaquette']<0)?'selected':'' ?>>Refuser</option>
       <option <?= ($detailArrivage['etatMaquette']==255)?'selected':'' ?>>Valider</option>
      </select>
    </div>
  </div>
      <input type="submit" id="btnModif" name="valideEtat" class="btn btn-primary mx-auto" style="    display: inherit;" value="VALIDER" >

</form>

</div>
 </div><br><br>

<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?> 
 <script>
  function validateFileType(){
        var fileName = $('#file-maquette input').val();
        $('#file-maquette label').html(fileName);
        var extFile = fileName.substr(fileName.lastIndexOf(".") + 1, fileName.length).toLowerCase();

        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
            alert("ce fichier n'est pas valide");;
            $('#file-maquette label').html("ce fichier n'est pas valide");

        }   
    }
 </script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>