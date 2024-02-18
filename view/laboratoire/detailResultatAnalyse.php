     <?php ob_start(); ?> 
      <div >

                   <form method="post" id="formAnalayse" action="" style="clear: both;">
                      
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Date d'analyse</div>
                            <div  class="col-7 detail"> <strong id="datePickerAna"><?= $detailAnalyse['dateAnal'] ?></strong></div>
                            <div class="col-7">
                              <input type="date" id="dateAnal" name="dateAnal" class="form-control modif d-none" placeholder="" value="<?= $detailAnalyse['dateAnal'] ?>">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Résultat d'analyse</div>
                            
                            <div  class="col-7 detail">   <strong id="resultParamdAna"><?= $detailAnalyse['resultParam'] ?>   <?=$detailAnalyse['uniteParam'] ?></strong>
                              
                            </div>
                            <div class="col-7">
                              <div class="input-group mb-3 modif d-none">
                                <input type="text" name = "resultParam" class="form-control "aria-describedby="basic-addon2" id="resultParam" value="<?=$detailAnalyse['resultParam'] ?>">
                                <div class="input-group-append">
                                  <span class="input-group-text" id="unité"><?=$detailAnalyse['uniteParam'] ?></span>
                                </div>
                              </div>
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Description d'analyse</div>
                            
                            <div  class="col-7 detail">   <strong id="descriptionAnalAna"><?=$detailAnalyse['descriptionAnal'] ?></strong></div>
                            <div class="col-7">
                                      <textarea type="text" id="descriptionAnal" name="descriptionAnal" class="form-control modif d-none" placeholder="" ><?=$detailAnalyse['descriptionAnal'] ?></textarea> 
                            </div>
                    </div>
                    <br>
                    <div class="modal-footer d-block text-center">       
                     <input id="submitBtn" type="button" onclick="modifAnalyse(<?=$detailAnalyse['id_analyseMat'] ?>,<?=$detailAnalyse['id_paramMat'] ?>)" class="btn btn-primary"  style="width:auto !important;margin-left: auto;" value="MODIFIER">
                    </div>
                  </form>

                <div id="accordion">
                <div class="card m-0 p-0">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none;color: black;font-weight: bold">
                        Detail paramètres
                      </button>
                    </h5>
                  </div>

                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                      <div class="row ml-2 mr-2 mt-4 mb-4">
                        <div class="col-4">
                          Version 
                        </div>
                        <div class="col-4 text-center">
                           <?= $detailAnalyse['nomVersion'] ?>
                        </div>
                        <div class="col-4 text-center">
                           <?= $detailAnalyse['dateVersion'] ?>
                        </div>
                      </div>
                      <div class="row ml-2 mr-2 mt-4 mb-4">
                        <div class="col-4">
                          Norme 
                        </div>
                        <div class="col-8">
                            <?= $detailAnalyse['normeParam'] ?>
                        </div>
                      </div>
                      <div class="row ml-2 mr-2 mt-4 mb-4">
                        <div class="col-4">
                          Nom 
                        </div>
                        <div class="col-8">
                             <?= $detailAnalyse['nomParamAnal'] ?>
                        </div>
                      </div>
                      <div class="row ml-2 mr-2 mt-4 mb-4">
                        <div class="col-4">
                          Utilisation
                        </div>
                        <div class="col-8">
                         <?= $formuleTest ?>
                        </div>
                      </div>
                      <div class="row ml-2 mr-2 mt-4 mb-4">
                        <div class="col-4">
                          Description 
                        </div>
                        <div class="col-8">
                           <?= $detailAnalyse['descriptionParamMat'] ?>
                        </div>
                      </div>
                      <div class="row ml-2 mr-2 mt-4 mb-4">
                        <div class="col-4">
                          
                        </div>
                        <div class="col-8">
                            <?= $detailAnalyse['descriptionParamAnal'] ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card m-0 p-0">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none;color: black;font-weight: bold">
                        document des paramètres
                      </button>
                    </h5>
                  </div>

                  <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                      <div class="d-flex flex-wrap">
           <!-- <button class="m-2 btnAdd" onclick="detailDocument(-1,'Nouveau document')">
              <i class="fas fa-plus iconAdd" style="line-height: 150px;"></i>
            </button>  onclick="detailDocument(<?= $document['id_docParam'] ?>,'<?= $document['nomDocument'] ?>')"     -->
    <?php while(!is_null($listeDocument) && $document = $listeDocument->fetch()){ ?>
            <div  class="m-2 btnMaquette <?= $document['typeDocument'] ?>" href="#" style="cursor: pointer;position:relative;background: rgb(218,218,218);">
              <div style="height: 80%"></div>
              <div class="text-center bottomMaquette"><?= $document['nomDocument'] ?></div>
                <div class="btn-group float-right dropleft menuDocument">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" target="_blank" href="#">Télécharger</a>
    <a class="dropdown-item" target="_blank" href="#">action1</a>
    <a class="dropdown-item" target="_blank" href="#">action2</a>
  </div>
            </div>
</div>
    <?php } ?>
      </div>
                    </div>
                  </div>
                </div>
              </div>

          </div>
<script>

    document.getElementById('dateAnal').valueAsDate = new Date();

  
  function modifAnalyse(id_analyseMat,id_paramMat){
  if($('#submitBtn').attr('value')=='MODIFIER'){
      $(".detail").addClass("d-none");
      $(".modif").removeClass("d-none");
      $('#submitBtn').attr('value','VALIDER');
      $('#submitBtn').attr('name','modifierAnalyse');
       $('#formAnalayse').attr('action','<?= $_SESSION['url'] ?>modifierResultatAnalyse/'+id_analyseMat+'/'+id_paramMat);
      
    }else{ 
      $('#submitBtn').attr('name','modifierAnalyse');
      $('#submitBtn').attr('type','submit');
        //window.parent.location.href = '<?= $_SESSION['url'] ?>analyseMatiere/'+id_analyseMat;
    }
  }

  function modifierAnalyse(id_analyseMat,id_paramMat){ 
      // $(".modif").addClass("d-none");
     //  $(".detail").removeClass("d-none");
      // $('#submitBtn').attr('type','button');
       $('#exampleModalLabel').text('MODIFIER ANALYSE');
      // $('#frameResultat').attr('src',"<?= $_SESSION['url'] ?>analyseMatiere/"+id_analyseMat+"/"+id_paramMat);
     
      


  /*  $.get("<?= $_SESSION['url'] ?>analyseMatiere/"+id_analyseMat+"/"+id_paramMat, function(data, status){
      var obj =JSON.parse(data);
     console.log(data);
      $('#datePicker3').val(obj.dateAnal); 
      $('#datePickerAna').text(obj.dateAnal); 
      $('#resultParam').val(obj.resultParam);
      $('#resultParamdAna').text(obj.resultParam);
      $('#descriptionAnal').val(obj.descriptionAnal);
      $('#descriptionAnalAna').text(obj.descriptionAnal);
      $('#unité').text(obj.uniteParam);
      
      
    
    });*/
 
  }
 
</script>



 <?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>