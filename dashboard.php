<?php
session_start();
if((!isset($_SESSION['iduser'])) || (empty($_SESSION['iduser'])))
{
$url_id = "index.html";
header("Location:$url_id");
exit;
}
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>Admin - Tableau de bord</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- dataTables -->
	<link rel="stylesheet" href="css/plugins/datatable/TableTools.css">
	<!-- chosen -->
	<link rel="stylesheet" href="css/plugins/chosen/chosen.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- imagesLoaded -->
	<script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.datepicker.min.js"></script>
	<!-- slimScroll -->
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- dataTables -->
	<script src="js/plugins/datatable/jquery.dataTables.min.js"></script>
	<script src="js/plugins/datatable/TableTools.min.js"></script>
	<script src="js/plugins/datatable/ColReorderWithResize.js"></script>
	<script src="js/plugins/datatable/ColVis.min.js"></script>
	<script src="js/plugins/datatable/jquery.dataTables.columnFilter.js"></script>
	<script src="js/plugins/datatable/jquery.dataTables.grouping.js"></script>
	<!-- Chosen -->
	<script src="js/plugins/chosen/chosen.jquery.min.js"></script>

	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>

	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->



	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

	
	                                    	<script>
                                    	function edition()
                                    	{
                                    		options = "Width=300,Height=700" ;
                                    		window.open( "ticketcaissier.php", "edition", options ) ;
                                    	}
                                    	</script>
                                    	
</head>

<body data-layout-topbar="fixed">

<?php include_once"modules/general/menu.inc.php"; ?>

	<div class="container-fluid nav-hidden" id="content">
    	<div id="left"></div>

		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Tableau de bord</h1>
					</div>
					<div class="pull-right">
						<ul class="minitiles">
						</ul>
						<ul class="stats">
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="#">Admin</a><i class="fa fa-angle-right"></i></li>
						<li><a href="dashboard.php">Tableau de board</a><i class="fa fa-angle-right"></i></li>
					</ul>
					<div class="close-bread"><a href="#"><i class="fa fa-times"></i></a></div>
				</div>


	</div>
</div>


				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>Caisse</h3>
							</div>
							<div class="box-content nopadding">
									
                                    	<?php

                                    	
                                    	
                                    		$nom = $_SESSION['nom'];
	                                    	include_once('modules/general/parametre-db.inc.php');
                                    		$total = 0;
                                    		$datestart = date('Y-m-d 00:00:00');
                                    		$dateend = date('Y-m-d 23:59:59');
											
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
												
											echo "<p>Vous avez un fond de caisse de : <span style=\"color:red; font-weight:bold; font-size:22px\">".$total."</span> DH <a onclick=\"edition();return false;\" style=\"color:bleu; font-size:20px\">Imprimer</a></p>";			
											
											
											
											
											echo '<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Produit</th>
											<th>Vendeur</th>
											<th>Date</th>
											<th>Qt</th>
											<th>Prix de vente</th>
											<th>Total</th>
										</tr>
										<tbody class="update">';
											
											
											$total = $totalachat=0;
											$querycaisse = mysql_query('select * from sortiestock where caissier="'.$nom.'" and date BETWEEN  "'.$datestart.'" and "'.$dateend.'" ');
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
													
													
													echo '
															<tr>
																<td>'.$resultp['nom'].'</td>
																<td>'.$resultv['nom'].'</td>
																<td>'.$caisse['date'].'</td>
																<td>'.$sorie['qt'].'</td>
																<td>'.$sorie['prix'].'</td>
																<td>'.$jam3.'</td>
															</tr>
														';
												}
											}
											
											echo '</tbody></table>';
											
											
										?>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>