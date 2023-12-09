<?php

include_once('modules/general/parametre-db.inc.php');

if(isset($_GET['search_word']))
{
	$search_word= @$_GET['search_word'];
	$search_marque= @$_GET['marque'];
	$search_cat= @$_GET['cat'];

	$where = " 1=1 ";
	if (!empty($search_word)) {$where.=" and (nom LIKE '%$search_word%')"; }
	if (!empty($search_cat)) {$where.=" and cat=$search_cat "; }
	if (!empty($search_marque)) {$where.=" and marque=$search_marque "; }

	$query = @mysql_query("select * from produits WHERE ".$where." group by id_prod ");
	$count= @mysql_num_rows($query);

		while ($result = @mysql_fetch_array($query))
		{
			$famille = @mysql_query('select nom from categories where id_cat ='.$result['cat'].' ');
			$fams = @mysql_fetch_array($famille);
			$fam = $fams['nom'];

			$famille2 = @mysql_query('select nom from marque where id_marque ='.$result['marque'].' ');
			$fams2 = @mysql_fetch_array($famille2);
			$fam2 = $fams2['nom'];


			$entreestock = @mysql_query("select sum(qt) from entreestock where id_prod=".$result['id_prod']." ");
			$entreest = @mysql_fetch_array($entreestock);
			$totalentree = $entreest['sum(qt)'];


			$sortiestock = @mysql_query("select sum(qt) from prodsortiestock where idprod=".$result['id_prod']." ");
			$sortiest = @mysql_fetch_array($sortiestock);
			$totalsortie = $sortiest['sum(qt)'];

			$totalprod = $totalentree - $totalsortie;

			if ($totalprod>=1) { $dispo ="<span class=\"label label-satgreen\">En Stock</span>"; }
			else { $dispo ="<span class=\"label label-lightred\">Rupture</span>"; }


			echo "<tr>
				<td>".stripslashes($result['nom'])."</td>
				<td>".$fam."</td>
				<td>".$fam2."</td>
				<td>".stripslashes($result['prixachat'])."</td>
				<td>".stripslashes($result['prixvente'])."</td>
				<td><span class='dispo' id='dispo".$result['id_prod']."' onclick=\"operatiof('dispo','".$result['id_prod']."');\">".$dispo."</span></td>
				<td>
					<a href=\"upprod.php?d=".$result['id_prod']."\" class=\"btn\" rel=\"tooltip\" title=\"Modifier\"><i class=\"fa fa-edit\"></i></a>
					<a href=\"modules/produits/action.php?d=".$result['id_prod']."&action=delprod\" class=\"btn\" rel=\"tooltip\" title=\"Supprimer\"><i class=\"fa fa-times\"></i></a>
					<a href=\"stockadd.php?d=".$result['id_prod']."\" class=\"btn\" rel=\"tooltip\" title=\"Entrée stock\"><i class=\"fa fa-arrow-down\"></i></a>
				</td>
			</tr>";
		}
}
?>
