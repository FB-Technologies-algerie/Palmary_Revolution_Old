<?php $title="Gestion d'utilisateur" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
 <?php require('view/navbar.php') ?>

    <h1 class="display-block mt-3 display-5 text-white" style="text-align: center;"></h1>

    <div class="card">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">GESTION D'UTILISATEUR</span></div>
        <div class="card-body">
            <form method="post" action="">
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Nom et prénom</label>
                            <input required type="text" name="nomUser" class="input form-control ml-2" value="<?= $user['nomComplet'] ?>">
                    </div>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Nom d'utilisateur</label>
                            <input required type="text" name="login" class="input form-control ml-2" value="<?= $user['login'] ?>">
                    </div>

                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
                        <label for="text" class="ldpLabel justify-content-middle text-left" >Mot de passe</label>


                           <div class="fixProblemPosition input-group-prepend ml-2">
                            <span class="input-group-text p-0" id="modif"><div class="btn btn-secondary rounded-0" onclick="passwordModif()">Modifier</div></span>
                             </div>
                            <input required type="password" id="passwordUser" class="passwordInput input form-control" value="********" name="mdp" aria-describedby="modif" style="border-top-left-radius: 0 !important;border-bottom-left-radius: 0 !important;" disabled>

                      </div> 

                   
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Hirarchie</label>
                            <select required name="type" class="selectNormeForm custom-select custom-select-lg ml-1">
                              <option value="">Selectionner une héararchie</option>
                            <?php if($_SESSION['droitAdmin']==','){ ?>
                              <option <?php if($user['type']=='admin') echo 'selected' ?> value="admin">Administrateur</option>
                            <?php } ?>
                              <option <?php if($user['type']=='control') echo 'selected' ?> value="control">Controleur</option>
                              <option <?php if($user['type']=='emballage') echo 'selected' ?> value="emballage">Emballage</option>
                              <option <?php if($user['type']=='magasinier') echo 'selected' ?> value="magasinier">Magasinier</option>
                              <option <?php if($user['type']=='laboratoire') echo 'selected' ?> value="laboratoire">Laboratoire</option>
                              <option <?php if($user['type']=='matierePremiere') echo 'selected' ?> value="matierePremiere">Matière Première</option>
                            </select>
                    </div>
                    <div class="modal-footer mx-auto text-center d-block">
                      <input type="submit" name="valider" class="btn btn-primary w-auto" value="VALIDER">
                      <a href="<?= $_SESSION['url'] ?>gestionUtilisateurs" class="btn btn-secondary">RETOUR</a>  
                    </div>
                  </form>
               
        </div>
    </div>
