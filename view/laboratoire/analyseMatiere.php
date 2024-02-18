<?php $title="modification du produit" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>

    <h1 class="display-block mt-3 display-5 text-white" style="text-align: center;"><?= $AnalyseMatiere['nomMatiere'] ?></h1>
         
    <div class="card">
      <form method="post"  action="" style="clear: both;">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">Nature de l'échantillon: <?= $AnalyseMatiere['nomMatiere'] ?></span></div>
        <div class="card-body">
                
                 <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Fournisseur</div>
                            <div  class="col-8 "><strong id="nomEquipement"><?= $AnalyseMatiere['fournisseurMatiere'] ?></strong></div>
                    </div>
                    <br>
                     <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Lot N°</div>
                            <div  class="col-8 "><strong id="nomEquipement"><?= $AnalyseMatiere['numLot'] ?></strong></div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Date de fabrication</div>
                            <div  class="col-8 "><strong id="nomEquipement"><?= $AnalyseMatiere['dateFabrication'] ?></strong></div>
                        
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Date de péremption</div>
                            <div class="col-8 "><strong id="nomEquipement"><?= $AnalyseMatiere['datePeremption'] ?></strong></div>
                          
                    </div>
                     <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Date de prélèvement</div>
                            <div  class="col-8 detailEchantillon"><strong id="nomEquipement"><?= $AnalyseMatiere['datePrelevement'] ?></strong></div>
                            <div class="col-8">
                              <input type="date" id="datePicker2"  name="datePrelevement" class="form-control modifEchantillon d-none " placeholder="" value="<?=$AnalyseMatiere['datePrelevement'] ?>">
                            </div>
                    </div>
             
            </div>
           <div class="modal-footer d-block text-center">       
            <input id="submitBtnEchantillon" type="button" onclick="modifEchantillon()" class="btn btn-primary" name="modifer" style="width:auto !important;margin-left: auto;" value="MODIFIER">
         </div>
        </form>
        </div>


    <div class="card">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
         <span class="cardTitle" >PARAMÈTRES D'ANALYSE</span> 
          <a href="#" data-toggle="modal"  data-target="#ajoutParam" class="btn btn-primary float-right mt-2 ml-3 btnAlign"><i class="fas fa-plus-circle"></i> PARAMÈTRE</a>
          
      </div>
      <div class="card-body pt-1">
        <div class="table-responsive">
            <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0" >
              <thead class="w-100">
                <tr>

                  <th style="width: 20%">Paramètre recherché</th>
                  <th style="width: 10%">Unité</th>
                  <th style="width: 10%">Résultat</th>
                  <th style="width:20%;text-align:center;">Norme</th>
                  <th style="width:10%;text-align:center;">Supprimer</th>

                </tr>
                 <?php while ($liste= $resultatAnalyseMatieres->fetch()){ ?>
              <tr>
              

              <td> <a href="#" data-toggle="modal"  data-target="#modifParam" class="textTab" onclick = "modifierAnalyse(<?= $liste['id_analyseMat'] ?>,<?= $liste['id_paramMat'] ?>,`<?= $liste['nomParamAnal'] ?>`)" ><?= $liste['nomParamAnal'] ?></a></td>
              <td>  <?= $liste['uniteParam'] ?> </td>
              <td>  <?= $liste['resultParam'] ?> </td>
              <td>  <?= $liste['normeParam'] ?> </td>

              <td class="d-flex justify-content-around">
                  <i  class="fas fa-minus-circle" style="color: red; font-size: 25px;cursor: pointer;"data-toggle="modal" data-target="#supprime" onclick="supprimerResultAnalyse(<?= $liste['id_analyseMat'] ?>,<?= $liste['id_paramMat'] ?>)"></i>  
              </td>
               </tr>
             
       <?php ; } ?>
              </thead>
            </table>

            </div>
          </div> 
       </div>

          <!--        add function  nabil -->
         <?php if (is_null( $AnalyseMatiere['dateFin'])) {  ?>
         <button class="btn btn-primary d-block mx-auto m-4 p-3"  data-toggle="modal"  data-target="#ConclusionAnalyse">
          TERMINER L'ANALYSE
          </button>
          <?php ; }else{ ?>
             <div class="card">
          <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
           <strong>CONCLUSION</strong>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-4">
                Date de fin
              </div>
              <div class="col-8">
               <?= $AnalyseMatiere['dateFin'] ?>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-4">
                Etat analyse
              </div>
              <div class="col-8">
                <?= $AnalyseMatiere['etatAnalyse'] ?>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-4">
                Conclusion
              </div>
              <div class="col-8">
                <?= $AnalyseMatiere['conclusionAnalyse'] ?>
              </div>
            </div>
          </div>
        </div>
          <?php ; } ?>
           <!--        add function  nabil -->
   </div>



    


 <div class="modal fade" id="ConclusionAnalyse" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 700px;">
               <div class="modal-content">
                 <form method="post"  action="" style="clear: both;">
                 <div class="modal-header">
                  <h5 class="modal-title" id="titleGroup">Conclusion</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
               <div class="row">
                <div class="col-md">
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Date Fin</label>
                  <div class="col-sm-8" style="align-self: center;"> 
                  <input type="date" id="dateFin" name="dateFin" class="form-control" placeholder="">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Conclusion D'analyse</label>
                  <div class="col-sm-8" style="align-self: center;">
                  <textarea id="conclusionAnalyse" name="conclusionAnalyse" class="form-control detailMatiere"></textarea>
                  </div>
                  </div>

                  <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Etat analyse</label>
                  <div class="col-sm-8" style="align-self: center;"> 
                  <select required name="etatAnalyse" class="selectNormeForm custom-select custom-select-lg ">
                            <option selected value="" >Selectionner l'etat</option>
                            <option  value="Refuser" >Refuser</option>
                            <option  value="Valider" >Valider</option>
                 </select>
                  </div>
                </div>
                </div>
              </div>
            </div>
               <div class="modal-footer mx-auto">
                <input  id="submitBtnConclusion" name="termineAnalyse" type="submit"  class="btn btn-primary"  style="width:auto !important;margin-left: auto;" value="Confirmer">

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>  
               </div>
            </form>
            </div>
           </div>
          </div>   


   
    <!--Modal SUPPRIMER NORME-->
    <div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 700px;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="titleGroup">Suppression d'une norme</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p id="textGroup" style="font-size:20px;">Vous voulez vraiement supprimer ce paramètre ?</p>
                </div>
                <div class="modal-footer mx-auto">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirmSupResult" >Confirmer</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>  
                </div>
              </div>
            </div>
          </div>   
           <!--Modal modif param -->
    <div class="modal fade" id="modifParam" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm" style="width: 800px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">PARAMÉTRE MATIÉRE</h5>
            <button type="button" class="close   Modal" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    <div class="modal-body" >
           <iframe id= "frameResultat" src="" height="400" frameborder="0" class="w-100" ></iframe>

       </div>
        </div>
      </div>
    </div>

    <!--Modal ajout param -->
    <div class="modal fade" id="ajoutParam" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm" style="width: 537px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">NOUVEAU  PARAMÉTRE D'ANALYSE</h5>
            <button type="button" class="close   Modal" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body">
           <div >

                   <form method="post" id="formAnalayse" action="" style="clear: both;">
                      
                    <div id="LDP_modif" class="row">  
                              <select required id="parametreAnalyse" name="parametreAnalyse" class="selectNormeForm custom-select custom-select-lg">
                                <option value="" >Selectionner un paramètre</option>
                               <?php while($param=$listeParamMatiere->fetch()) { ?>
                                <option unit="<?= $param['uniteParam'] ?>" value="<?= $param['id_paramMat'] ?>" ><?= $param['nomParamAnal'] ?></option>
                               <?php } ?>
                              </select>
                    </div>
                    <div class="modal-footer d-block text-center">       
                     <input name="ajoutParamAnalyse" type="submit" style="width:auto !important;margin-left: auto;" value="VALIDER">
                    </div>
                  </form>
          </div>

        </div>
        </div>
      </div>
    </div>

    </div>

