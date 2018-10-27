<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

get_header(); ?>
<div id="page-header" class="relative page-section">
    <div class="wrapper">
        <article class="no-post-thumbnail">
            <div class="entry-container">
                <header class="entry-header">
                    <h2 class="page-title"><?php esc_html_e( 'Oops! That page can\'t be found.', 'lekhak' ); ?></h2>
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
            <div class="single-wrapper">
            	<div class="entry-container">
					<section class="error-404 not-found">
						<header class="page-header">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/uploads/404.png' ); ?>" alt="<?php esc_attr_e( '404', 'lekhak' ); ?>">
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'lekhak' ); ?></p>
							<div class="widget">
								<?php get_search_form(); ?>
							</div>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
get_footer();
