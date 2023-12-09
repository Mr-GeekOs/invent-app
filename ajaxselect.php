<?php
    include_once('modules/general/parametre-db.inc.php');

	$d = (int) abs($_GET['d']);
	$sela = trim( strip_tags( html_entity_decode( addslashes( $_GET['sela'] ) , ENT_QUOTES) ) );

	if ($sela == "mark") 
	{
		$ReqLo = @mysql_query("SELECT * FROM model Where id_marque=".$d.""); 
		
		echo"<option value=\"\">---</option>";
		
		while($lignes = @mysql_fetch_array($ReqLo)) { echo"<option value=\"".$lignes['id_model']."\">".stripslashes($lignes['nom'])."</option>"; }
	}
	else { echo "<select><option value=\"\">votre choix</option></select>"; }
?>