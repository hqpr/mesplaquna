<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage Lekhak
	 * @since Lekhak 1.0.0
	 */

	/**
	 * lekhak_doctype hook
	 *
	 * @hooked lekhak_doctype -  10
	 *
	 */
	do_action( 'lekhak_doctype' );

?>
<head>
<?php
	/**
	 * lekhak_before_wp_head hook
	 *
	 * @hooked lekhak_head -  10
	 *
	 */
	do_action( 'lekhak_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>
<?php
	/**
	 * lekhak_page_start_action hook
	 *
	 * @hooked lekhak_page_start -  10
	 *
	 */
	do_action( 'lekhak_page_start_action' ); 

	/**
	 * lekhak_loader_action hook
	 *
	 * @hooked lekhak_loader -  10
	 *
	 */
	do_action( 'lekhak_before_header' );

	/**
	 * lekhak_header_action hook
	 *
	 * @hooked lekhak_header_start -  10
	 * @hooked lekhak_site_branding -  20
	 * @hooked lekhak_site_navigation -  30
	 * @hooked lekhak_header_end -  50
	 *
	 */
	do_action( 'lekhak_header_action' );

    if ( lekhak_is_frontpage() ) {
    	/**
		 * lekhak_primary_content hook
		 *
		 * @hooked lekhak_add_featured_section -  10
		 * @hooked lekhak_content_start -  16
		 * @hooked lekhak_add_featured_post_section -  20
		 * @hooked lekhak_add_popular_post_section -  30
		 * @hooked lekhak_add_blog_section -  40
		 *
		 */
		do_action( 'lekhak_primary_content' );
	}