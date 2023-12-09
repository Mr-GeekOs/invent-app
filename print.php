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
	$d = trim( strip_tags( html_entity_decode( addslashes( $_GET['d'] ) , ENT_QUOTES) ) );
?>
    
    <script>
    function edition()
    {
        options = "Width=300,Height=700" ;
        window.open( "imprimer.php?d=<?php echo $d; ?>", "edition", options ) ;
        }
    
    
    function edition1()
    {
        options = "Width=640,Height=842" ;
        window.open( "imprimer2.php?d=<?php echo $d; ?>", "edition", options ) ;
        }
    </script>
    
	<div class="container-fluid nav-hidden" id="content">
    	<div id="left"></div>

		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left"><h1>Caisse IP Gold</h1></div>
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
										<div class="col-sm-12">
											<p style="text-align: center">
												<br /><br />
												Filicitation votre operation est terminer avec succès. <br /><br />
                                                                                                <a href="imprimer.php?d=<?php echo $d; ?>" onclick="edition();return false;" style="color:bleu; font-size:20px">Imprimer Ticket</a><br> <br>
												<a href="imprimer.php?d=<?php echo $d; ?>" onclick="edition1();return false;" style="color:bleu; font-size:20px">Imprimer A4</a>
                                                                                                
											</p>
										</div>
									</div>									
									
								</form>
							</div>
						</div>1
					</div>
				</div>



			</div>
		</div>
	</div>
</body>

</html>