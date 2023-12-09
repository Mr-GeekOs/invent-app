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
	<!-- icheck -->
	<link rel="stylesheet" href="css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="js/plugins/validation/jquery.validate.min.js"></script>
	<script src="js/plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/eakroko.js"></script>

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


<body class='login'>
	<div class="wrapper">
		<h1>
			<a href="index.html">
				<img src="img/logo-big.png" alt="" class='retina-ready' width="59" height="49">Administration</a>
		</h1>
		<div class="login-body">
			<h2>Administration</h2>
			<form action="logins.php" method='POST' class='form-validate' id="test">
				<div class="form-group">
					<div class="email controls">
						<input type="text" name='uemail' placeholder="Identifiant" class='form-control' data-rule-required="true" data-rule-email="true">
					</div>
				</div>
				<div class="form-group">
					<div class="pw controls">
						<input type="password" name="upw" placeholder="Mot de passe" class='form-control' data-rule-required="true">
					</div>
				</div>
				<div class="submit">
					<input type="submit" value="Connexion" class='btn btn-primary'>
				</div>
			</form>
			<div class="forget">
				<a href="#">
					<span>Mot de passe oublier?</span>
				</a>
			</div>
		</div>
	</div>
</body>

</html>
