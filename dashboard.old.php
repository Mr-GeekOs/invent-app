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
	<!-- PageGuide -->
	<link rel="stylesheet" href="css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- chosen -->
	<link rel="stylesheet" href="css/plugins/chosen/chosen.css">
	<!-- select2 -->
	<link rel="stylesheet" href="css/plugins/select2/select2.css">
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
	<!-- jQuery UI -->
	<script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<!-- Touch enable for jquery UI -->
	<script src="js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
	<!-- slimScroll -->
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- vmap -->
	<script src="js/plugins/vmap/jquery.vmap.min.js"></script>
	<script src="js/plugins/vmap/jquery.vmap.world.js"></script>
	<script src="js/plugins/vmap/jquery.vmap.sampledata.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Flot -->
	<script src="js/plugins/flot/jquery.flot.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.bar.order.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="js/plugins/flot/jquery.flot.resize.min.js"></script>
	<!-- imagesLoaded -->
	<script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- PageGuide -->
	<script src="js/plugins/pageguide/jquery.pageguide.js"></script>
	<!-- Chosen -->
	<script src="js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- select2 -->
	<script src="js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>

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
									<span class="big">identifiant</span>
									<span><?php echo $_SESSION['nom']; ?></span>
								</div>
							</li>
							<li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big"><?php echo date('M-d-Y') ?></span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li><a href="more-login.html">Admin</a><i class="fa fa-angle-right"></i></li>
						<li><a href="index.html">Tableau de board</a></li>
					</ul>
					<div class="close-bread"><a href="#"><i class="fa fa-times"></i></a></div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="fa fa-bar-chart-o"></i>Audience Overview</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="fa fa-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="fa fa-times"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="fa fa-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								<div class="statistic-big">
									<div class="top">
										<div class="left">
											<div class="input-medium">
												<select name="category" class='chosen-select' data-nosearch="true">
													<option value="1">Visits</option>
													<option value="2">New Visits</option>
													<option value="3">Unique Visits</option>
													<option value="4">Pageviews</option>
												</select>
											</div>
										</div>
										<div class="right">
											8,195
											<span>
												<i class="fa fa-arrow-circle-up"></i>
											</span>
										</div>
									</div>
									<div class="bottom">
										<div class="flot medium" id="flot-audience"></div>
									</div>
									<div class="bottom">
										<ul class="stats-overview">
											<li>
												<span class="name">
													Visits
												</span>
												<span class="value">
													11,251
												</span>
											</li>
											<li>
												<span class="name">
													Pages / Visit
												</span>
												<span class="value">
													8.31
												</span>
											</li>
											<li>
												<span class="name">
													Avg. Duration
												</span>
												<span class="value">
													00:06:41
												</span>
											</li>
											<li>
												<span class="name">
													% New Visits
												</span>
												<span class="value">
													67,35%
												</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="box box-color lightred box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-bar-chart-o"></i>
									HDD usage
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh">
										<i class="fa fa-refresh"></i>
									</a>
									<a href="#" class="btn btn-mini content-remove">
										<i class="fa fa-times"></i>
									</a>
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content">
								<div class="statistic-big">
									<div class="top">
										<div class="left">
											<div class="input-medium">
												<select name="category" class='chosen-select' data-nosearch="true">
													<option value="1">Today</option>
													<option value="2">Yesterday</option>
													<option value="3">Last week</option>
													<option value="4">Last month</option>
												</select>
											</div>
										</div>
										<div class="right">
											50%
											<span>
												<i class="fa fa-arrow-circle-right"></i>
											</span>
										</div>
									</div>
									<div class="bottom">
										<div class="flot medium" id="flot-hdd"></div>
									</div>
									<div class="bottom">
										<ul class="stats-overview">
											<li>
												<span class="name">
													Usage
												</span>
												<span class="value">
													50%
												</span>
											</li>
											<li>
												<span class="name">
													Usage % / User
												</span>
												<span class="value">
													0.031
												</span>
											</li>
											<li>
												<span class="name">
													Avg. Usage %
												</span>
												<span class="value">
													60%
												</span>
											</li>
											<li>
												<span class="name">
													Idle Usage %
												</span>
												<span class="value">
													12%
												</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered lightgrey">
							<div class="box-title">
								<h3>
									<i class="fa fa-check"></i>Tasks</h3>
								<div class="actions">
									<a href="#new-task" data-toggle="modal" class='btn'>
										<i class="fa fa-plus-square"></i>Add Task</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<ul class="tasklist">
									<li class='bookmarked'>
										<div class="check">
											<input type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
										</div>
										<span class="task">
											<i class="fa fa-check"></i>
											<span>Approve new users</span>
										</span>
										<span class="task-actions">
											<a href="#" class='task-delete' rel="tooltip" title="Delete that task">
												<i class="fa fa-times"></i>
											</a>
											<a href="#" class='task-bookmark' rel="tooltip" title="Mark as important">
												<i class="fa fa-bookmark-o"></i>
											</a>
										</span>
									</li>
									<li>
										<div class="check">
											<input type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
										</div>
										<span class="task">
											<i class="fa fa-bar-chart-o"></i>
											<span>Check statistics</span>
										</span>
										<span class="task-actions">
											<a href="#" class='task-delete' rel="tooltip" title="Delete that task">
												<i class="fa fa-times"></i>
											</a>
											<a href="#" class='task-bookmark' rel="tooltip" title="Mark as important">
												<i class="fa fa-bookmark-o"></i>
											</a>
										</span>
									</li>
									<li class='done'>
										<div class="check">
											<input type="checkbox" class='icheck-me' data-skin="square" data-color="blue" checked>
										</div>
										<span class="task">
											<i class="fa fa-envelope"></i>
											<span>Check for new mails</span>
										</span>
										<span class="task-actions">
											<a href="#" class='task-delete' rel="tooltip" title="Delete that task">
												<i class="fa fa-times"></i>
											</a>
											<a href="#" class='task-bookmark' rel="tooltip" title="Mark as important">
												<i class="fa fa-bookmark-o"></i>
											</a>
										</span>
									</li>
									<li>
										<div class="check">
											<input type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
										</div>
										<span class="task">
											<i class="fa fa-comment"></i>
											<span>Chat with John Doe</span>
										</span>
										<span class="task-actions">
											<a href="#" class='task-delete' rel="tooltip" title="Delete that task">
												<i class="fa fa-times"></i>
											</a>
											<a href="#" class='task-bookmark' rel="tooltip" title="Mark as important">
												<i class="fa fa-bookmark-o"></i>
											</a>
										</span>
									</li>
									<li>
										<div class="check">
											<input type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
										</div>
										<span class="task">
											<i class="fa fa-retweet"></i>
											<span>Go and tweet some stuff</span>
										</span>
										<span class="task-actions">
											<a href="#" class='task-delete' rel="tooltip" title="Delete that task">
												<i class="fa fa-times"></i>
											</a>
											<a href="#" class='task-bookmark' rel="tooltip" title="Mark as important">
												<i class="fa fa-bookmark-o"></i>
											</a>
										</span>
									</li>
									<li>
										<div class="check">
											<input type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
										</div>
										<span class="task">
											<i class="fa fa-edit"></i>
											<span>Write an article</span>
										</span>
										<span class="task-actions">
											<a href="#" class='task-delete' rel="tooltip" title="Delete that task">
												<i class="fa fa-times"></i>
											</a>
											<a href="#" class='task-bookmark' rel="tooltip" title="Mark as important">
												<i class="fa fa-bookmark-o"></i>
											</a>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="fa fa-bolt"></i>Server load</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh">
										<i class="fa fa-refresh"></i>
									</a>
									<a href="#" class="btn btn-mini content-remove">
										<i class="fa fa-times"></i>
									</a>
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content">
								<div class="flot flot-line"></div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="fa fa-comment"></i>Chat</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh">
										<i class="fa fa-refresh"></i>
									</a>
									<a href="#" class="btn btn-mini content-remove">
										<i class="fa fa-times"></i>
									</a>
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding scrollable" data-height="350" data-visible="true" data-start="bottom">
								<ul class="messages">
									<li class="left">
										<div class="image">
											<img src="img/demo/user-1.jpg" alt="">
										</div>
										<div class="message">
											<span class="caret"></span>
											<span class="name">Jane Doe</span>
											<p>Lorem ipsum aute ut ullamco et nisi ad.</p>
											<span class="time">
												12 minutes ago
											</span>
										</div>
									</li>
									<li class="right">
										<div class="image">
											<img src="img/demo/user-2.jpg" alt="">
										</div>
										<div class="message">
											<span class="caret"></span>
											<span class="name">John Doe</span>
											<p>Lorem ipsum aute ut ullamco et nisi ad. Lorem ipsum adipisicing nisi Excepteur eiusmod ex culpa laboris. Lorem ipsum est ut...</p>
											<span class="time">
												12 minutes ago
											</span>
										</div>
									</li>
									<li class="left">
										<div class="image">
											<img src="img/demo/user-1.jpg" alt="">
										</div>
										<div class="message">
											<span class="caret"></span>
											<span class="name">Jane Doe</span>
											<p>Lorem ipsum aute ut ullamco et nisi ad. Lorem ipsum adipisicing nisi!</p>
											<span class="time">
												12 minutes ago
											</span>
										</div>
									</li>
									<li class="typing">
										<span class="name">John Doe</span>is typing
										<img src="img/loading.gif" alt="">
									</li>
									<li class="insert">
										<form id="message-form" method="POST" action="#">
											<div class="text">
												<input type="text" name="text" placeholder="Write here..." class="form-control">
											</div>
											<div class="submit">
												<button type="submit">
													<i class="fa fa-share"></i>
												</button>
											</div>
										</form>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="fa fa-globe"></i>User regions</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh">
										<i class="fa fa-refresh"></i>
									</a>
									<a href="#" class="btn btn-mini content-remove">
										<i class="fa fa-times"></i>
									</a>
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content">
								<div id="vmap"></div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-user"></i>Address Book</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh">
										<i class="fa fa-refresh"></i>
									</a>
									<a href="#" class="btn btn-mini content-remove">
										<i class="fa fa-times"></i>
									</a>
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding scrollable" data-height="300" data-visible="true">
								<table class="table table-user table-nohead">
									<tbody>
										<tr class="alpha">
											<td class="alpha-val">
												<span>B</span>
											</td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-1.jpg" alt="">
											</td>
											<td class='user'>Bi Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-2.jpg" alt="">
											</td>
											<td class='user'>Boo Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val">
												<span>D</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-3.jpg" alt="">
											</td>
											<td class='user'>Dan Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-4.jpg" alt="">
											</td>
											<td class='user'>Dane Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val">
												<span>H</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-3.jpg" alt="">
											</td>
											<td class='user'>Hilda N. Ervin</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val">
												<span>J</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-5.jpg" alt="">
											</td>
											<td class='user'>John Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-6.jpg" alt="">
											</td>
											<td class='user'>John Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val">
												<span>L</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-5.jpg" alt="">
											</td>
											<td class='user'>Laura J. Brown</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-6.jpg" alt="">
											</td>
											<td class='user'>Lilly J. Tooley</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val">
												<span>M</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-1.jpg" alt="">
											</td>
											<td class='user'>Maxi Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-2.jpg" alt="">
											</td>
											<td class='user'>Max Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val">
												<span>O</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-1.jpg" alt="">
											</td>
											<td class='user'>Oxx Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-2.jpg" alt="">
											</td>
											<td class='user'>Osam Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr class="alpha">
											<td class="alpha-val">
												<span>P</span>
											</td>
											<td colspan="3"></td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-1.jpg" alt="">
											</td>
											<td class='user'>Petra Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td class='img'>
												<img src="img/demo/user-2.jpg" alt="">
											</td>
											<td class='user'>Per Doe</td>
											<td class='icon'>
												<a href="#" class='btn'>
													<i class="fa fa-search"></i>
												</a>
											</td>
										</tr>
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
