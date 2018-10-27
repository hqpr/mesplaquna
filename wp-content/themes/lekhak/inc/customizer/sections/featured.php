<?php
/**
 * Featured Section options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

// Add Featured section
$wp_customize->add_section( 'lekhak_featured_section', array(
	'title'             => esc_html__( 'Featured Slider','lekhak' ),
	'description'       => esc_html__( 'Featured Slider Section options.', 'lekhak' ),
	'panel'             => 'lekhak_front_page_panel',
) );

// Featured content enable control and setting
$wp_customize->add_setting( 'lekhak_theme_options[featured_section_enable]', array(
	'default'			=> 	$options['featured_section_enable'],
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[featured_section_enable]', array(
	'label'             => esc_html__( 'Featured Section Enable', 'lekhak' ),
	'section'           => 'lekhak_featured_section',
	'on_off_label' 		=> lekhak_switch_options(),
) ) );

// Featured btn title setting and control
$wp_customize->add_setting( 'lekhak_theme_options[featured_btn_label]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['featured_btn_label'],
) );

$wp_customize->add_control( 'lekhak_theme_options[featured_btn_label]', array(
	'label'           	=> esc_html__( 'Button label', 'lekhak' ),
	'section'        	=> 'lekhak_about_section',
	'active_callback' 	=> 'lekhak_is_featured_section_enable',
	'type'				=> 'text',
) );

for ( $i = 1; $i <= 3; $i++ ) {
	// featured pages drop down chooser control and setting
	$wp_customize->add_setting( 'lekhak_theme_options[featured_content_page_' . $i . ']', array(
		'sanitize_callback' => 'lekhak_sanitize_page',
	) );

	$wp_customize->add_control( new Lekhak_Dropdown_Chooser( $wp_customize, 'lekhak_theme_options[featured_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'lekhak' ), $i ),
		'section'           => 'lekhak_featured_section',
		'choices'			=> lekhak_page_choices(),
		'active_callback'	=> 'lekhak_is_featured_section_enable',
	) ) );
}
