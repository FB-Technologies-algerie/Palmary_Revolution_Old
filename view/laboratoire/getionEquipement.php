<?php $title="Gestion d'equipement" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>


    <div class="card">
     <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
          <span class="cardTitle" >GESTION DES EQUIPEMENTS</span> 
          <a  href="#" data-toggle="modal"  data-target="#ajouteEquipement" class="btn btn-primary float-right mt-2 ml-3 btnAlign"><i class="fas fa-plus-circle"></i> EQUIPEMENT</a>
          <a href="#" data-toggle="modal"  data-target="#ajoutegroupe" class="btn btn-primary float-right mt-2 ml-3 btnAlign"><i class="fas fa-plus-circle"></i> GROUPE</a>
            
      </div> 
      <div class="card-body pt-1">

<div class="tab-content" id="myTabContent">
<div id="colonne1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="colonne1-tab">
    <div class="table-responsive">
            <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0" >
              <thead class="w-100">
                <tr>
                
                  <th style="width: 20%">Nom equipement</th>
                  <th style="width: 20%">Discription</th>
                 <th style="width:10%;text-align:center;">Supprimer</th>
                </tr>
              </thead>
            </table>
            <div id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
              <?php while ($groupe = $listeG->fetch()){ 
                      affichegroupe($groupe);
               } ?> 
            </div>
  

            <div  class="table  table-striped table-hover table-bordered table-sm m-0">
              <?php while ($equipe= $equipementLibre->fetch()){ ?> 
                    
      
              <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
                <tr>
               
                  
                  <td style="width: 20%"><a href="#" data-toggle="modal" data-target="#DtailEquipement"  class="textTab"  onclick="descriptionEquipement(<?= $equipe['id_equipement']?>)"><?= $equipe['nomEquipement'] ?></a></td>
                  <td style="width: 20%"><?= $equipe['descriptionEquipement'] ?></td>   
                  <td style=" text-align: center;width: 10%">
                    <a href="" onclick="defineId(<?= $equipe['id_equipement'] ?>)" name="supprimeEquipe" data-toggle="modal" data-target="#supprime"> <i class="fas fa-minus-circle"  style="color:rgb(119, 4, 4);" ></i></a>
                  </td> 
                </tr>
              </table>
         
       <?php ; 
} ?>
    
            </div>
          </div>
      </div>
    </div>
   </div>
 </div>
</div>

    

<div class="modal fade" id="DtailEquipement" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" style="max-width: 700px !important">
              <div class="modal-content">
                <div class="modal-header center">
                  <div class="modal-title" id="DtailEquipe">Detail equipement </div>
                  <a href="" id="ficheDeVie" class="btn btn-primary" style="width:auto !important;margin-left: auto;" >fiche de vie</a>
                 <button style="margin-left:0;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
               
                <div class="modal-body" id="afficheDonne"  >    
                   
                   
                   <form method="post" id="formEquipement" action="">
                    <div id="LDP_modif" class="row"> 
                            <div class="col-5" >Nom d'equipement</div>
                            
                            <div  class="col-7 detail">   <strong id="nomEquipement"></strong></div>
                            <div class="col-7">
                                      <input type="text" id="nomEquipe" name="nomEquipe" class="form-control modif" placeholder="">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div  class="col-5" >Description d'equipement</div>
                            <div class="col-7 detail"> <strong id="descriptionEquipement"></strong> </div>
                            <div class="col-7">
  
                                      <textarea id="descriptionEquipe" name="descriptionEquipe" class="form-control modif" placeholder=""></textarea>
                            </div>
                    </div>
                    <br>
                     <div id="LDP_modif" class="row"> 
                      <div  class="col-5">Groupe</div>
                          <div class="col-7 detail"> <strong id="idGroupeEquipement"></strong> </div>
                           <div class="col-7">
                                      <select   id="GroupeEquipe" name="GroupeEquipement" class="selectNormeForm custom-select custom-select-lg  modif ">
                                        <option selected value="null" >Aucun groupe</option>
                                      <?php while ($groupe= $listGroupeE->fetch()){ ?>
                                       <option value="<?= $groupe['idGroupeEquipement'] ?>" ><?= $groupe['nomGroupeEquip'] ?></option>
                                      <?php } ?>
                                      </select>
                            </div>
                    </div>
                     
                    <div class="modal-footer d-block text-center">       
                     <input id="submitBtn" type="button" onclick="modifEquipment()" class="btn btn-primary" name="modifer" style="width:auto !important;margin-left: auto;" value="MODIFIER">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
   

