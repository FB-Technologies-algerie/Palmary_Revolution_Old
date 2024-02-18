<?php $title='historique' ?>

<?php ob_start(); ?>
  
  <form method="post" action="">
<div id="accordion">

     <div class="card m-0 mt-2 mb-3">
        <div class="card-header" id="headingOne" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
                   <h5 class="mb-0">
        <div style="font-weight: bold;cursor: pointer;" aria-expanded="true"  onclick="toggleMaquette()">
          MAQUETTE
        </div>
      </h5>
        </div>

<div id="collapseMaquette" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       <div class="d-flex flex-wrap">
            <a class="m-2 btnAdd" href="#" onclick="detailMaquette(this,-1)">
              <i class="fas fa-plus iconAdd" style="line-height: 150px;"></i>
            </a>
    <?php while(!is_null($listeMaquette) && $maquette = $listeMaquette->fetch()){ ?>
            <div onclick="detailMaquette(this,<?= $maquette['id_maquette'] ?>)" class="m-2 btnMaquette" href="#" style="cursor: pointer; background: url(<?= $_SESSION['url'].'afficheMaquette/'.$id_version.'-'.$maquette['id_maquette'].'/'.$maquette['extensionMaquette'] ?>) no-repeat center;background-size: contain;">
              <div style="height: 80%">
                 <div class="text-center bottomMaquettetype"><?= $maquette['typeMaquette'] ?></div>
              </div>
              <div class="text-center bottomMaquette"><?= $maquette['titreMaquette'] ?></div>

            </div>
   <div class="btn-group float-right dropleft menuMaquette">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" target="_blank" href="<?= $_SESSION['url'].'afficheMaquette/'.$id_version.'-'.$maquette['id_maquette'].'/'.$maquette['extensionMaquette'] ?>">Télécharger</a>
    <a class="dropdown-item" target="_blank" href="<?= $_SESSION['url'].'compareMaquetteCouleur/'.$id_version.'-'.$maquette['id_maquette'].'/'.$maquette['extensionMaquette'] ?>">Comparaisons couleur</a>
    <a class="dropdown-item" target="_blank" href="<?= $_SESSION['url'].'compareMaquetteText/'.$id_version.'-'.$maquette['id_maquette'].'/'.$maquette['extensionMaquette'] ?>">Comparaisons texte</a>
  </div>
  
</div>
    <?php } ?>
      </div>
      </div>
    </div>

  </div>
  </div>




<div id="accordion">

  <div class="card m-0">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
        <h5>
          <div style="font-weight: bold;cursor: pointer;" aria-expanded="true"  onclick="toggleTrad()">
            LISTE DES INGREDIENTS
          </div>
        </h5>
         
           
      </div>
        <div id="collapseTrad" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body pt-3">

       <div class="form-group row">
              <label  class="col-sm-2 col-form-label">Français</label>
              <div class="col-sm-10">
                <textarea id="francais" class="w-100" disabled><?= $version['listeIngredientFR'] ?></textarea>
                <input type="button" id="btnModif" class="btn btn-primary float-right" onclick="activeTraduction()" value="MODIFIER" >
             </div>
        </div>

         <div class="form-group row">
              <label  class="col-sm-2 col-form-label">Anglais</label>
              <div class="col-sm-10">
              <textarea id="anglais" class="w-100" disabled><?= $version['listeIngredientEN'] ?></textarea>
              </div>
        </div>

         <div class="form-group row">
              <label  class="col-sm-2 col-form-label">Arabe</label>
              <div class="col-sm-10">
              <textarea id="arabe" style="direction: rtl;" class="w-100 text-right" disabled><?= $version['listeIngredientAR'] ?></textarea>
              </div>
        </div>

         <div class="form-group row">
              <label  class="col-sm-2 col-form-label">Espagnol</label>
              <div class="col-sm-10">
              <textarea id="espagnol" class="w-100" disabled><?= $version['listeIngredientES'] ?></textarea>
              </div>
        </div>

        <div class="form-group row">
              <label  class="col-sm-2 col-form-label">Portugais</label>
              <div class="col-sm-10">
              <textarea id="portugais" class="w-100" disabled><?= $version['listeIngredientPT'] ?></textarea>
              </div>
        </div>
      </div>
    </div>
    </div>
</div>