<script>


 

    document.getElementById('dateFin').valueAsDate = new Date();
    document.getElementById('datePicker3').valueAsDate = new Date();

   function modifEchantillon(){
  if($('#submitBtnEchantillon').attr('value')=='MODIFIER'){
      $(".detailEchantillon").addClass("d-none");
      $(".modifEchantillon").removeClass("d-none");
      $('#submitBtnEchantillon').attr('value','VALIDER');
      $('#submitBtnEchantillon').attr('name','modifierAnalyseMatiere');
    }else{
      $('#submitBtnEchantillon').attr('name','modifierAnalyseMatiere');
      $('#submitBtnEchantillon').attr('type','submit');
    }
  }
  
  document.getElementById('dateAnal').valueAsDate = new Date();

  function modifierAnalyse(id_analyseMat,id_paramMat,nomParamAnal){ 
       $('#exampleModalLabel').text("PARAMÉTRE D'ANALYSE: "+nomParamAnal);
       $('#frameResultat').attr('src',"<?= $_SESSION['url'] ?>analyseMatiere/"+id_analyseMat+"/"+id_paramMat); 
  }
 
 


/*         add function  nabil */

 function supprimerResultAnalyse(id_paramMat,id_analyseMat){ 
      $('#confirmSupResult').attr('onclick','confirmsupprimerResultAnalyse('+id_paramMat+','+id_analyseMat+')');
  }

  function confirmsupprimerResultAnalyse(id_paramMat,id_analyseMat){ 
      $.get("<?= $_SESSION['url'] ?>supprimerResultAnalyse/"+id_analyseMat+"/"+id_paramMat, function(data, status){
        window.location.reload(true);
      });
  }

/*         add function  nabil */

 
</script>


<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>


