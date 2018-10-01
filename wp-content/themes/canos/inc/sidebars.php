<?php
/**
 * Custom functions for the sidebars
 *
 *
 * @package Canos
 */

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function canos_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'canos' ),
		'id'            => 'canos-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Mobile Sidebar', 'canos' ),
		'id'            => 'canos-sidebar-mobile',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'canos_widgets_init' );
