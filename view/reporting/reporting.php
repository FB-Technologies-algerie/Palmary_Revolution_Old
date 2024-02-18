<?php $title="Reporting des passages" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<?php require('view/navbar.php') ?>
<?php $date = (new DateTime())->format('Y-m-d'); ?>
  
  <?php if(!isset($_POST['valider'])){ ?>
    <div class="card">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle"> RAPPORT </span></div>
        <div class="card-body">
            <form method="post" action="">
                            <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2">Unité de production</label>
                            <select  name="unite" id="uniteSelect" onchange="uniteSelected(this)" class="hirarchieUser custom-select custom-select-lg "> 
                                  <option selected value="">toutes les unités de production</option>
                                <?php while ($unite= $listUnite->fetch()) { ?>
                                    <option value="<?= $unite['id_unite'] ?>" ><?= $unite['nomUnite'] ?></option>
                                <?php } ?>
                            </select>
                    </div>
             
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2">Ligne de production</label>
                            <select  name="ligne" id="ligneSelect" onchange="ligneSelected(this.value)" class="hirarchieUser custom-select custom-select-lg "> 
                                  <option selected value="">toutes les lignes de production</option>
                             
                            </select>
                    </div>
                     <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2">Produit</label>
                            <select name="prod" id="prodSelect"  onchange="produitSelected(this.value)"   class="hirarchieUser custom-select custom-select-lg ">
                                  <option selected value="">Sélectionner un produit</option>  
                                  <?php while ($Prod= $listProds->fetch()) { ?>
                                    <option value="<?= $Prod['id_prod'] ?>" ><?= $Prod['nomProd'] ?></option>
                                <?php } ?>
                            </select>
                    </div>


                     <hr style="border: 1px solid ;">

                       <div class="row">
                         <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100 col-12">
                            <label for="groupProduitSelect" class="ldpLabel justify-content-middle text-left display-inline mr-2">Norme 1</label>
                            <select required name="GroupeNorme1" id="groupProduitSelect" onchange="groupProduitSelected(this.value)" class="hirarchieUser custom-select custom-select-lg " >
                                  <option value="">Selectionner un groupe</option>
                               
                            </select>
                            <select required name="Norme1" id="Norme1"  class="hirarchieUser custom-select custom-select-lg " >
                                  <option   value="">Selectionner une norme</option>
                               
                            </select>
                          </div>
                      </div>
                      <div class="row">
                         <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100 col-12">
                            <label for="groupProduitSelect" class="ldpLabel justify-content-middle text-left display-inline mr-2">Norme 2</label>
                            <select required name="GroupeNorme2" id="groupProduitSelectComp" onchange="groupProduitSelectedComp(this.value)" class="hirarchieUser custom-select custom-select-lg " >
                                  <option   value="">Selectionner un groupe</option>
                               
                            </select>
                            <select required name="Norme2" id="Norme2"  class="hirarchieUser custom-select custom-select-lg" >
                                  <option value="">Selectionner une norme</option>
                               
                            </select>
                      </div>
                      </div>

                     <hr style="border: 1px solid ;">
                    
                     <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                            <label for="groupSelect" class="ldpLabel justify-content-middle text-left display-inline mr-2">Rapport</label>
                            <select name="typeRecherche" value="" id="typeRecherche" class="hirarchieUser custom-select custom-select-lg" >
                                  <option <?= (isset($_POST['typeRecherche']) && $_POST['typeRecherche']=='passage')? 'selected': ''; ?>  value="passage">Rapport par passage</option>
                                  <option <?= (isset($_POST['typeRecherche']) && $_POST['typeRecherche']=='groupe')? 'selected': ''; ?> value="groupe">Rapport par groupe</option>
                                  <option <?= (isset($_POST['typeRecherche']) && $_POST['typeRecherche']=='jour')? 'selected': ''; ?> value="jour">Rapport par jour</option>
                            </select>
                    </div>
                    <div class="input-group input-group-lg mb-3">
                    <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2" >Date</label>
                    <div class="row" style="width: calc(100% - 250px)">
                      <div class="col">
                        <div class="input-group input-group-lg mb-3">

                              <input type="date" id="dateD" name="dateD" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="debut">
                    <div class="input-group-append">
                      <span class="input-group-text" id="debut">Début</span>
                    </div>
                  </div>
                      </div>
                       <div class="col">
                         <div class="input-group input-group-lg mb-3">
                              <input type="date" id="dateF" name="dateF" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="fin">
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
   <?php }else{ ?>  
      <br>
    <div class="text-center">
        <a class="btn btn-secondary mx-auto" href="" >Annuler</a>
        <button type="button" class="btn btn-primary mx-auto" name="imprimer"  onclick="printDivTest('printableArea','printableArea2')" >IMPRIMER</button>
    </div>             
   <div >
      <div class="card"  style="height: 650px" id="printableArea">
        <div class="card-body" id="chartbody" style=" width:100%;">
            <div id="chartdiv" style=" height: 500px;"> 
           </div>
        </div>
     </div>   


    <div class="card" id="printableArea2">

        <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">

           <span class="cardTitle" >RAPPORT DE <strong><?= $nomNorme1 ?></strong> et <strong><?= $nomNorme2 ?></strong> PAR <strong> <?= ($_POST['typeRecherche']) ?></strong></span>            

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                    <thead class="w-100 text-center">
                        <tr>
                        <?php if($_POST['typeRecherche']=='passage') { ?>
                          <th style="width:10%;">N° PASSAGE</th>
                        <?php } ?>
                          <th style="width:10%;">DATE</th>
                        <?php if($_POST['typeRecherche']=='groupe') { ?>
                          <th style="width:10%;">N° GROUPE</th>
                        <?php } ?>
                        <?php if($_POST['typeRecherche']=='passage') { ?>
                          <th style="width:40%;">PRODUIT</th>
                          <th style="width:15%;">VALEUR<br>[<?= $nomNorme1 ?>]</th>
                          <th style="width:15%;">VALEUR<br>[<?= $nomNorme2 ?>]</th>
                        <?php } ?>
                        <?php if($_POST['typeRecherche']!='passage') { ?>
                          <th style="width:20%;">MOYENNE<br>[<?= $nomNorme1 ?>]</th>
                          <th style="width:20%;">MOYENNE<br>[<?= $nomNorme2 ?>]</th>
                        <?php } ?>

                          

                        </tr>

                    </thead>

                    <tbody>

                      <?php while ($normeResult = $ValeurSaisie->fetch()) { ?>
                        <tr>
                          <?php if($_POST['typeRecherche']=='passage') { ?>
                         <td><?= $normeResult['id_passage'] ?></td>
                           <?php } ?>
                            <td><?= $normeResult['jour'] ?></td> 
                           <?php if($_POST['typeRecherche']=='groupe') { ?>
                           <td><?= $normeResult['groupeUser'] ?></td>
                           <?php } ?>

                            <?php if($_POST['typeRecherche']=='passage') { ?>
                               <td><?= $normeResult['nomProd'] ?></td>
                              <td><?= $normeResult['val1'] ?></td>
                              <td><?= $normeResult['val2'] ?></td>
                           <?php } ?>
                           <?php if($_POST['typeRecherche']!='passage') { ?>
                              <td><?= $normeResult['val1'] ?></td>
                              <td><?= $normeResult['val2'] ?></td>
                           <?php } ?>
                        </tr>

                      <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>
   </div>
  
  <?php } ?>

  <iframe id="csvPassage" src="" class="d-none" frameBorder="0"></iframe>
</div>


<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/material.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>


<script> 

am4core.ready(function() {
am4core.useTheme(am4themes_material);
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.paddingRight = 20;
var dataGraphe = <?= $ValeurSaisieGraphe ?>;
chart.data = dataGraphe;

var caregore = "<?php
if($_POST['typeRecherche']=='passage' ) echo "id_passage"; elseif($_POST['typeRecherche']=='groupe' ) echo 'groupe'; else echo "jour";

?>";
var valueGraphe = "<?= ($_POST['typeRecherche']=='passage' )? "val1" : 'val1'; ?>";
var valueGraphe2 = "<?= ($_POST['typeRecherche']=='passage' )? "val2" : 'val2'; ?>";
var textProduit = "<?php if($_POST['typeRecherche']=='passage' ) echo"Produit: {nomProd} ,"; 
                          elseif($_POST['typeRecherche']=='groupe' ) echo"Groupe: {groupeUser} ,"; 
                          else echo ''; ?>";
var textProduit2 = "<?php if($_POST['typeRecherche']=='passage' ) echo"Produit: {nomProd} ," ;
                          elseif($_POST['typeRecherche']=='groupe' ) echo"Groupe: {groupeUser} ," ;
                          else echo ''; ?>";
var textValue= "<?= ($_POST['typeRecherche']=='passage' )? "Valeur" : 'Moyenne'; ?>";
var textValue2= "<?= ($_POST['typeRecherche']=='passage' )? "Valeur" : 'Moyenne'; ?>";

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = caregore;
categoryAxis.renderer.minGridDistance = 100;
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.categoryX = caregore;
series.dataFields.valueY = valueGraphe;
series.tooltipText = "<?= $nomNorme1 ?> | Date: {jour}, "+textProduit+" "+textValue+": {valueY}  ";
series.propertyFields.stroke = "color";


var series2 = chart.series.push(new am4charts.LineSeries());
series2.dataFields.categoryX = caregore;
series2.dataFields.valueY = valueGraphe2;
series2.tooltipText = "<?= $nomNorme2 ?> | Date: {jour}, "+textProduit2+" "+textValue2+": {valueY}  ";
series2.propertyFields.stroke = "color";




chart.cursor = new am4charts.XYCursor();
var scrollbarX = new am4core.Scrollbar();
chart.scrollbarX = scrollbarX;
var scrollbarY = new am4core.Scrollbar();
chart.scrollbarY = scrollbarY;
});

</script>


<script type="text/javascript">
  document.getElementById('dateD').valueAsDate = new Date();
  document.getElementById('dateF').valueAsDate = new Date();
</script>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php'); ?>

<script> 

function printDiv(divName,divName2) { 
    var printContents = document.getElementById(divName).innerHTML;
    var printContents2 = document.getElementById(divName2).innerHTML;
     document.body.innerHTML = printContents+""+printContents2;
      window.print();


}
function printDivTest(divName,divName2) {
  var printContents = document.getElementById(divName).innerHTML;
  var printContents2 = document.getElementById(divName2).innerHTML;
  var head = document.getElementsByTagName('head')[0].innerHTML;
    
    var mywindow = window.open('', 'new div divPrint', 'height=1000,width=2500');
       mywindow.document.write(head);
       mywindow.document.write(printContents);
       mywindow.document.write(printContents2);
       mywindow.document.write('<style> #chartdiv{ width: 1147px;!important;} </style>');
       mywindow.document.close();
       mywindow.addEventListener('load',mywindow.print(),true);
       mywindow.addEventListener('load',setTimeout(function(){mywindow.close();},1000),true);
      
}

function uniteSelected(val){
    document.getElementById('ligneSelect').innerHTML ="<option selected value>toutes les lignes de production</option>";
      initialListeNorme();

     if(val.options[val.selectedIndex].value !=""){ 
      listeProdUnite(val.options[val.selectedIndex].value); 
      listeLigne(val.options[val.selectedIndex].value);
     }else{ 
       $("#ligneSelect option[value!='']").remove();
       $("#prodSelect option[value!='']").remove();
      listeProduitComplet();
     }
 
  }

function getData(target,id=null){

  return new Promise((resolve, reject)=> {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.open("GET", "<?= $_SESSION['url'] ?>reporting/"+target+"/"+id, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
    xhttp.onload = () => resolve(xhttp.responseText);
  });
}



function listeLigne(id_unit) {

    var x = document.getElementById("ligneSelect");
  getData("listLignes",id_unit).then((data)=> {
    var response =(JSON.parse(data)); 

    for (var i = 0; i < response.length; i++) {
     var option = document.createElement("option");
     option.text = response[i]['nomLigneP'];
     option.setAttribute("value", response[i]['id_ligneP']);
     x.add(option);
    }
  });
}

  function listeProduitComplet(){
    $("#prodSelect option[value!='']").remove();
    var x = document.getElementById("prodSelect");

   getData("listeProduitComplet").then((data)=> {
console.log(x);
    var response =(JSON.parse(data));
    
    for (var i = 0; i < response.length; i++) {
     var option = document.createElement("option");
     option.text = response[i]['nomProd'];
     option.setAttribute("value", response[i]['nomProd']);
     x.add(option);
    }
    
  });
  }


 function ligneSelected(val){
   document.getElementById('prodSelect').innerHTML ="<option selected value>Sélectionner un produit</option>";
   initialListeNorme();
       
   if(val!=''){
        listeProdLigne(val);
     }else{ 

        $("#prodSelect option[value!='']").remove();
        
        listeProdUnite($("#uniteSelect").val());
     }
  
} 

function produitSelected(val){
  initialListeNorme();
  if(val !='') listeGroupeNorme(val);
  else {
    $("#groupProduitSelect option[value!='']").remove();
    $("#groupProduitSelectComp option[value!='']").remove();
  } 
}

function groupProduitSelected(val){
  if(val !='') listeNormeGroupeProduit(val);
  else initialListeNorme("1");  
}

function groupProduitSelectedComp(val){
  if(val !='') listeNormeGroupeProduitComp(val);
  else initialListeNorme("2"); 
}

function initialListeNorme(num=''){
    if(num!='') $("#Norme"+num+" option[value!='']").remove();
    else{
      $("#Norme1 option[value!='']").remove();
      $("#Norme2 option[value!='']").remove();
    }
}


function listeGroupeNorme(id_prod) {
   $("#groupProduitSelect option[value!='']").remove();
    var x = document.getElementById("groupProduitSelect");
     $("#groupProduitSelectComp option[value!='']").remove();
    var y = document.getElementById("groupProduitSelectComp");
    
   getData("listeGroupeNorme",id_prod).then((data)=> {
     console.log(data);

    var response =(JSON.parse(data));
    console.log(data);
    for (var i = 0; i < response.length; i++) {
     var option = document.createElement("option");
     option.text = response[i]['nomNorme'];
     option.setAttribute("value", response[i]['id_norme']);
     x.add(option);
     var option1 = document.createElement("option");
     option1.text = response[i]['nomNorme'];
     option1.setAttribute("value", response[i]['id_norme']);
     y.add(option1);
    }

     
  });
}



function listeProdLigne(id_ligne){
  
  $("#prodSelect option[value!='']").remove();
  getData("listProduitsLigne",id_ligne).then((dataRep)=> {
    var response =JSON.parse(dataRep);
    var x = document.getElementById("prodSelect");
    // console.log(dataRep);
    for (var i = 0; i < response.length; i++) {
     var option = document.createElement("option");
     option.text = response[i]['nomProd'];
     option.setAttribute("value", response[i]['id_prod']);
     x.add(option);
   }

});
}
function listeProdUnite(id_unite){
  $("#prodSelect option[value!='']").remove();
  getData("listeProdUnite",id_unite).then((dataRep)=> {
    var response =JSON.parse(dataRep);
    var x = document.getElementById("prodSelect");
   
    for (var i = 0; i < response.length; i++) {
     var option = document.createElement("option");
     option.text = response[i]['nomProd'];
     option.setAttribute("value", response[i]['id_prod']);
     x.add(option);
   }

});
}


function listeNormeGroupeProduit(id) {
   $("#Norme1 option[value!='']").remove();
    var x = document.getElementById("Norme1");
    
   getData("listeNormeGroupeProduit",id).then((data)=> {

    var response =(JSON.parse(data));
  
    for (var i = 0; i < response.length; i++) {
     var option = document.createElement("option");
     option.text = response[i]['nomNorme'];
     option.setAttribute("value", response[i]['id_norme']);
     x.add(option);
   
    }
    
  });
}
function listeNormeGroupeProduitComp(id) {
   $("#Norme2 option[value!='']").remove();
    var x = document.getElementById("Norme2");
    
   getData("listeNormeGroupeProduit",id).then((data)=> {

    var response =(JSON.parse(data));
  
    for (var i = 0; i < response.length; i++) {
     var option = document.createElement("option");
     option.text = response[i]['nomNorme'];
     option.setAttribute("value", response[i]['id_norme']);
     x.add(option);
   
    }
    
  });
}

</script>


