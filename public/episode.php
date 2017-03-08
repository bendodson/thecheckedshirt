<?php

$xml = simplexml_load_string(file_get_contents('itunes.xml'));
$episodes = $xml->channel->item;
$episode = $episodes[count($episodes)-(int)$_GET['index']];
$namespaces = $episode->getNameSpaces(true); $content = $episode->children($namespaces['content']); $itunes = $episode->children($namespaces['itunes']);

function humanTime($time) {
	$time = strtotime($time);
	$hours = date('G', $time);
	$pluralHours = ($hours == 1) ? "hr" : "hrs";
	$minutes = (int)date('i', $time);
	$pluralMinutes = ($minutes == 1) ? "min" : "mins";
	
	$text = $hours.' '.$pluralHours;
	if ($minutes > 0) {
		$text .= '  '.$minutes.' '.$pluralMinutes;
	}


	return $text;
}

?>
<!DOCTYPE html>
<html lang="en">
	
	<head>

		<!-- =================================== -->
		<!-- 		  COMPATIBILITY 			 -->
		<!-- =================================== -->
		
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	

		<!-- =================================== -->
		<!-- 			  TITLE 			 	 -->
		<!-- =================================== -->

		<title>The Checked Shirt - Episode #<?php echo (int)$_GET['index'] ?></title>

		<!-- =================================== -->
		<!-- 			MORDERNIZR 			 	 -->
		<!-- =================================== -->

		<script src="assets/js/modernizr.js"></script>
		
		<!-- =================================== -->
		<!-- 			  STYLES 				 -->
		<!-- =================================== -->
		
		<!-- BOOTSTRAP MIN -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		
		<!-- MEDIA ELEMENT -->
		<link href="assets/css/mediaelementplayer.min.css" rel="stylesheet" />
		
		<!-- MAGNIFIC POPUP CSS -->
		<link href="assets/css/magnific-popup.css" rel="stylesheet" />
		
		<!-- THEME CSS -->
		<link href="assets/css/style.css" rel="stylesheet" />
		
		<!-- GOOGLE FONTS -->
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
		
		<!-- FONT AWESOME -->
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
		
		<!-- =================================== -->
		<!-- 		 	THEME COLOR 			 -->
		<!-- =================================== -->
		
		<meta name="theme-color" content="#fff" />
		
		<!-- =================================== -->
		<!-- 			CONDITIONAL 			 -->
		<!-- =================================== -->
		
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- =================================== -->
		<!-- 			 VIEWPORT 				 -->
		<!-- =================================== -->

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />

		<!-- =================================== -->
		<!-- 			  AUTHOR 				 -->
		<!-- =================================== -->

		<meta name="author" content="reidark" />
		<meta name="reply-to" content="support@reidark.com.br" />
		<meta name="DC.publisher" content="reidark" />
		<meta name="generator" content="Brackets" />


		<!-- =================================== -->
		<!-- 			 ROBOTS 				 -->
		<!-- =================================== -->

		<meta name="GOOGLEBOT" content="INDEX, FOLLOW" />
		<meta name="robots" content="index, follow">
		<meta name="msnbot" content="NOODP" />

		<!-- =================================== -->
		<!-- 			 FACEBOOK 				 -->
		<!-- =================================== -->

		<meta property="og:locale" content="en" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="The Checked Shirt" />
		<meta property="og:description" content="A podcast about app development freelance life" />
		<meta property="og:url" content="https://thecheckedshirt.com/" />
		<meta property="og:site_name" content="The Checked Shirt" />
		<meta property="og:image" content="https://bendodson.s3.amazonaws.com/tcs/icon.png" />

		<!-- =================================== -->
		<!-- 			  TWITTER 				 -->
		<!-- =================================== -->

		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="https://thecheckedshirt.com" />
		<meta name="twitter:creator" content="@thecheckedshirt" />
		<meta name="twitter:title" content="The Checked Shirt" />
		<meta name="twitter:description" content="A podcast about app development freelance life" />
		<meta name="twitter:domain" content="thecheckedshirt" />
		<meta name="twitter:image" content="https://bendodson.s3.amazonaws.com/tcs/icon.png" />

		<!-- =================================== -->
		<!-- 			  FAVICON 				 -->
		<!-- =================================== -->
		
		<link rel="icon" href="assets/img/favicon.png" />
		<link rel="shortcut icon" href="assets/img/favicon.png" />

	</head>

	<body itemscope itemtype="http://schema.org/WebSite">
		
		
		
		<!-- ===== MAIN ===== -->
		<main id="main" class="main">
			
			<!-- ===== PAGE HEADER ===== -->
			<header class="page-header-podcast" style="background-image: url(<?php echo $episode->tcsbackground ?>)">
				<div class="page-header-inner">
					<div class="container">

						<!-- ===== BREADCRUMB ===== -->
						<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
							<li itemprop="itemListElement"><a href="/">&laquo; Home</a></li>
						</ol>

						<!-- ===== PAGE HEADER CONTENT ===== -->
						<div class="page-header-content text-center">
							<h2><?php echo $episode->title ?></h2>
							<?php echo $content->encoded ?>
						</div>

					</div>
				</div>
			</header>
			
			<!-- ===== PODCAST PLAYER ===== -->
			<div class="podcast-player">
				<div class="podcast-player-inner">
					<div class="container">
						<audio src="<?php echo $episode->enclosure->attributes()->url; ?>"></audio>
					</div>
				</div>
			</div>
			
			<!-- ===== PODCAST META ===== -->
			<div class="podcast-meta-element">
				<span class="podcast-meta-item"><i class="fa fa-calendar"></i> <?php echo date('jS F, Y', strtotime($episode->pubDate)) ?></span>
				<span class="podcast-meta-item"><i class="fa fa-clock-o"></i> <?php echo humanTime($itunes->duration) ?></span>
				<a class="podcast-meta-item" href="<?php echo $episode->enclosure->attributes()->url; ?>"><i class="fa fa-download"></i> Download (MP3)</a>
			</div>

			<!-- ===== ABOUT US ===== -->
			<section id="about-us" class="section-negative">
				<div class="container">
					
					<!-- ===== SECTION TITLE ===== -->
					<h2 class="title-default text-center">Behind the mic...</h2>
					
					<div class="row mb-30">
						
						<!-- ===== TEAM CARD ===== -->
						<div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-12 mb-40">
							<div class="team-card">
								<figure class="team-card-image"><img src="https://bendodson.s3.amazonaws.com/tcs/ben.jpg" alt="Ben Dodson" title="Jason Kneen" /></figure>
								<div class="team-card-content">
									<h2 class="team-card-title">Ben Dodson</h2>
									<p class="team-card-description">Ben is a freelance iOS, watchOS, and tvOS developer who splits his time between client projects and his own apps. He is an avid gamer and posts regular reviews and video game news on his <a href="https://kyloben.com/">Kylo Ben </a> website.</p>
									<ul class="team-card-social">
										<li class="social-item"><a href="https://twitter.com/bendodson" target="_blank"><i class="fa fa-twitter"></i></a></li>
										<li class="social-item"><a href="https://bendodson.com/" target="_blank"><i class="fa fa-link"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
						
						<!-- ===== TEAM CARD ===== -->
						<div class="col-lg-4 col-lg-offset-0 col-md-6 col-md-offset-2 col-sm-12 mb-40">
							<div class="team-card">
								<figure class="team-card-image"><img src="https://bendodson.s3.amazonaws.com/tcs/jason.jpg" alt="Jason Kneen" title="Jason Kneen" /></figure>
								<div class="team-card-content">
									<h2 class="team-card-title">Jason Kneen</h2>
									<p class="team-card-description">Jason is a freelance Titanium Certified Developer working on cross-platform native mobile apps. He regularly speaks at events and meetups and owns a <a href="http://twitter.com/tardisloo">tweeting TARDIS loo</a>...</p>
									<ul class="team-card-social">
										<li class="social-item"><a href="https://twitter.com/jasonkneen" target="_blank"><i class="fa fa-twitter"></i></a></li>
										<li class="social-item"><a href="http://bouncingfish.com/" target="_blank"><i class="fa fa-link"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
		
						
					</div>
					
				</div>
			</section>
	
		</main>
		
		
		
		<!-- =================================== -->
		<!-- 			  SCRIPTS 				 -->
		<!-- =================================== -->
		
		<!-- JQUERY -->
		<script src="assets/js/jquery-1.11.min.js"></script>
		
		<!-- BOOTSTRAP JS -->
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- MEDIA ELEMENT -->
		<script src="assets/js/mediaelement-and-player.min.js"></script>
		
		<!-- MAGNIFIC POPUP -->
		<script src="assets/js/magnific-popup.min.js"></script>
		
		<!-- FORM VALIDATE -->
		<script src="assets/js/validate.min.js"></script>
		
		<!-- PLACEHOLDER FOR IE -->
		<script src="assets/js/placeholder.min.js"></script>
		
		<!-- THEME JS -->
		<script src="assets/js/main.js"></script>

	</body>

</html>