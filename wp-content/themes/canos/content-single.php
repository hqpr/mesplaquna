<?php
/**
 * @package Canos
 */
?>

<?php
/* Check if the post view count is enabled */
if ( ! get_theme_mod( 'canos_opt_disable_views' ) ) {
	do_action( 'canos_update_post_views', get_the_ID() );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-page-post' ); ?> itemscope="itemscope" itemtype="http://schema.org/Article">

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
				$canos_post_gallery_size = ( get_theme_mod( 'canos_opt_single_post_layout' ) == 'no-sidebar' ) ? 'canos_1300x554' : 'canos_833x554';
				canos_post_gallery( $canos_post_gallery_imgs, $canos_post_gallery_size );
			} ?>
		</div>

	<?php /* Display thumb according to the width of the content area */ ?>
	<?php else :

		$canos_post_thumb_size = ( get_theme_mod( 'canos_opt_single_post_layout' ) == 'no-sidebar' ) ? 'canos_1300x554' : 'canos_833x554';
		canos_post_thumbnail( $canos_post_thumb_size );

	endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">',
				'after'  => '</div>',
				'next_or_number' => 'next'
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<meta itemprop="interactionCount" content="UserComments:<?php echo esc_attr( get_comments_number() ); ?>">
		<?php if ( ! get_theme_mod( 'canos_opt_hide_post_sharer' ) ) : ?>

		<?php
		/**
		 * Sharing plugins can hook into here. The default sharer included
		 * in the framework uses this action.
		 *
		 */
		do_action( 'canos_post_sharer' ); ?>

		<?php endif; ?>
	</footer><!-- .entry-footer -->

	<div id="post-meta">
		<?php the_title( '<h2 class="entry-title semantic" itemprop="headline">', '</h2>' ); ?>

		<?php
		// Check if the author bio is enabled
		if ( ! get_theme_mod( 'canos_opt_single_post_hide_author_bio' ) ) {
			canos_post_author_bio();
		}
		?>

		<?php canos_entry_cats_meta(); ?>
		<?php canos_entry_tags(); ?>
		<?php canos_post_comments_count_badge(); ?>
		<?php canos_post_date( true ); ?>
		<?php canos_post_author( true ); ?>

		<div class="views">
			<?php
			if ( ! get_theme_mod( 'canos_opt_disable_views' ) ) {
				do_action( 'canos_display_post_views', get_the_ID() );
			} ?>
		</div><!-- .views -->
	</div>
</article><!-- #post-## -->
