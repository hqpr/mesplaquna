<?php
/**
 * @package Canos
 */
?>

<article <?php post_class( 'post-module post-module-full' ); ?> itemscope="itemscope" itemtype="http://schema.org/Article">

	<?php /* Display video if the post format is a video */ ?>
	<?php if ( 'video' === get_post_format() ) : ?>

		<div class="post-thumbnail">
			<?php $canos_post_video = get_post_meta( $post->ID, 'canos_meta_format_video_embed', true );
			if ( wp_oembed_get( $canos_post_video ) ) :
				echo wp_oembed_get( $canos_post_video );
			else :
				echo wp_kses_post( $canos_post_video );
			endif; ?>
		</div>

	<?php /* Display audio if the post format is a audio */ ?>
	<?php elseif ( 'audio' === get_post_format() ) : ?>

		<div class="post-thumbnail">
			<?php $canos_post_audio = get_post_meta( $post->ID, 'canos_meta_format_audio_embed', true );
			if ( wp_oembed_get( $canos_post_audio ) ) :
				echo wp_oembed_get( $canos_post_audio );
			else :
				echo wp_kses_post( $canos_post_audio );
			endif; ?>
		</div>

	<?php /* Display gallery if the post format is a gallery */ ?>
	<?php elseif ( 'gallery' === get_post_format() ) : ?>

		<div class="post-thumbnail">
			<?php $canos_post_gallery_imgs = get_post_meta( $post->ID, 'canos_meta_format_gallery', true );
			if ( $canos_post_gallery_imgs ) {
				$canos_post_gallery_size = ( get_theme_mod( 'canos_opt_blog_layout' ) == 'no-sidebar full-modules' ) ? 'canos_1300x554' : 'canos_833x554';
				canos_post_gallery( $canos_post_gallery_imgs, $canos_post_gallery_size );
				canos_entry_cats();
			} ?>
		</div>

	<?php /* Display thumb only if enabled, according to the width of the content area */ ?>
	<?php elseif ( ! get_theme_mod( 'canos_opt_blog_post_thumbnail' ) ) :

		if ( has_post_thumbnail() ) :

			$canos_post_thumb_size = ( get_theme_mod( 'canos_opt_blog_layout' ) == 'no-sidebar full-modules' ) ? 'canos_1300x554' : 'canos_833x554';
			?>

			<div class="post-thumbnail-wrap">
				<?php
				canos_post_thumbnail( $canos_post_thumb_size );
				canos_entry_cats();
				?>
			</div>

		<?php endif; ?>

	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 itemprop="headline" class="entry-title"><a itemprop="url" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php
	$canos_date_vis_var = ( get_theme_mod( 'canos_opt_blog_post_date' ) ) ? true : false;
	$canos_author_vis_var = ( get_theme_mod( 'canos_opt_blog_post_author' ) ) ? true : false;
	canos_post_date( $canos_date_vis_var );
	canos_post_author( $canos_author_vis_var );
	?>

	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'canos' ) );
	}
	?>

	<?php /* Display excerpt only if enabled, default false */ ?>
	<?php if ( ( get_theme_mod( 'canos_opt_blog_post_excerpt' ) == 'excerpt' ) || ( get_theme_mod( 'canos_opt_blog_post_excerpt' ) == 'excerpt+more' ) ) : ?>

	<div class="entry-summary" itemprop="text">
		<?php the_excerpt(); ?>
		<?php if ( get_theme_mod( 'canos_opt_blog_post_excerpt' ) == 'excerpt+more' ) : ?>
			<p class="more-link-wrap"><a class="more-link" href="<?php echo the_permalink(); ?>"><?php printf(
				esc_html__( 'Continue reading %s', 'canos' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			); ?></a></p>
		<?php endif; ?>
	</div><!-- .entry-summary -->

	<?php else : ?>

	<div class="entry-content" itemprop="text">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				esc_html__( 'Continue reading %s', 'canos' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'canos' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php endif; ?>

	<footer class="entry-footer">
		<meta itemprop="interactionCount" content="UserComments:<?php echo esc_attr( get_comments_number() ); ?>">
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
