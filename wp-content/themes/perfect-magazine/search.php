<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package perfect-magazine
 */

get_header();
$perfect_magazine_index_var = 1;
?>

    <section class="search-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                <?php
                if (have_posts()) : ?>

                    <?php
                    $perfect_magazine_index_var = 1;
                    /* Start the Loop */
                    while (have_posts()) : the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part('template-parts/content', 'search');

                    endwhile;

                    /**
                     * Hook - perfect_magazine_action_posts_navigation.
                     *
                     * @hooked: perfect_magazine_custom_posts_navigation - 10
                     */
                    do_action('perfect_magazine_action_posts_navigation');

                else :

                    get_template_part('template-parts/content', 'none');

                endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
