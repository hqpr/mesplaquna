<?php
/**
* Partial functions
*
* @package Theme Palace
* @subpackage Lekhak
* @since Lekhak 1.0.0
*/

if ( ! function_exists( 'lekhak_featured_post_title_partial' ) ) :
    // copyright text
    function lekhak_featured_post_title_partial() {
        $options = lekhak_get_theme_options();
        return esc_html( $options['featured_post_title'] );
    }
endif;

if ( ! function_exists( 'lekhak_popular_post_title_partial' ) ) :
    // copyright text
    function lekhak_popular_post_title_partial() {
        $options = lekhak_get_theme_options();
        return esc_html( $options['popular_post_title'] );
    }
endif;

if ( ! function_exists( 'lekhak_blog_title_partial' ) ) :
    // copyright text
    function lekhak_blog_title_partial() {
        $options = lekhak_get_theme_options();
        return esc_html( $options['blog_section_title'] );
    }
endif;

if ( ! function_exists( 'lekhak_copyright_text_partial' ) ) :
    // copyright text
    function lekhak_copyright_text_partial() {
        $options = lekhak_get_theme_options();
        return esc_html( $options['copyright_text'] );
    }
endif;
