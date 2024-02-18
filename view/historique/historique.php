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
                      <span class="input-group-text" id="fin">Fin</span>
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
    <div class="card">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
                 <span class="cardTitle" >RESULTAT DE LA RECHERCHE</span>
                 <!--<button class="btn btn-warning float-right" onclick="exportAll()">Exporter en csv</button>-->
               </div>
               <div class="body">
      <?php 
        $prod=$produit= $listeProd->fetch();
        if(!$produit) {echo '<h3 class="text-center w-100 mb-3">votre résultat est vide</h3>'; }
        else { ?>
                  <div class="text-center m-3">
        <?php while ($produit) { ?>
                    <button id="<?= $produit['id_prod'] ?>" onclick="afficheProd(<?= $produit['id_prod'] ?>,'<?= $produit['nomProd'] ?>')" class="btn btn-primary m-1 btnProd">
                      <?= $produit['nomProd'] ?>
                    </button>
            <?php $produit= $listeProd->fetch(); ?>
          <?php } ?>
                 </div>
                   
                 <div class="card m-1">
                   <div class="card-header" >
                    <h1 id="titreProd" class="text-center w-100 mb-3"><?= $prod['nomProd'] ?></h1>
                   </div>
                   <div class="card-body">
                 <iframe id="tablePassage" src="<?= $_SESSION['url'] ?>historique/tablePassage/<?= $prod['id_prod'] ?>"  width="100%" height="750px" frameBorder="0"></iframe>
               
                   </div>
                 </div>
               </div>
        <?php } ?>
    </div>
  <?php } ?>
  <iframe id="csvPassage" src="" class="d-none" frameBorder="0"></iframe>
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






//trigger AJAX load on "Load Data via AJAX" button click
$("#ajax-trigger").click(function(){
    table.setData("/exampledata/ajax");
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

function afficheProd(idProd,nomProd){
  $('#titreProd').html(nomProd);
  $('#tablePassage').attr('src','<?= $_SESSION['url'] ?>historique/tablePassage/'+idProd);
}

function exportAll(){
  var t=0;
  var myVar= setInterval(function(){ 

    $('#csvPassage').attr('src','<?= $_SESSION['url'] ?>historique/csvPassage/'+$('.btnProd:eq('+t+')').attr('id'));

    t++;
    if(t>$('.btnProd').length) clearInterval(myVar);
  }, 500);
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
