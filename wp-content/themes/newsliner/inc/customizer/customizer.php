<?php 

/**
 * Newsliner Theme Customizer.
 *
 * @package Newsliner
 */

//customizer core option
require get_template_directory() . '/inc/customizer/core-customizer.php';

//customizer 
require get_template_directory() . '/inc/customizer/customizer-default.php';
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function perfect_magazine_customize_register( $wp_customize ) {

	// Load custom customizer functions.
	require get_template_directory() . '/inc/customizer/customizer-function.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	/*theme option panel details*/
	require get_template_directory() . '/inc/customizer/theme-option.php';


	// Register custom section types.
	$wp_customize->register_section_type( 'Perfect_Magazine_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Perfect_Magazine_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Perfect Magazine Pro', 'newsliner' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'newsliner' ),
				'pro_url'  => 'http://www.thememattic.com/theme/Newsliner-pro/',
				'priority'  => 1,
			)
		)
	);

	// Ticker Main Section.
	$wp_customize->add_section('ticker_section_settings',
		array(
			'title'      => esc_html__('Ticker Section', 'newsliner'),
			'priority'   => 55,
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
		)
	);

	// Setting - show_ticker_section.
	$wp_customize->add_setting('show_ticker_section',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'perfect_magazine_sanitize_checkbox',
		)
	);
	$wp_customize->add_control('show_ticker_section',
		array(
			'label'    => esc_html__('Enable Ticker', 'newsliner'),
			'section'  => 'ticker_section_settings',
			'type'     => 'checkbox',
			'priority' => 100,
		)
	);


	// Setting - drop down category for ticker.
	$wp_customize->add_setting('select_category_for_ticker',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(new Perfect_Magazine_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_ticker',
			array(
				'label'    => esc_html__('Category For Ticker', 'newsliner'),
				'section'  => 'ticker_section_settings',
				'type'     => 'dropdown-taxonomies',
				'taxonomy' => 'category',
				'priority' => 130,
			)));


}
add_action( 'customize_register', 'perfect_magazine_customize_register' );

