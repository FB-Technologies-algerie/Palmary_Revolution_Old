<section>
        <button id="btnValid" class="btn btn-primary btn-block mx-auto m-5 w-auto p-3" onclick="recap(true)" data-toggle="modal" >PUBLIER LE PASSAGE</button>
        
        <div class="modal fade" id="recap" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel">RECAPITULATION</h5>
                  <button type="button" class="close" id="modalCloseBTN" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" style="background-color:#EAEAEA;">
                       <div id="recap" class="">
                         <h1 class="text-center w-100 mb-3">PRODUIT</h1>

                          <div class="row w-75 mx-auto">
                           <div class="col-md p-0" id="colLeftProduit"></div>
                            <div class="col-md p-0" id="colRightProduit"></div>
                          </div>
                       </div>
                  <form id="form" action="<?= $_SESSION['url'] ?>ficheControle/terminePassage/<?= $passage['id_passage'] ?>" method="post">
                    <input type="hidden" name="form_submitted" value="true">
                    <div class="form-group mt-3 w-75 mx-auto">
                      <label for="comment">Observation:</label>
                      <textarea name='comment' class="form-control" rows="5" id="comment"></textarea>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" id = "passage_id" name="passage_id" value="<?= $passage['id_passage'] ?>">
                      <input type="submit" class="btn btn-primary mx-auto" value="Terminer le passage">
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
    
</div>
    </section>
</div>

<script type="text/javascript">
    // select all input
   
   

// champ produit
var champProduit = document.querySelectorAll('#champProduit');
// button


var recapLigneHtml;
var recapProduitHtml;
var recapLigneHtmlFonction;
var recapProduitHtmlFonction;

// carte produit
var cardProduit = document.getElementById('Carte_Produit');
var produitHtml;
var checkSpan;

function recap(isValid){
//var isValid =true;
  if(isValid!=null) $("input.actif").each(function() {
                     var element = $(this);
                     if(element.val() == ""){
                       isValid =false;
                     }
                    });
  
  if(isValid==false){
    alert("Veuillez remplir tous les champs avant de pouvoir confirmer");
    $('#recap').modal('hide');
  
  }
  else{
      $('#recap').modal('show');
  
     if(cardProduit != null){
      produitHtml =``;
  
      for (i=0 ; i<champProduit.length ; i++) {
  
        if(champProduit[i].getElementsByTagName('span')[0] == undefined){
          checkSpan="";
        }
        else{
          checkSpan=champProduit[i].getElementsByTagName('span')[0].textContent;
        }
  
  
          produitHtml += `<p class=""><strong>`+champProduit[i].getElementsByClassName('label')[0].textContent+`:</strong> `+champProduit[i].getElementsByTagName('input')[0].value+` `+checkSpan+`</p>`
      
      }
      recapProduitHtml = document.getElementById('colLeftProduit');
      recapProduitHtml.innerHTML =produitHtml;
  
      var produitHtmlFonction = ``;
  
      for (i=0 ; i<cardProduit.querySelectorAll('.nomNorme').length ; i++) {
          
        produitHtmlFonction += `<p class=""><strong>`+cardProduit.querySelectorAll('.nomNorme')[i].textContent+`</strong> `+cardProduit.querySelectorAll('#fonction')[i].getElementsByTagName('input')[0].value+` `+cardProduit.querySelectorAll('#fonction')[i].getElementsByTagName('span')[0].textContent+`</p>`;
      
      }
      recapProduitHtmlFonction = document.getElementById('colRightProduit');
      recapProduitHtmlFonction.innerHTML =produitHtmlFonction;  
  }

  }  
}
   
</script>

<script type="text/javascript">
   function submitForm(event) {
    event.preventDefault();

    var form = document.getElementById('form');
    
    var passageIdField = document.getElementById('passage_id');
    if (!passageIdField) {
        console.error("Le champ de l'ID de passage n'a pas été trouvé !");
        alert("Le champ de l'ID de passage n'a pas été trouvé !");
        return;
    }
    
    var passageId = passageIdField.value;
    if (!passageId) {
        console.error("L'ID de passage n'a pas été trouvé !");
        alert("L'ID de passage n'a pas été trouvé !");
        return;
    }

    // Créer un objet FormData pour envoyer les données du formulaire
    var formData = new FormData(form);
    // Ajouter l'ID de passage à l'objet FormData
    formData.append('id_passage', passageId);
    // Modifier l'action du formulaire avec l'URL du script PHP
    form.action = 'upload_passage.php';
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log("Le passage a été terminé avec succès !");
        } else {
            console.error("Erreur lors de la requête AJAX");
            alert("Une erreur est survenue lors du traitement du passage.");
        }
    };
    xhr.onerror = function () {
        console.error("Erreur lors de la connexion au serveur");
        alert("Une erreur est survenue lors de la connexion au serveur.");
    };
    xhr.send(formData);
}
</script>
