<?php
/**
 * Featured post section
 *
 * This is the template for the content of featured_post section
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */
if ( ! function_exists( 'lekhak_add_featured_post_section' ) ) :
    /**
    * Add featured_post section
    *
    *@since Lekhak 1.0.0
    */
    function lekhak_add_featured_post_section() {
    	$options = lekhak_get_theme_options();
        // Check if featured_post is enabled on frontpage
        $featured_post_enable = apply_filters( 'lekhak_section_status', true, 'featured_post_section_enable' );

        if ( true !== $featured_post_enable ) {
            return false;
        }
        // Get featured_post section details
        $section_details = array();
        $section_details = apply_filters( 'lekhak_filter_featured_post_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render featured_post section now.
        lekhak_render_featured_post_section( $section_details );
    }
endif;
add_action( 'lekhak_primary_content', 'lekhak_add_featured_post_section', 20 );

if ( ! function_exists( 'lekhak_get_featured_post_section_details' ) ) :
    /**
    * featured_post section details.
    *
    * @since Lekhak 1.0.0
    * @param array $input featured_post section details.
    */
    function lekhak_get_featured_post_section_details( $input ) {
        $options = lekhak_get_theme_options();

        $content = array();
        $post_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['featured_post_content_post_' . $i] ) )
                $post_ids[] = $options['featured_post_content_post_' . $i];
        }
        
        $args = array(
            'post_type'         => 'post',
            'post__in'          => ( array ) $post_ids,
            'posts_per_page'    => 3,
            'orderby'           => 'post__in',
            'ignore_sticky_posts'   => true,
            );   

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = lekhak_trim_content( 25 );
                $page_post['author']    = lekhak_author();
                $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';

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
// featured_post section content details.
add_filter( 'lekhak_filter_featured_post_section_details', 'lekhak_get_featured_post_section_details' );


if ( ! function_exists( 'lekhak_render_featured_post_section' ) ) :
  /**
   * Start featured_post section
   *
   * @return string featured_post content
   * @since Lekhak 1.0.0
   *
   */
   function lekhak_render_featured_post_section( $content_details = array() ) {
        $options = lekhak_get_theme_options();
        $featured_post_title  = ! empty( $options['featured_post_title'] ) ? $options['featured_post_title'] : '';

        if ( empty( $content_details ) ) {
            return;
        } 
        ?>
        <div id="featured-posts" class="relative page-section">
            <div class="wrapper">
                <?php if ( ! empty( $featured_post_title ) ) : ?>
                    <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html( $featured_post_title ); ?></h2>
                    </div><!-- .section-header -->
                <?php endif; ?>

                <div class="section-content col-3"><!-- supports col-1,col-2,col-3 -->
                    <?php foreach ( $content_details as $content ) : ?>
                        <article class="<?php echo ! empty( $content['image'] ) ? 'has-post-thumbnail' : 'no-post-thumbnail'; ?>">
                            <?php if ( ! empty( $content['image'] ) ) : ?>
                                <div class="featured-image">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>"></a>
                                </div><!-- .featured-image -->
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
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #fetaured-posts -->
    <?php 
    }
endif;