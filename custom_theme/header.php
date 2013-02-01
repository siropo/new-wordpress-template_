<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> <?php } ?> <?php wp_title(); ?></title>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="author" content="Viktor Ivanov" />
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/scripts/script.js"></script>
		
		<!--[if lte IE 8]>
			<style type="text/css" media="screen">
			   #first-navi {
				  behavior: url('<?php echo get_stylesheet_directory_uri(); ?>/css/PIE.htc');
			   }
			</style>
			<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie_style.css" media="screen" />
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<? wp_head(); ?>
	</head>
	<body>
		<div id="wrapper-site">
			<!-- header -->
				<header id="header">
					<!-- logo -->
					header
						<a href="<?php bloginfo('url'); ?>" id="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" width="180" height="77" alt="Green Fit" /></a>
					<!-- navi -->
					<nav id="main-navi"> 
						<?php wp_nav_menu(array(
							'theme_location'  => 'first-navi-menu',
							'menu_class'      => 'clear',
							'container' => 'false'
						));
						?>
					</nav>
				</header>
		