<!-- detail groupe -->
   <div class="modal fade" id="Dtailgroupe" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" style="max-width: 700px !important">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="Dtailgroupe">Detail Groupe </h5>
                 
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
               
                <div class="modal-body" id="afficheDonne"  >    
                    
                   <form method="post" id="formGroupe" action="">
                    <div id="LDP_modif" class="row"> 
                            <div class="col-5" >Nom de groupe</div> 
                            
                            <div  class="col-7 detailGroupe">   <strong id="nomGroupe"></strong></div>
                            <div class="col-7">
                                      <input type="text" id="nomGroupeEquipe" name="nomGroupeEquipe" class="form-control modifGroupe" placeholder="">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-5" >Discription de groupe</div>
                            
                            <div  class="col-7 detailGroupe">   <strong id="Discgroupe"></strong></div>
                            <div class="col-7">
                                      <input type="text" id="DiscgroupeEquipe" name="DiscgroupeEquipe" class="form-control modifGroupe" placeholder="">
                            </div>
                    </div>
                    <br>
                  
                    <br>
                     <div id="LDP_modif" class="row"> 
                      <div  class="col-5">Groupe de Groupe</div>
                          <div class="col-7 detailGroupe"> <strong id="idGroupe"></strong> </div>
                           <div class="col-7">
                                      <select id="GroupeEquipement" name="GroupeEquipement" class="selectNormeForm custom-select custom-select-lg  modifGroupe ">
                                        
                                        <option selected value="null" >Aucun groupe</option>
                                      <?php while ($groupe= $listeGdetail->fetch()){ ?>
                                       <option value="<?= $groupe['idGroupeEquipement'] ?>" ><?= $groupe['nomGroupeEquip'] ?></option>
                                      <?php } ?>
                                      </select>
                            </div>
                    </div>
                     
                    <div class="modal-footer d-block text-center">       
                     <input id="submitBtnGroupe" type="button" onclick="modifGroupeEquipment()" class="btn btn-primary" name="modiferGroupe" style="width:auto !important;margin-left: auto;" value="MODIFIER">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
   
   <div class="modal fade" id="ajouteEquipement" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">AJOUTER EQUIPEMENT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="">
                    <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nom d'equipement</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="nomEquipement" class="form-control"  placeholder="">
                                    </div>
                            </div>
                    <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Discription equipement</label>
                                    <div class="col-sm-10">
                                      <textarea id="descriptionEquipement" name="descriptionEquipement"  class="form-control" placeholder=""></textarea>
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Groupe</label>
                                    <div class="col-sm-10">
                                      <select  name="GroupeEqu" class="selectNormeForm custom-select custom-select-lg ">

                                        <option selected value="null" >Aucun groupe</option>
                                      <?php while ($groupe= $listeGE->fetch()){ ?>
                                       <option value="<?= $groupe['idGroupeEquipement'] ?>" ><?= $groupe['nomGroupeEquip'] ?></option>
                                      <?php } ?>
                                       </select>
                                    </div>
                            </div>
                    
                    <div class="modal-footer d-block mx-auto text-center">
                    <input type="submit" class="btn btn-primary w-auto" name="ajouterEquipe"  value="VALIDER">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
            </form>
          </div>
          <div class="modal-footer mx-auto"> 
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ajoutegroupe" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">AJOUTER GROUPE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="">
                    <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nom de groupe</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="nomGroupe" class="form-control"  placeholder="">
                                    </div>
                            </div>
                    <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Discription de groupe</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="DescGroupe" class="form-control" placeholder="">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Groupe</label>
                                    <div class="col-sm-10">
                                      <select  name="selectGroupe" class="selectNormeForm custom-select custom-select-lg ">
                                        
                                        <option value="null" >Aucun groupe</option>
                                       <?php while ($groupe= $listeGajout->fetch()){ ?>
                                       <option value="<?= $groupe['idGroupeEquipement'] ?>" ><?= $groupe['nomGroupeEquip'] ?></option>
                                      <?php } ?>
                                       </select>
                                    </div>
                            </div>
                    
                    <div class="modal-footer d-block mx-auto text-center">
                    <input type="submit" class="btn btn-primary w-auto" name="ajouterGroupe"  value="VALIDER">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
            </form>
          </div>
          <div class="modal-footer mx-auto"> 
          </div>
        </div>
      </div>
    </div>

 <!--Modal SUPPRIMER EQUIPEMENT-->
    <div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Suppression d'une equipement</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p style="font-size:20px;">Vous voulez vraiement supprimer cette equipement ?</p>
                </div>
                <div class="modal-footer mx-auto">
                <a href="<?= $_SESSION['url'] ?>gestionEquipements/" id="confirmSup"  class="btn btn-primary">Confirmer</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>  
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="supprimeGroupe" name="supprimeGroupe" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Suppression d'un groupe</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p style="font-size:20px;">Vous voulez vraiement supprimer ce groupe ?</p>
                </div>
                <div class="modal-footer mx-auto">
                <a href="<?= $_SESSION['url'] ?>gestionEquipements/" id="confirmSupgroupe" name="supprimeG"  class="btn btn-primary">Confirmer</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>  
                </div>
              </div>
            </div>
          </div>


