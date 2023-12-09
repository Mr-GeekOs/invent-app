        
    <table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Catégorie</th>
											<th>Capitale</th>
										</tr>
										<tbody class="update">
	
<?php

include_once('modules/general/parametre-db.inc.php');

	$search_cat=$_GET['cat'];

	$where = " 1=1 ";
	$where2 = " 1=1 ";
	if (!empty($search_cat)) {$where.=" and cat=$search_cat "; $where2.=" and id_cat=$search_cat "; }
	
	$famille = mysql_query('select nom from categories WHERE '.$where2.' ');
	$fams = mysql_fetch_array($famille);
	$fam = $fams['nom'];
	if (empty($search_cat)) {$fam="Total de la boutique";}
	
		
	$prixtotal=0;
	$query = mysql_query("select * from produits WHERE ".$where." group by id_prod ");
	$count=mysql_num_rows($query);
		$counters = 1;
		while ($result = mysql_fetch_array($query))
		{
			$totalprod =0;
			
			$entreestock = mysql_query("select sum(qt) from entreestock where id_prod=".$result['id_prod']." ");
			$entreest = mysql_fetch_array($entreestock);
			$totalentree = $entreest['sum(qt)'];
				
			$sortiestock = mysql_query("select sum(qt) from prodsortiestock where idprod=".$result['id_prod']." ");
			$sortiest = mysql_fetch_array($sortiestock);
			$totalsortie = $sortiest['sum(qt)'];
				
			$totalprod = $totalentree - $totalsortie;
			$newsprix = $totalprod * $result['prixachat'];
			
			$prixtotal = $prixtotal + $newsprix;

			$counters++;
		}
		
		
		echo "<tr>
					<td>".$fam."</td>
					<td>$prixtotal DH</td>
				</tr>";
		
		
		
?>
	</tbody>
</table>