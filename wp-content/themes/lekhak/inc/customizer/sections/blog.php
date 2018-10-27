<?php
/**
 * Blog Section options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

// Add Blog section
$wp_customize->add_section( 'lekhak_blog_section', array(
	'title'             => esc_html__( 'Latest Posts','lekhak' ),
	'description'       => esc_html__( 'Latest Posts Section options.', 'lekhak' ),
	'panel'             => 'lekhak_front_page_panel',
) );

// Blog content enable control and setting
$wp_customize->add_setting( 'lekhak_theme_options[blog_section_enable]', array(
	'default'			=> 	$options['blog_section_enable'],
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[blog_section_enable]', array(
	'label'             => esc_html__( 'Blog Section Enable', 'lekhak' ),
	'section'           => 'lekhak_blog_section',
	'on_off_label' 		=> lekhak_switch_options(),
) ) );

// Blog content title 
$wp_customize->add_setting( 'lekhak_theme_options[blog_section_title]',
	array(
		'default'       	=> $options['blog_section_title'],
		'sanitize_callback'	=> 'sanitize_text_field',
		'transport'			=> 'postMessage',
	)
);
$wp_customize->add_control( 'lekhak_theme_options[blog_section_title]',
    array(
		'label'      		=> esc_html__( 'Latest Posts Title', 'lekhak' ),
		'section'    		=> 'lekhak_blog_section',
		'type'		 		=> 'text',
		'active_callback'   => 'lekhak_is_blog_section_enable',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'lekhak_theme_options[blog_section_title]', array(
		'selector'            => '#latest-posts .section-header h2.section-title',
		'settings'            => 'lekhak_theme_options[blog_section_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'lekhak_blog_section_title_partial',
    ) );
}

// Blog content title 
$wp_customize->add_setting( 'lekhak_theme_options[blog_section_btn_label]',
	array(
		'default'       	=> $options['blog_section_btn_label'],
		'sanitize_callback'	=> 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'lekhak_theme_options[blog_section_btn_label]',
    array(
		'label'      		=> esc_html__( 'Button Label', 'lekhak' ),
		'section'    		=> 'lekhak_blog_section',
		'type'		 		=> 'text',
		'active_callback'   => 'lekhak_is_blog_section_enable',
    )
);

// Blog content type control and setting
$wp_customize->add_setting( 'lekhak_theme_options[blog_content_type]', array(
	'default'          	=> $options['blog_content_type'],
	'sanitize_callback' => 'lekhak_sanitize_select',
) );

$wp_customize->add_control( 'lekhak_theme_options[blog_content_type]', array(
	'label'             => esc_html__( 'Content Type', 'lekhak' ),
	'section'           => 'lekhak_blog_section',
	'type'				=> 'select',
	'active_callback' 	=> 'lekhak_is_blog_section_enable',
	'choices'			=> array( 
		'category' 	=> esc_html__( 'Category', 'lekhak' ),
		'recent' 	=> esc_html__( 'Recent', 'lekhak' ),
	),
) );

// Add dropdown category setting and control.
$wp_customize->add_setting(  'lekhak_theme_options[blog_content_category]', array(
	'sanitize_callback' => 'lekhak_sanitize_single_category',
) ) ;

$wp_customize->add_control( new Lekhak_Dropdown_Taxonomies_Control( $wp_customize,'lekhak_theme_options[blog_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'lekhak' ),
	'description'      	=> esc_html__( 'Note: Latest four posts will be shown from selected category', 'lekhak' ),
	'section'           => 'lekhak_blog_section',
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'lekhak_is_blog_section_content_category_enable'
) ) );

// Add dropdown categories setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[blog_category_exclude]', array(
	'sanitize_callback' => 'lekhak_sanitize_category_list',
) ) ;

$wp_customize->add_control( new Lekhak_Dropdown_Category_Control( $wp_customize,'lekhak_theme_options[blog_category_exclude]', array(
	'label'             => esc_html__( 'Select Excluding Categories', 'lekhak' ),
	'description'      	=> esc_html__( 'Note: Select categories to exclude. Press Shift key select multilple categories.', 'lekhak' ),
	'section'           => 'lekhak_blog_section',
	'type'              => 'dropdown-categories',
	'active_callback'	=> 'lekhak_is_blog_section_content_recent_enable'
) ) );
