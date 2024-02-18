<?php $title="" ?>
 <?php ob_start(); ?> 
                 
                   <form method="post" id="formEquipement" action="" style="clear: both;">
                      <div id="LDP_modif" class="row"> 
                        <div  class="col-4">Paramètre</div>
                        <div  class="col-8">   <strong id="nomEquipement"><?=$ParamMat['nomParamAnal'] ?></strong></div> 
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Nom de version</div>
                            
                            <div  class="col-8 detail">   <strong id="nomVersion"><?=$ParamMat['nomVersion'] ?></strong></div>
                            <div class="col-8">
                                      <input type="text" id="nomVersion" name="nomVersion" class="form-control modif d-none" placeholder="" value="<?=$ParamMat['nomVersion'] ?>">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Date de version</div>
                            
                            <div  class="col-8 detail">   <strong id="dateVersion"><?=$ParamMat['dateVersion'] ?></strong></div>
                            <div class="col-8">
                                      <input type="date" id="datePicker1"" name="dateVersion" class="form-control modif d-none" placeholder="" value="<?=$ParamMat['dateVersion'] ?>">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Norme</div>
                            
                            <div  class="col-8 detail">   <strong id="normeParam"><?=$ParamMat['normeParam'] ?></strong></div>
                            <div class="col-8">
                                      <input type="text" id="normeParam" name="normeParam" class="form-control modif d-none" placeholder="" value="<?=$ParamMat['normeParam'] ?>">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Utilisation</div>
                            <div  class="col-8 detail"><strong id="formuleParam"></strong></div>
                            <div class="col-12 modif d-none" id="formule">
                              
                              <div id="divFormule" style="display: inline;cursor: pointer;color: #007bff;font-size: 30px;"  onclick="addFormule(false,'')">
                                <i class="fas fa-plus-circle"></i>
                              </div> 
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Unité</div>
                            
                            <div  class="col-8 detail">   <strong id="uniteParam"><?=$ParamMat['uniteParam'] ?></strong></div>
                            <div class="col-8">
                                      <input type="text" id="uniteParam" name="uniteParam" class="form-control modif d-none" placeholder="" value="<?=$ParamMat['uniteParam'] ?>">
                            </div>
                    </div>
                    <br>
                   <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Description</div>
                            
                            <div  class="col-8 detail">   <strong id="descriptionParamMat"><?=$ParamMat['descriptionParamMat'] ?></strong></div>
                            <div class="col-8">
                                      <textarea type="text" id="descriptionParamMat" name="descriptionParamMat" class="form-control modif d-none" placeholder="" ><?=$ParamMat['descriptionParamMat'] ?></textarea>
                            </div>
                    </div>
                    <br>
                     
                    <div class="modal-footer d-block text-center">       
                      <input id="submitBtn"  onclick="modifierparam()"  type="button" class="btn btn-primary w-auto" name="modifier"  value="MODIFIER">
                     <input type="button" class="btn btn-secondary" data-dismiss="modal" onclick="annuler()" value="ANNULER">
                    </div>
                  </form>
<?php $content= ob_get_clean(); ?>
<?php ob_start(); ?>           
<script>




function annuler(){

window.parent.$('#modifParametre').modal('hide');
}

 function modifierparam(){
  if($('#submitBtn').attr('value')=='MODIFIER'){
      $(".detail").addClass("d-none");
      $(".modif").removeClass("d-none");
      $('#submitBtn').attr('value','VALIDER');
      $('#submitBtn').attr('name','modifierParameMatiere');

    }else{
      $('#submitBtn').attr('type','submit');
      $(".modif").addClass("d-none");
      $(".detail").removeClass("d-none");
    }
  }


 function removeFormule(val){
    val.parentElement.remove()
  }

    var i= 0;
    var formule='';
  function addFormule(id,value){  
        document.getElementById('divFormule').insertAdjacentHTML('beforebegin', `
           <div class="row" style="padding:15px 0 0 0" >
                                <div class="col-7" style="padding-right: 0">
                                   <select onchange="changeUnite(`+i+`)" id="selectFormule`+i+`" name="reactif`+i+`" class=" custom-select" >
                                      <option selected value="" >Selectionner un réactif</option>
                                        <?php while ($groupe= $ReactifParametre->fetch()){ ?>
                                        <option unite="<?= $groupe['uniteReactif']?>"  value="<?= $groupe['id_reactif'] ?>" ><?= $groupe['nomReactif'] ?></option>
                                      <?php } ?>
                                      </select>
                                </div>
                                <div class="col-4" style="padding-left: 0">
                                  <div class="input-group ">
                                  <input type="number" name="valReactif`+i+`" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" value="`+value+`" >
                                  <div class="input-group-append">
                                    <span class="input-group-text"  id="id_Unite`+i+`">Unité</span>
                                  </div>
                                </div>
                                </div>
                                <div class="col-1 p-0" style="align-self: center;" onclick="removeFormule(this)">
                                  <i style="font-size: 30px" class="fas fa-minus-circle"></i>
                                </div>
                              </div>
          `);
        if(id){
          document.getElementById('selectFormule'+i).value=id;
          formule+= textParam(id)+'('+value+''+returnUnite(i)+'),';
          changeUnite(i);
        }
        i++;
  }
function returnUnite(i){
var test = $("#selectFormule"+i+" option:selected").attr('unite');
 return test;
}

function changeUnite(i){
//console.log($("#selectFormule"+i+" option:selected").attr('unite'));
var test = $("#selectFormule"+i+" option:selected").attr('unite');
 $("#id_Unite"+i).text(test);
}

  function textParam(idParam){
    return $("#selectFormule0 option[value='" + idParam + "']").text();
  
  }

</script>
  <?php foreach ($TableParamMat as $formule) { $formule=explode('@', $formule); ?>
      <script>addFormule(<?= $formule[0] ?>,<?= $formule[1]?>);</script>
  <?php } ?>
<script>
  $("#formuleParam").html(formule);
</script>

<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>
