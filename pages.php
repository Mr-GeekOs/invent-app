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

</head>

<body data-layout-topbar="fixed">

<?php
	include_once"modules/general/menu.inc.php";
?>

    
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
							<li class='satgreen'>
								<i class="fa fa-money"></i>
								<div class="details">
									<span class="big">user</span>
									<span>issam</span>
								</div>
							</li>
							<li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="#">Admin</a><i class="fa fa-angle-right"></i></li>
						<li><a href="dashboard.php">Tableau de board</a><i class="fa fa-angle-right"></i></li>
						<li><a href="produits.php">Liste pages</a></li>
					</ul>
					<div class="close-bread"><a href="#"><i class="fa fa-times"></i></a></div>
				</div>








				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>Pages</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Titre</th>
											<th>Description</th>
                                            <th>Catégorie</th>
                                            <th>Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
                                    	<?php
											include_once('modules/general/parametre-db.inc.php');
											
											$query = mysql_query('select * from pages order by id_page desc');
											while ($result = mysql_fetch_array($query))
											{
													$famille = mysql_query('select nom from categories where id_cat ='.$result['cat'].' ');
													$fams = mysql_fetch_array($famille);
													$fam = $fams['nom'];
													
													if ($result['visible']==1) { $act ="<span class=\"label label-satgreen\">Active</span>"; }
													else { $act ="<span class=\"label label-lightred\">Inactive</span>"; }

												echo "
													<tr>
														<td>".stripslashes($result['titre'])."</td>
														<td>".$result['desc']."</td>
														<td>".$fam."</td>
														<td>".$act."</td>
														<td>
															<a href=\"uppg.php?d=".$result['id_page']."\" class=\"btn\" rel=\"tooltip\" title=\"Modifier\"><i class=\"fa fa-edit\"></i></a>
															<a href=\"modules/pages/action.php?d=".$result['id_page']."&action=delpg\" class=\"btn\" rel=\"tooltip\" title=\"Supprimer\"><i class=\"fa fa-times\"></i></a>
														</td>
													</tr>
												
												";
											}
										?>
									
                                    </tbody>
								</table>
							</div>
						</div>
					</div>
				</div>









			</div>
		</div>
	</div>
</body>

</html>
