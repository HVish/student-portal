<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">

	<meta http-equiv=”X-UA-Compatible” content=”IE=EmulateIE9”>
	<meta http-equiv=”X-UA-Compatible” content=”IE=9”>

	<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.html');?>">
	<title><?php echo $title; ?></title>
	<!-- NProgress -->
	<script src="<?php echo base_url('assets/js/nprogress/nprogress.js');?>"></script>
	<script src="<?php echo base_url('assets/js/loader.js');?>"></script>
	<!--Core CSS -->
	<link href="<?php echo base_url('assets/bs3/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/js/jquery-ui/jquery-ui-1.10.1.custom.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/bootstrap-reset.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/clndr.css');?>" rel="stylesheet">
	<!-- PNotify -->
	<link href="<?php echo base_url('assets/js/pnotify/dist/pnotify.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/js/pnotify/dist/pnotify.buttons.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/js/pnotify/dist/pnotify.nonblock.css');?>" rel="stylesheet">
	<!--clock css-->
	<link href="<?php echo base_url('assets/js/css3clock/css/style.css');?>" rel="stylesheet">
	<!--Morris Chart CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/js/morris-chart/morris.css');?>">
	<?php if($title == "inbox") { ?>
		<!--icheck-->
		<link rel="stylesheet" href="<?php echo base_url('assets/js/iCheck/skins/minimal/minimal.css'); ?>" media="screen">
	<?php } ?>
	<?php if($title == "compose") { ?>
		<!--icheck-->
		<link rel="stylesheet" href="<?php echo base_url('assets/js/iCheck/skins/minimal/minimal.css'); ?>" media="screen">
		<link rel="stylesheet" href="<?php echo base_url('assets/js/bootstrap-wysihtml5/bootstrap-wysihtml5.css'); ?>" media="screen">
	<?php } ?>
	<?php if($title == "profile") { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/bootstrap-fileupload/bootstrap-fileupload.css'); ?>" />
	<?php } ?>
	<!-- Custom styles for this template -->
	<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/style-responsive.css');?>" rel="stylesheet" />
	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<script type="text/javascript">
		NProgress.start();
	</script>
	<section id="container">
		<!--header start-->
		<header class="header fixed-top clearfix">
			<!--logo start-->
			<div class="brand">

				<a href="<?php echo base_url(); ?>" class="logo">
			        <!-- <img src="<?php echo base_url('assets/images/logo.png');?>" alt=""> -->
					<h2 style="color: #fff; display: inline;">Jecrc</h2>
			    </a>
				<div class="sidebar-toggle-box">
					<div class="fa fa-bars"></div>
				</div>
			</div>
			<!--logo end-->

			<div class="nav notify-row" id="top_menu">
				<!--  notification start -->
				<ul class="nav top-menu">
					<!-- settings start -->
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<i class="fa fa-tasks"></i>
							<span class="badge bg-success"><?php echo count($alerts['tasks'])?></span>
						</a>
						<ul class="dropdown-menu extended tasks-bar">
							<li>
								<p class="">You have <?php echo count($alerts['tasks'])?> pending tasks</p>
							</li>
							<?php foreach ($alerts['tasks'] as $task => $value) { ?>
								<li>
									<a href="#">
										<div class="task-info clearfix">
											<div class="desc pull-left">
												<h5><?php echo $value['title']; ?></h5>
												<p><?php echo $value['message']; ?></p>
											</div>
											<span class="notification-pie-chart pull-right" data-percent="<?php echo $value['progress']; ?>">
												<span class="percent"></span>
											</span>
										</div>
									</a>
								</li>
							<?php } ?>
							<li class="external">
								<a href="#">See All Tasks</a>
							</li>
						</ul>
					</li>
					<!-- settings end -->
					<!-- inbox dropdown start-->
					<li id="header_inbox_bar" class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<i class="fa fa-envelope-o"></i>
							<span class="badge bg-important"><?php echo count($alerts['mails'])?></span>
						</a>
						<ul class="dropdown-menu extended inbox">
							<li>
								<p class="red">You have <?php echo count($alerts['mails'])?> Mails</p>
							</li>
							<?php foreach ($alerts['mails'] as $mail => $value) { ?>
								<li>
									<a href="#">
										<span class="photo"><img alt="avatar" src="<?php echo base_url('assets/images/'.$value['image']);?>"></span>
										<span class="subject">
		                                	<span class="from"><?php echo $value['from']; ?></span>
											<span class="time"><?php echo $value['time']; ?></span>
										</span>
										<span class="message">
		                                    <?php echo $value['message']; ?>
		                                </span>
									</a>
								</li>
							<?php } ?>
							<li>
								<a href="#">See all messages</a>
							</li>
						</ul>
					</li>
					<!-- inbox dropdown end -->
					<!-- notification dropdown start-->
					<li id="header_notification_bar" class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">

							<i class="fa fa-bell-o"></i>
							<span class="badge bg-warning"><?php echo count($alerts['notifications'])?></span>
						</a>
						<ul class="dropdown-menu extended notification">
							<li>
								<p>Notifications</p>
							</li>
							<?php foreach ($alerts['notifications'] as $notification => $value) { ?>
								<li>
									<div class="alert alert-info clearfix">
										<span class="alert-icon"><i class="fa fa-bolt"></i></span>
										<div class="noti-info">
											<a href="<?php echo $value['url']; ?>"><?php echo $value['message']; ?></a>
										</div>
									</div>
								</li>
							<?php } ?>
						</ul>
					</li>
					<!-- notification dropdown end -->
				</ul>
				<!--  notification end -->
			</div>
			<div class="top-nav clearfix">
				<!--search & user info start-->
				<ul class="nav pull-right top-menu">
					<li>
						<input type="text" class="form-control search" placeholder=" Search">
					</li>
					<!-- user login dropdown start-->
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
			                <img alt="" src="<?php echo base_url('assets/images/avatar1_small.jpg');?>">
			                <span class="username"><?php echo $username;?></span>
			                <b class="caret"></b>
			            </a>
						<ul class="dropdown-menu extended logout">
							<li><a href="<?php echo base_url('/profile') ?>"><i class=" fa fa-suitcase"></i>Profile</a></li>
							<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
							<li><a href="<?php echo base_url('home/logout');?>"><i class="fa fa-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- user login dropdown end -->
					<li>
						<div class="toggle-right-box">
							<div class="fa fa-bars"></div>
						</div>
					</li>
				</ul>
				<!--search & user info end-->
			</div>
		</header>
		<!--header end-->
		<!--sidebar start-->
		<aside>
			<div id="sidebar" class="nav-collapse">
				<!-- sidebar menu start-->
				<div class="leftside-navigation">
					<ul class="sidebar-menu" id="nav-accordion">
						<li>
							<a href="<?php echo base_url('/home/dashboard')?>">
								<i class="fa fa-dashboard"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li class="sub-menu">
		                    <a href="javascript:;">
		                        <i class="fa fa-envelope"></i>
		                        <span>Mail </span>
		                    </a>
		                    <ul class="sub">
		                        <li><a href="<?php echo base_url('/home/inbox'); ?>">Inbox</a></li>
		                        <li><a href="<?php echo base_url('/home/compose'); ?>">Compose Mail</a></li>
		                    </ul>
		                </li>
						<li class="sub-menu">
							<a href="javascript:;">
								<i class="fa fa-laptop"></i>
								<span>Academic Details</span>
							</a>
							<ul class="sub">
								<li><a href="boxed_page.html">Admission</a></li>
								<li><a href="horizontal_menu.html">RTU Marks</a></li>
							</ul>
						</li>
						<li>
							<a href="<?php echo base_url('/profile') ?>">
								<i class="fa fa-book"></i>
								<span>Personel Details</span>
							</a>
						</li>
						<li class="sub-menu">
							<a href="javascript:;">
								<i class="fa fa-book"></i>
								<span>Mark Sheets</span>
							</a>
							<ul class="sub">
								<li><a href="<?php echo base_url('/home/marksheet/1'); ?>">1<sup>st</sup> Semester</a></li>
								<li><a href="<?php echo base_url('/home/marksheet/2'); ?>">2<sup>st</sup> Semester</a></li>
								<li><a href="<?php echo base_url('/home/marksheet/3'); ?>">3<sup>st</sup> Semester</a></li>
								<li><a href="<?php echo base_url('/home/marksheet/4'); ?>">4<sup>st</sup> Semester</a></li>
								<li><a href="<?php echo base_url('/home/marksheet/5'); ?>">5<sup>st</sup> Semester</a></li>
								<li><a href="<?php echo base_url('/home/marksheet/6'); ?>">6<sup>st</sup> Semester</a></li>
								<li><a href="<?php echo base_url('/home/marksheet/7'); ?>">7<sup>st</sup> Semester</a></li>
								<li><a href="<?php echo base_url('/home/marksheet/8'); ?>">8<sup>st</sup> Semester</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- sidebar menu end-->
			</div>
		</aside>
		<!--sidebar end-->
