
<?php

if (!empty($_POST['action'])) { $action = trim( strip_tags( html_entity_decode( addslashes( $_POST['action'] ) , ENT_QUOTES) ) ); }
else { $action = trim( strip_tags( html_entity_decode( addslashes( $_GET['action'] ) , ENT_QUOTES) ) ); }


if ($action=="addcol") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );

	include_once('../general/parametre-db.inc.php');
	$query = mysql_query("INSERT INTO `couleur` (`nom` ) VALUES ('$nom' ) ");
}

else if ($action=="delcol") {

	include_once('../general/parametre-db.inc.php');
	$d = (int) abs($_GET['d']);
	$query = mysql_query("delete from couleur where id_col=$d ");
}

else if ($action=="upcol") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	$d = (int) abs($_POST['d']);
	include_once('../general/parametre-db.inc.php');

	$query = mysql_query("UPDATE `couleur` SET `nom` = '$nom' WHERE `id_col`=$d ") or die(mysql_error());
}


echo"<script language=\"javascript\">window.location='../../coleurs.php?msg=".$action."';</script>";

?>