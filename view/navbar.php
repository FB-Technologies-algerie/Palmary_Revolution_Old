    <!--NAVIGATION-->
<nav id="nav"> 
    <a href="<?= $_SESSION['url'] ?>"><img src="<?= $_SESSION['url'] ?>public/img/palmarylogo.png" class="float-left" id="logo"></a><span class="text-white">v2.2</span>
  <a class="deconnexionBTN btn btn-secondary float-right" href="<?= $_SESSION['url'] ?>deconnexion">DECONNEXION</a>
   <a class="deconnexionIcon"  href="<?= $_SESSION['url'] ?>deconnexion"><i class="fas fa-sign-out-alt fa-2x"></i></a>
   <strong class="float-right display-block text-white mr-3 mt-1 ml-2" style="text-transform: uppercase;">
                                 <strong class="float-right display-block text-white mr-3 mt-1 ml-2" style="text-transform: uppercase;">
                                 <a  href=""  class="mb-1 text-white" data-toggle="modal" data-target="#modifProfil"  onclick="definLogin('change')"   ><?= $_SESSION['nom'] ?></a>
                </strong> 
                <?php if(isset($_SESSION['groupe']) && $_SESSION['groupe']!=""){ ?>
                               <br>
                               <label style="font-size: 12px;">GROUPE:<?= $_SESSION['groupe'] ?></label>
                <?php } ?>
                </strong> 
        <a href="<?= $_SESSION['url'] ?>consigne" class="topNavbarMessage mt-2 btn btn-light float-right p-0 pt-1 mr-2 rounded-circle" style="color: #333"> <i class="fas fa-tasks topNavbarMessageIcon "></i>  <span class="badge badgeMessage"></span></a>
     <?php if($_SESSION['type']=='admin' || $_SESSION['type']=='control'){ ?>
        <a href="<?= $_SESSION['url'] ?>historique" class="topNavbarMessage mt-2 btn btn-light float-right p-0 pt-1 mr-2 rounded-circle" style="color: #333"><i class="fas fa-history"></i></a>
     <?php } ?>
     <?php if($_SESSION['type']=='admin' ){ ?>
      <a href="<?= $_SESSION['url'] ?>reporting" class="topNavbarMessage mt-2 btn btn-light float-right p-0 pt-1 mr-2 rounded-circle" style="color: #333"><i class="far fa-clipboard"></i></a>
      
     <?php } ?> 
      
      
       <div class="modal fade" id="modifProfil" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog ">
              <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="titremodifier">MODIFIER LOGIN OU MOT DE PASSE </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">    
                  <form method="post" id="form" action="<?= $_SESSION['url'] ?>modifierLoginMot">
                  
                    <div id="LDP_modif" class="row"> 
                            <div  class="col-3" >Login</div>
                            <input class="col-7" required type="text" name="nomUser" id="nomUser" class="input form-control ml-2" value="">

                    </div>
                    <br>

                    <div id="LDP_modif" class="row"> 
                            <label  class="col-3" >Mot de passe</label>


                   <span class="input-group-text btn btn-primary" id ="change"  onclick="toggler('mdpUser',this);">Modifier</span>

                            <input  class="col-6" required type="password" id="mdpUser" name="mdpUser" class="input form-control ml-2"  value="">

                        </div>

                    <br>
                    <div class="modal-footer d-block text-center">

                      <input type="submit" name="valider" class="btn btn-primary w-auto" onclick="modifierLogin()" value="VALIDER">

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">ANNULER</button> 

                    </div>

                  </form>

                </div>

              </div>

            </div>

   </div>
 <script>
    notification();
  setRequest();

  function setRequest(){
     var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "<?= $_SESSION['url'] ?>consigne/notificationMsg", false);
    xhttp.send();
  
    var reponse= xhttp.responseText;
    if(reponse==0){
      document.querySelector('.badgeMessage').hidden = true
      document.querySelector('.topNavbarMessageIcon').style.marginRight = "8px";
    }else{
      document.querySelector('.badgeMessage').hidden = false
      document.querySelector('.topNavbarMessageIcon').style.marginRight = "0px";
      document.querySelector('.badgeMessage').textContent = reponse;
    }
  }

  function notification() {
    setTimeout(function () {
        setRequest();

        notification();
    }, 3000);
  } 

   function definLogin(val){
 
 $('#nomUser').attr('value','<?=$_SESSION["login"]?>');
  $('#'+val).text('Modifier');
  $('#mdpUser').prop( "disabled", true );
  $('#mdpUser').val('000000');
}

 
  function toggler(id,val){
    if(val.textContent=="Modifier"){
      $('#'+id).val('');
      $('#'+id).attr("disabled", false);
      val.textContent = "Annuler"
    }
    else{
      $('#'+id).attr("disabled", true);
      val.textContent = "Modifier";
      $('#'+id).val('000000');
    }

  }
 </script>
 <style type="text/css">
   .topNavbarMessage{
    color: #333;
    border-radius: 15px;
    background-color: white;
    height: 40px ;
    width: 40px;
}

.topNavbarMessageIcon{
    margin-left: 8px;
    margin-top: 4px;
}

.badgeMessage{
      color: white;
    background: red;
    position: relative !important;
    top: -18px !important;
    left: -9px;
    width: 19px;
    text-align: center;
    margin-left: 2px;
}
 </style>
</nav>

