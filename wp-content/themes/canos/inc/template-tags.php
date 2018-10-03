<?php
/**
 * Custom template tags for this theme.
 *
 *
 * @package Canos
 */

if ( ! function_exists( 'canos_social_header' ) ) :
	/**
	 * Display social accounts header.
	 */
	function canos_social_header() {
		$target = ( get_theme_mod( 'canos_opt_check_social_target' ) ? 'target="_blank"' : '' );
		?>

		<a href="#" id="site-follow-toggle"><i class="fa fa-plus"></i><?php esc_html_e( 'Follow', 'canos' ); ?></a>

		<ul id="site-follow">
			<?php if ( get_theme_mod( 'canos_opt_facebook' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_facebook' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Facebook"><i class="fa fa-facebook"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_twitter' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_twitter' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Twitter"><i class="fa fa-twitter"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_dribbble' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_dribbble' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Dribbble"><i class="fa fa-dribbble"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_linkedin' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_linkedin' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_flickr' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_flickr' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Flickr"><i class="fa fa-flickr"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_tumblr' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_tumblr' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Tumblr"><i class="fa fa-tumblr"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_vimeo' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_vimeo' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Vimeo"><i class="fa fa-vimeo-square"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_youtube' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_youtube' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Youtube"><i class="fa fa-youtube"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_instagram' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_instagram' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Instagram"><i class="fa fa-instagram"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_google' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_google' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_foursquare' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_foursquare' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Foursquare"><i class="fa fa-foursquare"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_github' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_github' ) ); ?>" <?php echo esc_attr( $target ); ?> title="GitHub"><i class="fa fa-github"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_pinterest' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_pinterest' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_stackoverflow' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_stackoverflow' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Stack Overflow"><i class="fa fa-stack-overflow"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_deviantart' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_deviantart' ) ); ?>" <?php echo esc_attr( $target ); ?> title="DeviantART"><i class="fa fa-deviantart"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_behance' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_behance' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Behance"><i class="fa fa-behance"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_delicious' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_delicious' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Delicious"><i class="fa fa-delicious"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_soundcloud' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_soundcloud' ) ); ?>" <?php echo esc_attr( $target ); ?> title="SoundCloud"><i class="fa fa-soundcloud"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_spotify' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_spotify' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Spotify"><i class="fa fa-spotify"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_stumbleupon' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_stumbleupon' ) ); ?>" <?php echo esc_attr( $target ); ?> title="StumbleUpon"><i class="fa fa-stumbleupon"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_reddit' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_reddit' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Reddit"><i class="fa fa-reddit"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_vine' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_vine' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Vine"><i class="fa fa-vine"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_digg' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_digg' ) ); ?>" <?php echo esc_attr( $target ); ?> title="Digg"><i class="fa fa-digg"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_vk' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_vk' ) ); ?>" <?php echo esc_attr( $target ); ?> title="VK"><i class="fa fa-vk"></i></a></li>
			<?php endif; ?>
			<?php if ( get_theme_mod( 'canos_opt_rss' ) ) : ?>
				<li><a href="<?php echo esc_url( get_theme_mod( 'canos_opt_rss' ) ); ?>" <?php echo esc_attr( $target ); ?> title="RSS"><i class="fa fa-rss"></i></a></li>
			<?php endif; ?>
		</ul>

		<?php
	}
endif;


if ( ! function_exists( 'canos_paging_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function canos_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'canos' ); ?></h1>
			<div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'canos' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'canos' ) ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;


if ( ! function_exists( 'canos_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function canos_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'canos' ); ?></h3>
			<div class="nav-links">
				<?php
					previous_post_link( '<div class="nav-previous nav-post">%link</div>', '<span class="meta-nav">' . esc_html__( 'Histoire précédente', 'canos' ) . '</span>' );
					next_post_link( '<div class="nav-next nav-post">%link</div>', '<span class="meta-nav">' . esc_html__( 'Histoire suivante', 'canos' ) . '</span>' );
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;


if ( ! function_exists( 'canos_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index
	 * views, or a div element when on single views.
	 *
	 */
	function canos_post_thumbnail( $size, $single = false ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size );

		if ( is_singular() || $single ) : ?>

			<div class="post-thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				<?php the_post_thumbnail( $size ); ?>
				<meta itemprop="url" content="<?php echo esc_url( $image_data[ 0 ] ); ?>">
				<meta itemprop="width" content="<?php echo esc_attr( $image_data[ 1 ] ); ?>">
				<meta itemprop="height" content="<?php echo esc_attr( $image_data[ 2 ] ); ?>">
			</div>

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				<?php the_post_thumbnail( $size ); ?>
				<meta itemprop="url" content="<?php echo esc_url( $image_data[ 0 ] ); ?>">
				<meta itemprop="width" content="<?php echo esc_attr( $image_data[ 1 ] ); ?>">
				<meta itemprop="height" content="<?php echo esc_attr( $image_data[ 2 ] ); ?>">
			</a>

		<?php endif; // End is_singular()
	}
endif;


if ( ! function_exists( 'canos_post_date' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function canos_post_date( $hidden = false ) {
		$time_string = '<time class="entry-date published" itemprop="datePublished" datetime="%1$s">%2$s</time><time class="updated semantic" itemprop="dateModified" datetime="%3$s">%4$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		$visibility = ( $hidden ) ? 'semantic' : '';

		echo '<span class="posted-on ' . esc_attr( $visibility ) . '">' . $posted_on . '</span>';

	}
endif;


if ( ! function_exists( 'canos_widget_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail in widgets.
	 */
	function canos_widget_post_thumbnail( $size, $show ) {
		if ( post_password_required() || ! has_post_thumbnail() ) {
			return;
		}

		$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size );
		?>

		<a class="post-thumbnail <?php echo ! $show ? 'semantic' : ''; ?>" href="<?php the_permalink(); ?>" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
			<?php the_post_thumbnail( $size ); ?>
			<meta itemprop="url" content="<?php echo esc_url( $image_data[ 0 ] ); ?>">
		    <meta itemprop="width" content="<?php echo esc_attr( $image_data[ 1 ] ); ?>">
		    <meta itemprop="height" content="<?php echo esc_attr( $image_data[ 2 ] ); ?>">
		</a>

		<?php
	}
endif;


if ( ! function_exists( 'canos_post_author' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function canos_post_author( $hidden = false ) {
		$author = sprintf(
			_x( 'Écrit par %s', 'post author', 'canos' ),
			'<span class="author vcard" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><a itemprop="url" rel="author" class="url fn" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><span class="nickname" itemprop="name">' . esc_html( get_the_author() ) . '</span></a></span>'
		);

		$visibility = ( $hidden ) ? 'semantic' : '';

		$meta = '<div class="semantic" itemprop="publisher" itemscope itemtype="https://schema.org/Organization"><div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject"><img src="' . esc_url( get_theme_mod( 'canos_opt_logo' ) ) . '"><meta itemprop="url" content="' . esc_url( get_theme_mod( 'canos_opt_logo' ) ) . '"></div><meta itemprop="name" content="' . esc_html( get_bloginfo( 'name' ) ) . '"></div><meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="' . esc_url( get_permalink() ) . '">';

		echo '<span class="byline ' . esc_attr( $visibility ) . '"> ' . $author . '</span>' . $meta;

	}
endif;


if ( ! function_exists( 'canos_post_author_bio' ) ) :
	/**
	 * Prints author bio section.
	 */
	function canos_post_author_bio( $name = false ) {
		?>

		<div id="author-bio">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'email' ), $size = '80' ); ?>
			</div>

			<div class="author-information">

				<?php if ( ! $name ) : ?>
					<span class="author-name">
						<?php printf( '<a href="%1$s">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) ); ?>
					</span>
				<?php endif; ?>

				<p class="author-info"><?php the_author_meta( 'description' ); ?></p>
			</div>
		</div>

		<?php

	}
endif;


if ( ! function_exists( 'canos_post_related' ) ) :
	/**
	 * Prints related posts section.
	 */
	function canos_post_related() {
		if ( ! get_theme_mod( 'canos_opt_single_post_hide_related' ) ) {

			global $post;

			$args = array(
				'post__not_in' => array( $post->ID ),
				'posts_per_page' => 4,
				'orderby' => 'rand'
			);

			/**
			 * Display posts with the same category.
			 */

			$cats_array = array();

			// Get categories
			$cat_ids = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
			foreach ( $cat_ids as $cat ) {
				$cats_array[] = $cat;
			}

			$cats_array  = array_map( 'absint', $cats_array );

			$args[ 'category__in' ] = $cats_array;

			/*----------------------------------------------------------------*/

			/**
			 * Comment out this code to display posts with the same category and tag
			 */

			// $tags_array = array();

			// // Get tags
			// $tag_ids = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
			// foreach ( $tag_ids as $tag ) {
			// 	$tags_array[] = $tag;
			// }

			// $tags_array  = array_map( 'absint', $tags_array );

			// $args[ 'tag__in' ] = $tags_array;

			/*----------------------------------------------------------------*/

			$related_query = new WP_Query( $args );

			if ( $related_query->have_posts() ) : ?>

				<aside id="related-posts">

					<h3><?php esc_html_e( 'Articles Similaires', 'canos' ); ?></h3>

					<div class="related-posts">

						<?php while ( $related_query->have_posts() ) : $related_query->the_post();?>

							<article <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
								<?php the_title( sprintf( '<h4 itemprop="headline" class="entry-title"><a itemprop="url" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>

								<?php
								canos_post_date( false );
								canos_post_author( false );
								canos_post_thumbnail('thumbnail');
								?>

								<div class="entry-summary" itemprop="text">
									<?php the_excerpt(); ?>
								</div><!-- .entry-summary -->
								<meta itemprop="interactionCount" content="UserComments:<?php echo esc_attr( get_comments_number() ); ?>">
							</article>

						<?php
						endwhile;
						wp_reset_postdata(); ?>

					</div>

				</aside>

			<?php
			endif;

		}
	}
	add_action( 'canos_post_related_hook', 'canos_post_related' );
endif;


if ( ! function_exists( 'canos_entry_cats' ) ) :
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function canos_entry_cats() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			$categories_list = '';
			$terms = get_the_category();
			if ( $terms && canos_categorized_blog() ) : ?>
				<div class="entry-cats">
					<?php
					foreach( $terms as $term_cat ) {
						$categories_list .= '<a href="' . esc_url( get_category_link( $term_cat->term_id ) ) . '" class="canos_cat" rel="category tag">' . esc_html( $term_cat->name ) . '</a>';
					}
					echo $categories_list;
				?>
				</div><!-- .entry-cats -->
			<?php endif;
		}
	}
endif;


if ( ! function_exists( 'canos_entry_cats_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories (used on the post meta area).
	 */
	function canos_entry_cats_meta() {
		$categories_list = '';
		$terms = get_the_category();
		if ( $terms && canos_categorized_blog() ) : ?>
			<div class="entry-cats">
				<span><?php esc_html_e( 'Category:', 'canos' ); ?></span>
				<?php
				foreach( $terms as $term_cat ) {
					$categories_list .= '<a href="' . esc_url( get_category_link( $term_cat->term_id ) ) . '" class="canos_cat" rel="category tag">' . esc_html( $term_cat->name ) . '</a>';
				}
				echo $categories_list;
			?>
			</div><!-- .entry-cats -->
		<?php endif;
	}
endif;


if ( ! function_exists( 'canos_post_comments_count' ) ) :
	/**
	 * Prints HTML with meta information for the comments.
	 */
	function canos_post_comments_count() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Laissez un commentaire', 'canos' ), esc_html__( '1 Commentaire', 'canos' ), esc_html__( '% Commentaires', 'canos' ) );
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'canos_post_comments_badge' ) ) :
	/**
	 * Prints HTML with meta information for the comments (used on the post meta area).
	 */
	function canos_post_comments_count_badge() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-badge">';
			comments_popup_link( '0', '1', '%' );
			echo '</span>';
		}
	}
endif;


if ( ! function_exists( 'canos_entry_tags' ) ) :
/**
 * Prints HTML with meta information for tags.
 */
function canos_entry_tags() {

	// Hide tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'canos' ) );
		if ( $tags_list ) {
			echo '<div class="tags-links">';
			echo '<span class="tags-links">' . esc_html__( 'Marqué avec:', 'canos' ) . '</span>';
			echo $tags_list;
			echo '</div>';
		}
	}
}
endif;


if ( ! function_exists( 'canos_more_link_filter' ) ) :
	/**
	 * Filter more link.
	 *
	 */
	function canos_more_link_filter( $link ) {
		return '<p class="more-link-wrap">' . $link . '</p>';
	}
endif;
add_filter( 'the_content_more_link', 'canos_more_link_filter' );


if ( ! function_exists( 'canos_the_archive_title_filter' ) ) :
	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 */
	function canos_the_archive_title_filter() {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_year() ) {
			$title = get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'canos' ) );
		} elseif ( is_month() ) {
			$title = get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'canos' ) );
		} elseif ( is_day() ) {
			$title = get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'canos' ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = esc_html_x( 'Asides', 'post format archive title', 'canos' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery', 'canos' ) ) {
				$title = esc_html_x( 'Galleries', 'post format archive title', 'canos' );
			} elseif ( is_tax( 'post_format', 'post-format-image', 'canos' ) ) {
				$title = esc_html_x( 'Images', 'post format archive title', 'canos' );
			} elseif ( is_tax( 'post_format', 'post-format-video', 'canos' ) ) {
				$title = esc_html_x( 'Videos', 'post format archive title', 'canos' );
			} elseif ( is_tax( 'post_format', 'post-format-quote', 'canos' ) ) {
				$title = esc_html_x( 'Quotes', 'post format archive title', 'canos' );
			} elseif ( is_tax( 'post_format', 'post-format-link', 'canos' ) ) {
				$title = esc_html_x( 'Links', 'post format archive title', 'canos' );
			} elseif ( is_tax( 'post_format', 'post-format-status', 'canos' ) ) {
				$title = esc_html_x( 'Statuses', 'post format archive title', 'canos' );
			} elseif ( is_tax( 'post_format', 'post-format-audio', 'canos' ) ) {
				$title = esc_html_x( 'Audio', 'post format archive title', 'canos' );
			} elseif ( is_tax( 'post_format', 'post-format-chat', 'canos' ) ) {
				$title = esc_html_x( 'Chats', 'post format archive title', 'canos' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( esc_html__( 'Archives: %s', 'canos' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( esc_html__( '%1$s: %2$s', 'canos' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = esc_html__( 'Archives', 'canos' );
		}

		return $title;

	}
endif;
add_filter( 'get_the_archive_title', 'canos_the_archive_title_filter' );


if ( ! function_exists( 'canos_get_category_parents' ) ) :
	/**
	 * Retrieve category parents with separator. A custom version of the original
	 * get_category_parents() core WordPress function, with microdata
	 */
	function canos_get_category_parents( $id, $link = false, $separator = '/', $nicename = false, $visited = array() ) {
		$chain = '';
		$parent = get_term( $id, 'category' );
		if ( is_wp_error( $parent ) )
			return $parent;

		if ( $nicename )
			$name = $parent->slug;
		else
			$name = $parent->name;

		if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
			$visited[] = $parent->parent;
			$chain .= canos_get_category_parents( $parent->parent, $link, $separator, $nicename, $visited );
		}

		if ( $link )
			$chain .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="' . esc_url( get_category_link( $parent->term_id ) ) . '"><span itemprop="title">' . $name . '</span></a></li>' . $separator;
		else
			$chain .= $name.$separator;
		return $chain;
	}
endif;


if ( ! function_exists( 'canos_breadcrumbs' ) ) :
	/**
	 * Display the breadcrumbs section.
	 */
	function canos_breadcrumbs() {
		if ( get_theme_mod( 'canos_opt_hide_breadcrumbs' ) ) {
			return false;
		}
		$home = apply_filters( 'canos_breadcrumbs_home_filter', esc_html__( 'Home', 'canos' ) );
		$homeLink = site_url();
		$blog = apply_filters( 'canos_breadcrumbs_blog_filter', esc_html__( 'Blog', 'canos' ) );
		$before_container = '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">';
		$after_container = '</li>';
		$before = '<span itemprop="title">';
		$after = '</span>';
		global $post;

		$crumbs = '';

		if ( ( get_option( 'show_on_front' ) === 'page' && is_front_page() ) || ( get_option( 'show_on_front' ) === 'posts' && is_home() ) ) {
			// do nothing (breacrumbs are not displayed)
		} elseif ( get_option( 'show_on_front' ) == 'page' && is_home() ) {
			$blog_link = get_permalink( get_option( 'page_for_posts' ) );
			$crumbs = '<ul class="crumbs">';
			$crumbs .= $before_container . '<a href="' . esc_url( $homeLink ) . '" itemprop="url">' . $before . $home . $after . '</a>' . $after_container;
			$crumbs .= $before_container . '<a href="' . esc_url( $blog_link ) . '" itemprop="url">' . $before . $blog . $after . '</a>' . $after_container;
			$crumbs .= '</ul>';
		} else {
			$crumbs = '<ul class="crumbs">';
			$crumbs .= $before_container . '<a href="' . esc_url( $homeLink ) . '" itemprop="url">' . $before . $home . $after . '</a>' . $after_container;
			if ( is_category() ) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category( $thisCat );
				$parentCat = get_category( $thisCat->parent );
				if ( $thisCat->parent != 0 ) {
					$crumbs .= canos_get_category_parents( $parentCat, TRUE, '' );
				}
				$crumbs .= $before_container . '<a href="' . esc_url( get_category_link( $thisCat ) ) . '" itemprop="url">' . $before . single_cat_title( '', false ) . $after . '</a>' . $after_container;
			} elseif ( is_tag() || is_tax() ) {
				$thisTerm = get_queried_object();
				$crumbs .= $before_container . '<a href="' . esc_url( get_term_link( $thisTerm, $thisTerm->taxonomy ) ) . '" itemprop="url">' . $before . single_tag_title( '', false ) . $after . '</a>' . $after_container;
			} elseif ( is_author() ) {
				$crumbs .= $before_container . '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="url">' . $before . sprintf( esc_html__( 'Posts by %1$s', 'canos' ), get_the_author() ) . $after . '</a>' . $after_container;
			} elseif ( is_year() ) {
				$crumbs .= $before_container . '<a href="' . esc_url( get_year_link( get_query_var( 'year' ) ) ) . '" itemprop="url">' . $before . get_the_date( _x( 'Y', 'yearly archives date format', 'canos' ) ) . $after . '</a>' . $after_container;
			} elseif ( is_month() ) {
				$crumbs .= $before_container . '<a href="' . esc_url( get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) ) ) . '" itemprop="url">' . $before . get_the_date( _x( 'F Y', 'monthly archives date format', 'canos' ) ) . $after . '</a>' . $after_container;
			} elseif ( is_day() ) {
				$crumbs .= $before_container . '<a href="' . esc_url( get_day_link( get_query_var( 'year' ), get_query_var( 'monthnum' ), get_query_var( 'day' ) ) ) . '" itemprop="url">' . $before . get_the_date( _x( 'F j, Y', 'daily archives date format', 'canos' ) ) . $after . '</a>' . $after_container;
			} elseif ( is_single() && ! is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$crumbs .= $before_container . '<a href="' . get_the_permalink() . '" itemprop="url">' . $before . get_the_title() . $after . '</a>' . $after_container;
				} else {
					$cat = get_the_category();
					$cat = $cat[ 0 ];
					$crumbs .= canos_get_category_parents( $cat, TRUE, '' );
					$crumbs .= $before_container . '<a href="' . get_the_permalink() . '" itemprop="url">' . $before . get_the_title() . $after . '</a>' . $after_container;
				}
			} elseif ( is_attachment() ) {
				$crumbs .= $before_container . '<a href="' . get_attachment_link( get_the_ID() ) . '" itemprop="url">' . $before . get_the_title() . $after . '</a>' . $after_container;
			} elseif ( is_page() && ! $post->post_parent ) {
				$crumbs .= $before_container . '<a href="' . get_the_permalink() . '" itemprop="url">' . $before . get_the_title() . $after . '</a>' . $after_container;
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$chain = array();
				while ( $parent_id ) {
					$page = get_page( $parent_id );
					$chain[] = $before_container . '<a href="' . get_permalink( $page->ID ) . '" itemprop="url">' . $before . get_the_title( $page->ID ) . $after . '</a>' . $after_container;
					$parent_id = $page->post_parent;
				}
				$chain = array_reverse( $chain );
				foreach ( $chain as $ch ) {
					$crumbs .= $ch;
				}
				$crumbs .= $before_container . '<a href="' . get_the_permalink() . '" itemprop="url">' . $before . get_the_title() . $after . '</a>' . $after_container;
			} elseif ( is_404() ) {
				// do nothing (breacrumbs are not displayed)
			} elseif ( is_search() ) {
				$crumbs .= $before_container . '<a href="' . get_search_link() . '" itemprop="url">' . $before . sprintf( esc_html__( 'Search for "%s"', 'canos' ), esc_html( get_search_query() ) ) . $after . '</a>' . $after_container;
			}
			if ( get_query_var( 'paged' ) ) {
				$crumbs .= '<li>' . sprintf( esc_html__( '(Page %s)', 'canos' ), get_query_var( 'paged' ) ) . '</li>';
			}

			$crumbs .= '</ul>';

		}

		return $crumbs;

	}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function canos_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'canos_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'canos_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so canos_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so canos_categorized_blog should return false.
		return false;
	}
}


/**
 * Flush out the transients used in canos_categorized_blog.
 */
function canos_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'canos_categories' );
}
add_action( 'edit_category', 'canos_category_transient_flusher' );
add_action( 'save_post',     'canos_category_transient_flusher' );
