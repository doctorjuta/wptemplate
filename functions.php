<?php

require_once( 'wp-less/wp-less.php' );

/* Include css and js */
function include_css_and_js() {
    $SITE_VERSION = "1.0";
	wp_enqueue_style( 'fontStyle', get_template_directory_uri().'/fonts/fonts.css', array(), $SITE_VERSION );
	wp_enqueue_style( 'mainStyle', get_template_directory_uri().'/css/style.less', array(), $SITE_VERSION );
	wp_enqueue_script( 'mainScript', get_template_directory_uri().'/js/main.js', array(), $SITE_VERSION );
}
add_action( 'wp_enqueue_scripts', 'include_css_and_js' );

function mv_browser_body_class($classes) {
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if($is_lynx) $classes[] = 'lynx';
    elseif($is_gecko) $classes[] = 'gecko';
    elseif($is_opera) $classes[] = 'opera';
    elseif($is_NS4) $classes[] = 'ns4';
    elseif($is_safari) $classes[] = 'safari';
    elseif($is_chrome) $classes[] = 'chrome';
    elseif($is_IE) {
        $classes[] = 'ie';
        if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
        $classes[] = 'ie'.$browser_version[1];
    } else $classes[] = 'unknown';
    if($is_iphone) $classes[] = 'iphone';
    if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
        $classes[] = 'osx';
    } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
        $classes[] = 'linux';
    } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
        $classes[] = 'windows';
    }
    return $classes;
}
add_filter('body_class','mv_browser_body_class');

register_nav_menus( array('primary'=>__('Top Menu') ));
add_filter( 'show_admin_bar', '__return_false' );

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}

if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' );
    //add_image_size( 'custom-name', 618, 375, true );
}

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Allow svg uploading
function allowsvgup($mimes) { $mimes['svg'] = 'image/svg+xml'; return $mimes; }
add_filter('upload_mimes', 'allowsvgup');

?>