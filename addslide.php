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
    
    
<script>
$(document).ready(function() {
  $("#mark").change(function() {
  	var id =$("select#mark").val();
	var did ="ajaxselect.php?d="+id+"&sela=mark";
	$("#model").load(did);
  });
});
</script>
    

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
					<div class="pull-left"><h1>Tableau de bord</h1></div>
					<div class="pull-right">
						<ul class="minitiles"></ul>
						<ul class="stats">
							<li class='satgreen'>
							</li>
							<li class='lightred'>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="#">Admin</a><i class="fa fa-angle-right"></i></li>
						<li><a href="dashboard.php">Tableau de board</a><i class="fa fa-angle-right"></i></li>
                        <li><a href="addcat.php">Ajout Slide</a></li>
					</ul>
					<div class="close-bread"><a href="#"><i class="fa fa-times"></i></a></div>
				</div>




				<div class="row">
					<div class="col-sm-12">
						<div class="box">
							<div class="box-title"><h3><i class="fa fa-check"></i>Ajout Slide</h3></div>
							<div class="box-content">
								<form action="modules/promo/action.php" method="POST" class='form-horizontal form-validate' id="bb" enctype="multipart/form-data">
									<input type="hidden" name="action" value="addslide" >

									<div class="form-group">
										<label for="file" class="control-label col-sm-2">Slide 1</label>
										<div class="col-sm-10">
											<input type="file" name="tof1" id="file" class="form-control">
											<span class="help-block">Taille 1920 / 950 px, jpg seulement, le nom doit être slider_bg_17.jpg</span>
										</div>
									</div>

									<div class="form-group">
										<label for="file" class="control-label col-sm-2">Slide 2</label>
										<div class="col-sm-10">
											<input type="file" name="tof2" id="file" class="form-control">
											<span class="help-block">Taille 1920 / 950 px, jpg seulement, le nom doit être slider_bg_18.jpg</span>
										</div>
									</div>

									<div class="form-group">
										<label for="file" class="control-label col-sm-2">Slide 3</label>
										<div class="col-sm-10">
											<input type="file" name="tof3" id="file" class="form-control">
											<span class="help-block">Taille 1920 / 950 px, jpg seulement, le nom doit être slider_bg_19.jpg</span>
										</div>
									</div>

									
									<div class="form-group">
										<label for="file" class="control-label col-sm-2">Slide 4</label>
										<div class="col-sm-10">
											<input type="file" name="tof4" id="file" class="form-control">
											<span class="help-block">Taille 1920 / 950 px, jpg seulement, le nom doit être slider_bg_20.jpg</span>
										</div>
									</div>
									
									
									<div class="form-group">
										<label for="file" class="control-label col-sm-2">Slide 5</label>
										<div class="col-sm-10">
											<input type="file" name="tof5" id="file" class="form-control">
											<span class="help-block">Taille 1920 / 950 px, jpg seulement, le nom doit être slider_bg_21.jpg</span>
										</div>
									</div>
									

									<div class="form-group">
										<label for="file" class="control-label col-sm-2">Slide 6</label>
										<div class="col-sm-10">
											<input type="file" name="tof6" id="file" class="form-control">
											<span class="help-block">Taille 1920 / 950 px, jpg seulement, le nom doit être slider_bg_22.jpg</span>
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