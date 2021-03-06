<?php
/**
 * Post modules - Filter by category
 *
 * @package Canos
 */

class Canos_Widget_Module_Category extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'canos_widget_module_category',
			'description' => esc_html__( 'Your site\'s Posts filtered by category.', 'canos' )
		);
		parent::__construct( 'canos_widget_module_category', esc_html__( 'Canos Post Modules - By Category', 'canos' ), $widget_ops );
		$this->alt_option_name = 'canos_widget_module_category';

		add_action( 'save_post', array( $this, 'flush_widget_cache') );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache') );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache') );
	}

	public function widget( $args, $instance ) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'canos_widget_module_category', 'widget' );
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

		$category = ( ! empty( $instance[ 'category' ] ) ) ? $instance[ 'category' ] : false;
		if ( ! $category ) {
			$category = false;
		}

		$order = ( ! empty( $instance[ 'order' ] ) ) ? $instance[ 'order' ] : 'date';
		if ( ! $order ) {
			$order = 'date';
		}

		$number = ( ! empty( $instance[ 'number' ] ) ) ? absint( $instance[ 'number' ] ) : 4;
		if ( ! $number ) {
			$number = 4;
		}

		$offset = ( ! empty( $instance[ 'offset' ] ) ) ? absint( $instance[ 'offset' ] ) : 0;
		if ( ! $offset ) {
			$offset = 0;
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
			'offset'              => $offset,
			'ignore_sticky_posts' => true
		);

		if ( $category ) {
			$r_args[ 'cat' ] = $category;
		}

		if ( $order == 'comments' ) {
			$r_args[ 'orderby' ] = 'comment_count';
		} else if ( $order == 'views' ) {
			$r_args[ 'orderby' ] = 'meta_value_num';
			$r_args[ 'meta_key' ] = '_canos_framework_post_views_count';
		}

		if ( $exclude ) {
			$exclude = explode( ',', $exclude );
			$r_args[ 'post__not_in' ] = $exclude;
		}

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
			wp_cache_set( 'canos_widget_module_category', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'category' ] = strip_tags( $new_instance[ 'category' ] );
		$instance[ 'order' ] = strip_tags( $new_instance[ 'order' ] );
		$instance[ 'number' ] = (int) $new_instance[ 'number' ];
		$instance[ 'offset' ] = (int) $new_instance[ 'offset' ];
		$instance[ 'exclude' ] = strip_tags( $new_instance[ 'exclude' ] );
		$instance[ 'show_thumb' ] = isset( $new_instance[ 'show_thumb' ] ) ? (bool) $new_instance[ 'show_thumb' ] : false;
		$instance[ 'show_excerpt' ] = isset( $new_instance[ 'show_excerpt' ] ) ? (bool) $new_instance[ 'show_excerpt' ] : false;
		$instance[ 'show_authordate' ] = isset( $new_instance[ 'show_authordate' ] ) ? (bool) $new_instance[ 'show_authordate' ] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions[ 'canos_widget_module_category' ] ) ) {
			delete_option( 'canos_widget_module_category' );
		}

		return $instance;
	}

	public function flush_widget_cache() {
		wp_cache_delete( 'canos_widget_module_category', 'widget' );
	}

	public function form( $instance ) {

		$title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$category = isset( $instance[ 'category' ] ) ? esc_attr( $instance[ 'category' ] ) : '';
		$order = isset( $instance[ 'order' ] ) ? esc_attr( $instance[ 'order' ] ) : '';
		$number = isset( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : 4;
		$offset = isset( $instance[ 'offset' ] ) ? absint( $instance[ 'offset' ] ) : 0;
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category ID(s):', 'canos' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" type="text" value="<?php echo esc_attr( $category ); ?>" />
			<br>
			<small><?php esc_html_e( 'Type a list of category IDs separated by commas (eg. 1,5,8).', 'canos' ); ?></small>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('order') ); ?>"><?php esc_html_e( 'Order:', 'canos' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('order') ); ?>" name="<?php echo esc_attr( $this->get_field_name('order') ); ?>">
				<option value="date" <?php selected( $order, 'date' ); ?>>date</option>
				<option value="comments" <?php selected( $order, 'comments' ); ?>>comments</option>
				<option value="views" <?php selected( $order, 'views' ); ?>>views</option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'canos' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Offset:', 'canos' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo esc_attr( $offset ); ?>" />
			<br>
			<small><?php esc_html_e( 'The offset of this query. If you have a module that shows 4 posts before this one, you can start the query from the 5th post (using offset 4).', 'canos' ); ?></small>
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

add_action( 'widgets_init', 'canos_widget_module_category' );

function canos_widget_module_category() {
	register_widget( 'Canos_Widget_Module_Category' );
}
