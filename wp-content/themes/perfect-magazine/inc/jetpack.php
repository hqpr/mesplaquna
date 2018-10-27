<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package perfect-magazine
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/responsive-videos/
 */
function perfect_magazine_jetpack_setup() {
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'perfect_magazine_jetpack_setup' );
