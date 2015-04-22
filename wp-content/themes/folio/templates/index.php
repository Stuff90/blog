<?php get_header(); ?>


	<!-- <h2 class="header-title">Simon BERNARD</h2> -->
	<!-- <h1 class="header-subTitle">Développeur Front End</h1> -->

	<section id="home" class="page wrapper">

<!-- 
	<br>
	<br>
	<br>
	<br>
	<br>
	<ul class="sharingBox">
		<li><a href="#" class="icon github-white"></a></li>
		<li><a href="#" class="icon github-gray"></a></li>
		<li><a href="#" class="icon github-black"></a></li>
		<li><a href="#" class="icon twitter-white"></a></li>
		<li><a href="#" class="icon linkedin-white"></a></li>
		<li><a href="#" class="icon facebook-white"></a></li>
		<li><a href="#" class="icon pinterest-white"></a></li>
	</ul> -->
		<?php require_once( __DIR__ . '/fragments/feed.php'); ?>

	</section>

	<!-- <section id="projects">

		<?php foreach ($projects->all() as $aProject) { ?>

			<article>
				<h2 class="projects-title"><?php echo $aProject->post_title; ?></h2>
			</article>

		<?php } ?>

	</section> -->

<?php get_footer();	?>
