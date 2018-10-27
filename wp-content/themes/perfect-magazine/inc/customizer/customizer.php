<?php 

/**
 * perfect-magazine Theme Customizer.
 *
 * @package perfect-magazine
 */

//customizer core option
require get_template_directory() . '/inc/customizer/core-customizer.php';

//customizer 
require get_template_directory() . '/inc/customizer/customizer-default.php';
if ( ! function_exists( 'perfect_magazine_customize_register' ) ) :
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
					'title'    => esc_html__( 'Perfect Magazine Pro', 'perfect-magazine' ),
					'pro_text' => esc_html__( 'Upgrade To Pro', 'perfect-magazine' ),
					'pro_url'  => 'http://www.thememattic.com/theme/perfect-magazine-pro/',
					'priority'  => 1,
				)
			)
		);

	}
	add_action( 'customize_register', 'perfect_magazine_customize_register' );
endif;
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */
function perfect_magazine_customize_preview_js() {

	wp_enqueue_script( 'perfect_magazine_customizer', get_template_directory_uri() . '/assets/libraries/js/customizer.js', array( 'customize-preview' ), '20130508', true );

}
add_action( 'customize_preview_init', 'perfect_magazine_customize_preview_js' );

function perfect_magazine_customizer_css() {
	wp_enqueue_script( 'perfect_magazine_customize_controls', get_template_directory_uri() . '/assets/libraries/custom/js/customizer-admin.js', array( 'customize-controls' ) );
}
add_action( 'customize_controls_enqueue_scripts', 'perfect_magazine_customizer_css',0 );
