<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

// Add archive section
$wp_customize->add_section( 'lekhak_archive_section', array(
	'title'             => esc_html__( 'Blog/Archive','lekhak' ),
	'description'       => esc_html__( 'Archive section options.', 'lekhak' ),
	'panel'             => 'lekhak_theme_options_panel',
) );

// Your latest posts title setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[your_latest_posts_title]', array(
	'default'           => $options['your_latest_posts_title'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'lekhak_theme_options[your_latest_posts_title]', array(
	'label'             => esc_html__( 'Your Latest Posts Title', 'lekhak' ),
	'description'       => esc_html__( 'This option only works if Static Front Page is set to "Your latest posts."', 'lekhak' ),
	'section'           => 'lekhak_archive_section',
	'type'				=> 'text',
	'active_callback'   => 'lekhak_is_latest_posts'
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[hide_date]', array(
	'default'           => $options['hide_date'],
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[hide_date]', array(
	'label'             => esc_html__( 'Hide Date', 'lekhak' ),
	'section'           => 'lekhak_archive_section',
	'on_off_label' 		=> lekhak_hide_options(),
) ) );

// Archive author category setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[hide_category]', array(
	'default'           => $options['hide_category'],
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'lekhak' ),
	'section'           => 'lekhak_archive_section',
	'on_off_label' 		=> lekhak_hide_options(),
) ) );

// Archive comment category setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[hide_author]', array(
	'default'           => $options['hide_author'],
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[hide_author]', array(
	'label'             => esc_html__( 'Hide Author', 'lekhak' ),
	'section'           => 'lekhak_archive_section',
	'on_off_label' 		=> lekhak_hide_options(),
) ) );