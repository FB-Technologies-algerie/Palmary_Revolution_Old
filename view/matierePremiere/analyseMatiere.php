<?php $title="modification du produit" ?>

<?php ob_start(); ?> 

<div >

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
                            <div class="col-4" >Date de prélévement</div>
                            <div  class="col-8 detailEchantillon"><strong id="nomEquipement"><?= $AnalyseMatiere['datePrelevement'] ?></strong></div>
                            <div class="col-8">
                              <input type="date" id="datePicker2"  name="datePrelevement" class="form-control modifEchantillon d-none " placeholder="" value="<?=$AnalyseMatiere['datePrelevement'] ?>">
                            </div>
                    </div>
             
            </div>
           
        </form>
        </div>


    <div class="card">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
         <span class="cardTitle" >PARAMÈTRES D'ANALYSE</span>  
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

                </tr>
                 <?php while ($liste= $resultatAnalyseMatieres->fetch()){ ?>
              <tr>
              <td> <a ><?= $liste['nomParamAnal'] ?></a></td>
              <td>  <?= $liste['uniteParam'] ?> </td>
              <td>  <?= $liste['resultParam'] ?> </td>
              <td>  <?= $liste['normeParam'] ?> </td>
               </tr>
             
       <?php ; } ?>
              </thead>
            </table>

            </div>
          </div> 
       </div>


         <?php if (is_null( $AnalyseMatiere['dateFin'])) {  ?>
         <div class="card">
            <div class="card-body">
                 <div id="LDP_modif" class="row"> 
                            <div class="col-4" >Etat analyse</div>
                            <div  class="col-8 "><strong id="nomEquipement"><?= $AnalyseMatiere['etatAnalyse'] ?></strong></div>
                </div>
                   
                  
         </div>
        </div>
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
           <br>
           <br>
          <div></div>
          
   </div>
   

<script>

</script>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>


