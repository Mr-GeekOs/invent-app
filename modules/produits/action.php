
<?php

if (!empty($_POST['action'])) { $action = trim( strip_tags( html_entity_decode( addslashes( $_POST['action'] ) , ENT_QUOTES) ) ); }
else { $action = trim( strip_tags( html_entity_decode( addslashes($_GET['action']), ENT_QUOTES) ) ); }


if ($action=="addprod") {
	
	$cat = (int) trim( strip_tags( html_entity_decode( addslashes( $_POST['cat'] ) , ENT_QUOTES) ) );
	$mark = (int) trim( strip_tags( html_entity_decode( addslashes( $_POST['mark'] ) , ENT_QUOTES) ) );
	$coleur = (int) trim( strip_tags( html_entity_decode( addslashes( $_POST['coleur'] ) , ENT_QUOTES) ) );
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	$prixachat = trim( strip_tags( html_entity_decode( addslashes( $_POST['prixachat'] ) , ENT_QUOTES) ) );
	$prixvente = trim( strip_tags( html_entity_decode( addslashes( $_POST['prixvente'] ) , ENT_QUOTES) ) );
	$qtmin = trim( strip_tags( html_entity_decode( addslashes( $_POST['qtmin'] ) , ENT_QUOTES) ) );
			
	$tof1 ='';
	
	include('../general/class.upload_0.32/class.upload.php');

// set variables
$dir_dest = "../../produits/";
$dir_min = "../../produits/min/";


    $handle = new Upload($_FILES['tof1']);

    if ($handle->uploaded) {
          
		$handle->file_auto_rename = true;
        
        $handle->Process($dir_dest);
        
        
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 308;
        $handle->Process($dir_big);

        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 190;
        $handle->Process($dir_min);

        $tof1 = $handle->file_dst_name;

        $handle-> Clean();
    }

    $dates = date("Y-m-d"); 
   
	include_once('../general/parametre-db.inc.php');	
	$query = mysql_query("INSERT INTO `produits` (`nom`, `marque`, `img1`, `dtadd`, `prixachat`, `prixvente`, `qtmin`, `cat`, `coleur`) VALUES ('$nom', '$mark', '$tof1', '$dates', '$prixachat', '$prixvente', '$qtmin', '$cat', '$coleur'  ) ");
}

else if ($action=="delprod") {

	include_once('../general/parametre-db.inc.php');
	$d = (int) abs($_GET['d']);
	$query = mysql_query("delete from produits where id_prod=$d ");
}

else if ($action=="uprod") {
	
	$cat = (int) trim( strip_tags( html_entity_decode( addslashes( $_POST['cat'] ) , ENT_QUOTES) ) );
	$mark = (int) trim( strip_tags( html_entity_decode( addslashes( $_POST['mark'] ) , ENT_QUOTES) ) );
	$coleur = (int) trim( strip_tags( html_entity_decode( addslashes( $_POST['coleur'] ) , ENT_QUOTES) ) );
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	$prixachat = trim( strip_tags( html_entity_decode( addslashes( $_POST['prixachat'] ) , ENT_QUOTES) ) );
	$prixvente = trim( strip_tags( html_entity_decode( addslashes( $_POST['prixvente'] ) , ENT_QUOTES) ) );
	$qtmin = trim( strip_tags( html_entity_decode( addslashes( $_POST['qtmin'] ) , ENT_QUOTES) ) );

	$tof1 = '';

	$tofb1 = trim( strip_tags( html_entity_decode( addslashes( $_POST['tof1b'] ) , ENT_QUOTES) ) );
	
	$d = (int) abs($_POST['d']);
	
	include('../general/class.upload_0.32/class.upload.php');

	// set variables
	$dir_dest = "../../produits/";
	$dir_min = "../../produits/min/";

	//echo $_POST['tof1'];

	// Photo 1
	if (empty($_FILES["tof1"]["name"])) { $tof1 = $tofb1; }
	else
	{		
		$handle = new Upload($_FILES['tof1']);
	
		if ($handle->uploaded) 
		{
			$handle->file_auto_rename = true;	
			
			$handle->image_resize            = true;
			$handle->image_ratio_y           = true;
			$handle->image_x                 = 308;
			$handle->Process($dir_big);
	
			$handle->image_resize            = true;
			$handle->image_ratio_y           = true;
			$handle->image_x                 = 190;
			$handle->Process($dir_min);
	
            $tof1 = $handle->file_dst_name;
    
			$handle-> Clean();
		}
	} // fin upload 1	

	include_once('../general/parametre-db.inc.php');
	$query = mysql_query("UPDATE `produits` SET `nom` = '$nom', `marque` = '$mark', `img1` = '$tof1', `prixachat` = '$prixachat', `prixvente` = '$prixvente', `qtmin` = '$qtmin', `cat` = '$cat', `coleur` = '$coleur'  WHERE `id_prod`=$d ") or die(mysql_error());
}

echo"<script language=\"javascript\">window.location='../../produits.php?msg=".$action."';</script>";

?>