<?php $title='Gestion de normes' ?>

<?php ob_start(); ?>
              <form method="post" action="" id="formNorme" enctype="multipart/form-data">
                  <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                      <label for="text" class="ldpLabel justify-content-middle text-left mr-2" >Nom de la norme</label>
                      <input required type="text" name="nomNorme" class="input form-control ml-2" value="<?= $norme['nomNorme'] ?>">
                  </div>
                  <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                  <label for="Abreviation" class="ldpLabel justify-content-middle text-left mr-2">Abréviation de la norme</label>
                    <select required name="Abreviation" id="Abreviation" class="form-control ml-2" onchange="disableOptions()">
                        <option value=" " <?= ($norme['Abreviation'] === ' ') ? 'selected' : '' ?>>Aucun</option>
                        <option value="Poids_Total_g" <?= ($norme['Abreviation'] === 'Poids_Total_g') ? 'selected' : '' ?>>Poids_Total_g</option>
                        <option value="Poids_Chocolat_g" <?= ($norme['Abreviation'] === 'Poids_Chocolat_g') ? 'selected' : '' ?>>Poids_Chocolat_g</option>
                        <option value="Poids_Fourrage1_g" <?= ($norme['Abreviation'] === 'Poids_Fourrage1_g') ? 'selected' : '' ?>>Poids_Fourrage1_g</option>
                        <option value="Poids_Fourrage2_g" <?= ($norme['Abreviation'] === 'Poids_Fourrage2_g') ? 'selected' : '' ?>>Poids_Fourrage2_g</option>
                        <option value="Poids_Inclusions1_g" <?= ($norme['Abreviation'] === 'Poids_Inclusions1_g') ? 'selected' : '' ?>>Poids_Inclusions1_g</option>
                        <option value="Poids_Inclusions2_g" <?= ($norme['Abreviation'] === 'Poids_Inclusions2_g') ? 'selected' : '' ?>>Poids_Inclusions2_g</option>
                        <option value="Poids_Biscuit_Seul_g" <?= ($norme['Abreviation'] === 'Poids_Biscuit_Seul_g') ? 'selected' : '' ?>>Poids_Biscuit_Seul_g</option>
                    </select>

                        <br>
                  </div>
                  <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="number" class="ldpLabel justify-content-middle text-left" >document de la norme</label>
              <!--------------->
                    <div id="lienNorme">
                      <hr>
                        <div class="form-check">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienNorme"
                        value="FILE"
                        id="fileNorme"
                        <?= ($norme['lienNorme']['type']=='FILE')?'checked':'' ?>
                        onchange="toggleLien('lienNorme')"
                      />
                      <label class="form-check-label" for="fileNorme">
                        Importer un fichier
                        <input type="file" id="fichierNorme" name="lienNorme" class="fichier"
                        <?php if($norme['lienNorme']['type']!='FILE'){ ?>
                          disabled
                        <?php } ?> 
                        />
                      </label>
                    </div>

                    <div class="form-check">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienNorme"
                        value="LINK"
                        id="linkNorme"
                        <?= ($norme['lienNorme']['type']=='LINK')?'checked':'' ?>
                        onchange="toggleFichier('lienNorme')"
                      />
                      <label class="form-check-label" for="linkNorme">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienNorme"
                          name="lienNorme"
                          placeholder="http://"
                        <?php if($norme['lienNorme']['type']=='LINK'){ ?>
                          value="<?= $norme['lienNorme']['lien'] ?>"
                        <?php }else{ ?>
                          disabled
                        <?php } ?> 
                        />
                      </label>
                    </div>
                    <hr>
                    </div>
              <!--------------->
              </div>
                  <div class="typechoice mb-3">
                  <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 

                        <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-3" >Type de la norme</label>

                            <select required name="typeNorme" id="typeNorme" class="selectNormeForm custom-select custom-select-lg " onchange="setchoice(this.value)">
                                    <option value="">Ouvrir le menu de selection</option>
                                    <option <?php if($norme['typeNorme']=='texte') echo 'selected'; ?> value="texte" >Texte</option>
                                    <option <?php if($norme['typeNorme']=='booleen') echo 'selected'; ?> value="booleen" >Commutateur</option>
                                    <option <?php if($norme['typeNorme']=='valeur') echo 'selected'; ?> value="valeur" >Valeur numérique</option>
                                    <option <?php if($norme['typeNorme']=='intervalle') echo 'selected'; ?> value="intervalle" >Intervalle</option>
                                    <option <?php if($norme['typeNorme']=='formule') echo 'selected'; ?> value="formule" >Formule</option>
                                </select>
                              <br>
                      </div>
                      </div>

          <div id="formchoix">
            <div id="vn" class="d-none mt-3">
              <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="number" class="ldpLabel justify-content-middle text-left" >Valeur</label>
                <input name="valeur" step="any" type="number" step="any" class="input form-control ml-2" value="<?= $valeur ?>">
                </div>
                <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="text" class="ldpLabel justify-content-middle text-left" >Message d'alerte</label>
                    <input name="messageAlert1" type="text"  class="input form-control ml-2" value="<?= $norme['messageErreur'] ?>">
                </div>
                <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="uniteMesureV" class="ldpLabel justify-content-middle text-left" >Unité de mesure</label>
                    <input name="uniteMesureV" id="uniteMesureV" type="text"  class="input form-control ml-2" value="<?= $norme['uniteMesure'] ?>">
                </div>
          </div>
        

          <div id="intervalle" class="d-none mt-3">
              <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="number" class="ldpLabel justify-content-middle text-left" >Valeur Inférieure</label>
                <input name="min" type="number" step="any" class="input form-control ml-2" value="<?= $min ?>">
              </div>

              <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="number" class="ldpLabel justify-content-middle text-left" >Valeur Supérieure</label>
                <input name="max" type="number" step="any" class="input form-control ml-2" value="<?= $max ?>">
              </div>
                
              <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="text" class="ldpLabel justify-content-middle text-left" >Message d'alerte</label>
                <input name="messageAlert2" type="text"  class="input form-control ml-2" value="<?= $norme['messageErreur'] ?>">
              </div>
                <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="uniteMesureI" class="ldpLabel justify-content-middle text-left" >Unité de mesure</label>
                    <input name="uniteMesureI" id="uniteMesureI" type="text"  class="input form-control ml-2" value="<?= $norme['uniteMesure'] ?>">
                </div>
          </div>
         
          <div id="formule" class="d-none mt-3">
            <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="number" class="ldpLabel justify-content-middle text-left" >Formule</label>
                </div>

              <div class="bg-light border border-secondary p-3 rounded shadow m-3 " onclick="calc(event)">
                <div class="input-group mb-3">
                  <input required type="text" value="<?= $reFormule; ?>" class="form-control form-control-lg" id="inputFormule" placeholder="Entrez la formule"  aria-describedby="basic-addon" style="border-top-right-radius: 0px !important; border-bottom-right-radius: 0px !important;" disabled />

                  <div class="input-group-append">                    
                    <a class="fas fa-undo-alt fa-2x input-group-text bg-dark text-white align-text-bottom " id="basic-addon" href="#" style="text-decoration: none;" onclick="deletes()"></a>
                  </div>
                </div>

                <div class="row">

                      <?php while ($btn_norme = $listNorme->fetch()) { ?>
                        <?php if($norme['id_norme']!=$btn_norme['id_norme']){ ?>
                        <button id="<?= $btn_norme['id_norme'] ?>" type="button" class="col btn btn-primary m-1"><?= str_replace(' ', '-', $btn_norme['nomNorme']) ?></button>
                      <?php }} ?>
                        </div>
                      <div class="row">
                            <button type="button" class="col btn btn-primary m-1">1</button>
                            <button type="button" class="col btn btn-primary m-1">2</button>
                            <button type="button" class="col btn btn-primary m-1">3</button>
                            <button type="button" class="col btn btn-primary m-1">4</button>
                            <button type="button" class="col btn btn-primary m-1">5</button>
                            <button type="button" class="col btn btn-primary m-1">6</button>
                            <button type="button" class="col btn btn-primary m-1">7</button>
                            <button type="button" class="col btn btn-primary m-1">8</button>
                            <button type="button" class="col btn btn-primary m-1">9</button>
                            <button type="button" class="col btn btn-primary m-1">0</button>
                        </div>
                        <div class="row">
                                <button type="button" class="col btn btn-primary m-1">+</button>
                                <button type="button" class="col btn btn-primary m-1">*</button>
                                <button type="button" class="col btn btn-primary m-1">-</button>
                                <button type="button" class="col btn btn-primary m-1">/</button>
                                <button type="button" class="col btn btn-primary m-1">(</button>
                                <button type="button" class="col btn btn-primary m-1">)</button>
                                <button type="button" class="col btn btn-primary m-1">.</button>
                            </div>
                        <div class="input-group mb-3">
            <input type="text" name="formule" value="<?= $formule ?>" class="form-control form-control-lg d-none" id="inputBack"  aria-describedby="basic-addon" >
           
          </div>  
         </div>
            <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="number" class="ldpLabel justify-content-middle text-left" >Valeur Inférieure</label>
                <input name="minF" type="number" step="any" class="input form-control ml-2" value="<?= $min ?>">
              </div>

              <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="number" class="ldpLabel justify-content-middle text-left" >Valeur Supérieure</label>
                <input name="maxF" type="number" step="any" class="input form-control ml-2" value="<?= $max ?>">
              </div>
                
              <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="text" class="ldpLabel justify-content-middle text-left" >Message d'alerte</label>
                <input name="messageAlert3" type="text"  class="input form-control ml-2" value="<?= $norme['messageErreur'] ?>">
              </div>
        
  <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                <label for="uniteMesureF" class="ldpLabel justify-content-middle text-left" >Unité de mesure</label>
                    <input name="uniteMesureF" id="uniteMesureF" type="text"  class="input form-control ml-2" value="<?= $norme['uniteMesure'] ?>">
          </div>
        </div>
      </div>
