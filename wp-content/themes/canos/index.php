<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Canos
 */

get_header(); ?>

<div class="wrap">

	<?php canos_home_slider(); ?>

	<?php echo canos_breadcrumbs(); ?>

</div><!-- .wrap -->

<div id="content" class="site-content wrap">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<div class="post-modules">

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php if ( ( get_theme_mod( 'canos_opt_blog_layout' ) == 'no-sidebar grid-modules' ) || ( get_theme_mod( 'canos_opt_blog_layout' ) == 'right-sidebar grid-modules' ) || ( get_theme_mod( 'canos_opt_blog_layout' ) == 'left-sidebar grid-modules' ) ) : ?>

					<?php
						/* If you want to override this in a child theme, then include a file
						 * called content-grid.php and that will be used instead.
						 */
						get_template_part( 'content', 'grid' );
					?>

				<?php else : ?>

					<?php
						/* If you want to override this in a child theme, then include a file
						 * called content.php and that will be used instead.
						 */
						get_template_part( 'content' );
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
if ( ! ( get_theme_mod( 'canos_opt_blog_layout' ) == 'no-sidebar full-modules' ) && ! ( get_theme_mod( 'canos_opt_blog_layout' ) == 'no-sidebar grid-modules' ) ) {
	get_sidebar();
}
?>

<?php get_footer(); ?>
