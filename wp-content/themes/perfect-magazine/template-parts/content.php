<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package perfect-magazine
 */
global $perfect_magazine_index_var;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (!is_single()) {
        $pm_image_class = '';
    if ((perfect_magazine_get_option( 'global_layout' ) != 'no-sidebar')|| is_home()){
        if ($perfect_magazine_index_var % 2 == 0) {
            $pm_image_class = 'row-rtl';
        } else {
            $pm_image_class = '';
        }
    } else {
        $perfect_magazine_index_position = '';
        if ($perfect_magazine_index_var % 2 == 0) {
            $perfect_magazine_index_position = $perfect_magazine_index_var / 2;
            if ($perfect_magazine_index_position % 2 == 0) {
                $pm_image_class = 'row-rtl';
            } else {
                $pm_image_class = '';
            }
        } else {
            $perfect_magazine_index_position = (($perfect_magazine_index_var + 1) / 2);
            if ($perfect_magazine_index_position % 2 == 0) {
                $pm_image_class = 'row-rtl';
            } else {
                $pm_image_class = '';
            }
        }
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
        <?php } else { ?>

        <div class="entry-content">
            <?php
            $image_values = get_post_meta($post->ID, 'perfect-magazine-meta-image-layout', true);
            if (empty($image_values)) {
                $values = esc_attr(perfect_magazine_get_option('single_post_image_layout'));
            } else {
                $values = esc_attr($image_values);
            }
            if ('no-image' != $values) {
                if ('left' == $values) {
                    echo "<div class='image-left'>";
                    the_post_thumbnail('medium');
                } elseif ('right' == $values) {
                    echo "<div class='image-right'>";
                    the_post_thumbnail('medium');
                } else {
                    echo "<div class='image-full'>";
                    the_post_thumbnail('full');
                }
                echo "</div>";/*div end */
            }

            $raw_content = get_the_content();
            $final_content = apply_filters('the_content', $raw_content);

            /*Get first word of content*/
            $first_word = substr($raw_content, 0, 1);
            /*only allow alphabets*/
            if (preg_match("/[A-Za-z]+/", $first_word) != TRUE) {
            $first_word = '';
            }

            echo '<div class="entry-content" data-initials="' . esc_attr($first_word) . '">';
            ?>
            <?php the_content(); ?>
            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'perfect-magazine'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->

    <?php } ?>
    <?php if (is_single()) { ?>
    <footer class="entry-footer">
        <div class="mb--footer-tags">
            <?php perfect_magazine_entry_tags(); ?>
        </div>
        <div class="mb-footer-categories">
            <?php perfect_magazine_entry_footer(); ?>
        </div>
    </footer><!-- .entry-footer -->
    <?php }  $perfect_magazine_index_var++; ?>
</article><!-- #post-## -->
