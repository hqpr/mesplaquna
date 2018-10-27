<?php
/**
 * Implement theme metabox.
 *
 * @package perfect-magazine
 */

if ( ! function_exists( 'perfect_magazine_add_theme_meta_box' ) ) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function perfect_magazine_add_theme_meta_box() {

        $apply_metabox_post_types = array( 'post', 'page' );

        foreach ( $apply_metabox_post_types as $key => $type ) {
            add_meta_box(
                'perfect-magazine-theme-settings',
                esc_html__( 'Single Page/Post Settings', 'perfect-magazine' ),
                'perfect_magazine_render_theme_settings_metabox',
                $type
            );
        }

    }

endif;

add_action( 'add_meta_boxes', 'perfect_magazine_add_theme_meta_box' );

if ( ! function_exists( 'perfect_magazine_render_theme_settings_metabox' ) ) :

    /**
     * Render theme settings meta box.
     *
     * @since 1.0.0
     */
    function perfect_magazine_render_theme_settings_metabox( $post, $metabox ) {

        $post_id = $post->ID;
        $perfect_magazine_post_meta_value = get_post_meta($post_id);

        // Meta box nonce for verification.
        wp_nonce_field( basename( __FILE__ ), 'perfect_magazine_meta_box_nonce' );
        // Fetch Options list.
        $page_layout = get_post_meta($post_id,'perfect-magazine-meta-select-layout',true);
        $page_image_layout = get_post_meta($post_id,'perfect-magazine-meta-image-layout',true);
        ?>
        <div id="perfect-magazine-settings-metabox-container" class="perfect-magazine-settings-metabox-container">
            <div id="perfect-magazine-settings-metabox-tab-layout">
                <h4><?php echo __( 'Layout Settings', 'perfect-magazine' ); ?></h4>
                <div class="perfect-magazine-row-content">
                    <!-- Checkbox Field-->
                    <p>
                    <div class="perfect-magazine-row-content">
                        <label for="perfect-magazine-meta-checkbox">
                            <input type="checkbox" name="perfect-magazine-meta-checkbox" id="perfect-magazine-meta-checkbox"
                                   value="yes" <?php if (isset($perfect_magazine_post_meta_value['perfect-magazine-meta-checkbox'])) {checked($perfect_magazine_post_meta_value['perfect-magazine-meta-checkbox'][0], 'yes');
                            }
                            ?>/>
                            <?php _e('Check To Use Featured Image As Banner Image', 'perfect-magazine')?>
                        </label>
                    </div>
                    </p>
                    <!-- Select Field-->
                    <p>
                        <label for="perfect-magazine-meta-select-layout" class="perfect-magazine-row-title">
                            <?php _e( 'Single Page/Post Layout', 'perfect-magazine' )?>
                        </label>
                        <select name="perfect-magazine-meta-select-layout" id="perfect-magazine-meta-select-layout">
                            <option value="left-sidebar" <?php selected('left-sidebar',$page_layout);?>>
                                <?php _e( 'Primary Sidebar - Content', 'perfect-magazine' )?>
                            </option>
                            <option value="right-sidebar" <?php selected('right-sidebar',$page_layout);?>>
                                <?php _e( 'Content - Primary Sidebar', 'perfect-magazine' )?>
                            </option>
                            <option value="no-sidebar" <?php selected('no-sidebar',$page_layout);?>>
                                <?php _e( 'No Sidebar', 'perfect-magazine' )?>
                            </option>
                        </select>
                    </p>

                    <!-- Select Field-->
                    <p>
                        <label for="perfect-magazine-meta-image-layout" class="perfect-magazine-row-title">
                            <?php _e( 'Single Page/Post Image Layout', 'perfect-magazine' )?>
                        </label>
                        <select name="perfect-magazine-meta-image-layout" id="perfect-magazine-meta-image-layout">
                            <option value="full" <?php selected('full',$page_image_layout);?>>
                                <?php _e( 'Full', 'perfect-magazine' )?>
                            </option>
                            <option value="left" <?php selected('left',$page_image_layout);?>>
                                <?php _e( 'Left', 'perfect-magazine' )?>
                            </option>
                            <option value="right" <?php selected('right',$page_image_layout);?>>
                                <?php _e( 'Right', 'perfect-magazine' )?>
                            </option>
                            <option value="no-image" <?php selected('no-image',$page_image_layout);?>>
                                <?php _e( 'No Image', 'perfect-magazine' )?>
                            </option>
                        </select>
                    </p>
                </div><!-- .perfect-magazine-row-content -->
            </div><!-- #perfect-magazine-settings-metabox-tab-layout -->
        </div><!-- #perfect-magazine-settings-metabox-container -->

        <?php
    }

endif;



if ( ! function_exists( 'perfect_magazine_save_theme_settings_meta' ) ) :

    /**
     * Save theme settings meta box value.
     *
     * @since 1.0.0
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post Post object.
     */
    function perfect_magazine_save_theme_settings_meta( $post_id, $post ) {

        // Verify nonce.
        if ( ! isset( $_POST['perfect_magazine_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['perfect_magazine_meta_box_nonce'], basename( __FILE__ ) ) ) {
            return; }

        // Bail if auto save or revision.
        if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
            return;
        }

        // Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
        if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
            return;
        }

        // Check permission.
        if ( 'page' === $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return; }
        } else if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        $perfect_magazine_meta_checkbox = isset($_POST['perfect-magazine-meta-checkbox'])?esc_attr($_POST['perfect-magazine-meta-checkbox']):'';
        update_post_meta($post_id, 'perfect-magazine-meta-checkbox', sanitize_text_field($perfect_magazine_meta_checkbox));
        $perfect_magazine_meta_select_layout =  isset( $_POST[ 'perfect-magazine-meta-select-layout' ] ) ? esc_attr($_POST[ 'perfect-magazine-meta-select-layout' ]) : '';
        if(!empty($perfect_magazine_meta_select_layout)){
            update_post_meta($post_id, 'perfect-magazine-meta-select-layout', sanitize_text_field($perfect_magazine_meta_select_layout));
        }
        $perfect_magazine_meta_image_layout =  isset( $_POST[ 'perfect-magazine-meta-image-layout' ] ) ? esc_attr($_POST[ 'perfect-magazine-meta-image-layout' ]) : '';
        if(!empty($perfect_magazine_meta_image_layout)){
            update_post_meta($post_id, 'perfect-magazine-meta-image-layout', sanitize_text_field($perfect_magazine_meta_image_layout));
        }
    }

endif;

add_action( 'save_post', 'perfect_magazine_save_theme_settings_meta', 10, 2 );