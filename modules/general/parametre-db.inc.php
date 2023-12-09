<?php
$sql_serveur = "localhost";
$sql_user = "";
$sql_passwd = "";
$sql_bdd = "";

	$link = @mysql_connect($sql_serveur,$sql_user,$sql_passwd) or die("Impossible de se connecter : " . mysql_error());
	@mysql_select_db($sql_bdd);
	@mysql_query('SET NAMES utf8');
?>
