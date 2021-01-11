
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="en" class="no-js"> <![endif]-->
<!--[if !(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
	<title>Dashboard | KingAdmin - Admin Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="KingAdmin - Bootstrap Admin Dashboard Theme">
	<meta name="author" content="The Develovers">
	<!-- CSS -->
	<link href="<?php echo base_url(); ?>assets/portal/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/portal/css/main.css" rel="stylesheet" type="text/css">
	<!--[if lte IE 9]>
		<link href="<?php echo base_url(); ?>assets/portal/css/main-ie.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>assets/portal/css/main-ie-part2.css" rel="stylesheet" type="text/css"/>
	<![endif]-->
	<!-- CSS for demo style switcher. you can remove this -->
	<!-- Fav and touch icons -->
	</head>

<body class="sidebar-fixed topnav-fixed dashboard">
	<!-- WRAPPER -->
	<div id="wrapper" class="wrapper">
		<!-- TOP BAR -->
		<div class="top-bar navbar-fixed-top">
			<div class="container">
				<div class="clearfix">
					<a href="#" class="pull-left toggle-sidebar-collapse"><i class="fa fa-bars"></i></a>
					<!-- logo -->
					<div class="pull-left left logo">
						<a href="index.html"><img src="<?php echo base_url();?>assets/img/icons/iri.logo.png" alt="IRI- Admin Dashboard" /></a>
						<h1 class="sr-only">IRI Admin Dashboard</h1>
					</div>
					<!-- end logo -->
					<div class="pull-right right">
						<!-- search box -->
						<div class="searchbox">
							<div id="tour-searchbox" class="input-group">
								<input type="search" class="form-control" placeholder="procurar...">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
						<!-- end search box -->
						<!-- top-bar-right -->
						<div class="top-bar-right">
							<button type="button" id="start-tour" class="btn btn-link"><i class="fa fa-refresh"></i> Start Tour</button>
							<button type="button" id="global-volume" class="btn btn-link btn-global-volume"><i class="fa"></i></button>
							<div class="notifications">
								<ul>
									<!-- notification: inbox -->
									<li class="notification-item inbox">
										<div class="btn-group">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="fa fa-envelope"></i><span class="count">2</span>
												<span class="circle"></span>
											</a>
											<ul class="dropdown-menu" role="menu">
												<li class="notification-header">
													<em>You have 2 unread messages</em>
												</li>
												<li class="inbox-item clearfix">
													<a href="#">
														<div class="media">
															<div class="media-left">
																<img class="media-object" src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/img/user1.png" alt="Antonio">
															</div>
															<div class="media-body">
																<h5 class="media-heading name">Antonius</h5>
																<p class="text">The problem just happened this morning. I can't see ...</p>
																<span class="timestamp">4 minutes ago</span>
															</div>
														</div>
													</a>
												</li>
												<li class="inbox-item unread clearfix">
													<a href="#">
														<div class="media">
															<div class="media-left">
																<img class="media-object" src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/img/user2.png" alt="Antonio">
															</div>
															<div class="media-body">
																<h5 class="media-heading name">Michael</h5>
																<p class="text">Hey dude, cool theme!</p>
																<span class="timestamp">2 hours ago</span>
															</div>
														</div>
													</a>
												</li>
												<li class="inbox-item unread clearfix">
													<a href="#">
														<div class="media">
															<div class="media-left">
																<img class="media-object" src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/img/user3.png" alt="Antonio">
															</div>
															<div class="media-body">
																<h5 class="media-heading name">Stella</h5>
																<p class="text">Ok now I can see the status for each item. Thanks! :D</p>
																<span class="timestamp">Oct 6</span>
															</div>
														</div>
													</a>
												</li>
												<li class="inbox-item clearfix">
													<a href="#">
														<div class="media">
															<div class="media-left">
																<img class="media-object" src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/img/user4.png" alt="Antonio">
															</div>
															<div class="media-body">
																<h5 class="media-heading name">Jane Doe</h5>
																<p class="text"><i class="fa fa-reply"></i> Please check the status of your ...</p>
																<span class="timestamp">Oct 2</span>
															</div>
														</div>
													</a>
												</li>
												<li class="inbox-item clearfix">
													<a href="#">
														<div class="media">
															<div class="media-left">
																<img class="media-object" src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/img/user5.png" alt="Antonio">
															</div>
															<div class="media-body">
																<h5 class="media-heading name">John Simmons</h5>
																<p class="text"><i class="fa fa-reply"></i> I've fixed the problem :)</p>
																<span class="timestamp">Sep 12</span>
															</div>
														</div>
													</a>
												</li>
												<li class="notification-footer">
													<a href="#">View All Messages</a>
												</li>
											</ul>
										</div>
									</li>
									<!-- end notification: inbox -->
									<!-- notification: general -->
									<li class="notification-item general">
										<div class="btn-group">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<i class="fa fa-bell"></i><span class="count">8</span>
												<span class="circle"></span>
											</a>
											<ul class="dropdown-menu" role="menu">
												<li class="notification-header">
													<em>You have 8 notifications</em>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-comment green-font"></i>
														<span class="text">New comment on the blog post</span>
														<span class="timestamp">1 minute ago</span>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-user green-font"></i>
														<span class="text">New registered user</span>
														<span class="timestamp">12 minutes ago</span>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-comment green-font"></i>
														<span class="text">New comment on the blog post</span>
														<span class="timestamp">18 minutes ago</span>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-shopping-cart red-font"></i>
														<span class="text">4 new sales order</span>
														<span class="timestamp">4 hours ago</span>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-edit yellow-font"></i>
														<span class="text">3 product reviews awaiting moderation</span>
														<span class="timestamp">1 day ago</span>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-comment green-font"></i>
														<span class="text">New comment on the blog post</span>
														<span class="timestamp">3 days ago</span>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-comment green-font"></i>
														<span class="text">New comment on the blog post</span>
														<span class="timestamp">Oct 15</span>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="fa fa-warning red-font"></i>
														<span class="text red-font">Low disk space!</span>
														<span class="timestamp">Oct 11</span>
													</a>
												</li>
												<li class="notification-footer">
													<a href="#">View All Notifications</a>
												</li>
											</ul>
										</div>
									</li>
									<!-- end notification: general -->
								</ul>
							</div>
							<!-- logged user and the menu -->
							<div class="logged-user">
								<div class="btn-group">
									<a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
										<img src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/img/user-avatar.png" alt="User Avatar" />
										<span class="name">Stacy Rose</span> <span class="caret"></span>
									</a>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="#">
												<i class="fa fa-user"></i>
												<span class="text">Profile</span>
											</a>
										</li>
										<li>
											<a href="#">
												<i class="fa fa-cog"></i>
												<span class="text">Settings</span>
											</a>
										</li>
										<li>
											<a href="#">
												<i class="fa fa-power-off"></i>
												<span class="text">Logout</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<!-- end logged user and the menu -->
						</div>
						<!-- end top-bar-right -->
					</div>
				</div>
			</div>
			<!-- /container -->
		</div>
		<!-- END TOP BAR -->
		<!-- LEFT SIDEBAR -->
		<div id="left-sidebar" class="left-sidebar ">
			<div class="sidebar-minified js-toggle-minified">
				<i class="fa fa-exchange"></i>
			</div>
			<!-- main-nav -->
			<div class="sidebar-scroll">
				<nav class="main-nav">
					<ul class="main-menu">
						<li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-road fa-fw"></i><span class="text">Lotes</span>
							<i class="toggle-icon fa fa-angle-down"></i></a>
							<ul class="sub-menu">
								<li><a href=""><span class="text">Lote 1</span></a></li>
								<li><a href=""><span class="text">Lote 2</span></a></li>
								<li><a href=""><span class="text">Lote 3</span></a></li>
								<li><a href=""><span class="text">Lote 4</span></a></li>
								<li><a href=""><span class="text">Lote 5</span></a></li>
								<li><a href=""><span class="text">Lote 6</span></a></li>
							</ul>
						</li>
						<li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-dashboard"></i><span class="text">Dashboard </span>
							<i class="toggle-icon fa fa-angle-left"></i></a>
							<ul class="sub-menu ">
								<li><a href=""><span class="text">Análise 1</span></a></li>
								<li><a href=""><span class="text">Análise 2</span></a></li>
							</ul>
						</li>
						<li><a href="page-inbox.html"><i class="fa fa-pie-chart"></i><span class="text">Programa IRI/LVC</span></a></li>
						<li><a href="page-inbox.html"><i class="fa fa-road"></i><span class="text">Condição ICS</span></a></li>
						<li><a href="page-inbox.html"><i class="fa fa-gears"></i><span class="text">Gerenciadora</span></a></li>
						<li><a href="page-inbox.html"><i class="fa fa-university"></i><span class="text">Financeiro</span></a></li>
						<li><a href="page-inbox.html"><i class="fa fa-calendar"></i><span class="text">Calendário</span></a></li>
						<li><a href="page-inbox.html"><i class="fa fa-map-o"></i><span class="text">Mapas</span></a></li>
					</ul>
				</nav>
				<!-- /main-nav -->
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN CONTENT WRAPPER -->
		<div id="main-content-wrapper" class="content-wrapper ">
			<!-- top general alert -->
			<div class="alert alert-danger top-general-alert">
				<span>If you <strong>can't see the logo</strong> on the top left, please reset the style on right style switcher (for upgraded theme only).</span>
				<button type="button" class="close">&times;</button>
			</div>
			<!-- end top general alert -->
			<div class="row">
				<div class="col-md-4 ">
					<ul class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="#">Home</a></li>
						<li class="active">Dashboard</li>
					</ul>
				</div>
				<div class="col-md-8 ">
					<div class="top-content">
						<ul class="list-inline mini-stat">
							<li>
								<h5>TOTAL AVERIGUADO <span class="stat-value stat-color-orange"><i class="fa fa-plus-circle"></i> 35.450</span></h5>
								<span id="mini-bar-chart1" class="mini-bar-chart"></span>
							</li>
							<li>
								<h5>TOTAL MÊS <span class="stat-value stat-color-blue"><i class="fa fa-plus-circle"></i> 8.743</span></h5>
								<span id="mini-bar-chart2" class="mini-bar-chart"></span>
							</li>
							<li>
								<h5>% EXECUTADO <span class="stat-value stat-color-seagreen"><i class="fa fa-plus-circle"></i> 23.34%</span></h5>
								<span id="mini-bar-chart3" class="mini-bar-chart"></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- main -->
			<div class="content">
				<div class="main-header">
					<h2>DASHBOARD</h2>
					<em>informação prioritária.</em>
				</div>
				<div class="main-content">
					<div class="row">
						<div class="col-md-9">
							<!-- WIDGET NO HEADER -->
							<div class="widget widget-hide-header">
								<div class="widget-header hide">
									<h3>Summary Info</h3>
								</div>
								<div class="widget-content">
									<div class="row">
										<div class="col-md-3">
											<div class="easy-pie-chart blue" data-percent="70">
												<span class="percent">70</span>
											</div>
											<p class="text-center">AE 1</p>
										</div>
										<div class="col-md-3">
											<div class="easy-pie-chart green" data-percent="22">
												<span class="percent">22</span>
											</div>
											<p class="text-center">AE 2</p>
										</div>
										<div class="col-md-3">
											<div class="easy-pie-chart red" data-percent="65">
												<span class="percent">65</span>
											</div>
											<p class="text-center">AE 3</p>
										</div>
									</div>
								</div>
							</div>
							<!-- WIDGET NO HEADER -->
						</div>
						<div class="col-md-3">
							<!-- WIDGET REMINDER -->
							<div class="widget widget-hide-header widget-reminder">
								<div class="widget-header hide">
									<h3>Today's Reminder</h3>
								</div>
								<div class="widget-content">
									<div class="today-reminder">
										<h4 class="reminder-title">Project Meeting</h4>
										<p class="reminder-time"><i class="fa fa-clock-o"></i> 9:00 AM</p>
										<p class="reminder-place">War Room</p>
										<em class="reminder-notes">Bring weekly report summary</em>
										<i class="fa fa-bell"></i>
										<div class="btn-group btn-group-xs">
											<button type="button" class="btn btn-warning"><i class="fa fa-cloud-upload"></i> Sync</button>
											<div class="btn-group  btn-group-xs">
												<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Remind Me <span class="caret"></span></button>
												<ul class="dropdown-menu pull-right">
													<li><a href="#">15 minutes later</a></li>
													<li><a href="#">30 minutes later</a></li>
													<li><a href="#">1 hour later</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END WIDGET REMINDER -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<!-- WIDGET TABLE -->
							<div class="widget widget-table">
								<div class="widget-header">
									<h3><i class="fa fa-desktop"></i> Browser &amp; OS</h3>
									<div class="btn-group widget-header-toolbar">
										<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
										<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
										<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
									</div>
									<div class="btn-group widget-header-toolbar">
										<div class="control-inline toolbar-item-group">
											<span class="control-title">New Visits:</span>
											<div class="label label-success"><i class="fa fa-caret-up"></i> 3.5%</div>
										</div>
									</div>
								</div>
								<div class="widget-content">
									<table id="visit-stat-table" class="table table-sorting table-striped table-hover datatable">
										<thead>
											<tr>
												<th>Lote</th>
												<th>Mês</th>
												<th>Total</th>
												<th>%</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>90</td>
												<td>15.400</td>
												<td>16.78%</td>
											</tr>
											<tr>
												<td>2</td>
												<td>400</td>
												<td>5400</td>
												<td>16%</td>
											</tr>
											<tr>
												<td>3</td>
												<td>900</td>
												<td>4300</td>
												<td>20.2%</td>
											</tr>
											<tr>
												<td>4</td>
												<td>876</td>
												<td>94037</td>
												<td>78.1%</td>
											</tr>
											<tr>
												<td>5</td>
												<td>436</td>
												<td>9333</td>
												<td>77.8%</td>
											</tr>
											<tr>
												<td>6</td>
												<td>322</td>
												<td>6488</td>
												<td>9.7%</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- END WIDGET TABLE -->
							<!-- WIDGET DONUT AND PIE CHART -->
							<div class="widget">
								<div class="widget-header">
									<h3><i class="fa fa-truck"></i> Rede Rodoviária Nacional</h3> <em>- Tipo de Superfície</em>
									<div class="btn-group widget-header-toolbar">
										<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
										<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
										<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
									</div>
								</div>
								<div class="widget-content">
									<div class="demo-flot-chart" id="demo-donut-chart"></div>
									<div class="panel panel-default panel-pie-chart">
										<div class="panel-heading">
											<h3 class="panel-title">Lotes</h3></div>
										<div class="panel-body">
											<ul class="list-inline">
												<li><span id="mini-pie-chart1" class="mini-pie-chart"></span>
													<div>Lote 1</div>
												</li>
												<li><span id="mini-pie-chart2" class="mini-pie-chart"></span>
													<div>Lote 2</div>
												</li>
												<li><span id="mini-pie-chart3" class="mini-pie-chart"></span>
													<div>Lote 3</div>
												</li>
												<li><span id="mini-pie-chart4" class="mini-pie-chart"></span>
													<div>Lote 4</div>
												</li>
												<li><span id="mini-pie-chart5" class="mini-pie-chart"></span>
													<div>Lote 5</div>
												</li>
												<li><span id="mini-pie-chart6" class="mini-pie-chart"></span>
													<div>Lote 6</div>
												</li>
												
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- END WIDGET DONUT AND PIE CHART -->
						</div>
						<div class="col-md-6">
							<!-- WIDGET SALES MAP -->
							<div class="widget">
								<div class="widget-header">
									<h3><i class="fa fa-globe"></i>Mapa de Segmentos</h3> <em> - mapa de segmendos</em>
									<div class="btn-group widget-header-toolbar">
										<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
										<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
										<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
									</div>
								</div>
								<div class="widget-content">
									<div class="map-custom-width data-us-map">
										<div class="map"></div>
										<div class="plotLegend"></div>
									</div>
								</div>
							</div>
							<!-- END WIDGET SALES MAP -->
							<!-- WIDGET INLINE SPARKLINE -->
							<div class="widget widget-sparkline">
								<div class="widget-header">
									<h3><i class="fa fa-bar-chart-o"></i> Visits Stat</h3> <em>- Sparkline Charts With Random Data</em>
									<div class="btn-group widget-header-toolbar">
										<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
										<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
										<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
									</div>
								</div>
								<div class="widget-content">
									<div class="row first">
										<div class="col-md-6">
											<div class="sparkline-stat-item">
												<div class="info"><span>Visits</span><strong>1,363</strong></div>
												<span id="sparkline1" class="inlinesparkline">Loading...</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="sparkline-stat-item">
												<div class="info"><span>Unique Visitors</span><strong>1,221</strong></div>
												<span id="sparkline2" class="inlinesparkline">Loading...</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="sparkline-stat-item last">
												<div class="info"><span>Page Views</span><strong>2,300</strong></div>
												<span id="sparkline3" class="inlinesparkline">Loading...</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="sparkline-stat-item">
												<div class="info"><span>Pages/Visit</span><strong>1.19</strong></div>
												<span id="sparkline4" class="inlinesparkline">Loading...</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="sparkline-stat-item">
												<div class="info"><span>Avg. Visit Duration</span><strong>00:00:30</strong></div>
												<span id="sparkline5" class="inlinesparkline">Loading...</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="sparkline-stat-item last">
												<div class="info"><span>% New Visits</span><strong>28.35%</strong></div>
												<span id="sparkline6" class="inlinesparkline">Loading...</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END WIDGET INLINE SPARKLINE -->
						</div>
					</div>
					<div class="row">
						
						<div class="col-md-12">
							<!-- WIDGET CHART DATA SERIES -->
							<div class="widget widget-chart-toggle-series">
								<div class="widget-header">
									<h3><i class="fa fa-bar-chart-o"></i> Flot Chart: On/Off Data Series</h3> <em> - toggle on/off </em>
									<div class="btn-group widget-header-toolbar">
										<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
										<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
										<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
									</div>
								</div>
								<div class="widget-content">
									<div class="row">
										<div class="col-md-10">
											<div class="demo-flot-chart" id="demo-toggle-series-chart"></div>
										</div>
										<div class="col-md-2">
											<!-- must be id="choices" -->
											<div id="choices"></div>
											<div id="overview" class="demo-placeholder" style="float:right;width:160px; height:125px;"></div>
										</div>
									</div>
								</div>
							</div>
							<!-- WIDGET CHART DATA SERIES -->
						</div>
					</div>
					<!-- WIDGET TICKET TABLE -->
					<div class="widget widget-table">
						<div class="widget-header">
							<h3><i class="fa fa-group"></i> Support Tickets</h3> <em>- List of Support Tickets</em>
							<div class="btn-group widget-header-toolbar">
								<a href="#" title="Focus" class="btn-borderless btn-focus"><i class="fa fa-eye"></i></a>
								<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
								<a href="#" title="Remove" class="btn-borderless btn-remove"><i class="fa fa-times"></i></a>
							</div>
							<div class="widget-header-toolbar">
								<div class="label label-danger"><i class="fa fa-warning"></i> 2 Critical Messages</div>
							</div>
						</div>
						<div class="widget-content">
							<table id="ticket-table" class="table table-sorting">
								<thead>
									<tr>
										<th>Number</th>
										<th>Date</th>
										<th>Category</th>
										<th>Name</th>
										<th>Title</th>
										<th>Priority</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><a href="#">[#18765]</a></td>
										<td>Nov 21, 2013 15:45</td>
										<td>Front-End Site</td>
										<td>Smith</td>
										<td><a href="#">Product Review Problem</a></td>
										<td><span class="label label-high">#4 - High</span></td>
									</tr>
									<tr>
										<td><a href="#">[#18766]</a></td>
										<td>Nov 21, 2013 16:12</td>
										<td>Technical Support</td>
										<td>Sean</td>
										<td><a href="#">Can't Download the Guide Doc</a></td>
										<td><span class="label label-medium">#5 - Medium</span></td>
									</tr>
									<tr>
										<td><a href="#">[#18767]</a></td>
										<td>Nov 21, 2013 16:43</td>
										<td>General Info</td>
										<td>Jane Doe</td>
										<td><a href="#">Regarding Customer Support</a></td>
										<td><span class="label label-medium">#5 - Medium</span></td>
									</tr>
									<tr>
										<td><a href="#">[#18768]</a></td>
										<td>Nov 22, 2013 08:24</td>
										<td>General Info</td>
										<td>Smith</td>
										<td><a href="#">Can't Change My Address</a></td>
										<td><span class="label label-urgent">#3 - Urgent</span></td>
									</tr>
									<tr>
										<td><a href="#">[#18769]</a></td>
										<td>Nov 22, 2013 08:30</td>
										<td>Sales</td>
										<td>Smith</td>
										<td><a href="#">Review Tab Malfunction</a></td>
										<td><span class="label label-low">#6 - Low</span></td>
									</tr>
									<tr>
										<td><a href="#">[#18770]</a></td>
										<td>Nov 22, 2013 08:47</td>
										<td>Front-End Site</td>
										<td>John Doe</td>
										<td><a href="#">Broken Link</a></td>
										<td><span class="label label-emergency">#2 - Emergency</span></td>
									</tr>
									<tr>
										<td><a href="#">[#18771]</a></td>
										<td>Nov 23, 2013 14:08</td>
										<td>Sales</td>
										<td>Jack</td>
										<td><a href="#">Need Info About My Order Status</a></td>
										<td><span class="label label-critical">#1 - Critical</span></td>
									</tr>
									<tr>
										<td><a href="#">[#18772]</a></td>
										<td>Nov 23, 2013 17:45</td>
										<td>Techincal Support</td>
										<td>Darren</td>
										<td><a href="#">Bouncing Email</a></td>
										<td><span class="label label-critical">#1 - Critical</span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END WIDGET TICKET TABLE -->
				</div>
			</div>
			<!-- /main -->
			<!-- FOOTER -->
			<footer class="footer">
				&copy; 2016 The Develovers
			</footer>
			<!-- END FOOTER -->
		</div>
		<!-- END CONTENT WRAPPER -->
	</div>
	<!-- END WRAPPER -->
	
	<!-- Javascript -->
	<script src="<?php echo base_url()?>assets/portal/js/jquery-2.1.0.min.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo  base_url().'assets/portal/js/jquery.easypiechart.min.js'?>"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
	
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/stat/flot/jquery.flot.min.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/stat/flot/jquery.flot.resize.min.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/stat/flot/jquery.flot.time.min.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/stat/flot/jquery.flot.pie.min.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/stat/flot/jquery.flot.tooltip.min.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/stat/flot/jquery.flot.selection.min.js"></script>
	<!--
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/bootstrap/bootstrap.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/modernizr/modernizr.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/bootstrap-tour/bootstrap-tour.custom.js"></script>
	


	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/demo-style-switcher/assets/js/deliswitch.js"></script>
	
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/raphael/raphael-2.1.0.min.js"></script>
	
	
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/datatable/jquery.dataTables.min.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/datatable/dataTables.bootstrap.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/jquery-mapael/jquery.mapael.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/plugins/raphael/maps/usa_states.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/king-chart-stat.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/king-table.js"></script>
	<script src="http://demo.thedevelovers.com/dashboard/kingadmin-v1.6.1/assets/js/king-components.js"></script>
	
	 -->
	
	<script src="https://use.fontawesome.com/4058d20e68.js"></script>
	
<script>
$(document).ready(function(){


	//*******************************************
	/*	CHART AND STAT DEMO PAGE
	/********************************************/

	if( $('#demo-line-chart').length > 0 ) 
		chartYear( $('#demo-line-chart') );
	if( $('#demo-area-chart').length > 0 )
		chartWeek( $('#demo-area-chart') );
	if( $('#demo-vertical-bar-chart').length > 0 )
		chartBarVertical( $('#demo-vertical-bar-chart') );
	if( $('#demo-horizontal-bar-chart').length > 0 )
		chartBarHorizontal( $('#demo-horizontal-bar-chart') );
	if( $('#demo-multi-types-chart').length > 0 )
		chartMonth( $('#demo-multi-types-chart') );

	/* interactive chart demo page */
	if( $('#demo-toggle-series-chart').length > 0 ) {
		chartToggleSeries( $('#demo-toggle-series-chart') );
	}

	if( $('#demo-select-zoom-chart').length > 0 ) {
		chartSelectZoomSeries( $('#demo-select-zoom-chart') );
	}

	/* real-time chart demo */
	if ( $('#demo-real-time-chart').length > 0  ) {
		chartRealtTime($('#demo-real-time-chart'), "bar");
	}

	/* javascript helper functions */
	function showTooltip(x, y, contents) {

		$("<div id='tooltip' class='flot-tooltip'>" + contents + "</div>").css({
			top: y + 5,
			left: x + 5,
		}).appendTo("body").fadeIn(200);
	}

	// get day function
	function gt(y, m, d) {
		return new Date(y, m-1, d).getTime();
	}

	function donutLabelFormatter(label, series) {
		return "<div class=\"donut-label\">" + label + "<br/>" + Math.round(series.percent) + "%</div>";
	}

	function randomVal(){
		return Math.floor( Math.random() * 80 );
	}

	// init flot chart: current week
	function chartWeek(placeholder) {

		var visit = [
			[gt(2013, 10, 21), 188], [gt(2013, 10, 22), 185], [gt(2013, 10, 23), 250], [gt(2013, 10, 24), 230], [gt(2013, 10, 25), 275], [gt(2013, 10, 26), 190], [gt(2013, 10, 27), 230]
		];

		var val = [
			[gt(2013, 10, 21), 100], [gt(2013, 10, 22),50], [gt(2013, 10, 23),95], [gt(2013, 10, 24),105], [gt(2013, 10, 25),125], [gt(2013, 10, 26),90], [gt(2013, 10, 27),155]
		];

		var plot = $.plot(placeholder, 
			[
				{
					data: visit,
					label: "Visits",
					lines: {
						show: true,
						lineWidth: 2,
						fill: true,
					},
					points: {
						show: true, 
						lineWidth: 3,
						fill: true,
						fillColor: "#fafafa"
					}
				},
				{
					data: val,
					label: "Sales",
					lines: {
						show: true,
						fill: true
					},
					points: {
						show: true, 
						fill: true,
						fillColor: "#fafafa"
					},
				}
			], 

			{
			series: {
				lines: {
					lineWidth: 2,
					fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.1 } ] }
				},
				points: {
					lineWidth: 3,
				},

				shadowSize: 0
			},
			grid: {
				hoverable: true, 
				clickable: true,
				borderWidth: 0,
				tickColor: "#E4E4E4"
			},
			colors: ["#7d939a", "#1D92AF"],
			yaxis: {
				font: { color: "#555" },
				ticks: 8
			},
			xaxis: {
				mode: "time",
				timezone: "browser",
				minTickSize: [1, "day"],
				timeformat: "%a",
				font: { color: "#555" },
				tickColor: "#fafafa",
				autoscaleMargin: 0.02
			},
			legend: {
				labelBoxBorderColor: "transparent",
				backgroundColor: "transparent"
			},
			tooltip: true,
			tooltipOpts: {
				content: '%s: %y'
			}

		});
	}

	// init flot chart: current month
	function chartMonth(placeholder) {

		var visit = [
			[gt(2013, 10, 1), 100], [gt(2013, 10, 2), 140], [gt(2013, 10, 3), 160], [gt(2013, 10, 4),190], [gt(2013, 10, 5),170], [gt(2013, 10, 6), 200], [gt(2013, 10, 7), 220],
			[gt(2013, 10, 8), 250], [gt(2013, 10, 9),280], [gt(2013, 10, 10), 240], [gt(2013, 10, 11), 250], [gt(2013, 10, 12), 260], [gt(2013, 10, 13), 300], [gt(2013, 10, 14), 320],
			[gt(2013, 10, 15), 330], [gt(2013, 10, 16), 370], [gt(2013, 10, 17), 390], [gt(2013, 10, 18), 350], [gt(2013, 10, 19), 340], [gt(2013, 10, 20), 320], [gt(2013, 10, 21), 370],
			[gt(2013, 10, 22), 400], [gt(2013, 10, 23), 440], [gt(2013, 10, 24), 450], [gt(2013, 10, 25), 470], [gt(2013, 10, 26), 450], [gt(2013, 10, 27), 500], [gt(2013, 10, 28), 540],
			[gt(2013, 10, 29), 600], [gt(2013, 10, 30), 580], [gt(2013, 10, 31), 620]
		];

		var val = [
			[gt(2013, 10, 1), 20], [gt(2013, 10, 2), 28], [gt(2013, 10, 3), 32], [gt(2013, 10, 4), 40], [gt(2013, 10, 5), 35], [gt(2013, 10, 6), 40], [gt(2013, 10, 7), 45],
			[gt(2013, 10, 8), 25], [gt(2013, 10, 9), 60], [gt(2013, 10, 10), 48], [gt(2013, 10, 11), 53], [gt(2013, 10, 12), 58], [gt(2013, 10, 13), 60], [gt(2013, 10, 14), 65],
			[gt(2013, 10, 15), 66], [gt(2013, 10, 16), 60], [gt(2013, 10, 17), 79], [gt(2013, 10, 18), 75], [gt(2013, 10, 19), 34], [gt(2013, 10, 20), 32], [gt(2013, 10, 21), 75],
			[gt(2013, 10, 22), 88], [gt(2013, 10, 23), 99], [gt(2013, 10, 24), 86], [gt(2013, 10, 25), 83], [gt(2013, 10, 26), 45], [gt(2013, 10, 27), 50], [gt(2013, 10, 28), 100],
			[gt(2013, 10, 29), 125], [gt(2013, 10, 30), 110], [gt(2013, 10, 31), 130]
		];

		var plot = $.plot(placeholder, 
			[
				{
					data: visit,
					label: "Visits",
					bars: {
						show: true,
						fill: false,
						barWidth: 0.1,
						align: "center",
						lineWidth: 18
					}
				},
				{
					data: val,
					label: "Sales"
				}
			], 

			{
				series: {
					lines: {
						show: true,
						lineWidth: 2, 
						fill: false
					},
					points: {
						show: true, 
						lineWidth: 3,
						fill: true,
						fillColor: "#fafafa"
					},
					shadowSize: 0
				},
				grid: {
					hoverable: true, 
					clickable: true,
					borderWidth: 0,
					tickColor: "#E4E4E4",
					
				},
				colors: ["rgba(217,217,217, 0.3)", "#d7ea2b"],
				yaxis: {
					font: { color: "#555" },
					ticks: 8,
				},
				xaxis: {
					mode: "time",
					timezone: "browser",
					minTickSize: [1, "day"],
					font: { color: "#555" },
					tickColor: "#fafafa",
					autoscaleMargin: 0.02
				},
				legend: {
					labelBoxBorderColor: "transparent",
					backgroundColor: "transparent"
				},
				tooltip: true,
				tooltipOpts: {
					content: '%s: %y'
				}
			}
		); 

	}

	// init flot chart: current year
	function chartYear(placeholder) {

		var visit = [
			[gt(2013, 1, 1), 200], [gt(2013, 2, 1), 300], [gt(2013, 3, 1), 360], [gt(2013, 4, 1), 340], [gt(2013, 5, 1), 440], [gt(2013, 6, 1), 600], [gt(2013, 7, 1), 1050],
			[gt(2013, 8, 1), 1700], [gt(2013, 9, 1), 1100], [gt(2013, 10, 1), 1200], [gt(2013, 11, 1), 1300], [gt(2013, 12, 1), 1500]
		];

		var val = [
			[gt(2013, 1, 1), 100], [gt(2013, 2, 1), 155], [gt(2013, 3, 1), 180], [gt(2013, 4, 1), 172], [gt(2013, 5, 1), 222], [gt(2013, 6, 1), 300], [gt(2013, 7, 1), 550],
			[gt(2013, 8, 1), 452], [gt(2013, 9, 1), 552], [gt(2013, 10, 1), 600], [gt(2013, 11, 1), 680], [gt(2013, 12, 1), 750]
		];

		var plot = $.plot(placeholder, 
			[
				{
					data: visit,
					label: "Visits"
				},
				{
					data: val,
					label: "Sales"

				}
			], 

			{
				series: {
					lines: {
						show: true,
						lineWidth: 2, 
						fill: false
					},
					points: {
						show: true, 
						lineWidth: 3,
						fill: true,
						fillColor: "#fafafa"
					},
					shadowSize: 0
				},
				grid: {
					hoverable: true, 
					clickable: true,
					borderWidth: 0,
					tickColor: "#E4E4E4",
					
				},
				colors: ["#d9d9d9", "#5399D6"],
				yaxis: {
					font: { color: "#555" },
					ticks: 8,
				},
				xaxis: {
					mode: "time",
					timezone: "browser",
					minTickSize: [1, "month"],
					font: { color: "#555" },
					tickColor: "#fafafa",
					autoscaleMargin: 0.02
				},
				legend: {
					labelBoxBorderColor: "transparent",
					backgroundColor: "transparent"
				},
				tooltip: true,
				tooltipOpts: {
					content: '%s: %y'
				}
			}
		);
	}

	// init flot chart: vertical bar chart
	function chartBarVertical(placeholder) {
		var basic = [
			[gt(2013, 10, 21), 188], [gt(2013, 10, 22), 205], [gt(2013, 10, 23), 250], [gt(2013, 10, 24), 230], [gt(2013, 10, 25), 245], [gt(2013, 10, 26), 260], [gt(2013, 10, 27), 290]
		];

		var gold = [
			[gt(2013, 10, 21), 100], [gt(2013, 10, 22), 110], [gt(2013, 10, 23), 155], [gt(2013, 10, 24), 120], [gt(2013, 10, 25), 135], [gt(2013, 10, 26), 150], [gt(2013, 10, 27), 175]
		];

		var platinum = [
			[gt(2013, 10, 21), 75], [gt(2013, 10, 22), 65], [gt(2013, 10, 23), 80], [gt(2013, 10, 24), 60], [gt(2013, 10, 25), 65], [gt(2013, 10, 26), 80], [gt(2013, 10, 27), 110]
		];

		var plot = $.plot(placeholder, 
			[
				{
					data: basic,
					label: "Basic"
				},
				{
					data: gold,
					label: "Gold"
				},
				{
					data: platinum,
					label: "Platinum"
				}
			], 
			{
				bars: {
					show: true,
					barWidth: 15*60*60*300,
					fill: true,
					order: true,
					lineWidth: 0,
					fillColor: { colors: [ { opacity: 1 }, { opacity: 1 } ] }
				},
				grid: {
					hoverable: true, 
					clickable: true,
					borderWidth: 0,
					tickColor: "#E4E4E4",
					
				},
				colors: ["#d9d9d9", "#5399D6", "#d7ea2b"],
				yaxis: {
					font: { color: "#555" },
				},
				xaxis: {
					mode: "time",
					timezone: "browser",
					minTickSize: [1, "day"],
					timeformat: "%a",
					font: { color: "#555" },
					tickColor: "#fafafa",
					autoscaleMargin: 0.2
				},
				legend: {
					labelBoxBorderColor: "transparent",
					backgroundColor: "transparent"
				},
				tooltip: true,
				tooltipOpts: {
					content: '%s: %y'
				}
			}
		);
	}

	// init flot chart: horizontal bar chart
	function chartBarHorizontal(placeholder) {
		var basic = [
			[188, 1], [200, 2], [225, 3], [230, 4], [250, 5]
		];

		var gold = [
			[200, 1], [220, 2], [210, 3], [240, 4], [240, 5]
		];

		var platinum = [
			[100, 1], [90, 2], [150, 3], [200, 4], [235, 5]
		];

		var plot = $.plot(placeholder, 
			[
				{
					data: basic,
					label: "Basic"
				},
				{
					data: gold,
					label: "Gold"
				},
				{
					data: platinum,
					label: "Platinum"
				}
			], 
			{
				bars: {
					show: true,
					horizontal: true,
					barWidth: 0.2,
					fill: true,
					order: true,
					lineWidth: 0,
					fillColor: { colors: [ { opacity: 1 }, { opacity: 1 } ] }
				},
				grid: {
					hoverable: true, 
					clickable: true,
					borderWidth: 0,
					tickColor: "#E4E4E4",
					
				},
				colors: ["#d9d9d9", "#5399D6", "#d7ea2b"],
				xaxis: {
					autoscaleMargin: 0.2
				},
				legend: {
					labelBoxBorderColor: "transparent",
					backgroundColor: "transparent"
				},
				tooltip: true,
				tooltipOpts: {
					content: '%s: %x'
				}
			}
		);
	}

	// init interactive flot chart: toggle on/off data series
	function chartToggleSeries(placeholder) {

		var datasets = {
			"lote1": {
				label: "Lote 1",
				
			},
			"lote2": {
				label: "Lote 2",
				data: [[1, 5000], [2, 6790], [3, 4576], [4, 4019], [5, 3895], [6, 5832], [7, 5201], [8, 6954], [9, 8764], [10, 2053], [11, 4389], [12, 3294]]
			},
			"lote3": {
				label: "Lote 3",
				data: [[1, 3940], [2, 5200], [3, 5476], [4, 5069], [5, 6839], [6, 9723], [7, 5472], [8, 3452], [9, 7165], [10, 6563], [11, 5736], [12, 4657]]
			},
			"lote4": {
				label: "Lote 4",
				data: [[1, 2952], [2, 4200], [3, 4019], [4, 6094], [5, 9283], [6, 1436], [7, 7626], [8, 1298], [9, 6935], [10, 7462], [11, 5983], [12, 7654]]
			},
			"lote5": {
				label: "Lote 5",
				data: [[1, 6937], [2, 2200], [3, 4000], [4, 3572], [5, 3278], [6, 4758], [7, 3426], [8, 2946], [9, 3693], [10, 2994], [11, 8736], [12, 6583]]
			},
			"lote6": {
				label: "Lote 6",
				data: [[1, 4728], [2, 3200], [3, 3895], [4, 8593], [5, 7380], [6, 9583], [7, 7241], [8, 8634], [9, 4038], [10, 3864], [11, 6254], [12, 8356]]
			}
		};

		// hard-code color indices to prevent them from shifting as countries are turned on/off
		var i = 0;
		$.each(datasets, function(key, val) {
			val.color = i;
			++i;
		});

		// insert checkboxes 
		var choiceContainer = $("#choices");
		$.each( datasets, function( key, val ) {

			choiceContainer.append(
				"<label class='fancy-checkbox custom-bgcolor-green'><input type='checkbox' name='" + key + "' checked='checked' id='id" + key + "'><span for='id" + key + "'>" + val.label + "</span></label>"
			);
		});

		choiceContainer.find("input").click( function() {
			plotAccordingToChoices(placeholder, datasets);
		});

		
		plotAccordingToChoices(placeholder, datasets);
	}

	function plotAccordingToChoices(placeholder, datasets) {

		var data = [];

		$("#choices").find("input:checked").each(function () {
			var key = $(this).attr("name");
			if (key && datasets[key]) {
				data.push(datasets[key]);
			}
		});

		if (data.length > 0) {
			var plot = $.plot( placeholder, data, {
				series: {
					lines: {
						show: true,
						lineWidth: 2, 
						fill: false
					},
					points: {
						show: true, 
						lineWidth: 3,
						fill: true,
						fillColor: "#fafafa"
					},
					shadowSize: 0
				},

				grid: {
					hoverable: true, 
					clickable: true,
					borderWidth: 0,
					tickColor: "#E4E4E4",
				},
				xaxis: {
					tickDecimals: 0,
					autoscaleMargin: 0.1,
					tickColor: "#fafafa"
				},
				yaxis: {
					min: 0,
					max: 15000
				},
				colors: ["#d9d9d9", "#5399D6", "#d7ea2b", "#f30", "#E7A13D"],
				legend: {
					labelBoxBorderColor: "transparent",
					backgroundColor: "transparent",
					noColumns: 4
				},
				tooltip: true,
				tooltipOpts: {
					content: '%s: y%km'
				},
				selection: {
					mode: "xy"
				}
			});
			
		}

		/*
		var overview = $.plot("#overview", data, {
			legend: {
				show: false
			},
			series: {
				lines: {
					show: true,
					lineWidth: 1
				},
				shadowSize: 0
			},
			xaxis: {
				ticks: 4
			},
			yaxis: {
				ticks: 3,
				min: 0,
				max: 15000
			},
			grid: {
				color: "#999"
			},
			selection: {
				mode: "xy"
			}
		});

		
		$("#overview").bind("plotselected", function (event, ranges) {
			
			plot.setSelection(ranges);
			if (ranges.xaxis.to - ranges.xaxis.from < 0.00001) {
				ranges.xaxis.to = ranges.xaxis.from + 0.00001;
			}

			if (ranges.yaxis.to - ranges.yaxis.from < 0.00001) {
				ranges.yaxis.to = ranges.yaxis.from + 0.00001;
			}

			
			console.log(ranges);
			
			plot = $.plot("#choices", getData(ranges.xaxis.from, ranges.xaxis.to),
				$.extend(true, {}, options, {
					xaxis: { min: ranges.xaxis.from, max: ranges.xaxis.to },
					yaxis: { min: ranges.yaxis.from, max: ranges.yaxis.to }
				})
			);

			overview.setSelection(ranges, true);
			//console.log(ranges);
		});
		*/
	}

	// init flot chart: select and zoom
	function chartSelectZoomSeries(placeholder) {

		var data = [{
			label: "United States",
			data: [[1990, 18.9], [1991, 18.7], [1992, 18.4], [1993, 19.3], [1994, 19.5], [1995, 19.3], [1996, 19.4], [1997, 20.2], [1998, 19.8], [1999, 19.9], [2000, 20.4], [2001, 20.1], [2002, 20.0], [2003, 19.8], [2004, 20.4]]
		}, {
			label: "Russia", 
			data: [[1992, 13.4], [1993, 12.2], [1994, 10.6], [1995, 10.2], [1996, 10.1], [1997, 9.7], [1998, 9.5], [1999, 9.7], [2000, 9.9], [2001, 9.9], [2002, 9.9], [2003, 10.3], [2004, 10.5]]
		}, {
			label: "United Kingdom",
			data: [[1990, 10.0], [1991, 11.3], [1992, 9.9], [1993, 9.6], [1994, 9.5], [1995, 9.5], [1996, 9.9], [1997, 9.3], [1998, 9.2], [1999, 9.2], [2000, 9.5], [2001, 9.6], [2002, 9.3], [2003, 9.4], [2004, 9.79]]
		}, {
			label: "Germany",
			data: [[1990, 12.4], [1991, 11.2], [1992, 10.8], [1993, 10.5], [1994, 10.4], [1995, 10.2], [1996, 10.5], [1997, 10.2], [1998, 10.1], [1999, 9.6], [2000, 9.7], [2001, 10.0], [2002, 9.7], [2003, 9.8], [2004, 9.79]]
		}, {
			label: "Denmark",
			data: [[1990, 9.7], [1991, 12.1], [1992, 10.3], [1993, 11.3], [1994, 11.7], [1995, 10.6], [1996, 12.8], [1997, 10.8], [1998, 10.3], [1999, 9.4], [2000, 8.7], [2001, 9.0], [2002, 8.9], [2003, 10.1], [2004, 9.80]]
		}, {
			label: "Sweden",
			data: [[1990, 5.8], [1991, 6.0], [1992, 5.9], [1993, 5.5], [1994, 5.7], [1995, 5.3], [1996, 6.1], [1997, 5.4], [1998, 5.4], [1999, 5.1], [2000, 5.2], [2001, 5.4], [2002, 6.2], [2003, 5.9], [2004, 5.89]]
		}];

		var options = {
			series: {
				lines: {
					show: true,
					lineWidth: 2, 
					fill: false
				},
				points: {
					show: true, 
					lineWidth: 3,
					fill: true,
					fillColor: "#fafafa"
				},
				shadowSize: 0
			},
			grid: {
				hoverable: true, 
				clickable: true,
				borderWidth: 0,
				tickColor: "#E4E4E4",
				
			},
			legend: {
				noColumns: 3,
				labelBoxBorderColor: "transparent",
				backgroundColor: "transparent"
			},
			xaxis: {
				tickDecimals: 0,
				tickColor: "#fafafa"
			},
			yaxis: {
				min: 0
			},
			colors: ["#d9d9d9", "#5399D6", "#d7ea2b", "#f30", "#E7A13D"],
			tooltip: true,
			tooltipOpts: {
				content: '%s: %y'
			},
			selection: {
				mode: "x"
			}
		};

		var plot = $.plot(placeholder, data, options);

		placeholder.bind("plotselected", function (event, ranges) {

			plot = $.plot(placeholder, data, $.extend(true, {}, options, {
				xaxis: {
					min: ranges.xaxis.from,
					max: ranges.xaxis.to
				}
			}));
		});

		$('#reset-chart-zoom').click( function() {
			plot.setSelection({
				xaxis: {
					from: 1990,
					to: 2004
				}
			});
		});
	}

	// init flot chart: real-time
	var plotOptions;
	function chartRealtTime(placeholder, type) {
		var dataset;
		var cpuData = [];
			totalPoints = 200;
			updateInterval = 1000; // 1000ms
			now = new Date().getTime();

		plotOptions = {
			series: {
				shadowSize: 0, // Drawing is faster without shadows
				lines: {
					fill: false
				},
			},
			grid: {
				borderWidth: 0
			},
			colors: ["#5399D6"],
			yaxis: {
				min: 0,
				max: 100,
				tickSize: 5,
				tickFormatter: function (v, axis) {
					if (v % 10 == 0) {
						return v + "%";
					} else {
						return "";
					}
				},
				tickColor: "#e4e4e4",
			},
			xaxis: {
				mode: "time",
				tickSize: [2, "second"],
				tickFormatter: function (v, axis) {
					var date = new Date(v);
		 
					if (date.getSeconds() % 20 == 0) {
						var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
						var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
						var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
		 
						return hours + ":" + minutes + ":" + seconds;
					} else {
						return "";
					}
				},
				tickColor: "transparent",
			},
			legend: {
				show: false
			}
		}

		if ( type == "area") {
			plotOptions.series.lines = {
				fill: true,
				fillColor: "#92D135"
			};

			plotOptions.colors = ["#72AC1C"];

		} else if ( type == "bar") {
			plotOptions.series.bars = {
				show: true,
				barWidth: 1,
				fill: false,
			}

			plotOptions.colors = ["#7d939a"];
		}

		getRandomData();
		dataset = [
			{ data: cpuData }
		];
		
		$.plot(placeholder, dataset, plotOptions);

		update();

		function update() {
			getRandomData();

			$.plot(placeholder, dataset, plotOptions);
			setTimeout(update, updateInterval);
		}

		function getRandomData() {

			cpuData.shift();

			while (cpuData.length < totalPoints) {
				var y = Math.random() * 100;
				var temp = [now += updateInterval, y];
		 
				cpuData.push(temp);
			}
		}
	}

	$('.btn-change-chart').click( function(){
		plotOptions.series.lines = {
			fill: true,
			fillColor: "#92D135"
		};

		plotOptions.colors = ["#72AC1C"];

	});

	if( $('#select-chart-type').length > 0) {
		$('#select-chart-type').multiselect({
			dropRight: true
		});

		$('#select-chart-type').change( function() {

			var chartType = $(this).val();

			if( chartType == 'area' ) {
				plotOptions.series.bars = {
					show: false,
				}

				plotOptions.series.lines = {
					fill: true,
					fillColor: "#92D135"
				};
				plotOptions.colors = ["#72AC1C"];

			}else if( chartType == 'bar') {
				plotOptions.series.bars = {
					show: true,
					barWidth: 1,
					fill: false,
				}
				plotOptions.colors = ["#F30"];

			}else if( chartType == 'line' ) {
				plotOptions.series.bars = {
					show: false,
				}

				plotOptions.series.lines = {
					fill: false,
				};
				plotOptions.colors = ["#5399D6"];

			}

		});
	}

	/* d3 charts: heatmap */
	if( $('#demo-d3-heatmap').length > 0 ) {

		var dataHeat = "assets/js/plugins/stat/data-heatmap.tsv"; // path/to/your/datafile.tsv
		var placeholderHeat = "#demo-d3-heatmap"; // chart placeholder or container

		var margin = { top: 50, right: 0, bottom: 100, left: 30 },
			width = 960 - margin.left - margin.right,
			height = 430 - margin.top - margin.bottom,
			gridSize = Math.floor(width / 24),
			legendElementWidth = gridSize*2,
			buckets = 9,
			colors = colorbrewer.YlOrRd[9],
			days = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
			times = ["1a", "2a", "3a", "4a", "5a", "6a", "7a", "8a", "9a", "10a", "11a", "12a", "1p", "2p", "3p", "4p", "5p", "6p", "7p", "8p", "9p", "10p", "11p", "12p"];

		d3.tsv(dataHeat,
			function(d) {
				return {
					day: +d.day,
					hour: +d.hour,
					value: +d.value
				};
			},

			function(error, data) {
				var colorScale = d3.scale.quantile()
					.domain([0, buckets - 1, d3.max(data, function (d) { return d.value; })])
					.range(colors);
				
				var svg = d3.select(placeholderHeat).append("svg")
					.attr("width", width + margin.left + margin.right)
					.attr("height", height + margin.top + margin.bottom)
					.attr('viewBox','0 0 '+ width +' '+ (height + margin.top + margin.bottom))
					.attr('preserveAspectRatio','xMidYMid')
					.append("g")
					.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

				var dayLabels = svg.selectAll(".dayLabel")
					.data(days)
					.enter().append("text")
					.text(function (d) { return d; })
					.attr("x", 0)
					.attr("y", function (d, i) { return i * gridSize; })
					.style("text-anchor", "end")
					.attr("transform", "translate(-6," + gridSize / 1.5 + ")")
					.attr("class", function (d, i) { return ((i >= 0 && i <= 4) ? "dayLabel mono axis axis-workweek" : "dayLabel mono axis"); });

				var timeLabels = svg.selectAll(".timeLabel")
					.data(times)
					.enter().append("text")
					.text(function(d) { return d; })
					.attr("x", function(d, i) { return i * gridSize; })
					.attr("y", 0)
					.style("text-anchor", "middle")
					.attr("transform", "translate(" + gridSize / 2 + ", -6)")
					.attr("class", function(d, i) { return ((i >= 7 && i <= 16) ? "timeLabel mono axis axis-worktime" : "timeLabel mono axis"); });

				var heatMap = svg.selectAll(".hour")
					.data(data)
					.enter().append("rect")
					.attr("x", function(d) { return (d.hour - 1) * gridSize; })
					.attr("y", function(d) { return (d.day - 1) * gridSize; })
					.attr("rx", 4)
					.attr("ry", 4)
					.attr("class", "hour bordered")
					.attr("width", gridSize)
					.attr("height", gridSize)
					.style("fill", colors[0]);

				heatMap.transition().duration(1000).style("fill", function(d) { return colorScale(d.value); });
				heatMap.append("title").text(function(d) { return d.value; });
				  
				var legend = svg.selectAll(".legend")
					.data([0].concat(colorScale.quantiles()), function(d) { return d; })
					.enter().append("g")
					.attr("class", "legend");

				legend.append("rect")
					.attr("x", function(d, i) { return legendElementWidth * i; })
					.attr("y", height)
					.attr("width", legendElementWidth)
					.attr("height", gridSize / 2)
					.style("fill", function(d, i) { return colors[i]; });

				legend.append("text")
					.attr("class", "mono")
					.text(function(d) { return "â‰¥ " + Math.round(d); })
					.attr("x", function(d, i) { return legendElementWidth * i; })
					.attr("y", height + gridSize);
			}
		);
	}

	/* d3 chart: bar chart with negative values */
	if( $('#demo-d3-barchart').length > 0 ) {
		var dataBar = "assets/js/plugins/stat/data-barchart.tsv"; // path/to/your/datafile.tsv
		var placeholderBar = "#demo-d3-barchart"; // placeholder or container
	
		var marginBar = {top: 30, right: 10, bottom: 10, left: 10},
			widthBar = 960 - marginBar.left - marginBar.right,
			heightBar = 500 - marginBar.top - marginBar.bottom;

		var x = d3.scale.linear().range([0, widthBar]);
		var y = d3.scale.ordinal().rangeRoundBands([0, heightBar], .2);

		var xAxis = d3.svg.axis()
			.scale(x)
			.orient("top");

		var svg = d3.select(placeholderBar).append("svg")
			.attr("width", widthBar + marginBar.left + marginBar.right)
			.attr("height", heightBar + marginBar.top + marginBar.bottom)
			.attr('viewBox','0 0 '+ width +' '+ (heightBar + margin.top + margin.bottom))
			.attr('preserveAspectRatio','xMidYMid')
			.append("g")
			.attr("transform", "translate(" + marginBar.left + "," + marginBar.top + ")");

		d3.tsv(dataBar, 
			function(d) {
				d.value = +d.value;
				return d;
			}, 

			function(error, data) {
				x.domain(d3.extent(data, function(d) { return d.value; })).nice();
				y.domain(data.map(function(d) { return d.name; }));

			svg.selectAll(".bar")
				.data(data)
				.enter().append("rect")
				.attr("class", function(d) { return d.value < 0 ? "bar negative" : "bar positive"; })
				.attr("x", function(d) { return x(Math.min(0, d.value)); })
				.attr("y", function(d) { return y(d.name); })
				.attr("width", function(d) { return Math.abs(x(d.value) - x(0)); })
				.attr("height", y.rangeBand());

			svg.append("g")
				.attr("class", "x axis")
				.call(xAxis);

			svg.append("g")
				.attr("class", "y axis")
				.append("line")
				.attr("x1", x(0))
				.attr("x2", x(0))
				.attr("y2", heightBar);
			}
		);
	}

	
	
	//*******************************************
	/*	EASY PIE CHART
	/********************************************/

	if( $('.easy-pie-chart').length > 0 ) {

		var cOptions = {
				delay: 3000,
				barColor: '#69c',
				trackColor: '#ace',
				scaleColor: false,
				lineWidth: 20,
				trackWidth: 16,
				lineCap: 'butt',
				onStep: function(from, to, percent) {
					$(this.el).find('.percent').text(Math.round(percent));
				}
		}

		$('.easy-pie-chart.blue').easyPieChart(cOptions);
		
		cOptions.barColor = '#EE6E73';
		cOptions.trackColor = '#F29396';
		$('.easy-pie-chart.red').easyPieChart(cOptions);
		
		cOptions.barColor = '#66BB6A';
		cOptions.trackColor = '#89CB8C';
		$('.easy-pie-chart.green').easyPieChart(cOptions);
		
	}

	//*******************************************
	/*	MINI BAR CHART
	/********************************************/

	if( $('.mini-bar-chart').length > 0 ) {
		var values = getRandomValues();
		var params = {
			type: 'bar',
			barWidth: 5,
			height: 25
		}

		params.barColor = '#CE7B11';
		$('#mini-bar-chart1').sparkline(values[0], params);
		params.barColor = '#1D92AF';
		$('#mini-bar-chart2').sparkline(values[1], params);
		params.barColor = '#3F7577';
		$('#mini-bar-chart3').sparkline(values[2], params);
	}

	//*******************************************
	/*	DONUT CHART
	/********************************************/

	if( $('#visit-chart, #demo-donut-chart').length > 0 ) {
		var data = [
			{ label: "Pavimentada",  data: 12},
			{ label: "Planejada",  data: 7.6},
			{ label: "Não Pavimentada", data: 80.4}
		];

		$.plot('#visit-chart, #demo-donut-chart', data, {
			series: {
				pie: {
					show: true,
					innerRadius: .4,
					stroke: {
						width: 4,
						color: "#F9F9F9"
					},
					label: {
						show: true,
						radius: 3/4,
						formatter: donutLabelFormatter
					}
				},
			},
			legend: {
				show: false
			},
			grid: {
				hoverable: true
			},
			colors: ["#7d939a", "#5399D6", "#d7ea2b"],
		});
	}

	if( $('#investment-donut-chart').length > 0 ) {
		var data = [
			{ label: "Stock",  data: 55},
			{ label: "Mutual Fund",  data: 8},
			{ label: "Fixed Assets", data: 18},
			{ label: "Forex", data: 12},
			{ label: "Others", data: 7}
		];

		$.plot('#investment-donut-chart', data, {
			series: {
				pie: {
					show: true,
					//innerRadius: 0,
					stroke: {
						width: 0,
						color: "#F9F9F9"
					},
					label: {
						show: true,
						radius: 3/4,
						formatter: donutLabelFormatter
					}
				},
			},
			legend: {
				show: false
			},
			grid: {
				hoverable: true
			},
			colors: ["#f98114", "#88f914", "#f91465", "#1461f9", "#f9d614"],
		});
	}

	//*******************************************
	/*	MINI PIE CHART
	/********************************************/

	if( $('.mini-pie-chart').length > 0 ) {
		var visitData = [[30, 15, 55], [65, 25, 10], [55, 15, 30], [25, 25, 50], [40, 35, 25], [70, 15, 15], [15, 25, 60]];
		var params = {
			type: "pie",
			sliceColors: ["#7d939a", "#5399D6", "#d7ea2b"], 
			height: "30px",
		}

		$('#mini-pie-chart1').sparkline(visitData[0], params);
		$('#mini-pie-chart2').sparkline(visitData[1], params);
		$('#mini-pie-chart3').sparkline(visitData[2], params);
		$('#mini-pie-chart4').sparkline(visitData[3], params);
		$('#mini-pie-chart5').sparkline(visitData[4], params);
		$('#mini-pie-chart6').sparkline(visitData[5], params);
	}

	
	//*******************************************
	/*	AUXILIAR METHODS
	/********************************************/
	
	function getRandomValues() {
		// data setup
		var values = new Array(20);

		for (var i = 0; i < values.length; i++){
			values[i] = [5 + randomVal(), 10 + randomVal(), 15 + randomVal(), 20 + randomVal(), 30 + randomVal(),
				35 + randomVal(), 40 + randomVal(), 45 + randomVal(), 50 + randomVal()]
		}

		return values;
	}

	function randomVal(){
		return Math.floor( Math.random() * 80 );
	}

	function donutLabelFormatter(label, series) {
		return "<div class=\"donut-label\">" + label + "<br/>" + Math.round(series.percent) + "%</div>";
	}
	
	/************************
	/*	LAYOUT
	/************************/

	// set minimum height for content wrapper
	$(window).bind("load resize scroll", function () {
		calculateContentMinHeight();
	});

	function calculateContentMinHeight() {
		$('#main-content-wrapper').css('min-height', $('#left-sidebar').height());
	}


	/************************
	/*	MAIN NAVIGATION
	/************************/

	$('.main-menu .js-sub-menu-toggle').on('click', function(e){

		e.preventDefault();

		$li = $(this).parent('li');
		if( !$li.hasClass('active')){
			$li.find(' > a .toggle-icon').removeClass('fa-angle-left').addClass('fa-angle-down');
			$li.addClass('active');
			$li.find('ul.sub-menu')
				.slideDown(300);
		}
		else {
			$li.find(' > a .toggle-icon').removeClass('fa-angle-down').addClass('fa-angle-left');
			$li.removeClass('active');
			$li.find('ul.sub-menu')
				.slideUp(300);
		}
	});

	// checking for minified left sidebar
	checkMinified();

	$('.js-toggle-minified').on('click', function() {
		if(!$('.left-sidebar').hasClass('minified')) {
			$('.left-sidebar').addClass('minified');
			$('.content-wrapper').addClass('expanded');

		} else {
			$('.left-sidebar').removeClass('minified');
			$('.content-wrapper').removeClass('expanded');
		}
		
		checkMinified();
	});

	function checkMinified() {
		if(!$('.left-sidebar').hasClass('minified')) {
			setTimeout( function() {

				$('.left-sidebar .sub-menu.open')
				.css('display', 'block')
				.css('overflow', 'visible')
				.siblings('.js-sub-menu-toggle').find('.toggle-icon').removeClass('fa-angle-left').addClass('fa-angle-down');
			}, 200);

			$('.main-menu > li > a > .text').animate({
				opacity: 1
			}, 1000);

		} else {
			$('.left-sidebar .sub-menu.open')
			.css('display', 'none')
			.css('overflow', 'hidden');

			$('.main-menu > li > a > .text').animate({
					opacity: 0
			}, 200);
		}
	}

	$('.toggle-sidebar-collapse').on('click', function() {
		if( $(window).width() < 992) {
			// use float sidebar
			if(!$('.left-sidebar').hasClass('sidebar-float-active')) {
				$('.left-sidebar').addClass('sidebar-float-active');
			} else {
				$('.left-sidebar').removeClass('sidebar-float-active');
			}
		} else {
			// use collapsed sidebar
			if(!$('.left-sidebar').hasClass('sidebar-hide-left')) {
				$('.left-sidebar').addClass('sidebar-hide-left');
				$('.content-wrapper').addClass('expanded-full');
			} else {
				$('.left-sidebar').removeClass('sidebar-hide-left');
				$('.content-wrapper').removeClass('expanded-full');
			}
		}
	});

	$(window).bind("load resize", determineSidebar);

	function determineSidebar() {

		if( $(window).width() < 992) {
			$('body').addClass('sidebar-float');

		}else {
			$('body').removeClass('sidebar-float');
		}
	}

	// main responsive nav toggle
	$('.main-nav-toggle').clickToggle(
		function() {
			$('.left-sidebar').slideDown(300)
		},
		function() {
			$('.left-sidebar').slideUp(300);
		}
	);

	// slimscroll left navigation
	if( $('body.sidebar-fixed').length > 0 ) {
		$('body.sidebar-fixed .sidebar-scroll').slimScroll({
			height: '100%',
			wheelStep: 5,
		});
	}


	//*******************************************
	/*	LIVE SEARCH
	/********************************************/

	$mainContentCopy = $('.main-content').clone();
	$('.searchbox input[type="search"]').keydown( function(e) {
		var $this = $(this);
		
		setTimeout(function() {
			var query = $this.val();
			
			if( query.length > 2 ) {
				var regex = new RegExp(query, "i");
				var filteredWidget = [];

				$('.widget-header h3').each( function(index, el){
					var matches = $(this).text().match(regex);

					if( matches != "" && matches != null ) {
						filteredWidget.push( $(this).parents('.widget') );
					}
				});

				if( filteredWidget.length > 0 ) {
					$('.main-content .widget').hide();
					$.each( filteredWidget, function(key, widget) {
						widget.show();
					});
				}else{
					console.log('widget not found');
				}
			}else {
				$('.main-content .widget').show();
			}
		}, 0);
	});

	// widget remove
	$('.widget .btn-remove').click(function(e){

		e.preventDefault();
		$(this).parents('.widget').fadeOut(300, function(){
			$(this).remove();
		});
	});

	// widget toggle expand
	var affectedElement = $('.widget-content');

	$('.widget .btn-toggle-expand').clickToggle(
		function(e) {
			e.preventDefault();

			// if has scroll
			if( $(this).parents('.widget').find('.slimScrollDiv').length > 0 ) {
				affectedElement = $('.slimScrollDiv');
			}

			$(this).parents('.widget').find(affectedElement).slideUp(300);
			$(this).find('i.fa-chevron-up').toggleClass('fa-chevron-down');
		},
		function(e) {
			e.preventDefault();

			// if has scroll
			if( $(this).parents('.widget').find('.slimScrollDiv').length > 0 ) {
				affectedElement = $('.slimScrollDiv');
			}

			$(this).parents('.widget').find(affectedElement).slideDown(300);
			$(this).find('i.fa-chevron-up').toggleClass('fa-chevron-down');
		}
	);

	// widget focus
	$('.widget .btn-focus').clickToggle(
		function(e) {
			e.preventDefault();
			$(this).find('i.fa-eye').toggleClass('fa-eye-slash');
			$(this).parents('.widget').find('.btn-remove').addClass('link-disabled');
			$(this).parents('.widget').addClass('widget-focus-enabled');
			$('body').addClass('focus-mode');
			$('<div id="focus-overlay"></div>').hide().appendTo('body').fadeIn(300);

		},
		function(e) {
			e.preventDefault();
			$theWidget = $(this).parents('.widget');
			
			$(this).find('i.fa-eye').toggleClass('fa-eye-slash');
			$theWidget.find('.btn-remove').removeClass('link-disabled');
			$('body').removeClass('focus-mode');
			$('body').find('#focus-overlay').fadeOut(function(){
				$(this).remove();
				$theWidget.removeClass('widget-focus-enabled');
			});
		}
	);

	


	/************************
	/*	BOOTSTRAP ALERT
	/************************/

	$('.alert .close').click( function(e){
		e.preventDefault();
		$(this).parents('.alert').fadeOut(300);
	});


	

	/*****************************
	/*	WIDGET WITH AJAX ENABLE
	/*****************************/

	$('.widget-header-toolbar .btn-ajax').click( function(e){
		e.preventDefault();
		$theButton = $(this);

		$.ajax({
			url: 'php/widget-ajax.php',
			type: 'POST',
			dataType: 'json',
			cache: false,
			beforeSend: function(){
				$theButton.prop('disabled', true);
				$theButton.find('i').removeClass().addClass('fa fa-spinner fa-spin');
				$theButton.find('span').text('Loading...');
			},
			success: function( data, textStatus, XMLHttpRequest ) {
				
				setTimeout( function() {
					getResponseAction($theButton, data['msg'])
				}, 1000 );
				/* setTimeout is used for demo purpose only */

			},
			error: function( XMLHttpRequest, textStatus, errorThrown ) {
				console.log("AJAX ERROR: \n" + errorThrown);
			}
		});
	});

	function getResponseAction(theButton, msg){

		$('.widget-ajax .alert').removeClass('alert-info').addClass('alert-success')
		.find('span').text( msg );

		$('.widget-ajax .alert').find('i').removeClass().addClass('fa fa-check-circle');

		theButton.prop('disabled', false);
		theButton.find('i').removeClass().addClass('fa fa-floppy-o');
		theButton.find('span').text('Update');
	}


	//*******************************************
	/*	WIDGET QUICK NOTE
	/********************************************/

	if($('.quick-note-create').length > 0) {
		$('.quick-note-create textarea, .quick-note-create input').focusin( function() {
			$(this).attr('rows', 7);
			$('.quick-note-create').find('.widget-footer').show();
		});

		$('.quick-note-create').focusout( function() {
			$(this).find('textarea').attr('rows', 1);
			$(this).find('.widget-footer').hide();
		});
	}

	if($('.quick-note-saved').length > 0) {
		$('.quick-note-saved').click( function() {
			$('#quick-note-modal').modal();
		});
	}

	if($('.quick-note-edit').length > 0) {
		$('.quick-note-edit .btn-save').click( function() {
			$('#quick-note-modal').modal('hide');
		});
	}


	//*******************************************
	/*	WIDGET SLIM SCROLL
	/********************************************/

	if( $('.widget-scrolling').length > 0) {
		$('.widget-scrolling .widget-content').slimScroll({
			height: '410px',
			wheelStep: 5,
		});
	}


	//*******************************************
	/*	WIDGET WITH AJAX STATE
	/********************************************/

	if($('#btn-ajax-state').length > 0) {
		$('#btn-ajax-state').click( function() {
			$statusPlaceholder = $(this).parents('.widget').find('.process-status');
			ajaxCallToDo($statusPlaceholder);
		});
	}


	/**************************************
	/*	MULTISELECT/SINGLESELECT DROPDOWN
	/**************************************/

	if( $('.widget-header .multiselect').length > 0 ) {

		$('.widget-header .multiselect').multiselect({
			dropRight: true,
			buttonClass: 'btn btn-warning btn-sm'
		});
	}


	

	//*******************************************
	/*	SWITCH INIT
	/********************************************/

	if( $('.bs-switch').length > 0 ) {
		$('.bs-switch').bootstrapSwitch();
	}


	

	/************************
	/*	TOP BAR
	/************************/

	if( $('.top-general-alert').length > 0 ) {

		if(localStorage.getItem('general-alert') == null) {
			$('.top-general-alert').delay(800).slideDown('medium');
			$('.top-general-alert .close').click( function() {
				$(this).parent().slideUp('fast');
				localStorage.setItem('general-alert', 'closed');
			});
		}
	}


	
	$btnGlobalvol = $('.btn-global-volume');
	$theIcon = $btnGlobalvol.find('i');

	// check global volume setting for each loaded page
	checkGlobalVolume($theIcon, localStorage.getItem('global-volume'));

	$btnGlobalvol.click( function() {
			var currentVolSetting = localStorage.getItem('global-volume');
			// default volume: 1 (on)
			if(currentVolSetting == null || currentVolSetting == "1") {
				localStorage.setItem('global-volume', 0);
			} else {
				localStorage.setItem('global-volume', 1);
			}

			checkGlobalVolume($theIcon, localStorage.getItem('global-volume'));
		}
	);

	function checkGlobalVolume(iconElement, vSetting) {
		if(vSetting == null || vSetting == "1") {
			iconElement.removeClass('fa-volume-off').addClass('fa-volume-up');
		} else {
			iconElement.removeClass('fa-volume-up').addClass('fa-volume-off');
		}
	}


	//*******************************************
	/*	SELECT2
	/********************************************/

	if( $('.select2').length > 0) {
		$('.select2').select2();
	}

	if( $('.select2-multiple').length > 0) {
		$('.select2-multiple').select2();
	}


	//*******************************************
	/*	DRAG & DROP TO-DO LIST
	/********************************************/

	if( $('.todo-list').length > 0 ) {
		$('#dragdrop-todo').sortable({
			revert: true,
			placeholder: "ui-state-highlight",
			handle: '.handle',
			update: function() {
				$status = $(this).parents('.widget').find('.process-status');
				ajaxCallToDo($status);
			}
		});

		$('.todo-list input').change( function() {
			if( $(this).prop('checked') ) {
				$(this).parents('li').addClass('completed');
			}else {
				$(this).parents('li').removeClass('completed');
			}

			$status = $(this).parents('.widget').find('.process-status');
			ajaxCallToDo($status);
		});

		function ajaxCallToDo($status) {
			$.ajax({
				url: 'php/widget-ajax.php',
				type: 'POST',
				dataType: 'json',
				cache: false,
				beforeSend: function(){
					$status.find('.loading').fadeIn(300);
				},
				success: function( data, textStatus, XMLHttpRequest ) {

					setTimeout( function() {
						$status.find('span').hide();
						$status.find('.saved').fadeIn(300);
						console.log("AJAX SUCCESS");
					}, 1000 );

					setTimeout( function() {
						$status.find('.saved').fadeOut(300);
					}, 2000 );
					/* all setTimeout is used for demo purpose only */

				},
				error: function( XMLHttpRequest, textStatus, errorThrown ) {
					$status.find('span').hide();
					$status.find('.failed').addClass('active');
					console.log("AJAX ERROR: \n" + errorThrown);
				}
			});
		}
	}

	function ajaxCallToDo($status) {
		$.ajax({
			url: 'php/widget-ajax.php',
			type: 'POST',
			dataType: 'json',
			cache: false,
			beforeSend: function(){
				$status.find('.loading').fadeIn(300);
			},
			success: function( data, textStatus, XMLHttpRequest ) {

				setTimeout( function() {
					$status.find('span').hide();
					$status.find('.saved').fadeIn(300);
					console.log("AJAX SUCCESS");
				}, 1000 );

				setTimeout( function() {
					$status.find('.saved').fadeOut(300);
				}, 2000 );
				/* all setTimeout is used for demo purpose only */

			},
			error: function( XMLHttpRequest, textStatus, errorThrown ) {
				$status.find('span').hide();
				$status.find('.failed').addClass('active');
				console.log("AJAX ERROR: \n" + errorThrown);
			}
		});
	}


	//*******************************************
	/*	TEXTAREA FOR CHAT
	/********************************************/

	// enabling shift enter for new line
	$(".textarea-chat").keydown(function(e){
		if (e.keyCode == 13 && !e.shiftKey) {
			e.preventDefault();
			console.log('send message');
			$(this).val('');
		}
	});


	//*******************************************
	/*	DATA COMPLETENESS METER
	/********************************************/

	if( $('.completeness-meter').length > 0 ) {
		var cPbar = $('.completeness-progress');

		if( $('.progress-bar').length > 0 ) {
			cPbar.progressbar({
				display_text: 'fill',
				update: function(current_percentage) {
					$('.completeness-percentage').text(current_percentage+'%');

					if(current_percentage == 100) {
						$('.complete-info').addClass('text-success').html('<i class="ion ion-checkmark-circled"></i> Hooray, it\'s done!');
						cPbar.removeClass('progress-bar-info').addClass('progress-bar-success');
						$('.completeness-meter .editable').editable('disable');
					}
				}
			});
		}

		$.fn.editable.defaults.mode = 'inline';

		$('#complete-phone-number').on('shown', function(e, editable) {
			editable.input.$input.mask('(999) 999-9999');
		}).on('hidden', function(e, reason) {
			if(reason == 'save') {
				$(this).parent().prepend('Phone: ');
				updateProgressBar(cPbar, 10);
			}
		});
		$('#complete-sex').on('hidden', function(e, reason) {
			if(reason == 'save') {
				$(this).parent().prepend('Sex: ');
				updateProgressBar(cPbar, 10);
			}
		});
		$('#complete-birthdate').on('hidden', function(e, reason) {
			if(reason == 'save') {
				$(this).parent().prepend('Birthdate: ');
				updateProgressBar(cPbar, 10);
			}
		});
		$('#complete-nickname').on('shown', function(e, editable) {
			editable.input.$input.val('');
		}).on('hidden', function(e, reason) {
			if(reason == 'save') {
				$(this).parent().prepend('Nickname: ');
				updateProgressBar(cPbar, 10);
			}
		});

		$('.completeness-meter #complete-phone-number').editable();
		$('#complete-sex').editable({
			source: [
				{value: 1, text: 'Male'},
				{value: 2, text: 'Female'}
			]
		});
		$('#complete-birthdate').editable();
		$('#complete-nickname').editable();
	}

	function updateProgressBar(pbar, valueAdded) {
		pbar.attr('data-transitiongoal', parseInt(pbar.attr('data-transitiongoal'))+valueAdded).progressbar();
	}

});

// toggle function
$.fn.clickToggle = function( f1, f2 ) {
	return this.each( function() {
		var clicked = false;
		$(this).bind('click', function() {
			if(clicked) {
				clicked = false;
				return f2.apply(this, arguments);
			}

			clicked = true;
			return f1.apply(this, arguments);
		});
	});

}
</script>	
</body>

</html>
