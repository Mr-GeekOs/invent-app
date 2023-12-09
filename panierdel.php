<?php
session_start();
if((!isset($_SESSION['iduser'])) || (empty($_SESSION['iduser'])))
{
	$url_id = "index.html";
	header("Location:$url_id");
	exit;
}

if (!empty($_POST['action'])) { $action = trim( strip_tags( html_entity_decode( addslashes( $_POST['action'] ) , ENT_QUOTES) ) ); }
else { $action = trim( strip_tags( html_entity_decode( addslashes( $_GET['action'] ) , ENT_QUOTES) ) ); }

$lien = 'index.html';

if ($action=="panierdel") {
	
	include_once('modules/general/panier.inc.php');
	$d = (int) abs($_GET['d']);
	supprimerArticle($d);
	$lien = 'sortiestock.php';
}

echo"<script language=\"javascript\">window.location='".$lien."';</script>";
?>