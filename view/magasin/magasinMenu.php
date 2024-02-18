<?php $title='gestion arrivage' ?>

<?php ob_start(); ?> 
<div id="bodylignesP" >
 <?php require('view/navbar.php') ?>
    
    <div class="card">
        <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
          <span class="cardTitle mt-2">Gestion d'arrivage</span>
            <a href="" data-toggle="modal" data-target="#ajout" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> NOUNEAU ARRIVAGE</a>
        </div>  
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                    <thead class="w-100">
                        <tr>
                          <th style="width:2%;">Etat</th>
                          <th style="width:20%;">Date arrivage</th>
                          <th style="width:13%;">Groupe produit</th>
                          <th style="width:22%;">Nom produit</th>
                          <th style="width:20%;">Fournisseur</th>
                          <th style="width:10%;">Quantite</th>
                          <th style="width:20%;">num Lot</th>                      
                        </tr>
                    </thead>
                    <tbody>
                      <?php while ($arrivage = $listArrivage->fetch()){ ?>
                        <tr>
                        <?php if ($arrivage['etatMaquette']==0){ ?>    
                            <td title="en attente" style="color:orange;text-align: center;">
                              <i class="fas fa-hourglass-end"></i>
                            </td>
                        <?php }
                           elseif ($arrivage['etatMaquette']>0 && $arrivage['etatMaquette']<255){ ?>    
                            <td title="en validation" style="color:#0070ff;text-align: center;">
                              <i class="fas fa-tasks"></i>
                            </td>
                        <?php }
                           elseif ($arrivage['etatMaquette']<0){ ?>    
                            <td title="refuser" style="color:red;text-align: center;">
                              <i class="fas fa-times-circle"></i>
                            </td>
                        <?php }
                           elseif ($arrivage['etatMaquette']==255){ ?>    
                            <td title="valider" style="color:green;text-align: center;">
                              <i class="fas fa-check-circle"></i>
                            </td>
                        <?php }
                           else{ ?>    
                            <td> -- </td>
                        <?php } ?>

                        <td><a href="<?= $_SESSION['url'] ?>magasin/detailArrivage/<?=$arrivage['id_arrivage']?>"   class="textTab" ><?= $arrivage['dateArrivage'] ?></a></td>
                          <td><?= $arrivage['nomGroupeProd'] ?></td>
                          <td><?= $arrivage['nomProd'] ?></td>
                          <td><?= $arrivage['nomFournisseur'] ?></td>
                          <td><?= $arrivage['quantite'] ?></td>  
                          <td><?= $arrivage['numLot'] ?></td>
                       
                       </tr>
                      <?php } ?>
                    </tbody>                             
                </table>
            </div>
        </div>
    </div>
</div>
   
   

           <!-- Modal Ajouter ARRIVAGE -->
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
                  <form method="post" enctype="multipart/form-data" action="<?= $_SESSION['url'] ?>magasin/gestionArrivage/ajouter">
                   <div class="row">
                    <div class="col-md">

                      <div class="input-group mb-3">
                       <label for="text" class="ldpLabel justify-content-middle text-left" style="width: 200px">Code à barre</label>
                   <input type="text" name="codeBarProd" id="codeBarValue" class="input form-control ml-2" autofocus>
                   <div class="input-group-append">
                   <span class="input-group-text btn btn-primary p-0 pr-3 pl-3" id="basic-addon2" onclick="getProduit()" style="background-color: #007bff;
    color: white;">Valider</span>
                       </div>
                  </div> 


                    
                     <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100 ml-1"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" style="width: 200px">Fournisseur</label>
                            <select required name="fournisseur" class="selectNormeForm custom-select custom-select-lg ">
                              <option value="">Selectionner le fournisseur</option>
                            
                               <?php while ($nomFournisseur = $listEmbFournisseur->fetch()){ ?>
                              <option value=<?= $nomFournisseur['id_fournisseur'] ?>><?= $nomFournisseur['nomFournisseur'] ?></option>
                              <?php } ?>
                            </select>
                     </div>
                     <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" style="width: 200px">Quantité</label>
                            <input id="qte" required type="text" name="quantite" class="input form-control ml-2" value="">
                     </div>
                     <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" style="width: 200px">numéro de lot</label>
                            <input required type="number" name="numLot" class="input form-control ml-2" value="">
                     </div>
                     <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100 ml-1"> 
                          <label for="imgEmballage" class="ldpLabel justify-content-middle text-left" style="width: 200px">image emballage</label>
                          <div class="custom-file" id="imgEmballage">
                            <input type="file" accept="image/*" class="custom-file-input" name="imgEmballage" onchange="validateFileType()">
                            <label class="custom-file-label" for="imgEmballage">inserer une image</label>
                          </div>
                     </div>
                    </div>
                 <div class="col-md" id="detailProd" style="opacity: 0;">
                    <div style="text-align: center;font-weight: bold;font-size: 25px;">
                      <span id="nomProduit">Nom produit</span>
                    </div>
                    <div style="width:100%;height:300px;text-align:center;">
                      <img style="max-height:100%;max-width:100%;" src="" id="imgProduit">
                    </div>
                 </div>
               </div>
                    <div class="modal-footer d-block text-center">
                      <input type="submit" disabled id="btnValid" name="valider" class="btn btn-primary w-auto" value="VALIDER">
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
  function validateFileType(){
        var fileName = $('#imgEmballage input').val();
        $('#imgEmballage label').html(fileName);
        var extFile = fileName.substr(fileName.lastIndexOf(".") + 1, fileName.length).toLowerCase();

        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
            alert("ce fichier n'est pas valide");;
            $('#imgEmballage label').html("ce fichier n'est pas valide");
        }   
    }


    //detect enter keyboard
    $(document).on('keypress',function(e) {
      if(e.which == 13) {
        getProduit();
      }
    });


    $(document).ready(function(){
      $("#ajout").on('shown.bs.modal', function(){
        $('#codeBarValue').focus();
      });

      $('#codeBarValue').keyup(function () { 
        $('#detailProd').css('opacity','0');
        $('#btnValid').attr('disabled','disabled'); 
      });
    });

    function getProduit() {
    var codebar=  $('#codeBarValue').val();
            var xhttp;
            xhttp = new XMLHttpRequest();
            
            xhttp.open("POST", "<?= $_SESSION['url'] ?>magasin/detailProd/", false);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('codeBarre='+codebar);
            var reponse= JSON.parse(xhttp.response);

          if(reponse){
            $('#nomProduit').text(reponse['nomProd'])
            $('#imgProduit').attr("src", reponse['miniatureProd']);
            $('#detailProd').css('opacity','1');
            $('#btnValid').removeAttr('disabled');
          }
          else{
            $('#detailProd').css('opacity','0');
            $('#btnValid').attr('disabled','disabled');
          }
  }

</script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>