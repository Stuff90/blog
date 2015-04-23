<?php get_header(); ?>

<?php
	$article = new Content($post);

	$shareOptions = array(
		'post'			=> $article,
		'liClass'		=> 'share--item',
		'twitterUser'	=> '@simonbernard90'
	);
?>


<section id="article" class="page">

	<section class="article--cover wrapper">
		<figure><img src="<?php echo $article->getImageUrl('articlecover', 'Article Cover'); ?>" alt=""></figure>
		<h1 class="article--title"><?php echo $article->post_title; ?></h1>
	</section>

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
					<?php echo apply_filters('share_icons' , $shareOptions , 'twitter' , 'share--link share--twitter'); ?><!--
					--><?php echo apply_filters('share_icons' , $shareOptions , 'facebook' , 'share--link share--facebook'); ?><!--
					--><?php echo apply_filters('share_icons' , $shareOptions , 'linkedin' , 'share--link share--linkedin'); ?><!--
					--><?php echo apply_filters('share_icons' , $shareOptions , 'googleplus' , 'share--link share--googleplus'); ?>
				</ul>
				<hr class="bar">

				<h5 class="article--sidebarTitle">Articles populaires</h5>

				<?php

					$related = new ContentManager();
					$related
					    ->setQueryParameters('meta_key', 'viewCounter')
					    ->setQueryParameters('orderby', 'meta_value_num')
					    ->setContentType('article')
					    ->setPostPerPage(5)
					    ->setOrder('ASC')
					    ->fetch();
					?>

					<ul class="article--sidebarRelated">
						<?php foreach ($related->all() as $relatedArticle) { ?>
							<li><a class="article--sidebarRelated--link" href="<?php echo get_permalink($relatedArticle->ID); ?>"><?php echo $relatedArticle->post_title; ?></a></li>
					   	<?php } ?>
					</ul>

			</div>
		</aside>

	</div>

</section>


<?php

	$viewCount = get_post_custom_values('viewCounter' , $article->ID);

	if(sizeof($viewCount) > 0){
		$newCount = $viewCount[0] + 1;
		update_post_meta($article->ID, 'viewCounter' , $newCount);
	} else {
		add_post_meta($article->ID, 'viewCounter' , 1, true);
	}
?>


<?php get_footer();	?>