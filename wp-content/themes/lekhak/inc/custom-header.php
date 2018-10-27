<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */


if ( ! function_exists( 'lekhak_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see lekhak_custom_header_setup().
	 */
	function lekhak_header_style() {
		$options = lekhak_get_theme_options();
		$css = '';

		$header_title_color = $options['header_title_color'];
		$header_tagline_color = $options['header_tagline_color'];


		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
		 */
		if ( $header_title_color && $header_tagline_color ) {

			$css .='
			.site-title a {
				color: '.esc_attr( $header_title_color ).';
			}
			#site-identity p.site-description {
				color: '.esc_attr( $header_tagline_color ).';
			}';
		}

		$css .= '.trail-items li:not(:last-child):after {
			    content: "' . html_entity_decode( esc_attr( $options['breadcrumb_separator'] ) ) . '";
		        color: #5f6d84;
				padding: 0 5px;
			}';
		
		wp_add_inline_style( 'lekhak-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'lekhak_header_style', 10 );