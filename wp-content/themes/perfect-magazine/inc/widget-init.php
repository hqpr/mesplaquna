<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function perfect_magazine_widgets_init()
{

    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'perfect-magazine'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'perfect-magazine'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title secondary-font">',
        'after_title' => '</h2>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Homepage Widget Area', 'perfect-magazine'),
        'id' => 'sidebar-home-1',
        'description' => esc_html__('Add widgets here.', 'perfect-magazine'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title secondary-font"><span>',
        'after_title' => '</span></h2>',
    ));

    $perfect_magazine_footer_widgets_number = perfect_magazine_get_option('number_of_footer_widget');
    if ($perfect_magazine_footer_widgets_number > 0) {
        register_sidebar(array(
            'name' => esc_html__('Footer Column One', 'perfect-magazine'),
            'id' => 'footer-col-one',
            'description' => esc_html__('Displays items on footer section.', 'perfect-magazine'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title secondary-font">',
            'after_title' => '</h2>',
        ));
        if ($perfect_magazine_footer_widgets_number > 1) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Two', 'perfect-magazine'),
                'id' => 'footer-col-two',
                'description' => esc_html__('Displays items on footer section.', 'perfect-magazine'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title secondary-font">',
                'after_title' => '</h2>',
            ));
        }
        if ($perfect_magazine_footer_widgets_number > 2) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Three', 'perfect-magazine'),
                'id' => 'footer-col-three',
                'description' => esc_html__('Displays items on footer section.', 'perfect-magazine'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title secondary-font">',
                'after_title' => '</h2>',
            ));
        }
    }
}

add_action('widgets_init', 'perfect_magazine_widgets_init');
