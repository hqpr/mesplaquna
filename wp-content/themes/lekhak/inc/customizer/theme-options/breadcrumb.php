<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

$wp_customize->add_section( 'lekhak_breadcrumb', array(
	'title'             => esc_html__( 'Breadcrumb','lekhak' ),
	'description'       => esc_html__( 'Breadcrumb section options.', 'lekhak' ),
	'panel'             => 'lekhak_theme_options_panel',
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[breadcrumb_enable]', array(
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
	'default'          	=> $options['breadcrumb_enable'],
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'lekhak' ),
	'section'          	=> 'lekhak_breadcrumb',
	'on_off_label' 		=> lekhak_switch_options(),
) ) );

// Breadcrumb separator setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[breadcrumb_separator]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['breadcrumb_separator'],
) );

$wp_customize->add_control( 'lekhak_theme_options[breadcrumb_separator]', array(
	'label'            	=> esc_html__( 'Separator', 'lekhak' ),
	'active_callback' 	=> 'lekhak_is_breadcrumb_enable',
	'section'          	=> 'lekhak_breadcrumb',
) );
