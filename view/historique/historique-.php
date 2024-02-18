<?php $title="Historique des passages" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<?php require('view/navbar.php') ?>
<?php $date = (new DateTime())->format('Y-m-d'); ?>
  
  <script type="text/javascript">
    var data= <?= (isset($_POST['valider']))? json_encode($_POST)
              : "{'unite':'','ligne':'','prod':'','dateD':'".$date."','dateF':'".$date."','groupe':'','control':''}" ?>;
  </script>
    <div class="card">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">RECHERCHE</span></div>
        <div class="card-body">
            <form method="post" action="">
                  <?php if($typeUser=='admin') { ?>
                     <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2">Unité de production</label>
                            <select  name="unite" id="uniteSelect" onchange="uniteSelected(this)" class="hirarchieUser custom-select custom-select-lg "> 
                                  <option selected value="">Chercher par unité de production</option>
                                <?php while ($unite= $listUnite->fetch()) { ?>
                                    <option value="<?= $unite['id_unite'] ?>" ><?= $unite['nomUnite'] ?></option>
                                <?php } ?>
                            </select>
                    </div>
                  <?php } ?>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2">Ligne de production</label>
                            <select  name="ligne" id="ligneSelect" onchange="ligneSelected(this.value)" class="hirarchieUser custom-select custom-select-lg "> 
                                  <option selected value="">Chercher par ligne de production</option>
                              <?php if($typeUser=='control') { ?>
                                <?php while ($ligne= $listLigne->fetch()) { ?>
                                    <option value="<?= $ligne['id_ligneP'] ?>" ><?= $ligne['nomLigneP'] ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                    </div>
                     <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2">Produit</label>
                            <select name="prod" id="prodSelect" class="hirarchieUser custom-select custom-select-lg ">
                                  <option selected value="">Chercher par produit</option>
                            </select>
                    </div>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="groupSelect" class="ldpLabel justify-content-middle text-left display-inline mr-2">Groupe</label>
                            <select name="groupe" id="groupeSelect" class="hirarchieUser custom-select custom-select-lg ">
                                  <option selected value="">Chercher par groupe</option>
                                <?php while ($groupe= $listGroupe->fetch()) { ?>
                                    <option value="<?= $groupe['groupeUser'] ?>" ><?= $groupe['groupeUser'] ?></option>
                                <?php } ?>
                            </select>
                    </div>
                  <?php if($typeUser=='admin'){ ?>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="controlSelect" class="ldpLabel justify-content-middle text-left display-inline mr-2">Controleur</label>
                            <select name="control" id="controlSelect" class="hirarchieUser custom-select custom-select-lg ">
                                  <option selected value="">Chercher par controleur</option>
                                <?php while ($control= $listControl->fetch()) { ?>
                                    <option value="<?= $control['id_user'] ?>" ><?= $control['nomComplet'] ?></option>
                                <?php } ?>
                            </select>
                    </div>
                  <?php } ?>

                    <div class="input-group input-group-lg mb-3">
                    <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2" >Date</label>
                    <div class="row" style="width: calc(100% - 250px)">
                      <div class="col">
                        <div class="input-group input-group-lg mb-3">

                              <input type="date" id="datePicker1" name="dateD" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="debut">
                    <div class="input-group-append">
                      <span class="input-group-text" id="debut">Début</span>
                    </div>
                  </div>
                      </div>
                       <div class="col">
                         <div class="input-group input-group-lg mb-3">
                              <input type="date" id="datePicker2" name="dateF" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="fin">
                    <div class="input-group-append">
                      <span class="input-group-text" id="debut">Fin</span>
                    </div>
                  </div>
                      </div>
                    </div>
              
                  </div>

                  
                    <div class="text-center">
                       <input type="submit" class="btn btn-primary mx-auto" name="valider" style="" value="RECHERCHER">
                   
                    </div>
                   
            </form>
               
        </div>
    </div>
    
  <?php if(isset($_POST['valider'])){ ?>
    <div class="card search">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
         <span class="cardTitle" >RESULTAT DE LA RECHERCHE</span> 
         <?php
  $passage= $listePassage->fetch();
  if(!$passage) {echo '<h3 class="text-center w-100 mb-3">votre résultat est vide</h3>'; }
  while ($passage) {
?>
    <h1 class="text-center w-100 mb-3"><?= nomProduit($passage['id_prod']) ?></h1>
    <div class="table-responsive">
    <table id="id_ligne" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%">
      <thead>
       <tr>
        <th class='titleTab' rowspan="2" >Num.</th>
        <th class='titleTab' rowspan="2">Heure</th>
        <th class='titleTab' rowspan="2">Etat</th>
    <?php if($typeUser=='admin') { ?>
        <th class='titleTab' rowspan="2" >Controleur</th>
    <?php } ?>
        <th class='titleTab' rowspan="2">Groupe</th>
  <?php
    //$listN=$tabMoyenne=$minMax='';
    $sortie['listN']=$sortie['tabMoyenne']=$sortie['minMax']='';
    
    $listeNormeP1= recupNormeProduit($passage['id_prod'],null,1);
    $listeNormeP2= recupNormeProduit($passage['id_prod'],null,2);
    $numPassage=1;

    $sortie1= afficheNorme($listeNormeP1,$passage['id_prod'],$sortie);
    $sortie2= afficheNorme($listeNormeP2,$passage['id_prod'],$sortie);
    
    $listN= explode(',', $sortie1['listN'].$sortie2['listN']);
    $tabMoyenne= explode(',', $sortie1['tabMoyenne'].$sortie2['tabMoyenne']);
    $minMax= explode(',', $sortie1['minMax'].$sortie2['minMax']);
    $divMoyenne= array_fill(0, sizeof($listN), 0);

    $prod = $passage['id_prod'];
  ?>      
        <th class="titleTab" rowspan="2">Observation</th>
       </tr>
      </thead>
      <tbody>
  <?php while ($prod == $passage['id_prod']) { ?>
        <tr>
          <th class="border"><?= $numPassage ?></th>
          <th class="border text-center"><?= $passage['dateHeure'] ?></th>
          <th class="border"><?= $passage['etatPassage'] ?></th>
        <?php if($typeUser=='admin') { ?>
          <th class="border"><?= $passage['nomComplet'] ?></th>
        <?php } ?>
          <th class="border"><?= $passage['groupeUser'] ?></th>
    <?php for($i=0;$i<sizeof($listN)-1;$i++){ ?>
      <?php
        $valNorm= recupValNorm($passage['id_passage'],$listN[$i]);
        if($tabMoyenne[$i]!='null' && !is_null($valNorm)){
          $tabMoyenne[$i]+= $valNorm;
          $divMoyenne[$i]++;
        }
        if(strlen($valNorm)>10){
      ?>
          <td class="border" style="<?= verifValNorme($valNorm,$minMax[$i]) ?>" data-toggle="popover" data-trigger="hover" data-content="<?= $valNorm ?>" ><?= substr($valNorm,0,10) ?>...</td>
      <?php }else{ ?>
          <td class="border" style="<?= verifValNorme($valNorm,$minMax[$i]) ?>" ><?= $valNorm ?></td>
      <?php } ?>
    <?php } ?>
      <?php if(strlen ($passage['observation'])>15){ ?> 
          <th class="border" href="#" data-toggle="popover" data-trigger="hover" data-content="<?= $passage['observation'] ?>"><?= substr($passage['observation'],0,15); ?>...</th>
      <?php }else{ ?>
          <th class="border"><?= $passage['observation'] ?></th>
      <?php } ?>
        </tr>
      <?php 
          $passage= $listePassage->fetch();
          $numPassage++;
        } 
      ?>
        <tr>
          <th colspan="<?= ($typeUser=='admin')? '5' : '4' ?>" class="groupeN text-center" style="background-color:#7b7a7a" >Moyenne</th>
         <?php for($i=0;$i<sizeof($tabMoyenne)-1;$i++){ ?>
          <?php if($tabMoyenne[$i]!='null' && $divMoyenne[$i]>0) $myn= number_format($tabMoyenne[$i]/($divMoyenne[$i]), 2, ',', ''); else $myn= '-'; ?>
          <th class="groupeN text-center" style="background-color:#7b7a7a; <?= verifValNorme($myn,$minMax[$i]) ?>" ><?= $myn ?></th>
         <?php } ?>
        </tr>
      </tbody>
    </table>
    </div>

<?php } ?>
</div>
      </div>
    </div>
  <?php } ?>
        </div>
        </div>
    </div>
<script type="text/javascript">
  document.getElementById('datePicker1').valueAsDate = new Date();
  document.getElementById('datePicker2').valueAsDate = new Date();
</script>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php'); ?>

<script>
  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
  });

  function uniteSelected(val,data){
    document.getElementById('ligneSelect').innerHTML ="<option selected value>Chercher par ligne de production</option>"
    listeLigne(val.options[val.selectedIndex].value,data);
  }

  function ligneSelected(val){
   document.getElementById('prodSelect').innerHTML ="<option selected value>Chercher par produit</option>"
   listeProd(val);
}

