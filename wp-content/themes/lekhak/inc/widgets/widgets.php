<?php
/**
 * Theme Palace widgets inclusion
 *
 * This is the template that includes all custom widgets of Lekhak
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

/*
 * Add social link widget
 */
require get_template_directory() . '/inc/widgets/social-link-widget.php';
/*
 * Add Latest Posts widget
 */
require get_template_directory() . '/inc/widgets/latest-posts-widget.php';


/**
 * Register widgets
 */
function lekhak_register_widgets() {

	register_widget( 'Lekhak_Latest_Post' );

	register_widget( 'Lekhak_Social_Link' );

}
add_action( 'widgets_init', 'lekhak_register_widgets' );