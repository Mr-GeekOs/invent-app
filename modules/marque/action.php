
<?php

if (!empty($_POST['action'])) { $action = trim( strip_tags( html_entity_decode( addslashes( $_POST['action'] ) , ENT_QUOTES) ) ); }
else { $action = trim( strip_tags( html_entity_decode( addslashes( $_GET['action'] ) , ENT_QUOTES) ) ); }


if ($action=="addmark") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );

	include_once('../general/parametre-db.inc.php');
	$query = mysql_query("INSERT INTO `marque` (`nom` ) VALUES ('$nom' ) ") or die (mysql_error());
}

else if ($action=="delmark") {

	include_once('../general/parametre-db.inc.php');
	$d = (int) abs($_GET['d']);
	$query = mysql_query("delete from marque where id_marque=$d ");
}

else if ($action=="upmark") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	$d = (int) abs($_POST['d']);

	include_once('../general/parametre-db.inc.php');

	$query = mysql_query("UPDATE `marque` SET `nom` = '$nom' WHERE `id_marque`=$d ") or die(mysql_error());
}


echo"<script language=\"javascript\">window.location='../../marques.php?msg=".$action."';</script>";

?>