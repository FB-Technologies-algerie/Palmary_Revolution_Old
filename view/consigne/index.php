<?php $title="Consigne" ?>
<?php $style='<link rel="stylesheet" href="'.$_SESSION['url'].'public/css/consigne.css">'; ?>

<?php ob_start(); ?> 

<?php require('view/navbar.php') ?>

<div class="card cardMessagerie">
    <div class="card-header p-0" style="background-color:#E8E8E8;">
        <strong class="text-center d-block">MES CONSIGNES</strong> 
        <button onclick="doIt()" id="nouveauMsg" class="btn btn-primary float-right mr-2 <?= ($_SESSION['type']!='admin')? 'd-none': '' ?>" data-toggle="modal" data-target="#envoyeMessage"><i class="fas fa-tasks"></i> NOUVELLE CONSIGNE</button>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="recu-tab" data-toggle="tab" href="#p0" role="tab" aria-controls="recu" aria-selected="true"><?= $p0['titre'] ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="envoye-tab" data-toggle="tab" href="#p1" role="tab" aria-controls="envoye" aria-selected="true"><?= $p1['titre'] ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="envoye-tab" data-toggle="tab" href="#p2" role="tab" aria-controls="envoye" aria-selected="true"><?= $p2['titre'] ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="envoye-tab" data-toggle="tab" href="#p3" role="tab" aria-controls="envoye" aria-selected="true"><?= $p3['titre'] ?></a>
            </li>     
        </ul>
    </div>

    <div class="card-body cardbodyMessagerie p-0">
        <div class="row rowMessagerie m-0">
            <div class="col-md-4 p-0 colListe">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="p0" role="tabpanel" aria-labelledby="recu-tab">
                    <div class="list-group" id="listMessage">
                         <?php afficheList($p0['list'],$p0['type']); ?>
                    </div>
                  </div>
                    <div class="tab-pane fade" id="p1" role="tabpanel" aria-labelledby="envoye-tab">
                      <div class="list-group" id="listMessage">
                           <?php afficheList($p1['list'],$p1['type']); ?>    
                        </div>
                    </div>
                    <div class="tab-pane fade" id="p2" role="tabpanel" aria-labelledby="envoye-tab">
                      <div class="list-group" id="listMessage">
                           <?php afficheList($p2['list'],$p2['type']); ?>    
                        </div>
                    </div>
                    <div class="tab-pane fade" id="p3" role="tabpanel" aria-labelledby="recu-tab">
                      <div class="list-group" id="listMessage">
                         <?php afficheList($p3['list'],$p3['type']); ?>
                      </div>
                  </div>
                </div>             
            </div>
            <iframe id="iframeMessage" src="" class="col-md-8 d-none d-md-block p-0 pl-2 colMessage"></iframe>
        </div>
    </div>
</div>


     <!--Envoyé message-->
     <div class="modal fade" id="envoyeMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: auto;">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Envoie Message</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <iframe id="iframeFormMsg" style="height: 80vh;width: 100%;" src="" class="embed-responsive-item" frameborder="0"></iframe>
                </div>
              </div>
            </div>

      </div>




         <div class="modal fade" id="voirMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
               <form method="post" action="">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body p-0">
                <iframe frameborder="0" id=responsiveMessage style="width: 100%; height: 70vh" src="/revolution/consigne/2"></iframe>
                  
                </div>
              
              </form>
            </div>
          </div>
        </div>


    
<?php $content= ob_get_clean(); ?>

<?php ob_start(); ?>
    
  <script>
    function state(val){
            try{
                document.querySelector('.list-group-item.list-group-item-action.active').className= "list-group-item list-group-item-action";
            }catch(e){}
            val.className="list-group-item list-group-item-action active";
            document.getElementById('iframeMessage').setAttribute("src", "<?= $_SESSION['url'] ?>consigne/"+val.id);
            document.getElementById('responsiveMessage').setAttribute("src", "<?= $_SESSION['url'] ?>consigne/"+val.id);
            if(window.innerWidth<=768){
              $('#voirMessage').modal('show');
            }
            else if(window.innerWidth>=768){
              $('#voirMessage').modal('hide');
            }

        }

      function doIt(){
        $('#voirMessage').modal('hide');
        $('#iframeFormMsg').attr('src','<?= $_SESSION['url'] ?>consigne/envoiMsg');
      }

      function refresh() {
        setTimeout(function () {
          window.location.reload()
        }, 1000);
      }
    </script>

<?php $scriptJS= ob_get_clean(); ?>
<?php require('view/gabarit.php'); ?>


<?php 
  function afficheList($list,$type='reçu'){
    if($type=='reçu'){
      while ($message= $list->fetch()){ ?>
        <a href="#" id="<?= $message['id_message'] ?>" onclick="state(this);" class="list-group-item list-group-item-action <?php if($message['etatMsg']=='nonLu') echo 'nonLu' ?> mb-1">
            <span class="topMessageExped"><?= $message['nomComplet'] ?>, <?= $message['login'] ?></span>
            <br>
            <span class="topMessageTitle"> <Strong><?= $message['objetMsg'] ?></Strong> </span>
            <br>
            <span class="topMessageDate float-right"><?= $message['tempEnvoiMsg'] ?></span>
          </a>
<?php } 
    }else{
      while ($message= $list->fetch()){ ?>
        <a href="#" id="<?= $message['id_message'] ?>" onclick="state(this);" class="list-group-item list-group-item-action mb-1">
          <span class="topMessageExped">
            <?php
              $usersRecev= recupUsersRecept($message['id_message'],3);
              while ($recev=$usersRecev->fetch())echo $recev['login'].",";
            ?>
          </span>
          <br>
          <span class="topMessageTitle"> <Strong><?= $message['objetMsg'] ?></Strong> </span>
          <br>
          <span class="topMessageDate float-right"><?= $message['tempEnvoiMsg'] ?></span>
        </a>
<?php } 
    }
  }
