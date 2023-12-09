<?php
include_once('modules/general/parametre-db.inc.php');

	$factnum=$_GET['factnum'];
    $datefact=$_GET['datefact'];
    
    
    if (!empty($datefact))
    {
        echo '<table class="table table-hover table-nomargin table-bordered"><thead><tr><th>Ticket Numero</th><th>Caissier</th><th>Vendeur</th><th>Client</th><th>Option</th></thead>
                <tbody class="update">';
                
        $sorties = mysql_query('select * from sortiestock where `date` BETWEEN  "'.$datefact.' 00:00:00" and "'.$datefact.' 23:59:59" ');
        while ($sortiestock = mysql_fetch_array($sorties))
        {
            $queryven = mysql_query('select * from vendeur where id_vendeur='.$sortiestock['vendeur'].' ');
            $resultv = mysql_fetch_array($queryven);
            
            $clientv = mysql_query("select nom from client where id_client =".$sortiestock['client']." ");
            $resc = mysql_fetch_array($clientv);
        
        echo '<tr>
                    <td>'.$sortiestock['tichet_id'].'</td>
                    <td>'.$sortiestock['caissier'].'</td>
                    <td>'.$resultv['nom'].'</td>
                    <td>'.$resc['nom'].'</td>
                    <td>
                        <a href="imprimer.php?d='.$sortiestock['id_sortie'].'" onclick="edition2('.$sortiestock['id_sortie'].');return false;" style="color:bleu; font-size:20px">Ticket</a> - 
                        <a href="imprimer.php?d='.$sortiestock['id_sortie'].'" onclick="edition3('.$sortiestock['id_sortie'].');return false;" style="color:bleu; font-size:20px">Format A4</a>
                    </td>
                </tr>';
        } 
        echo '</tbody></table>
        <script>
    function edition2(vari)
    {
        options = "Width=300,Height=700" ;
        window.open( "imprimer.php?d="+vari+"", "edition", options ) ;
        }
    
     function edition3(vari)
    {
        options = "Width=640,Height=842" ;
        window.open( "imprimer2.php?d="+vari+"", "edition", options ) ;
        }
    </script>';
    }
    else if (!empty($factnum))
	{
		$sorties = mysql_query("select * from sortiestock where tichet_id ='".$factnum."' ");
		$sortiestock = mysql_fetch_array($sorties);
		
		echo '<table class="table table-hover table-nomargin table-bordered">
<thead><tr><th>Ticket Numero</th><th>Option</th></thead>
<tbody class="update">
				<tr>
					<td>'.$sortiestock['tichet_id'].'</td>
					<td>
					   <a href="imprimer.php?d='.$sortiestock['id_sortie'].'" onclick="edition();return false;" style="color:bleu; font-size:20px">Ticket</a> - 
                       <a href="imprimer.php?d='.$sortiestock['id_sortie'].'" onclick="edition1();return false;" style="color:bleu; font-size:20px">Format A4</a>
                    </td>
				</tr>
				</tbody></table>
							
							
							
							
    <script>
    function edition()
    {
        options = "Width=300,Height=700" ;
        window.open( "imprimer.php?d='.$sortiestock['id_sortie'].'", "edition", options ) ;
        }
     function edition1()
    {
        options = "Width=640,Height=842" ;
        window.open( "imprimer2.php?d='.$sortiestock['id_sortie'].'", "edition", options ) ;
        }
    </script>';
	}
	else
	{
		
	

	
	echo '<style>table tr th {text-align:right}</style><table class="table table-hover table-nomargin table-bordered">
<thead><tr><th>هامش الربح</th><th>رأس مال</th><th>التكاليف</th><th>مبيعات</th><th>الإ سم</th></tr></thead>
<tbody class="update">';
	
	$search_cais=$_GET['cais'];
	$search_type=$_GET['type'];
	$search_date=$_GET['date'];
	$search_client=$_GET['client'];
	$search_vendeur=$_GET['vendeur'];
	
	$table = '';
	$where = " 1=1 ";
	
	if (!empty($search_date)) 
	{
		if (!empty($search_cais)) 
		{
			$where.=' and caissier="'.$search_cais.'" and date BETWEEN  "'.$search_date.' 00:00:00" and "'.$search_date.' 23:59:59" ';  
			$fam = $search_cais;
		}
		else if (!empty($search_vendeur)) 
		{
			$where.=' and vendeur='.$search_vendeur.' and date BETWEEN  "'.$search_date.' 00:00:00" and "'.$search_date.' 23:59:59" '; 
		}
		else if (!empty($search_client)) 
		{
			$where.=' and client='.$search_client.' and date > "'.$search_date.' 00:00:00"  '; 
			$querytoto = mysql_query('select * from client where id_client='.$search_client.' ');
			$resulttoto = mysql_fetch_array($querytoto);
			$fam = $resulttoto['nom'];
		}
		else if (!empty($search_type)) 
		{
			$where.=' and date BETWEEN  "'.$search_date.' 00:00:00" and "'.$search_date.' 23:59:59" '; 
		}
		
	}
	
	$chargedb = mysql_query("SELECT sum(montant) as totaldepence FROM `chargelist` WHERE date='$search_date' ");
	$chargefetch = mysql_fetch_array($chargedb);
	$totalcharge = $chargefetch['totaldepence'];
	
	if (!empty($search_cais) or !empty($search_vendeur) ) {$totalcharge=0;}
	
	
	$total = $totalachat=0;
	$querycaisse = mysql_query('select id_sortie from sortiestock where '.$where.' ');
	while ($caisse = mysql_fetch_array($querycaisse))
	{
		$produitsortie = mysql_query('select * from prodsortiestock where id_sortie='.$caisse['id_sortie'].' ');
		while ($sorie = mysql_fetch_array($produitsortie))
		{
			$jam3 = $sorie['qt'] * $sorie['prix'];
			$jam32 = $sorie['qt'] * $sorie['pachat'];
			$total = $total + $jam3;
			$totalachat = $totalachat + $jam32;
		}
	}
		
	$marge = $total - $totalachat;
	echo "<tr>
			<td align='right'>".$marge." <br> درهم</td>
			<td align='right'>".$totalachat." <br> درهم</td>
			<td align='right'>".$totalcharge." <br> درهم</td>
			<td align='right'>".$total." <br> درهم</td>
			<td align='right'>".$fam."</td>
		</tr>";
?>
	</tbody>
</table>


<table class="table table-hover table-nomargin table-bordered">
		<thead><tr><th>Type de charge</th><th>Montant</th></tr></thead>
		<tbody class="update">
<?php 
	$chargedb = mysql_query("SELECT id_charge, sum(montant)  FROM `chargelist` WHERE date='$search_date' group by id_charge ");
	while ($chargefetch = mysql_fetch_array($chargedb))
	{
		$idcom = $chargefetch['id_charge'];
		$categorielisting = mysql_query('select * from chargescat where id_charge='.$idcom.' ');
		$soriecat = mysql_fetch_array($categorielisting);
		
		echo "<tr><td>".$soriecat['nom']."</td><td>".$chargefetch['sum(montant)']."</td></tr>";
	}

echo'</tbody></table>';


if (!empty($search_cais))
{
	$nom = $search_cais;
	$total = 0;	
	echo '<table class="table table-hover table-nomargin table-bordered"><thead><tr><th>Produit</th><th>Vendeur</th><th>Date</th><th>Qt</th><th>Prix de vente</th><th>Total</th></tr><tbody class="update">';
	
	$total = $totalachat=0;
	$querycaisse = mysql_query('select * from sortiestock where caissier="'.$nom.'" and date BETWEEN   "'.$search_date.' 00:00:00" and "'.$search_date.' 23:59:59" ');
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


if (!empty($search_client))
{
	$nom = $search_client;
	$total = 0;	
	echo '<table class="table table-hover table-nomargin table-bordered"><thead><tr><th>Produit</th><th>Vendeur</th><th>Date</th><th>Qt</th><th>Prix de vente</th><th>Total</th></tr><tbody class="update">';
	
	$total = $totalachat=0;
	$querycaisse = mysql_query('select * from sortiestock where client="'.$nom.'" and date > "'.$search_date.' 00:00:00" ');
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


if (!empty($search_vendeur))
{
	$nom = $search_vendeur;
	$total = 0;	
	echo '<table class="table table-hover table-nomargin table-bordered"><thead><tr><th>Produit</th><th>Caissier</th><th>Date</th><th>Qt</th><th>Prix de vente</th><th>Total</th></tr><tbody class="update">';
	
	$total = $totalachat=0;
	$querycaisse = mysql_query('select * from sortiestock where vendeur="'.$nom.'" and date BETWEEN   "'.$search_date.' 00:00:00" and "'.$search_date.' 23:59:59" ');
	while ($caisse = mysql_fetch_array($querycaisse))
	{
		
		$produitsortie = mysql_query('select * from prodsortiestock where id_sortie='.$caisse['id_sortie'].' ');
		while ($sorie = mysql_fetch_array($produitsortie))
		{
			$jam3 = $sorie['qt'] * $sorie['prix'];
			$queryp = mysql_query('select * from produits where id_prod='.$sorie['idprod'].' ');
			$resultp = mysql_fetch_array($queryp);
			echo '<tr><td>'.$resultp['nom'].'</td><td>'.$caisse['caissier'].'</td><td>'.$caisse['date'].'</td><td>'.$sorie['qt'].'</td><td>'.$sorie['prix'].'</td><td>'.$jam3.'</td></tr>';
		}
	}
	echo '</tbody></table>';
}
	}
?>