<script type="text/javascript">




  function getLDPgroupe(value){
    document.getElementById('iframe').setAttribute("src",`<?= $_SESSION['url'] ?>formgroupe/${value.id}`);
  }
  function getNewgroupe(){
    document.getElementById('iframe').setAttribute("src",`<?= $_SESSION['url'] ?>formgroupe/addP/<?= $prod['id_prod'] ?>`);
  }
  function refresh() {
    window.location.href = window.location.href;
  }
  async function supprimegroupe(id_groupe) {
           var xhttp;
            xhttp = new XMLHttpRequest();
            
            xhttp.open("GET", "<?= $_SESSION['url'] ?>formgroupe/supprimer/"+id_groupe, true);
            await xhttp.send(); 
    await refresh();
  }
  function getID(id) {
    document.getElementById('confirmSup').setAttribute("onclick","supprimegroupe("+id+")");

    document.getElementById('titleGroup').textContent= "Supression groupe";
    document.getElementById('textGroup').textContent= "Vous voulez vraiement supprimer cette groupe ?";
  }

  function getGroupOld(val,col){
    document.getElementById('nameGroup').value = val.text;
    document.getElementById('ordreGroup').value = val.parentElement.parentElement.getElementsByTagName('td')[1].textContent;
    document.getElementById('formGroup').setAttribute("action", '<?= $_SESSION['url'] ?>groupeN/modif/'+val.id);
    if(col==1) document.getElementById('col1').setAttribute("selected","selected");
    else document.getElementById('col2').setAttribute("selected","selected");



  }
  
function getGroup(id,name,ordre,groupeN,colone){
    document.getElementById('nameGroup').value =name;
    document.getElementById('ordreGroup').value =ordre;
    var selectList =document.querySelector('.selectgroupeForm');
    for (var i = 0; i < selectList.length; i++) {
      if(name == selectList[i].textContent){
        selectList[i].disabled = true;
      }
      else{
        selectList[i].disabled = false;

      }
    }
    if(groupeN=='') document.querySelector('.selectgroupeForm').value = -colone; 
      else{
        document.querySelector('.selectgroupeForm').value = groupeN;
        //si même nom disabled
      }

    document.getElementById('formGroup').setAttribute("action", '<?= $_SESSION['url'] ?>groupeN/modif/'+id);
  }




  function getSuprimGroup(id_groupeN){
    document.getElementById('titleGroup').textContent= "Supression groupe";
    document.getElementById('textGroup').textContent= "Vous voulez vraiement supprimer ce groupe ?";

    document.getElementById('confirmSup').setAttribute("onclick","supprimegroupe("+id_groupeN+")");
  }

  function clearGroup(){
    document.getElementById('nameGroup').value ="";
    document.getElementById('ordreGroup').value ="";
    document.getElementById('formGroup').setAttribute("action", '<?= $_SESSION['url'] ?>groupeN/ajout/<?= $prod['id_prod'] ?>');
   var selectList =document.querySelector('.selectgroupeForm');

     for (var i = 0; i < selectList.length; i++) {
        selectList[i].disabled = false;
    }

  }
 


