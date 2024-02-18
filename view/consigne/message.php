<?php ob_start(); ?>
<div class="bodyMessage">
    <div class="topMessage border-bottom p-2 <?= (!$reponse)?'position-fixed" style="top:0;z-index: 1000;':''; ?>">
        <?php if(!$reponse && $msg['id_sender']!=-1){ ?>
            <button class="btn btn-primary float-right" onclick="openModal()">REPONDRE</button>
        <?php } ?>
        <?php if($msg['id_sender']!=-1){ ?>
        <span class="topMessageTitle"> <Strong><?= $msg['etatConsigne'] ?></Strong> </span>
        <br>
        <?php } ?>
        <span class="topMessageDate"><?= $msg['tempEnvoiMsg'] ?></span>
        <br>
        <span class="topMessageExped"><?= $msg['nomComplet'] ?>, <?= $msg['login'] ?></span>
        <br>
        <span class="topMessageTitle"> <Strong><?= $msg['objetMsg'] ?></Strong> </span>
        <br>
        <?php if($msg['id_sender']!=-1){ ?>
        <span class="topMessageRecev">À
          <?php while ($recev=$usersMsgRecev->fetch())echo $recev['login'].";"; ?>
        </span>
        <br>
        <?php } ?>
        <?php if($msg['jointMsg']!=''){ ?>
            
            <span class="joint">joint: <a href="telechargement/<?= sizeof($_SESSION['file'])-1 ?>"><?= $_SESSION['file'][sizeof($_SESSION['file'])-1]['origine'] ?></a></span>
            <style>.bodyMessage{top: 167px !important;}</style>
        <?php } ?>
        <?php if($msg['id_sender']==-1){ ?>
            <style>.bodyMessage{top: 105px !important;}</style>
        <?php } ?>
    </div>
    <div><?= htmlspecialchars_decode($msg['corpMsg']) ?></div>
        
</div>
<div class="w-100"></div>

<?php $content.= ob_get_clean(); ?>







