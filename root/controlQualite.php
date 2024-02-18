<?php 
	
	if(isset($_GET['action'])){
		if($_GET['action']=='traitementImage'){
			require('view/controlQualite/traitementImage.html');
		}
		else require('view/controlQualite/index.php');
	}
	else require('view/controlQualite/index.php');