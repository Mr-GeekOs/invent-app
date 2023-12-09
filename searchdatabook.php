<script type="text/javascript">
$(document).ready(function() {
  $(".addprod").click(function() {

	  var qts = qtmax =0;
	var id = $(this).attr('id');
	var prix =$("#prix"+id).val();
	var qts =parseInt($("#qt"+id).val());
	var qtmax =parseInt($("#maxqt"+id).val());
	var idprod =$("#idprod"+id).val();
	var pachat =$("#pachat"+id).val();

	if (qts > qtmax)	{ alert('Qt incorrect'); }
	else
	{
		var did ="ajaxaddcart.php?id="+id+"&prix="+prix+"&qt="+qts+"&idprod="+idprod+"&pachat="+pachat+"&qtmax="+qtmax;
		$("#prodslist").load(did);
		alert('Produit bien ajoutee');
	}
  });
});
</script>

    <table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Photo</th>
											<th>Nom</th>
											<th>Catégorie</th>
											<th>Marque</th>
                                            <th>Stock</th>
                                            <th>Prix * Qt</th>
										</tr>
										<tbody class="update">

<?php

include_once('modules/general/parametre-db.inc.php');

if(isset($_GET['search_word']))
{
	$search_word=$_GET['search_word'];
	$search_marque=$_GET['marque'];
	$search_cat=$_GET['cat'];

	$where = " 1=1 ";
	if (!empty($search_word)) {$where.=" and (nom LIKE '%$search_word%')"; }
	if (!empty($search_cat)) {$where.=" and cat=$search_cat "; }
	if (!empty($search_marque)) {$where.=" and marque=$search_marque "; }

	$query = @mysql_query("select * from produits WHERE ".$where." group by id_prod ");
	$count= @mysql_num_rows($query);
		$counters = 1;
		while ($result = @mysql_fetch_array($query))
		{
			$totalprod =0;
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

			if ($totalprod>=1)
			{
				echo "<tr>
					<td><img src=\"produits/min/".stripslashes($result['img1'])."\" width=\"160\" /></td>
					<td>".stripslashes($result['nom'])."</td>
					<td>".$fam."</td>
					<td>".$fam2."</td>
					<td><span class='dispo' id='dispo".$result['id_prod']."'\"><span class=\"label label-satgreen\">En Stock (".$totalprod.")</span></span></td>
					<td>
						<input type=\"hidden\" value=\"".$result['prixachat']."\" name\"pachatadd".$counters."\" id=\"pachatadd".$counters."\" />
						<input type=\"hidden\" value=\"".$result['id_prod']."\" name\"idprodadd".$counters."\"  id=\"idprodadd".$counters."\" />
						<input type=\"hidden\" value=\"".$totalprod."\" name=\"maxqtadd".$counters."\" id=\"maxqtadd".$counters."\"  />
						<input value=\"".$result['prixvente']."\" name\"prixadd".$counters."\" size=\"3\" id=\"prixadd".$counters."\" /> * <input type=\"number\" max=\"".$totalprod."\" name=\"qtadd".$counters."\" size=\"3\" max=\"".$totalprod."\" id=\"qtadd".$counters."\" /> <input type=\"button\" value=\"ajouter\" class=\"addprod\" id=\"add".$counters."\" />
					</td>
				</tr>";

				$counters++;
			}

		}
}
?>
	</tbody>
</table>
