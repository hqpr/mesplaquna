<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package perfect-magazine
 */

get_header(); ?>
<section class="error-404 not-found">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-content">
                    <h3>
                        <?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'perfect-magazine'); ?>
                    </h3>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