<div id="accordion">

  <div class="card m-0">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
        <h5 class="d-inline-block" style="width: 89%;">
          <div style="font-weight: bold;cursor: pointer;" aria-expanded="true" onclick="toggleNutr()">
            TABLE NUTRITIONNELLE
          </div>
        </h5>
        <a href="" data-toggle="modal" data-target="#ajoutNutrition" onclick="detailNutrition()"  class="btn btn-primary float-right btnAlign"> MODIFIER</a>
           


      </div>
        <div id="collapseNutr" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
   
    <style>
      #table td, #table th{font-size: 17px;}
      #table{width:650px;text-align:center;}
    </style>
    <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-hover table-bordered table-sm">
                    <thead class="w-100">
                        <tr>
                          <th colspan="2">
                            VALEUR NUTRITIONNELLE ET ENERGETIQUE POUR 100 g / NUTRITIONAL AND ENERGY VALUE 100 g / VALOR NUTRICIONAL E ENERGÉTICO 100 g / VALOR NUTRICIONAL Y ENERGÉTICO 100g / القيمة الغذائية و الطاقوية 100 غ
                          </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while ($nutrition = $listNutrition->fetch()){ ?>
                        <?php $tab['n'.$nutrition['id_nutrition']]=$nutrition['valeurNutrition']; ?>
                          <tr>
                           <th>
                             <?= $nutrition['textNutrition'] ?>
                           </th>
                           <td style="width: 40%;">
                             <div style="display: inline-block;"><?= explode('!i!', $nutrition['valeurNutrition'])[0] ?></div>
                             <div style="display: inline-block;"><?= (isset(explode('!i!', $nutrition['valeurNutrition'])[1]))?explode('!i!', $nutrition['valeurNutrition'])[1]:'' ?></div>                 
                           </td>
                          </tr>
                      <?php } ?> 
                    </tbody>                             
                </table>
            </div>
        </div>
    </div>
    </div>
</div>

<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?> 
<script>
  function toggleMaquette(){
    $('#collapseMaquette').collapse('toggle')
  }
  function toggleTrad(){
    $('#collapseTrad').collapse('toggle');
  }
  function toggleNutr(){
    $('#collapseNutr').collapse('toggle');
  }
  function activeTraduction(){
    if($('#btnModif').attr('value')=='TRADUIRE'){
      traduireList($('#francais').val());
      
      $('#btnModif').attr('value','MODIFIER');
      $('#francais').attr('disabled','disabled');
    }
    else{
      $('#btnModif').attr('value','TRADUIRE');
      $('#francais').removeAttr('disabled');
    }
  }

  function traduireList(listeIngrediantFR) {
      $.post("<?= $_SESSION['url'] ?>detailVersion/traduire",
              {listeIngrediantFR: listeIngrediantFR, id_version: "<?= $version['id_version'] ?>" },
              function(data, status){
                var reponse =JSON.parse(data);

                $('#anglais').html(reponse['EN']);
                $('#arabe').html(reponse['AR']);
                $('#portugais').html(reponse['PT']);
                $('#espagnol').html(reponse['ES']);
              });
  }
  
  function detailMaquette(val,id_maquette) {

    if(id_maquette !=-1){
          window.parent.document.getElementById('titreR').textContent = val.getElementsByClassName('bottomMaquette')[0].textContent
    }
    else{
      window.parent.document.getElementById('titreR').textContent = "Nouvelle Maquette"
    }

    //
    window.parent.$('#maquetteModal').modal('toggle')
    window.parent.$('#maquetteModal iframe').attr('src','<?= $_SESSION['url'].'detailMaquette/'.$version['id_version'] ?>/'+id_maquette);
   
  }


  function detailNutrition() {
    var nutristion = <?php echo json_encode($tab) ?> ;
    window.parent.resetNutr(); 
  
    if( nutristion!=null){
      var idNut = Object.keys(nutristion);
      for (var i = 0; i < idNut.length; i++) {
        window.parent.$('#'+idNut[i]+'ar').val(nutristion[idNut[i]].split('!i!')[0]);
        window.parent.$('#'+idNut[i]+'fr').val(nutristion[idNut[i]].split('!i!')[1]);
      }
    }
    window.parent.$('#nutritionModal').modal('toggle');
  }
</script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>