function getData(target,id_unit){
  return new Promise((resolve, reject)=> {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.open("GET", "<?= $_SESSION['url'] ?>historique/"+target+"/"+id_unit, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
    xhttp.onload = () => resolve(xhttp.responseText);
  });
}


function listeLigne(id_unit,dataRestore) {

    var x = document.getElementById("ligneSelect");
  getData("listLignes",id_unit).then((data)=> {
    var response =(JSON.parse(data));
    for (var i = 0; i < response.length; i++) {
     var option = document.createElement("option");
     option.text = response[i]['nomLigneP'];
     option.setAttribute("value", response[i]['id_ligneP'])
     x.add(option);
    }
    if(data['ligne']) restoreLigne();
  });
}


function restoreLigne(){
  document.getElementById('ligneSelect').value = data['ligne'];
  ligneSelected(data['ligne']);
}


function restoreProd(){
  document.getElementById('prodSelect').value = data['prod'];
}



function restoreUnite(){
  var UniteSelect = document.getElementById('uniteSelect');
  UniteSelect.value = data['unite'];
  uniteSelected(UniteSelect);
}

function restore(){
  if(data['unite']) restoreUnite();
   else restoreLigne();

  restoreDate();
  restoreGroupeControl();
}

restore();

function restoreDate(){
    document.getElementById('datePicker1').value= data['dateD'];
    document.getElementById('datePicker2').value= data['dateF'];;
}

function restoreGroupeControl(){
    document.getElementById('groupeSelect').value= data['groupe'];
    document.getElementById('controlSelect').value= data['control'];;
}

function listeProd(id_ligne){
  getData("listProduits",id_ligne).then((dataRep)=> {
    var response =JSON.parse(dataRep);
    var x = document.getElementById("prodSelect");

    for (var i = 0; i < response.length; i++) {
     var option = document.createElement("option");
     option.text = response[i]['nomProd'];
     option.setAttribute("value", response[i]['id_prod'])
     x.add(option);
   }
   if(data['prod']) restoreProd();

});
}

/**********/
</script>

<?php
  function afficheNorme($listeNormeP,$id_prod,$sortie,$source=''){

    while ($norme = $listeNormeP->fetch()) { 
      if($norme['typeNorme']!='groupe'){
        $sortie['listN'] .= $norme['id_norme'].",";
        $sortie['minMax'] .= verifNorme($norme).",";
        if($norme['typeNorme']!='booleen' && $norme['typeNorme']!='texte')$sortie['tabMoyenne'].='0,';
         else $sortie['tabMoyenne'].='null,';
    ?>
        <th class='titleTab' rowspan="2" data-toggle="popover" data-trigger="hover" data-content="<?= $source.' >'.$norme['nomNorme'] ?>" ><?= $norme['nomNorme'] ?></th>
    <?php
      }else{
    ?>
    <?php
        $listeNormeG= recupNormeProduit($id_prod,$norme['id_norme']);
        
        $sortie= afficheNorme($listeNormeG,$id_prod,$sortie,$source.' >'.$norme['nomNorme']);
      }
   }

   return $sortie;
  }
