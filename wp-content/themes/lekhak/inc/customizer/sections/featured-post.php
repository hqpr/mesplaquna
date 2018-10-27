<?php
/**
 * Featured post Section options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

// Add Featured post section
$wp_customize->add_section( 'lekhak_featured_post_section', array(
	'title'             => esc_html__( 'Featured Posts','lekhak' ),
	'description'       => esc_html__( 'Featured Posts Section options.', 'lekhak' ),
	'panel'             => 'lekhak_front_page_panel',
) );

// Featured post content enable control and setting
$wp_customize->add_setting( 'lekhak_theme_options[featured_post_section_enable]', array(
	'default'			=> 	$options['featured_post_section_enable'],
	'sanitize_callback' => 'lekhak_sanitize_switch_control',
) );

$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[featured_post_section_enable]', array(
	'label'             => esc_html__( 'Featured posts Section Enable', 'lekhak' ),
	'section'           => 'lekhak_featured_post_section',
	'on_off_label' 		=> lekhak_switch_options(),
) ) );

// Featured post content 
$wp_customize->add_setting( 'lekhak_theme_options[featured_post_title]',
	array(
		'default'       	=> $options['featured_post_title'],
		'sanitize_callback'	=> 'sanitize_text_field',
		'transport'			=> 'postMessage',
	)
);
$wp_customize->add_control( 'lekhak_theme_options[featured_post_title]',
    array(
		'label'      		=> esc_html__( 'Featured Posts Title', 'lekhak' ),
		'section'    		=> 'lekhak_featured_post_section',
		'type'		 		=> 'text',
		'active_callback'   => 'lekhak_is_featured_post_section_enable',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'lekhak_theme_options[featured_post_title]', array(
		'selector'            => '#featured-posts .section-header h2.section-title',
		'settings'            => 'lekhak_theme_options[featured_post_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'lekhak_featured_post_title_partial',
    ) );
}

for ( $i = 1; $i <= 3; $i++ ) {
	// featured_post posts drop down chooser control and setting
	$wp_customize->add_setting( 'lekhak_theme_options[featured_post_content_post_' . $i . ']', array(
		'sanitize_callback' => 'lekhak_sanitize_page',
	) );

	$wp_customize->add_control( new Lekhak_Dropdown_Chooser( $wp_customize, 'lekhak_theme_options[featured_post_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'lekhak' ), $i ),
		'section'           => 'lekhak_featured_post_section',
		'choices'			=> lekhak_post_choices(),
		'active_callback'	=> 'lekhak_is_featured_post_section_enable',
	) ) );
}
