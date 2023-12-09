<?php
session_start();
if((!isset($_SESSION['iduser'])) || (empty($_SESSION['iduser'])))
{
	$url_id = "index.html";
	header("Location:$url_id");
	exit;
}

include_once('modules/general/panier.inc.php');
include_once('modules/general/parametre-db.inc.php');

$d = trim( strip_tags( html_entity_decode( addslashes( $_GET['d'] ) , ENT_QUOTES) ) );


$sorties = mysql_query("select * from sortiestock where id_sortie =".$d." ");
$sortiestock = mysql_fetch_array($sorties);
	


$paiv = mysql_query("select nom from paiement where id_pai =".$sortiestock['paiement']." ");
$respai = mysql_fetch_array($paiv);

$vendv = mysql_query("select nom from vendeur where id_vendeur =".$sortiestock['vendeur']." ");
$resv = mysql_fetch_array($vendv);

$clientv = mysql_query("select nom from client where id_client =".$sortiestock['client']." ");
$resc = mysql_fetch_array($clientv);

	$toto="";
	$totalmad="";
		$qrpd = mysql_query("select * from prodsortiestock where id_sortie =".$d." ");
		while ($qtprods = mysql_fetch_array($qrpd))
		{
			$qr = mysql_query("select nom from produits where id_prod =".$qtprods['idprod']." ");
			$nomq = mysql_fetch_array($qr);
			
			$toto .= "<tr>";
			$toto .= "<td>".$nomq['nom']."</ td>";
			$toto .= "<td class=\"text-right\">".$qtprods['qt']."</td>";
			$toto .= "<td class=\"text-right\">".number_format($qtprods['prix'], 2, '.', '')."</td>";
			$toto .= "</tr>";
			
			$sommes = $qtprods['prix'] * $qtprods['qt'];
			
			$totalmad = $totalmad + $sommes;
		}		

		$totalrow = mysql_num_rows($qrpd);


$my_html="
    <div class=\"container\">
      
      <div class=\"row\">
        <div class=\"col-xs-12\">
          <div class=\"panel panel-default\">
            <div class=\"panel-body text-center\">
			<h1>Aziz Phone</h1>
              <p>Accessoire Mobile et informatique<br> Tel : 0535624567</p>
            </div>
          </div>
        </div>
      </div>
      
		
		<hr />
      <div class=\"row\">
        <div class=\"col-xs-6\"><p>Ticket : ".$sortiestock['tichet_id']."</p></div>
      	<div class=\"col-xs-6\"><p>".$sortiestock['date']."</p></div>
		</div>		
		
      <div class=\"row\">
        <div class=\"col-xs-6\"><p>Vendeur : ".$resv['nom']."</p></div>
      	<div class=\"col-xs-6\"><p>Client : ".$resc['nom']."</p></div>
		</div>			
		<br><br>
		
		<table>
        <thead>
          <tr>
            <th width=\"60%\"><h4 class=\"text-left\">Articles</h4></th>
            <th width=\"15%\"><h4 class=\"text-right\">QT</h4></th>
            <th width=\"25%\"><h4 class=\"text-right\">PU</h4></th>
          </tr>
        </thead>
        <tbody>
          ".$toto."
        </tbody>
      </table>

	<hr />	
	<div class=\"row\"><div class=\"col-xs-12\">Total ".$totalrow." produits(s)<br><br></div></div>
	<div style=\"clear:both\"></div>
		
	<div class=\"row\">
        <div class=\"col-xs-6 text-center\"><strong>".$respai['nom']."</strong></div>
        <div class=\"col-xs-6 text-right\"><strong>".$totalmad." DH</strong></div>
	</div>
    <div style=\"clear:both\"></div>

        		
		<hr />
      <div class=\"row\"><div class=\"col-xs-12 text-center\">N° 22, Rue AB Med Loukili 30000 Agdal Fès <br><br>Aziz Phone<br> vous remercie de votre visite<br> A BIENTOT</div></div>
		
    </div>
  </body>
</html>";

echo $my_html;

?>


<script type="text/javascript">
		window.print() ;
	</script>

<style>
body, html { margin:0; padding:0; font-size:12px }
table { border-spacing : 0; border-collapse : collapse; margin:0; padding:0; font-size:12px; width:100% }
.container {margin:0; padding:0; width:270px}
.col-xs-12 {width:100%; padding:0; margin:0}
.col-xs-6 {width:50%; padding:0; margin:0; float:left}
.text-left {text-align:left}
.text-right {text-align:right}
.text-center {text-align:center}

</style>