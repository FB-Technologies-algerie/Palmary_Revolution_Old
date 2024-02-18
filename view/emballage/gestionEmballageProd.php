<?php $title='gestion des produits' ?>

<?php ob_start(); ?>

<div id="bodylignesP">
  <?php require('view/navbar.php') ?>
    
    <div class="card">
        <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
           <span class="cardTitle" >GESTION DES EMBALLAGES DES PRODUITS</span>         
            <a  href="#" data-toggle="modal" data-target="#ajoutProd" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> PRODUIT</a>
            <a  href="#" data-toggle="modal" data-target="#ajoutGroupe" class="btn btn-primary float-right btnAlign mr-3" onclick="ajouterGroupe()" ><i class="fas fa-plus-circle"></i> GROUPE</a>
        </div>
            <div class="card-body" >
        <div class="table-responsive">
          <table
            id="id_ligne"
            class="table  table-striped table-hover table-bordered table-sm"
            cellspacing="0"
            width="100%"
          >
            <thead>
               <th>Produit</th>
                <th>Code article</th>
                <th>Code à barre</th>
                          <th style="text-align:center;">Supprimer</th>
            </thead>
          </table>
          <div id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
              <?php while ($groupe = $listeGroupeProduit->fetch()){ 
                  afficheGroupe($groupe);
               }
              ?>
            <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
              <?php
                while ($produit= $listeProduit->fetch()){ 
                  afficheProduit($produit);
               }
              ?>
            </table>
          </div>

        </div>
      </div>

    </div>

   
    <!--Modal SUPPRIMER-->
  <div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SUPPRESSION D'UN PRODUIT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p style="font-size:20px;">Vous voulez vraiement supprimer ce produit, avec tous ces versions, maquettes et arrivages ?</p>
              </div>
              <div class="modal-footer mx-auto">
                <button type="button" id="confirmSup" class="btn btn-primary">Oui</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>  
              </div>
            </div>
        </div>
    </div>
