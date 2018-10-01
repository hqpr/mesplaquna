<?php
/**
 * The template for displaying author pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canos
 */

get_header(); ?>

<div class="wrap">

	<header class="page-header">
		<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
		?>
	</header><!-- .page-header -->

	<?php echo canos_breadcrumbs(); ?>

	<?php canos_post_author_bio( true ); ?>

</div><!-- .wrap -->

<div id="content" class="site-content wrap">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<div class="post-modules">

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php if ( ( get_theme_mod( 'canos_opt_archive_layout' ) == 'no-sidebar grid-modules' ) || ( get_theme_mod( 'canos_opt_archive_layout' ) == 'right-sidebar grid-modules' ) || ( get_theme_mod( 'canos_opt_archive_layout' ) == 'left-sidebar grid-modules' ) ) : ?>

					<?php
						/* If you want to override this in a child theme, then include a file
						 * called content-archive-grid.php and that will be used instead.
						 */
						get_template_part( 'content-archive', 'grid' );
					?>

				<?php else : ?>
					
					<?php
						/* If you want to override this in a child theme, then include a file
						 * called content-archive.php and that will be used instead.
						 */
						get_template_part( 'content-archive' );
					?>

				<?php endif; ?>

			<?php endwhile; ?>

			</div><!-- .post-modules -->

			<?php canos_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php /* Don't display the sidebar if the option is not selected */ ?>
<?php
if ( ! ( get_theme_mod( 'canos_opt_archive_layout' ) == 'no-sidebar full-modules' ) && ! ( get_theme_mod( 'canos_opt_archive_layout' ) == 'no-sidebar grid-modules' ) ) {
	get_sidebar();
}
?>
<?php get_footer(); ?>
