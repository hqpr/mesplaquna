<?php
/**
 * The template for displaying home page.
 * @package perfect-magazine
 */

get_header();
if ('posts' == get_option('show_on_front')) {
    include(get_home_template());
} else {

    /**
     * perfect_magazine_action_sidebar_section hook
     * @since Perfect Magazine 0.0.1
     *
     * @hooked perfect_magazine_action_sidebar_section -  20
     * @sub_hooked perfect_magazine_action_sidebar_section -  20
     */
    do_action('perfect_magazine_action_sidebar_section');

    if (perfect_magazine_get_option('home_page_content_status') == 1) {
        ?>
        <div class="feature-block recent-blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <?php
                        while (have_posts()) : the_post();
                            the_title('<h2 class="section-title"> <span class="secondary-bgcolor">', '</span></h2>');
                            get_template_part('template-parts/content', 'page');

                        endwhile; // End of the loop.
                        ?>
                    </div><!-- #primary -->
                        <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    <?php }
}
get_footer();