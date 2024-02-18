<?php $title='gestion arrivage' ?>

<?php ob_start(); ?> 
<div id="bodylignesP" >
 <?php require('view/navbar.php') ?>

 <div class="card">
  <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
    <span class="cardTitle mt-2">Gestion d'arrivage</span>
     <form method="post" >
       <a href="" data-toggle="modal" data-target="#ajout" name="ajouterArrivageAffiche" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> NOUNEAU ARRIVAGE</a>
      </form>
   
  </div>  
  <div class="card-body">
    <div class="table-responsive">
      <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
        <thead class="w-100">
          <tr>
            <th style="width:10%;">Date arrivage</th>
            <th style="width:12%;">Matiere</th>
            <th style="width:16%;">Fournisseur</th>
            <th style="width:9%;">Quantite</th>
            <th style="width:9%;">num Lot</th>
            <th style="width:11%;">Date fabrication</th> 
            <th style="width:12%;">Date peremption</th> 
            <th style="width:30%;text-align:center;">Paramètre</th> 
          </tr>
        </thead>
        <tbody>
          <?php while ($arrivage = $listeArrivage->fetch()){ ?>
            <tr>
              <td><?= $arrivage['dateArrivage'] ?></td>
              <td><b><a href="#" data-toggle="modal" data-target="#groupeParent" class="text-align" style="text-decoration-color: black;color: #212529;" onclick="videGroupe();groupeParent(<?= $arrivage['idGroupeMatiere'] ?>)"><?= $arrivage['nomGroupeMat'] ?></a></b></td>                           
              <td><?= $arrivage['nomMatiere'] ?> ➤<?= $arrivage['fournisseurMatiere'] ?></td>
              <td><?= $arrivage['quantite'] ?></td>  
              <td><?= $arrivage['numLot'] ?></td>
              <td><?= $arrivage['dateFabrication'] ?></td>
              <td><?= $arrivage['datePeremption'] ?></td>
              <td class="text-center" >
               <a href="<?= $_SESSION['url'] ?>detailArrivage/<?=$arrivage['id_arrivage']?>"><i class="fas fa-pen" style="color: blue; font-size: 20px;cursor: pointer;"></i></a>
               <i onclick="defineId(<?= $arrivage['id_arrivage']?>)" class="fas fa-minus-circle" style="color: red; font-size: 25px;cursor: pointer;padding-left:25px;"data-toggle="modal" data-target="#supprim" ></i>
              </td>
            </tr>
        <?php } ?>
      </tbody>                             
    </table>
  </div>
</div>
</div>
</div>


<div class="modal fade" id="groupeParent" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="max-width: 700px !important">
    <div class="modal-content">
                <!--div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" onclick="videGroupe()">&times;</span>
                  </button>
                </div-->

                <div class="modal-body" id="afficheDonne"  >    

                 <form method="post" id="formGroupe" action="">
                  <div id="LDP_modif" class="row" >     
                   <div  class="col-12 text-center"  id="divGroupeParent"> </div>      
                 </div>
                 <br>

                    <!--div class="modal-footer d-block text-center">       

                     <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="videGroupe()">ANNULER</button>
                   </div-->
                 </form>
               </div>
             </div>
           </div>
         </div>

         <!-- Modal Ajouter ARRIVAGE -->


        



    <div
    class="modal fade"
    id="supprim"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
    >
    <div class="modal-dialog" role="document">
     <form  method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Supprimer</h5>
          <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
          >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span>Vous voulez vraiment supprimer ?</span>
      </div>
      <div class="modal-footer mx-auto">
        <span id="supprimerArrivage"   class="btn btn-primary">SUPPRIMER</span> 
        <button
        type="button"
        class="btn btn-secondary"
        data-dismiss="modal"
        >
        Annuler
      </button>
    </div>
  </div>
