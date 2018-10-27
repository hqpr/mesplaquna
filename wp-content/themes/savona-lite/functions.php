<?php


// ----------------------------------------------------------------------------------
//	Register Front-End Styles And Scripts
// ----------------------------------------------------------------------------------

function savona_lite_enqueue_child_styles() {
 
    wp_enqueue_style( 'savona-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'savona-lite-style', get_stylesheet_directory_uri() . '/style.css', array( 'savona-style' ), wp_get_theme()->get('Version') );
}
add_action( 'wp_enqueue_scripts', 'savona_lite_enqueue_child_styles' );
