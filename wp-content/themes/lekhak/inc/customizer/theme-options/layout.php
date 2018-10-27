<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'lekhak_layout', array(
	'title'               => esc_html__('Layout','lekhak'),
	'description'         => esc_html__( 'Layout section options.', 'lekhak' ),
	'panel'               => 'lekhak_theme_options_panel',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[site_layout]', array(
	'sanitize_callback'   => 'lekhak_sanitize_select',
	'default'             => $options['site_layout'],
) );

$wp_customize->add_control(  new Lekhak_Custom_Radio_Image_Control ( $wp_customize, 'lekhak_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'lekhak' ),
	'section'             => 'lekhak_layout',
	'choices'			  => lekhak_site_layout(),
) ) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'lekhak_sanitize_select',
	'default'             => $options['sidebar_position'],
) );

$wp_customize->add_control(  new Lekhak_Custom_Radio_Image_Control ( $wp_customize, 'lekhak_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Blog/Archive Sidebar Position', 'lekhak' ),
	'section'             => 'lekhak_layout',
	'choices'			  => lekhak_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[post_sidebar_position]', array(
	'sanitize_callback'   => 'lekhak_sanitize_select',
	'default'             => $options['post_sidebar_position'],
) );

$wp_customize->add_control(  new Lekhak_Custom_Radio_Image_Control ( $wp_customize, 'lekhak_theme_options[post_sidebar_position]', array(
	'label'               => esc_html__( 'Posts Sidebar Position', 'lekhak' ),
	'section'             => 'lekhak_layout',
	'choices'			  => lekhak_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[page_sidebar_position]', array(
	'sanitize_callback'   => 'lekhak_sanitize_select',
	'default'             => $options['page_sidebar_position'],
) );

$wp_customize->add_control( new Lekhak_Custom_Radio_Image_Control( $wp_customize, 'lekhak_theme_options[page_sidebar_position]', array(
	'label'               => esc_html__( 'Pages Sidebar Position', 'lekhak' ),
	'section'             => 'lekhak_layout',
	'choices'			  => lekhak_sidebar_position(),
) ) );