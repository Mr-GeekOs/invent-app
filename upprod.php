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

						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="#">Admin</a><i class="fa fa-angle-right"></i></li>
						<li><a href="dashboard.php">Tableau de board</a><i class="fa fa-angle-right"></i></li>
                        <li><a href="addcat.php">Modifier Produit</a></li>
					</ul>
					<div class="close-bread"><a href="#"><i class="fa fa-times"></i></a></div>
				</div>




				<div class="row">
					<div class="col-sm-12">
						<div class="box">
							<div class="box-title"><h3><i class="fa fa-check"></i>Modifier produit</h3></div>
							<div class="box-content">
								<form action="modules/produits/action.php" method="POST" class='form-horizontal form-validate' id="bb" enctype="multipart/form-data">
											<?php
                                                include_once('modules/general/parametre-db.inc.php');
												$d = (int) abs($_GET['d']);

                                                $query = mysql_query('select * from produits where id_prod='.$d.' ');
                                                $result = mysql_fetch_array($query);

                                            ?>


									<input type="hidden" name="action" value="uprod" >
									<input type="hidden" name="d" value="<?php echo $d; ?>" >

									<div class="form-group">
										<label for="select" class="control-label col-sm-2">Famille</label>
										<div class="col-sm-10">
											<select name="cat" id="select" class='form-control'>
                                            <option value="">---</option>
											<?php
                                                	$select = mysql_query("select * from categories");
													while ($ca = mysql_fetch_array($select))
													{
														if ($ca['id_cat']==$result['cat']) {	echo "<option value=\"".$ca['id_cat']."\" selected>".$ca['nom']."</option>"; }
														else {	echo "<option value=\"".$ca['id_cat']."\"><strong>".$ca['nom']."</strong></option>"; }
													}
                                            ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="select" class="control-label col-sm-2">Marque</label>
										<div class="col-sm-10">
											<select name="mark" id="mark" class='form-control'>
                                            <option value="">---</option>
											<?php
                                                $querys = mysql_query('select * from marque order by nom asc');
                                                while ($results = mysql_fetch_array($querys))
                                                {
													if ($results['id_marque']==$result['marque']) {	echo "<option value=\"".$results['id_marque']."\" selected>".$results['nom']."</option>"; }
													else {	echo "<option value=\"".$results['id_marque']."\"><strong>".$results['nom']."</strong></option>"; }
                                                }
                                            ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="type" class="control-label col-sm-2">Coleur</label>
										<div class="col-sm-10">
											<select name="coleur" class='form-control'>
											<?php
                                                $query3 = mysql_query('select * from couleur order by nom asc');
                                                while ($result3 = mysql_fetch_array($query3))
                                                {
                                                	if ($results3['id_col']==$result['coleur']) { echo "<option value=\"".$result3['id_col']."\" selected>".stripslashes($result3['nom'])."</option>";}
                                                	else { echo "<option value=\"".$result3['id_col']."\">".stripslashes($result3['nom'])."</option>";}
                                                }
                                            ?>
                                            </select>
										</div>
									</div>


									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Nom</label>
										<div class="col-sm-10">
											<input type="text" name="nom" value="<?php echo stripslashes($result['nom']); ?>" id="textfield" class="form-control" data-rule-required="true" data-rule-minlength="2">
										</div>
									</div>

									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Prix achat</label>
										<div class="col-sm-10">
											<input type="text" name="prixachat" value="<?php echo $result['prixachat']; ?>" id="textfield" class="form-control" data-rule-required="false" data-rule-minlength="0">
										</div>
									</div>

									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Prix vente</label>
										<div class="col-sm-10">
											<input type="text" name="prixvente" value="<?php echo $result['prixvente']; ?>" id="textfield" class="form-control" data-rule-required="false" data-rule-minlength="0">
										</div>
									</div>


									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">QT minimal</label>
										<div class="col-sm-10">
											<input type="text" name="qtmin" value="<?php echo $result['qtmin']; ?>" id="textfield" class="form-control" data-rule-required="false" >
										</div>
									</div>

									<div class="form-group">
										<label for="file" class="control-label col-sm-2">Photo 1</label>
										<div class="col-sm-10">
											<input type="file" name="tof1" id="file" class="form-control">
											<span class="help-block">Seulement .JPG et .PNG (Max : 4MB)</span>
                                           <input type="hidden" value="<?php echo $result['img1']; ?>"  name="tof1b"/>
                                            <?php
												if (!empty($result['img1']))
												{
													if (file('produits/min/'.$result['img1']))
													{
														echo '<img src="produits/min/'.$result['img1'].'" width="120" />';
													}
												}
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
