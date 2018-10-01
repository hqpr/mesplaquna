<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Canos_Framework
 * @subpackage Canos_Framework/public
 */

class Canos_Framework_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $canos_framework    The ID of this plugin.
	 */
	private $canos_framework;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $canos_framework       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $canos_framework, $version ) {

		$this->canos_framework = $canos_framework;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets/scripts for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		if ( is_active_widget( '', '', 'canos_widget_newsletter' ) ) {

			wp_enqueue_script( 'mailchimp-js', plugin_dir_url( __FILE__ ) . 'js/canos-mailchimp.js', array( 'jquery' ), $this->version, true );

			wp_localize_script( 'mailchimp-js', 'canos_framework_process_form_vars', 
				array( 
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'nonce' => wp_create_nonce( 'canos_framework-mailchimp-form-nonce' )
				) 
			);

		}

	}

	/**
	 * Process the MailChimp form.
	 *
	 * @since    1.0.0
	 */
	public function mailchimp_form() {

		$mailchimp_api = get_theme_mod( 'canos_opt_mailchimp_api' );

		if ( ! $mailchimp_api ) {

			echo '<div class="canos-newsletter-message canos-newsletter-error"><i class="fa fa-exclamation"></i>' . apply_filters( 'canos_framework_newsletter_api_error_filter', esc_html__( 'Please insert a correct MailChimp API key in the WP Customizer', 'canos-framework' ) ) . '</div>';

		} elseif ( empty( $_POST[ 'canos_framework_m_list_id' ] ) ) {

			echo '<div class="canos-newsletter-message canos-newsletter-error"><i class="fa fa-exclamation"></i>' . apply_filters( 'canos_framework_newsletter_id_error_filter', esc_html__( 'Please insert the ID of your MailChimp list', 'canos-framework' ) ) . '</div>';

		} else {

			$display_name = false;
			$welcome = false;
			$opt_in = false;

			if ( isset( $_POST[ 'canos_framework_m_display_name' ] ) && $_POST[ 'canos_framework_m_display_name' ] == 'yes' ) {
				$display_name = true;
			}

			if ( isset( $_POST[ 'canos_framework_m_confirm' ] ) &&  $_POST[ 'canos_framework_m_confirm' ] != 'nothing' ) {
				$welcome = true;
			}

			if ( isset( $_POST[ 'canos_framework_m_confirm' ] ) &&  $_POST[ 'canos_framework_m_confirm' ] == 'opt-in' ) {
				$opt_in = true;
			}

			if ( $display_name && ( empty( $_POST[ 'canos_framework_m_first_name' ] ) || empty( $_POST[ 'canos_framework_m_last_name' ] ) ) ) {
				echo '<div class="canos-newsletter-message canos-newsletter-error"><i class="fa fa-exclamation"></i>' . apply_filters( 'canos_framework_newsletter_names_error_filter', esc_html__( 'Please fill the "First Name" and the "Last Name" fields', 'canos-framework' ) ) . '</div>';
			}

			if ( empty( $_POST[ 'canos_framework_m_email' ] ) || !is_email( $_POST[ 'canos_framework_m_email' ] ) ) {
				echo '<div class="canos-newsletter-message canos-newsletter-error"><i class="fa fa-exclamation"></i>' . apply_filters( 'canos_framework_newsletter_email_error_filter', esc_html__( 'Please type a correct email address', 'canos-framework' ) ) . '</div>';
			}

			if ( ( wp_verify_nonce( $_POST[ 'canos_framework_m_nonce' ], 'canos_framework-mailchimp-form-nonce' ) || apply_filters( 'canos_framework_disable_load_more_nonce', false ) ) && ( $display_name && !empty( $_POST[ 'canos_framework_m_first_name' ] ) && !empty( $_POST[ 'canos_framework_m_last_name' ] ) && !empty( $_POST[ 'canos_framework_m_email' ] ) && is_email( $_POST[ 'canos_framework_m_email' ] ) ) || ( !$display_name && !empty( $_POST[ 'canos_framework_m_email' ] ) && is_email( $_POST[ 'canos_framework_m_email' ] ) ) ) {
				
				$MailChimp = new Drewm_MailChimp( $mailchimp_api );
				$result = $MailChimp->call( 'lists/subscribe', array(
					'id'                => sanitize_text_field( $_POST[ 'canos_framework_m_list_id' ] ),
					'email'             => array( 'email' => sanitize_email( $_POST[ 'canos_framework_m_email' ] ) ),
					'merge_vars'        => ( $display_name ? array( 'FNAME' => sanitize_text_field( $_POST[ 'canos_framework_m_first_name' ] ), 'LNAME' => sanitize_text_field( $_POST[ 'canos_framework_m_last_name' ] ) ) : array() ),
					'double_optin'      => $opt_in,
					'update_existing'   => true,
					'replace_interests' => false,
					'send_welcome'      => $welcome,
				) );

				echo '<div class="canos-newsletter-message canos-newsletter-success"><i class="fa fa-check"></i>' . apply_filters( 'canos_framework_newsletter_success_filter', esc_html__( 'Thank you for subscribing!', 'canos-framework' ) ) . '</div>';
			}

		}

		die();

	}

	/**
	 * Update the views count when the post is viewed (only in single.php).
	 *
	 * @since    1.0.0
	 */
	public function update_post_views( $postID ) {

		global $page;
		$post_view_meta_key = '_canos_framework_post_views_count';

		if ( is_single() && ( empty( $page ) || $page == 1 ) ) {

			$count = get_post_meta( $postID, $post_view_meta_key, true );

			if ( $count == '' ) {
				update_post_meta( $postID, $post_view_meta_key, 1 );
			} else {
				$count = absint( $count );
				$count++;
				update_post_meta( $postID, $post_view_meta_key, $count );
			}

		}

	}

	/**
	 * Get post views count.
	 *
	 * @since    1.0.0
	 */
	public function get_post_views( $postID ) {

		$post_view_meta_key = '_canos_framework_post_views_count';
		$count = get_post_meta( $postID, $post_view_meta_key, true );

		if ( $count == '' ) {
			delete_post_meta( $postID, $post_view_meta_key );
			add_post_meta( $postID, $post_view_meta_key, '0' );
			return "0";
		}

		return absint( $count );

	}

	/**
	 * Show post views count.
	 *
	 * @since    1.0.0
	 */
	public function show_post_views( $postID ) {

		$count = $this->get_post_views( $postID );

		echo '<span class="post-views-count canos-post-' . esc_attr( $postID ) . '">' . sprintf( esc_html__( '%s views', 'canos-framework' ), absint( $count ) ) . '</span>';

	}

	/**
	 * Show the post sharer.
	 *
	 * @since    1.0.0
	 */
	public function sharer() { ?>

		<?php if ( ! get_theme_mod( 'canos_opt_hide_post_sharer' ) ) :

		$socials = array(
			'facebook',
			'twitter',
			'google',
			'linkedin',
			'pinterest',
			'vk'
		);

		$socials = apply_filters( 'canos_social_sharers', $socials );
		?>

		<ul class="post-sharer">

		<?php if ( in_array( 'facebook', $socials ) ) : ?>
			<li><a class="canos-facebook-share" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="javascript:window.open(encodeURI(this.href), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook"></i><?php esc_html_e( 'Share', 'canos-framework' ) ?></a></li>
		<?php endif; ?>

		<?php if ( in_array( 'twitter', $socials ) ) : ?>
			<li><a class="canos-twitter-share" href="https://twitter.com/share?text=<?php echo rawurlencode( get_the_title() ); ?>&amp;url=<?php the_permalink(); ?>" onclick="javascript:window.open(encodeURI(this.href), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-twitter"></i><?php esc_html_e( 'Tweet', 'canos-framework' ) ?></a></li>
		<?php endif; ?>

		<?php if ( in_array( 'google', $socials ) ) : ?>
			<li><a class="canos-google-share" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(encodeURI(this.href), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i><?php esc_html_e( 'Share', 'canos-framework' ) ?></a></li>
		<?php endif; ?>

		<?php if ( in_array( 'linkedin', $socials ) ) : ?>
			<li><a class="canos-linkedin-share" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo rawurlencode( get_the_title() ); ?>&amp;source=<?php echo esc_url( home_url() ); ?>" onclick="javascript:window.open(encodeURI(this.href), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-linkedin"></i><?php esc_html_e( 'Share', 'canos-framework' ) ?></a></li>
		<?php endif; ?>

		<?php if ( in_array( 'pinterest', $socials ) ) : ?>
			<li><a class="canos-pinterest-share" href="//pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&amp;media=<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>&amp;description=<?php echo rawurlencode( get_the_title() ); ?>" onclick="javascript:window.open(encodeURI(this.href), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-pinterest"></i><?php esc_html_e( 'Pin it', 'canos-framework' ) ?></a></li>
		<?php endif; ?>

		<?php if ( in_array( 'vk', $socials ) ) : ?>
			<li><a class="canos-vk-share" href="http://vkontakte.ru/share.php?url=<?php echo get_permalink(); ?>&amp;image=<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>&amp;description=<?php echo rawurlencode( get_the_title() ); ?>" onclick="javascript:window.open(encodeURI(this.href), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-vk"></i><?php esc_html_e( 'Share', 'canos-framework' ) ?></a></li>
		<?php endif; ?>

		</ul>

		<?php endif;
	}

	/**
	 * Column shortcode.
	 *
	 * @since    1.0.0
	 */
	public function column( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'column' => 'one-third',
			'last' => false
		), $atts) );

		$last_class = '';
		$last_div = '';

		if ( $last ) {
			$last_class = ' canos-last-column';
			$last_div = '<div class="clear"></div>';
		}

		return '<div class="canos-column canos-' . $column . $last_class . '">' . do_shortcode( $content ) . '</div>' . $last_div;

	}

	/**
	 * Clean column shortcode output.
	 *
	 * @since    1.0.0
	 */
	public function clean_shortcodes( $content ) {

		$array = array (
			'<p>[' => '[', 
			']</p>' => ']', 
			']<br />' => ']'
		);

		$content = strtr( $content, $array );

		return $content;

	}

}
