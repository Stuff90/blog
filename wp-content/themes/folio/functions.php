<?php require_once 'class/Content.php';




    require_once 'setup/filters.php';
    add_filter( 'clean_content', 'clean_content_fn', 20 );
	add_filter( 'share_icons', 'share_icons_fn', 20 , 3 );


    function registerMainMenu() {
        register_nav_menu('header-menu',__( 'Header Menu' ));
    }

    add_image_size( 'Article Thumbnail' 	, '400' , '250'    , true );
    add_image_size( 'Article Cover'		    , '900' , '250'    , true );


    add_action( 'init', 'registerMainMenu' );

    add_theme_support( 'post-thumbnails' );