<!-- ********************** -->
                      
                <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                 <label for="isReset" class="ldpLabel justify-content-middle text-left mr-3" >Norme Réintialisé</label>
                  <div class="onoffswitch">
                    <input type="checkbox" name="isReset" class="onoffswitch-checkbox" id="myonoffswitch" <?php if($norme['isReset']!='0') echo "checked"; ?> >
                    <label class="onoffswitch-label" for="myonoffswitch">
                      <span class="onoffswitch-inner"></span>
                      <span class="onoffswitch-switch"></span>
                    </label>
                  </div>
                </div>

                <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                 <label for="isReset" class="ldpLabel justify-content-middle text-left mr-3" >Norme avec timer ?</label>
                  <div class="onoffswitch" onclick="timerValue()">
                    <input type="checkbox" name="parTime" class="onoffswitch-checkbox" id="switchTimer" <?php if($norme['parTime']>'0') echo "checked"; ?> >
                    <label class="onoffswitch-label" for="switchTimer">
                      <span class="onoffswitch-inner"></span>
                      <span class="onoffswitch-switch"></span>
                    </label>
                   
                  </div>
                    <div id="timerInput" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                      <label for="number" class="ldpLabel justify-content-middle text-left mr-2" >Temps</label>
                      <input name="time" type="time" step="any" class="unit input form-control ml-2" value="<?= $norme['time'] ?>">
                    </div>
                </div>


                <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                 <label for="number" class="ldpLabel justify-content-middle text-left mr-2" >Ordre</label>
                <input required name="ordreNorme" type="number" step="any" class="unit input form-control ml-2" value="<?= $norme['ordreNorme'] ?>">
                </div>
                <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                
                        <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-3" >Affecter au Colonne/Groupe</label>

                            <select required name="groupeN" class="selectNormeForm custom-select custom-select-lg ">
                                  <optgroup label = "selectionner une colonne">
                                    <option <?php if($norme['id_groupeN']==NULL && $norme['colone']==1) echo 'selected'; ?> value="-1">Colonne 1</option>
                                    <option <?php if($norme['id_groupeN']==NULL && $norme['colone']==2) echo 'selected'; ?> value="-2">Colonne 2</option>
                                  </optgroup>
                                  <optgroup label = "ou un groupe">
                                  <?php while ($groupe= $listGroupeN->fetch()){ ?>
                                    <option <?php if($norme['id_groupeN']==$groupe['id_groupeN']) echo 'selected'; ?> value="<?= $groupe['id_groupeN'] ?>" ><?= $groupe['nomGroupeN'] ?></option>
                                  <?php } ?>
                                  </optgroup>
                                </select>
                              <br>
                      </div>
                <div class="text-center">
                <input type="submit" name="valider" class="btn btn-primary w-auto" value="VALIDER" >
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="var modal1 = $('.close', window.parent.document); modal1.click();">ANNULER</button> 
                </div>
                 
              </form>

