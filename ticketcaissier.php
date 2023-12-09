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
		
		
		$nom = $_SESSION['nom'];
		$total = 0;
		$datestart = date('Y-m-d 00:00:00');
		$dateend = date('Y-m-d 23:59:59');
		$datenows = gmdate('Y-m-d H:m:s');
		
		$querycaisse = mysql_query('select id_sortie from sortiestock where caissier="'.$nom.'" and date BETWEEN  "'.$datestart.'" and "'.$dateend.'" ');
		while ($caisse = mysql_fetch_array($querycaisse))
		{
			$produitsortie = mysql_query('select * from prodsortiestock where id_sortie='.$caisse['id_sortie'].' ');
			while ($sorie = mysql_fetch_array($produitsortie))
			{
				$jam3 = $sorie['qt'] * $sorie['prix'];
				$total = $total + $jam3;
			}
		}
		
		
		

$my_html="
    <div class=\"container\">
      
      <div class=\"row\">
        <div class=\"col-xs-12\">
          <div class=\"panel panel-default\">
            <div class=\"panel-body text-center\">
			<h1>BRAHIMGSM</h1>
              <p>Accessoire Mobile & Tablette<br> Tel : 0535624567<br> web : www.alfajr-gsm.com</p>
            </div>
          </div>
        </div>
      </div>
      
		
		<hr />
      <div class=\"row\">
        <div class=\"col-xs-6\"><p>Vendeur : ".$nom."</p></div>
      	<div class=\"col-xs-6\"><p>".$datenows."</p></div>
		</div>		
		
      <br><br>
		
		<table>
        <thead>
          <tr>
            <th width=\"70%\"><h4 class=\"text-left\">Total</h4></th>
            <th width=\"30%\"><h4 class=\"text-right\">".$total." DH</h4></th>
          </tr>
        </thead>
      </table>
	
	<div style=\"clear:both\"></div>

        		
		<hr />
      <div class=\"row\"><div class=\"col-xs-12 text-center\">N° 22, Rue AB Med Loukili 30000 Agdal Fès <br><br>BRAHIMGSM</div></div>
		
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