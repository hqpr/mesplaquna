<?php
/**
 * Popular post section
 *
 * This is the template for the content of popular_post section
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */
if ( ! function_exists( 'lekhak_add_popular_post_section' ) ) :
    /**
    * Add popular_post section
    *
    *@since Lekhak 1.0.0
    */
    function lekhak_add_popular_post_section() {
    	$options = lekhak_get_theme_options();
        // Check if popular_post is enabled on frontpage
        $popular_post_enable = apply_filters( 'lekhak_section_status', true, 'popular_post_section_enable' );

        if ( true !== $popular_post_enable ) {
            return false;
        }
        // Get popular_post section details
        $section_details = array();
        $section_details = apply_filters( 'lekhak_get_popular_post_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render popular_post section now.
        lekhak_render_popular_post_section( $section_details );
    }
endif;
add_action( 'lekhak_primary_content', 'lekhak_add_popular_post_section', 30 );

if ( ! function_exists( 'lekhak_get_popular_post_section_details' ) ) :
    /**
    * popular_post section details.
    *
    * @since Lekhak 1.0.0
    * @param array $input popular_post section details.
    */
    function lekhak_get_popular_post_section_details( $input ) {
        $options = lekhak_get_theme_options();

        $content = array();
        $content['left']  = array();
        $content['right'] = array();
        $cat_id = ! empty( $options['popular_post_left_content_category'] ) ? $options['popular_post_left_content_category'] : '';
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 3,
            'cat'               => absint( $cat_id ),
            'ignore_sticky_posts'   => true,
            );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['author']    = lekhak_author();
                $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'medium' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x600.jpg';

                // Push to the main array.
                array_push( $content['left'], $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

        
        $post_id = ! empty( $options['popular_post_right_content_post'] ) ? $options['popular_post_right_content_post'] : '';
        $args = array(
            'post_type'         => 'post',
            'page_id'           => absint( $post_id ),
            'posts_per_page'    => 1,
            'ignore_sticky_posts'   => true,
            );   

        // Run The Loop.
        $query_2 = new WP_Query( $args );
        if ( $query_2->have_posts() ) : 
            while ( $query_2->have_posts() ) : $query_2->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['author']    = lekhak_author();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'medium_large' ) : '';

                // Push to the main array.
                array_push( $content['right'], $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// popular_post section content details.
add_filter( 'lekhak_get_popular_post_section_details', 'lekhak_get_popular_post_section_details' );


if ( ! function_exists( 'lekhak_render_popular_post_section' ) ) :
  /**
   * Start popular_post section
   *
   * @return string popular_post content
   * @since Lekhak 1.0.0
   *
   */
   function lekhak_render_popular_post_section( $content_details = array() ) {
        $options = lekhak_get_theme_options();
        $popular_post_title  = ! empty( $options['popular_post_title'] ) ? $options['popular_post_title'] : '';
        if ( empty( $content_details ) ) {
            return;
        } 
        ?>
        <div id="popular-posts" class="relative page-section">
            <div class="wrapper">
                <?php if ( ! empty( $popular_post_title ) ) : ?>
                    <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html( $popular_post_title ); ?></h2>
                    </div><!-- .section-header -->
                <?php endif; ?>

                <div class="section-content col-2 clear">
                    <div class="hentry posts-wrapper">
                        <div class="inner-posts-wrapper" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite": false, "speed": 800, "dots": false, "arrows":true, "autoplay": true, "vertical": true, "fade": false }'>
                            <?php foreach ( $content_details['left'] as $content ) : ?>
                                <article class="<?php echo ! empty( $content['image'] ) ? 'has-post-thumbnail' : 'no-post-thumbnail'; ?>">
                                    <?php if ( ! empty( $content['image'] ) ) : ?>
                                        <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');"><a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a></div>
                                    <?php endif; ?>

                                    <div class="entry-container">
                                        <div class="entry-meta">
                                            <?php lekhak_article_categories_meta( $content['id'] ); ?>
                                        </div><!-- .entry-meta -->

                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                        </header>

                                        <div class="entry-meta">
                                            <?php  
                                                lekhak_posted_on( $content['id'] );
                                                echo wp_kses_post( $content['author'] );
                                            ?>
                                        </div><!-- .entry-meta -->
                                    </div><!-- .entry-container -->
                                </article>
                            <?php endforeach; ?>
                        </div><!-- .inner-posts-wrapper -->
                    </div><!-- .hentry -->

                    <div class="hentry highlighted-post">
                        <?php foreach ( $content_details['right'] as $content ) : ?>
                            <article class="<?php echo ! empty( $content['image'] ) ? 'has-post-thumbnail' : 'no-post-thumbnail'; ?>">
                                <?php if ( ! empty( $content['image'] ) ) : ?>
                                    <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');"><a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a></div>
                                <?php endif; ?>

                                <div class="entry-container">
                                    <div class="entry-meta">
                                        <?php lekhak_article_categories_meta( $content['id'] ); ?>
                                    </div><!-- .entry-meta -->

                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                    </header>

                                    <div class="entry-meta">
                                        <?php  
                                            lekhak_posted_on( $content['id'] );
                                            echo wp_kses_post( $content['author'] );
                                        ?>
                                    </div><!-- .entry-meta -->
                                </div><!-- .entry-container -->
                            </article>
                        <?php endforeach; ?>
                    </div><!-- .hentry -->
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #popular-posts -->
    <?php 
    }
endif;