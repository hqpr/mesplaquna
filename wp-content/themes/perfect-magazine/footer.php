<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package perfect-magazine
 */

?>
</div><!-- #content -->
<?php
if (is_front_page()) {
    // Default homepage
    do_action('perfect_magazine_action_trending_slider');
} ?>
<footer id="colophon" class="site-footer" role="contentinfo">
    <?php $perfect_magazine_footer_widgets_number = perfect_magazine_get_option('number_of_footer_widget');
    if (1 == $perfect_magazine_footer_widgets_number) {
        $col = 'col-md-12';
    } elseif (2 == $perfect_magazine_footer_widgets_number) {
        $col = 'col-md-6';
    } elseif (3 == $perfect_magazine_footer_widgets_number) {
        $col = 'col-md-4';
    } elseif (4 == $perfect_magazine_footer_widgets_number) {
        $col = 'col-md-3';
    } else {
        $col = 'col-md-3';
    }
    if (is_active_sidebar('footer-col-one') || is_active_sidebar('footer-col-two') || is_active_sidebar('footer-col-three') || is_active_sidebar('footer-col-four')) { ?>
        <section class="wrapper block-section footer-widget">
            <div class="container">
                <div class="row">
                    <?php if (is_active_sidebar('footer-col-one') && $perfect_magazine_footer_widgets_number > 0) : ?>
                        <div class="contact-list <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-one'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-two') && $perfect_magazine_footer_widgets_number > 1) : ?>
                        <div class="contact-list <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-two'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-three') && $perfect_magazine_footer_widgets_number > 2) : ?>
                        <div class="contact-list <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-three'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-four') && $perfect_magazine_footer_widgets_number > 3) : ?>
                        <div class="contact-list <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-four'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php } ?>

    <div class="footer-bottom">
        <div class="container">
            <div class="row row-table">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="tm-social-share">
                        <?php if (perfect_magazine_get_option('social_icon_style') == 'circle') {
                            $perfect_magazine_social_icon = 'bordered-radius';
                        } else {
                            $perfect_magazine_social_icon = '';
                        } ?>
                        <div class="social-icons <?php echo esc_attr($perfect_magazine_social_icon); ?>">
                            <?php
                            wp_nav_menu(
                                array('theme_location' => 'social',
                                    'link_before' => '<span class="screen-reader-text">',
                                    'link_after' => '</span>',
                                    'menu_id' => 'social-menu',
                                    'fallback_cb' => false,
                                    'menu_class' => false
                                )); ?>

                            <span aria-hidden="true" class="stretchy-nav-bg secondary-bgcolor"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="footer-logo text-center">
                            <span class="site-title secondary-font">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                        <?php $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()) : ?>
                            <p class="site-description"><?php echo $description; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="site-copyright text-right">
                        <?php
                        $perfect_magazine_copyright_text = perfect_magazine_get_option('copyright_text');
                        if (!empty ($perfect_magazine_copyright_text)) {
                            echo wp_kses_post($perfect_magazine_copyright_text);
                        }
                        ?>
                        <br>
                        <?php printf(esc_html__('Theme: %1$s by %2$s', 'perfect-magazine'), 'Perfect Magazine', '<a href="https://thememattic.com" target = "_blank" rel="designer">Themematic </a>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div><!-- #page -->
<a id="scroll-up" class="secondary-bgcolor"><i class="ion-ios-arrow-up"></i></a>
<?php wp_footer(); ?>

</body>
</html>