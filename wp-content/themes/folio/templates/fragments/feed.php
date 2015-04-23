<?php

	$articles = new ContentManager();
	$articles
	    ->setContentType('article')
	    ->setOrder('DESC')
	    ->setPostPerPage(6)
	    ->fetch();
?>

<?php foreach ($articles->all() as $anArticle) {


	$shareOptions = array(
		'post'			=> $anArticle,
		'liClass'		=> 'share--item',
		'twitterUser'	=> '@simonbernard90'
	); ?>

	<article class="article">
		<figure class="article--imageFig"><img src="<?php echo $anArticle->getImageUrl( 'articlecover' , 'Article Thumbnail'); ?>" alt="Thumbnail : <?php echo $anArticle->post_title; ?>" class="article--image"></figure>

		<h2 class="article--title"><a href="<?php echo get_permalink($anArticle->ID); ?>"><?php echo $anArticle->post_title; ?></a></h2>

		<p class="article--excerpt"><?php echo $anArticle->post_excerpt; ?></p>

		<ul class="share-articleFeed">
			<?php echo apply_filters('share_icons' , $shareOptions , 'twitter' , 'share--link share--twitter'); ?><!--
			--><?php echo apply_filters('share_icons' , $shareOptions , 'facebook' , 'share--link share--facebook'); ?><!--
			--><?php echo apply_filters('share_icons' , $shareOptions , 'linkedin' , 'share--link share--linkedin'); ?><!--
			--><?php echo apply_filters('share_icons' , $shareOptions , 'googleplus' , 'share--link share--googleplus'); ?>
		</ul>

	</article>


<?php } ?>