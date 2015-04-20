<?php


/**
 * Class Content
 */

class Content
{
    private $data;
    private $compositeData = array();

    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function __set( $name , $value )
    {
        $this->compositeData[$name] = $value;
        return $this;
    }

    public function __get( $name )
    {
        if (!isset($this->data->$name)) {
            return $this->compositeData[$name];
        }
        return $this->data->$name;
    }
}


/**
 * Class Handling contents retrievement
 */

class ContentManager
{

    private $contentType = array();
    private $postPerPage = -1;
    private $order = 'DESC';
    private $orderby = 'date';
    private $postId;
    private $taxonomy;
    private $queryParameters;

    private $contents = array();

    public function __construct( $contentType = null)
    {
        if(!is_null($contentType))
        {
            $this->contentType = $contentType;
            return $this;
        }
        $this->contentType = array(
            'video',
            'caption',
            'text',
            'book'
        );
        return $this;
    }

    private function formatImage($anImage)
    {
        $imageSizes = get_intermediate_image_sizes();
        $imageSizes[] = 'full';

        $setOfImages = array();

        foreach ($imageSizes as $size) {
            $imageData = wp_get_attachment_image_src( $anImage, $size);
            $setOfImages[$size] = array(
                'src'   => $imageData[0],
                'width' => $imageData[1],
                'height'=> $imageData[2],
                'id'    => $anImage
            );
        }
        return $setOfImages;
    }

    public function fetch()
    {
        $theParameters = $this->queryParameters;
        $theParameters['posts_per_page'] = $this->postPerPage;
        $theParameters['order'] = $this->order;
        $theParameters['orderby'] = $this->orderby;
        $theParameters['tax_query'] = $this->taxonomy;
        $theParameters['post_type'] = $this->contentType;

        // echo "<pre>";
        // var_dump($theParameters);
        // die();

        if(!is_null($this->postId))
        {
            $theParameters['p'] = $this->postId;
        }

        $theContents = new WP_Query( $theParameters );

        $counter = 0;

        while ( $theContents->have_posts() ) : $theContents->the_post();

            $aContent = new Content($theContents->post);

            // #################################################### //
            // #############          IMAGES          ############# //
            // #################################################### //

            $imagesBySize = array();

            // ############# Project ############# //
            if($aContent->post_type == 'project')
            {
//                $images = get_custom_field('brand_logo');
//                var_dump($images);
//                die();
//                $imagesBySize = $this->formatImage($images);
            }

            // ############# Brand ############# //
            if($aContent->post_type == 'brand')
            {
                $images = get_custom_field('brand_logo');
                $imagesBySize = $this->formatImage($images);
            }

            // ############# Text article ############# //
            if($aContent->post_type == 'text' OR $aContent->post_type == 'book')
            {
                $images = get_custom_field('article_text_image:to_array');

                foreach ($images as $anImage) {
                    $imagesBySize[] = $this->formatImage($anImage);
                }
            }

            // ############# Caption article ############# //
            if($aContent->post_type == 'caption')
            {
                $aContent->captions  = array();
                $captions = get_custom_field('article_caption_list_caption:to_array');

                foreach ($captions as $aCaption)
                {
                    $theImage = get_post($aCaption);

                    $contentCaptions[]      = $theImage->post_content;
                    $imagesBySize[]         = $this->formatImage($theImage->caption_image);

                }
            }

            // ############# Video article ############# //
            if($aContent->post_type == 'video')
            {
                $imagesBySize[]         = $this->formatImage($aContent->video_cover_image);

                parse_str( parse_url( $aContent->youtube_video_url, PHP_URL_QUERY ), $urlParameters );

                $aContent->youtube  = array(
                    'url' => $aContent->youtube_video_url,
                    'youtubeId' => $urlParameters['v']
                );
            }

            // ############# Envelope ############# //
            if($aContent->post_type == 'envelope')
            {
                $contentCaptions[] = $aContent->post_content;
                $imagesBySize[]    = $this->formatImage($aContent->envelope_image);
            }

            // ###################################################### //

            $aContent->captions = $contentCaptions;
            $aContent->images   = $imagesBySize;
            $aContent->nb       = $counter;

            $this->contents[]   = $aContent;
            $this->count        = $theContents->found_posts;
            $counter++;

        endwhile;
        wp_reset_query();
        return $this;
    }

    public function all()
    {
        return $this->contents;
    }

    public function setQueryParameters( $queryParametersKey , $queryParametersValue = null )
    {
        if(gettype($queryParametersKey) == "array")
        {
            $this->queryParameters = array_merge( $this->queryParameters , $queryParametersKey );
        }
        else
        {
            $this->queryParameters[$queryParametersKey] = $queryParametersValue;
        }
        return $this;
    }


    public function setPostId( $postId )
    {
        $this->postId = $postId;
        return $this;
    }

    public function setContentType( $contentType )
    {
        $this->contentType = $contentType;
        return $this;
    }

    public function setOrder( $order )
    {
        $this->order = $order;
        return $this;
    }

    public function setTaxonomy( $taxonomy )
    {
        $this->taxonomy = $taxonomy;
        return $this;
    }

    public function setOrderBy( $orderby )
    {
        $this->orderby = $orderby;
        return $this;
    }

    public function setPostPerPage( $postPerPage )
    {
        $this->postPerPage = $postPerPage;
        return $this;
    }
}



?>