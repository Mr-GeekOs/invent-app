<?php

if (!empty($_POST['action'])) { $action = trim( strip_tags( html_entity_decode( addslashes( $_POST['action'] ) , ENT_QUOTES) ) ); }
else { $action = trim( strip_tags( html_entity_decode( addslashes( $_GET['action'] ) , ENT_QUOTES) ) ); }
$message ="";

if ($action=="addclient") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	$tel = trim( strip_tags( html_entity_decode( addslashes( $_POST['tel'] ) , ENT_QUOTES) ) );
    $dates = date('Y-m-d');
	
	include_once('../general/parametre-db.inc.php');
    $querys = mysql_query("select * from client where tel='$tel' ");
    $toto = mysql_num_rows($querys);
    if (empty($toto)) { $query = mysql_query("INSERT INTO `client` (`nom`, `tel`, `dates`) VALUES ('$nom', '$tel', '$dates') "); $message = 'oui'; }
    else { $message = 'nn'; }

}

else if ($action=="delclient") {

	include_once('../general/parametre-db.inc.php');
	$d = (int) abs($_GET['d']);
	$query = mysql_query("delete from client where id_client=$d ");
}

else if ($action=="upclient") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
	$tel = trim( strip_tags( html_entity_decode( addslashes( $_POST['tel'] ) , ENT_QUOTES) ) );
	
	$d = (int) abs($_POST['d']);
	
	
	include_once('../general/parametre-db.inc.php');
	
	$query = mysql_query("UPDATE `client` SET `nom` = '$nom', `tel` = '$tel' WHERE `id_client`=$d ") or die(mysql_error());
}


echo"<script language=\"javascript\">window.location='../../client.php?msg=".$message."';</script>";

?>