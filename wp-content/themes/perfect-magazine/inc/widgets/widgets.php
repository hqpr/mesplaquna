<?php
/**
 * Theme widgets.
 *
 * @package Perfect Magazine
 */

// Load widget base.
require_once get_template_directory() . '/inc/widgets/widget-base-class.php';

if (!function_exists('perfect_magazine_load_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function perfect_magazine_load_widgets()
    {
        //  Perfect_Magazine_slider
        register_widget('Perfect_Magazine_widget_slider');
        //  Perfect_Magazine_Carousel_Widget
        register_widget('Perfect_Magazine_Carousel_Widget');
        //Perfect_Magazine_widget_vertical_list
        register_widget('Perfect_Magazine_Widget_Vertical_List');
        register_widget('Perfect_Magazine_Widget_Grid_List');

        register_widget('Perfect_Magazine_widget_social');

        // Recent Post widget.
        register_widget('Perfect_Magazine_sidebar_widget');

        // Tabbed widget.
        register_widget('Perfect_Magazine_Tabbed_Widget');

        // Auther widget.
        register_widget('Perfect_Magazine_Author_Post_widget');

    }
endif;
add_action('widgets_init', 'perfect_magazine_load_widgets');


/*vertical list widget*/
if (!class_exists('Perfect_Magazine_Widget_Vertical_List')) :

    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Perfect_Magazine_Widget_Vertical_List extends Perfect_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'perfect_magazine_vertical_list tm-widget',
                'description' => __('Displays posts from selected category in vertical post listing', 'perfect-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'perfect-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => __('Description:', 'perfect-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'perfect-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'perfect-magazine'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'perfect-magazine'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 4,
                ),
            );

            parent::__construct('perfect-magazine-vertical-list', __('PM: Vertical List Widget', 'perfect-magazine'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>

            <?php global $post;
            ?>
            <div class="widget-wrapper widget-wrapper-1">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if ((!empty($params['title'])) ||(!empty($params['description'])) ) {
                                echo "<div class='widget-header-wrapper'>";
                                if (!empty($params['title'])) {
                                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                                }
                                if (!empty($params['description'])) {
                                    echo "<p class='widget-description'>";
                                    echo esc_html($params['description']);
                                    echo "</p>";
                                }
                                echo "</div>";
                            } ?>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($all_posts as $key => $post) : ?>
                            <?php setup_postdata($post); ?>
                            <?php if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'perfect-magazine-460-280');
                                $thumblarge = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                $url_large = $thumblarge['0'];
                                $url = $thumb['0'];
                            } else {
                                $url = get_template_directory_uri() . '/assets/images/no-image.jpg';
                                $url_large = get_template_directory_uri() . '/assets/images/no-image.jpg';
                            }

                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-12" data-mh="list-height">
                                <article class="">
                                    <div class="post-image zoom-gallery">
                                        <a href="<?php echo esc_url($url_large); ?>" class="reveal-enable">
                                            <img src="<?php echo esc_url($url); ?>"
                                                 alt="<?php the_title_attribute(); ?>">
                                        </a>
                                    </div>
                                    <div class="article-content article-content-1">
                                        <div class="entry-meta">
                                            <?php perfect_magazine_posted_category_only(); ?>
                                        </div>
                                        <div class="entry-header">
                                            <h3 class="entry-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                        </div>
                                        <div class="entry-footer">
                                            <?php perfect_magazine_posted_date_only(); ?>
                                            <?php perfect_magazine_posted_author_only(); ?>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*grid list widget*/
if (!class_exists('Perfect_Magazine_Widget_Grid_List')) :

    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Perfect_Magazine_Widget_Grid_List extends Perfect_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'perfect_magazine_grid_list tm-widget',
                'description' => __('Displays posts from selected category in Grid post listing with one large featured post', 'perfect-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'perfect-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => __('Description:', 'perfect-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'perfect-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'perfect-magazine'),
                ),
                'img_right' => array(
                    'label' => __('Move Image to Right', 'perfect-magazine'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'perfect-magazine'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 4,
                ),
            );

            parent::__construct('perfect-magazine-grid-list', __('PM: Grid List Widget', 'perfect-magazine'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $i = 1;

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>

            <?php global $post;
            ?>
            <div class="widget-wrapper widget-wrapper-2">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if ((!empty($params['title'])) ||(!empty($params['description'])) ) {
                                echo "<div class='widget-header-wrapper'>";
                                if (!empty($params['title'])) {
                                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                                }
                                if (!empty($params['description'])) {
                                    echo "<p class='widget-description'>";
                                    echo esc_html($params['description']);
                                    echo "</p>";
                                }
                                echo "</div>";
                            } ?>
                        </div>
                    </div>
                    <?php
                    foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <?php if (has_post_thumbnail()) {
                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'perfect-magazine-460-280');
                            $thumb1 = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'perfect-magazine-720-480');
                            $thumblarge = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                            $url_large = $thumblarge['0'];
                            $url = $thumb['0'];
                            $url1 = $thumb1['0'];
                        } else {
                            $url = get_template_directory_uri() . '/assets/images/no-image.jpg';
                            $url1 = get_template_directory_uri() . '/assets/images/no-image-720x480.jpg';
                            $url_large = get_template_directory_uri() . '/assets/images/no-image-720x480.jpg';
                        }

                        ?>
                        <?php if ($i == 1) { ?>
                            <?php
                            if (true === $params['img_right']) {
                                $image_class= 'row-rtl';
                            } else {
                                $image_class= '';
                            }?>
                            <div class="row row-collapse row-table row-bg <?php echo esc_attr($image_class); ?>">
                                <div class="col-sm-6 article-feature-image zoom-gallery">
                                    <a href="<?php echo esc_url($url_large); ?>" class="reveal-enable">
                                        <img src="<?php echo esc_url($url1); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                </div>
                                <div class="col-sm-6 article-feature-content">
                                    <div class="article-content">
                                        <div class="entry-meta entry-meta-bg">
                                            <?php perfect_magazine_posted_category_only(); ?>
                                        </div>
                                        <div class="entry-header">
                                            <h3 class="entry-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                        </div>
                                        <div class="entry-footer">
                                            <?php perfect_magazine_posted_date_only() ?>
                                            <?php perfect_magazine_posted_author_only() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++;
                        } else {
                            if ($i == 2) {
                                echo "<div class='row'>";
                            } ?>
                            <div class="col-sm-4" data-mh="grid-height">
                                <article>
                                    <div class="post-image zoom-gallery">
                                        <a href="<?php echo esc_url($url_large); ?>" class="reveal-enable">
                                            <img src="<?php echo esc_url($url); ?>"
                                                 alt="<?php the_title_attribute(); ?>">
                                        </a>
                                    </div>
                                    <div class="article-content article-content-1">
                                        <div class="entry-meta">
                                            <?php perfect_magazine_posted_category_only(); ?>
                                        </div>
                                        <div class="entry-header">
                                            <h3 class="entry-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                        </div>
                                        <div class="entry-footer">
                                            <?php perfect_magazine_posted_date_only() ?>
                                            <?php perfect_magazine_posted_author_only() ?>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <?php if ($i == esc_attr($params['post_number'])) {
                                echo "</div>";
                            }
                            $i++; ?>
                        <?php } ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

//    slider
if (!class_exists('Perfect_Magazine_widget_slider')) :

    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Perfect_Magazine_widget_slider extends Perfect_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'perfect_magazine_slider_widget tm-widget',
                'description' => __('Displays posts from selected category in slider', 'perfect-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'post_category' => array(
                    'label' => __('Select Category:', 'perfect-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'perfect-magazine'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'perfect-magazine'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 4,
                ),
            );

            parent::__construct('perfect-magazine-slider-layout', __('PM: Slider Widget', 'perfect-magazine'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>

            <?php global $post;
            $author_id = $post->post_author;
            ?>
            <div class="widget-wrapper widget-wrapper-slider">
                <div class="container">
                    <div class="tm-slider-widget">
                        <?php foreach ($all_posts as $key => $post) : ?>
                            <?php setup_postdata($post); ?>
                            <?php if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                $url = $thumb['0'];
                            } else {
                                $url = '';
                            }
                            ?>
                            <figure class="slick-item primary-bgcolor">
                                <a href="<?php the_permalink(); ?>" class="data-bg data-bg-slide data-bg-slide-widget"
                                   data-background="<?php echo esc_url($url); ?>">
                                </a>
                                <figcaption class="slider-figcaption">
                                    <div class="slider-figcaption-inner">
                                        <div class="entry-meta entry-meta-bg">
                                            <span class="item-metadata post-category-label">
                                                <?php $categories_list = get_the_category_list(wp_kses_post(' ')); ?>
                                                <?php if (!empty($categories_list)) { ?>
                                                    <?php echo $categories_list; ?>
                                                <?php } ?>
                                            </span>
                                        </div>
                                        <h2 class="slide-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <div class="tm-article-meta">
                                            <div class="entry-footer">
                                                <?php perfect_magazine_posted_date_only() ?>
                                                <?php perfect_magazine_posted_author_only() ?>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

//    slider
if (!class_exists('Perfect_Magazine_Carousel_Widget')) :

    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Perfect_Magazine_Carousel_Widget extends Perfect_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'perfect_magazine_carousel_widget tm-widget',
                'description' => __('Displays posts from selected category in Carousel slider', 'perfect-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'post_category' => array(
                    'label' => __('Select Category:', 'perfect-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'perfect-magazine'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'perfect-magazine'),
                    'type' => 'number',
                    'default' => 8,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 8,
                ),
            );

            parent::__construct('perfect-magazine-carousel-layout', __('PM: Carousel Widget', 'perfect-magazine'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>

            <?php global $post;
            $author_id = $post->post_author;
            ?>
            <div class="widget-wrapper widget-wrapper-carousel">
                <div class="container">
                    <div class="tm-carousel-widget">
                        <?php foreach ($all_posts as $key => $post) : ?>
                            <?php setup_postdata($post); ?>
                            <?php if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                $url = $thumb['0'];
                            } else {
                                $url = '';
                            }
                            ?>
                            <div class="slick-item">
                                <div class="carousel-items">
                                    <div class="carousel-items-list">
                                        <a href="<?php the_permalink(); ?>" class="data-bg data-bg-slide data-bg-slide-widget"
                                           data-background="<?php echo esc_url($url); ?>">
                                        </a>
                                        <figcaption class="slider-figcaption">
                                            <div class="slider-figcaption-inner">
                                                <div class="entry-meta entry-meta-bg">
                                                    <span class="item-metadata post-category-label">
                                                        <?php $categories_list = get_the_category_list(wp_kses_post(' ')); ?>
                                                        <?php if (!empty($categories_list)) { ?>
                                                            <?php echo $categories_list; ?>
                                                        <?php } ?>
                                                    </span>
                                                </div>
                                                <h2 class="slide-title">
                                                    <a href="<?php the_permalink(); ?>" class="bg-shadow"><?php the_title(); ?></a>
                                                </h2>
                                                <div class="tm-article-meta">
                                                    <div class="entry-footer">
                                                        <?php perfect_magazine_posted_date_only() ?>
                                                        <?php perfect_magazine_posted_author_only() ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Grid Panel widget*/
if (!class_exists('Perfect_Magazine_sidebar_widget')) :

    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class Perfect_Magazine_sidebar_widget extends Perfect_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'perfect_magazine_popular_post_widget tm-widget',
                'description' => __('Displays post form selected category specific for popular post in sidebars.', 'perfect-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'perfect-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => __('Description:', 'perfect-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'perfect-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'perfect-magazine'),
                ),
                'enable_discription' => array(
                    'label' => __('Enable Discription:', 'perfect-magazine'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'perfect-magazine'),
                    'description' => __('Number of words', 'perfect-magazine'),
                    'default' => 15,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'perfect-magazine'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 6,
                ),
            );

            parent::__construct('perfect-magazine-popular-sidebar-layout', __('PM: Recent/Popular Post Widget', 'perfect-magazine'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            if ((!empty($params['title'])) ||(!empty($params['description'])) ) {
                echo "<div class='widget-header-wrapper'>";
                if (!empty($params['title'])) {
                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                }
                if (!empty($params['description'])) {
                    echo "<p class='widget-description'>";
                    echo esc_html($params['description']);
                    echo "</p>";
                }
                echo "</div>";
            }

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            $count = 1;
            ?>
            <?php global $post;
            $author_id = $post->post_author;
            ?>
            <?php if (!empty($all_posts)) : ?>
            <div class="tm-recent-widget">
                <ul class="recent-widget-list">
                    <?php foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <li class="full-item clearfix">
                            <div class="tm-row row">
                                <div class="full-item-image item-image col col-four pull-left">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'perfect-magazine-460-280');
                                        $url = $thumb['0'];
                                    } else {
                                        $url = get_template_directory_uri() . '/images/no-image.jpg';
                                    }
                                    ?>
                                    <figure class="tm-article">
                                        <div class="tm-article-item">
                                            <div class="article-item-image">
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo esc_url($url); ?>"
                                                         alt="<?php the_title_attribute(); ?>">
                                                </a>
                                            </div>
                                        </div>
                                    </figure>

                                </div>
                                <div class="full-item-details col col-six">
                                    <div class="full-item-content">
                                        <h3 class="full-item-title item-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>

                                    <div class="tm-article-meta">
                                        <div class="item-metadata posts-date">
                                            <span><?php echo esc_html__('Published on : ', 'perfect-magazine'); ?></span>
                                            <?php the_time('j M Y'); ?>
                                        </div>
                                        <div class="item-metadata tm-article-author">
                                            <span><?php echo esc_html('Published by : ', 'perfect-magazine'); ?></span>
                                            <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                                                <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="full-item-discription">
                                        <?php if (true === $params['enable_discription']) { ?>
                                            <div class="post-description">
                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                    <?php
                                                    $excerpt = perfect_magazine_words_count(absint($params['excerpt_length']), get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                        $count++;
                    endforeach; ?>
                </ul>
            </div>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*tabed widget*/
if (!class_exists('Perfect_Magazine_Tabbed_Widget')) :

    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class Perfect_Magazine_Tabbed_Widget extends Perfect_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {

            $opts = array(
                'classname' => 'perfect_magazine_widget_tabbed tm-widget',
                'description' => __('Tabbed widget.', 'perfect-magazine'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label' => __('Popular', 'perfect-magazine'),
                    'type' => 'heading',
                ),
                'popular_number' => array(
                    'label' => __('No. of Posts:', 'perfect-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'enable_discription' => array(
                    'label' => __('Enable Discription:', 'perfect-magazine'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'perfect-magazine'),
                    'description' => __('Number of words', 'perfect-magazine'),
                    'default' => 30,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'recent_heading' => array(
                    'label' => __('Recent', 'perfect-magazine'),
                    'type' => 'heading',
                ),
                'recent_number' => array(
                    'label' => __('No. of Posts:', 'perfect-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'comments_heading' => array(
                    'label' => __('Comments', 'perfect-magazine'),
                    'type' => 'heading',
                ),
                'comments_number' => array(
                    'label' => __('No. of Comments:', 'perfect-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
            );

            parent::__construct('perfect-magazine-tabbed', __('PM: Sidebar Tab Widget', 'perfect-magazine'), $opts, array(), $fields);

        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);
            $tab_id = 'tabbed-' . $this->number;

            echo $args['before_widget'];
            ?>
            <div class="tabbed-container clearfix">
                <div class="section-head">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="tab tab-popular active">
                            <a href="#<?php echo esc_attr($tab_id); ?>-popular"
                               aria-controls="<?php esc_html_e('Popular', 'perfect-magazine'); ?>" role="tab"
                               data-toggle="tab" class="tab-popular-bgcolor">
                                <?php esc_html_e('Popular', 'perfect-magazine'); ?>
                            </a>
                        </li>
                        <li class="tab tab-recent">
                            <a href="#<?php echo esc_attr($tab_id); ?>-recent"
                               aria-controls="<?php esc_html_e('Recent', 'perfect-magazine'); ?>" role="tab"
                               data-toggle="tab" class="tab-popular-bgcolor">
                                <?php esc_html_e('Recent', 'perfect-magazine'); ?>
                            </a>
                        </li>
                        <li class="tab tab-comments">
                            <a href="#<?php echo esc_attr($tab_id); ?>-comments"
                               aria-controls="<?php esc_html_e('Comments', 'perfect-magazine'); ?>" role="tab"
                               data-toggle="tab" class="tab-popular-bgcolor">
                                <?php esc_html_e('Comments', 'perfect-magazine'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab-pane active">
                        <?php $this->render_news('popular', $params); ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab-pane">
                        <?php $this->render_news('recent', $params); ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-comments" role="tabpanel" class="tab-pane">
                        <?php $this->render_comments($params); ?>
                    </div>
                </div>
            </div>
            <?php

            echo $args['after_widget'];

        }

        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         */
        function render_news($type, $params)
        {

            if (!in_array($type, array('popular', 'recent'))) {
                return;
            }

            switch ($type) {
                case 'popular':
                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows' => true,
                        'orderby' => 'comment_count',
                    );
                    break;

                case 'recent':
                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows' => true,
                    );
                    break;

                default:
                    break;
            }

            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            ?>

            <ul class="article-item article-list-item article-tabbed-list article-item-left">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <li class="full-item clearfix">
                        <div class="tm-row row">
                            <div class="full-item-image item-image col col-four pull-right">
                                <a href="<?php the_permalink(); ?>" class="news-item-thumb">
                                    <?php if (has_post_thumbnail($post->ID)) : ?>
                                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'perfect-magazine-720-480'); ?>
                                        <?php if (!empty($image)) : ?>
                                            <img src="<?php echo esc_url($image[0]); ?>"
                                                 alt="<?php the_title_attribute(); ?>"/>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/no-image-720x480.jpg'; ?>" alt="<?php the_title_attribute(); ?>"/>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="full-item-details col col-six">

                                <div class="full-item-content">
                                    <h3 class="full-item-title item-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <div class="full-item-metadata">
                                        <div class="item-metadata posts-date">
                                            <span><?php echo esc_html__('Published on : ', 'perfect-magazine'); ?></span>
                                            <?php the_time('j M Y'); ?>
                                        </div>
                                    </div>

                                    <div class="full-item-desc">
                                        <?php if (true === $params['enable_discription']) { ?>
                                            <div class="post-description">
                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                    <?php
                                                    $excerpt = perfect_magazine_words_count(absint($params['excerpt_length']), get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .news-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .news-list -->

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>

            <?php

        }

        /**
         * Render comments.
         *
         * @since 1.0.0
         *
         * @param array $params Parameters.
         * @return void
         */
        function render_comments($params)
        {

            $comment_args = array(
                'number' => $params['comments_number'],
                'status' => 'approve',
                'post_status' => 'publish',
            );

            $comments = get_comments($comment_args);
            ?>
            <?php if (!empty($comments)) : ?>
            <ul class="article-item article-list-item article-item-left comments-tabbed--list">
                <?php foreach ($comments as $key => $comment) : ?>
                    <li class="article-panel clearfix">
                        <figure class="article-thumbmnail">
                            <?php $comment_author_url = get_comment_author_url($comment); ?>
                            <?php if (!empty($comment_author_url)) : ?>
                                <a href="<?php echo esc_url($comment_author_url); ?>"><?php echo get_avatar($comment, 65); ?></a>
                            <?php else : ?>
                                <?php echo get_avatar($comment, 65); ?>
                            <?php endif; ?>
                        </figure><!-- .comments-thumb -->
                        <div class="comments-content">
                            <?php echo get_comment_author_link($comment); ?>
                            &nbsp;<?php echo esc_html_x('on', 'Tabbed Widget', 'perfect-magazine'); ?>&nbsp;<a
                                    href="<?php echo esc_url(get_comment_link($comment)); ?>"><?php echo get_the_title($comment->comment_post_ID); ?></a>
                        </div><!-- .comments-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .comments-list -->
        <?php endif; ?>
            <?php
        }

    }
endif;


/*author widget*/
if (!class_exists('Perfect_Magazine_Author_Post_widget')) :

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class Perfect_Magazine_Author_Post_widget extends Perfect_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'perfect_magazine_author_widget tm-widget',
                'description' => __('Displays authors details in post.', 'perfect-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'perfect-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'author-name' => array(
                    'label' => __('Name:', 'perfect-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'discription' => array(
                    'label' => __('Discription:', 'perfect-magazine'),
                    'type' => 'textarea',
                    'class' => 'widget-content widefat'
                ),
                'image_url' => array(
                    'label' => __('Author Image:', 'perfect-magazine'),
                    'type' => 'image',
                ),
                'url-fb' => array(
                    'label' => __('Facebook URL:', 'perfect-magazine'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tw' => array(
                    'label' => __('Twitter URL:', 'perfect-magazine'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-gp' => array(
                    'label' => __('Googleplus URL:', 'perfect-magazine'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
            );

            parent::__construct('perfect-magazine-author-layout', __('PM: Author Widget', 'perfect-magazine'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            } ?>

            <!--cut from here-->
            <div class="author-info">
                <div class="author-image">
                    <?php if (!empty($params['image_url'])) { ?>
                        <div class="profile-image bg-image">
                            <img src="<?php echo esc_url($params['image_url']); ?>">
                        </div>
                    <?php } ?>
                </div> <!-- /#author-image -->
                <div class="author-details">
                    <?php if (!empty($params['author-name'])) { ?>
                        <h3 class="author-name"><?php echo esc_html($params['author-name']); ?></h3>
                    <?php } ?>
                    <?php if (!empty($params['discription'])) { ?>
                        <p><?php echo wp_kses_post($params['discription']); ?></p>
                    <?php } ?>
                </div> <!-- /#author-details -->
                <div class="author-social">
                    <?php if (!empty($params['url-fb'])) { ?>
                        <a href="<?php echo esc_url($params['url-fb']); ?>"><i
                                    class="meta-icon ion-social-facebook"></i></a>
                    <?php } ?>
                    <?php if (!empty($params['url-tw'])) { ?>
                        <a href="<?php echo esc_url($params['url-tw']); ?>"><i class="meta-icon ion-social-twitter"></i></a>
                    <?php } ?>
                    <?php if (!empty($params['url-gp'])) { ?>
                        <a href="<?php echo esc_url($params['url-gp']); ?>"><i
                                    class="meta-icon ion-social-googleplus"></i></a>
                    <?php } ?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*author widget*/
if (!class_exists('Perfect_Magazine_widget_social')) :

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class Perfect_Magazine_widget_social extends Perfect_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'perfect_magazine_social_widget tm-widget',
                'description' => __('Displays social menu if you have set it(social menu)', 'perfect-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'perfect-magazine'),
                    'description' => __('Note: Displays social menu if you have set it(social menu)', 'perfect-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => __('Description:', 'perfect-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('perfect-magazine-social-layout', __('PM: Social Menu Widget', 'perfect-magazine'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if ((!empty($params['title'])) ||(!empty($params['description'])) ) {
                echo "<div class='widget-header-wrapper'>";
                if (!empty($params['title'])) {
                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                }
                if (!empty($params['description'])) {
                    echo "<p class='widget-description'>";
                    echo esc_html($params['description']);
                    echo "</p>";
                }
                echo "</div>";
            } ?>

            <!--cut from here-->
            <div class="social-widget-menu">
                <?php
                if (has_nav_menu('social')) {
                    wp_nav_menu(array(
                        'theme_location' => 'social',
                        'link_before' => '<span>',
                        'link_after' => '</span>',
                    ));
                } ?>
            </div>
            <?php if (!has_nav_menu('social')) : ?>
            <p>
                <?php esc_html_e('Social menu is not set. You need to create menu and assign it to Social Menu on Menu Settings.', 'perfect-magazine'); ?>
            </p>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

