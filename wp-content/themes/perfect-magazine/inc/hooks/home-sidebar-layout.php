<?php
if ( ! function_exists( 'perfect_magazine_widget_section' ) ) :
    /**
     *
     * @since Perfect Magazine 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function perfect_magazine_widget_section() {
        $sidebar_home_1 = '';
        ?>
        <!-- Main Content section -->
        <?php if (! is_active_sidebar( 'sidebar-home-2') ) {
            $sidebar_home_1 = "full-width";
        }?>
        <?php if ( is_active_sidebar( 'sidebar-home-1') ) {  ?>
            <div class="feature-block homepage-widgetarea">
                <?php dynamic_sidebar('sidebar-home-1'); ?>
            </div>
        <?php } ?>
    <?php
    }
endif;
add_action( 'perfect_magazine_action_sidebar_section', 'perfect_magazine_widget_section', 50 );