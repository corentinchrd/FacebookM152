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
									$posts = GetAllPost();
									foreach ($posts as $post) {
										$medias = GetAllMediaFormID($post["idPost"]);
										$message = $post["commentaire"];

										echo "<div class='panel panel-default'>
										<div class='panel-thumbnail responsive' style='padding: 7px;'>";
										foreach ($medias as $media) {
											if ($media["nomMedia"] != NULL && $media["typeMedia"] == "image") {
												$image = $media["nomMedia"] . "." . $media["typeMedia"];
												echo "<img src='./uploaded_files/$image' class='img-responsive center-block' style='max-height: 100%; margin-top: 20px' >";
											}
											elseif($media["nomMedia"] != NULL && $media["typeMedia"] == "mp4"){
												$video = $media["nomMedia"] . "." . $media["typeMedia"];
												echo '<video width="75%" controls autoplay loop style="align:center;">'
												.'<source class="d-block w-40" src="uploaded_files/' . $video . '" type="video/mp4"'
												.'</video>';
											}
											elseif($media["nomMedia"] != NULL && $media["typeMedia"] == "mp3"){
												$audio = $media["nomMedia"] . "." . $media["typeMedia"];
												echo '<audio width="300px" controls>'
												.'<source class="d-block w-100" src="uploaded_files/' . $audio . '" type="audio/mp3"'
												.'</audio>';
											}
										}
										echo "</div>
										<div class='panel-body'>
										<p class='lead col-sm-8'>$message</p>
										<button type='button' class='btn btn-danger col-sm-2'>Delete</button>
										<button type='button' class='btn btn-primary col-sm-2'>Edit</button>
										</div>
										</div>";
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