<script type="text/javascript">
  
  setchoice('<?= $norme['typeNorme'] ?>');

  function refresh() {
    window.location.href = window.location.href;
  }

function setchoice(val1){
switch (val1){
    case "valeur":
      document.getElementById('vn').className = "d-block"
      document.getElementById('intervalle').className = "d-none"
      document.getElementById('formule').className = "d-none"
       var list =document.getElementById('formchoix').getElementsByTagName('input');

      for(i=0;i<list.length;i++){
        list[i].required=false;
      }

      var vnList=document.getElementById('vn').getElementsByTagName('input');
      for(i=0;i<vnList.length;i++){
        vnList[i].required =true;
      }
     

    break;
    case "intervalle":
    document.getElementById('vn').className = "d-none"
      document.getElementById('intervalle').className = "d-block"
      document.getElementById('formule').className = "d-none"
      var list =document.getElementById('formchoix').getElementsByTagName('input');

      for(i=0;i<list.length;i++){
        list[i].required=false;
      }

    var vnList=document.getElementById('intervalle').getElementsByTagName('input');
      for(i=0;i<vnList.length;i++){
        vnList[i].required =true;
      }
      
    break;
    case "formule":
      document.getElementById('vn').className = "d-none"
      document.getElementById('intervalle').className = "d-none"
      document.getElementById('formule').className = "d-block"
      var list =document.getElementById('formchoix').getElementsByTagName('input');

      for(i=0;i<list.length;i++){
        list[i].required=false;
      }
      var vnList=document.getElementById('formule').getElementsByTagName('input');
      for(i=0;i<vnList.length;i++){
        vnList[i].required =true;
      }
      
    break;
    case "checkbox":
      document.getElementById('vn').className = "d-none"
      document.getElementById('intervalle').className = "d-none"
      document.getElementById('formule').className = "d-none"


    break;
    case "texte":
      document.getElementById('vn').className = "d-none"
      document.getElementById('intervalle').className = "d-none"
      document.getElementById('formule').className = "d-none"
    
    break;
    default:
    document.getElementById('vn').className = "d-none"
      document.getElementById('intervalle').className = "d-none"
      document.getElementById('formule').className = "d-none"
    
    break;
}
}
/*****/
var input=document.getElementById('inputFormule');
var inputBackend=document.getElementById('inputBack');
var op = ["+","-","*","/","(",")"];
var evenValue;
var cond="";
function calc(event) {
  evenValue=event.target.textContent;
  typeValue=event.target.value;

  if(event.target.tagName == "BUTTON"){
    
    if(!isNaN(evenValue) || evenValue =='.'){
      input.value += evenValue+" ";
      input.value=input.value.slice(0,-1);
    }
    else if (!isNaN(cond[cond.length-1]) && isNaN(evenValue)){
      input.value += " "+evenValue+" ";
    }
    else {
      input.value += evenValue+" ";
    }
  }
  try{
  cond =input.value.split(" ");
  cond= cond.filter(Boolean);
  }catch(error){}

  backendFormule(event);

}

