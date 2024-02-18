<?php $title='fiche de contrôle '.$nomProd; ?>

<?php ob_start(); ?>
<div id="bodySaisie">
  <?php require('view/navbar.php') ?>

    <header id="headerSaisie">            
    <div class="dropdown ml-3">
        <button class="btn btn-primary dropdown-toggle mt-3" id="btnDropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $ligne['nomLigneP']; ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <?php while ($prod = $listeProd->fetch()) { ?>
            <a class="dropdown-item" href="<?= $prod['id_prod']; ?>"><?= $prod['nomProd']; ?></a>
          <?php } ?>
        </div>
    </div>
 
        <h1 class="text-center w-100"><?= $nomProd; ?></h1>
        <h5 class="text-center"><?= $passage['dateHeure'] ?></h5>
        
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
    <?php while(!is_null($listeDocument) && $document = $listeDocument->fetch()){ ?>
      <?php $document['fileDocument']= reecrireLienA($document['fileDocument']); ?>
            <a  target="_blank" 
                class="m-2 btnMaquette <?= $document['typeDocument'] ?>"
                style="cursor: pointer;position:relative;background: rgb(218,218,218);text-decoration: none;"
              <?php if($document['fileDocument']['type']=='LINK' && $document['fileDocument']['lien']!=''){ ?>
                href="<?= $document['fileDocument']['lien'] ?>"
              <?php }elseif($document['fileDocument']['type']=='FILE'){ ?>
                href="<?= $_SESSION['url'].'telecharger/Document/'.$document['id_docProd'] ?>"
              <?php } ?>
            >
              <div style="height: 80%"></div>
              <div class="text-center bottomMaquette"><?= $document['nomDocument'] ?></div>
            </a>
            
    <?php } ?>
       </div>
      </div>
    </div>

  </div>
  </div>


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
       <form class="doc" method="post" action="">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Nom de document</label>
                      <div class="col-sm-8">
                        <input disabled type="text" id="nomDocument" name="nomDocument" class="form-control" value="" placeholder="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                          <textarea disabled type="text" id="DescriptionDoc" name="DescriptionDoc" class="form-control " placeholder=""></textarea>
                        </div>
                    </div>
            </form>

      </div>
    </div>
   </div>
  </div>







        <?php if($passage['dateHeure']!='' && date('Y-m-d',strtotime($passage['dateHeure']))!=date('Y-m-d')){ ?>
          <div class="modal fade" id="ancien" tabindex="-1" role="dialog" aria-hidden="true">
           <div class="modal-dialog" style="width: 700px;" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Attention!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">
                <p style="font-size:20px;">
                  Vous êtes sur le point de modifier un ancien passage non terminé<br>
                  Voulez vous le cloturer et commencer un nouveau passage ?
                </p>
              </div>
              <div class="modal-footer mx-auto">
                <button type="button" style="width: 150px;" class="btn btn-primary" onclick="recap(null)">Oui</button>
                <button type="button" style="width: 100px;" class="btn btn-secondary" data-dismiss="modal">Non</button>  
              </div>
            </div>
           </div>
          </div>
        <?php } ?>

    </header>

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
    <script type="text/javascript">
        function valid(value,min,max,alrt){
            if(value=='' || (value>=min && value<=max)){
                document.getElementById(alrt).style="display:none";
            }else{
                document.getElementById(alrt).style="display:inline";
            }
        }
        function calcul(idForm, formule){
          // la valeur de formule est de ce genre  "( ( @12278] - @12280] ) / @12278] ) * 100"
            formule = formule.split("@").join("n")
            formule = formule.split("]").join(".value")
            var result = document.querySelector('#n'+idForm);
            var res= parseFloat(eval(formule)).toFixed(2);

            if(res != '-Infinity' && res != 'NaN') {
                result.value = res;
                result.onchange();
                saveNorme(idForm,res);
            }else{
                result.value = '';
                saveNorme(idForm,'0');
            }
        }
        
        function saveNorme(id_norme,valueNorme) {  
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.open("POST", "<?= $_SESSION['url'] ?>ficheControle/saveNorme", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('id_passage=<?= $passage['id_passage'] ?>&id_norme='+id_norme+'&valueNorme='+valueNorme);
        }

        function ouiNon(valChecked){
          if(valChecked==true || valChecked=='oui') return 'oui'; else return 'non';
        }



    </script>

   <?php if(!$passage['id_passage']){ ?>
    <a href="<?= $_SESSION['url'] ?>ficheControle/ajoutPassage/<?= $id_prod ?>" class="btn btn-primary float-right mt-3 mr-5" id="nouvPassage">ajouter un nouveau passage</a><br><br> 
   <?php } ?>

  <?php if(($listeNormeP1!=null) || ($listeNormeP2!=null)){ ?>
    <section>
        <div class="card" style="border:#808080 solid 1px;"> 
            <div class="card-header" style="background-color:#D3D3D3;border-top-left-radius: 15px;border-top-right-radius: 15px;">
              <strong>LES NORMES DU PRODUIT</strong>
            </div>
            <div class="card-body" id="Carte_Produit">
                <div class="row">
                 <?php if($normeP1 = $listeNormeP1->fetch()){ ?>
                    <div class="col-md">
                    <?php
                        while ($normeP1) {
                          afficheNorme($normeP1);
                      $normeP1 = $listeNormeP1->fetch();
            }
                      ?>
                    </div>
                 <?php } ?>
                 <?php if($normeP2 = $listeNormeP2->fetch()){ ?>
                    <div class="col-md">
                      <?php
                        while ($normeP2) {
                          afficheNorme($normeP2);
                          $normeP2 = $listeNormeP2->fetch();
                        }
                      ?>
                    </div>
                 <?php } ?>
                </div>
            </div>
        </div>
    </section>
  <?php } ?>
<script id="test"> <?= $script; ?> </script>

<?php if($passage['id_passage']) require('view/process/recap.php'); ?>  

<?php $content= ob_get_clean(); ?>
<?php ob_start(); ?>  
<script>

  function EnterToTab(){
    var inputs = $(':input').keypress(function(e){ 
      if (e.which == 13) {
        e.preventDefault();
        var nextInput = inputs.get(inputs.index(this) + 1);
        if (nextInput) {
          nextInput.focus();
        }
      }
    });         
  }
  
  $(window).scroll(function(){
    if ($(window).scrollTop() >= 127) {
        $('#headerSaisie').addClass('fixed');
    }
    else {
        $('#headerSaisie').removeClass('fixed');
    }
  });

  <?php if(date('Y-m-d',strtotime($passage['dateHeure']))!=date('Y-m-d')){ ?>
    $('#ancien').modal('show');
  <?php } ?>
</script>
<?php $scriptJS= ob_get_clean(); ?>

<?php require('view/gabarit.php') ?>

<?php //*********************************************// ?>
<?php
  function lienDocument($lien,$type,$id_norme){
    $lien= reecrireLienA($lien);

    ob_start();
      if($lien['type']!='' && $lien['lien']!=''){ ?>
        <a class="ml-2" target="_blank" 
          <?php if($lien['type']=='LINK' && $lien['lien']!=''){ ?>
              href="<?= $lien['lien'] ?>"
          <?php }elseif($lien['type']=='FILE'){ ?>
              href="<?= $_SESSION['url'].'telecharger/'.$type.'/'.$id_norme ?>"
          <?php } ?>
        ><i class="fas fa-file"></i></a>
    <?php }
    $link= ob_get_clean();
    return $link;
  }

  function afficheNorme($norme){ 
    global $script;global $passage;global $oldPassage;global $id_prod;

?>
  <?php if($norme['typeNorme']=='groupe') {
          $listeNormeG = recupNormeProduit($id_prod,$norme['id_norme']);
  ?>
    <div class="groupeNorme card w-100 m-0 mb-1">
      <div class="card-header bg-dark text-light text-center" style="border-radius:15px 15px 0px 0px;font-weight:bold">
        <?= $norme['nomNorme'] ?>
        <?= lienDocument($norme['lienNorme'],'Groupe',$norme['id_norme']) ?>
      </div>
      <div class="card-body p-1" style="background-color:#F5F5F5;border:#343a40 solid 2px;border-radius:0px 0px 15px 15px;">
  <?php
          while ($normeG = $listeNormeG->fetch()) {
            afficheNorme($normeG); 
          }
  ?>
        </div>
    </div>
  <?php
        }else{ ?>
          <?php 
            $actuel= strtotime(date('Y-m-d H:i:s'));
            //$dernier= strtotime(recupLastTimeNorme($norme['id_norme'], $_SESSION['id_user']));
            $dernier = null;
            $lastTimeNorme = recupLastTimeNorme($norme['id_norme'], $_SESSION['id_user']);
              if ($lastTimeNorme !== null) {
                $dernier = strtotime($lastTimeNorme);
              }

            $difference= $norme['parTime'];

            $parTime= (($actuel-$dernier)>$difference)? 'actif' : 'disabled'; 
          ?>
    <?php if($norme['typeNorme']=='booleen'){ ?>
        <div id="LDP_modif" class="input-group  form-group mx-left mb-2 w-100"> 
            <label for="n<?= $norme['id_norme'] ?>" class="label justify-content-middle text-left my-auto" >
              <?= $norme['nomNorme'] ?>
              <?= lienDocument($norme['lienNorme'],'Norme',$norme['id_norme']) ?>
            </label>
          <?php $valNorm='non'; if($norme['isReset']==0) $valNorm=recupValNorm($passage['id_passage'],$norme['id_norme'],$oldPassage);
            else $valNorm=recupValNorm($passage['id_passage'],$norme['id_norme']);
          ?>
            <div class="onoffswitch">
                <input <?= $parTime ?> onkeydown="EnterToTab()" type="checkbox" name="value" onchange="saveNorme(<?= $norme['id_norme'] ?>,ouiNon(this.checked));" class="onoffswitch-checkbox <?= $parTime ?>" id="n<?= $norme['id_norme'] ?>" <?php if($valNorm=='oui') echo "checked"; ?> >
                <label class="onoffswitch-label" for="n<?= $norme['id_norme'] ?>">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
            <script> document.onload=saveNorme(<?= $norme['id_norme'] ?>,ouiNon('<?= $valNorm ?>'));</script>
        </div>
    <?php }elseif($norme['typeNorme']=='texte'){ ?>
        <div id="champProduit" class="input-group form-group mx-left mb-1 w-100" > 
            <label for="n<?= $norme['id_norme'] ?>" class="label justify-content-start text-left my-auto mb-2 ml-2" >
              <?= $norme['nomNorme'] ?>
              <?= lienDocument($norme['lienNorme'],'Norme',$norme['id_norme']) ?>
              </label>
          <?php
            $valNorm=''; if($norme['isReset']==0) $valNorm=recupValNorm($passage['id_passage'],$norme['id_norme'],$oldPassage);
            else $valNorm=recupValNorm($passage['id_passage'],$norme['id_norme']);
          ?>
            <input <?= $parTime ?> onkeydown="EnterToTab()" type="text" value="<?= $valNorm ?>" id="n<?= $norme['id_norme'] ?>" onchange="saveNorme(<?= $norme['id_norme'] ?>,this.value);" class="input input-lg form-control ml-2 <?= $parTime ?>">
            <script> document.onload=saveNorme(<?= $norme['id_norme'] ?>,'<?= $valNorm ?>');</script>
        </div>
    <?php }elseif($norme['typeNorme']=='valeur'){ ?>
        <div id="champProduit" class="input-group form-group mx-left mb-1 w-100" > 
            <label for="n<?= $norme['id_norme'] ?>" class="label justify-content-start text-left my-auto ml-2 mb-2" >
              <?= $norme['nomNorme'] ?>
              <?= lienDocument($norme['lienNorme'],'Norme',$norme['id_norme']) ?>
              </label>
          <?php
            if($norme['isReset']==0) $valNorm=recupValNorm($passage['id_passage'],$norme['id_norme'],$oldPassage);
            else $valNorm=recupValNorm($passage['id_passage'],$norme['id_norme']);
          ?>
            <input <?= $parTime ?> onkeydown="EnterToTab()" type="number" step="0.01" min="0" lang="en" value="<?= $valNorm ?>" id="n<?= $norme['id_norme'] ?>" onchange="saveNorme(<?= $norme['id_norme'] ?>,this.value); valid(this.value,<?= $norme['formuleNorme'] ?>,<?= $norme['formuleNorme'] ?>,'alert_<?= $norme["id_norme"] ?>')" class="inputValue input input-lg form-control ml-2 <?= $parTime ?>">
        
            <div class="input-group-append" id=""> 
                <span class="unit input-group-text" ><?= $norme['uniteMesure'] ?></span>
            </div>
            <br>

            <div class="w-100 text-right">
              <span style="color: green"><?= $norme['formuleNorme'] ?></span>
              <span id="alert_<?= $norme['id_norme'] ?>" class="alert text-danger ml-2" style="display: none;">*<?= $norme['messageErreur'] ?></span>
            </div>
                <script> document.onload=saveNorme(<?= $norme['id_norme'] ?>,'<?= $valNorm ?>');valid('<?= $valNorm ?>',<?= $norme['formuleNorme'] ?>,<?= $norme['formuleNorme'] ?>,'alert_<?= $norme["id_norme"] ?>');</script>
        </div>

    <?php }elseif($norme['typeNorme']=='intervalle'){ ?>
        <div id="champProduit" class="input-group form-group mx-left mb-1 w-100" > 
            <label for="n<?= $norme['id_norme'] ?>" class="label justify-content-start text-left my-auto ml-2 mb-2" >
              <?= $norme['nomNorme'] ?>
              <?= lienDocument($norme['lienNorme'],'Norme',$norme['id_norme']) ?>    
            </label>

          <?php
            if($norme['isReset']==0) $valNorm=recupValNorm($passage['id_passage'],$norme['id_norme'],$oldPassage);
            else $valNorm=recupValNorm($passage['id_passage'],$norme['id_norme']);
          ?>
            <input <?= $parTime ?> onkeydown="EnterToTab()" type="number" step="0.01" min="0" lang="en" value="<?= $valNorm ?>" id="n<?= $norme['id_norme'] ?>" onchange="saveNorme(<?= $norme['id_norme'] ?>,this.value); valid(this.value,<?= explode('-',$norme['formuleNorme'])[0] ?>,<?= explode('-',$norme['formuleNorme'])[1] ?>,'alert_<?= $norme["id_norme"] ?>')" class="inputValue input input-lg form-control ml-2 <?= $parTime ?>">
        
            <div class="input-group-append" id=""> 
                <span class="unit input-group-text" ><?= $norme['uniteMesure'] ?></span>
            </div>
            <br>
                       
                <div class="w-100 text-right">
                    <span style="color: green"><?= $norme['formuleNorme'] ?></span>

                    <span id="alert_<?= $norme['id_norme'] ?>" class="alert text-danger ml-2" style="display: none;">*<?= $norme['messageErreur'] ?> </span>
                </div>
              
                <script id='erreur'>document.onload=saveNorme(<?= $norme['id_norme'] ?>,'<?= $valNorm ?>');valid('<?= $valNorm ?>',<?= explode('-',$norme['formuleNorme'])[0] ?>,<?= explode('-',$norme['formuleNorme'])[1] ?>,'alert_<?= $norme["id_norme"] ?>');</script>
        </div>

    <?php }elseif ($norme['typeNorme']=='formule') { ?>
      <?php
        $formul= explode("#=#", $norme['formuleNorme']);
        $norme['formuleNorme']= $formul[0];
        $minMax= $formul[1];
      ?>
        <div id="fonction" class="input-group form-group mx-left mb-1 w-100" > 
            <label class="nomNorme mr-2 label justify-content-start text-left my-auto mb-2 ml-2">
                <?= $norme['nomNorme'] ?>
                <?= lienDocument($norme['lienNorme'],'Norme',$norme['id_norme']) ?>:
            </label>
            <input type='number' id="n<?= $norme['id_norme'] ?>" onchange="valid(this.value,<?= explode('-', $minMax)[0] ?>,<?= explode('-', $minMax)[1] ?>,'alert_<?= $norme["id_norme"] ?>')" class="inputValue input input-lg form-control " disabled >
            <div class="input-group-append">
                <span class="unit input-group-text" ><?= $norme['uniteMesure'] ?></span>
            </div>
            <br>
                       
                <div class="w-100 text-right">
                    <span style="color: green"><?= $minMax ?></span>

                    <span id="alert_<?= $norme['id_norme'] ?>" class="alert text-danger ml-2" style="display: none;">*<?= $norme['messageErreur'] ?> </span>
                </div>
        </div>

      <?php $script .= "calcul(`".$norme['id_norme']."`,`".$norme['formuleNorme']." `);"; ?>
      <?php $script .= inserScriptChange($norme['id_norme'],$norme['formuleNorme']); ?>
   <?php } ?> 
  <?php } ?>
<?php } ?>