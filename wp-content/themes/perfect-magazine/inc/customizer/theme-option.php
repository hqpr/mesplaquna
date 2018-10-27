<?php

/**
 * Theme Options Panel.
 *
 * @package perfect-magazine
 */

$default = perfect_magazine_get_default_theme_options();

// Slider Main Section.
$wp_customize->add_section('slider_section_settings',
	array(
		'title'      => esc_html__('Slider Section', 'perfect-magazine'),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting - show_slider_section.
$wp_customize->add_setting('show_slider_section',
	array(
		'default'           => $default['show_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control('show_slider_section',
	array(
		'label'    => esc_html__('Enable Slider', 'perfect-magazine'),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting('show_fullwidth_slider_section',
    array(
        'default'           => $default['show_fullwidth_slider_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'perfect_magazine_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_fullwidth_slider_section',
    array(
        'label'    => esc_html__('Enable Fullwidth Slider', 'perfect-magazine'),
        'section'  => 'slider_section_settings',
        'type'     => 'checkbox',
        'priority' => 100,
    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_category_for_slider',
	array(
		'default'           => $default['select_category_for_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(new Perfect_Magazine_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_slider',
		array(
			'label'    => esc_html__('Category For Main slider', 'perfect-magazine'),
			'section'  => 'slider_section_settings',
			'type'     => 'dropdown-taxonomies',
			'taxonomy' => 'category',
			'priority' => 130,
		)));

// Setting - drop down category for slider.
$wp_customize->add_setting('select_category_for_slider_double_post',
	array(
		'default'           => $default['select_category_for_slider_double_post'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(new Perfect_Magazine_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_slider_double_post',
		array(
			'label'       => esc_html__('Category For 2 Pined Post ', 'perfect-magazine'),
			'description' => esc_html__('Select category to be shown on side of slider i.e the 2 pined posts', 'perfect-magazine'),
			'section'     => 'slider_section_settings',
			'type'        => 'dropdown-taxonomies',
			'taxonomy'    => 'category',
			'priority'    => 140,
		)));

// Latest featured Section.
$wp_customize->add_section('top_section_settings',
	array(
		'title'      => esc_html__('Header Section', 'perfect-magazine'),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting top_section_advertisement.
$wp_customize->add_setting('top_section_advertisement',
	array(
		'default'           => $default['top_section_advertisement'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_image',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control($wp_customize, 'top_section_advertisement',
		array(
			'label'       => esc_html__('Top Section Advertisement', 'perfect-magazine'),
			'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'perfect-magazine'), 728, 90),
			'section'     => 'top_section_settings',
			'priority'    => 120,
		)
	)
);

/*top_section_advertisement_url*/
$wp_customize->add_setting('top_section_advertisement_url',
	array(
		'default'           => $default['top_section_advertisement_url'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control('top_section_advertisement_url',
	array(
		'label'    => esc_html__('URL Link', 'perfect-magazine'),
		'section'  => 'top_section_settings',
		'type'     => 'text',
		'priority' => 130,
	)
);

// Add Theme Options Panel.
$wp_customize->add_panel('theme_option_panel',
	array(
		'title'      => esc_html__('Theme Options', 'perfect-magazine'),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);

/*layout management section start */
$wp_customize->add_section('theme_option_section_settings',
	array(
		'title'      => esc_html__('Layout Management', 'perfect-magazine'),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting social_icon_style.
$wp_customize->add_setting('single_page_first_text',
	array(
		'default'           => $default['single_page_first_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control('single_page_first_text',
	array(
		'label'       => esc_html__('Enable Large letter ', 'perfect-magazine'),
		'description' => esc_html__('Change the first letter to normal one in single page', 'perfect-magazine'),
		'section'     => 'theme_option_section_settings',
		'type'        => 'checkbox',
		'priority'    => 140,
	)
);
/*Home Page Layout*/
$wp_customize->add_setting('home_page_content_status',
	array(
		'default'           => $default['home_page_content_status'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control('home_page_content_status',
	array(
		'label'    => esc_html__('Enable Static Page Content', 'perfect-magazine'),
		'section'  => 'static_front_page',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

/*Home Page Layout*/
$wp_customize->add_setting('enable_overlay_option',
	array(
		'default'           => $default['enable_overlay_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_overlay_option',
	array(
		'label'    => esc_html__('Enable Banner Overlay', 'perfect-magazine'),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

/*Home Page Layout*/
$wp_customize->add_setting('homepage_layout_option',
	array(
		'default'           => $default['homepage_layout_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_select',
	)
);
$wp_customize->add_control('homepage_layout_option',
	array(
		'label'       => esc_html__('Site Layout', 'perfect-magazine'),
		'section'     => 'theme_option_section_settings',
		'choices'     => array(
			'full-width' => esc_html__('Full Width', 'perfect-magazine'),
			'boxed'      => esc_html__('Boxed', 'perfect-magazine'),
		),
		'type'     => 'select',
		'priority' => 160,
	)
);

/*Global Layout*/
$wp_customize->add_setting('global_layout',
	array(
		'default'           => $default['global_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_select',
	)
);
$wp_customize->add_control('global_layout',
	array(
		'label'          => esc_html__('Global Layout', 'perfect-magazine'),
		'section'        => 'theme_option_section_settings',
		'choices'        => array(
			'right-sidebar' => esc_html__('Content - Primary Sidebar', 'perfect-magazine'),
			'left-sidebar'  => esc_html__('Primary Sidebar - Content', 'perfect-magazine'),
			'no-sidebar'    => esc_html__('No Sidebar', 'perfect-magazine')
		),
		'type'     => 'select',
		'priority' => 170,
	)
);

/*single post Layout image*/
$wp_customize->add_setting('single_post_image_layout',
	array(
		'default'           => $default['single_post_image_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_select',
	)
);
$wp_customize->add_control('single_post_image_layout',
	array(
		'label'     => esc_html__('Single Post/Page Image Alocation', 'perfect-magazine'),
		'section'   => 'theme_option_section_settings',
		'choices'   => array(
			'full'     => esc_html__('Full', 'perfect-magazine'),
			'right'    => esc_html__('Right', 'perfect-magazine'),
			'left'     => esc_html__('Left', 'perfect-magazine'),
			'no-image' => esc_html__('No image', 'perfect-magazine')
		),
		'type'     => 'select',
		'priority' => 190,
	)
);

// Pagination Section.
$wp_customize->add_section('pagination_section',
	array(
		'title'      => esc_html__('Pagination Options', 'perfect-magazine'),
		'priority'   => 110,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting pagination_type.
$wp_customize->add_setting('pagination_type',
	array(
		'default'           => $default['pagination_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_select',
	)
);
$wp_customize->add_control('pagination_type',
	array(
		'label'    => esc_html__('Pagination Type', 'perfect-magazine'),
		'section'  => 'pagination_section',
		'type'     => 'select',
		'choices'  => array(
			'default' => esc_html__('Default (Older / Newer Post)', 'perfect-magazine'),
			'numeric' => esc_html__('Numeric', 'perfect-magazine'),
		),
		'priority' => 100,
	)
);

// Footer Section.
$wp_customize->add_section('footer_section',
	array(
		'title'      => esc_html__('Footer Options', 'perfect-magazine'),
		'priority'   => 130,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting social_content_heading.
$wp_customize->add_setting('number_of_footer_widget',
	array(
		'default'           => $default['number_of_footer_widget'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_select',
	)
);
$wp_customize->add_control('number_of_footer_widget',
	array(
		'label'    => esc_html__('Number Of Footer Widget', 'perfect-magazine'),
		'section'  => 'footer_section',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => array(
			0         => esc_html__('Disable footer sidebar area', 'perfect-magazine'),
			1         => esc_html__('1', 'perfect-magazine'),
			2         => esc_html__('2', 'perfect-magazine'),
			3         => esc_html__('3', 'perfect-magazine'),
		),
	)
);

// Setting copyright_text.
$wp_customize->add_setting('copyright_text',
	array(
		'default'           => $default['copyright_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control('copyright_text',
	array(
		'label'    => esc_html__('Footer Copyright Text', 'perfect-magazine'),
		'section'  => 'footer_section',
		'type'     => 'text',
		'priority' => 120,
	)
);

// Preloader Section.
$wp_customize->add_section('enable_preloader_option',
	array(
		'title'      => __('Preloader Options', 'perfect-magazine'),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting enable_preloader.
$wp_customize->add_setting('enable_preloader',
	array(
		'default'           => $default['enable_preloader'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_preloader',
	array(
		'label'    => __('Enable Preloader', 'perfect-magazine'),
		'section'  => 'enable_preloader_option',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

// Breadcrumb Section.
$wp_customize->add_section('breadcrumb_section',
	array(
		'title'      => esc_html__('Breadcrumb Options', 'perfect-magazine'),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting('breadcrumb_type',
	array(
		'default'           => $default['breadcrumb_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'perfect_magazine_sanitize_select',
	)
);
$wp_customize->add_control('breadcrumb_type',
	array(
		'label'       => esc_html__('Breadcrumb Type', 'perfect-magazine'),
		'description' => sprintf(esc_html__('Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin', 'perfect-magazine'), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">', '</a>'),
		'section'     => 'breadcrumb_section',
		'type'        => 'select',
		'choices'     => array(
			'disabled'   => esc_html__('Disabled', 'perfect-magazine'),
			'simple'     => esc_html__('Simple', 'perfect-magazine'),
			'advanced'   => esc_html__('Advanced', 'perfect-magazine'),
		),
		'priority' => 100,
	)
);