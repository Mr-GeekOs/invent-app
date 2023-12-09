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
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<title>Admin - Tableau de bord</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/themes.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
	<script src="js/plugins/form/jquery.form.min.js"></script>
	<script src="js/plugins/validation/jquery.validate.min.js"></script>
	<script src="js/plugins/validation/additional-methods.min.js"></script>
	<script src="js/eakroko.min.js"></script>
	<script src="js/application.min.js"></script>
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

	<script type="text/javascript">
		$( document ).ready(function() {
			$(".search_button").click(function() {
				var search_word = $("#searchd").val();
				var cat = $("#cat").val();
				var marque = $("#marque").val();
				var dataString = 'search_word='+ search_word +'&marque='+ marque +'&cat='+ cat;

				$("#insert_search").html('');

					$.ajax({
					type: "GET",
					url: "searchdatabook.php",
					data: dataString,
					cache: false,
					beforeSend: function(html)
					{
						$("#insert_search").html('');
						$("#flash").show();
						$("#flash").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;Loading Results...');
					},
					success: function(html)
					{
					   $("#insert_search").html(html);
					   $("#flash").hide();
					}
					});

		    	return false;
			});
		});
	</script>
	<script>$(document).ready(function() { $("#endsof").click(function() { $("#insert_search").html(''); }); });</script>
</head>

<body data-layout-topbar="fixed">

<?php
	include_once"modules/general/menu.inc.php";
	include_once('modules/general/parametre-db.inc.php');
	$rotas = '';

		$selectos = @mysql_query("select * from categories ");
		while ($cass = @mysql_fetch_array($selectos))
		{
			$rotas.='<option value="'.$cass['id_cat'].'">'.stripslashes($cass['nom']).'</option>';
		}
?>

	<div class="container-fluid nav-hidden" id="content">
    	<div id="left"></div>

		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left"><h1>Tableau de bord</h1></div>
					<div class="pull-right">
						<ul class="minitiles"></ul>
						<ul class="stats">
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="#">Admin</a><i class="fa fa-angle-right"></i></li>
						<li><a href="dashboard.php">Tableau de board</a><i class="fa fa-angle-right"></i></li>
                        <li><a href="#">Sortie Stock</a></li>
					</ul>
					<div class="close-bread"><a href="#"><i class="fa fa-times"></i></a></div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="box">
							<div class="box-title"><h3><i class="fa fa-check"></i>Sortie Stock</h3></div>
							<div class="box-content">
								<form action="modules/stock/action.php" method="POST" class='form-horizontal form-validate' id="bb">
									<input type="hidden" name="action" value="sortiestock" >

									<div class="form-group">
										<label for="select" class="control-label col-sm-2">Client</label>
										<div class="col-sm-10">
											<select name="client" class='form-control'>
											<?php

                                                $query0 = @mysql_query('select * from client order by nom asc');
                                                while ($result0 = @mysql_fetch_array($query0))
                                                {
													echo "<option value=\"".$result0['id_client']."\">".stripslashes($result0['nom'])."</option>";
                                                }
                                            ?>
											</select>
										</div>
									</div>
									<?php echo @$tot; ?>

									<div class="form-group">
										<label for="select" class="control-label col-sm-2">Vendeur</label>
										<div class="col-sm-10">
											<select name="vendeur" class='form-control'>
											<?php

                                                $query1 = @mysql_query('select * from vendeur order by nom asc');
                                                while ($result1 = @mysql_fetch_array($query1))
                                                {
													echo "<option value=\"".$result1['id_vendeur']."\">".stripslashes($result1['nom'])."</option>";
                                                }
                                            ?>
											</select>
										</div>
									</div>


									<div class="form-group">
										<label for="type" class="control-label col-sm-2">Mode de paiement</label>
										<div class="col-sm-10">
											<select name="paiement" class='form-control'>
											<?php

                                                $query2 = mysql_query('select * from paiement order by nom asc');
                                                while ($result2 = mysql_fetch_array($query2))
                                                {
													echo "<option value=\"".$result2['id_pai']."\">".stripslashes($result2['nom'])."</option>";
                                                }
                                            ?>
                                            </select>
										</div>
									</div>




									<br /><br />
									<div class="form-group">
										<div class="col-sm-1">&nbsp;</div>
										<div class="col-sm-2">
											<input type="text" name="searchd" id="searchd" class="form-control" data-rule-required="false" >
									</div>
									<div class="form-group">
										<div class="col-sm-3">
											<select name="cat" id="cat" class='form-control'>
												<option value="">-- Catégorie --</option>
												<?php
													include_once('modules/general/parametre-db.inc.php');

														$select = mysql_query("select * from categories ");
														while ($ca = mysql_fetch_array($select))
														{
															echo "<option value=\"".$ca['id_cat']."\">".stripslashes($ca['nom'])."</option>";
														}
												?>
											</select>

										</div>
										<div class="col-sm-3">
											<select name="marque" id="marque" class='form-control'>
												<option value="">-- Marque --</option>
												<?php
													$query24 = mysql_query('select * from marque order by nom asc');
													while ($result24 = mysql_fetch_array($query24))
													{
														echo "<option value=\"".$result24['id_marque']."\">".stripslashes($result24['nom'])."</option>";
													}
												?>
											</select>
										</div>
										<div class="col-sm-2" style="text-align: center;">

												<input type="submit" class="btn btn-primary search_button" value="Recherche">
												<a id="endsof">Terminer</a>

										</div>
										<br><br>

										<hr>
										<div class="col-sm-1">&nbsp;</div>
										<div class="col-sm-10">
										<div class="box-content nopadding" id="insert_search">

										</div>
										</div>
										<div class="col-sm-1">&nbsp;</div>



									</div>

									<hr />
									<div class="form-group">

										<div class="col-sm-12" id="prodslist">

											<?php

									echo '<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Nom</th>
											<th>Prix</th>
											<th>Qt</th>
                                            <th>Options</th>
										</tr>
										<tbody>';
											include_once('modules/general/panier.inc.php');
											if (creationPanier())
											{
												$nbArticles=count($_SESSION['panier']['idprod']);
												if ($nbArticles <= 0) {	echo "<tr><td>aucun produits</ td></tr>"; }
												else
												{
													for ($i=0 ;$i < $nbArticles ; $i++)
													{
													$qr = mysql_query("select nom from produits where id_prod =".$_SESSION['panier']['idprod'][$i]." ");
													$nomq = mysql_fetch_array($qr);

													echo "<tr>
															<td>".$nomq['nom']."</ td>
															<td>".htmlspecialchars($_SESSION['panier']['prix'][$i])."</td>
															<td>".htmlspecialchars($_SESSION['panier']['qt'][$i])."</td>
															<td><a href=\"".htmlspecialchars("panierdel.php?action=panierdel&d=".rawurlencode($_SESSION['panier']['idprod'][$i]))."\">Supprimer</a></td>
														</tr>";
													}
											}
											}
												echo '</tbody></table>';
											?>

										</div>
									</div>

									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Enregistrer">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</body>
</html>
