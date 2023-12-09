<?php
session_start();
if((!isset($_SESSION['iduser'])) || (empty($_SESSION['iduser'])))
{
$url_id = "index.html";
header("Location:$url_id");
exit;
}

include_once('modules/general/parametre-db.inc.php');
include_once('modules/general/panier.inc.php');

$id = trim( strip_tags( html_entity_decode( addslashes( $_GET['id'] ) , ENT_QUOTES) ) );
$prix = trim( strip_tags( html_entity_decode( addslashes( $_GET['prix'] ) , ENT_QUOTES) ) );
$qt = trim( strip_tags( html_entity_decode( addslashes( $_GET['qt'] ) , ENT_QUOTES) ) );
$pachat = trim( strip_tags( html_entity_decode( addslashes( $_GET['pachat'] ) , ENT_QUOTES) ) );
$idprod = trim( strip_tags( html_entity_decode( addslashes( $_GET['idprod'] ) , ENT_QUOTES) ) );
$qtmax = trim( strip_tags( html_entity_decode( addslashes( $_GET['qtmax'] ) , ENT_QUOTES) ) );


if (!empty($qt) && !empty($prix) && !empty($id) && !empty($idprod) && !empty($pachat) && !empty($qtmax))
{
	ajouterArticle($idprod,$qt,$prix,$pachat,$qtmax);
	
	echo '<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Nom</th>
											<th>Prix</th>
											<th>Qt</th>
                                            <th>Options</th>
										</tr>
										<tbody>';
	if (creationPanier())
	{
		$nbArticles=count($_SESSION['panier']['idprod']);
		if ($nbArticles <= 0)
			echo "<tr><td>aucun produits</ td></tr>";
		else
		{
			for ($i=0 ;$i < $nbArticles ; $i++)
			{
				$qr = mysql_query("select nom from produits where id_prod =".$_SESSION['panier']['idprod'][$i]." ");
				$nomq = mysql_fetch_array($qr);
				
				
			echo "<tr>";
					echo "<td>".$nomq['nom']."</ td>";
							echo "<td>".htmlspecialchars($_SESSION['panier']['prix'][$i])."</td>";
							echo "<td>".htmlspecialchars($_SESSION['panier']['qt'][$i])."</td>";
							echo "<td><a href=\"".htmlspecialchars("panierdel.php?action=panierdel&d=".rawurlencode($_SESSION['panier']['idprod'][$i]))."\">Supprimer</a></td>";
							echo "</tr>";
		}
	
		}
		}
		
		echo '</tbody></table>';
}
?>