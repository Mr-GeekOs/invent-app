<?php

if (!empty($_POST['action'])) { $action = trim( strip_tags( html_entity_decode( addslashes( $_POST['action'] ) , ENT_QUOTES) ) ); }
else { $action = trim( strip_tags( html_entity_decode( addslashes( $_GET['action'] ) , ENT_QUOTES) ) ); }


if ($action=="addcompte") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	$email = trim( strip_tags( html_entity_decode( addslashes( $_POST['email'] ) , ENT_QUOTES) ) );
	$passwd = trim( strip_tags( html_entity_decode( addslashes( $_POST['passwd'] ) , ENT_QUOTES) ) );
	
	
	include_once('../general/parametre-db.inc.php');
	$query = mysql_query("INSERT INTO `admin` (`nom`, `email`, `psswd`, `acces`) VALUES ('$nom', '$email', '$passwd', '3') ");
}

else if ($action=="delcompte") {

	include_once('../general/parametre-db.inc.php');
	$d = (int) abs($_GET['d']);
	$query = mysql_query("delete from admin where id_adm=$d and acces=3 ");
}

else if ($action=="upcompte") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	$email = trim( strip_tags( html_entity_decode( addslashes( $_POST['email'] ) , ENT_QUOTES) ) );
	$passwd = trim( strip_tags( html_entity_decode( addslashes( $_POST['passwd'] ) , ENT_QUOTES) ) );
	
	$d = (int) abs($_POST['d']);
	
	
	include_once('../general/parametre-db.inc.php');
	
	$query = mysql_query("UPDATE `admin` SET `nom` = '$nom', `email` = '$email', `psswd` = '$passwd' WHERE `id_adm`=$d and acces=3 ") or die(mysql_error());
}


echo"<script language=\"javascript\">window.location='../../compte.php?msg=".$action."';</script>";

?>