var val,valBack;
function deletes(){
  val = input.value.split(" ");
  val= val.filter(Boolean);
  val.splice(-1,1);
  input.value= "";
  for(i=0;i<val.length;i++){
    input.value += val[i]+" ";
  }

  /*-------BackGround------------*/

  valBack = inputBackend.value.split(" ");
  valBack= valBack.filter(Boolean);
  valBack.splice(-1,1);
  inputBackend.value= "";
  for(i=0;i<valBack.length;i++){
    inputBackend.value += valBack[i]+" ";
  }

}

function backendFormule(event){
  if(event.target.tagName == "BUTTON"){
    eventID = event.target.id;

    if(!isNaN(evenValue) || evenValue =='.'){
      inputBackend.value += evenValue+" ";
      inputBackend.value=inputBackend.value.slice(0,-1);
    }
    else if (isNaN(cond[cond.length-1]) && op.indexOf(evenValue)== -1){
      inputBackend.value += " @"+eventID+"] ";
    }
    else{
      inputBackend.value += " "+evenValue+" ";

    }
    
  }
  
 
  
}

      function toggleLien(className){
        $('#'+className+" .lien").prop("disabled", true)
        $('#'+className+" .fichier").prop("disabled", false)

      }

      function toggleFichier(className){
        $('#'+className+" .fichier").prop("disabled", true);
        $('#'+className+" .lien").prop("disabled", false);
      }


/*------------------*/



</script>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>

<script>
window.closeModal = function(){
    $('#iframeModal').modal('hide');
};

function closeM(){
  window.parent.closeModal();
}
</script>

<script>
   function timerValue(){
    if(document.getElementById('switchTimer').checked){
      document.getElementById('timerInput').style.display ="flex"
     }
  else{
      document.getElementById('timerInput').style.display ="none"

  }
  }

  timerValue();

</script>
<script>

    // Définissez la fonction disableOptions()
    function disableOptions() {
        var selectNorme = document.getElementById('typeNorme');
        console.log(selectNorme);
        var abreviation = document.getElementById('Abreviation');
        console.log(abreviation);
        // Désactiver les options "Texte" et "Commutateur" si un champ "Poids" est sélectionné
        if (abreviation.value.indexOf('Poids_') !== -1) {
            for (var i = 0; i < selectNorme.options.length; i++) {
                if (selectNorme.options[i].value === 'texte' || selectNorme.options[i].value === 'booleen') {
                    selectNorme.options[i].disabled = true;
                }
            }
        } else {
            // Activer toutes les options si aucun champ "Poids" n'est sélectionné
            for (var i = 0; i < selectNorme.options.length; i++) {
                selectNorme.options[i].disabled = false;
            }
        }
    }

</script>