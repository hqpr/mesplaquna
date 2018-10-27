<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

get_header(); 

while ( have_posts() ) : the_post(); ?>
	<div id="page-header" class="relative page-section">
        <div class="wrapper">
            <article class="<?php echo has_post_thumbnail() ? 'has-post-thumbnail' : 'no-post-thumbnail'; ?>">
                <?php if ( has_post_thumbnail() ) : ?>
	            	<div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');"></div>
	            <?php endif; ?>
                <div class="entry-container">
                    <div class="entry-meta">
                        <?php lekhak_single_categories(); ?>
                    </div><!-- .entry-meta -->

                    <header class="entry-header">
                        <h2 class="page-title"><?php the_title(); ?></h2>
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
<?php endwhile;

/**
 * lekhak_inner_page_secondary_menu hook
 *
 * @hooked lekhak_content_start -  20
 *
 */
do_action( 'lekhak_inner_page_secondary_menu' ); ?>

 <div id="inner-content-wrapper" class="wrapper page-section">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="single-wrapper">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'single' );

					/**
					* Hook lekhak_action_post_pagination
					*  
					* @hooked lekhak_post_pagination 
					*/
					do_action( 'lekhak_action_post_pagination' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div><!-- .single-post-wrapper -->
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
