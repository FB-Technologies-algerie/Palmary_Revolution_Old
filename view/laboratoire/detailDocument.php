<?php $title="detail document" ?>

<?php ob_start(); ?>
<div style="width: 98%">
  <div class="row">
   <?php if($id_document!=-1){ ?>
    <div class="col p-0 pt-1">
      <div class="btn-group float-right">
  <div class="btn-group dropleft" role="group">
    <button type="button" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-bars"></i>

    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" target="_blank" 
                        <?php if($document['fileDocument']['type']=='LINK'){ ?>
                          href="<?= $document['fileDocument']['lien'] ?>"
                        <?php }elseif($document['fileDocument']['type']=='FILE'){ ?>
                          href="<?= $_SESSION['url'].'telecharger/Document/'.$id_document ?>"
                        <?php } ?>
      >Ouvrir</a>
      <button class="dropdown-item alert-danger" href="" data-toggle="modal" data-target="#supprime">Supprimer</button>
    </div>
  </div>

</div>
    </div>
<?php } ?>
  </div>
<div style="width: 95%;">
<form Document="" method="post" enctype="multipart/form-data" class="documentForm">

  <div class="form-group row mt-1">
    <label for="" class="col-sm-2 col-form-label">titre</label>
    <div class="col-sm-10">
      <input <?= ($id_document!=-1)?'disabled':'' ?> type="text" name="nomDocument" class="form-control detail" placeholder="" value="<?= $document['nomDocument'] ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Description document</label>
    <div class="col-sm-10">
      <textarea <?= ($id_document!=-1)?'disabled':'' ?> name="descriptionDoc" class="form-control detail"><?= $document['descriptionDoc'] ?></textarea>
    </div>
  </div>
     <div class="form-group row inputAffiche" <?= ($id_document!=-1)?'style="display: none;"':'' ?>>
        <label for="" class="col-sm-2 col-form-label">document</label>
          <div class="col-sm-10" style="align-self: center;"> 
            <div>
                  <!--<span class="textAffiche">
                    <a  target="_blank"
                        <?php if($document['fileDocument']['type']=='LINK'){ ?>
                          href="<?= $document['fileDocument']['lien'] ?>"
                        <?php }elseif($document['fileDocument']['type']=='FILE'){ ?>
                          href="<?= $_SESSION['url'].'telecharger/Document/'.$id_document ?>"
                        <?php } ?>
                    />
                      <?= $document['nomDocument'] ?>   
                    </a>
                  </span>-->
                  <div id="lienDocument">
                      <div class="form-check" id="FILEdocument">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienDocument"
                        value="FILE"
                        id="fileDocument"
                        <?= ($document['fileDocument']['type']=='FILE')?'checked':'' ?>
                        onchange="toggleLien('lienDocument')"
                      />
                      <label class="form-check-label" for="fileDocument">
                        Importer un fichier
                        <input type="file" id="fichierDocument" name="lienDocument" class="fichier"
                        <?php if($document['fileDocument']['type']=='FILE'){ ?>
                          value="<?= $document['fileDocument']['lien'] ?>"
                        <?php }else{ ?>
                          disabled
                        <?php } ?> 
                        />
                      </label>
                    </div>

                    <div class="form-check" id="LINKdocument">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienDocument"
                        value="LINK"
                        id="linkDocument"
                        <?= ($document['fileDocument']['type']=='LINK')?'checked':'' ?>
                        onchange="toggleFichier('lienDocument')"
                      />
                      <label class="form-check-label row" for="linkDocument">
                        <span class="col-sm-12">Lien</span>
                        <input
                          type="text"
                          class="form-control lien col-sm-4 mr-2"
                          id="lienDocument"
                          name="lienDocument"
                          placeholder="https://"
                        <?php if($document['fileDocument']['type']=='LINK'){ ?>
                          value="<?= $document['fileDocument']['lien'] ?>"
                        <?php }else{ ?>
                          disabled
                        <?php } ?>
                        />
                        <select 
                          class="form-control lien col-sm-4"
                          name="typeDocument"
                         <?php if($document['fileDocument']['type']!='LINK'){ ?>
                          disabled
                         <?php } ?>
                        >
                          <option <?= ($document['typeDocument']=="autre")?'selected':'' ?> 
                            value="autre">type du document</option>
                          <option <?= ($document['typeDocument']=="word")?'selected':'' ?> 
                            value="word">word</option>
                          <option <?= ($document['typeDocument']=="excel")?'selected':'' ?> 
                            value="excel">excel</option>
                          <option <?= ($document['typeDocument']=="powerPoint")?'selected':'' ?> 
                            value="powerPoint">power point</option>
                          <option <?= ($document['typeDocument']=="pdf")?'selected':'' ?> 
                            value="pdf">pdf</option>
                          <option <?= ($document['typeDocument']=="image")?'selected':'' ?> 
                            value="image">image</option>
                          <option <?= ($document['typeDocument']=="audio")?'selected':'' ?> 
                            value="audio">audio</option>
                          <option <?= ($document['typeDocument']=="video")?'selected':'' ?> 
                            value="video">vidéo</option>
                        </select>
                      </label>
                    </div>
                  </div>
              </div>
            </div>
          </div>


<?php if($id_document!=-1){ ?>
  <input type="button" id="btnModif" name="valideModif" class="btn btn-primary d-block mx-auto" onclick="activeForm('documentForm')" value="MODIFIER" >
<?php }else{ ?>
  <input type="submit" id="btnAjout" name="valideAjout" class="btn btn-primary d-block mx-auto" value="VALIDER" >
<?php } ?>
</form>
</div>
 </div>

 <!--Modal SUPPRIMER-->
  <div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SUPPRESSION DU DOCUMENT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p style="font-size:20px;">Vous voulez vraiement supprimer ce document ?</p>
              </div>
              <div class="modal-footer mx-auto">
                <a href="<?= $_SESSION['url'].'supprimeDocument/'.$id_document ?>" id="confirmSup" class="btn btn-primary">Oui</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>  
              </div>
            </div>
        </div>
    </div>

<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?> 
 <script>
  function activeForm(form){
    if($('.'+form+' #btnModif').attr('value')=='VALIDER')
      $('.'+form+' #btnModif').attr('type','submit') ;
    else{
      $('.'+form+' #btnModif').attr('value','VALIDER');
      $('.'+form+' .detail').removeAttr('disabled');
      $(".inputAffiche").css("display", "flex");
    }
  }

  function toggleLien(className){
        $('#'+className+" .lien").prop("disabled", true)
        $('#'+className+" .fichier").prop("disabled", false)

      }

  function toggleFichier(className){
        $('#'+className+" .fichier").prop("disabled", true);
        $('#'+className+" .lien").prop("disabled", false);
      }
 </script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>