<?php


	function clean_content_fn($content){
		$filterContent = '';
		$splittedContent = explode('<br />', nl2br($content));
		foreach ($splittedContent as $element) {
			$containImg 	= preg_match('/<img[^>]+./', $element, $imgTag);
			$containVideo 	= preg_match('/\[embed(.*)](.*)\[\/embed]/',$element, $videoContent);
			if ($containImg){
				$filterContent .= '<figure class="format-media image">'. $imgTag[0] .'</figure>';
			} elseif ($containVideo){
				$filterContent .= '<div class="format-media video ">'. wp_oembed_get($videoContent[2], array('width'=> 800 )) .'</div>';
				$filterContent .= '<div class="format-media video video-mobile">'. wp_oembed_get($videoContent[2], array('width'=> 260 , 'height' => 150 )) .'</div>';
			} else {
				$element = trim($element);
				if(strlen($element) > 0 && $element != '&nbsp;'){
					$filterContent .= '<p class="format-text">'. $element . '</p>';
				} else {
					$filterContent .= '<br class="format-lineBreak" />';
				}
			}
		}
	    return $filterContent;
	}



	function share_icons_fn( $options , $network , $class){

		$defaultOption = array(
			'pinterestMedia' => '',
			'twitterUser' 	 => '',
			'liClass' 		 => '',
			'aClass' 		 => '',
			'post' 			 => null
		);

		$options = array_merge($defaultOption, $options);
		if(!isset($options['post']) || !isset($network)) { return ''; }

		$thePost = $options['post'];

		$url = array(
			'facebook' 		=> 'https://www.facebook.com/sharer/sharer.php?u='. get_permalink($thePost->ID, FALSE),
			'twitter' 		=> 'https://twitter.com/home?status='. get_permalink($thePost->ID, FALSE),
			'googleplus' 	=> 'https://plus.google.com/share?url='. get_permalink($thePost->ID, FALSE),
			'pinterest' 	=> 'https://pinterest.com/pin/create/button/?media='. $options['pinterestMedia'] .'&url='. get_permalink($thePost->ID, FALSE),
			'linkedin' 		=> 'https://www.linkedin.com/shareArticle?mini=true&title='. $thePost->post_title .'&url='. get_permalink($thePost->ID, FALSE)
		);

		$clickEvent = array(
			'facebook' 		=> 'window.open(\'https://www.facebook.com/sharer/sharer.php?u=\'+encodeURIComponent(\''. get_permalink($thePost->ID, FALSE) .'\'), \'Share on Facebook\',\'width=626,height=436\');return false;',
			'twitter' 		=> 'window.open(\'https://www.twitter.com/share?text=\'+encodeURIComponent(\''. $options['twitterUser'] .'\')+\'&url=\'+encodeURIComponent(\''. get_permalink($thePost->ID, FALSE) .'\'), \'Share on Twitter\', \'width=626,height=436\');return false;',
			'googleplus' 	=> 'window.open(\'https://plus.google.com/share?url=\'+encodeURIComponent(\''. get_permalink($thePost->ID, FALSE) .'\'), \'Share on Google plus\', \'width=626,height=436\');return false;',
			'pinterest' 	=> 'window.open(\'http://pinterest.com/pin/create/button/?url=\'+encodeURIComponent(\'http://com.crfashionbook/text/dummy-article-18-title/\')+\'&media=\'+encodeURIComponent(media)+\'&description=Vestibulum condimentum accumsanornare arcu, sit amet elementum quam felis at elit.\', \'Share on Pinterest\',\'width=626,height=436\');',
			'linkedin' 		=> 'window.open(\'http://www.linkedin.com/shareArticle?mini=true&url=\'+encodeURIComponent(\''. get_permalink($thePost->ID, FALSE) .'\')+\'&title=\'+encodeURIComponent(\''. $thePost->post_title .'\'), \'Share on Linkedin\', \'width=626,height=436\');return false;'
		);

		return '<li class="'. $options['liClass'] .'"><a href="'. $url[$network] .'" class="'. $class .'" onclick="javascript:'. $clickEvent[$network] .'"></a></li>';
	}
