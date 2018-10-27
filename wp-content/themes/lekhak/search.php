<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
                    <h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'lekhak' ), get_search_query() ); ?></h2>
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
