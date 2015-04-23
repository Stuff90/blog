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

		<aside class="wrapper-sidebar">
			<div class="article--sidebar">
				<ul class="share-articleDetail">
					<li class="share--item"><a href="#" class="share--link share--facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('<?php echo get_permalink($article->ID, FALSE); ?>'), 'Share on Facebook','width=626,height=436');return false;"></a></li><!--
					--><li class="share--item"><a href="#" class="share--link share--twitter" onclick="window.open('https://www.twitter.com/share?text='+encodeURIComponent('@CrFashionBook')+'&url='+encodeURIComponent('<?php echo get_permalink($article->ID, FALSE); ?>'), 'Share on Twitter', 'width=626,height=436');return false;"></a></li>
				</ul>

				<hr class="bar">

				<h5 class="article--sidebarTitle">Voir aussi :</h5>

				<?php

					$related = new ContentManager();
					$related
					    ->setContentType('article')
					    ->setOrder('DESC')
					    ->setPostPerPage(4)
					    ->fetch();
					?>

					<ul class="article--sidebarRelated">
						<?php foreach ($related->all() as $relatedArticle) { ?>
							<li><a href="<?php echo get_permalink($relatedArticle->ID); ?>"><?php echo $relatedArticle->post_title; ?></a></li>
					   	<?php } ?>
					</ul>

			</div>
		</aside>

	</div>

</section>


<?php get_footer();	?>