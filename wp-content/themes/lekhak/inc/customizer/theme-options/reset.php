<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'lekhak_reset_section', array(
	'title'             => esc_html__('Reset all settings','lekhak'),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'lekhak' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'lekhak_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'lekhak_sanitize_checkbox',
	'transport'			  => 'postMessage',
) );

$wp_customize->add_control( 'lekhak_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'lekhak' ),
	'section'           => 'lekhak_reset_section',
	'type'              => 'checkbox',
) );
