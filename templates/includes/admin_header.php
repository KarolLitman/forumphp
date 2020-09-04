<!DOCTYPE html>
<html lang="en">

<?php
if(!hasadmin()){
     exit();
 }
 ?>

<head>
<title>Forum PHP - ACP</title>
<meta charset="utf-8">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="<?php echo BASE_URI; ?>templates/css/custom.css" rel="stylesheet">


</head>




<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">


			<a class="navbar-brand" href="#">
				Admin control panel
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="navbar-collapse" id="bs-example-navbar-collapse-1">      
			<ul class="nav navbar-nav navbar-right">
				<li><a href="../index.php" target="_blank">Logout</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>  	<div class="container-fluid main-container">
  		<div class="col-md-2 sidebar">
  			<div class="row">
	<!-- uncomment code for absolute positioning tweek see top comment in css -->
	<div class="absolute-wrapper"> </div>
	<!-- Menu -->
	<div class="side-menu">
		<nav class="navbar navbar-default navbar-without">
			<!-- Main Menu -->
			<div class="side-menu-container">
				<ul class="nav navbar-nav">
					<li class="hover_admin"><a href="admin.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
					<li class="hover_admin"><a href="admin_users.php"><span class="glyphicon glyphicon-user"></span> Users</a></li>
					<li class="hover_admin"><a href="admin_categories.php"><span class="glyphicon glyphicon-cloud"></span> Categories</a></li>
					<li class="hover_admin"><a href="admin_groups.php"><span class="glyphicon glyphicon-user"></span> Groups</a></li>
					<li class="hover_admin"><a href="admin_privilages.php"><span class="glyphicon glyphicon-remove"></span> Privilages groups</a></li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>

	</div>
</div>  		</div>
  		<div class="col-md-10 content">
		  <?php displayMessages(); ?>
  			  <div class="panel panel-default">
	<div class="panel-heading">
    <?php echo $title; ?>
	</div>
	<div class="panel-body">






