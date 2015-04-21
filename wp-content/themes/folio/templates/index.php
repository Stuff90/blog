<?php get_header(); ?>

	<?php

	$projects = new ContentManager();
	$projects
	    ->setContentType('project')
	    ->setOrder('DESC')
	    ->setPostPerPage(6)
	    ->fetch();
	?>


	<header id="header">

		<h2 class="header-title">Simon BERNARD</h2>
		<h1 class="header-subTitle">Développeur Front End</h1>
		<ul class="header-social">
			<li class="sprite icon-icon-github"></li>
			<li class="icon-twitter"></li>
			<li class="icon-linkedin"></li>
		</ul>

	</header>

	<section id="projects">

		<?php foreach ($projects->all() as $aProject) { ?>

			<article>
				<h2 class="projects-title"><?php echo $aProject->post_title; ?></h2>
			</article>

		<?php } ?>

	</section>

<?php get_footer();	?>
