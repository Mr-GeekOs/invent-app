
<?php

if (!empty($_POST['action'])) { $action = trim( strip_tags( html_entity_decode( addslashes( $_POST['action'] ) , ENT_QUOTES) ) ); }
else { $action = trim( strip_tags( html_entity_decode( addslashes( $_GET['action'] ) , ENT_QUOTES) ) ); }


if ($action=="addpai") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	
	include_once('../general/parametre-db.inc.php');
	$query = mysql_query("INSERT INTO `paiement` (`nom` ) VALUES ('$nom' ) ") or die (mysql_error());
}

else if ($action=="delpai") {

	include_once('../general/parametre-db.inc.php');
	$d = (int) abs($_GET['d']);
	$query = mysql_query("delete from paiement where id_pai=$d ");
}

else if ($action=="uppai") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	$d = (int) abs($_POST['d']);

	include_once('../general/parametre-db.inc.php');

	$query = mysql_query("UPDATE `paiement` SET `nom` = '$nom' WHERE `id_pai`=$d ") or die(mysql_error());
}


echo"<script language=\"javascript\">window.location='../../paiement.php?msg=".$action."';</script>";

?>