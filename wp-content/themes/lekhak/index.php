<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

get_header(); 
?>

<div id="page-header" class="relative page-section">
    <div class="wrapper">
        <article class="no-post-thumbnail">
            <div class="entry-container">
                <header class="entry-header">
                    <?php  
			        $options = lekhak_get_theme_options();
					if ( lekhak_is_latest_posts() ) : 
						$title = ! empty( $options['your_latest_posts_title'] ) ? $options['your_latest_posts_title'] : esc_html_e( 'Blog', 'lekhak' ); ?>
						<h2 class="page-title"><?php echo esc_html( $title ); ?></h2>
					<?php elseif ( lekhak_is_blog_page() || is_singular() ): ?>
						<h2 class="page-title"><?php single_post_title(); ?></h2>
					<?php endif;?>
                </header>
                <?php  
		        /**
				 * lekhak_breadcrumb_action hook
				 *
				 * @hooked lekhak_add_breadcrumb -  10
				 *
				 */
				do_action( 'lekhak_breadcrumb_action' );
		        ?>
            </div><!-- .entry-container -->
        </article>
    </div><!-- .wrapper -->
</div><!-- #page-header -->

<?php 
/**
 * lekhak_inner_page_secondary_menu hook
 *
 * @hooked lekhak_content_start -  20
 *
 */
do_action( 'lekhak_inner_page_secondary_menu' ); 
?>

<div id="inner-content-wrapper" class="wrapper page-section">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="posts-wrapper archive-blog-wrapper clear">
				<?php
				if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
			</div>
			<?php  
			/**
			* Hook - lekhak_action_pagination.
			*
			* @hooked lekhak_pagination 
			*/
			do_action( 'lekhak_action_pagination' ); 
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php  
	if ( lekhak_is_sidebar_enable() ) {
		get_sidebar();
	}
	?>
</div><!-- .page-section -->

<?php
get_footer();
