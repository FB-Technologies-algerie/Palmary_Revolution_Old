<?php $title="Consigne" ?>
<?php $style='<link rel="stylesheet" href="'.$_SESSION['url'].'public/css/consigne.css">'; ?>

<?php ob_start(); ?>

	                  <form method="post" action="" enctype="multipart/form-data">
                    <div class="correspMessagerie"> 
                            <div class="form-group row" >
                                <label for="a" class="col-sm-1 col-form-label">À...</label>
                                <div class="col-sm-11" id="userBtnSelect">
                              <?php if(!$id_reponseMsg){ ?>
                                    <div id="btnArea" class="d-inline"></div>
                                    <select class="form-control d-inline" style="width: 250px;" onchange="addBtn()" id="userSelected">
                                      <option>Selectionné le destinataire</option>
                                      <option value="all">Selectionné tous</option>
                              	<?php while ($receptUser=$listRecept->fetch()) { ?>
                                      <option value="<?= $receptUser['id_user'] ?>"><?= $receptUser['nomComplet'] ?></option>
                                <?php } ?>
                                    </select>  
                            		<input type="hidden" name="listRecept" id="hiddenInput">
                              <?php }else{ $listRecept=''; ?>
                              		<div id="btnArea" class="d-inline">
                              		  <?php if(!$usersMsgRecev){ $listRecept=$msg['id_sender']; ?>
                              			<button type="button" class="p-0 pl-2 pr-2 btn btn-primary" disabled=""><?= $msg['login']; ?></button>
                              		  <?php }else{
                              		  	while ($receptUser=$usersMsgRecev->fetch()) {
                              		  		$listRecept.= $receptUser['id_user'].';'; ?>
                              		  	<button type="button" class="p-0 pl-2 pr-2 btn btn-primary" disabled=""><?= $receptUser['login']; ?></button>
                              		  <?php	}
                              		  } ?>
                              		</div>
                              		<input type="hidden" name="listRecept" id="hiddenInput" value="<?= $listRecept ?>">
                              <?php } ?>
                                </div>
                            </div>
                         
                            <div class="form-group row">
                                    <label for="objet" class="col-sm-1 col-form-label">Objet</label>
                                    <div class="col-sm-11">
                                      <input type="text" name="objetMsg" class="form-control" placeholder="" value="<?= ($id_reponseMsg)? 'Re: '.$msg['objetMsg']:'' ?>">
                                    </div>
                            </div>
                        <?php if($id_reponseMsg){ ?>
                            <div class="form-group row">
                              <label for="objet" class="col-sm-1 col-form-label">Etat de la consigne</label>
                              <select class="form-control d-inline" style="width: 250px;" name="etatConsigne" id="etatConsigne">
                                <option <?= ($msg['etatConsigne']=='enAttente')? 'selected':'' ?> value="enAttente">en attente</option>
                                <option <?= ($msg['etatConsigne']=='enCours')? 'selected':'' ?> value="enCours">en cours</option>
                                <option <?= ($msg['etatConsigne']=='terminer')? 'selected':'' ?> value="terminer">terminé</option>
                              </select>
                            </div>
                      <?php } ?>
                            <div class="form-group row">
                              <label for="joint" class="col-sm-1">Joindre</label>
                              <div class="col-sm-11">
                                <input type="file" name="jointMsg" class="form-control-file" id="joint">
                              </div>
                            </div>

                            <textarea id="summernote" name="corpMsg"></textarea>

                    </div>
                  
                <div class="modal-footer mx-auto">
                    <input type="submit" name="valider" class="btn btn-primary" value="ENVOYER">
                    <button type="button" onclick="var modal1 = $('.close', window.parent.document); modal1.click();" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                </div>
              </form>

<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>

    <script>
              //*************************************User Selection*****************************************

    var allElements ;
    var hidenInput;

    function getElements(){
      hidenInput = document.getElementById('hiddenInput');
      allElements = hidenInput.value.split(';');
    }


    function addBtn(){
      var e = document.getElementById("userSelected");
      var strUser = e.options[e.selectedIndex].text;
      var idUser = e.options[e.selectedIndex].value;
      

      ajoutBtn(idUser,strUser)
        
        if(idUser=='all'){
          for(var i=0;i<e.options.length;i++){
            ajoutBtn(e.options[i].value,e.options[i].text);
          }
        }
        else{
          ajoutBtn(idUser,strUser);
        }
        
    }

    function ajoutBtn(idUser,strUser){
      getElements();
      var groupBtn = document.getElementById('userBtnSelect').getElementsByTagName('div')[0];

      if(!allElements.includes(idUser) && strUser!='Selectionné le destinataire' && idUser!='all'){

          groupBtn.innerHTML += ` <button type="button" class="p-0 pl-2 pr-2 btn btn-primary" value="`+idUser+`" disabled="">`+strUser+`<i href="#" class="fas fa-minus-circle ml-2 removeBTN"  onclick="removeBtn(this)"></i></button>`;
           hidenInput.value +=idUser+';';
           allElements = hidenInput.value.split(';');
         }
    }

    function removeBtn(val){
        getElements(); 

     val.parentNode.remove(val.parentNode);

      allElements.splice(allElements.indexOf(val.parentElement.value), 1);  
      hidenInput.setAttribute('value',allElements.join(';'));
    }

           /**************************************************************************************/

      $('#summernote').summernote({
          tabsize: 3,
          height: 300
      });
</script>

<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>