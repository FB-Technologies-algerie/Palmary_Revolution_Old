<?php $title="modification d'un emballage de Parametre" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>

    <h1 class="display-block mt-3 display-5 text-white" style="text-align: center;"><?= $Parametre['nomParamAnal'] ?></h1>
    
    <div class="row">
      <div class="col">
         <div class="card">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">Parametre</span></div>
        <div class="card-body">
            <form class="detailProd" method="post" action="">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Nom du Paramètre</label>
                      <div class="col-sm-8">
                        <input disabled type="text" name="nomParam" class="form-control detail" value="<?= $Parametre['nomParamAnal'] ?>" placeholder="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                          <textarea disabled type="text" name="descriptionParam" class="form-control detail" placeholder=""><?= $Parametre['descriptionParamAnal'] ?></textarea>
                        </div>
                    </div>
                    <input type="button" id="btnModif" onclick="activeModif('Prod')" class="btn btn-primary mx-auto" name="validerModif" style="width:auto !important;display:block" value="MODIFIER">
            </form>
               
        </div>
    </div>
      </div>
     </div>

  <!-- ******************************** -->

  <div id="accordion">

     <div class="card mt-7 mb-3">
        <div class="card-header" id="headingOne" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
                   <h5 class="mb-0">
        <div style="font-weight: bold;cursor: pointer;" aria-expanded="true"  onclick="toggleMaquette()">
          LISTE DES DOCUMENTS
        </div>
      </h5>
        </div>

<div id="collapseMaquette" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       <div class="d-flex flex-wrap">
            <button class="m-2 btnAdd" onclick="detailDocument(-1,'Nouveau document')">
              <i class="fas fa-plus iconAdd" style="line-height: 150px;"></i>
            </button>
    <?php while(!is_null($listeDocument) && $document = $listeDocument->fetch()){ ?>
            <div onclick="detailDocument(<?= $document['id_docParam'] ?>,'<?= $document['nomDocument'] ?>')" class="m-2 btnMaquette <?= $document['typeDocument'] ?>" href="#" style="cursor: pointer;position:relative;background: rgb(218,218,218);">
              <div style="height: 80%"></div>
              <div class="text-center bottomMaquette"><?= $document['nomDocument'] ?></div>
            </div>
    <?php } ?>
       </div>
      </div>
    </div>

  </div>
  </div>

  <!-- ******************************** -->

<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titreR">Nouveau Document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="<?= ""//$_SESSION['url'].'detailDocument/' ?>" height="400" frameborder="0" class="w-100"></iframe>
      </div>
    </div>
   </div>
  </div>

<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titreR">Nouvelle document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="<?= $_SESSION['url'].'detailDocument/' ?>" height="400" frameborder="0" class="w-100"></iframe>
      </div>
    </div>
   </div>
  </div>

</div>

<style type="text/css">
  .btnMaquette:before {
    content: "\f15b";  /* this is your text. You can also use UTF-8 character codes as I do here */
    font-family: "Font Awesome 5 Free";
    left:-5px;
    font-size: 80px;
    font-weight: 900;
    position: absolute;
    left: 30%;
    color: #263238;
 }

 .btnMaquette.word:before {content: "\f1c2";}
 .btnMaquette.excel:before {content: "\f1c3";}
 .btnMaquette.powerPoint:before {content: "\f1c4";}
 .btnMaquette.pdf:before {content: "\f1c1";}
 .btnMaquette.image:before {content: "\f1c5";}
 .btnMaquette.audio:before {content: "\f1c7";}
 .btnMaquette.video:before {content: "\f1c8";}
</style>

<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?> 
<script>
  function detailDocument(idDoc,titreDoc) {
    $('#documentModal #titreR').text(titreDoc);
    $('#documentModal').modal('toggle');
    $('#documentModal iframe').attr('src','<?= $_SESSION['url'].'detailDocument/'.$Parametre['id_paramAnal'].'/' ?>'+idDoc); 
    
  }

  function activeModif(form){
    if($('.detail'+form+' #btnModif').attr('value')=='VALIDER')
      $('.detail'+form+' #btnModif').attr('type','submit') ;
    else{
      $('.detail'+form+' #btnModif').attr('value','VALIDER');
      $('.detail'+form+' .detail').removeAttr('disabled');
    }
  }


</script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>
