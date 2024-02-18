<?php $title="Gestion d'equipement" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>


    <div class="card">
    
          <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
          <span class="cardTitle" >GESTION DES REACTIFS</span> 
          <a  href="#" data-toggle="modal"  data-target="#ajouteReactif" class="btn btn-primary float-right mt-2 ml-3 btnAlign"><i class="fas fa-plus-circle"></i> REACTIF</a>
          <a href="#" data-toggle="modal"  data-target="#ajoutegroupe" class="btn btn-primary float-right mt-2 ml-3 btnAlign"><i class="fas fa-plus-circle"></i> GROUPE</a>
            
      </div> 

      <div class="card-body pt-1">
  
  


  <div class="tab-content" id="myTabContent">
<div id="colonne1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="colonne1-tab">
    <div class="table-responsive">
            <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0" >
              <thead class="w-100">
                <tr>
                  <th style="width: 18%"> Nom</th>
                  <th style="width: 20%">Fournisseur</th>
                  <th style="width: 20%">Quantité</th>
                  <th style="width: 20%">Numéro de lot</th>  
                  <th style="width: 15%">Supprimer</th>
                </tr>
              </thead>
            </table>
            <div id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
              <?php while ($groupe = $listeReactif->fetch()){ 
                      affichegroupe($groupe);
               } ?> 
            </div>
          </div>
