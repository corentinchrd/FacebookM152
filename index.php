<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Facebook Theme Demo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/facebook.css" rel="stylesheet">
</head>

<body>

	<div class="wrapper">
		<div class="box">
			<div class="">
				<!-- main right col -->
				<div class="column col-sm-12 col-xs-12" id="main">
					<!-- top nav -->
					<div class="navbar navbar-blue navbar-static-top">
						<div class="navbar-header">
							<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand logo">F</a>
						</div>
						<nav class="collapse navbar-collapse" role="navigation">
							<form class="navbar-form navbar-left">
								<div class="input-group input-group-sm" style="max-width:360px;">
									<input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
									<div class="input-group-btn">
										<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
									</div>
								</div>
							</form>
							<ul class="nav navbar-nav">
								<li>
									<a href="#"><i class="glyphicon glyphicon-home"></i> Home</a>
								</li>
								<li>
									<a href="./Post.php" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
								</li>
							</ul>
						</nav>
					</div>
					<!-- /top nav -->
					<div class="padding">
						<div class="full col-sm-9">
							<!-- content -->
							<div class="row">
								<!-- main col left -->

								<!-- main col right -->
								<div class="col-sm-4">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h1>WELCOME</h1>
										</div>
										<div class="panel-body">
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-sm-8">


									<?php
									include_once 'db\func.php';
									$test = GetAllPost();
									foreach ($test as $value) {
										$test1 = GetAllMediaFormID($value["idPost"]);
										$message = $value["commentaire"];
										foreach ($test1 as $value1) {
											$image = $value1["nomMedia"] . "." . $value1["typeMedia"];
											echo "<div class='panel panel-default'>
													<div class='panel-thumbnail responsive' style='padding: 7px;'><img src='./uploaded_files/$image' class='img-responsive center-block' style='max-height: 100%;' ></div>
													<div class='panel-body'>
													<p class='lead'>$message</p>
													</div>
													</div>";
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>

</html>