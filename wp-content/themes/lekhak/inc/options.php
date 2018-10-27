<?php
/**
 * Theme Palace options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

/**
 * List of pages for page choices.
 * @return Array Array of page ids and name.
 */
function lekhak_page_choices() {
    $pages = get_pages();
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'lekhak' );
    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }
    return  $choices;
}

/**
 * List of posts for post choices.
 * @return Array Array of post ids and name.
 */
function lekhak_post_choices() {
    $posts = get_posts( array( 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'lekhak' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    return  $choices;
}

if ( ! function_exists( 'lekhak_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function lekhak_site_layout() {
        $lekhak_site_layout = array(
            'wide'  => get_template_directory_uri() . '/assets/images/full.png',
            'boxed-layout' => get_template_directory_uri() . '/assets/images/boxed.png',
        );

        $output = apply_filters( 'lekhak_site_layout', $lekhak_site_layout );
        return $output;
    }
endif;

if ( ! function_exists( 'lekhak_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function lekhak_selected_sidebar() {
        $lekhak_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'lekhak' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar', 'lekhak' ),
        );

        $output = apply_filters( 'lekhak_selected_sidebar', $lekhak_selected_sidebar );

        return $output;
    }
endif;


if ( ! function_exists( 'lekhak_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function lekhak_sidebar_position() {
        $lekhak_sidebar_position = array(
            'right-sidebar' => get_template_directory_uri() . '/assets/images/right.png',
            'no-sidebar'    => get_template_directory_uri() . '/assets/images/full.png',
        );

        $output = apply_filters( 'lekhak_sidebar_position', $lekhak_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'lekhak_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function lekhak_pagination_options() {
        $lekhak_pagination_options = array(
            'numeric'   => esc_html__( 'Numeric', 'lekhak' ),
            'default'   => esc_html__( 'Default(Older/Newer)', 'lekhak' ),
        );

        $output = apply_filters( 'lekhak_pagination_options', $lekhak_pagination_options );

        return $output;
    }
endif;

if ( ! function_exists( 'lekhak_switch_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function lekhak_switch_options() {
        $arr = array(
            'on'        => esc_html__( 'Enable', 'lekhak' ),
            'off'       => esc_html__( 'Disable', 'lekhak' )
        );
        return apply_filters( 'lekhak_switch_options', $arr );
    }
endif;

if ( ! function_exists( 'lekhak_hide_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function lekhak_hide_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'lekhak' ),
            'off'       => esc_html__( 'No', 'lekhak' )
        );
        return apply_filters( 'lekhak_hide_options', $arr );
    }
endif;