</script>
<style type="text/css">
  .firstCard .firstCard{
    margin: 7px 16px 3px 16px !important;
  }
  .firstCard{
    margin-top: 7px !important;
  }
</style>

<?php $content= ob_get_clean(); ?>



<?php ob_start(); ?>  
<script>
function descriptionEquipement(id_equipement) {
   
      $(".detail").addClass("d-none");
      $(".modif").addClass("d-none");
      $.get("<?= $_SESSION['url'] ?>detailEquipe/"+id_equipement, function(data, status){
        var obj =JSON.parse(data);
        $('#submitBtn').attr('value','MODIFIER')
        $('#nomEquipement').text(obj.nomEquipement);
        $('#nomEquipe').val(obj.nomEquipement);
        $('#descriptionEquipement').text(obj.descriptionEquipement);
        $('#descriptionEquipe').val(obj.descriptionEquipement);
        $('#idGroupeEquipement').text(obj.idGroupeEquipement);
        $('#GroupeEquipe').val(obj.idGroupeEquipement);
        $('#formEquipement').attr('action','<?= $_SESSION['url'] ?>detailEquipe/'+id_equipement);
        $('#ficheDeVie').attr('href','<?= $_SESSION['url'] ?>ficheDeVie/'+id_equipement);
        $(".detail").removeClass("d-none");
      });
  
  }

  function descriptionGroupeEquipe(idGroupeEquipement) { 
      $(".detailGroupe").addClass("d-none");
      $(".modifGroupe").addClass("d-none");
      $.get("<?= $_SESSION['url'] ?>detailGroupe/"+idGroupeEquipement, function(data, status){
      var obj =JSON.parse(data);
      $('#submitBtnGroupe').attr('value','MODIFIER')
      $('#nomGroupe').text(obj.nomGroupeEquip);
      $('#nomGroupeEquipe').val(obj.nomGroupeEquip);
      $('#Discgroupe').text(obj.descriptionGroupe);
      $('#DiscgroupeEquipe').val(obj.descriptionGroupe); 
      $('#idGroupe').text(obj.id_groupe);
      $('#GroupeEquipement').val(""+obj.id_groupe+""); 
      $('#formGroupe').attr('action','<?= $_SESSION['url'] ?>detailGroupe/'+idGroupeEquipement);
      $(".detailGroupe").removeClass("d-none");
    });
  }


  function modifEquipment(){
  if($('#submitBtn').attr('value')=='MODIFIER'){
      $(".detail").addClass("d-none");
      $(".modif").removeClass("d-none");
      $('#submitBtn').attr('value','VALIDER');
    
    }else{
      $('#submitBtn').attr('type','submit');
      
    }

  }
  function modifGroupeEquipment(){
    
if($('#submitBtnGroupe').attr('value')=='MODIFIER'){
      $(".detailGroupe").addClass("d-none");
      $(".modifGroupe").removeClass("d-none");
      $('#submitBtnGroupe').attr('value','VALIDER');
    
    }else{
      $('#submitBtnGroupe').attr('type','submit');
      
    }

  }


  
   function defineId(id) {
      $('#confirmSup').attr('href','<?= $_SESSION['url'] ?>gestionEquipements/supprimer/'+id);
     
    }
    function defineIdGroupe(id) {
      $('#confirmSupgroupe').attr('href','<?= $_SESSION['url'] ?>gestionEquipements/supprimergroupe/'+id);
     
    }


