
<?php

if (!empty($_POST['action'])) { $action = trim( strip_tags( html_entity_decode( addslashes( $_POST['action'] ) , ENT_QUOTES) ) ); }
else { $action = trim( strip_tags( html_entity_decode( addslashes($_GET['action']), ENT_QUOTES) ) ); }


if ($action=="addcharget") {
	
	$nom = trim( strip_tags( html_entity_decode( addslashes( $_POST['nom'] ) , ENT_QUOTES) ) );
			
   
	include_once('../general/parametre-db.inc.php');	
	$query = mysql_query("INSERT INTO `chargescat` (`nom`) VALUES ('$nom' ) ");
}

else if ($action=="delcharge") {

	include_once('../general/parametre-db.inc.php');
	$d = (int) abs($_GET['d']);
	$query = mysql_query("UPDATE chargescat set valid=0 where id_charge=$d ");
}

else if ($action=="addchargej") {
	
	$date = trim( strip_tags( html_entity_decode( addslashes( $_POST['date'] ) , ENT_QUOTES) ) );
	
	include_once('../general/parametre-db.inc.php');
	$query = mysql_query('SELECT *  FROM  `chargescat` where valid=1 ORDER BY  `nom` ASC ');
	while ($result = mysql_fetch_array($query))
	{
		$id = $result['id_charge'];
		$vari = "charge".$result['id_charge']."";
		$montant = trim( strip_tags( html_entity_decode( addslashes( $_POST[$vari] ) , ENT_QUOTES) ) );

		$chargedb = mysql_query("SELECT id_charge FROM `chargelist` WHERE id_charge=$id and date='$date' ");
		$chargedbquery = mysql_num_rows($chargedb);
		
		if (empty($chargedbquery)) { $querys = mysql_query("INSERT INTO `chargelist` (`id_charge`, `montant`, `date`) VALUES ('$id', '$montant', '$date')"); }
		else  { $querys = mysql_query("UPDATE  `chargelist` SET  `montant` =$montant WHERE  `id_chargelist` =$id and date='$date' "); }	
	}
}

else if ($action=="editchargej") {

	include_once('../general/parametre-db.inc.php');
	$query = mysql_query('SELECT *  FROM  `chargescat` ORDER BY  `nom` ASC ');
	while ($result = mysql_fetch_array($query))
	{
		$id = $result['id_charge'];
		$vari = "charge".$result['id_charge']."";
		$montant = trim( strip_tags( html_entity_decode( addslashes( $_POST[$vari] ) , ENT_QUOTES) ) );
		if (!empty($montant))
		{
			$querys = mysql_query("UPDATE  `chargescat` SET  `prix` =  '$montant' WHERE  `chargescat`.`id_charge` ='$id'");
		}
	}
}

echo"<script language=\"javascript\">window.location='../../charge.php?msg=".$action."';</script>";

?>