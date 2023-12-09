
<?php

if (!empty($_POST['action'])) { $action = trim( strip_tags( html_entity_decode( addslashes( $_POST['action'] ) , ENT_QUOTES) ) ); }
else { $action = trim( strip_tags( html_entity_decode( addslashes( $_GET['action'] ) , ENT_QUOTES) ) ); }


if ($action=="addvend") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
		
	include_once('../general/parametre-db.inc.php');
	$query = mysql_query("INSERT INTO `vendeur` (`nom`) VALUES ('$nom') ");
}

else if ($action=="delvend") {

	include_once('../general/parametre-db.inc.php');
	$d = (int) abs($_GET['d']);
	$query = mysql_query("delete from vendeur where id_vendeur=$d ");
}

else if ($action=="upvend") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	$d = (int) abs($_POST['d']);
	
	
	include_once('../general/parametre-db.inc.php');
	
	$query = mysql_query("UPDATE `vendeur` SET `nom` = '$nom' WHERE `id_vendeur`=$d ") or die(mysql_error());
}


echo"<script language=\"javascript\">window.location='../../vendeurs.php?msg=".$action."';</script>";

?>