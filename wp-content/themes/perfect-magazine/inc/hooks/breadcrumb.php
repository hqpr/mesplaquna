<?php 

if ( ! function_exists( 'perfect_magazine_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function perfect_magazine_add_breadcrumb() {

		// Bail if Breadcrumb disabled.
		$breadcrumb_type = perfect_magazine_get_option( 'breadcrumb_type' );
		if ( 'disabled' === $breadcrumb_type ) {
			return;
		}
		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}
		// Render breadcrumb.
		echo '<div class="col-md-12">';
		switch ( $breadcrumb_type ) {
			case 'simple':
				perfect_magazine_simple_breadcrumb();
			break;

			case 'advanced':
				if ( function_exists( 'bcn_display' ) ) {
					bcn_display();
				}
			break;

			default:
			break;
		}
		echo '</div><!-- .container -->';
		return;

	}

endif;

add_action( 'perfect_magazine_action_breadcrumb', 'perfect_magazine_add_breadcrumb' , 10 );
