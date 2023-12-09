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
			var tel = $("#tel").val();
			var client = $("#client").val();
			var dataString = '&tel='+ tel + '&client='+ client;
			
			$("#insert_search").html('');
				$.ajax({
				type: "GET",
				url: "searchanalyticscaisse2.php",
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

<script type="text/javascript">
$( document ).ready(function() 
	{
		$(".search_inv").click(function() {
			var factnum = $("#factnum").val();
			var dataString = '&factnum='+ factnum;
			
			$("#insert_search").html('');
				$.ajax({
				type: "GET",
				url: "searchanalyticscaisse.php",
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
					<div class="pull-left"><h1>Caisse Alfajr GSM</h1></div>
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
                        <li><a href="#">Journal Caisse</a></li>
					</ul>
					<div class="close-bread"><a href="#"><i class="fa fa-times"></i></a></div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="box">
							<div class="box-title"><h3><i class="fa fa-check"></i>Journal Caisse</h3></div>
							<div class="box-content">
									<div class="form-group">
										<div class="col-sm-12"><h3>Recherce N° Facture</h3></div>
										<div class="col-sm-6"><input type="text" name="factnum" id="factnum" class='form-control'></div>
										
										
										<div class="col-sm-4" style="text-align: center;"><input type="submit" class="btn btn-primary search_inv" value="Afficher Facture"></div>
										<br><br>
										
										<hr>
									</div>
										
									<div class="form-group">
									<div class="col-sm-12"><h3>Recherce Par Client</h3></div>
										
										<div class="col-sm-4">
											<select name="client" id="client" class='form-control'>
												<option value="">-- Client --</option>
												<?php
		                                            $query5 = mysql_query('select * from client order by nom asc');
													while ($result5 = mysql_fetch_array($query5)) { echo "<option value=\"".$result5['id_client']."\">".stripslashes($result5['nom'])."</option>"; }
												?>
											</select>
										</div>
										
										<div class="col-sm-4"><input type="text" name="tel" id="tel" class='form-control' placeholder="Numero Tel"></div>
										
										<div class="col-sm-3" style="text-align: center;"><input type="submit" class="btn btn-primary search_button" value="Calculer"></div>
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