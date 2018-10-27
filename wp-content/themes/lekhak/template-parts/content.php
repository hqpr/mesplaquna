<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

$options = lekhak_get_theme_options();
$readmore = ! empty( $options['read_more_text'] ) ? $options['read_more_text'] : esc_html__( 'Read More', 'lekhak' );
$class = has_post_thumbnail() ? 'has-post-thumbnail' : 'no-post-thumbnail';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="featured-image" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( '', 'medium_large' ) ); ?>');"><a href="<?php the_permalink(); ?>" class="post-thumbnail-link"></a></div>
    <?php endif; ?>

    <div class="entry-container">
        <div class="entry-meta">
            <?php lekhak_article_categories_meta(); ?>
        </div><!-- .entry-meta -->

        <header class="entry-header">
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </header>

        <div class="entry-meta">
            <?php  
                lekhak_posted_on();
                echo lekhak_author();;
            ?>
        </div><!-- .entry-meta -->

        <div class="entry-content">
            <p><?php the_excerpt(); ?></p>
        </div><!-- .entry-content -->

        <a href="<?php the_permalink(); ?>" class="more-link">
            <?php  
                echo esc_html( $readmore );
                echo lekhak_get_svg( array( 'icon' => 'right' ) );
            ?>
        </a>
    </div><!-- .entry-container -->
</article>
