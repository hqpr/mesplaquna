<?php
/**
 * Custom functions that act independently of the theme templates
 *
 *
 * @package Canos
 */

if ( ! function_exists( 'canos_body_classes' ) ) :
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function canos_body_classes( $classes ) {

		$classes[] = '';

		if ( is_home() ) {
			$layout = 'right-sidebar full-modules';
			if ( get_theme_mod( 'canos_opt_blog_layout' ) ) {
				$layout = esc_attr( get_theme_mod( 'canos_opt_blog_layout' ) );
			}
			$classes[] = $layout;
		}

		if ( is_archive() || is_search() ) {
			$layout = 'right-sidebar full-modules';
			if ( get_theme_mod( 'canos_opt_archive_layout' ) ) {
				$layout = esc_attr( get_theme_mod( 'canos_opt_archive_layout' ) );
			}
			$classes[] = $layout;
		}

		if ( is_single() ) {
			$layout = 'right-sidebar';
			if ( get_theme_mod( 'canos_opt_single_post_layout' ) ) {
				$layout = esc_attr( get_theme_mod( 'canos_opt_single_post_layout' ) );
			}
			$classes[] = $layout;
		}

		if ( is_page() && ! is_front_page() ) {
			$layout = 'no-sidebar';
			if ( get_theme_mod( 'canos_opt_single_page_layout' ) ) {
				$layout = esc_attr( get_theme_mod( 'canos_opt_single_page_layout' ) );
			}
			$classes[] = esc_attr( $layout );
		}

		if ( is_404() ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}
	add_filter( 'body_class', 'canos_body_classes' );
endif;


if ( ! function_exists( 'canos_home_slider' ) ) :
/**
 * Display slider in homepage.
 */
function canos_home_slider() {

	if ( ( get_theme_mod( 'canos_opt_home_slider' ) ) && is_home() && ! is_paged() ) {

		$args = array(
			'ignore_sticky_posts' => true,
			'posts_per_page' => -1,
			'meta_key'   => 'canos_meta_home_slider',
			'meta_value' => 'yes'
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) : ?>

			<div id="homeslider" class="flexslider flex-home">

				<ul class="slides">

				<?php while ( $query->have_posts() ) : $query->the_post(); ?>

					<li><article <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/Article">

						<?php if ( ! post_password_required() && has_post_thumbnail() ) :
							$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'milkit_1330x590' );
							?>

							<a class="post-thumbnail" href="<?php the_permalink(); ?>" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
								<?php the_post_thumbnail( 'canos_620x413' ); ?>
								<meta itemprop="url" content="<?php echo esc_url( $image_data[ 0 ] ); ?>">
							    <meta itemprop="width" content="<?php echo esc_attr( $image_data[ 1 ] ); ?>">
							    <meta itemprop="height" content="<?php echo esc_attr( $image_data[ 2 ] ); ?>">
							</a>

						<?php endif; ?>

						<header class="entry-header">
							<?php the_title( sprintf( '<h2 itemprop="headline" class="entry-title"><a itemprop="url" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						</header><!-- .entry-header -->

						<div class="post-slider-content">

							<div class="entry-summary" itemprop="text">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->

							<?php canos_post_date( false ); ?>
							<?php canos_post_author( false ); ?>

							<meta itemprop="interactionCount" content="UserComments:<?php echo esc_attr( get_comments_number() ); ?>">

						</div><!-- .post-slider-content -->

					</article></li><!-- #post-## -->

				<?php
				endwhile;
				wp_reset_postdata(); ?>

				</ul>

			</div>

		<?php
		endif;

	}

}
endif;


if ( ! function_exists( 'canos_offset_main_query' ) ) :
	/**
	 * Modify the main loop in index.php to skip the posts used in the slider
	 */
	function canos_offset_main_query( &$query ) {
		/* Run only on the category page */
		if ( ! is_admin() && $query->is_home() && $query->is_main_query() ) {

			// Get original meta query
			$meta_query = $query->get('meta_query');

			$meta_query[ 'meta_query' ] = array(
				'relation' => 'OR',
				array(
					'key' => 'canos_meta_home_slider',
					'compare' => 'NOT EXISTS'
				),
				array(
					'key' => 'canos_meta_home_slider',
					'compare' => '!=',
					'value' => 'yes'
				)
			);

			$query->set('meta_query',$meta_query);
		}
	}
	add_action( 'pre_get_posts', 'canos_offset_main_query' );
endif;


if ( ! function_exists( 'canos_post_gallery' ) ) :
/**
 * Display post gallery.
 */
function canos_post_gallery( $ids, $size ) {
	?>

	<div class="flexslider flex-gallery">
		<span class="preloader"></span>

		<ul class="slides">

			<?php
			$images = explode( ',', $ids );

			foreach ( $images as $image ) :

				$attachment = get_post( intval( $image ) );
				$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
				$caption = $attachment->post_excerpt;
				$src = wp_get_attachment_image_src( $image, $size );
				?>

				<li>
					<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
						<img src="<?php echo esc_url( $src[ 0 ] ); ?>" itemprop="thumbnail" alt="<?php echo esc_attr( $alt ); ?>" width="<?php echo esc_attr( $src[ 1 ] ); ?>" height="<?php echo esc_attr( $src[ 2 ] ); ?>">
						<meta itemprop="copyrightHolder" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<meta itemprop="width" content="<?php echo esc_attr( $src[ 1 ] ); ?>">
						<meta itemprop="height" content="<?php echo esc_attr( $src[ 2 ] ); ?>">

						<figcaption itemprop="caption description">
							<?php echo esc_html( $caption ); ?>
						</figcaption>
					</figure>
				</li>

			<?php endforeach; ?>

		</ul>
	</div>
	<?php

}
endif;


if ( ! function_exists( 'canos_comment' ) ) :
	/**
	 * Custom callback for the comment item.
	 */
	function canos_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		if ( 'div' == $args[ 'style' ] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>

		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? 'parent' : '' ); ?> id="comment-<?php comment_ID(); ?>" itemscope="itemscope" itemtype="http://schema.org/Comment">
			<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<?php endif; ?>
			<span class="comment-author">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				<cite itemprop="author"><?php echo get_comment_author_link(); ?></cite>
			</span>

			<?php
			$time_string = '<time class="entry-date published" itemprop="datePublished" datetime="%1$s">%2$s</time>';

			$time_string = sprintf( $time_string,
				esc_attr( get_comment_date( 'c' ) ),
				esc_html( get_comment_date( 'M j, Y' ) )
			);
			?>

			<span class="comment-meta commentmetadata">
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>"><?php echo $time_string; ?></a>
				<?php edit_comment_link( esc_html__( '(Edit)', 'canos' ), '', '' ); ?>
			</span>

			<?php if ( '0' == $comment->comment_approved ) : ?>
			<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'canos' ) ?></em>
			<br />
			<?php endif; ?>

			<div class="comment-text" itemprop="text">
				<?php comment_text( get_comment_id(), array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>

			<?php
			comment_reply_link( array_merge( $args, array(
				'add_below' => $add_below,
				'depth'     => $depth,
				'max_depth' => $args['max_depth'],
				'before'    => '<div class="reply"><i class="fa fa-reply"></i>',
				'after'     => '</div>'
			) ) );
			?>

			<?php if ( 'div' != $args['style'] ) : ?>
			</div>
			<?php endif; ?>

		<?php
	}
endif;


if ( ! function_exists( 'canos_comment_form_fields' ) ) :
	/**
	 * Add placeholder to the comment form fields.
	 */
	function canos_comment_form_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields[ 'author' ] = '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Prénom', 'canos' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			            '<input id="author" name="author" type="text" placeholder="' . esc_html__( 'Prénom', 'canos' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" size="30"' . $aria_req . ' /></p>';

		$fields[ 'email' ] = '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'canos' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			            '<input id="email" name="email" type="email" placeholder="' . esc_html__( 'Email', 'canos' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr(  $commenter[ 'comment_author_email' ] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . ' /></p>';

		$fields[ 'url' ] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Votre site web', 'canos' ) . '</label> ' . '<input id="url" name="url" type="url" placeholder="' . esc_html__( 'Votre site web', 'canos' ) . '" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '" size="30" /></p>';

		return $fields;

	}
	add_filter( 'comment_form_default_fields', 'canos_comment_form_fields' );
endif;


if ( ! function_exists( '_wp_render_title_tag' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function canos_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'canos' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'canos_wp_title', 10, 2 );
endif;


if ( ! function_exists( '_wp_render_title_tag' ) ) :
	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function canos_render_title() {
		echo '<title>' . wp_title( '|', false, 'right' ) . "</title>\n";
	}
	add_action( 'wp_head', 'canos_render_title' );
endif;


if ( ! function_exists( 'canos_tag_cloud' ) ) :
	/**
	 * Change the font-size of the tag cloud widget.
	 */
	function canos_tag_cloud( $args ) {
		$args[ 'largest' ] = 11;
		$args[ 'smallest' ] = 11;
		$args[ 'unit' ] = 'px';
		return $args;
	}
	add_filter( 'widget_tag_cloud_args', 'canos_tag_cloud' );
endif;


/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function canos_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'canos_setup_author' );


// Before, check if a google font is selected (custom font empty)
if ( ! get_theme_mod( 'canos_opt_site_custom_font' ) ) {
	if ( ! function_exists( 'canos_google_web_fonts' ) ) :
		/**
		 * Register Google Web Fonts
		 */
		function canos_google_web_fonts() {
			$font = get_theme_mod( 'canos_opt_site_google_font', 'Open+Sans' );
			$protocol = is_ssl() ? 'https' : 'http';
			wp_enqueue_style( 'canos-google-font', $protocol . '://fonts.googleapis.com/css?family=' . $font . ':400,700,400italic,700italic' );
		}
		add_action( 'wp_enqueue_scripts', 'canos_google_web_fonts' );
	endif;
}
