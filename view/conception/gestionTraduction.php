<?php $title='gestion des produits' ?>

<?php ob_start(); ?>

<div id="bodylignesP">
  <?php require('view/navbar.php') ?>
    
    <div class="card">
        <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
           <span class="cardTitle" >GESTION DES TRADUCTIONS</span>         
            <a  href="#" data-toggle="modal" data-target="#ajoutProd" onclick="clearAll()" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> INGRÉDIENT</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                    <thead class="w-100">
                        <tr>
                          <th >Français</th>
                          <th >Arabe</th>
                          <th >Anglais</th>
                          <th >Espagnol</th>
                          <th >Portugais</th>
                          <th >Supprimer</th>
                     </th> 
                        </tr>
                    </thead>
                    <tbody>
                <?php while ($traduction=$listTraduction->fetch()) { ?>
                    <tr>
                      <td> <a href="#" id="<?= $traduction['id_traduction'] ?>" class="ldp_table" onclick="modifTranslat(this)"><?= $traduction['frTraduction'] ?></a></td>
                      <td style="direction: rtl;" class="text-right"><?= $traduction['arTraduction'] ?></td>
                      <td><?= $traduction['enTraduction'] ?></td>
                      <td><?= $traduction['esTraduction'] ?></td>
                      <td><?= $traduction['ptTraduction'] ?></td>
                      <td class="text-center">
                      <a><i class="fas fa-minus-circle" data-toggle="modal" data-target="#supprime" onclick="supprime(<?= $traduction['id_traduction'] ?>)"></i></a>
                    </tr>
                <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   
    <!--Modal SUPPRIMER-->
  <div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SUPPRESSION D'UN INGRÉDIENT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p style="font-size:20px;">Vous voulez vraiement supprimer cet ingrédient ?</p>
              </div>
              <div class="modal-footer mx-auto">
                <input type="submit" name="" id="confirmSup" onclick="" class="btn btn-primary" value="Oui">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>  
              </div>
            </div>
        </div>
    </div>
</div>

       <!--Modal Ajout/modif PROD-->
        <div class="modal fade" id="ajoutProd" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
         <form method="post" action="" >
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">INGRÉDIENT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <div class="table-responsive">
             <table id="table" class="table table-striped table-hover table-bordered table-sm" >
              <thead class="w-100">
                <tr>
                  <th>Français</th>
                  <th>Arabe</th>
                  <th>Anglais</th>
                  <th>Espagnol</th>
                  <th>Portugais</th>
                </tr>
              </thead>
              <tbody>
                     <tr>
                      <input type="hidden" name="id_traduction" id="hiddenInput" value="">
                      <td ><textarea name="french" id="french" class="w-100"></textarea></td>
                      <td ><textarea style="direction: rtl;" class="w-100 text-right" name="arabic" id="arabic"></textarea></td>
                      <td ><textarea name="english" id="english" class="w-100"></textarea></td>
                      <td ><textarea name="spanish" id="spanish" class="w-100"></textarea></td>
                      <td ><textarea name="portuguese" id="portuguese" class="w-100"></textarea></td>
                     </tr>

              </tbody>  
             </table>
           </div>
          </div>
          <div class="modal-footer d-block text-center mx-auto">
            <input type="submit" name="valider" class="btn btn-primary w-auto" value="VALIDER" >
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>  
          </div>
         </form>
        </div>
      </div>
    </div>


    <script type="text/javascript">
      function supprimeTraduction(id_traduction) {
        var xhttp;
          xhttp = new XMLHttpRequest();
            
          xhttp.open("GET", "<?= $_SESSION['url'] ?>gestionTraduction/supprimer/"+id_traduction, true);
          xhttp.send(); 
        refresh();
      }

      function modifTranslat(val){
      $('#ajoutProd').modal('show');
      var translat = val.parentElement.parentElement.getElementsByTagName('td');
      document.getElementById('french').value = translat[0].textContent;
      document.getElementById('arabic').value = translat[1].textContent;
      document.getElementById('english').value = translat[2].textContent;
      document.getElementById('spanish').value = translat[3].textContent;
      document.getElementById('portuguese').value = translat[4].textContent;
      document.getElementById('hiddenInput').value = val.id;
      }

      function clearAll(){
      document.getElementById('french').value = "";
      document.getElementById('english').value = "";
      document.getElementById('arabic').value = "";
      document.getElementById('spanish').value = "";
      document.getElementById('portuguese').value = "";
      document.getElementById('hiddenInput').value = "";
      }

      function supprime(val){
        document.getElementById('confirmSup').setAttribute("onclick","supprimeTraduction("+val+")");
      }

      function refresh() {
    	setTimeout(function () {
    	  window.location.reload()
    	}, 500);
  	  }

    </script>
<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>