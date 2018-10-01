<?php
/**
 * The template for displaying all single posts.
 *
 * @package Canos
 */

get_header(); ?>

<div class="wrap">

	<header class="page-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .page-header -->

	<?php echo canos_breadcrumbs(); ?>

</div><!-- .wrap -->

<div id="content" class="site-content wrap">

	<div id="primary" class="content-area">
		<main id="main" class="site-main single-page" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php
			/**
			 * Related posts plugins can hook into here.
			 *
			 */
			do_action( 'canos_post_related_hook' ); ?>

			<?php
				// Check if the post navigation is enabled
				if ( ! get_theme_mod( 'canos_opt_single_post_hide_post_nav' ) ) {
					canos_post_nav();
				} 
			?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php /* Don't display the sidebar if the option is not selected */ ?>
<?php
if ( ! ( get_theme_mod( 'canos_opt_single_post_layout' ) == 'no-sidebar' ) ) {
	get_sidebar();
}
?>

<?php get_footer(); ?>