</form>
</div>
</div> 


        
    <div class="modal fade" id="ajout" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN NOUVEAU ARRIVAGE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" id="FourmAjouterArrivage"  action="<?= $_SESSION['url'] ?>/gestionArchivage">
                 <div class="row">
                  <div class="col-md">

                     
                    <div class="form-group row">
                      <label  class="col-sm-2 col-form-label">Matière</label>
                      <div class="col-sm-10">
                        <select onchange ="listMatiere(this.value)" name="GroupeEqu" class="selectNormeForm custom-select custom-select-lg ">
                         <option selected value="null" >Selectionner une matière</option>
                         <?php while ($groupe= $listeGroupeMatiere->fetch()){ ?>
                           <option value="<?= $groupe['idGroupeMatiere'] ?>" ><?= afficheGroupe($groupe['idGroupeMatiere'],null) ?> <script > console.log("<?= afficheGroupe($groupe['idGroupeMatiere'],null) ?>")</script></option>
                         <?php } ?>
                         <option value="-1" >Autre</option>
                       </select>
                     </div>
                   </div>
                                        

                   <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Fournisseur matière</label>
                    <div class="col-sm-10">
                      <select required  name="groupeMatiere" id="groupeMatiere" class="selectNormeForm custom-select custom-select-lg ">

                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Quantité</label>
                    <div class="col-sm-10">
                      <input id="quantite" required type="text" name="quantite" class="input form-control ml-2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">N° lot</label>
                    <div class="col-sm-10">
                      <input id="lot" required type="text" name="lot" class="input form-control ml-2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Date d'arrivage</label>
                    <div class="col-sm-10">
                      <input id="dateArrivage" required type="Date" name="dateArrivage" class="input form-control ml-2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Date Fabrication</label>
                    <div class="col-sm-10">
                      <input id="dateFabrication" required type="Date" name="dateFabrication" class="input form-control ml-2" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label"> Date Péremption</label>
                    <div class="col-sm-10">
                      <input id="datePeremption" required type="date" name="datePeremption" class="input form-control ml-2" value="">
                    </div>
                  </div>

                </div>
              </div>
              <div class="modal-footer d-block text-center">
                <input type="submit"  name="ajouterArrivage" class="btn btn-primary w-auto" value="VALIDER">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>  
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>



</div>
<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
 document.getElementById('dateArrivage').valueAsDate = new Date();
 

 function groupeParent(id) { 
  $.get("<?= $_SESSION['url'] ?>groupeParent/"+id, function(data, status){
   var obj =JSON.parse(data);
   console.log(obj);
   var mySelect = $('#divGroupeParent');
   if (obj.id_groupeParent != null && obj.id_groupeParent != id) {
      $('#divGroupeParent').append('<strong>' +'&nbsp; &nbsp;<i class="fas fa-arrow-alt-circle-right"></i>&nbsp;' +obj.nomGroupeMat+'</strong>');
      groupeParent(obj.id_groupeParent);
     
   }else{ 
    $('#divGroupeParent').append('<strong>' +'&nbsp; &nbsp;<i class="fas fa-arrow-alt-circle-right"></i>&nbsp; ' +obj.nomGroupeMat+'</strong>');
    
  }
});
}
function videGroupe(){
 var mySelect = $('#divGroupeParent');
 mySelect.find('strong').remove();
}





function listMatiere(id_groupe_mat) {  
  $.get("<?= $_SESSION['url'] ?>listMatiere/"+id_groupe_mat, function(data, status){
    var obj =JSON.parse(data);
    console.log(data);
    var mySelect = $('#groupeMatiere');
    mySelect.find('option').remove();
    $.each(obj, function(i, obj) {
      mySelect.append('<option value="'+obj.id_matiere+'">'+obj.nomMatiere+' ⟾ '+obj.fournisseurMatiere+'</option>');
    });     

  });
}

function defineId(id) {
  $('#supprimerArrivage').attr('onclick','supprimerArrivageMatiere('+id+')');
}

function supprimerArrivageMatiere(id){ 
  $.get("<?= $_SESSION['url'] ?>supprimerArrivageMatiere/"+id, function(data, status){
    window.location.reload(true);
  });
}


</script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>