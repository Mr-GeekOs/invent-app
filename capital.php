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
	<!-- slimScroll -->
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/form/jquery.form.min.js"></script>
	<!-- Validation -->
	<script src="js/plugins/validation/jquery.validate.min.js"></script>
	<script src="js/plugins/validation/additional-methods.min.js"></script>

	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />
	
	
<script type="text/javascript">
$( document ).ready(function() 
	{
		$(".search_button").click(function() {
			var cat = $("#cat").val();
			var dataString = '&cat='+ cat;
			
			$("#insert_search").html('');
				$.ajax({
				type: "GET",
				url: "searchanalytics.php",
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
	$selectos = mysql_query("select * from categories ");
	while ($cass = mysql_fetch_array($selectos)) { $rotas.='<option value="'.$cass['id_cat'].'">'.stripslashes($cass['nom']).'</option>'; }
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
                        <li><a href="#">Journal Capitale</a></li>
					</ul>
					<div class="close-bread"><a href="#"><i class="fa fa-times"></i></a></div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="box">
							<div class="box-title"><h3><i class="fa fa-check"></i>Journal Capitale</h3></div>
							<div class="box-content">
									
									<div class="form-group">
										<div class="col-sm-1">&nbsp;</div>
										
									<div class="form-group">
										<div class="col-sm-5">
											<select name="cat" id="cat" class='form-control'>
												<option value="">-- Catégorie --</option>
												<?php
													include_once('modules/general/parametre-db.inc.php');
													$select = mysql_query("select * from categories ");
													while ($ca = mysql_fetch_array($select)) { echo "<option value=\"".$ca['id_cat']."\">".stripslashes($ca['nom'])."</option>"; }
												?>
											</select>
										</div>
										
										<div class="col-sm-2" style="text-align: center;"><input type="submit" class="btn btn-primary search_button" value="Calculer"></div>
										<br><br>
										
										<hr>
										<div class="col-sm-1">&nbsp;</div>
										<div class="col-sm-10"><div class="box-content nopadding" id="insert_search"></div></div>
										<div class="col-sm-1">&nbsp;</div>
									</div>

									<hr />
									<div class="form-group"><div class="col-sm-12" id="prodslist"></div></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>