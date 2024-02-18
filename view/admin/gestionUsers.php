<?php $title='gestion des utilisateurs' ?>

<?php ob_start(); ?> 
<div id="bodylignesP" >
 <?php require('view/navbar.php') ?>
    
    <div class="card">
      	<div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
      		<span class="cardTitle mt-2">Gestion des Utilisateurs</span>
            <a href="#" data-toggle="modal" data-target="#ajout" class="btn btn-primary float-right btnAlign"><i class="fas fa-plus-circle"></i> UTILISATEUR</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table  table-striped table-hover table-bordered table-sm" >
                    <thead class="w-100">
                        <tr>
                          <th style="width:30%;">Nom de l'Utilisateur</th>
                          <th style="width:20%;">Hirarchie</th>
                          <th style="width:15%;">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while ($user = $listUsers->fetch()) { ?>
                        <tr>
                          <td><a class="textTab" href="<?= $_SESSION['url'] ?>gestionUtilisateurs/modifier/<?= $user['id_user'] ?>"><i class="fas fa-user-alt fa-2x mr-3"></i><?= $user['nomComplet'] ?></a></td>
                          <td><?= $user['type'] ?></td>
                          <td style=" text-align: center;">
                          <?php if($user['id_user'] != $_SESSION['id_user']){ ?>
                            <a href="" onclick="getID(<?= $user['id_user'] ?>)" data-toggle="modal" data-target="#supprime"><i class="fas fa-user-times fa-lg mr-3" style="color:rgb(119, 4, 4);"></i></a>
                          <?php } ?> 
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>                             
                </table>
            </div>
        </div>
    </div>
</div>
   
    <!--Modal SUPPRIMER COMPTE-->
    <div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Suppression d'un compte</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p style="font-size:20px;">Vous voulez vraiement supprimer ce compte ?</p>
                </div>
                <div class="modal-footer mx-auto">
                <a href="" id="confirmSup" class="btn btn-primary">Confirmer</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>  
                </div>
              </div>
            </div>
          </div>

           <!--Modal Ajouter COMPTE-->
    <div class="modal fade" id="ajout" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog ">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN NOUVEAU COMPTE</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">    
                  <form method="post" action="<?= $_SESSION['url'] ?>gestionUtilisateurs/ajouter">
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Nom et prénom</label>
                            <input required type="text" name="nomUser" class="input form-control ml-2" value="">
                    </div>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Nom d'utilisateur</label>
                            <input required type="text" name="login" class="input form-control ml-2" value="">
                    </div>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Mot de passe</label>
                            <input required type="password" name="mdp" class="input form-control ml-2" value="">
                    </div>
                    <div id="LDP_modif" class="input-group input-group-lg form-group mx-left mb-3 w-100 ml-1"> 
                            <label for="text" class="ldpLabel justify-content-middle text-left" >Hirarchie</label>
                            <select required name="type" class="selectNormeForm custom-select custom-select-lg ">
                              <option value="">Selectionner une héararchie</option>
                            <?php if($_SESSION['droitAdmin']==','){ ?>
                              <option value="admin">Administrateur</option>
                            <?php } ?>
                              <option value="control">Controleur</option>
                              <option value="emballage">Emballage</option>
                              <option value="magasinier">Magasinier</option>
                              <option value="laboratoire">Laboratoire</option>
                              <option value="matierePremiere">Matière Première</option>
                            </select>
                    </div>
                    <div class="modal-footer d-block text-center">
                      <input type="submit" name="valider" class="btn btn-primary w-auto" value="VALIDER">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>  
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

</div>
<script type="text/javascript">
  function getID(id) {
    document.getElementById('confirmSup').setAttribute("onclick","supprimeUser("+id+")");
  }
  function refresh() {
    window.location.href = window.location.href;
  }
  function supprimeUser(id_norme) {
           var xhttp;
            xhttp = new XMLHttpRequest();
            
            xhttp.open("GET", "<?= $_SESSION['url'] ?>gestionUtilisateurs/supprimer/"+id_norme, true);
            xhttp.send(); 
    refresh();
  }
</script>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>