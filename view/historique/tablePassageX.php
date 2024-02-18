<?php $title="les passages du ".$nomProduit; ?>

<?php ob_start();
  if($passage= $listePassage->fetch()) {
?>
    <div class="table-responsive">
    <table id="<?= $nomProduit ?>" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%">
      <thead>
       <tr>
        <th class='titleTab' rowspan="2" >Num.</th>
        <th class='titleTab' rowspan="2">Heure</th>
        <th class='titleTab' rowspan="2">Etat</th>
    <?php if($typeUser=='admin') { ?>
        <th class='titleTab' rowspan="2" >Controleur</th>
    <?php } ?>
        <th class='titleTab' rowspan="2">Groupe</th>
  <?php
    //$listN=$tabMoyenne=$minMax='';
    $sortie['listN']=$sortie['tabMoyenne']=$sortie['minMax']='';
    
    $listeNormeP1= recupNormeProduit($passage['id_prod'],null,1);
    $listeNormeP2= recupNormeProduit($passage['id_prod'],null,2);
    $numPassage=1;

    $sortie1= afficheNorme($listeNormeP1,$passage['id_prod'],$sortie);
    $sortie2= afficheNorme($listeNormeP2,$passage['id_prod'],$sortie);
    
    $listN= explode(',', $sortie1['listN'].$sortie2['listN']);
    $tabMoyenne= explode(',', $sortie1['tabMoyenne'].$sortie2['tabMoyenne']);
    $minMax= explode(',', $sortie1['minMax'].$sortie2['minMax']);
    $divMoyenne= array_fill(0, sizeof($listN), 0);

  ?>      
        <th class="titleTab" rowspan="2">Observation</th>
       </tr>
      </thead>
      <tbody>
  <?php while ($passage) { ?>
        <tr>
          <th class="border"><?= $numPassage ?></th>
          <th class="border text-center"><?= $passage['dateHeure'] ?></th>
          <th class="border"><?= $passage['etatPassage'] ?></th>
        <?php if($typeUser=='admin') { ?>
          <th class="border"><?= $passage['nomComplet'] ?></th>
        <?php } ?>
          <th class="border"><?= $passage['groupeUser'] ?></th>
    <?php for($i=0;$i<sizeof($listN)-1;$i++){ ?>
      <?php
        $valNorm= recupValNorm($passage['id_passage'],$listN[$i]);
        if($tabMoyenne[$i]!='null' && !is_null($valNorm) && $valNorm!='' && $valNorm!=0){
          $tabMoyenne[$i]+= $valNorm;
          $divMoyenne[$i]++;
        }
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
          <th colspan="<?= ($typeUser=='admin')? '5' : '4' ?>" class="groupeN text-center" style="background-color:#7b7a7a" >Moyenne</th>
         <?php for($i=0;$i<sizeof($tabMoyenne)-1;$i++){ ?>
          <?php if($tabMoyenne[$i]!='null' && $divMoyenne[$i]>0) $myn= number_format($tabMoyenne[$i]/($divMoyenne[$i]), 2, ',', ''); else $myn= '-'; ?>
          <th class="groupeN text-center" style="background-color:#7b7a7a; <?= verifValNorme($myn,$minMax[$i]) ?>" ><?= $myn ?></th>
         <?php } ?>
        </tr>
      </tbody>
    </table>
    </div>

<?php } ?>

<?php $content= ob_get_clean(); ?>
<?php require('view/gabarit.php'); ?>

<?php if($_GET['v1']=='csvPassage') { ?>
  
  <script type="text/javascript">
	var xport = {
  _fallbacktoCSV: true,  
  toXLS: function(tableId, filename) {   
    this._filename = (typeof filename == 'undefined') ? tableId : filename;
    
    //var ieVersion = this._getMsieVersion();
    //Fallback to CSV for IE & Edge
    if ((this._getMsieVersion() || this._isFirefox()) && this._fallbacktoCSV) {
      return this.toCSV(tableId);
    } else if (this._getMsieVersion() || this._isFirefox()) {
      alert("Not supported browser");
    }

    //Other Browser can download xls
    var htmltable = document.getElementById(tableId);
    var html = htmltable.outerHTML;

    this._downloadAnchor("data:application/vnd.ms-excel" + encodeURIComponent(html), 'xls'); 
  },
  toCSV: function(tableId, filename) {
    this._filename = (typeof filename === 'undefined') ? tableId : filename;
    // Generate our CSV string from out HTML Table
    var csv = this._tableToCSV(document.getElementById(tableId));
    // Create a CSV Blob
    var blob = new Blob([csv], { type: "text/csv" });

    // Determine which approach to take for the download
    if (navigator.msSaveOrOpenBlob) {
      // Works for Internet Explorer and Microsoft Edge
      navigator.msSaveOrOpenBlob(blob, this._filename + ".csv");
    } else {      
      this._downloadAnchor(URL.createObjectURL(blob), 'csv');      
    }
  },
  _getMsieVersion: function() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf("MSIE ");
    if (msie > 0) {
      // IE 10 or older => return version number
      return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)), 10);
    }

    var trident = ua.indexOf("Trident/");
    if (trident > 0) {
      // IE 11 => return version number
      var rv = ua.indexOf("rv:");
      return parseInt(ua.substring(rv + 3, ua.indexOf(".", rv)), 10);
    }

    var edge = ua.indexOf("Edge/");
    if (edge > 0) {
      // Edge (IE 12+) => return version number
      return parseInt(ua.substring(edge + 5, ua.indexOf(".", edge)), 10);
    }

    // other browser
    return false;
  },
  _isFirefox: function(){
    if (navigator.userAgent.indexOf("Firefox") > 0) {
      return 1;
    }
    
    return 0;
  },
  _downloadAnchor: function(content, ext) {
      var anchor = document.createElement("a");
      anchor.style = "display:none !important";
      anchor.id = "downloadanchor";
      document.body.appendChild(anchor);

      // If the [download] attribute is supported, try to use it
      
      if ("download" in anchor) {
        anchor.download = this._filename + "." + ext;
      }
      anchor.href = content;
      anchor.click();
      anchor.remove();
  },
  _tableToCSV: function(table) {
    // We'll be co-opting `slice` to create arrays
    var slice = Array.prototype.slice;

    return slice
      .call(table.rows)
      .map(function(row) {
        return slice
          .call(row.cells)
          .map(function(cell) {
            return '"t"'.replace("t", cell.textContent);
          })
          .join(";");
      })
      .join("\r\n");
  }
};

$(document).ready(function(){
	xport.toCSV('<?= $nomProduit ?>');
});

</script>
<?php } ?>

<?php
  function afficheNorme($listeNormeP,$id_prod,$sortie,$source=''){

    while ($norme = $listeNormeP->fetch()) { 
      if($norme['typeNorme']!='groupe'){
        $sortie['listN'] .= $norme['id_norme'].",";
        $sortie['minMax'] .= verifNorme($norme).",";
        if($norme['typeNorme']!='booleen' && $norme['typeNorme']!='texte')$sortie['tabMoyenne'].='0,';
         else $sortie['tabMoyenne'].='null,';
    ?>
        <th class='titleTab' rowspan="2" data-toggle="popover" data-trigger="hover" data-content="<?= $source.' >'.$norme['nomNorme'] ?>" ><?= $norme['nomNorme'] ?></th>
    <?php
      }else{
    ?>
    <?php
        $listeNormeG= recupNormeProduit($id_prod,$norme['id_norme']);
        
        $sortie= afficheNorme($listeNormeG,$id_prod,$sortie,$source.' >'.$norme['nomNorme']);
      }
   }

   return $sortie;
  }
