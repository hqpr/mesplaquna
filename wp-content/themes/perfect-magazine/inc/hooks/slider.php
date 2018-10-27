<?php
if (!function_exists('perfect_magazine_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since perfect-magazine 1.0.0
     *
     */
    function perfect_magazine_banner_slider()
    {
        if (1 != perfect_magazine_get_option('show_slider_section')) {
            return null;
        }
        $perfect_magazine_slider_category = esc_attr(perfect_magazine_get_option('select_category_for_slider'));
        $perfect_magazine_slider_double_post_category = esc_attr(perfect_magazine_get_option('select_category_for_slider_double_post'));
        $perfect_magazine_slider_number = 3;
        ?>
        <?php
        if (1 != perfect_magazine_get_option('show_fullwidth_slider_section')) {
            $fullwidth_slider = '';
        } else {
            $fullwidth_slider = 'main-banner-fullwidth';
        }?>
        <div class="feature-block main-banner <?php echo esc_attr($fullwidth_slider); ?>">
            <div class="container">
                <div class="row row-collapse">
                    <?php 
                    $perfect_magazine_banner_slider_args = array(
                        'post_type' => 'post',
                        'cat' => absint($perfect_magazine_slider_category),
                        'ignore_sticky_posts' => true,
                        'posts_per_page' => absint( $perfect_magazine_slider_number ),
                    ); ?>
                    <div class="col-sm-7">
                        <div class="mainbanner-jumbotron">
                            <?php
                            $perfect_magazine_banner_slider_post_query = new WP_Query($perfect_magazine_banner_slider_args);
                            if ($perfect_magazine_banner_slider_post_query->have_posts()) :
                                while ($perfect_magazine_banner_slider_post_query->have_posts()) : $perfect_magazine_banner_slider_post_query->the_post();
                                    if(has_post_thumbnail()){
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'perfect-magazine-1200-800' );
                                        $url = $thumb['0'];
                                    }
                                    global $post;
                                    $author_id = $post->post_author;
                                    ?>
                                        <figure class="slick-item">
                                            <a href="<?php the_permalink(); ?>" class="data-bg data-bg-slide" data-background="<?php echo esc_url($url); ?>">
                                            </a>
                                            <figcaption class="slider-figcaption slider-figcaption-main">
                                                <div class="slider-wrapper">
                                                    <h2 class="slide-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h2>
                                                    <div class="grid-item-metadata">
                                                        <?php perfect_magazine_posted_date_only(); ?>
                                                        <?php perfect_magazine_posted_author_only(); ?>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    <?php
                                    endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-5">
                    <?php 
                    $perfect_magazine_banner_slider_double_post_args = array(
                        'post_type' => 'post',
                        'cat' => absint($perfect_magazine_slider_double_post_category),
                        'ignore_sticky_posts' => true,
                        'posts_per_page' => 3,
                    ); ?>
                    <?php 
                    $perfect_magazine_banner_slider_double_post_query = new WP_Query($perfect_magazine_banner_slider_double_post_args);
                    if ($perfect_magazine_banner_slider_double_post_query->have_posts()) :
                        while ($perfect_magazine_banner_slider_double_post_query->have_posts()) : $perfect_magazine_banner_slider_double_post_query->the_post();
                            if(has_post_thumbnail()){
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'perfect-magazine-1200-800' );
                                $url = $thumb['0'];
                            }
                            global $post;
                            $author_id = $post->post_author;
                            ?>
                                <div class="slider-aside-item">
                                    <figure class="tm-article tm-article-slides">
                                         <div class="tm-article-item">
                                            <div class="article-item-image">
                                                <div class="row row-collapse row-table">
                                                    <div class="col-xs-5">
                                                        <div class="data-bg data-bg-1" data-background="<?php echo esc_url($url); ?>"></div>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <figcaption>
                                                            <h4 class="secondary-font slide-nav-title">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </h4>
                                                            <div class="entry-footer">
                                                                <?php perfect_magazine_posted_date_only(); ?>
                                                                <?php perfect_magazine_posted_author_only(); ?>
                                                            </div>
                                                        </figcaption>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
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

        <?php
    }
endif;
add_action('perfect_magazine_action_banner_slider', 'perfect_magazine_banner_slider', 40);
