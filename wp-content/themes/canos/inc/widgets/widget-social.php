<?php
/**
 * Custom social widget
 *
 * @package Canos
 */

class Canos_Widget_Social extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'canos_widget_social',
			'description' => esc_html__( 'Use this widget to display your social accounts.', 'canos' )
		);
		parent::__construct( 'canos_widget_social', esc_html__( 'Custom Social Icons', 'canos' ), $widget_ops );
		$this->alt_option_name = 'canos_widget_social';
	}

	function widget( $args, $instance ) {

		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		$target = isset( $instance[ 'target' ] ) ? $instance[ 'target' ] : false;
		if ( ! $target ) {
			$target = false;
		}
		$facebook = ( isset( $instance[ 'facebook' ] ) ) ? $instance[ 'facebook' ] : '';
		$twitter = ( isset( $instance[ 'twitter' ] ) ) ? $instance[ 'twitter' ] : '';
		$dribbble = ( isset( $instance[ 'dribbble' ] ) ) ? $instance[ 'dribbble' ] : '';
		$linkedin = ( isset( $instance[ 'linkedin' ] ) ) ? $instance[ 'linkedin' ] : '';
		$flickr = ( isset( $instance[ 'flickr' ] ) ) ? $instance[ 'flickr' ] : '';
		$tumblr = ( isset( $instance[ 'tumblr' ] ) ) ? $instance[ 'tumblr' ] : '';
		$vimeo = ( isset( $instance[ 'vimeo' ] ) ) ? $instance[ 'vimeo' ] : '';
		$youtube = ( isset( $instance[ 'youtube' ] ) ) ? $instance[ 'youtube' ] : '';
		$instagram = ( isset( $instance[ 'instagram' ] ) ) ? $instance[ 'instagram' ] : '';
		$google = ( isset( $instance[ 'google' ] ) ) ? $instance[ 'google' ] : '';
		$foursquare = ( isset( $instance[ 'foursquare' ] ) ) ? $instance[ 'foursquare' ] : '';
		$github = ( isset( $instance[ 'github' ] ) ) ? $instance[ 'github' ] : '';
		$pinterest = ( isset( $instance[ 'pinterest' ] ) ) ? $instance[ 'pinterest' ] : '';
		$stackoverflow = ( isset( $instance[ 'stackoverflow' ] ) ) ? $instance[ 'stackoverflow' ] : '';
		$deviantart = ( isset( $instance[ 'deviantart' ] ) ) ? $instance[ 'deviantart' ] : '';
		$behance = ( isset( $instance[ 'behance' ] ) ) ? $instance[ 'behance' ] : '';
		$delicious = ( isset( $instance[ 'delicious' ] ) ) ? $instance[ 'delicious' ] : '';
		$soundcloud = ( isset( $instance[ 'soundcloud' ] ) ) ? $instance[ 'soundcloud' ] : '';
		$spotify = ( isset( $instance[ 'spotify' ] ) ) ? $instance[ 'spotify' ] : '';
		$stumbleupon = ( isset( $instance[ 'stumbleupon' ] ) ) ? $instance[ 'stumbleupon' ] : '';
		$reddit = ( isset( $instance[ 'reddit' ] ) ) ? $instance[ 'reddit' ] : '';
		$vine = ( isset( $instance[ 'vine' ] ) ) ? $instance[ 'vine' ] : '';
		$digg = ( isset( $instance[ 'digg' ] ) ) ? $instance[ 'digg' ] : '';
		$vk = ( isset( $instance[ 'vk' ] ) ) ? $instance[ 'vk' ] : '';
		$rss = ( isset( $instance[ 'rss' ] ) ) ? $instance[ 'rss' ] : '';

		echo $before_widget;

		if ( $title ) { 
			echo $before_title . esc_html( $title ) . $after_title; 
		}
		?>

		<?php $target = ( $target ) ? 'target="_blank"' : ''; ?>
			
		<ul class="site-follow">
			<?php if ( $facebook != '' ) : ?>
				<li><a href="<?php echo esc_url( $facebook ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-facebook"></i></a></li>
			<?php endif; ?>
			<?php if ( $twitter != '' ) : ?>
				<li><a href="<?php echo esc_url( $twitter ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-twitter"></i></a></li>
			<?php endif; ?>
			<?php if ( $dribbble != '' ) : ?>
				<li><a href="<?php echo esc_url( $dribbble ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-dribbble"></i></a></li>
			<?php endif; ?>
			<?php if ( $linkedin != '' ) : ?>
				<li><a href="<?php echo esc_url( $linkedin ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-linkedin"></i></a></li>
			<?php endif; ?>
			<?php if ( $flickr != '' ) : ?>
				<li><a href="<?php echo esc_url( $flickr ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-flickr"></i></a></li>
			<?php endif; ?>
			<?php if ( $tumblr != '' ) : ?>
				<li><a href="<?php echo esc_url( $tumblr ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-tumblr"></i></a></li>
			<?php endif; ?>
			<?php if ( $vimeo != '' ) : ?>
				<li><a href="<?php echo esc_url( $vimeo ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-vimeo-square"></i></a></li>
			<?php endif; ?>
			<?php if ( $youtube != '' ) : ?>
				<li><a href="<?php echo esc_url( $youtube ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-youtube"></i></a></li>
			<?php endif; ?>
			<?php if ( $instagram != '' ) : ?>
				<li><a href="<?php echo esc_url( $instagram ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-instagram"></i></a></li>
			<?php endif; ?>
			<?php if ( $google != '' ) : ?>
				<li><a href="<?php echo esc_url( $google ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-google-plus"></i></a></li>
			<?php endif; ?>
			<?php if ( $foursquare != '' ) : ?>
				<li><a href="<?php echo esc_url( $foursquare ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-foursquare"></i></a></li>
			<?php endif; ?>
			<?php if ( $github != '' ) : ?>
				<li><a href="<?php echo esc_url( $github ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-github"></i></a></li>
			<?php endif; ?>
			<?php if ( $pinterest != '' ) : ?>
				<li><a href="<?php echo esc_url( $pinterest ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-pinterest"></i></a></li>
			<?php endif; ?>
			<?php if ( $stackoverflow != '' ) : ?>
				<li><a href="<?php echo esc_url( $stackoverflow ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-stack-overflow"></i></a></li>
			<?php endif; ?>
			<?php if ( $deviantart != '' ) : ?>
				<li><a href="<?php echo esc_url( $deviantart ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-deviantart"></i></a></li>
			<?php endif; ?>
			<?php if ( $behance != '' ) : ?>
				<li><a href="<?php echo esc_url( $behance ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-behance"></i></a></li>
			<?php endif; ?>
			<?php if ( $soundcloud != '' ) : ?>
				<li><a href="<?php echo esc_url( $soundcloud ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-soundcloud"></i></a></li>
			<?php endif; ?>
			<?php if ( $spotify != '' ) : ?>
				<li><a href="<?php echo esc_url( $spotify ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-spotify"></i></a></li>
			<?php endif; ?>
			<?php if ( $stumbleupon != '' ) : ?>
				<li><a href="<?php echo esc_url( $stumbleupon ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-stumbleupon"></i></a></li>
			<?php endif; ?>
			<?php if ( $reddit != '' ) : ?>
				<li><a href="<?php echo esc_url( $reddit ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-reddit"></i></a></li>
			<?php endif; ?>
			<?php if ( $vine != '' ) : ?>
				<li><a href="<?php echo esc_url( $vine ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-vine"></i></a></li>
			<?php endif; ?>
			<?php if ( $digg != '' ) : ?>
				<li><a href="<?php echo esc_url( $digg ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-digg"></i></a></li>
			<?php endif; ?>
			<?php if ( $vk != '' ) : ?>
				<li><a href="<?php echo esc_url( $vk ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-vk"></i></a></li>
			<?php endif; ?>
			<?php if ( $rss != '' ) : ?>
				<li><a href="<?php echo esc_url( $rss ); ?>" <?php echo esc_attr( $target ); ?>><i class="fa fa-rss"></i></a></li>
			<?php endif; ?>
		</ul>
	
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'target' ] = isset( $new_instance[ 'target' ] ) ? (bool) $new_instance[ 'target' ] : false;
		$instance[ 'facebook' ] = strip_tags( $new_instance[ 'facebook' ] );
		$instance[ 'twitter' ] = strip_tags( $new_instance[ 'twitter' ] );
		$instance[ 'dribbble' ] = strip_tags( $new_instance[ 'dribbble' ] );
		$instance[ 'linkedin' ] = strip_tags( $new_instance[ 'linkedin' ] );
		$instance[ 'flickr' ] = strip_tags( $new_instance[ 'flickr' ] );
		$instance[ 'tumblr' ] = strip_tags( $new_instance[ 'tumblr' ] );
		$instance[ 'vimeo' ] = strip_tags( $new_instance[ 'vimeo' ] );
		$instance[ 'youtube' ] = strip_tags( $new_instance[ 'youtube' ] );
		$instance[ 'instagram' ] = strip_tags( $new_instance[ 'instagram' ] );
		$instance[ 'google' ] = strip_tags( $new_instance[ 'google' ] );
		$instance[ 'foursquare' ] = strip_tags( $new_instance[ 'foursquare' ] );
		$instance[ 'github' ] = strip_tags( $new_instance[ 'github' ] );
		$instance[ 'pinterest' ] = strip_tags( $new_instance[ 'pinterest' ] );
		$instance[ 'stackoverflow' ] = strip_tags( $new_instance[ 'stackoverflow' ] );
		$instance[ 'deviantart' ] = strip_tags( $new_instance[ 'deviantart' ] );
		$instance[ 'behance' ] = strip_tags( $new_instance[ 'behance' ] );
		$instance[ 'delicious' ] = strip_tags( $new_instance[ 'delicious' ] );
		$instance[ 'soundcloud' ] = strip_tags( $new_instance[ 'soundcloud' ] );
		$instance[ 'spotify' ] = strip_tags( $new_instance[ 'spotify' ] );
		$instance[ 'stumbleupon' ] = strip_tags( $new_instance[ 'stumbleupon' ] );
		$instance[ 'reddit' ] = strip_tags( $new_instance[ 'reddit' ] );
		$instance[ 'vine' ] = strip_tags( $new_instance[ 'vine' ] );
		$instance[ 'digg' ] = strip_tags( $new_instance[ 'digg' ] );
		$instance[ 'vk' ] = strip_tags( $new_instance[ 'vk' ] );
		$instance[ 'rss' ] = strip_tags( $new_instance[ 'rss' ] );

		return $instance;
	}

	function form( $instance ) {

		$title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$target = isset( $instance[ 'target' ] ) ? (bool) $instance[ 'target' ] : false;
		$facebook = isset( $instance[ 'facebook' ] ) ? esc_attr( $instance[ 'facebook' ] ) : '';
		$twitter = isset( $instance[ 'twitter' ] ) ? esc_attr( $instance[ 'twitter' ] ) : '';
		$dribbble = isset( $instance[ 'dribbble' ] ) ? esc_attr( $instance[ 'dribbble' ] ) : '';
		$linkedin = isset( $instance[ 'linkedin' ] ) ? esc_attr( $instance[ 'linkedin' ] ) : '';
		$flickr = isset( $instance[ 'flickr' ] ) ? esc_attr( $instance[ 'flickr' ] ) : '';
		$tumblr = isset( $instance[ 'tumblr' ] ) ? esc_attr( $instance[ 'tumblr' ] ) : '';
		$vimeo = isset( $instance[ 'vimeo' ] ) ? esc_attr( $instance[ 'vimeo' ] ) : '';
		$youtube = isset( $instance[ 'youtube' ] ) ? esc_attr( $instance[ 'youtube' ] ) : '';
		$instagram = isset( $instance[ 'instagram' ] ) ? esc_attr( $instance[ 'instagram' ] ) : '';
		$google = isset( $instance[ 'google' ] ) ? esc_attr( $instance[ 'google' ] ) : '';
		$foursquare = isset( $instance[ 'foursquare' ] ) ? esc_attr( $instance[ 'foursquare' ] ) : '';
		$github = isset( $instance[ 'github' ] ) ? esc_attr( $instance[ 'github' ] ) : '';
		$pinterest = isset( $instance[ 'pinterest' ] ) ? esc_attr( $instance[ 'pinterest' ] ) : '';
		$stackoverflow = isset( $instance[ 'stackoverflow' ] ) ? esc_attr( $instance[ 'stackoverflow' ] ) : '';
		$deviantart = isset( $instance[ 'deviantart' ] ) ? esc_attr( $instance[ 'deviantart' ] ) : '';
		$behance = isset( $instance[ 'behance' ] ) ? esc_attr( $instance[ 'behance' ] ) : '';
		$delicious = isset( $instance[ 'delicious' ] ) ? esc_attr( $instance[ 'delicious' ] ) : '';
		$soundcloud = isset( $instance[ 'soundcloud' ] ) ? esc_attr( $instance[ 'soundcloud' ] ) : '';
		$spotify = isset( $instance[ 'spotify' ] ) ? esc_attr( $instance[ 'spotify' ] ) : '';
		$stumbleupon = isset( $instance[ 'stumbleupon' ] ) ? esc_attr( $instance[ 'stumbleupon' ] ) : '';
		$reddit = isset( $instance[ 'reddit' ] ) ? esc_attr( $instance[ 'reddit' ] ) : '';
		$vine = isset( $instance[ 'vine' ] ) ? esc_attr( $instance[ 'vine' ] ) : '';
		$digg = isset( $instance[ 'digg' ] ) ? esc_attr( $instance[ 'digg' ] ) : '';
		$vk = isset( $instance[ 'vk' ] ) ? esc_attr( $instance[ 'vk' ] ) : '';
		$rss = isset( $instance[ 'rss' ] ) ? esc_attr( $instance[ 'rss' ] ) : '';
		?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $target ); ?> id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open social links in a new window/tab?', 'canos' ); ?></label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_attr( $facebook ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo esc_attr( $twitter ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>"><?php esc_html_e( 'Dribbble URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble' ) ); ?>" value="<?php echo esc_attr( $dribbble ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'LinkedIn URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" value="<?php echo esc_attr( $linkedin ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>"><?php esc_html_e( 'Flickr URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr' ) ); ?>" value="<?php echo esc_attr( $flickr ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>"><?php esc_html_e( 'Tumblr URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tumblr' ) ); ?>" value="<?php echo esc_attr( $tumblr ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>"><?php esc_html_e( 'Vimeo URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) ); ?>" value="<?php echo esc_attr( $vimeo ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'Youtube URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" value="<?php echo esc_attr( $youtube ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_attr( $instagram ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'google' ) ); ?>"><?php esc_html_e( 'Google Plus URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google' ) ); ?>" value="<?php echo esc_attr( $google ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'foursquare' ) ); ?>"><?php esc_html_e( 'Foursquare URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'foursquare' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'foursquare' ) ); ?>" value="<?php echo esc_attr( $foursquare ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'github' ) ); ?>"><?php esc_html_e( 'GitHub URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'github' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'github' ) ); ?>" value="<?php echo esc_attr( $github ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" value="<?php echo esc_attr( $pinterest ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'stackoverflow' ) ); ?>"><?php esc_html_e( 'Stack Overflow URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'stackoverflow' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'stackoverflow' ) ); ?>" value="<?php echo esc_attr( $stackoverflow ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'deviantart' ) ); ?>"><?php esc_html_e( 'DeviantART URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'deviantart' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'deviantart' ) ); ?>" value="<?php echo esc_attr( $deviantart ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>"><?php esc_html_e( 'Behance URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'behance' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'behance' ) ); ?>" value="<?php echo esc_attr( $behance ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'delicious' ) ); ?>"><?php esc_html_e( 'Delicious URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'delicious' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'delicious' ) ); ?>" value="<?php echo esc_attr( $delicious ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>"><?php esc_html_e( 'SoundCloud URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'soundcloud' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'soundcloud' ) ); ?>" value="<?php echo esc_attr( $soundcloud ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'spotify' ) ); ?>"><?php esc_html_e( 'Spotify URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'spotify' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'spotify' ) ); ?>" value="<?php echo esc_attr( $spotify ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'stumbleupon' ) ); ?>"><?php esc_html_e( 'StumbleUpon URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'stumbleupon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'stumbleupon' ) ); ?>" value="<?php echo esc_attr( $stumbleupon ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>"><?php esc_html_e( 'Reddit URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'reddit' ) ); ?>" value="<?php echo esc_attr( $reddit ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vine' ) ); ?>"><?php esc_html_e( 'Vine URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vine' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vine' ) ); ?>" value="<?php echo esc_attr( $vine ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'digg' ) ); ?>"><?php esc_html_e( 'Digg URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'digg' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'digg' ) ); ?>" value="<?php echo esc_attr( $digg ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>"><?php esc_html_e( 'VK URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vk' ) ); ?>" value="<?php echo esc_attr( $vk ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>"><?php esc_html_e( 'RSS URL:', 'canos' ) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rss' ) ); ?>" value="<?php echo esc_attr( $rss ); ?>">
		</p>
	
	<?php
	}

}

add_action( 'widgets_init', 'canos_social_widget' );

function canos_social_widget() {
	register_widget( 'Canos_Widget_Social' );
}
