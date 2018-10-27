<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

// Footer Section
$wp_customize->add_section( 'lekhak_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'lekhak' ),
		'priority'   			=> 900,
		'panel'      			=> 'lekhak_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'lekhak_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'lekhak_santize_allow_tag',
		'transport'				=> 'postMessage',
	)
);
$wp_customize->add_control( 'lekhak_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'lekhak' ),
		'section'    			=> 'lekhak_section_footer',
		'type'		 			=> 'textarea',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'lekhak_theme_options[copyright_text]', array(
		'selector'            => '.site-info .copyright p',
		'settings'            => 'lekhak_theme_options[copyright_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'lekhak_copyright_text_partial',
    ) );
}

// scroll top visible
$wp_customize->add_setting( 'lekhak_theme_options[scroll_top_visible]',
	array(
		'default'       		=> $options['scroll_top_visible'],
		'sanitize_callback' => 'lekhak_sanitize_switch_control',
	)
);
$wp_customize->add_control( new Lekhak_Switch_Control( $wp_customize, 'lekhak_theme_options[scroll_top_visible]',
    array(
		'label'      			=> esc_html__( 'Display Scroll Top Button', 'lekhak' ),
		'section'    			=> 'lekhak_section_footer',
		'on_off_label' 		=> lekhak_switch_options(),
    )
) );