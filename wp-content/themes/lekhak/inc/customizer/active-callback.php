<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

if ( ! function_exists( 'lekhak_is_loader_enable' ) ) :
	/**
	 * Check if loader is enabled.
	 *
	 * @since Lekhak 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function lekhak_is_loader_enable( $control ) {
		return $control->manager->get_setting( 'lekhak_theme_options[loader_enable]' )->value();
	}
endif;

if ( ! function_exists( 'lekhak_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since Lekhak 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function lekhak_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'lekhak_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'lekhak_is_menu_sticky_enable' ) ) :
	/**
	 * Check if menu sticky is enabled.
	 *
	 * @since Lekhak 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function lekhak_is_menu_sticky_enable( $control ) {
		return $control->manager->get_setting( 'lekhak_theme_options[menu_sticky]' )->value();
	}
endif;

if ( ! function_exists( 'lekhak_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Lekhak 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function lekhak_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'lekhak_theme_options[pagination_enable]' )->value();
	}
endif;

/**
 * Front Page Active Callbacks
 */

/**
 * Check if featured section is enabled.
 *
 * @since Lekhak 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function lekhak_is_featured_section_enable( $control ) {
	return ( $control->manager->get_setting( 'lekhak_theme_options[featured_section_enable]' )->value() );
}

/**
 * Check if featured_post section is enabled.
 *
 * @since Lekhak 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function lekhak_is_featured_post_section_enable( $control ) {
	return ( $control->manager->get_setting( 'lekhak_theme_options[featured_post_section_enable]' )->value() );
}

/**
 * Check if popular_post section is enabled.
 *
 * @since Lekhak 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function lekhak_is_popular_post_section_enable( $control ) {
	return ( $control->manager->get_setting( 'lekhak_theme_options[popular_post_section_enable]' )->value() );
}

/**
 * Check if popular_post_left section content type is post.
 *
 * @since Lekhak 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function lekhak_is_popular_post_left_section_content_post_enable( $control ) {
	$content_type = $control->manager->get_setting( 'lekhak_theme_options[popular_post_left_content_type]' )->value();
	return lekhak_is_popular_post_section_enable( $control ) && ( 'post' == $content_type );
}

/**
 * Check if popular_post_left section content type is page.
 *
 * @since Lekhak 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function lekhak_is_popular_post_left_section_content_page_enable( $control ) {
	$content_type = $control->manager->get_setting( 'lekhak_theme_options[popular_post_left_content_type]' )->value();
	return lekhak_is_popular_post_section_enable( $control ) && ( 'page' == $content_type );
}

/**
 * Check if popular_post_left section content type is category.
 *
 * @since Lekhak 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function lekhak_is_popular_post_left_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'lekhak_theme_options[popular_post_left_content_type]' )->value();
	return lekhak_is_popular_post_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if popular_post_right section content type is post.
 *
 * @since Lekhak 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function lekhak_is_popular_post_right_section_content_post_enable( $control ) {
	$content_type = $control->manager->get_setting( 'lekhak_theme_options[popular_post_right_content_type]' )->value();
	return lekhak_is_popular_post_section_enable( $control ) && ( 'post' == $content_type );
}

/**
 * Check if popular_post_right section content type is page.
 *
 * @since Lekhak 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function lekhak_is_popular_post_right_section_content_page_enable( $control ) {
	$content_type = $control->manager->get_setting( 'lekhak_theme_options[popular_post_right_content_type]' )->value();
	return lekhak_is_popular_post_section_enable( $control ) && ( 'page' == $content_type );
}

/**
 * Check if blog section is enabled.
 *
 * @since Lekhak 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function lekhak_is_blog_section_enable( $control ) {
	return ( $control->manager->get_setting( 'lekhak_theme_options[blog_section_enable]' )->value() );
}

/**
 * Check if blog section content type is category.
 *
 * @since Lekhak 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function lekhak_is_blog_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'lekhak_theme_options[blog_content_type]' )->value();
	return lekhak_is_blog_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if blog section content type is recent.
 *
 * @since Lekhak 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function lekhak_is_blog_section_content_recent_enable( $control ) {
	$content_type = $control->manager->get_setting( 'lekhak_theme_options[blog_content_type]' )->value();
	return lekhak_is_blog_section_enable( $control ) && ( 'recent' == $content_type );
}
