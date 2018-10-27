<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package perfect-magazine
 */
global $perfect_magazine_index_var;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
        $pm_image_class = '';
                if ($perfect_magazine_index_var % 2 == 0) {
                    $pm_image_class = 'row-rtl';
                } else {
                    $pm_image_class = '';
                }
        ?>
        <div class="row-collapse row-table <?php echo esc_attr($pm_image_class); ?>">
            <?php if (has_post_thumbnail()) {
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'perfect-magazine-720-1020');
                $thumblarge = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                $url_large = $thumblarge['0'];
                $url = $thumb['0'];
            } else {
                $url = get_template_directory_uri() . '/assets/images/no-image-720x1020.jpg';
                $url_large = get_template_directory_uri() . '/assets/images/no-image-720x1020.jpg';
            } ?>
            <div class='tm-image-archive col-sm-6 zoom-gallery'>
                <a href="<?php echo esc_url($url_large); ?>" class="reveal-enable">
                    <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                </a>
            </div>
            <div class="col-sm-6 article-feature-content">
                <div class="article-content">
                    <div class="archive-category-class">
                        <?php perfect_magazine_posted_category_only(); ?>
                    </div>
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <footer class="entry-footer">
                        <?php perfect_magazine_posted_date_only(); ?>
                        <?php perfect_magazine_posted_author_only(); ?>
                    </footer>
                    <div class="archive-tags">
                        <?php perfect_magazine_entry_tags();?>
                    </div>
                </div>
            </div>
        </div>
    <?php $perfect_magazine_index_var++; ?>
</article><!-- #post-## -->
