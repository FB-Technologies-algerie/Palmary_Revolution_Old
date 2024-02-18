<?php $title="detail maquette" ?>

<?php ob_start(); ?>
<div style="width: 98%">
  <div class="row">
   <?php if($id_maquette!=-1){ ?>
    <div class="col p-0 pt-1">
      <div class="btn-group float-right">
  <div class="btn-group dropleft" role="group">
    <button type="button" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-bars"></i>

    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" target="_blank" href="<?= $_SESSION['url'].'afficheMaquette/'.$id_version.'-'.$id_maquette.'/'.$maquette['extensionMaquette'] ?>">Télécharger</a>
      <a class="dropdown-item" target="_blank" href="<?= $_SESSION['url'].'compareMaquetteCouleur/'.$id_version.'-'.$id_maquette.'/'.$maquette['extensionMaquette'] ?>">Comparaisons couleur</a>
      <a class="dropdown-item" target="_blank" href="<?= $_SESSION['url'].'compareMaquetteText/'.$id_version.'-'.$id_maquette.'/'.$maquette['extensionMaquette'] ?>">Comparaisons texte</a>
      <a class="dropdown-item alert-danger" href="" data-toggle="modal" data-target="#supprime">Supprimer cette maquette</a>
    </div>
  </div>

</div>
    </div>
<?php } ?>
  </div>
<div style="width: 95%;">
<form action="" method="post" enctype="multipart/form-data" class="maquetteForm">

  <div class="form-group row mt-1">
    <label for="" class="col-sm-2 col-form-label">titre</label>
    <div class="col-sm-10">
      <input <?= ($id_maquette!=-1)?'disabled':'' ?> type="text" name="titreMaquette" class="form-control detail" placeholder="" value="<?= $maquette['titreMaquette'] ?>">
    </div>
  </div>
    <div class="form-group row mt-1">
    <label for="" class="col-sm-2 col-form-label">Type maquette</label>
    <div class="col-sm-10">
  
      <select  <?= ($id_maquette!=-1)?'disabled':'' ?>  name="typeMaquette" class="selectNormeForm custom-select custom-select-lg  detail ">                  
            <option <?php if($maquette['typeMaquette']=='Primère') echo"selected" ?> value="Primère"  >Primère</option>
            <option <?php if($maquette['typeMaquette']=='Secondaire') echo"selected" ?> value="Secondaire" >Secondaire</option>
            <option <?php if($maquette['typeMaquette']=='Tertiaire') echo"selected" ?> value="Tertiaire" >Tertiaire</option>
            <option <?php if($maquette['typeMaquette']=='Autre') echo"selected" ?> value="Autre" >Autre</option>
        </select>
    </div>
  </div>
  <div class="form-group row mt-1">
    <label for="" class="col-sm-2 col-form-label">Dimension</label>
    <div class="col-sm-2">
      <input <?= ($id_maquette!=-1)?'disabled':'' ?> type="text" name="dimensionPasCoupe" class="form-control detail" title="Pas De Coupe" placeholder="Pas De Coupe" value="<?= $maquette['dimensionMaquette'][0] ?>">
    </div>
    <div class="col-sm-2">
      <input <?= ($id_maquette!=-1)?'disabled':'' ?> type="text" name="dimensionLese" class="form-control detail" title="Lèse" placeholder="Lèse" value="<?= $maquette['dimensionMaquette'][1] ?>">
    </div>
    <div class="col-sm-2">
      <input <?= ($id_maquette!=-1)?'disabled':'' ?> type="text" name="dimensionHauteur" class="form-control detail" title="Hauteur" placeholder="Hauteur" value="<?= $maquette['dimensionMaquette'][2] ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Description maquette</label>
    <div class="col-sm-10">
      <textarea <?= ($id_maquette!=-1)?'disabled':'' ?> name="descriptionMaquette" class="form-control detail"><?= $maquette['descriptionMaquette'] ?></textarea>
    </div>
  </div>
  
<?php if($id_maquette!=-1){ ?>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Date de depot: </label>
    <div class="col-sm-10">
      <span><?= $maquette['dateDepot'] ?></span>
    </div>
  </div>
<?php } ?>


  <div class="form-group row">
    <label class="col-sm-2 col-form-label" style="align-self: center;">Miniature </label>
    <div class="col-sm-10">
                <div class="onoffswitch d-inline-block">
              <input <?= ($id_maquette!=-1)?'disabled':'' ?> type="checkbox" id="miniatureProd" name="miniatureProd" class="onoffswitch-checkbox detail" <?= ($maquette['miniatureProd'])?'checked':'' ?> >
              <label style="text-align: center;" class="onoffswitch-label" for="miniatureProd">
                  <span class="onoffswitch-inner"></span>
                  <span class="onoffswitch-switch"></span>
              </label>
          </div>
    </div>
  </div>

    <div class="form-group row">
    <label class="col-sm-2 col-form-label" style="align-self: center;">Maquette reférence </label>
    <div class="col-sm-10">
                <div class="onoffswitch d-inline-block">
              <input <?= ($id_maquette!=-1)?'disabled':'' ?> type="checkbox" id="referenceProd" name="referenceProd" class="onoffswitch-checkbox detail" <?= ($maquette['referenceProd'])?'checked':'' ?> >
              <label style="text-align: center;" class="onoffswitch-label" for="referenceProd">
                  <span class="onoffswitch-inner"></span>
                  <span class="onoffswitch-switch"></span>
              </label>
          </div>
    </div>
  </div>


