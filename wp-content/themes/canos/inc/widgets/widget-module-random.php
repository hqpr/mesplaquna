<?php
/**
 * Post modules - Random
 *
 * @package Canos
 */

class Canos_Widget_Module_Random extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'canos_widget_module_random',
			'description' => esc_html__( 'Your site\'s Posts in random order.', 'canos' )
		);
		parent::__construct( 'canos_widget_module_random', esc_html__( 'Canos Post Modules - Random', 'canos' ), $widget_ops );
		$this->alt_option_name = 'canos_widget_module_random';

		add_action( 'save_post', array( $this, 'flush_widget_cache') );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache') );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache') );
	}

	public function widget( $args, $instance ) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'canos_widget_module_random', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		}

		if ( isset( $cache[ $args[ 'widget_id' ] ] ) ) {
			echo $cache[ $args[ 'widget_id' ] ];
			return;
		}

		ob_start();

		$title = ( ! empty( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance[ 'number' ] ) ) ? absint( $instance[ 'number' ] ) : 4;
		if ( ! $number ) {
			$number = 4;
		}

		$exclude = ( ! empty( $instance[ 'exclude' ] ) ) ? $instance[ 'exclude' ] : false;
		if ( ! $exclude ) {
			$exclude = false;
		}

		$show_thumb = isset( $instance[ 'show_thumb' ] ) ? $instance[ 'show_thumb' ] : false;
		if ( ! $show_thumb ) {
			$show_thumb = false;
		}

		$show_excerpt = isset( $instance[ 'show_excerpt' ] ) ? $instance[ 'show_excerpt' ] : false;
		if ( ! $show_excerpt ) {
			$show_excerpt = false;
		}

		$show_authordate = isset( $instance[ 'show_authordate' ] ) ? $instance[ 'show_authordate' ] : false;
		if ( ! $show_authordate ) {
			$show_authordate = false;
		}

		$r_args = array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'orderby'             => 'rand',
			'ignore_sticky_posts' => true
		);

		$r = new WP_Query( $r_args );

		if ( $r->have_posts() ) :

		$r_post_thumb_size = 'canos_100x90';
		$has_thumb = ( ! $show_thumb ) ? 'no-thumb' : '';

		?>

		<?php echo $args[ 'before_widget' ]; ?>

		<?php if ( $title ) {
			echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
		} ?>

		<?php while ( $r->have_posts() ) : $r->the_post(); ?>

			<article <?php post_class( esc_attr( $has_thumb ) ); ?> itemscope="itemscope" itemtype="http://schema.org/Article">

				<?php canos_widget_post_thumbnail( $r_post_thumb_size, $show_thumb ); ?>

				<header class="entry-header">
					<?php the_title( sprintf( '<h2 itemprop="headline" class="entry-title"><a itemprop="url" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				</header><!-- .entry-header -->

				<?php
				$r_authordate_vis_var = ( $show_authordate ) ? false : true;
				canos_post_date( $r_authordate_vis_var );
				canos_post_author( $r_authordate_vis_var );
				?>

				<?php if ( $show_excerpt ) : ?>
				<div class="entry-summary" itemprop="text">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
				<?php endif; ?>

				<footer class="entry-footer">
					<meta itemprop="interactionCount" content="UserComments:<?php echo esc_attr( get_comments_number() ); ?>">
				</footer><!-- .entry-footer -->

			</article><!-- #post-## -->
		<?php endwhile; ?>

		<?php echo $args[ 'after_widget' ]; ?>

		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args[ 'widget_id' ] ] = ob_get_flush();
			wp_cache_set( 'canos_widget_module_random', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'number' ] = (int) $new_instance[ 'number' ];
		$instance[ 'exclude' ] = strip_tags( $new_instance[ 'exclude' ] );
		$instance[ 'show_thumb' ] = isset( $new_instance[ 'show_thumb' ] ) ? (bool) $new_instance[ 'show_thumb' ] : false;
		$instance[ 'show_excerpt' ] = isset( $new_instance[ 'show_excerpt' ] ) ? (bool) $new_instance[ 'show_excerpt' ] : false;
		$instance[ 'show_authordate' ] = isset( $new_instance[ 'show_authordate' ] ) ? (bool) $new_instance[ 'show_authordate' ] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions[ 'canos_widget_module_random' ] ) ) {
			delete_option( 'canos_widget_module_random' );
		}

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete( 'canos_widget_module_random', 'widget' );
	}

	public function form( $instance ) {

		$title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$number = isset( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : 4;
		$exclude = isset( $instance[ 'exclude' ] ) ? esc_attr( $instance[ 'exclude' ] ) : '';
		$show_thumb = isset( $instance[ 'show_thumb' ] ) ? (bool) $instance[ 'show_thumb' ] : true;
		$show_excerpt = isset( $instance[ 'show_excerpt' ] ) ? (bool) $instance[ 'show_excerpt' ] : false;
		$show_authordate = isset( $instance[ 'show_authordate' ] ) ? (bool) $instance[ 'show_authordate' ] : true;
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title (optional):', 'canos' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'canos' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>"><?php esc_html_e( 'Exclude:', 'canos' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" type="text" value="<?php echo esc_attr( $exclude ); ?>" />
			<br>
			<small><?php esc_html_e( 'Type a list of posts IDs separated by commas (eg. 1,5,8) or leave the field empty.', 'canos' ); ?></small>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_thumb ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_thumb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_thumb' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_thumb' ) ); ?>"><?php esc_html_e( 'Display thumbnail?', 'canos' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_excerpt ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_excerpt' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_excerpt' ) ); ?>"><?php esc_html_e( 'Display excerpt?', 'canos' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_authordate ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_authordate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_authordate' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_authordate' ) ); ?>"><?php esc_html_e( 'Display author and date?', 'canos' ); ?></label>
		</p>

	<?php }

}

add_action( 'widgets_init', 'canos_widget_module_random' );

function canos_widget_module_random() {
	register_widget( 'Canos_Widget_Module_Random' );
}
