<html>
	<head>
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
	</head>
<body>

	<header id="header">
		<div class="wrapper">
			<h1 class="header--title">Simon BERNARD</h1>

			 <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>

			<aside class="search">

				<p class="search--buttonWrapper"><a href="#" class="search--button"></a></p>

				<form action="#" class="search--form">
					<input type="text" class="search--input">
				</form>
			</aside>
		</div>

	</header>