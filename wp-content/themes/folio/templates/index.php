<?php get_header(); ?>

	<?php

	$projects = new ContentManager();
	$projects
	    ->setContentType('project')
	    ->setOrder('DESC')
	    ->setPostPerPage(6)
	    ->fetch();
	?>

	<section id="projects">

		<?php foreach ($projects->all() as $aProject) { ?>

			<article>
				<h2 class="projects-title"><?php echo $aProject->post_title; ?></h2>
			</article>

		<?php } ?>

	</section>

<?php get_footer();	?>
