
<?php

if (!empty($_POST['action'])) { $action = trim( strip_tags( html_entity_decode( addslashes( $_POST['action'] ) , ENT_QUOTES) ) ); }
else { $action = trim( strip_tags( html_entity_decode( addslashes( $_GET['action'] ) , ENT_QUOTES) ) ); }


if ($action=="addcat") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	
	include_once('../general/parametre-db.inc.php');
	$query = mysql_query("INSERT INTO `categories` (`nom`) VALUES ('$nom') ");
}

else if ($action=="delcat") {

	include_once('../general/parametre-db.inc.php');
	$d = (int) abs($_GET['d']);
	$query = mysql_query("delete from categories where id_cat=$d ");
}

else if ($action=="upcat") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	$d = (int) abs($_POST['d']);

	include_once('../general/parametre-db.inc.php');

	$query = mysql_query("UPDATE `categories` SET `nom` = '$nom' WHERE `id_cat`=$d ") or die(mysql_error());
}


echo"<script language=\"javascript\">window.location='../../categories.php?msg=".$action."';</script>";

?>