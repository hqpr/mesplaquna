<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Canos
 */

get_header(); ?>

<div class="wrap">

	<header class="page-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .page-header -->

	<?php if ( get_theme_mod( 'canos_opt_single_page_layout' ) == 'no-sidebar' ) {
		canos_post_thumbnail( 'canos_1300x554' );
		} else {
			canos_post_thumbnail( 'canos_833x554' );
		}
	?>

	<?php echo canos_breadcrumbs(); ?>

</div><!-- .wrap -->

<div id="content" class="site-content wrap">

	<div id="primary" class="content-area">
		<main id="main" class="site-main single-page" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php if ( get_theme_mod( 'canos_opt_single_page_show_comments' ) ) : ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php /* Don't display the sidebar if the option is not selected */ ?>
<?php
if ( ( get_theme_mod( 'canos_opt_single_page_layout' ) == 'left-sidebar' ) || ( get_theme_mod( 'canos_opt_single_page_layout' ) == 'right-sidebar' ) ) {
	get_sidebar();
}
?>

<?php get_footer(); ?>
