<?php
/**
 * Blog section
 *
 * This is the template for the content of blog section
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */
if ( ! function_exists( 'lekhak_add_blog_section' ) ) :
    /**
    * Add blog section
    *
    *@since Lekhak 1.0.0
    */
    function lekhak_add_blog_section() {
    	$options = lekhak_get_theme_options();
        // Check if blog is enabled on frontpage
        $blog_enable = apply_filters( 'lekhak_section_status', true, 'blog_section_enable' );

        if ( true !== $blog_enable ) {
            return false;
        }
        // Get blog section details
        $section_details = array();
        $section_details = apply_filters( 'lekhak_filter_blog_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render blog section now.
        lekhak_render_blog_section( $section_details );
    }
endif;
add_action( 'lekhak_primary_content', 'lekhak_add_blog_section', 40 );

if ( ! function_exists( 'lekhak_get_blog_section_details' ) ) :
    /**
    * blog section details.
    *
    * @since Lekhak 1.0.0
    * @param array $input blog section details.
    */
    function lekhak_get_blog_section_details( $input ) {
        $options = lekhak_get_theme_options();

        // Content type.
        $blog_content_type  = $options['blog_content_type'];
        
        $content = array();
        switch ( $blog_content_type ) {

            case 'category':
                $cat_id = ! empty( $options['blog_content_category'] ) ? $options['blog_content_category'] : '';
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => 4,
                    'cat'               => absint( $cat_id ),
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            case 'recent':
                $cat_ids = ! empty( $options['blog_category_exclude'] ) ? $options['blog_category_exclude'] : array();
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => 4,
                    'category__not_in'  => ( array ) $cat_ids,
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            default:
            break;
        }


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = lekhak_trim_content( 35 );
                $page_post['author']    = lekhak_author();
                $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'medium_large' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x600.jpg';

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// blog section content details.
add_filter( 'lekhak_filter_blog_section_details', 'lekhak_get_blog_section_details' );


if ( ! function_exists( 'lekhak_render_blog_section' ) ) :
  /**
   * Start blog section
   *
   * @return string blog content
   * @since Lekhak 1.0.0
   *
   */
   function lekhak_render_blog_section( $content_details = array() ) {
        $options = lekhak_get_theme_options();
        $title = ! empty( $options['blog_section_title'] ) ? $options['blog_section_title'] : '';
        $readmore = ! empty( $options['blog_section_btn_label'] ) ? $options['blog_section_btn_label'] : esc_html__( 'Read More', 'lekhak' );

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="latest-posts" class="relative page-section">
            <div class="wrapper">
                <?php if ( ! empty( $title ) ) : ?>
                    <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
                    </div><!-- .section-header -->
                <?php endif; ?>

                <div class="section-content posts-wrapper clear">
                    <?php foreach ( $content_details as $content ) : ?>
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

                                <div class="entry-content">
                                    <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                </div><!-- .entry-content -->

                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="more-link">
                                    <?php 
                                        echo esc_html( $readmore ); 
                                        echo lekhak_get_svg( array( 'icon' => 'right' ) );
                                    ?>
                                </a>
                            </div><!-- .entry-container -->
                        </article>
                    <?php endforeach; ?>

                </div><!-- .section-content -->

            </div><!-- .wrapper -->
        </div><!-- #latest-posts -->

    <?php }
endif;