<?php if($id_maquette==-1){ ?>
  <div class="form-group row <?= ($id_maquette!=-1)?'d-none':'' ?>">
    <label for="" class="col-sm-2 col-form-label">Importer une maquette</label>
    <div class="col-sm-10">
      <div class="input-group mb-3">
        <div class="custom-file" id="file-maquette">
          <input type="file" accept="image/*" class="custom-file-input" name="maquette" onchange="validateFileType()">
          <label class="custom-file-label" for="file-maquette">inserer un fichier</label>
        </div>
        <div class="input-group-append"></div>
      </div>
    </div>
  </div>
<?php } ?>

<?php if($id_maquette!=-1){ ?>
  <input type="button" id="btnModif" name="valideDetail" class="btn btn-primary" onclick="activeForm('maquetteForm')" value="MODIFIER" >
<?php }else{ ?>
  <input type="submit" id="btnModif" name="valider" class="btn btn-primary d-block mx-auto" value="VALIDER" >
<?php } ?>
</form>
<hr>
<?php if($id_maquette!=-1){ ?>
  <div style="width: 100%;border: #263238 solid 1px;text-align: center;">
    <img style="max-height: 700px;" src="<?= $_SESSION['url'].'afficheMaquette/'.$id_version.'-'.$id_maquette.'/'.$maquette['extensionMaquette'] ?>">
  </div>

<form action="" method="post" enctype="multipart/form-data" class="remarqueForm">
   <div class="form-group row mt-3">
    <label for="" class="col-sm-2 col-form-label">Remarque</label>
    <div class="col-sm-10">
      <textarea disabled name="remarqueMaquette" class="form-control detail"><?= $maquette['remarqueMaquette'] ?></textarea>
    </div>
  </div>

   <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Etat maquette</label>
    <div class="col-sm-10">
      <select disabled name="etatMaquette" class="form-control detail">
       <option <?= ($maquette['etatMaquette']=='En attente')?'selected':'' ?>>En attente</option>
       <option <?= ($maquette['etatMaquette']=='À modifier')?'selected':'' ?>>À modifier</option>
       <option <?= ($maquette['etatMaquette']=='Valider')?'selected':'' ?>>Valider</option>
      </select>
    </div>
  </div>

  <input type="button" id="btnModif" name="valideRemarque" class="btn btn-primary float-right" onclick="activeForm('remarqueForm')" value="MODIFIER" >
</form>
<?php } ?>
</div>
 </div>

   <!--Modal SUPPRIMER-->
  <div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SUPPRESSION D'UNE MAQUETTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p style="font-size:20px;">Vous voulez vraiement supprimer cette maquette ?</p>
              </div>
              <div class="modal-footer mx-auto">
                <a href="<?= $_SESSION['url'].'supprimeMaquette/'.$id_version.'-'.$id_maquette.'/'.$maquette['extensionMaquette'] ?>" id="confirmSup" class="btn btn-primary">Oui</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>  
              </div>
            </div>
        </div>
    </div>

<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?> 
 <script>
  function activeForm(form){
    if($('.'+form+' #btnModif').attr('value')=='VALIDER'){
      $('.'+form+' #btnModif').attr('type','submit') ;
   
   myVar = setTimeout(relaodPage, 3000); 
       console.log($('#detailVersion',window.parent.document).attr('src'));

    }else{
      $('.'+form+' #btnModif').attr('value','VALIDER');
      $('.'+form+' .detail').removeAttr('disabled');

    } 
    
  }
  function relaodPage(){
   var lien =  $('#detailVersion',window.parent.document).attr('src');
       //$('#detailVersion',window.parent.document).attr('src',"");
       //$('#detailVersion',window.parent.document).attr('src',lien+'iiii')
          console.log($('#detailVersion',window.parent.document).attr('src'));
          $('#detailVersion',window.parent.document).attr('src',lien);
  }

  function validateFileType(){
        var fileName = $('#file-maquette input').val();
        $('#file-maquette label').html(fileName);
        var extFile = fileName.substr(fileName.lastIndexOf(".") + 1, fileName.length).toLowerCase();
        
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png" || extFile=="gif" || extFile=="csv" || extFile=="tif" || extFile=="tiff"){
            //TO DO
        }else{
            alert("ce fichier n'est pas valide");;
            $('#file-maquette label').html("ce fichier n'est pas valide");

        }   
    }
 </script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>