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

<script>
$(document).ready(function() {
	$(".dispo").click(function (e) {
		var id = $(this).attr("id");
		$("#"+id).load("ajaxmod.php?id="+id+"&type=dispo");
	});	

	$(".status").click(function (e) {
		var id = $(this).attr("id");
		$("#"+id).load("ajaxmod.php?id="+id+"&type=status");
	});	

});
</script>

<script type="text/javascript">

$( document ).ready(function() {

	$(".search_button").click(function() {
		var search_word = $("#searchd").val();
		var cat = $("#cat").val();
		var marque = $("#marque").val();
		var dataString = 'search_word='+ search_word +'&marque='+ marque +'&cat='+ cat+'&rep=rep';
		
		$("#insert_search").html('');
		
			$.ajax({
			type: "GET",
			url: "searchdata.php",
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


function operatiof(action,id) 
{
	if (action=="dispo") { $("#dispo"+id).load("ajaxmod.php?id="+id+"&type=dispo"); }
	if (action=="status") { $("#status"+id).load("ajaxmod.php?id="+id+"&type=status"); }
}

</script>


	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

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
							<li class='satgreen'>
								<i class="fa fa-plus"></i>
								<div class="details">
									<a href="addprod.php" style="color: white">
									<span class="big">Ajouter</span>
									<span>Produit</span>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="#">Admin</a><i class="fa fa-angle-right"></i></li>
						<li><a href="dashboard.php">Tableau de board</a><i class="fa fa-angle-right"></i></li>
						<li><a href="produits.php">Liste produits</a></li>
					</ul>
					<div class="close-bread"><a href="#"><i class="fa fa-times"></i></a></div>
				</div>

<style type="text/css">
	#flash { margin-top:20px; text-align:left }
	#search_box { padding:4px; border:solid 1px #666666; width:50%; height:30px; font-size:18px;-moz-border-radius: 6px;-webkit-border-radius: 6px; }
	.search_button { background:#FFF; border:#000000 solid 1px; padding:5px; color:#000; font-weight:bold; font-size:13px;-moz-border-radius: 6px;-webkit-border-radius: 6px }
</style>



<div align="center">
    <div style="width:100%">
        <div style="margin-top:20px; text-align:left">
            <form method="get" action="">
                <div class="col-sm-3"><input type="text" name="search" id="searchd" class='form-control'/></div>
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
                        $query = mysql_query('select * from marque order by nom asc');
                        while ($result = mysql_fetch_array($query))
                        {
                            echo "<option value=\"".$result['id_marque']."\">".stripslashes($result['nom'])."</option>";
                        }
                    ?>
                </select>
                </div>
                <input type="submit" value="Recherche" class="search_button" /><br />
                <a href="produits_stock.php">Produits en stock</a> - <a href="produits_nostock.php">Produits en repture</a>
            </form>
        </div>    
        <div>
            <div id="flash"></div>
            </ol>  
        </div>
    </div>
</div>


				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>Produits</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Nom</th>
											<th>Catégorie</th>
											<th>Marque</th>
											<th>Prix Achat</th>
											<th>Prix Vente</th>
                                            <th>Stock</th>
                                            <th>Options</th>
										</tr>
									</thead>
									<tbody class="update" id="insert_search">
									
                                    	<?php
											include_once('modules/general/parametre-db.inc.php');
											$query = mysql_query('select * from produits order by id_prod desc');
											while ($result = mysql_fetch_array($query))
											{
												$famille = mysql_query('select nom from categories where id_cat ='.$result['cat'].' ');
                                                $fams = mysql_fetch_array($famille);
                                                $fam = $fams['nom'];
            
                                                $famille2 = mysql_query('select nom from marque where id_marque ='.$result['marque'].' ');
												$fams2 = mysql_fetch_array($famille2);
												$fam2 = $fams2['nom'];
									
												$entreestock = mysql_query("select sum(qt) from entreestock where id_prod=".$result['id_prod']." ");
												$entreest = mysql_fetch_array($entreestock);
												$totalentree = $entreest['sum(qt)'];
												
												
												$sortiestock = mysql_query("select sum(qt) from prodsortiestock where idprod=".$result['id_prod']." ");
												$sortiest = mysql_fetch_array($sortiestock);
												$totalsortie = $sortiest['sum(qt)'];
												
												$totalprod = $totalentree - $totalsortie;
												
												if ($totalprod>=1) { $dispo ="<span class=\"label label-satgreen\">En Stock</span>"; }
												else { $dispo ="<span class=\"label label-lightred\">Rupture</span>"; }

												if ($_SESSION['email']=="azami@brahim.ma" or $_SESSION['email']=="brahim@gsm.com")
                                                {
                                                    $ramdis="
                                                            <a href=\"upprod.php?d=".$result['id_prod']."\" class=\"btn\" rel=\"tooltip\" title=\"Modifier\"><i class=\"fa fa-edit\"></i></a>
                                                            <a onclick=\"return(confirm('Etes-vous sûr de vouloir supprimer cette entree?'));\" href=\"modules/produits/action.php?d=".$result['id_prod']."&action=delprod\" class=\"btn\" rel=\"tooltip\" title=\"Supprimer\"><i class=\"fa fa-times\"></i></a>
                                                            <a href=\"stockadd.php?d=".$result['id_prod']."\" class=\"btn\" rel=\"tooltip\" title=\"Entrée stock\"><i class=\"fa fa-arrow-down\"></i></a>
                                                    ";
                                                }
                                                else
                                                    {
                                                        $ramdis="";
                                                    }
                                                
                                                if ($totalprod>=1) {
												echo"";
                                                }
else {
	echo "<tr>
                                                        <td>".stripslashes($result['nom'])."</td>
                                                        <td>".$fam."</td>
                                                        <td>".$fam2."</td>
                                                        <td>".stripslashes($result['prixachat'])."</td>
                                                        <td>".stripslashes($result['prixvente'])."</td>
                                                        <td><span class='dispo' id='dispo".$result['id_prod']."'>".$dispo."</span></td>
                                                        <td>
                                                            ".$ramdis."
                                                        </td>
                                                    </tr>";
}
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