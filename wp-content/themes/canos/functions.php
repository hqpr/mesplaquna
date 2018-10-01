<?php
/**
 * Canos functions and definitions
 *
 * @package Canos
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1300; /* pixels */
}

if ( ! function_exists( 'canos_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function canos_setup() {

	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'canos', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video', 'audio', 'gallery'
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/* grid post module thumb (2 cols) */
	add_image_size( 'canos_620x413', 620, 413, true );
	/* wide thumb with sidebar */
	add_image_size( 'canos_833x554', 833, 554, true );
	/* wide thumb no sidebar */
	add_image_size( 'canos_1300x554', 1300, 554, true );
	/* widget thumbs */
	add_image_size( 'canos_100x90', 100, 90, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'canos' ),
		'footer' => esc_html__( 'Footer Menu', 'canos' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

}
endif; // canos_setup
add_action( 'after_setup_theme', 'canos_setup' );

/**
 * Enqueue scripts and styles.
 */
function canos_scripts() {
	wp_enqueue_style( 'canos-style', get_stylesheet_uri() );
	wp_enqueue_style( 'canos-fontawesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );

	wp_enqueue_script( 'canos-main-js', get_template_directory_uri() . '/js/canos.js', array( 'jquery' ), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_home() || has_post_format( 'gallery' ) ) {
		wp_enqueue_script( 'canos-flexslider', get_template_directory_uri() . '/js/flexslider.js', array( 'jquery' ), false, true );
	}

	if ( is_home() || has_post_format( 'video' ) ) {
		wp_enqueue_script( 'canos-fitvids', get_template_directory_uri() . '/js/fitvids.js', array( 'jquery' ), false, true );
	}
}
add_action( 'wp_enqueue_scripts', 'canos_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom functions for the sidebars.
 */
require get_template_directory() . '/inc/sidebars.php';

/**
 * Custom functions for the widgets.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom functions for the customizer.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-css.php';

/**
 * Require Canos Framework.
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/activate-canos-framework.php';
