<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package newsliner
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<?php
$body_class = '';
if (is_home() ) {
    $body_class = "blog-post";
} else {
    $body_class = "static-page";
} ?>
<body <?php body_class($body_class); ?>>

<?php if ((perfect_magazine_get_option('enable_preloader')) == 1) { ?>
    <div class="preloader">
        <div class="preloader-wrapper">
            <div class="loader-con">
                <div class="ball ball-1"><span class="main-color-bg"></span></div>
                <div class="ball ball-2"><span class="main-color-bg"></span></div>
                <div class="ball ball-3"><span class="main-color-bg"></span></div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- full-screen-layout/boxed-layout -->
<?php if (perfect_magazine_get_option('homepage_layout_option') == 'full-width') {
    $perfect_magazine_homepage_layout = 'full-screen-layout';
} elseif (perfect_magazine_get_option('homepage_layout_option') == 'boxed') {
    $perfect_magazine_homepage_layout = 'boxed-layout';
}
?>
<?php if (1 == perfect_magazine_get_option('single_page_first_text')) {
    $perfect_magazine_single_page_text = 'text-capitalized';
} else {
    $perfect_magazine_single_page_text = '';
} ?>

<div id="page" class="site <?php echo esc_attr($perfect_magazine_homepage_layout); ?> <?php echo esc_attr($perfect_magazine_single_page_text); ?>">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'newsliner'); ?></a>
    <header id="masthead" class="site-header" role="banner">

        <?php if (1 == perfect_magazine_get_option('show_ticker_section')) { ?>
            <div class="news-ticker">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="news-scroller">
                                <?php 
                                $perfect_magazine_ticker_category = absint(perfect_magazine_get_option('select_category_for_ticker'));
                                $perfect_magazine_banner_ticker_args = array(
                                    'post_type' => 'post',
                                    'cat' => absint($perfect_magazine_ticker_category),
                                    'ignore_sticky_posts' => true,
                                    'posts_per_page' => 8,
                                ); ?>
                                <?php
                                $perfect_magazine_banner_ticker_post_query = new WP_Query($perfect_magazine_banner_ticker_args);
                                if ($perfect_magazine_banner_ticker_post_query->have_posts()) :
                                    while ($perfect_magazine_banner_ticker_post_query->have_posts()) : $perfect_magazine_banner_ticker_post_query->the_post();
                                        if(has_post_thumbnail()){
                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
                                            $url = $thumb['0'];
                                        }
                                        global $post;
                                        $author_id = $post->post_author;
                                        ?>
                                            <div class="news-scroller-item">
                                                <div class="featured-wrapper">
                                                    <div class="featured-wrapper-child featured-img-wrapper">
                                                        <a href="<?php the_permalink(); ?>" class="bg-image ticker-bg-image">
                                                            <img src="<?php echo esc_url($url); ?>">
                                                        </a>
                                                    </div>
                                                    <header class="featured-wrapper-child entry-header">
                                                        <div class="entry-header">
                                                            <h3 class="entry-title">
                                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                        </div>
                                                        <div class="entry-footer">
                                                            <?php perfect_magazine_posted_date_only(); ?>
                                                        </div>
                                                    </header>
                                                </div>
                                            </div>
                                        <?php
                                        endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="top-bar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8 col-xs-12">
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
                    <div class="col-sm-4 col-xs-12 pull-right icon-search">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="site-branding">
                            <?php
                            if (is_front_page() && is_home()):?>
                                <span class="site-title secondary-font">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                            <?php else : ?>
                                <span class="site-title secondary-font">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                            <?php endif;
                            perfect_magazine_the_custom_logo();
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()):?>
                                <p class="site-description"><span><?php echo $description; ?></span></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navigation-area">
            <div class="container">
                <div class="row">
                    <nav class="main-navigation" role="navigation">
                            <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                                 <span class="screen-reader-text">
                                    <?php esc_html_e('Primary Menu', 'newsliner'); ?>
                                </span>
                                <i class="ham"></i>
                            </span>

                        <?php wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'container' => 'div',
                            'container_class' => 'menu',
                        )); ?>
                    </nav><!-- #site-navigation -->
                </div>
            </div>
        </div>
    </header>
    <!-- #masthead -->

    <?php
    if (is_front_page() || is_home()) {
        $add_img = perfect_magazine_get_option('top_section_advertisement');
        $add_url = perfect_magazine_get_option('top_section_advertisement_url');
        if (!empty ($add_img)){ ?>
            <div class="pro-banner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <a href="<?php echo esc_url($add_url); ?>" target="_blank">
                                <img src="<?php echo esc_url($add_img); ?>">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
        /**
         * perfect_magazine_action_front_page hook
         * @since newsliner 0.0.2
         *
         * @hooked perfect_magazine_action_banner_slider -  10
         * @sub_hooked perfect_magazine_action_front_page -  10
         */
        do_action('perfect_magazine_action_banner_slider');
    }
    if (is_front_page() && !is_home()) {
    } else {
        do_action('perfect-magazine-page-inner-title');
    }
    ?>

    <div id="content" class="site-content">