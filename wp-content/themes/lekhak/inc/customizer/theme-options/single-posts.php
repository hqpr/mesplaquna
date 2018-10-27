<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'lekhak_single_post_section', array(
	'title'             => esc_html__( 'Single Post','lekhak' ),
	'description'       => esc_html__( 'Options to change the single posts globally.', 'lekhak' ),
	'panel'             => 'lekhak_theme_options_panel',
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[single_post_hide_date]', array(
	'default'           => $options['single_post_hide_date'],
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[single_post_hide_date]', array(
	'label'             => esc_html__( 'Hide Date', 'lekhak' ),
	'section'           => 'lekhak_single_post_section',
	'on_off_label' 		=> lekhak_hide_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[single_post_hide_author]', array(
	'default'           => $options['single_post_hide_author'],
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[single_post_hide_author]', array(
	'label'             => esc_html__( 'Hide Author', 'lekhak' ),
	'section'           => 'lekhak_single_post_section',
	'on_off_label' 		=> lekhak_hide_options(),
) ) );

// Archive author category setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[single_post_hide_category]', array(
	'default'           => $options['single_post_hide_category'],
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[single_post_hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'lekhak' ),
	'section'           => 'lekhak_single_post_section',
	'on_off_label' 		=> lekhak_hide_options(),
) ) );

// Archive tag category setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[single_post_hide_tags]', array(
	'default'           => $options['single_post_hide_tags'],
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[single_post_hide_tags]', array(
	'label'             => esc_html__( 'Hide Tag', 'lekhak' ),
	'section'           => 'lekhak_single_post_section',
	'on_off_label' 		=> lekhak_hide_options(),
) ) );
