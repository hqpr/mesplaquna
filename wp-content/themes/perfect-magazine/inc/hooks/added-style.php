<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package perfect-magazine
 */

if (!function_exists('perfect_magazine_trigger_custom_css_action')) :

    /**
     * Do action theme custom CSS.
     *
     * @since 1.0.0
     */
    function perfect_magazine_trigger_custom_css_action()
    {
        $perfect_magazine_enable_banner_overlay = perfect_magazine_get_option('enable_overlay_option');
        ?>
        <style type="text/css">
            <?php
            /* Banner Image */
            if ( $perfect_magazine_enable_banner_overlay == 1 ){
                ?>
                    .inner-header-overlay,
                    .hero-slider.overlay .slide-item .bg-image:before {
                        background: #042738;
                        filter: alpha(opacity=65);
                        opacity: 0.65;
                    }
            <?php
        } ?>
        </style>

    <?php }

endif;