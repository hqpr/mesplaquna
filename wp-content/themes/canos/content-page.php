<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Canos
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-page-post' ); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
	<?php the_title( '<h2 class="entry-title semantic" itemprop="headline">', '</h2>' ); ?>

	<?php if ( get_theme_mod( 'canos_opt_single_page_layout' ) == 'no-sidebar' ) {
		canos_post_thumbnail( 'canos_1300x554' );
		} else {
			canos_post_thumbnail( 'canos_833x554' );
		}
	?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'canos' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		canos_post_date( true );
		canos_post_author( true );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
