<?php
session_start();
if((!isset($_SESSION['iduser'])) || (empty($_SESSION['iduser'])))
{
$url_id = "index.html";
header("Location:$url_id");
exit;
}

if (!empty($_POST['action'])) { $action = trim( strip_tags( html_entity_decode( addslashes( $_POST['action'] ) , ENT_QUOTES) ) ); }
else { $action = trim( strip_tags( html_entity_decode( addslashes($_GET['action']), ENT_QUOTES) ) ); }

$pages = '';

if ($action=="entree") {
	
	$d = trim( strip_tags( html_entity_decode( addslashes( $_POST['d'] ) , ENT_QUOTES) ) );
	$prixachat = trim( strip_tags( html_entity_decode( addslashes( $_POST['prixachat'] ) , ENT_QUOTES) ) );
	$prixvente = trim( strip_tags( html_entity_decode( addslashes( $_POST['prixvente'] ) , ENT_QUOTES) ) );
	$qt = trim( strip_tags( html_entity_decode( addslashes( $_POST['qt'] ) , ENT_QUOTES) ) );
			
	$caissier = $_SESSION['nom'];
	
	$dates = new DateTime('NOW');
	$dates->setTimezone(new DateTimeZone('GMT'));
	$dates = $dates->format('Y-m-d H:i:s');
	   
	include_once('../general/parametre-db.inc.php');	
	$query = mysql_query("INSERT INTO `entreestock` (`dtadd`, `prixachat`, `prixvente`, `qt`, `id_prod`, `caissier` )VALUES ('$dates', '$prixachat', '$prixvente', '$qt', '$d', '$caissier' ) ");
	$query = mysql_query("UPDATE `produits` SET `prixachat` = '$prixachat', `prixvente` = '$prixvente'  WHERE `id_prod`=$d ") or die(mysql_error());
	
	$pages = 'produits';
	$d ="";
}

else if ($action=="sortiestock") {
	
	$vendeur = (int) trim( strip_tags( html_entity_decode( addslashes( $_POST['vendeur'] ) , ENT_QUOTES) ) );
	$client = (int) trim( strip_tags( html_entity_decode( addslashes( $_POST['client'] ) , ENT_QUOTES) ) );
	$paiement = (int) trim( strip_tags( html_entity_decode( addslashes( $_POST['paiement'] ) , ENT_QUOTES) ) );
	
	$dates = new DateTime('NOW');
	$dates->setTimezone(new DateTimeZone('GMT'));
	$dates = $dates->format('Y-m-d H:i:s');
	
	$caissier = $_SESSION['nom'];
	
	include_once('../general/parametre-db.inc.php');
	include_once('../general/panier.inc.php');
	$query55 = mysql_query("select id_sortie from sortiestock order by id_sortie desc limit 1");
	$res55 = mysql_fetch_array($query55);
	$id_tic2 = $res55['id_sortie']+1;
	$datemois = date('m');
	$id_tic3 = sprintf("%04d", $id_tic2);
	
	$id_tic = "".$id_tic3."/".$datemois."";
	
	$nbArticles=count($_SESSION['panier']['idprod']);
		
	for ($i=0 ;$i < $nbArticles ; $i++)
	{		
		$idprod = $_SESSION['panier']['idprod'][$i];
		$prix = $_SESSION['panier']['prix'][$i];
		$qt = $_SESSION['panier']['qt'][$i];
		$pachat = $_SESSION['panier']['pachat'][$i];
		
		$query = mysql_query("INSERT INTO `prodsortiestock` (`idprod`, `prix`, `qt`, `pachat`, `id_sortie` )VALUES ('$idprod', '$prix', '$qt', '$pachat', '$id_tic2') ");
	}
	
	$query = mysql_query("INSERT INTO `sortiestock` (`date`, `vendeur`, `paiement`, `tichet_id`, `client`, `caissier` )VALUES ('$dates', '$vendeur', '$paiement', '$id_tic', '$client', '$caissier') ");
	supprimePanier();
	$pages = 'print';
	$d = $id_tic2;
}

echo"<script language=\"javascript\">window.location='../../".$pages.".php?d=".$d."';</script>";

?>