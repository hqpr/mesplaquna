<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'lekhak_pagination', array(
	'title'               => esc_html__('Pagination','lekhak'),
	'description'         => esc_html__( 'Blog/Archive Pagination options.', 'lekhak' ),
	'panel'               => 'lekhak_theme_options_panel',
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[pagination_enable]', array(
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
	'default'             => $options['pagination_enable'],
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'lekhak' ),
	'section'             => 'lekhak_pagination',
	'on_off_label' 		=> lekhak_switch_options(),
) ) );

// Site layout setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'lekhak_sanitize_select',
	'default'             => $options['pagination_type'],
) );

$wp_customize->add_control( 'lekhak_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'lekhak' ),
	'section'             => 'lekhak_pagination',
	'type'                => 'select',
	'choices'			  => lekhak_pagination_options(),
	'active_callback'	  => 'lekhak_is_pagination_enable',
) );
