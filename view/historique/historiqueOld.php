<?php $title='historique' ?>

<?php ob_start(); ?>
<div class="modal-body"  style="background-color:#F0F0F0;">
<?php
  $passage= $listePassage->fetch();
  if(!$passage) {echo '<h3 class="text-center w-100 mb-3">votre résultat est vide</h3>'; }
  while ($passage) {
?>
    <h1 class="text-center w-100 mb-3"><?= nomProduit($passage['id_prod']) ?></h1>
    <div class="table-responsive">
    <table id="id_ligne" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%">
      <thead>
       <tr>
        <th class='titleTab' rowspan="2" >Num.</th>
        <th class='titleTab' rowspan="2">Heure</th>
        <th class='titleTab' rowspan="2">Etat</th>
        <th class='titleTab' rowspan="2">Groupe</th>
  <?php
    $listN=$tabMoyenne=$minMax='';
    $sortie['listN']=$sortie['tabMoyenne']=$sortie['minMax']='';
    
    $listeNormeP1= recupNormeProduit($passage['id_prod'],null,1);
    $listeNormeP2= recupNormeProduit($passage['id_prod'],null,2);
    $numPassage=1;

    $sortie1= afficheNorme($listeNormeP1,$passage['id_prod'],$sortie);
    $sortie2= afficheNorme($listeNormeP2,$passage['id_prod'],$sortie);
var_dump($sortie1);var_dump($sortie2);    
    $listN= explode(',', $sortie1['listN'].$sortie2['listN']);
    $tabMoyenne= explode(',', $sortie1['tabMoyenne'].$sortie2['tabMoyenne']);
    $minMax= explode(',', $sortie1['minMax'].$sortie2['minMax']);

    $prod = $passage['id_prod'];
  ?>      
        <th class="titleTab" rowspan="2">Observation</th>
       </tr>
      </thead>
      <tbody>
  <?php while ($prod == $passage['id_prod']) { ?>
        <tr>
          <th class="border"><?= $numPassage ?></th>
          <th class="border"><?= explode(' ',$passage['dateHeure'])[1] ?></th>
          <th class="border"><?= $passage['etatPassage'] ?></th>
          <th class="border"><?= $passage['groupeUser'] ?></th>
    <?php for($i=0;$i<sizeof($listN)-1;$i++){ ?>
      <?php
        $valNorm= recupValNorm($passage['id_passage'],$listN[$i]);
        if($tabMoyenne[$i]!='null')$tabMoyenne[$i]+= $valNorm;
        if(strlen($valNorm)>10){
      ?>
          <td class="border" style="<?= verifValNorme($valNorm,$minMax[$i]) ?>" data-toggle="popover" data-trigger="hover" data-content="<?= $valNorm ?>" ><?= substr($valNorm,0,10) ?>...</td>
      <?php }else{ ?>
          <td class="border" style="<?= verifValNorme($valNorm,$minMax[$i]) ?>" ><?= $valNorm ?></td>
      <?php } ?>
    <?php } ?>
      <?php if(strlen ($passage['observation'])>15){ ?> 
          <th class="border" href="#" data-toggle="popover" data-trigger="hover" data-content="<?= $passage['observation'] ?>"><?= substr($passage['observation'],0,15); ?>...</th>
      <?php }else{ ?>
          <th class="border"><?= $passage['observation'] ?></th>
      <?php } ?>
        </tr>
      <?php 
          $passage= $listePassage->fetch();
          $numPassage++;
        } 
      ?>
        <tr>
          <th colspan="4" class="groupeN text-center" style="background-color:#7b7a7a" >Moyenne</th>
         <?php for($i=0;$i<sizeof($tabMoyenne)-1;$i++){ ?>
          <?php if($tabMoyenne[$i]!='null') $myn= number_format($tabMoyenne[$i]/($numPassage-1), 2, ',', ''); else $myn= '-'; ?>
          <th class="groupeN text-center" style="background-color:#7b7a7a; <?= verifValNorme($myn,$minMax[$i]) ?>" ><?= $myn ?></th>
         <?php } ?>
        </tr>
      </tbody>
    </table>
    </div>

<?php } ?>
</div>

   
<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php') ?>

<script>
  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
  });
</script>

<?php
  function afficheNorme($listeNormeP,$id_prod,$sortie,$source=''){
    //global $listN,$tabMoyenne,$minMax;
    //$listN=$tabMoyenne=$minMax='';

    while ($norme = $listeNormeP->fetch()) { 
      if($norme['typeNorme']!='groupe'){
        $sortie['listN'] .= $norme['id_norme'].",";
        $sortie['minMax'] .= verifNorme($norme).",";
        if($norme['typeNorme']!='booleen' && $norme['typeNorme']!='texte')$sortie['tabMoyenne'].='0,';
         else $sortie['tabMoyenne'].='null,';
  ?>
        <th class='titleTab' rowspan="2" data-toggle="popover" data-trigger="hover" data-content="<?= $source.'>'.$norme['nomNorme'] ?>" ><?= $norme['nomNorme'] ?></th>
  <?php
      }else{
    ?>
    <?php
        $listeNormeG= recupNormeProduit($id_prod,$norme['id_norme']);
        
        $sortie= afficheNorme($listeNormeG,$id_prod,$sortie,$source.'>'.$norme['nomNorme']);
      }
   }
   //$sortie['listN']=$listN;$sortie['tabMoyenne']=$tabMoyenne;$sortie['minMax']=$minMax;
   return $sortie;
  } 
