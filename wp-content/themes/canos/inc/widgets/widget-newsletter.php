<?php
/**
 * Newsletter
 *
 * @package Canos
 */

class Canos_Widget_Newsletter extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'canos_widget_newsletter',
			'description' => esc_html__( 'A custom MailChimp widget. You need a Mailchimp account to use it', 'canos' )
		);
		parent::__construct( 'canos_widget_newsletter', esc_html__( 'Custom Newsletter', 'canos' ), $widget_ops );
		$this->alt_option_name = 'canos_widget_newsletter';
	}

	public function widget( $args, $instance ) {
		
		$title = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );

		$list = $instance[ 'list' ];
		$name = $instance[ 'name' ];
		$confirm = $instance[ 'confirm' ];
		$btn_text = $instance[ 'btn-text' ];

		echo $args[ 'before_widget' ];
		?>

		<div class="canos-item-newsletter">

			<?php if ( $title ) : ?>
				<h4 class="widget-title"><?php echo esc_html( $title ); ?></h4>
			<?php endif; ?>

			<form class="canos-newsletter-form" name="canos-newsletter-form" action="#" method="post" data-name="<?php echo esc_attr( $name ); ?>" data-confirm="<?php echo esc_attr( $confirm ); ?>">

				<?php if ( $name == 'yes' ) : ?>

					<p class="canos-newsletter-field">
						<label><?php esc_html_e( 'First Name', 'canos' );?></label>
						<input type="text" placeholder="<?php esc_html_e( 'First Name', 'canos' );?>" class="canos-newsletter-first-name">
					</p>

					<p class="canos-newsletter-field">
						<label><?php esc_html_e( 'Last Name', 'canos' );?></label>
						<input type="text" placeholder="<?php esc_html_e( 'Last Name', 'canos' );?>" class="canos-newsletter-last-name">
					</p>

				<?php endif; ?>

				<p class="canos-newsletter-field">
					<label><?php esc_html_e( 'Email Address', 'canos' );?></label>
					<input type="email" placeholder="<?php esc_html_e( 'Email Address', 'canos' );?>" class="canos-newsletter-email">
				</p>

				<input type="hidden" class="canos-newsletter-list-id" value="<?php echo esc_attr( $list );?>" />

				<input type="submit" value="<?php echo esc_attr( $btn_text ); ?>" class="canos-newsletter-button">
				
				<div class="canos-newsletter-loader"></div>
				<div class="clearfix"></div>

			</form>

			<div class="canos-newsletter-response"></div>

		</div>

		<?php
		echo $args[ 'after_widget' ];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'list' ] = strip_tags( $new_instance[ 'list' ] );
		$instance[ 'name' ] = strip_tags( $new_instance[ 'name' ] );
		$instance[ 'confirm' ] = strip_tags( $new_instance[ 'confirm' ] );
		$instance[ 'btn-text' ] = strip_tags( $new_instance[ 'btn-text' ] );

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete( 'canos_widget_module_views', 'widget' );
	}

	public function form( $instance ) {
		$title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$list = isset( $instance[ 'list' ] ) ? esc_attr( $instance[ 'list' ] ) : '';
		$name = isset( $instance[ 'name' ] ) ? esc_attr( $instance[ 'name' ] ) : '';
		$confirm = isset( $instance[ 'confirm' ] ) ? esc_attr( $instance[ 'confirm' ] ) : '';
		$btn_text = isset( $instance[ 'btn-text' ] ) ? esc_attr( $instance[ 'btn-text' ] ) : 'Subscribe';
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title (optional):', 'canos' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'list' ) ); ?>"><?php esc_html_e( 'MailChimp List ID:', 'canos' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'list' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'list' ) ); ?>" type="text" value="<?php echo esc_attr( $list ); ?>" />
			<small><?php printf( __( 'Enter your MailChimp List ID here (<a href="%s" title="How can I find my List ID?">How can I find my List ID?</a>)', 'canos' ), 'http://kb.mailchimp.com/article/how-can-i-find-my-list-id' ); ?></small>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('name') ); ?>"><?php esc_html_e( 'Display Name Fields?', 'canos' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('name') ); ?>">
				<option value="yes" <?php selected( $name, 'yes' ); ?>>yes</option>
				<option value="no" <?php selected( $name, 'no' ); ?>>no</option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('confirm') ); ?>"><?php esc_html_e( 'Display Name Fields?', 'canos' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('confirm') ); ?>" name="<?php echo esc_attr( $this->get_field_name('confirm') ); ?>">
				<option value="welcome-email" <?php selected( $confirm, 'welcome-email' ); ?>>welcome-email</option>
				<option value="opt-in" <?php selected( $confirm, 'opt-in' ); ?>>opt-in</option>
				<option value="nothing" <?php selected( $confirm, 'nothing' ); ?>>nothing</option>
			</select>
			<p><small><?php esc_html_e( 'You can send a "welcome" email after the subscribtion or enable the "double opt-in" option. In this case when your subscriber checks their inbox, they will see an email with a link to confirm their subscription.', 'canos' ); ?></small></p>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'btn-text' ) ); ?>"><?php esc_html_e( 'Button Text:', 'canos' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn-text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn-text' ) ); ?>" type="text" value="<?php echo esc_attr( $btn_text ); ?>" />
		</p>

	<?php }

}

add_action( 'widgets_init', 'canos_widget_newsletter' );

function canos_widget_newsletter() {
	register_widget( 'Canos_Widget_Newsletter' );
}