<?php if($user['type']=='control'){ ?>
    <div class="card">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
         <span class="cardTitle">GESTION DES AFFECTATIONS</span> 
         
          <a href="#" data-toggle="modal" onclick="" data-target="#ajoutModif" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> AFFECTATION</a>
            
      </div>

      <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
              <thead class="w-100">
                <tr>
                  <th>Ligne de production</th>
                  <th>Unité de production</th>
                  <th style="width:15%;text-align:center;">Supprimer</th>
                </tr>
              </thead>
              <tbody>
              <?php while ($affect = $listAffect->fetch()){ $affectation= true;?>
                <tr>
                  <td><?= $affect['nomLigneP'] ?></td>
                  <td><?= $affect['nomUnite'] ?></td>
                    
                  <td style=" text-align: center;">
                    <a><i class="fas fa-minus-circle" data-toggle="modal" data-target="#supprime" onclick="getID(<?= $id_user ?>,<?= $affect['id_ligneP'] ?>,'Ligne')"></i></a>
                  </td>
                </tr>
              <?php } ?>
              <?php if(!$affectation){ ?>
                <span class="alert text-danger" >*Attention ce contrôleur est affecté à aucune ligne de production</span>
              <?php } ?>
             
            </table>
          </div>
        </div>
    </div>

    <!--Modal SUPPRIMER affect-->
    <div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="titleGroup">SUPRESSION D'AFFECTATION</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p id="textGroup" style="font-size:20px;">Vous voulez vraiement supprimer cette affectation à cette utilisateur ?</p>
                </div>
                <div class="modal-footer mx-auto">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirmSup" >CONFIRMER</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>  
                </div>
              </div>
            </div>
          </div>

                       <!--Modal Ajout/modif affect-->
    <div class="modal fade" id="ajoutModif" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">AFFECTATION</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
        <form method="post" action="">
          <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
            <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2" >Ligne de production</label>
            <select name="ligneP" class="selectNormeForm custom-select custom-select-lg "> 
                <option value="">choisir une ligne</option>
              <?php while($ligne= $listLignesP->fetch()){ ?>
                <option value="<?= $ligne['id_ligneP'] ?>" ><?= $ligne['nomLigneP'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="modal-footer mx-auto d-block text-center">
            <input type="submit" name="confirmeLigne" class="btn btn-primary w-auto" value="CONFIRMER">
            <button class="btn btn-secondary">ANNULER</button>
          </div>
        </form>
          </div>
        </div>
      </div>
    </div>
<?php } elseif($user['type']=='admin'){ ?>
    <div class="card">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
         <span class="cardTitle">GESTION DES AFFECTATIONS</span> 
         
          <a href="#" data-toggle="modal" onclick="" data-target="#ajoutModif" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> AFFECTATION</a>
            
      </div>

      <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
              <thead class="w-100">
                <tr>
                  <th>Unité de production</th>
                  <th>adresse d'unité</th>
                  <th style="width:15%;text-align:center;">Supprimer</th>
                </tr>
              </thead>
              <tbody>
              <?php while ($affect = $listAffect->fetch()){ $affectation=true; ?>
                <tr>
                  <td><?= $affect['nomUnite'] ?></td>
                  <td><?= $affect['adresseUnite'] ?></td>
                    
                  <td style=" text-align: center;">
                    <a><i class="fas fa-minus-circle" data-toggle="modal" data-target="#supprime" onclick="getID(<?= $id_user ?>,<?= $affect['id_unite'] ?>,'Unite')"></i></a>
                  </td>
                </tr>
              <?php } ?>
              <?php if(!$affectation){ ?>
                <span class="alert text-danger" >*Attention si vous n'affectez cet administrateur à aucune unité de production, il aura l'accès à tous les unités</span>
              <?php } ?>

            </table>
          </div>
        </div>
    </div>

    <!--Modal SUPPRIMER affect-->
    <div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="titleGroup">SUPRESSION D'AFFECTATION</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refresh()">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p id="textGroup" style="font-size:20px;">Vous voulez vraiement supprimer cette affectation à cette utilisateur ?</p>
                </div>
                <div class="modal-footer mx-auto">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirmSup" >CONFIRMER</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>  
                </div>
              </div>
            </div>
          </div>

                   <!--Modal Ajout/modif affect-->
    <div class="modal fade" id="ajoutModif" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">AFFECTATION</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
        <form method="post" action="">
          <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100">
            <label for="text" class="ldpLabel justify-content-middle text-left display-inline mr-2" >Unité de production</label>
            <select name="unite" class="selectNormeForm custom-select custom-select-lg "> 
                <option value="">choisir une unité</option>
              <?php while($unite= $listUnite->fetch()){ ?>
                <option value="<?= $unite['id_unite'] ?>" ><?= $unite['nomUnite'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="modal-footer mx-auto d-block text-center">
            <input type="submit" name="confirmeUnite" class="btn btn-primary w-auto" value="CONFIRMER">
            <button class="btn btn-secondary">ANNULER</button>
          </div>
        </form>
          </div>
        </div>
      </div>
    </div>
<?php } ?> 
   
    

    


</div>
<script type="text/javascript">
  function refresh() {
    window.location.href = window.location.href;
  }
  function supprimeAffect(id_user,id_suppr,type) {
           var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.open("GET", "<?= $_SESSION['url'] ?>suprAffect"+type+"/"+id_user+"/"+id_suppr, true);
            xhttp.setRequestHeader("Content-Type", "text/plain;charset=UTF-8");
            xhttp.send(); 
       
    refresh();
  }
  function getID(id_user,id_suppr,type) {
    document.getElementById('confirmSup').setAttribute("onclick","supprimeAffect("+id_user+","+id_suppr+",'"+type+"')");
  }
  function passwordModif(){
    psw= document.getElementById('passwordUser');
    if(psw.disabled){
    	psw.disabled=false
    	psw.value="";
    	psw.focus();
	}else{
		psw.disabled=true
    	psw.value="*********";
    	psw.focus();
	}
  }

</script>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>