</div>

   
<div class="modal fade" id="supprimeGroupe" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SUPPRESSION DE GROUPE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p style="font-size:20px;">Vous voulez vraiement supprimer ce groupe ?</p>
              </div>
              <div class="modal-footer mx-auto">
                <button type="button" id="confirmSupGroupe" class="btn btn-primary">Oui</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>  
              </div>
            </div>
        </div>
    </div>




       <!--Modal Ajout/modif PROD-->
    <div class="modal fade" id="ajoutProd" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" style="width: 600px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN NOUVEAU EMBALLAGE PRODUIT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="">
                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom du Produit</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="nomProd" class="form-control"  placeholder="">
                                    </div>
                            </div>
                    <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Code article</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="codeArticle" class="form-control" placeholder="">
                                    </div>
                    </div>
                    <div class="form-group row">
                      <label  class="col-sm-3 col-form-label">Code à barre</label>
                      <div class="col-sm-9">
                        <input type="text" name="codeBarre" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label  class="col-sm-3 col-form-label">Groupe parent</label>
                      <div class="col-sm-9">
                        <select id="idGroupe" name="idGroupe" class="custom-select custom-select-lg">
                            <option value="null" >Aucun groupe</option>
                          <?php foreach ($listeToutGroupe as $groupe) { ?>
                            <option value="<?= $groupe->id_groupeProd ?>" ><?= $groupe->nomGroupeProd ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="modal-footer d-block mx-auto text-center">
                      <input type="submit" class="btn btn-primary w-auto" name="valider"  value="VALIDER">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
            </form>
          </div>
          <div class="modal-footer mx-auto"> 
          </div>
        </div>
      </div>
    </div>

    <!--Modal Ajout/modif groupe-->
    <div class="modal fade" id="ajoutGroupe" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" style="width: 600px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titre" >AJOUTER UN NOUVEAU GROUPE D'EMBALLAGE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="" id="formGroupe">
                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom du groupe</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="nomGroupeProd" id="nomGroupeProd" class="form-control"  placeholder="">
                                    </div>
                            </div>
                    
                    <div class="form-group row">
                      <label  class="col-sm-3 col-form-label">Groupe parent</label>
                      <div class="col-sm-9">
                        <select id= "id_groupeProd" name="id_groupeProd" class="custom-select custom-select-lg">
                            <option value="null" >Aucun groupe</option>
                          <?php foreach ($listeToutGroupe as $groupe) { ?>
                            <option value="<?= $groupe->id_groupeProd ?>" ><?= $groupe->nomGroupeProd ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="modal-footer d-block mx-auto text-center">
                    <input type="submit" class="btn btn-primary w-auto" name="validerGroupe" id="submitGroupe"  value="VALIDER">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
            </form>
          </div>
          <div class="modal-footer mx-auto"> 
          </div>
        </div>
      </div>
    </div>
<?php $content= ob_get_clean(); ?>
<?php ob_start(); ?>
    <script type="text/javascript">
      function supprimeEmballageProd(id_emballageProd) {
        $.get("<?= $_SESSION['url'] ?>gestionEmballage/supprimer/"+id_emballageProd);
        
        refresh();
      }
      function getID(id) {
        document.getElementById('confirmSup').setAttribute("onclick","supprimeEmballageProd("+id+")");
      }

      function refresh() {
        setTimeout(function () {
          window.location.href= window.location.href;
        }, 500);
      }

function supprimeGroupeProd(id_groupeProd) {
        $.get("<?= $_SESSION['url'] ?>gestionEmballage/supprimerGroupe/"+id_groupeProd);
        
        refresh();
      }
      function getIDGroupe(id) {
        document.getElementById('confirmSupGroupe').setAttribute("onclick","supprimeGroupeProd("+id+")");
      }

 function modifGroupe(id_groupeProd,nomGroupeProd,id_groupe) { 
        
        $('#titre').text("MODIFIER LE GROUPE D'EMBALLAGE");
        $('#submitGroupe').attr('value','MODIFIER');
        $('#submitGroupe').attr('name','modifierGroupeProd');
        $('#nomGroupeProd ').val(nomGroupeProd);
         id_groupe= (id_groupe!='')?id_groupe : 'null';
        $('#id_groupeProd').val(id_groupe); 
      
         if ( id_groupeProd!='null') {
          $('#id_groupeProd option').removeAttr('disabled');
          $('#id_groupeProd option[value="'+id_groupeProd+'"]').attr("disabled", true);
        }
        $('#formGroupe').attr('action','<?= $_SESSION['url'] ?>gestionEmballage/'+id_groupeProd);
      }

function ajouterGroupe(){
  $('#titre').text("AJOUTER UN NOUVEAU EMBALLAGE PRODUIT");
  $('#submitGroupe').attr('value','VALIDER');
  $('#submitGroupe').attr('name','validerGroupe');
  $('#nomGroupeProd ').val("");
  $("#id_groupeProd option").removeAttr('disabled');
  $('#id_groupeProd').val("null"); 

  $('#formGroupe').attr('action','');
}

    </script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>

<?php 
      function afficheProduit($produit){ ?>
          <tr>
             <td><a href="<?= $_SESSION['url'] ?>formEmballage/<?= $produit['id_prod'] ?>" class="ldp_table"><?= $produit['nomProd'] ?></a></td>
                          <td><?= $produit['codeArticle'] ?></td>
                          <td><?= $produit['codeBarre'] ?></td>
                          <td style=" text-align: center;">
                  <a onclick="getID(<?= $produit['id_prod'] ?>)" href="" data-toggle="modal" data-target="#supprime"><i class="fas fa-minus-circle"></i></a>
                          </td>
          </tr>
<?php }


  function afficheGroupe($groupe,$sousGrp=false){
    $listeGroupe = listeGroupeProd($groupe['id_groupeProd']);
    $listeProduitGroupe= listeProduitGroupe($groupe['id_groupeProd']);
  ?>
    <div class="card <?=($sousGrp)?'m-2':'m-0 mb-2' ?>  firstCard" style="border:#333 solid 1px;border-radius: 5px">
      <div class="card-header textTab" style="background-color:#333;color:white;padding-right: 0px">
        <a href="#" data-toggle="modal" data-target="#ajoutGroupe" class="text-white"
          onclick="modifGroupe(<?= $groupe['id_groupeProd'].",'".$groupe['nomGroupeProd']."','".$groupe['id_groupe']."'" ?>)">
          <?= $groupe['nomGroupeProd'] ?>
        </a>
        <div class="float-right" style="width: 10%;text-align: left;color: white">
          <a href="" onclick="getIDGroupe(<?= $groupe['id_groupeProd'] ?>)"  data-toggle="modal" data-target="#supprimeGroupe"> <i class="fas fa-minus-circle"  style="color:rgb(190, 190, 190);" ></i></a>
        </div>
      </div>

      <div class="card-body p-0">
        <?php while ($groupe= $listeGroupe->fetch()){
          afficheGroupe($groupe,true);
        } ?>

        <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
          <?php while ($produit= $listeProduitGroupe->fetch()){
            afficheProduit($produit);
          } ?>
        </table>
      </div>
    </div>
  
  <?php }