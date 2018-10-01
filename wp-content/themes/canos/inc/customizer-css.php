<?php
/**
 * Canos Theme Customizer CSS
 *
 * @package Canos
 */

/**
 * Output custom CSS to live site.
 *
 */
function canos_customizer_css() {
	?>
		<style type="text/css">
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.sticky .sticky-post,
			.post-module .entry-cats a,
			#post-meta .entry-cats a,
			.widget_tag_cloud a,
			.canos_widget_newsletter .canos-newsletter-message,
			.canos_widget_social .site-follow a,
			#site-sidebar .canos_widget_newsletter {
			  background-color: <?php echo esc_attr( get_theme_mod( 'canos_opt_accent_color', '#55cbe3' ) ); ?>;
			}

			a:hover,
			#site-sidebar a:hover,
			#site-sidebar #site-navigation a:hover,
			#site-sidebar #site-navigation .menu > li.current_page_item > a,
			#site-sidebar #site-navigation .menu > li.current-menu-item > a,
			#site-sidebar #site-navigation .menu > li.current_page_ancestor > a {
			  color: <?php echo esc_attr( get_theme_mod( 'canos_opt_accent_color', '#55cbe3' ) ); ?>;
			}

			.entry-content a:hover,
			.comment-text a:hover,
			.widget_text a:hover,
			.empty-first-post:hover,
			#site-sidebar .widget_text a:hover {
			  border-color: <?php echo esc_attr( get_theme_mod( 'canos_opt_accent_color', '#55cbe3' ) ); ?>;
			}

			#comments .bypostauthor .comment-author cite {
			  border-bottom: 2px solid <?php echo esc_attr( get_theme_mod( 'canos_opt_accent_color', '#55cbe3' ) ); ?>;
			}

			<?php
			$site_font = get_theme_mod( 'canos_opt_site_custom_font' ) ? get_theme_mod( 'canos_opt_site_custom_font' ) : get_theme_mod( 'canos_opt_site_google_font', 'Open+Sans' );
			$site_font = str_replace( '+', ' ', $site_font );
			?>

			body,
			button,
			input,
			select,
			textarea {
				font-family: <?php echo esc_attr( $site_font ); ?>;
			}
		</style>
	<?php
}
add_action( 'wp_head', 'canos_customizer_css' );
