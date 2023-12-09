<?php
	$type = trim($_GET["type"]);
	$ids = $_GET["id"];
	$toto = array("special", "dispo", "status", "promo");
	$id = str_replace($toto, "", $ids);
	

if ($type=="dispo") 
{
	require"../metiers_/parametre-db.inc.php";
	$query = mysql_query("select * from produits where id_prod='".$id."' ");
	$result = mysql_fetch_array($query);
	// 0 == sur commande
	// 1 == en stock
	// 3 == nous consulter
	
	if ($result['dispo']==0) { $dispo ="<span class=\"label label-satgreen\">En Stock</span>"; $dis=1; }
	else if ($result['dispo']==1) { $dispo ="<span class=\"label label-lightgari\">Nous consulter</span>"; $dis=3; }
	else { $dispo ="<span class=\"label label-lightred\">Sur Commande</span>"; $dis=0; }

	$query = mysql_query("UPDATE `produits` SET `dispo` = '$dis'  WHERE `id_prod`=$id ") or die(mysql_error());

	echo $dispo;
}
else if ($type=="special") 
{
	require"../metiers_/parametre-db.inc.php";
	$query = mysql_query("select * from produits where id_prod='".$id."' ");
	$result = mysql_fetch_array($query);
	
	if ($result['special']==1) { $dispo ="<span class=\"label label-lightred\">Non</span>"; $dis=0; }
	else { $dispo ="<span class=\"label label-satgreen\">Special</span>"; $dis=1; }

	$query = mysql_query("UPDATE `produits` SET `special` = '$dis'  WHERE `id_prod`=$id ") or die(mysql_error());

	echo $dispo;
}
else if ($type=="status") 
{
	require"../metiers_/parametre-db.inc.php";
	$query = mysql_query("select * from produits where id_prod='".$id."' ");
	$result = mysql_fetch_array($query);

	if ($result['valid']==1) { $dispo ="<span class=\"label label-lightred\">Inactive</span>"; $dis=0; }
	else { $dispo ="<span class=\"label label-satgreen\">Active</span>"; $dis=1; }

	$query = mysql_query("UPDATE `produits` SET `valid` = '$dis'  WHERE `id_prod`=$id ") or die(mysql_error());

	echo $dispo;
}
else if ($type=="promo")
{
	require"../metiers_/parametre-db.inc.php";
	$query = mysql_query("select * from produits where id_prod='".$id."' ");
	$result = mysql_fetch_array($query);

	if ($result['prom']==1) { $dispo ="<span class=\"label label-lightred\">ActiveInactive</span>"; $dis=0; }
	else { $dispo ="<span class=\"label label-satgreen\">Active</span>"; $dis=1; }

	$query = mysql_query("UPDATE `produits` SET `prom` = '$dis'  WHERE `id_prod`=$id ") or die(mysql_error());

	echo $dispo;
}
?>

