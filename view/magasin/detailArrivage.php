<?php $title="les sous projets de projet"  ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>
 <h1 class="display-block mt-3 display-5 text-white" style="text-align: center;"><?= $detailArrivage['nomProd'] ?></h1>
 <h3 class="display-block mt-3 display-5 text-white" style="text-align: center;">arrivage du <?= $detailArrivage['dateArrivage'] ?></h3>

    <div class="card">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">ARRIVAGE</span></div>
         <div class="card-body">
            <form method="post" action="">
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100 ml-1"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Produit</label>
                            <select required name="produit" class="selectNormeForm custom-select custom-select-lg ">
                              <option value="">Selectionner un produit</option>
                              <?php while ($nomProd = $listEmbProduit->fetch()){ ?>
                              <option  <?php if($detailArrivage['nomProd']==$nomProd['nomProd']) echo"selected" ?>  value="<?= $nomProd['id_prod'] ?>"><?= $nomProd['nomProd'] ?></option>
                               <?php } ?>
                           



                            
                            </select>
                    </div>
                      <div class="text-center">
                       <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100 ml-1"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Fournisseur</label>
                            <select required name="fournisseur" class="selectNormeForm custom-select custom-select-lg ">
                              <option value="">Selectionner le fournisseur</option>
                            
                               <?php while ($nomFournisseur = $listEmbFournisseur->fetch()){ ?>
                              <option  <?php if($detailArrivage['nomFournisseur']==$nomFournisseur['nomFournisseur']) echo"selected" ?>  value="<?= $nomFournisseur['id_fournisseur'] ?>"><?= $nomFournisseur['nomFournisseur'] ?></option>
                              <?php } ?>
                            </select>
                    </div>
                     </div>
                    <div class="text-center">
                     <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Quantite </label>
                            <input required type="text" name="quantite" class="input form-control ml-2" value="<?= $detailArrivage['quantite'] ?>">
                      </div>
                     </div>
                     <div class="text-center">
                     <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Date d'arrivage </label>
                            <input required type="date" name="dateArrivage" class="input form-control ml-2" value="<?= $detailArrivage['dateArrivage'] ?>">
                      </div>
                     </div>
                     <div class="text-center">
                     <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >num Lot </label>
                            <input required type="text" name="numLot" class="input form-control ml-2" value="<?= $detailArrivage['numLot'] ?>">
                      </div>
                     </div>
                      <div class="text-center">
                    
                     </div>
                    
                    <div class="text-center">
                      <div>
                      <input type="submit" class="btn btn-primary mx-auto" name="modifier"  value="MODIFIIER">
                      
                      <a href="<?= $_SESSION['url'] ?>/magasin" class="btn btn-secondary mx-auto">RETOUR</a>
                      </div>
                   </div>
                   
            </form>
               
        </div>
    </div>
   
<div class="card">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
          <span class="cardTitle">Verification de l'image d'emballage</span>
        </div>
        <div class="card-body">
          <iframe id="detailVersion" src="<?= $_SESSION['url'].'magasin/verifIMG/'.$id_arrivage ?>" style="width: 100%;" scrolling="no" onload="resizeIframe(this)" class="embed-responsive-item" frameborder="0"></iframe>                 
        </div>
    </div>


  </div>


   
    




<style type="text/css">
  .firstCard .firstCard{
    margin: 7px 16px 3px 16px !important;
  }
  .firstCard{
    margin-top: 7px !important;
  }
</style>

<?php $content= ob_get_clean(); ?>

<?php require('view/gabarit.php') ?>


<?php
function afficheTache($Tache){ 
  $obj = new Projet;
  $listSousTache = $obj-> recupSousTache($Tache['id_tache']);
 

  if($sousTache= $listSousTache->fetch()) { ?>
    <div class="card m-0 firstCard" style="border:#333 solid 1px;border-radius: 5px">
        <div class="card-header textTab" style="background-color:#333;color:white;padding-right: 0px">
          <a href="#" class="text-white" style="text-decoration: none;" data-toggle="modal" data-target="#ajoutModifGroup"  id="<?= $Tache['id_tache'] ?>"><?= $Tache['titre_tache'] ?></a>
        
          <div class="float-right" style="width: 20%;text-align: center;color: white">
             <a><i class="fas fa-minus-circle text-white" data-toggle="modal" data-target="#supprimetache" onclick="getID(<?= $Tache['id_tache'] ?>)"></i></a>
          </div>
          <div class="float-right" style="width: 5%;text-align: left;color: white">
            <?= $Tache['id_tache']?>
          </div>
        </div>
    <div class="card-body p-0">
    
      <?php while($sousTache){ 
              afficheTache($sousTache);
              $sousTache= $listSousTache->fetch();
            } ?>

        </div>
    </div>
    <?php }else{ ?>
              <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
                <tr>
                  <td style="width: 20%"><a id="<?= $Tache['id_tache'] ?>" class="textTab" href="#" data-toggle="modal" data-target="#ajoutModif" onclick="getLDPNorme(this)"><?= $Tache['id_tache'] ?></a></td>
                  <td style="width: 10%"><?= $Tache['titre_tache'] ?></td>
                  <td style="width: 15%"><?= $Tache['desc_tache'] ?></td>
                  <td style="width: 15%"><?= $Tache['temp_reel'] ?></td>
                  <td style="width: 15%"><?= $Tache['etat_tache'] ?></td>
                  <td style="width: 5%"><?= $Tache['date_limite'] ?></td>   
                  <td style=" text-align: center;width: 20%">
                    <a><i class="fas fa-minus-circle" data-toggle="modal" data-target="#supprime" onclick="getID(<?= $Tache['id_tache'] ?>)"></i></a>
                  </td>
                </tr>
              </table>
               <?php } 
}?>

<script type="text/javascript">
  function getID(id) {
    document.getElementById('confirmSup').setAttribute("onclick","supprimeUser("+id+")");
  }
  function refresh() {
    window.location.href = window.location.href;
  }
  function supprimeUser(id) {
           var xhttp;
            xhttp = new XMLHttpRequest();
            
            xhttp.open("GET", "<?= $_SESSION['url'] ?>detailProjet/supprimer/"+id, true);
            xhttp.send(); 
    refresh();
  }
  function ajouteSousProjet() {
      $('#nom_projet').attr('value','');
      $('#Des_projet').attr('value','');
      $('#date_debut_p').val('type');
      $('#titremodifier').text('AJOUTER UN NOUVEAU SOUS PROJET'); 
     
      
    }
    function defineId(id) {
      $('#confirmSup').attr('href','<?= $_SESSION['url'] ?>detailProjet/supprimer/'+id);
     
    }
  </script>

<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?>
  <script type="text/javascript">
    
   
   
   
  </script>
<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>