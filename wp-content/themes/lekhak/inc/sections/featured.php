<?php
/**
 * Featured section
 *
 * This is the template for the content of featured section
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */
if ( ! function_exists( 'lekhak_add_featured_section' ) ) :
    /**
    * Add featured section
    *
    *@since Lekhak 1.0.0
    */
    function lekhak_add_featured_section() {
    	$options = lekhak_get_theme_options();
        // Check if featured is enabled on frontpage
        $featured_enable = apply_filters( 'lekhak_section_status', true, 'featured_section_enable' );

        if ( true !== $featured_enable ) {
            return false;
        }
        // Get featured section details
        $section_details = array();
        $section_details = apply_filters( 'lekhak_filter_featured_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render featured section now.
        lekhak_render_featured_section( $section_details );
    }
endif;
add_action( 'lekhak_primary_content', 'lekhak_add_featured_section', 10 );

if ( ! function_exists( 'lekhak_get_featured_section_details' ) ) :
    /**
    * featured section details.
    *
    * @since Lekhak 1.0.0
    * @param array $input featured section details.
    */
    function lekhak_get_featured_section_details( $input ) {
        $options = lekhak_get_theme_options();

        $content = array();
        $page_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['featured_content_page_' . $i] ) )
                $page_ids[] = $options['featured_content_page_' . $i];
        }
        
        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 3,
            'orderby'           => 'post__in',
            );                     

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = has_post_thumbnail() ? lekhak_trim_content( 25 ) : lekhak_trim_content( 35 );
                $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'medium_large' ) : '';

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
// featured section content details.
add_filter( 'lekhak_filter_featured_section_details', 'lekhak_get_featured_section_details' );


if ( ! function_exists( 'lekhak_render_featured_section' ) ) :
  /**
   * Start featured section
   *
   * @return string featured content
   * @since Lekhak 1.0.0
   *
   */
   function lekhak_render_featured_section( $content_details = array() ) {
        $options = lekhak_get_theme_options();
        $featured_btn_label  = ! empty( $options['featured_btn_label'] ) ? $options['featured_btn_label'] : esc_html__( 'Start Reading', 'lekhak' );

        if ( empty( $content_details ) ) {
            return;
        } 
        ?>
        <div id="featured-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": false, "speed": 1000, "dots": true, "arrows":true, "autoplay": true, "fade": true }'>
            <?php foreach ( $content_details as $content ) : ?>
                <article class="<?php echo ! empty( $content['image'] ) ? 'has-post-thumbnail' : 'no-post-thumbnail'; ?>"><!-- add class 'no-post-thumbnail' when no featured image-->
                    <div class="wrapper">
                        <?php if ( ! empty( $content['image'] ) ) : ?>
                            <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">  
                            </div><!-- .featured-image -->
                        <?php endif; ?>

                        <div class="entry-container">
                            <div class="entry-meta">
                                <?php lekhak_posted_on( $content['id'] ); ?>
                            </div><!-- .entry-meta -->

                            <div class="section-header">
                                <h2 class="section-title"><?php echo esc_html( $content['title'] ); ?><span class="first-word"><?php echo wp_trim_words( esc_html( $content['title'] ), 1, '' ); ?></span></h2>
                            </div><!-- .section-header -->

                            <div class="entry-content">
                                <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                            </div><!-- .entry-content -->

                            <div class="read-more">
                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn btn-primary"><?php echo esc_html( $featured_btn_label ); ?></a>
                            </div>

                        </div><!-- .entry-container -->
                    </div><!-- .wrapper -->
                </article>
            <?php endforeach; ?>
        </div><!-- #featured-slider -->
        <?php 
    }
endif;