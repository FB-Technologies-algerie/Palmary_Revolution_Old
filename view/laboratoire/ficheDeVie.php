<?php $title="Gestion d'equipement" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
  <!-- <div id="bodyAdmin"> -->
<?php require('view/navbar.php') ?>
  <header class="mt-5">            
        <h2 class="text-center w-100 text-white">Fiche de vie</h2>
        <h1 class="text-center text-white"><?= $ficheDeVie['nomEquipement'] ?></h1>
    </header>

    <div class="card" style="width: 80%;margin: auto;margin-top: 100px">
      <div class="card-header">
        <div class="row">
          <div class="col-md"><span>Detail équipement</span></div>
        </div>
      </div>
      <div class="card-body">
        <form action="" id="Detailequipement" enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="col-md">
              <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">Marque</label>
                <div class="col-sm-8">
                  <input
                    style="display: none"
                    type="text"
                    class="inputAffiche form-control"
                    name="marque"
                    value="<?= $ficheDeVie['marque'] ?>"
                  />
                  <span class="textAffiche"><?= $ficheDeVie['marque'] ?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">Modèle</label>
                <div class="col-sm-8" style="align-self: center;">
                  <input
                    style="display: none"
                    type="text"
                    class="inputAffiche form-control"
                    name="modele"
                    value="<?= $ficheDeVie['modele'] ?>"
                  />
                  <span class="textAffiche"><?= $ficheDeVie['modele'] ?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">N° de serie</label>
                <div class="col-sm-8" style="align-self: center;">
                  <input
                    style="display: none"
                    type="text"
                    class="inputAffiche form-control"
                    name="nSerie"
                    value="<?= $ficheDeVie['nSerie'] ?>"
                  />
                  <span class="textAffiche"><?= $ficheDeVie['nSerie'] ?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">N° d'identification</label>
                <div class="col-sm-8" style="align-self: center;">
                  <input
                    style="display: none"
                    type="text"
                    class="inputAffiche form-control"
                    name="nIdentification"
                    value="<?= $ficheDeVie['nIdentification'] ?>"
                  />
                  <span class="textAffiche"><?= $ficheDeVie['nIdentification'] ?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">Référence</label>
                <div class="col-sm-8" style="align-self: center;">
                  <input
                    style="display: none"
                    type="text"
                    class="inputAffiche form-control"
                    name="reference"
                    value="<?= $ficheDeVie['reference'] ?>"
                  />
                  <span class="textAffiche"><?= $ficheDeVie['reference'] ?></span>
                </div>
              </div>
            </div>
            <div class="col-md">
              <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">Constructeur</label>
                <div class="col-sm-8" style="align-self: center;">
                  <div class="inputAffiche" style="display: none">
                    <input type="text" class="form-control" name="constructeur"
                    value="<?= $ficheDeVie['constructeur'] ?>" />

                    <div id="constructeur">
                        <div class="form-check">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienConstructeur"
                        value="FILE"
                        id="fileConstructeur"
                        <?= ($ficheDeVie['lienConstructeur']['FILE']!='')?'checked':'' ?>
                        onchange="toggleLien('constructeur')"
                      />
                      <label class="form-check-label" for="fileConstructeur">
                        Importer un fichier
                        <input type="file" id="fichierConst" name="lienConstructeur" class="fichier"
                        <?php if($ficheDeVie['lienConstructeur']['FILE']!=''){ ?>
                          value="<?= $ficheDeVie['lienConstructeur']['FILE'] ?>"
                        <?php }else{ ?>
                          disabled
                        <?php } ?> 
                        />
                      </label>
                    </div>

                    <div class="form-check">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienConstructeur"
                        value="LINK"
                        id="linkConstructeur"
                        <?= ($ficheDeVie['lienConstructeur']['LINK']!='')?'checked':'' ?>
                        onchange="toggleFichier('constructeur')"
                      />
                      <label class="form-check-label" for="linkConstructeur">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienConst"
                          name="lienConstructeur"
                          placeholder="http://"
                        <?php if($ficheDeVie['lienConstructeur']['LINK']!=''){ ?>
                          value="<?= $ficheDeVie['lienConstructeur']['LINK'] ?>"
                        <?php }else{ ?>
                          disabled
                        <?php } ?> 
                        />
                      </label>
                    </div>
                    </div>
                  
                   
                  </div>

                  <span class="textAffiche">
                    <a  target="_blank"
                        <?php if($ficheDeVie['lienConstructeur']['LINK']!=''){ ?>
                          href="<?= $ficheDeVie['lienConstructeur']['LINK'] ?>"
                        <?php }elseif($ficheDeVie['lienConstructeur']['FILE']!=''){ ?>
                          href="<?= $_SESSION['url'].'telecharger/Constructeur/'.$id_equipement ?>"
                        <?php } ?>
                    />
                      <?= $ficheDeVie['constructeur'] ?>   
                    </a>
                  </span>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label"
                  >Fournisseur</label
                >
                <div class="col-sm-8">
                  <div class="inputAffiche" style="display: none">
                    <input type="text" class="form-control" name="fournisseur"
                    value="<?= $ficheDeVie['fournisseur'] ?>" />
                    <div id="fournisseur">
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="typeLienFournisseur"
                        value="FILE"
                        id="fileFournisseur"
                        <?= ($ficheDeVie['lienFournisseur']['FILE']!='')?'checked':'' ?>
                        onchange="toggleLien('fournisseur')"
                      />
                      <label class="form-check-label" for="fileFournisseur">
                        Importer un fichier
                        <input type="file" id="fichierConst" name="lienFournisseur" class="fichier"
                        <?php if($ficheDeVie['lienFournisseur']['FILE']!=''){ ?>
                          value="<?= $ficheDeVie['lienFournisseur']['FILE'] ?>"
                        <?php }else{ ?>
                          disabled
                        <?php } ?> 
                        />
                      </label>
                    </div>

                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="typeLienFournisseur"
                        value="LINK"
                        id="linkFournisseur"
                        <?= ($ficheDeVie['lienFournisseur']['LINK']!='')?'checked':'' ?>
                        onchange="toggleFichier('fournisseur')"
                      />
                      <label class="form-check-label" for="linkFournisseur">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienConst"
                          name="lienFournisseur"
                          placeholder="https://"
                        <?php if($ficheDeVie['lienFournisseur']['LINK']!=''){ ?>
                          value="<?= $ficheDeVie['lienFournisseur']['LINK'] ?>"
                        <?php }else{ ?>
                          disabled
                        <?php } ?> 
                        />
                      </label>
                    </div>
                    </div>
                  </div>

                  <span class="textAffiche">
                    <a  target="_blank"
                        <?php if($ficheDeVie['lienFournisseur']['LINK']!=''){ ?>
                          href="<?= $ficheDeVie['lienFournisseur']['LINK'] ?>"
                        <?php }elseif($ficheDeVie['lienFournisseur']['FILE']!=''){ ?>
                          href="<?= $_SESSION['url'].'telecharger/Fournisseur/'.$id_equipement ?>"
                        <?php }else{ ?>
                          href="#"
                        <?php } ?>
                    />
                      <?= $ficheDeVie['fournisseur'] ?>   
                    </a>
                  </span>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label"
                  >Affectation</label
                >
                <div class="col-sm-8" style="align-self: center;">
                  <input
                    style="display: none"
                    type="text"
                    class="inputAffiche form-control"
                    name="affectation"
                    value="<?= $ficheDeVie['affectation'] ?>"
                  />
                  <span class="textAffiche"><?= $ficheDeVie['affectation'] ?></span>
                </div>
              </div>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-md">
              <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label"
                  >Date de réception</label
                >
                <div class="col-sm-8" style="align-self: center;">
                  <input
                    style="display: none"
                    type="date"
                    class="inputAffiche form-control"
                    name="dateReception"
                    value="<?= $ficheDeVie['dateReception'] ?>"
                  />
                  <span class="textAffiche"><?= $ficheDeVie['dateReception'] ?></span>
                </div>
              </div>
              
            </div>
            <div class="col-md">
              <div class="form-group row">
                <label for="" class="col-sm-5 col-form-label"
                  >Date de mise en service</label
                >
                <div class="col-sm-7" style="align-self: center;">
                  <input
                    style="display: none"
                    type="date"
                    class="inputAffiche form-control"
                    name="dateMisService"
                    value="<?= $ficheDeVie['dateMisService'] ?>"
                  />
                  <span class="textAffiche"><?= $ficheDeVie['dateMisService'] ?></span>
                </div>
              </div>
            </div>
          </div>
          <input
            class="btn btn-primary mx-auto d-block"
            value="Modifier"
            id="btnValid"
            name ="modifierDetailEquipement"
            onclick="toggleFunc()"
            type="button"
           >
          
        </form>
      </div>
    </div>

    <div class="card" style="width: 80%;margin: auto;margin-top: 100px">
      <div class="card-header">
        Tableau des actions
        <button 
          class="btn btn-primary float-right"
          data-toggle="modal"
          data-target="#action"  onclick="ajoutAction()" 
        >
          Ajouter une action
        </button>
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
              <th>Action</th>
              <th>Date</th>
              <th>Responsable</th>
              <th>Décision</th>
              <th style="width: 15%">Paramètres</th>
            </thead>

            
        <?php while ($action= $listeActionActive->fetch()){ 
            $action['lienAction']= reecrireLienA($action['lienAction']);
            $action['lienDecision']= reecrireLienA($action['lienDecision']);
         ?>
             <tr>
              <td>
                <a  target="_blank"
                        <?php if($action['lienAction']['type']=='LINK' && $action['lienAction']['lien']!=''){ ?>
                          href="<?= $action['lienAction']['lien'] ?>"
                        <?php }elseif($action['lienAction']['type']=='FILE'){ ?>
                          href="<?= $_SESSION['url'].'telecharger/Action/'.$action['id_action'] ?>"
                        <?php } ?>
                    />
                      <?= $action['nomAction'] ?>   
                </a>
              </td>
              <td><?= $action['dateAction'] ?></td>
              <td><?= $action['responsable'] ?></td>    
              <td>
                <a  target="_blank"
                        <?php if($action['lienDecision']['type']=='LINK'){ ?>
                          href="<?= $action['lienDecision']['lien'] ?>"
                        <?php }elseif($action['lienDecision']['type']=='FILE'){ ?>
                          href="<?= $_SESSION['url'].'telecharger/Decision/'.$action['id_action'] ?>"
                        <?php } ?>
                    />
                      <?= $action['decision'] ?> 
                </a>
              </td>
              <td class="d-flex justify-content-around"> 
                <i  onclick='modifAction(<?= '"'.$action['id_action'].'","'.$action['nomAction'].'","'.$action['lienAction']['type'].'","'.$action['lienAction']['lien'].'","'.$action['dateAction'].'","'.$action['freqAction'].'","'.$action['numDocument'].'","'.$action['responsable'].'","'.$action['commentAvis'].'","'.$action['decision'].'","'.$action['lienDecision']['type'].'","'.$action['lienDecision']['lien'].'","'.$action['id_equipement'].'"' ?>)'
                  class="fas fa-pen"
                  style="color: royalblue;
                        font-size: 25px;cursor: pointer;"
                  data-toggle="modal"
                  data-target="#action"
                ></i>
                 
              </td>
             
          </tr>
       <?php ; 
} ?>
        
           
          </table>



          <div><br></div>
        </div>
        <div class="table-responsive">
          <table
            id="id_ligne"
            class="table  table-striped table-hover table-bordered table-sm"
            cellspacing="0"
            width="100%"
          >
            <thead>
              <th>Action</th>
              <th>Date</th>
              <th>numéro document</th>
              <th>Responsable</th>
              <th>commentaire et avis</th>
              <th>Décision</th>
              <th style="width: 15%">Paramètres</th>
            </thead>

            
        <?php while ($action= $listeAction->fetch()){ 
            $action['lienAction']= reecrireLienA($action['lienAction']);
            $action['lienDecision']= reecrireLienA($action['lienDecision']);
         ?>
             <tr>
              <td>
                <a  target="_blank"
                        <?php if($action['lienAction']['type']=='LINK'&& $action['lienAction']['lien']!=''){ ?>
                          href="<?= $action['lienAction']['lien'] ?>"
                        <?php }elseif($action['lienAction']['type']=='FILE'){ ?>
                          href="<?= $_SESSION['url'].'telecharger/Action/'.$action['id_action'] ?>"
                        <?php } ?>
                    />

                      <?= $action['nomAction'] ?>   
                </a>
              </td>
              <td><?= $action['dateAction'] ?></td>
              <td><?= $action['numDocument'] ?></td>
              <td><?= $action['responsable'] ?></td>
              <td><?= $action['commentAvis'] ?></td>
              <td>
                <a  target="_blank"
                        <?php if($action['lienDecision']['type']=='LINK'){ ?>
                          href="<?= $action['lienDecision']['lien'] ?>"
                        <?php }elseif($action['lienDecision']['type']=='FILE'){ ?>
                          href="<?= $_SESSION['url'].'telecharger/Decision/'.$action['id_action'] ?>"
                        <?php } ?>
                    />
                      <?= $action['decision'] ?> 
                </a>
              </td>
              <td class="d-flex justify-content-around">
                <i  onclick='modifAction(<?= '"'.$action['id_action'].'","'.$action['nomAction'].'","'.$action['lienAction']['type'].'","'.$action['lienAction']['lien'].'","'.$action['dateAction'].'","'.$action['freqAction'].'","'.$action['numDocument'].'","'.$action['responsable'].'","'.$action['commentAvis'].'","'.$action['decision'].'","'.$action['lienDecision']['type'].'","'.$action['lienDecision']['lien'].'","'.$action['id_equipement'].'"' ?>)'
                  class="fas fa-pen"
                  style="color: royalblue;
                        font-size: 25px;cursor: pointer;"
                  data-toggle="modal"
                  data-target="#action"
                ></i>
                  <i onclick="defineId(<?= $action['id_action'] ?>)" class="fas fa-minus-circle" style="color: red; font-size: 25px;cursor: pointer;"data-toggle="modal" data-target="#supprim" ></i>
                
              </td>
             
          </tr>
       <?php ; 
} ?>

           
          </table>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="action"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
       
        <form method="post" action="" id="formAction" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titre">Modal title</h5>
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
            
            <div class="row">
              <div class="col-md">
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Action</label>
                  <div class="col-sm-9" style="align-self: center;"> 
                   <div>
                    <input type="text" class="form-control" name="nomAction" id="nomAction" />

                  <div id="lienAction">
                      <div class="form-check" id="FILEaction">
                       <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienAction"
                        value="FILE"
                        id="fileAction"
                        onchange="toggleLien('lienAction')"
                      />
                      <label class="form-check-label" for="fileAction">
                        Importer un fichier
                        <input type="file" id="fichierAction" name="lienAction" class="fichier" />
                      </label>
                    </div>

                    <div class="form-check" id="LINKaction">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienAction"
                        value="LINK"
                        id="linkAction"
                        onchange="toggleFichier('lienAction')"
                      />
                      <label class="form-check-label" for="linkAction">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienAction"
                          name="lienAction"
                          placeholder="http://"
                        />
                      </label>
                    </div>
                    </div>
                  </div>
                    
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Date</label>
                  <div class="col-sm-9" style="align-self: center;">
                    <input type="date" class="form-control" id="dateAction" name="dateAction" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">fréquence</label>
                  <div class="col-sm-9 input-group form-group mx-left" style="align-self: center;">
                    <span class="input-group-text btn btn-primary" id="ActiverfreqAction" onclick="toggler(this);" >Activer</span>
                    <input type="number" class="input input-lg form-control" id="freqAction" name="freqAction" />
                    <div class="input-group-append" id=""> 
                      <span class="unit input-group-text" >mois</span>
                    </div>
                  </div>
        
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Numéro de document</label>
                  <div class="col-sm-9" style="align-self: center;">
                    <input type="text" class="form-control" id="numDocument" name="numDocument" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Responsable</label>
                  <div class="col-sm-9" style="align-self: center;">
                    <input type="text" class="form-control" id="responsable" name="responsable" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Commentaire et avis</label>
                  <div class="col-sm-9" style="align-self: center;">
                    <input type="text" class="form-control" id="commentAvis" name="commentAvis" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Décision</label>
                  <div class="col-sm-9" style="align-self: center;">
                   <div>
                    <input type="text" class="form-control" id="decision" name="decision" />

                    <div id="lienDecision">
                      <div class="form-check" id="FILEdecision">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienDecision"
                        value="FILE"
                        id="fileDecision"
                        onchange="toggleLien('lienDecision')"
                      />
                      <label class="form-check-label" for="fileDecision">
                        Importer un fichier
                        <input type="file" id="fichierDecision" name="lienDecision" class="fichier" />
                      </label>
                    </div>

                    <div class="form-check" id="LINKdecision">
                      <input
                        class="form-check-input radio"
                        type="radio"
                        name="typeLienDecision"
                        value="LINK"
                        id="linkDecision"
                        onchange="toggleFichier('lienDecision')"
                      />
                      <label class="form-check-label" for="linkDecision">
                        Lien
                        <input
                          type="text"
                          class="form-control lien"
                          id="lienDecision"
                          name="lienDecision"
                          placeholder="http://"
                        />
                      </label>
                    </div>
                    </div>
                  </div>
                
                  </div>
                </div>


              </div>
            </div>
           
          </div>
          <div class="modal-footer mx-auto">
            <input id="actionAjouter" type="submit" class="btn btn-primary w-auto" name="ajouterAction"  value="VALIDER">
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
            <span id="supprimerAction"   class="btn btn-primary">SUPPRIMER</span> 
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
<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
      var toggle = true;
     
      function toggleFunc() {
        if (toggle) {
          $(".inputAffiche").css("display", "block");
          $(".textAffiche").css("display", "none");
          $("#btnValid").val("Valider");
          toggle = false;
        } else {
          $(".inputAffiche").css("display", "none");
          $(".textAffiche").css("display", "block");
          $("#btnValid").text("Modifier");
          $("#btnValid").attr("type","submit");
          toggle = true;
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




/********/
        function defineId(id) {
        $('#supprimerAction').attr('onclick','supprimerAction('+id+')');

    }
 

   function supprimerAction(id){ 
      $.get("<?= $_SESSION['url'] ?>ficheDeVie/supprimer/"+id, function(data, status){
        window.location.reload(true);
      });
  }

  function modifAction(id_action,nomAction,typeLienAction,lienAction,dateAction,freqAction,numDocument,responsable,commentAvis,decision,typeLienDecision,lienDecision,id_equipement) {
      
      $('#nomAction').attr('value',nomAction);
      $('#dateAction').attr('value',dateAction);
      if (freqAction !=""){
        $('#freqAction').attr("disabled",false);
        $('#freqAction').attr('value',freqAction);
        ActiverfreqAction.textContent = "Desactiver";
      }else{
        $('#freqAction').attr('value','');
        $('#freqAction').attr("disabled",true);
        ActiverfreqAction.textContent = "Activer";
      }
       $('#numDocument').attr('value',numDocument);
      $('#responsable').attr('value',responsable);
       $('#commentAvis').attr('value',commentAvis);
      $('#decision').attr('value',decision);
      $('#titre').text('MODIFIER ACTION'); 
      $('#actionAjouter').attr('name','modifAction'); 
      $('#formAction').attr('action','<?= $_SESSION['url'] ?>ficheDeVie/'+id_equipement+'/'+id_action);
 
      $('#'+typeLienAction+'action input[name="typeLienAction"]').attr('checked','checked');
      $('#'+typeLienAction+'action input[name="lienAction"]').attr('value',lienAction);
      if(typeLienAction=='FILE') toggleLien('lienAction');
       else if(typeLienAction=='LINK') toggleFichier('lienAction');
      $('#'+typeLienDecision+'decision input[name="typeLienDecision"]').attr('checked','checked');
      $('#'+typeLienDecision+'decision input[name="lienDecision"]').attr('value',lienDecision);
      if(typeLienDecision=='FILE') toggleLien('lienDecision');
       else if(typeLienDecision=='LINK') toggleFichier('lienDecision');
  }
function ajouterNouveauAction(id_action,nomAction,typeLienAction,lienAction,dateAction,freqAction,responsable,decision,typeLienDecision,lienDecision,id_equipement) {
      
      $('#nomAction').attr('value',nomAction);
      $('#dateAction').attr('value',dateAction);
      if (freqAction !=""){
      $('#freqAction').attr("disabled",false);
      $('#freqAction').attr('value',freqAction);
      ActiverfreqAction.textContent = "Desactiver";
     
       }else{
      $('#freqAction').attr('value','');
      $('#freqAction').attr("disabled",true);
      ActiverfreqAction.textContent = "Activer";
       }
      $('#numDocument').attr('value',numDocument);
      $('#responsable').attr('value',responsable);
       $('#commentAvis').attr('value',commentAvis);
      $('#decision').attr('value',decision);
      $('#titre').text('AJOUTER ACTION'); 
      $('#actionAjouter').attr('name','ajouterAction'); 
      $('#form').attr('action','#');
 
      $('#'+typeLienAction+'action input[name="typeLienAction"]').attr('checked','checked');
      $('#'+typeLienAction+'action input[name="lienAction"]').attr('value',lienAction);
      if(typeLienAction=='FILE') toggleLien('lienAction');
       else if(typeLienAction=='LINK') toggleFichier('lienAction');
     $('#'+typeLienDecision+'decision input[name="typeLienDecision"]').attr('checked','checked');
      $('#'+typeLienDecision+'decision input[name="lienDecision"]').attr('value',lienDecision);
      if(typeLienDecision=='FILE') toggleLien('lienDecision');
       else if(typeLienDecision=='LINK') toggleFichier('lienDecision');
  }

  function ajoutAction(){
      $('#nomAction').attr('value','');
      $('#lienAction').attr('value','');
      $('#dateAction').attr('value','');
      $('#freqAction').attr('value','');
      $('#freqAction').attr("disabled", true);
      $('#numDocument').attr('value','');
      $('#responsable').attr('value','');
      $('#commentAvis').attr('value','');
      $('#decision').attr('value','');
      $('#lienDecision').attr('value','');
      $('#titre').text('AJOUTER ACTION');
      $('#actionAjouter').attr('name','ajouterAction'); 
      $('#form').attr('action','#');
    }
   
 
    function toggler(val){
    if(val.textContent=="Activer"){
      $('#freqAction').val('');
      $('#freqAction').attr("disabled", false);
      val.textContent = "Desactiver";
    }
    else{
      $('#freqAction').attr("disabled", true);
      val.textContent = "Activer";
      $('#freqAction').val('');
    }
  }
   
</script>
<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>