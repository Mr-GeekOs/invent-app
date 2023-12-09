<?php

include_once('modules/general/parametre-db.inc.php');

	$search_tel= @$_GET['tel'];
	$search_client= @$_GET['client'];

	$table = '';
	$where = " 1=1 ";
echo $search_tel;

if (!empty($search_client) or !empty($search_tel))
{

	if (!empty($search_tel))
	{
		$clinetid = mysql_query('select * from client where tel="'.$search_tel.'" ');
		$client = mysql_fetch_array($clinetid);
		$nom = $client['nom'];
	}
	else
	{
		$nom = $search_client;
	}
	$total = 0;
	echo '<table class="table table-hover table-nomargin table-bordered"><thead><tr><th>Produit</th><th>Vendeur</th><th>Date</th><th>Qt</th><th>Prix de vente</th><th>Total</th></tr><tbody class="update">';

	$total = $totalachat=0;
	$querycaisse = mysql_query('select * from sortiestock where client="'.$nom.'" ');
	while ($caisse = mysql_fetch_array($querycaisse))
	{
		$queryven = mysql_query('select * from vendeur where id_vendeur='.$caisse['vendeur'].' ');
		$resultv = mysql_fetch_array($queryven);

		$produitsortie = mysql_query('select * from prodsortiestock where id_sortie='.$caisse['id_sortie'].' ');
		while ($sorie = mysql_fetch_array($produitsortie))
		{
			$jam3 = $sorie['qt'] * $sorie['prix'];
			$queryp = mysql_query('select * from produits where id_prod='.$sorie['idprod'].' ');
			$resultp = mysql_fetch_array($queryp);
			echo '<tr><td>'.$resultp['nom'].'</td><td>'.$resultv['nom'].'</td><td>'.$caisse['date'].'</td><td>'.$sorie['qt'].'</td><td>'.$sorie['prix'].'</td><td>'.$jam3.'</td></tr>';
		}
	}
	echo '</tbody></table>';
}

?>
