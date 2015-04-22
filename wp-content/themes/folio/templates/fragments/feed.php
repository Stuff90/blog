<?php

	$articles = new ContentManager();
	$articles
	    ->setContentType('article')
	    ->setOrder('DESC')
	    ->setPostPerPage(6)
	    ->fetch();
?>

<?php foreach ($articles->all() as $anArticle) { ?>

	<article class="article">
		<figure class="article--imageFig"><img src="<?php echo $anArticle->getImageUrl( 'articlecover' , 'Article Thumbnail'); ?>" alt="Thumbnail : <?php echo $anArticle->post_title; ?>" class="article--image"></figure>

		<h2 class="article--title"><a href="<?php echo get_permalink($anArticle->ID); ?>"><?php echo $anArticle->post_title; ?></a></h2>

		<p class="article--excerpt"><?php echo $anArticle->post_excerpt; ?></p>

		<ul class="share-articleFeed">
			<li class="share--item"><a href="#" class="share--link share--facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('<?php echo get_permalink($anArticle->ID, FALSE); ?>'), 'Share on Facebook','width=626,height=436');return false;"></a></li><!--
			--><li class="share--item"><a href="#" class="share--link share--twitter" onclick="window.open('https://www.twitter.com/share?text='+encodeURIComponent('@CrFashionBook')+'&url='+encodeURIComponent('<?php echo get_permalink($anArticle->ID, FALSE); ?>'), 'Share on Twitter', 'width=626,height=436');return false;"></a></li>
		</ul>

	</article>


<?php } ?>