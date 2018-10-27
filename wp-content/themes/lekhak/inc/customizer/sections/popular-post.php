<?php
/**
 * Popular post Section options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

// Add Popular post section
$wp_customize->add_section( 'lekhak_popular_post_section', array(
	'title'             => esc_html__( 'Popular Posts','lekhak' ),
	'description'       => esc_html__( 'Popular Posts Section options.', 'lekhak' ),
	'panel'             => 'lekhak_front_page_panel',
) );

// Popular post content enable control and setting
$wp_customize->add_setting( 'lekhak_theme_options[popular_post_section_enable]', array(
	'default'			=> 	$options['popular_post_section_enable'],
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[popular_post_section_enable]', array(
	'label'             => esc_html__( 'Popular posts Section Enable', 'lekhak' ),
	'section'           => 'lekhak_popular_post_section',
	'on_off_label' 		=> lekhak_switch_options(),
) ) );

// Popular post content 
$wp_customize->add_setting( 'lekhak_theme_options[popular_post_title]',
	array(
		'default'       	=> $options['popular_post_title'],
		'sanitize_callback'	=> 'sanitize_text_field',
		'transport'			=> 'postMessage',
	)
);
$wp_customize->add_control( 'lekhak_theme_options[popular_post_title]',
    array(
		'label'      		=> esc_html__( 'Popular Posts Title', 'lekhak' ),
		'section'    		=> 'lekhak_popular_post_section',
		'type'		 		=> 'text',
		'active_callback'   => 'lekhak_is_popular_post_section_enable',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'lekhak_theme_options[popular_post_title]', array(
		'selector'            => '#popular-posts .section-header h2.section-title',
		'settings'            => 'lekhak_theme_options[popular_post_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'lekhak_popular_post_title_partial',
    ) );
}

// Popular post left control and setting
$wp_customize->add_setting( 'lekhak_theme_options[popular_post_left_label]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Lekhak_Note_Control( $wp_customize, 'lekhak_theme_options[popular_post_left_label]', array(
	'label'             => esc_html__( 'Popular Posts', 'lekhak' ),
	'section'           => 'lekhak_popular_post_section',
	'active_callback'	=> 'lekhak_is_popular_post_section_enable',
) ) );

// Add dropdown category setting and control.
$wp_customize->add_setting(  'lekhak_theme_options[popular_post_left_content_category]', array(
	'sanitize_callback' => 'lekhak_sanitize_single_category',
) ) ;

$wp_customize->add_control( new Lekhak_Dropdown_Taxonomies_Control( $wp_customize,'lekhak_theme_options[popular_post_left_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'lekhak' ),
	'description'      	=> esc_html__( 'Note: Latest three posts will be shown from selected category', 'lekhak' ),
	'section'           => 'lekhak_popular_post_section',
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'lekhak_is_popular_post_section_enable'
) ) );

// Popular post right control and setting
$wp_customize->add_setting( 'lekhak_theme_options[popular_post_right_label]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Lekhak_Note_Control( $wp_customize, 'lekhak_theme_options[popular_post_right_label]', array(
	'label'             => esc_html__( 'Highlighted Post', 'lekhak' ),
	'section'           => 'lekhak_popular_post_section',
	'active_callback'	=> 'lekhak_is_popular_post_section_enable',
) ) );

// popular_post posts drop down chooser control and setting
$wp_customize->add_setting( 'lekhak_theme_options[popular_post_right_content_post]', array(
	'sanitize_callback' => 'lekhak_sanitize_page',
) );

$wp_customize->add_control( new Lekhak_Dropdown_Chooser( $wp_customize, 'lekhak_theme_options[popular_post_right_content_post]', array(
	'label'             => esc_html__( 'Select Post', 'lekhak' ),
	'section'           => 'lekhak_popular_post_section',
	'choices'			=> lekhak_post_choices(),
	'active_callback'	=> 'lekhak_is_popular_post_section_enable',
) ) );
