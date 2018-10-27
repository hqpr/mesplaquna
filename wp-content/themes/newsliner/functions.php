<?php
/*
 * Newsliner functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newsliner
*/

// Loads parent theme stylesheet
// Do not delete this
function newsliner_scripts()
{
    wp_enqueue_style('newsliner-style-parent', get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'newsliner_scripts', 20);

// Loads custom stylesheet and js for child. 
// This could override all stylesheets of parent theme and custom js functions
function newsliner_custom_scripts()
{
    wp_enqueue_style('newsliner', get_stylesheet_directory_uri() . '/assets/css/custom.css');
    wp_enqueue_script('newsliner-script', get_stylesheet_directory_uri().'/assets/js/child-script.js', array('jquery'), '', true);

}

add_action('wp_enqueue_scripts', 'newsliner_custom_scripts', 60);

//customizer
require get_stylesheet_directory() . '/inc/customizer/customizer.php';


/**
 * function for google fonts
 */
if (!function_exists('perfect_magazine_fonts_url')) :

    /**
     * Return fonts URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function perfect_magazine_fonts_url()
    {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Source Sans Pro, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Source Sans Pro font: on or off', 'newsliner')) {
            $fonts[] = 'Source+Sans+Pro:400,400i,600,600i';
        }

        /* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Playfair Display: on or off', 'newsliner')) {
            $fonts[] = 'Playfair+Display:400,400i,700,700i,900';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
                'subset' => urldecode($subsets),
            ), '//fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;

//* Add description to menu items
add_filter( 'walker_nav_menu_start_el', 'newsliner_add_description', 10, 2 );
function newsliner_add_description( $item_output, $item ) {
    $description = $item->post_content;
    if (('' !== $description) && (' ' !== $description) ) {
        return preg_replace( '/(<a.*)</', '$1' . '<span class="menu-description">' . $description . '</span><', $item_output) ;
    }
    else {
        return $item_output;
    };
}
