<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 * @return array An array of default values
 */

function lekhak_get_default_theme_options() {
	$lekhak_default_options = array(
		// Color Options
		'header_title_color'			=> '#2a2e43',
		'header_tagline_color'			=> '#2a2e43',
		'header_txt_logo_extra'			=> 'show-all',
		'colorscheme_hue'				=> '#000',
		'colorscheme'					=> 'default',
		
		// typography Options
		'theme_typography' 				=> 'default',
		'body_theme_typography' 		=> 'default',
		
		// loader
		'loader_enable'         		=> false,
		'loader_icon'         			=> 'default',

		// breadcrumb
		'breadcrumb_enable'				=> true,
		'breadcrumb_separator'			=> '/',
		
		// layout 
		'site_layout'         			=> 'wide',
		'sidebar_position'         		=> 'right-sidebar',
		'post_sidebar_position' 		=> 'right-sidebar',
		'page_sidebar_position' 		=> 'right-sidebar',
		'menu_sticky'					=> true,
		'nav_search_enable'				=> true,
		'primary_menu_label'           	=> esc_html__( 'Primary', 'lekhak' ),

		// excerpt options
		'long_excerpt_length'           => 25,
		'read_more_text'           		=> esc_html__( 'Read More', 'lekhak' ),
		
		// pagination options
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',

		// footer options
		'copyright_text'           		=> sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s | All Rights Reserved', '1: Year, 2: Site Title with home URL', 'lekhak' ), '[the-year]', '[site-link]' ),
		'scroll_top_visible'        	=> true,

		// reset options
		'reset_options'      			=> false,
		
		// homepage options
		'enable_frontpage_content' 		=> false,

		// blog/archive options
		'your_latest_posts_title' 		=> esc_html__( 'Blogs', 'lekhak' ),
		'hide_date' 					=> false,
		'hide_category'					=> false,
		'hide_author'					=> false,

		// single post theme options
		'single_post_hide_date' 		=> false,
		'single_post_hide_author'		=> false,
		'single_post_hide_category'		=> false,
		'single_post_hide_tags'			=> false,

		/* Front Page */


		// Featured slider
		'featured_section_enable'		=> true,
		'featured_btn_label'			=> esc_html__( 'Start Reading', 'lekhak' ),

		// Featured post
		'featured_post_title'			=> esc_html__( 'Featured Posts', 'lekhak' ),
		'featured_post_section_enable'	=> true,

		// Popular post
		'popular_post_title'			=> esc_html__( 'Popular Posts', 'lekhak' ),
		'popular_post_section_enable'	=> true,


		// blog
		'blog_section_title'			=> esc_html__( 'Latest Posts', 'lekhak' ),
		'blog_section_enable'			=> true,
		'blog_content_type'				=> 'recent',
		'blog_section_btn_label'		=> esc_html__( 'Read More', 'lekhak' ),


	);

	$output = apply_filters( 'lekhak_default_theme_options', $lekhak_default_options );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}