<?php get_header(); ?>

<?php
	$article = new Content($post);
?>


<section id="article" class="page">

	<aside class="article--cover wrapper">
		<figure><img src="<?php echo $article->getImageUrl('articlecover', 'Article Cover'); ?>" alt=""></figure>
	</aside>

	<div class="wrapper">

		<article class="wrapper-content">
			<section class="article--excerpt">
				<div><?php echo $article->post_excerpt; ?></div>
				<p class="article--datePlublished"><time>Publié le <?php echo get_the_date( 'd/m/Y' , $article->ID); ?></time></p>
			</section>
			<section class="article--content"><?php echo apply_filters('clean_content' , $article->post_content); ?></section>
		</article>

		<aside class="wrapper-sidebar"><?php echo $article->post_excerpt; ?></aside>

	</div>

</section>


<?php get_footer();	?>