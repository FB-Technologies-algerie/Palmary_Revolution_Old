<?php $title="modification d'un emballage de produit" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>

    <h1 class="display-block mt-3 display-5 text-white" style="text-align: center;"><?= $produit['nomProd'] ?></h1>
    <div class="d-block text-right mr-5">
                      <button class="btn btn-primary mr-5 mt-4" onclick="window.print();">IMPRIMER</button>

          </div>



    <div class="row">
      <div class="col">
         <div class="card mr-1">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">PRODUIT</span></div>
        <div class="card-body">
            <form class="detailProd" method="post" action="">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Nom du Produit</label>
                      <div class="col-sm-8">
                        <input disabled type="text" name="nomProd" class="form-control detail" value="<?= $produit['nomProd'] ?>" placeholder="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Code article</label>
                        <div class="col-sm-8">
                          <input disabled type="text" name="codeArticle" value="<?= $produit['codeArticle'] ?>" class="form-control detail" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Code à barre</label>
                        <div class="col-sm-8">
                          <input disabled type="text" name="codeBarre" value="<?= $produit['codeBarre'] ?>" class="form-control detail" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Groupe </label>
                      <div class="col-sm-8">
                        <select disabled id="idGroupe"  name="idGroupe" class="custom-select custom-select-lg detail">
                            <option value="null" >Aucun groupe</option>
                          <?php foreach ($listeToutGroupe as $groupe) { ?>
                            <option     value="<?= $groupe->id_groupeProd ?>" ><?= $groupe->nomGroupeProd ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <input type="button" id="btnModif" onclick="activeModif('Prod')" class="btn btn-primary mx-auto" name="validerProd" style="width:auto !important;display:block" value="MODIFIER">
            </form>
               
        </div>
    </div>
      </div>

      
      <div class="col">
                <div class="card ml-1">
<div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">
  VERSION 

  <div class="float-right">
          <?php if($version= $listeVersion->fetch()){ $versionSelect=$version; } ?>
    <div class="dropdown d-inline mt-4" style="margin-left:80px">
      <button class="btn btn-primary" onclick="afficheVersion(-1,'','<?= date('Y-m-d') ?>','')"><i class="fas fa-plus-circle" style="color: white"></i></button>
    <?php if(isset($versionSelect)){ ?>
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        LISTE DES VERSIONS
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        
        <button onclick="afficheVersion(<?= $versionSelect['id_version'].",'".valid($versionSelect['titreVersion'])."','".valid($versionSelect['dateVersion'])."','".valid($versionSelect['descriptionVersion'])."'" ?>)" class="dropdown-item"><?= $versionSelect['titreVersion'] ?></button>
      <?php while($version= $listeVersion->fetch()){?>
        <button onclick="afficheVersion(<?= $version['id_version'].",'".valid($version['titreVersion'])."','".valid($version['dateVersion'])."','".valid($version['descriptionVersion'])."'" ?>)" class="dropdown-item"><?= $version['titreVersion'] ?></button>
        <?php if($version['id_version']==$idSelect)$versionSelect=$version; ?>
      <?php } ?>
      </div>
    <?php } ?>
    </div>
   </div>
  </div>
        <div class="card-body">
            <form method="post" class="detailVersion <?= (isset($versionSelect))?'':'d-none'; ?>" action="">
                    <div class="form-group row">
                      <input type="text" name="id_version" class="form-control d-none" value="<?= (!isset($versionSelect))?'':$versionSelect['id_version'] ?>" placeholder="">
                      <label class="col-sm-4 col-form-label">Numéro de la version</label>
                      <div class="col-sm-8">
                        <input disabled type="text" name="titreVersion" class="form-control detail" value="<?= (!isset($versionSelect))?'':$versionSelect['titreVersion'] ?>" placeholder="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Date de la version</label>
                      <div class="col-sm-8">
                        <input disabled type="date" name="dateVersion" value="<?= (!isset($versionSelect))?'':$versionSelect['dateVersion'] ?>" class="form-control detail" placeholder="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Description</label>
                      <div class="col-sm-8">
                        <textarea disabled name="descriptionVersion" class="w-100 detail"><?= (!isset($versionSelect))?'':$versionSelect['descriptionVersion'] ?></textarea>
                      </div>
                    </div>
                    <input type="button" id="btnModif" onclick="activeModif('Version')" class="btn btn-primary mx-auto" name="validerVersion" style="width:auto !important;display:block" value="MODIFIER">
            </form>
               
        </div>
    </div>
      </div>
    </div>

   


      


  <div id='cardVersion' class="card <?= (isset($versionSelect))?'':'d-none'; ?>">
      <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
       <span id='titreVersion' class="cardTitle"><?= (!isset($versionSelect))?'':$versionSelect['titreVersion'] ?></span>
      </div>
    <div class="card-body">
       <iframe id="detailVersion" src="<?= (!isset($versionSelect))?'':$_SESSION['url'].'detailVersion/'.$versionSelect['id_version'] ?>" style="width: 100%;" scrolling="no" onload="resizeIframe(this)" class="embed-responsive-item" frameborder="0"></iframe>
  </div>
 </div>


</div>



  <div class="modal fade" id="maquetteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titreR">Nouvelle maquette</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="<?= $_SESSION['url'].'detailMaquette/' ?>" height="400" frameborder="0" class="w-100"></iframe>
      </div>
    </div>
   </div>
  </div>

  <div class="modal fade" id="nutritionModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog ">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="titremodifier">Nutrition</h5>
                 
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div style="display: inline-block;"><?= 'غ  ' ?></div>
                    <div style="display: inline-block;"><?= ' 55 cc' ?></div>
 
                  <form method="post" id="formSave" action="<?= $_SESSION['url'] ?>detailVersion/saveNutrition/<?= $produit['id_prod'] ?>-<?= $versionSelect['id_version'] ?>">
                    

                    <?php while ($nutristion = $listeNutrition->fetch()){ ?>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                      <label style="width:40%" for="text" class="ldpLabel justify-content-middle text-left" ><?= $nutristion['textNutrition'] ?></label>
                      <input type="text" class="form-control nutristion" name="<?= $nutristion['id_nutrition'] ?>ar" id="n<?= $nutristion['id_nutrition'] ?>ar" placeholder="عربي" style="direction: rtl;">
                      <input type="text" class="form-control nutristion" name="<?= $nutristion['id_nutrition'] ?>fr" id="n<?= $nutristion['id_nutrition'] ?>fr" placeholder="français">
                    </div>
                    <hr>
                   <?php } ?>

                   <div class="input-group mb-3">

                    </div>
                   
                    <div class="modal-footer d-block text-center">
                      <input type="submit" name="validerValeur" class="btn btn-primary w-auto" value="VALIDER">

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button> 
                       
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

<div class="modal fade" id="nutritionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titreN">nutrition</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="<?= $_SESSION['url'].'detailVersionProd/' ?>" height="400" frameborder="0" class="w-100"></iframe>
      </div>
    </div>
   </div>
  </div>

<script type="text/javascript">

  function refresh() {
    setTimeout(function () {
      window.location.reload()
    }, 500);
  }

</script>

<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?> 
<script> 

 

  function afficheVersion(id_version,titreVersion,dateVersion,descriptionVersion){
    $('input[name="id_version"]').attr('value',id_version);
    $('input[name="titreVersion"]').attr('value',titreVersion);
    $('input[name="dateVersion"]').attr('value',dateVersion);
    $('textarea[name="descriptionVersion"]').html(descriptionVersion);
    $('form.detailVersion').removeClass('d-none');

    if(id_version==-1){
      activeModif('Version');
      $('#cardVersion').addClass('d-none');
    }else{
      $('iframe#detailVersion').attr('src','<?= $_SESSION['url'] ?>detailVersion/'+id_version);
      $('#titreVersion').html(titreVersion);
      $('#cardVersion').removeClass('d-none');
      $('#formSave').attr('action','<?= $_SESSION['url'] ?>detailVersion/saveNutrition/<?=$produit['id_prod']?>-'+id_version);
    }
  }

  function activeModif(form){ 
   // console.log($('.detail'+form+' #btnModif').attr('value'));
    if($('.detail'+form+' #btnModif').attr('value')=='VALIDER')
      $('.detail'+form+' #btnModif').attr('type','submit');
    else{
      $('.detail'+form+' #btnModif').attr('value','VALIDER');
      $('.detail'+form+' .detail').removeAttr('disabled');
    }
  }

  function resetNutr(){
    $('.nutristion').val('');
  }

console.log('<?= $produit['id_groupeProd'] ?>');
  $("#idGroupe").val("<?=($produit['id_groupeProd'] !='')? $produit['id_groupeProd']: 'null' ?>");
 
</script>



<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>
