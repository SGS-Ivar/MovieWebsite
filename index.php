<?php

session_start();

include_once('includes/connection.php');
include_once('includes/movie.php');

$movie = new Movie;
$movies = $movie->fetch_all();

//search code

if(isset($_POST['name'])){

	$name = $_POST['name'];
	
	if(empty($name)){
		$error_mail = 'Movie name is required!';
	} else {
		
		$sucess = mail('ChunkTreasure@gmail.com', 'Movie request', $name);
		
		if($sucess){
			
			$mail = 'Request sent!';
			
		}
		
	}
	
}


?>

<html>
	<head>
		<title>Moviewatchers</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="../assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="../assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="../assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->

							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

						</div>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<h2>Menu</h2>
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="categories.php">Categories</a></li>
							<?php if(isset($_SESSION['u_admin'])){ ?>
								<li><a href="admin/index.php">Admin</a></li>
							<?php }?>
							
							<?php if(isset($_SESSION['u_id'])) { ?>
								<li><a href="includes/logout.php">Sign out</a></li>
							<?php } else { ?>
								<li><a href="/login.php">Log in</a></li>
							<?php } ?>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							
							<?php if (isset($error)){ ?>
								<h4 style="color: #aa0000"><?php echo $error ?></h4>
							<?php }?>
							<form action="search.php" method="post">
								<input type="text" name="search" placeholder="Search for a movie..."/>
								<br />
								<input type="submit" name="submit-search" value="Search"/>
							</form>
							
							<h4><?php echo $output; ?></h4>
							
							<header>
                                <h4>All movies</h4>
							</header>
							<section class="tiles">
								<?php foreach ($movies as $movie) {?>
								<article class="style1">
									<span class="image">
										<img src="images/<?php echo $movie['movie_img'] ?>" alt="" />
									</span>
									<a href="movie.php?id=<?php echo $movie['movie_id']; ?>">
										<h2><?php echo $movie['movie_title']; ?>(<?php echo $movie['movie_year'] ?>)</h2>
									</a>
								</article>
								<?php } ?>
							</section>
						</div>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							<section>
								<h2>Request a movie</h2>
								<?php if (isset($error_mail)){ ?>
									<h4 style="color: #aa0000"><?php echo $error_mail ?></h4>
								<?php }?>
								<?php if (isset($mail)){ ?>
									<h4 style="color: #095A00"><?php echo $mail ?></h4>
								<?php }?>
								<form method="post" action="">
									<div class="field half first">
										<input type="text" name="name" id="name" placeholder="Movie name" />
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send" class="special" /></li>
									</ul>
								</form>
							</section>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>