<?php $equipementReactif = listeReactifLibre(); ?>
<?php while ($equipe= $equipementReactif->fetch()){ ?> 
                    
        <div class="table-responsive">
              <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
                <tr>
                  <td style="width: 18%"><a href="#" data-toggle="modal" data-target="#detailReactifs"  class="textTab"  onclick="descriptionReactif(<?= $equipe['id_reactif']?>)"><?= $equipe['nomReactif'] ?></a></td>
                  <td style="width: 20%"><?= $equipe['fournisseur'] ?></td>
                  <td style="width: 20%"><?= $equipe['quantiteReactif'].' '.$equipe['uniteReactif'] ?></td>
                  <td style="width: 20%"><?= $equipe['numLot'] ?></td>   
                  
            
                
                 <td style=" text-align: center;width: 15%">
                    <a href="" onclick="defineId(<?= $equipe['id_reactif'] ?>)" name="supprimeEquipe" data-toggle="modal" data-target="#supprime"> <i class="fas fa-minus-circle"  style="color:rgb(119, 4, 4);" ></i></a>
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



     <div class="modal fade" id="ajouteReactif" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog " style="width: 700px">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">AJOUTER REACTIF</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nom </label>
                                    <div class="col-sm-9">
                                      <input type="text" name="nomEquipement" class="form-control"  placeholder="">
                                    </div>
                            </div>
                    <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Fournisseur</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="fournisseur" class="form-control" placeholder="">
                                    </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Contact fournisseur</label>
                            <div class="col-sm-9">
                              <input type="text" name="mailFournisseur" class="form-control"  placeholder="">
                            </div>
                    </div>
                    <!-- modifier nabil -->     <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Quantité</label>
                                    <div class="col-sm-5">
                                      <input type="number" name="quantite" class="form-control" placeholder="quantité">
                                    </div>
                        <div class="col-sm-4">
                                      <input type="text" name="uniteReactif" class="form-control" placeholder="unité">
                                    </div>
                    </div>    <!-- modifier nabil -->  
                    <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Discription</label>
                                    <div class="col-sm-9">
                                      <textarea id="descReactif" name="descriptionReactif" class="form-control" placeholder=""></textarea>
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Groupe</label>
                                    <div class="col-sm-9">
                                      <select  name="GroupeReactif" class="selectNormeForm custom-select custom-select-lg ">

                                        <option value="null" >Aucun groupe</option>
                                      <?php while ($groupe= $listeGReactif->fetch()){ ?>
                                       <option value="<?= $groupe['idGroupeReactif'] ?>" ><?= $groupe['NomGroupe'] ?></option>
                                      <?php } ?>
                                       </select>
                                    </div>
                            </div>

                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">FDS</label>
                              <div class="col-sm-9">
                                      <!--<input type="text" name="fds" class="form-control"  placeholder="">-->
                                <!---------->
                                <div id="lienFds">
                      <div class="form-check" id="FILEfds">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienFds"
                        value="FILE"
                        id="fileFds"
                        onchange="toggleLien('lienFds')"
                      />
                      <label class="form-check-label" for="fileFds">
                        Importer un fichier
                        <input type="file" id="fichierFds" name="lienFds" class="fichier" />
                      </label>
                    </div>

                    <div class="form-check" id="LINKfds">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienFds"
                        value="LINK"
                        id="linkFds"
                        onchange="toggleFichier('lienFds')"
                      />
                      <label class="form-check-label" for="linkFds">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienFds"
                          name="lienFds"
                          placeholder="https://"
                        />
                      </label>
                    </div>
                    </div>
                                <!---------->
                              </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">DLC</label>
                                    <div class="col-sm-9">
                                      <div id="lienDlc">
                      <div class="form-check" id="FILEdlc">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienDlc"
                        value="FILE"
                        id="fileDlc"
                        onchange="toggleLien('lienDlc')"
                      />
                      <label class="form-check-label" for="fileDlc">
                        Importer un fichier
                        <input type="file" id="fichierDlc" name="lienDlc" class="fichier" />
                      </label>
                    </div>

                    <div class="form-check" id="LINKdlc">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienDlc"
                        value="LINK"
                        id="linkDlc"
                        onchange="toggleFichier('lienDlc')"
                      />
                      <label class="form-check-label" for="linkDlc">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienDlc"
                          name="lienDlc"
                          placeholder="https://"
                        />
                      </label>
                    </div>
                    </div>
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">numLot </label>
                                    <div class="col-sm-9">
                                      <input type="text" name="numLot" class="form-control"  placeholder="">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Date d'ouverture </label>
                                    <div class="col-sm-9">
                                      <input type="date" name="dateOuverture" class="form-control"  placeholder="" >
                                    </div>
                            </div>

                    
                    <div class="modal-footer d-block mx-auto text-center">
                    <input type="submit" class="btn btn-primary w-auto" name="ajouterEquipeReactif"  value="VALIDER">
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
                                       <?php while ($groupe= $listeGroupeReactif->fetch()){ ?>
                                       <option value="<?= $groupe['idGroupeReactif'] ?>" ><?= $groupe['NomGroupe'] ?></option>
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


<!--Modal SUPPRIMER REACTIFS-->
    <div class="modal fade" id="supprime" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Suppression d'une reactif</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p style="font-size:20px;">Vous voulez vraiement supprimer cette reactif ?</p>
                </div>
                <div class="modal-footer mx-auto">
                <a href="<?= $_SESSION['url'] ?>gestionConsommables/" id="confirmSup"  class="btn btn-primary">Confirmer</a>
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
                <a href="<?= $_SESSION['url'] ?>gestionReactifs/" id="confirmSupgroupe" name="supprimeG"  class="btn btn-primary">Confirmer</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>  
                </div>
              </div>
            </div>
          </div>


          <div class="modal fade" id="detailReactifs" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" style="max-width: 800px !important">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="DtailEquipe">Detail reactif </h5>
                 
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">    
                  <form method="post" id="formReactif" action="" enctype="multipart/form-data">
                    <div id="LDP_modif" class="row"> 
                            <div class="col-5" >Nom</div>
                            <div  class="col-7 detail" >   <strong id="nomConsommable"></strong></div>
                            <div class="col-7">
                                      <input type="text" id="nomConso" name="nomConso" class="form-control modif" placeholder="">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div  class="col-5" >Fournisseur</div>
                            <div  class="col-7 detail"> <strong id="fournisseurc"></strong> </div>
                            <div class="col-7">
                                      <input type="text" id="fournisseur" name="fournisseur" class="form-control modif" placeholder="">
                            </div>
                    </div>
                     <br>
                    <div id="LDP_modif" class="row"> 
                            <div  class="col-5" > Contact fournisseur </div>
                           <div class="col-7 detail"><strong id="mailFournisseur"></strong></div>
                        <div class="col-7">
                                      <input type="text" id="mailFournisseurI" name="mailFournisseurI" class="form-control modif" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div  class="col-5" >Quantité</div>
                           <div class="col-1 detail"> <strong id="Quantité"></strong> </div>
                           <div class="col-2 detail"> <strong id="uniteReactif"></strong> </div>
                        <div class="col-4">
                                      <input type="number" id="quantite" name="quantite" class="form-control modif" placeholder="">
                            </div>
                            
                            <div class="col-3">
                                      <div class="input-group mb-3  modif">
                                         <div class="input-group-prepend">
                                           <span class="input-group-text" id="basic-addon1">Unité</span>
                                              </div>
                                         <input type="text" id="uniteReactifI" name="uniteReactifI" class="form-control " placeholder="">
                                                    </div>
                            </div>
                    </div>
                    
                    <br>
                     <div id="LDP_modif" class="row"> 
                     <div  class="col-5 groupeAfiche ">Groupe</div>
                                 <div class="col-7 ">
                                      <select   id="groupeReactif" name="groupeReactif" class="selectNormeForm custom-select custom-select-lg  modif ">
                                        <option value="null" >Aucun groupe</option>
                                      <?php while ($groupe= $GroupeD->fetch()){ ?>
                                       <option value="<?= $groupe['idGroupeReactif']?>" ><?=$groupe['NomGroupe'] ?></option>
                                      <?php } ?>
                                      </select>
                            </div>
                            </div>
                            <br>
                    <div id="LDP_modif" class="row"> 
                            <div  class="col-5" >FDS</div>
                           <div class="col-7 detail"> <strong id="fds2"></strong> </div>
                        <div class="col-7">
                          <div class="modif d-none" id="lienFds2">
                      <div class="form-check" id="FILEfds2">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienFds"
                        value="FILE"
                        id="fileFds2"
                        onchange="toggleLien('lienFds2')"
                      />
                      <label class="form-check-label" for="fileFds2">
                        Importer un fichier
                        <input type="file" id="fichierFds2" name="lienFds" class="fichier" />
                      </label>
                    </div>

                    <div class="form-check" id="LINKfds2">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienFds"
                        value="LINK"
                        id="linkFds2"
                        onchange="toggleFichier('lienFds2')"
                      />
                      <label class="form-check-label" for="linkFds2">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienFds2"
                          name="lienFds"
                          placeholder="https://"
                        />
                      </label>
                    </div>
                    </div>
                        </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div  class="col-5" >DLC</div>
                           <div class="col-7 detail"> <strong id="dlc2"></strong> </div>
                        <div class="col-7">
                          <div class="modif d-none" id="lienDlc2">
                      <div class="form-check" id="FILEdlc2">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienDlc"
                        value="FILE"
                        id="fileDlc2"
                        onchange="toggleLien('lienDlc2')"
                      />
                      <label class="form-check-label" for="fileDlc2">
                        Importer un fichier
                        <input type="file" id="fichierDlc2" name="lienDlc" class="fichier" />
                      </label>
                    </div>

                    <div class="form-check" id="LINKdlc2">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienDlc"
                        value="LINK"
                        id="linkDlc2"
                        onchange="toggleFichier('lienDlc2')"
                      />
                      <label class="form-check-label" for="linkDlc2">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienDlc2"
                          name="lienDlc"
                          placeholder="https://"
                        />
                      </label>
                    </div>
                    </div>
                        </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div  class="col-5" >Numéro de lot </div>
                           <div class="col-7 detail"> <strong id="numLot"></strong> </div>
                        <div class="col-7">
                                      <input type="text" id="numLotI" name="numLotI" class="form-control modif" placeholder="">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div  class="col-5" >Date d'ouverture</div>
                           <div class="col-7 detail"> <strong id="dateOuverture"></strong> </div>
                        <div class="col-7">
                                      <input type="date" id="dateOuvertureI" name="dateOuvertureI" class="form-control modif" placeholder="">
                            </div>
                    </div>

                     <br>
                    <div id="LDP_modif" class="row"> 
                            <div  class="col-5" >Description </div>
                           <div class="col-7 detail"> <strong id="descriptioncConsommable"></strong> </div>
                        <div class="col-7">
                                      <textarea id="descriptionReactif" name="descriptionReactif" class="form-control modif"> </textarea>
                            </div>
                    </div>
                     
                    <br>
                     <div class="modal-footer d-block text-center">       
                    <input id="submitBtn" type="button" onclick="modifReactif()" class="btn btn-primary" name="modifier" style="width:auto !important;margin-left: auto;" value="MODIFIER">
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
                  <h5 class="modal-title" id="Dtailgroupe">Detail Groupe</h5>
                 
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
               
                <div class="modal-body" id="afficheDonne"  >    
                    
                   <form method="post" id="formGroupe" action="">     
                    <div id="LDP_modif" class="row"> 
                            <div class="col-5" >Nom</div> 
                            
                            <div  class="col-7 detailGroupe"><strong id="nomGroupe"></strong></div>
                            <div class="col-7">
                                      <input type="text" id="nomGroupeConsommable" name="nomGroupeConsommable" class="form-control modifGroupe" placeholder="">
                            </div>
                    </div>
                    <br>
                    <div id="LDP_modif" class="row"> 
                            <div class="col-5" >Discription</div>     
                            <div class="col-7 detailGroupe"><strong id="Discgroupe"></strong></div>
                            <div class="col-7">
                              <input type="text" id="DiscgroupeC" name="DiscgroupeC" class="form-control modifGroupe" placeholder="">
                            </div>
                    </div>
                    <br>
                  
                    <br>
                     <div id="LDP_modif" class="row"> 
                      <div  class="col-5">Groupe </div>
                          <div class="col-7 detailGroupe"> <strong id="idGroupe"></strong> </div>
                           <div class="col-7">
                                      <select   id="GroupeEquipement" name="GroupeEquipement" class="selectNormeForm custom-select custom-select-lg  modifGroupe ">
                                        
                                        <option value="null" >Aucun groupe</option>
                                      <?php while ($groupe= $listeDetailGroupe->fetch()){ ?>
                                       <option value="<?= $groupe['idGroupeReactif'] ?>" ><?= $groupe['NomGroupe'] ?></option>
                                      <?php } ?>
                                      </select>
                            </div>
                    </div>
                     
                    <div class="modal-footer d-block text-center">       
                     <input id="submitBtnGroupe" type="button" onclick="modifGroupeEquipment()" class="btn btn-primary" name="modifierGroupe" style="width:auto !important;margin-left: auto;" value="MODIFIER">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button>
                    </div>
                  </form>
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
        //disabled si même nom
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
function descriptionReactif(id_reactif) {
     $(".detail").addClass("d-none");
      $(".modif").addClass("d-none");
      $(".groupeAfiche").addClass("d-none");
      
    $.get("<?= $_SESSION['url'] ?>detailReactifs/"+id_reactif, function(data, status){
      var obj =JSON.parse(data);
      $('#submitBtn').attr('value','MODIFIER')
      $('#nomConsommable').text(obj.nomReactif); 
      $('#nomConso').val(obj.nomReactif);
      $('#fournisseurc').text(obj.fournisseur);
      $('#fournisseur').val(obj.fournisseur);
      $('#Quantité').text(obj.quantiteReactif);
      $('#quantite').val(obj.quantiteReactif);
      $('#uniteReactif').text(obj.uniteReactif);
      $('#uniteReactifI').val(obj.uniteReactif);
      $('#descriptioncConsommable').text(obj.descriptionReactif);
      $('#descriptionReactif').val(obj.descriptionReactif);
      if(obj.idGroupeReactif) $('#groupeReactif').val(obj.idGroupeReactif);
       else $('#groupeReactif').val('null');
      if(obj.mailFournisseur.search("http")==0)
        $('#mailFournisseur').empty().prepend('<a target="_blank" href="'+obj.mailFournisseur+'" >'+obj.mailFournisseur+'</a>');
       else $('#mailFournisseur').text(obj.mailFournisseur); 
      $('#mailFournisseurI').val(obj.mailFournisseur);
      
      $('#'+obj.fds.type+'fds2 input[name="typeLienFds"]').attr('checked','checked');
      $('#'+obj.fds.type+'fds2 input[name="lienFds"]').attr('value',obj.fds.lien);
      if(obj.fds.type=='FILE'){
        toggleLien('lienFds2');
        $('#fds2').empty().prepend('<a target="_blank" href="<?= $_SESSION['url'] ?>telecharger/Fds/'+obj.id_reactif+'" >'+obj.fds.lien+'</a>');
      }
      else if(obj.fds.type=='LINK'){
        toggleFichier('lienFds2');
        $('#fds2').empty().prepend('<a target="_blank" href="'+obj.fds.lien+'" >'+obj.fds.lien+'</a>');
      }
      else $('#fds2').empty();

      $('#'+obj.dlc.type+'dlc2 input[name="typeLienDlc"]').attr('checked','checked');
      $('#'+obj.dlc.type+'dlc2 input[name="lienDlc"]').attr('value',obj.dlc.lien);
      if(obj.dlc.type=='FILE'){
        toggleLien('lienDlc2');
        $('#dlc2').empty().prepend('<a target="_blank" href="<?= $_SESSION['url'] ?>telecharger/Dlc/'+obj.id_reactif+'" >'+obj.dlc.lien+'</a>');
      }
      else if(obj.dlc.type=='LINK'){
        toggleFichier('lienDlc2');
        $('#dlc2').empty().prepend('<a target="_blank" href="'+obj.dlc.lien+'" >'+obj.dlc.lien+'</a>');
      }
      else $('#dlc2').empty();

      $('#numLot').text(obj.numLot); 
      $('#numLotI').val(obj.numLot);
      $('#dateOuverture').text(obj.dateOuverture); 
      $('#dateOuvertureI').val(obj.dateOuverture);
      
      $('#formReactif').attr('action','<?= $_SESSION['url'] ?>detailReactifs/'+id_reactif);
      $(".detail").removeClass("d-none");

    });
  }
  
 function modifReactif(){
  if($('#submitBtn').attr('value')=='MODIFIER'){
      $(".detail").addClass("d-none");
      $(".modif").removeClass("d-none");
      $(".groupeAfiche").removeClass("d-none");
      $('#submitBtn').attr('value','VALIDER');
    
    }else{
      $('#submitBtn').attr('type','submit');
      
    }

  }

  function toggleLien(className){
    $('#'+className+" .lien").prop("disabled", true)
    $('#'+className+" .fichier").prop("disabled", false)
  }

  function toggleFichier(className){
    $('#'+className+" .fichier").prop("disabled", true);
    $('#'+className+" .lien").prop("disabled", false);
  }

 function descriptionGroupeConso(idGroupeReactif) {    
      $(".detailGroupe").addClass("d-none");
      $(".modifGroupe").addClass("d-none");
      $.get("<?= $_SESSION['url'] ?>detailGroupeReactif/"+idGroupeReactif, function(data, status){
      var obj =JSON.parse(data);
      $('#submitBtnGroupe').attr('value','MODIFIER')
      $('#nomGroupe').text(obj.NomGroupe);
      $('#nomGroupeConsommable').val(obj.NomGroupe);
      $('#Discgroupe').text(obj.DescriptionGroupe);
      $('#DiscgroupeC').val(obj.DescriptionGroupe); 
      $('#idGroupe').text(obj.id_Groupe);
      if(obj.id_Groupe!=null) $('#GroupeEquipement').val(obj.id_Groupe);
        else $('#GroupeEquipement').val('null'); 
      $('#formGroupe').attr('action','<?= $_SESSION['url'] ?>detailGroupeReactif/'+idGroupeReactif);
      $(".detailGroupe").removeClass("d-none");
    });
  
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
      $('#confirmSup').attr('href','<?= $_SESSION['url'] ?>gestionReactifs/supprimer/'+id);
     
    }
    function defineIdGroupe(id) {
      $('#confirmSupgroupe').attr('href','<?= $_SESSION['url'] ?>gestionReactifs/supprimergroupe/'+id);
     
    }
  
</script>

<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>


<?php
function affichegroupe($groupe){
$sousGroupe = SousGroupeReactif($groupe['idGroupeReactif']);
  
if ($Groupe = $sousGroupe->fetch()){  $equipementReactif = liste_Reactifs($groupe['idGroupeReactif']); ?>  

<div class="card m-0 firstCard" style="border:#333 solid 1px;border-radius: 5px">
        <div class="card-header textTab" style="background-color:#333;color:white;padding-right: 0px">
          <a href="#" data-toggle="modal" data-target="#Dtailgroupe" class="text-white" onclick="descriptionGroupeConso(<?= $groupe['idGroupeReactif'] ?>)"><?= $groupe['NomGroupe'] ?></a>
        
          <div  class="text-white" style="text-decoration: none;"   ></div>
          <div class="float-right" style="width: 10%;text-align: left;color: white">
          <a href="" onclick="defineIdGroupe(<?= $groupe['idGroupeReactif'] ?>)"  data-toggle="modal" data-target="#supprimeGroupe"> <i class="fas fa-minus-circle"  style="color:rgb(119, 4, 4);" ></i></a>
          </div>
        </div>
    <div class="card-body p-0">
             
<?php while ($equipe= $equipementReactif->fetch()){ ?> 
                    
                 <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
                  <tr>
                  
                  <td style="width: 18%"><a href="#" data-toggle="modal" data-target="#detailReactifs"  class="textTab"  onclick="descriptionReactif(<?= $equipe['id_reactif']?>)"><?= $equipe['nomReactif'] ?></a></td>
                  <td style="width: 20%"><?= $equipe['fournisseur'] ?></td>
                  <td style="width: 20%"><?= $equipe['quantiteReactif'].' '.$equipe['uniteReactif'] ?></td>
                  <td style="width: 20%"><?= $equipe['numLot'] ?></td>   
                 <td style=" text-align: center;width: 15%">
                  <a href="" onclick="defineId(<?= $equipe['id_reactif'] ?>)"  data-toggle="modal" data-target="#supprime"> <i class="fas fa-minus-circle"  style="color:rgb(119, 4, 4);" ></i></a>
                  </td>
                </tr>
              </table>
    
          <?php ; 
} ?> 
<?php while($Groupe){ 
              affichegroupe($Groupe);
              $Groupe= $sousGroupe->fetch();
            } ?>

 

    </div>
    </div>

<?php }else{ $equipementReactif = liste_Reactifs($groupe['idGroupeReactif']); ?>
 <div class="card m-0 firstCard" style="border:#333 solid 1px;border-radius: 5px">
        <div class="card-header textTab" style="background-color:#333;color:white;padding-right: 0px">
         <a href="#" data-toggle="modal" data-target="#Dtailgroupe" class="text-white" onclick="descriptionGroupeConso(<?= $groupe['idGroupeReactif'] ?>)"><?= $groupe['NomGroupe'] ?></a>  
          <div class="float-right" style="width: 10%;text-align: left;color: white">
          <a href="" onclick="defineIdGroupe(<?= $groupe['idGroupeReactif'] ?>)"  data-toggle="modal" data-target="#supprimeGroupe"> <i class="fas fa-minus-circle"  style="color:rgb(119, 4, 4);" ></i></a>
          </div>
        </div>
    <div class="card-body p-0">
             
<?php while ($equipe= $equipementReactif->fetch()){ ?> 
              <table id="table" class="table  table-striped table-hover table-bordered table-sm m-0">
                <tr>
                  
                  <td style="width: 18%"><a href="#" data-toggle="modal" data-target="#detailReactifs"  class="textTab"  onclick="descriptionReactif(<?= $equipe['id_reactif']?>)"><?= $equipe['nomReactif'] ?></a></td>
                  <td style="width: 20%"><?= $equipe['fournisseur'] ?></td>
                   <td style="width: 20%"><?= $equipe['quantiteReactif'].' '.$equipe['uniteReactif'] ?></td>
                  <td style="width: 20%"><?= $equipe['numLot'] ?></td>   
                    <td style=" text-align: center;width: 15%">
                     <a href="" onclick="defineId(<?= $equipe['id_reactif']?>)"  data-toggle="modal" data-target="#supprime"> <i class="fas fa-minus-circle"  style="color:rgb(119, 4, 4);" ></i></a>
                  </td>
                </tr>
              </table>
    
          <?php ; 
} ?> 
 

    </div>
    </div>

<?php } ?>
      
<?php }?>
