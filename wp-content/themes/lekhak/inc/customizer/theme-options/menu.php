<?php
/**
 * Menu options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'lekhak_menu', array(
	'title'             => esc_html__('Header Menu','lekhak'),
	'description'       => esc_html__( 'Header Menu options.', 'lekhak' ),
	'panel'             => 'nav_menus',
) );

// Menu sticky setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[menu_sticky]', array(
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
	'default'           => $options['menu_sticky'],
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[menu_sticky]', array(
	'label'             => esc_html__( 'Make Menu Sticky', 'lekhak' ),
	'section'           => 'lekhak_menu',
	'on_off_label' 		=> lekhak_switch_options(),
) ) );

// search enable setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[nav_search_enable]', array(
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
	'default'           => $options['nav_search_enable'],
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[nav_search_enable]', array(
	'label'             => esc_html__( 'Enable search', 'lekhak' ),
	'section'           => 'lekhak_menu',
	'on_off_label' 		=> lekhak_switch_options(),
) ) );

// primary menu label setting and control
$wp_customize->add_setting( 'lekhak_theme_options[primary_menu_label]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['primary_menu_label'],
) );

$wp_customize->add_control( 'lekhak_theme_options[primary_menu_label]', array(
	'label'           	=> esc_html__( 'Primary Menu Label', 'lekhak' ),
	'description'       => esc_html__( 'Displays in responsive view.', 'lekhak' ),
	'section'        	=> 'lekhak_menu',
	'type'				=> 'text',
) );
