<?php $title='historique' ?>

<?php ob_start(); ?>
  
  <form id="detailVersion" method="post" action="">


<div id="accordion">

  <div class="card m-0">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
        <h5>
          <div style="font-weight: bold;cursor: pointer;" aria-expanded="true"  onclick="toggleTrad()">
            nitrution
          </div>
        </h5>
         
           
      </div>
        <div id="collapseTrad" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
   

    <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                    <thead class="w-100">
                        <tr>


                          <th style="width:10%;">Français</th>
                          <th style="width:20%;">Arabe</th>
                          <th style="width:10%;">Anglais</th>
                          <th style="width:20%;">Portugais</th>
                          <th style="width:20%;">Espagnol</th>
                          <th style="width:30%;">Valeur</th>
                          <th style="width:30%;">unité</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                      <?php while ($nitrution = $listnitrution->fetch()){ ?>
                        <tr>
                      
                        <td><a href="#" data-toggle="modal" data-target="#ajout" class="textTab" ><i class="fas fa-user-alt fa-2x mr-3"></i><?=$nitrution['nutritionFR']?></a></td>

                         
                          <td><?= $nitrution['nutritionAR'] ?></td>  
                          <td><?= $nitrution['nutritionEN'] ?></td>
                          <td><?= $nitrution['nutritionPT'] ?></td>
                          <td><?= $nitrution['nutritionES'] ?></td>
                          <td><?= $nitrution['valeurNutrition'] ?></td>
                          <td><?= $nitrution['uniteNutrition'] ?></td>
                      
                          <td style=" text-align: center;">

                          
                        
                        
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
            var xhttp;
            xhttp = new XMLHttpRequest();
            
            xhttp.open("POST", "<?= $_SESSION['url'] ?>detailVersion/traduire", false);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('listeIngrediantFR='+listeIngrediantFR+'&id_version=<?= $version['id_version'] ?>');

            var reponse= JSON.parse(xhttp.response);

            $('#anglais').html(reponse['EN']);
            $('#arabe').html(reponse['AR']);
            $('#portugais').html(reponse['PT']);
            $('#espagnol').html(reponse['ES']);
  }
  var test;
  function detailMaquette(val,id_maquette) {
    test = val;
    if(id_maquette !=-1){
          window.parent.document.getElementById('titreR').textContent = val.getElementsByClassName('bottomMaquette')[0].textContent
    }
    else{
      window.parent.document.getElementById('titreR').textContent = "Nouvelle Maquette"
    }

    //
    window.parent.$('#maquetteModal').modal('toggle')
    window.parent.$('#maquetteModal iframe').attr('src','<?= $_SESSION['url'].'nutrition/'.$nitrution['nutritionFR'] ?>/'+id_maquette);

  }
</script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>
