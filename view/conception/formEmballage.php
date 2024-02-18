<?php $title="modification d'un emballage de produit" ?>

<?php ob_start(); ?> 

<div id="bodylignesP" >
<!-- <div id="bodyAdmin"> -->
 <?php require('view/navbar.php') ?>

    <h1 class="display-block mt-3 display-5 text-white" style="text-align: center;"><?= $emballage['nomEmballage'] ?></h1>
    <div class="d-block text-right mr-5">
                      <button class="btn btn-primary mr-5 mt-4" onclick="window.print();">IMPRIMER</button>

          </div>


    <div class="card">
        <div class="card-header" style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;"><span class="cardTitle">PRODUIT</span></div>
        <div class="card-body">
            <form method="post" action="">
                   <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nom du Produit</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="nomEmballage" class="form-control" value="<?= $emballage['nomEmballage'] ?>" placeholder="">
                                    </div>
                            </div>
                    <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Code article</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="codeArticle" value="<?= $emballage['codeArticle'] ?>" class="form-control" placeholder="">
                                    </div>
                    </div>
                    <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Code à barre</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="codeBarre" value="<?= $emballage['codeBarre'] ?>" class="form-control" placeholder="">
                                    </div>
                            </div>
                    <input type="submit" class="btn btn-primary mx-auto" name="valider" style="width:auto !important;display:block" value="ENREGISTRER">
            </form>
               
        </div>
    </div>
    
    <div class="card">
      <div class="card-header"  style="background-color:#D3D3D3; font-size:15px;border-top-left-radius: 15px;border-top-right-radius: 15px;">
         <span class="cardTitle" >TRADUCTION</span> 
           
      </div>
      <div class="card-body pt-3">

       <div class="form-group row">
              <label  class="col-sm-2 col-form-label">Français</label>
              <div class="col-sm-10">
              <textarea id="francais" onchange="traduire(<?= $emballage['id_emballageProd'] ?>)" class="w-100"><?= $emballage['listeIngrediants'] ?></textarea>
             </div>
        </div>

         <div class="form-group row">
              <label  class="col-sm-2 col-form-label">Anglais</label>
              <div class="col-sm-10">
              <textarea id="anglais" class="w-100" disabled></textarea>
              </div>
        </div>

         <div class="form-group row">
              <label  class="col-sm-2 col-form-label">Arabe</label>
              <div class="col-sm-10">
              <textarea id="arabe" style="direction: rtl;" class="w-100 text-right" disabled></textarea>
              </div>
        </div>

         <div class="form-group row">
              <label  class="col-sm-2 col-form-label">Espagnol</label>
              <div class="col-sm-10">
              <textarea id="espagnol" class="w-100" disabled></textarea>
              </div>
        </div>

        <div class="form-group row">
              <label  class="col-sm-2 col-form-label">Portugais</label>
              <div class="col-sm-10">
              <textarea id="portugais" class="w-100" disabled></textarea>
              </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function refresh() {
    setTimeout(function () {
      window.location.reload()
    }, 500);
  }
  function envoiList(id_emballageProd ,listeIngrediants) {
            var xhttp;
            xhttp = new XMLHttpRequest();
            
            xhttp.open("POST", "<?= $_SESSION['url'] ?>formEmballage/traduire", false);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('listeIngrediants='+listeIngrediants+'&id_emballageProd='+id_emballageProd);

            var reponse= xhttp.responseText;
            
            reponse =reponse.split(';@;');
            document.getElementById('anglais').value =reponse[0];
            document.getElementById('arabe').value =reponse[1];
            document.getElementById('espagnol').value =reponse[2];
            document.getElementById('portugais').value =reponse[3];
  }
  if(document.getElementById('francais').value!="")document.getElementById('francais').onchange();

  function traduire(id_emballageProd) {
    if(document.getElementById('francais').value==""){
      document.getElementById('anglais').disabled =true;
      document.getElementById('arabe').disabled =true;
      document.getElementById('espagnol').disabled =true;
      document.getElementById('portugais').disabled =true;

    }
    else{
      document.getElementById('anglais').disabled =false;
      document.getElementById('arabe').disabled =false;
      document.getElementById('espagnol').disabled =false;
      document.getElementById('portugais').disabled =false;
    }
    envoiList(id_emballageProd,document.getElementById('francais').value);
    remplir();
  }

</script>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>