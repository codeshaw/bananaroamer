<?php

/**
 * GLOBAL VARIABLES
 */
// This is hard-coded and gross, but who the fuck cares rn?
$backgrounds = array("image_b", "image_c", "image_a");

/* THEME SETUP
------------------------------------------------ */

function bananaroamer_setup() {
	
	// Automatic feed
	add_theme_support( 'automatic-feed-links' );
	
	// Set content-width
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 620;
	
	// Post thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'post-image', 620, 9999 );
	
	// Title tag
	add_theme_support( 'title-tag' );
	
	// Post formats
	add_theme_support( 'post-formats', array( 'aside' ) );
	
	// Add nav menu
	register_nav_menu( 'primary-menu', __( 'Primary Menu', 'bananaroamer' ) );

}
add_action( 'after_setup_theme', 'bananaroamer_setup' );


/* ENQUEUE STYLES
------------------------------------------------ */

function bananaroamer_load_style() {
	if ( ! is_admin() ) {
        wp_enqueue_style( 'wanderlost_style', get_stylesheet_uri());
    } 
}
add_action( 'wp_print_styles', 'bananaroamer_load_style' );


/* ENQUEUE COMMENT-REPLY.JS
------------------------------------------------ */

function bananaroamer_load_scripts(){
    if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    wp_enqueue_script( 'tracking', get_theme_file_uri( '/js/tracking.js') );
}
add_action( 'wp_print_scripts', 'bananaroamer_load_scripts' );


function wanderlost_get_background() {
    global $backgrounds;

    $current = current($backgrounds);
    if ($current === false) {
        reset($backgrounds);
        $current = current($backgrounds);
    }
    next($backgrounds);
    echo $current;
}

/**
 * Debug to the damn console
 *
 * @param $data The data to debug
 */
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

?>
