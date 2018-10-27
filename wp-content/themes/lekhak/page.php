<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

get_header(); 
if ( true === apply_filters( 'lekhak_filter_frontpage_content_enable', true ) ) : 
	while ( have_posts() ) : the_post(); ?>
		<div id="page-header" class="relative page-section">
	        <div class="wrapper">
	            <article class="<?php echo has_post_thumbnail() ? 'has-post-thumbnail' : 'no-post-thumbnail'; ?>">
	                <?php if ( has_post_thumbnail() ) : ?>
		            	<div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');"></div>
		            <?php endif; ?>
	                <div class="entry-container">
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


	<div id="inner-content-wrapper" class="page-section no-padding-top clear">
		<div class="wrapper">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<div class="single-post-wrapper">
						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

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
			} ?>
		</div><!-- .wrapper -->
	</div><!-- .page-section -->
<?php endif;
get_footer();
