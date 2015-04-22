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
