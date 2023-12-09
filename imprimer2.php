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
			$twito = $qtprods['qt'] * $qtprods['prix'];
			$toto .= "<tr>";
			$toto .= "<td>".$nomq['nom']."</ td>";
			$toto .= "<td class=\"text-center\">".$qtprods['qt']."</td>";
			$toto .= "<td class=\"text-center\">".number_format($qtprods['prix'], 2, '.', '')."</td>";
			$toto .= "<td class=\"text-center\">".number_format($twito, 2, '.', '')."</td></tr>";
			
			$sommes = $qtprods['prix'] * $qtprods['qt'];
			
			$totalmad = $totalmad + $sommes;
		}		

		$totalrow = mysql_num_rows($qrpd);


$my_html="
    <div class=\"container\">
      
      <div class=\"row\">
        <div class=\"col-xs-12\">
            <div class=\"row\">
             <div class=\"col-xs-9\">Aziz Phone</div>
             <div class=\"col-xs-3\">
             <p>
                <b>Aziz Phone</b> <br>
                22 B Avenue Med Loukili<br> 
                Agdal Fès <br>
                Tel : 0535624567<br>
                Tel : 0666942328
             </p>
             </div>
             <div style=\"clear:both\"></div>
            </div>  
        
          <div class=\"panel panel-default\">
            <div class=\"panel-body text-center\">
              <p class=\"fontbig\">Vente toutes sortes d’accessoires de Téléphone et Informatique</p>
            </div>
          </div>
        </div>
      </div>
      
		
	<div class=\"center\">
      <div class=\"row ints\">
        <div class=\"col-xs-6 ints\">Facture : </div>
      	<div class=\"col-xs-6 ints\">".$sortiestock['tichet_id']."</div>
		</div>		

      <div class=\"row\">
        <div class=\"col-xs-6\">&nbsp;</div>
        <div class=\"col-xs-6\">".$sortiestock['date']."</div>
        </div>  

		
		<div class=\"row ints\">
        <div class=\"col-xs-6 ints\">Client :</div>
        <div class=\"col-xs-6 ints\">".$resc['nom']."</div>
        </div>      
		
      <div class=\"row\">
        <div class=\"col-xs-6\">Vendeur :</div>
      	<div class=\"col-xs-6\">".$resv['nom']."</div>
		</div>
		</div>	
		<div style=\"clear:both\"></div>
		<br><br>
		
		<table>
        <thead>
          <tr>
            <th width=\"50%\">Designation</th>
            <th width=\"10%\">QT</th>
            <th width=\"20%\">PU</th>
            <th width=\"20%\">Total</th>
          </tr>
        </thead>
        <tbody>
          ".$toto."
        </tbody>
      </table>

	<div style=\"clear:both\"></div>
		
	<div class=\"row\">
        <div class=\"col-xs-6 text-center\"><strong>".$respai['nom']."</strong></div>
        <div class=\"col-xs-6 text-right\"><strong>".number_format($totalmad, 2, '.', '')." DH</strong></div>
	</div>
    <div style=\"clear:both\"></div>

        
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
table { border:1px solid #999; border-spacing : 0; border-collapse : collapse; margin:0; padding:0; font-size:13px; width:100% }
.container {margin:0; padding:5px; width:645px}
.col-xs-12 {width:100%; padding:0; margin:0}
.col-xs-6 {width:48%; padding:1%; margin:0; float:left}
.col-xs-9 {width:70%; padding:0; margin:0; float:left}
.col-xs-3 {width:30%; padding:0; margin:0; float:left}
.text-left {text-align:left}
.text-right {text-align:right}
.text-center {text-align:center}
.ints {background: #deeaf6}
.center {width: 90%; margin:10px auto}
th {background: #2e74b5; color: #FFF; vertical-align: middle; text-align: center}
.widths {width: 85%}
.fontbig {font-size:22px; font-weight: bold}

</style>