</script>

<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>


<?php
function affichegroupe($groupe){

$sousGroupe = SousGroupeEq($groupe['idGroupeEquipement']);
 if ($Groupe= $sousGroupe->fetch()){ ?>
  <?php $equipement = listeEquipement($groupe['idGroupeEquipement']); ?>
    <div class="card m-0 firstCard" style="border:#333 solid 1px;border-radius: 5px">
      <div class="card-header textTab" style="background-color:#333;color:white;padding-right: 0px">
        <a href="#" data-toggle="modal" data-target="#Dtailgroupe" class="text-white" onclick="descriptionGroupeEquipe(<?= $groupe['idGroupeEquipement'] ?>)"><?= $groupe['nomGroupeEquip'] ?></a>
        <div class="float-right" style="width: 10%;text-align: left;color: white">
          <a href="" onclick="defineIdGroupe(<?= $groupe['idGroupeEquipement'] ?>)"  data-toggle="modal" data-target="#supprimeGroupe"> <i class="fas fa-minus-circle"  style="color:rgb(119, 4, 4);" ></i></a>
        </div>
      </div>

      <div class="card-body p-0">      
  <?php while ($equipe= $equipement->fetch()){ ?> 
    <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
      <tr>
        <td style="width: 20%"><a href="#" data-toggle="modal" data-target="#DtailEquipement"  class="textTab"  onclick="descriptionEquipement(<?= $equipe['id_equipement']?>)"><?= $equipe['nomEquipement'] ?></a></td>
        <td style="width: 20%"><?= $equipe['descriptionEquipement'] ?></td>   
        <td style=" text-align: center;width: 10%">

           <a href="" onclick="defineId(<?= $equipe['id_equipement'] ?>)"  data-toggle="modal" data-target="#supprime"> <i class="fas fa-minus-circle"  style="color:rgb(119, 4, 4);" ></i></a>
        </td>
      </tr>
    </table>
    
  <?php } ?> 
  <?php while($Groupe){ 
          affichegroupe($Groupe);
          $Groupe= $sousGroupe->fetch();
        } ?>
    </div>
  </div>

 <?php }else{ $equipement = listeEquipement($groupe['idGroupeEquipement']); ?>
      
    <div class="card m-0 firstCard" style="border:#333 solid 1px;border-radius: 5px">
      <div class="card-header textTab" style="background-color:#333;color:white;padding-right: 0px">
        <a href="#" data-toggle="modal" data-target="#Dtailgroupe" class="text-white" onclick="descriptionGroupeEquipe(<?= $groupe['idGroupeEquipement'] ?>)"><?= $groupe['nomGroupeEquip'] ?></a>
        <div class="float-right" style="width: 10%;text-align: left;color: white">
          <a href="" onclick="defineIdGroupe(<?= $groupe['idGroupeEquipement'] ?>)"  data-toggle="modal" data-target="#supprimeGroupe"> <i class="fas fa-minus-circle"  style="color:rgb(119, 4, 4);" ></i></a>
        </div>
      </div>

      <div class="card-body p-0">      
    <?php while ($equipe= $equipement->fetch()){ ?> 
      <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
        <tr>
          <td style="width: 20%"><a href="#" data-toggle="modal" data-target="#DtailEquipement"  class="textTab"  onclick="descriptionEquipement(<?= $equipe['id_equipement']?>)"><?= $equipe['nomEquipement'] ?></a></td>
          <td style="width: 20%"><?= $equipe['descriptionEquipement'] ?></td>   
          <td style=" text-align: center;width: 10%">

             <a href="" onclick="defineId(<?= $equipe['id_equipement'] ?>)"  data-toggle="modal" data-target="#supprime"> <i class="fas fa-minus-circle"  style="color:rgb(119, 4, 4);" ></i></a>
          </td>
        </tr>
      </table>
    <?php } ?> 
    </div>
  </div>

<?php 
    }
  } 
