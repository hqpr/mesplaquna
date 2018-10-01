<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 *
 * @since      1.0.0
 *
 * @package    Canos_Framework
 * @subpackage Canos_Framework/admin
 */

class Canos_Framework_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $canos_framework    The ID of this plugin.
	 */
	private $canos_framework;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * General meta boxes.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $meta_boxes_general    The array of fields for the general meta boxes.
	 */
	private $meta_boxes_general;

	/**
	 * Gallery meta boxes.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $meta_boxes_gallery   The array of fields for the gallery.
	 */
	private $meta_boxes_gallery;

	/**
	 * Video meta boxes.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $meta_boxes_video   The array of fields for the video.
	 */
	private $meta_boxes_video;

	/**
	 * Audio meta boxes.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $meta_boxes_audio   The array of fields for the audio.
	 */
	private $meta_boxes_audio;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $canos_framework       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $canos_framework, $version ) {

		$this->canos_framework = $canos_framework;
		$this->version = $version;
		$this->meta_boxes_general = array();
		$this->add_meta_boxes_general();
		$this->meta_boxes_gallery = array();
		$this->add_meta_boxes_gallery();
		$this->meta_boxes_video = array();
		$this->add_meta_boxes_video();
		$this->meta_boxes_audio = array();
		$this->add_meta_boxes_audio();

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Canos_Framework_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Canos_Framework_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
			wp_enqueue_style( 'canos-framework-meta-css', plugin_dir_url( __FILE__ ) . 'css/canos-framework-meta.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Canos_Framework_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Canos_Framework_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		global $post;

		if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
			wp_enqueue_script( 'canos-framework-meta-js', plugin_dir_url( __FILE__ ) . 'js/canos-framework-meta.js', array( 'jquery' ), $this->version, true );
		}

	}

	/**
	 * Add the post views count column.
	 *
	 * @since    1.0.0
	 */
	public function manage_posts_columns( $columns ) {

		return array_merge( $columns, array( 'canos_framework_post_views' => esc_html__( 'Views', 'canos-framework' ) ) );

	}

	/**
	 * Get post views count.
	 *
	 * @since    1.0.0
	 */
	public function get_post_views( $postID ) {

		$post_view_meta_key = '_canos_framework_post_views_count';
		$count = get_post_meta( $postID, $post_view_meta_key, true );

		if ( $count == '' ) {
			delete_post_meta( $postID, $post_view_meta_key );
			add_post_meta( $postID, $post_view_meta_key, '0' );
			return "0";
		}

		return absint( $count );

	}

	/**
	 * Display the post views count in the column.
	 *
	 * @since    1.0.0
	 */
	public function manage_posts_custom_column( $column, $postID ) {

		if ( $column === 'canos_framework_post_views' ) {
			echo absint( $this->get_post_views( $postID ) );
		}

	}

	/**
	 * Meta box utility: case select.
	 *
	 * @since    1.0.0
	 */
	public function meta_box_select( $type, $id, $std, $name, $desc, $options, $meta ) {

		$val = $meta ? $meta : $std;
		echo '<div class="section section-' . esc_attr( $type ) . ' section-' . esc_attr( $id ) . '">';
		echo '<h4 class="heading">' . esc_html( $name ) . '</h4>';
		echo '<div class="option">';
		echo '<div class="command">';
		echo'<select id="' . esc_attr( $id ) . '" name="' . esc_attr( $id ) . '">';
		foreach ( $options as $option ) {
			echo'<option';
			if ( $meta == $option ) { 
				echo ' selected="selected"'; 
			}
			echo'>' . esc_html( $option ) . '</option>';
		} 
		echo'</select>';
		echo '<br></div>';
		if ( $desc != '' ) {
			echo '<p class="desc">' . esc_html( $desc ) . '</p>';
		}
		echo '</div>';
		echo '</div>';

	}

	/**
	 * Meta box utility: case media.
	 *
	 * @since    1.0.0
	 */
	public function meta_box_media( $type, $id, $std, $name, $meta ) {

		$val = $meta ? $meta : $std;
		echo '<div class="section section-' . esc_attr( $type ) . ' section-' . esc_attr( $id ) . '">';
		echo '<h4 class="heading">' . esc_html( $name ) . '</h4>';
		echo '<div class="option">';
		echo '<div class="command">';
		echo '<textarea name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '" cols="40" rows="4">' . esc_textarea( $val ) . '</textarea>';
		echo '<br></div>';
		echo '</div>';
		echo '</div>';

	}

	/**
	 * Meta box utility: case upload-gallery.
	 *
	 * @since    1.0.0
	 */
	public function meta_box_upload_gallery( $type, $id, $std, $name, $desc, $meta ) {

		$val = $meta ? $meta : $std;
		echo '<div class="section section-' . esc_attr( $type ) . ' section-' . esc_attr( $id ) . '">';
		echo '<h4 class="heading">' . esc_html( $name ) . '</h4>';
		echo '<div class="option">';
		echo '<div class="command">';
		echo '<input type="text" name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '" value="' . esc_attr( $val ) . '">';
		echo '<br>';
		echo '<a href="#" class="upload-button-gallery button-primary">' . esc_html__( 'Select images', 'canos-framework' ) . '</a>';
		echo '<br></div>';
		if ( $desc != '' ) {
			echo '<p class="desc">' . esc_html( $desc ) . '</p>';
		}
		echo '</div>';
		echo '</div>';

	}

	/**
	 * Meta boxes: general.
	 *
	 * @since    1.0.0
	 */
	public function add_meta_boxes_general() {

		$prefix = 'canos_meta_';

		$this->meta_boxes_general = array(
			'id' => 'canos-framework-meta-box-general',
			'title' => esc_html__('Post settings', 'canos-framework' ),
			'page' => 'post',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' =>  esc_html__( 'Use for slider in homepage?', 'canos-framework' ),
					'id' => $prefix . 'home_slider',
					'options' => array( 'no', 'yes' ),
					'desc' => '',
					'type' => 'select',
					'std' => 'no'
				),
			)
		);
	}

	/**
	 * Meta boxes: general fields.
	 *
	 * @since    1.0.0
	 */
	public function meta_boxes_general_fields() {
		global $post;

		wp_nonce_field( 'canos_framework_meta_box_nonce', 'canos_meta_box_nonce' );

		echo '<div class="wrap-boxes">';

		foreach ( $this->meta_boxes_general[ 'fields' ] as $field ) {

			switch ( $field[ 'type' ] ) {

				case 'select':
					$meta = get_post_meta( $post->ID, $field[ 'id' ], true );
					$this->meta_box_select( $field[ 'type' ], $field[ 'id' ], $field[ 'std' ], $field[ 'name' ], $field[ 'desc' ], $field[ 'options' ], $meta );
				break;

			}
		}

		echo '</div>';
	}

	/**
	 * Meta boxes: gallery.
	 *
	 * @since    1.0.0
	 */
	public function add_meta_boxes_gallery() {

		$prefix = 'canos_meta_';

		$this->meta_boxes_gallery = array(
			'id' => 'canos-framework-meta-box-gallery',
			'title' => esc_html__('Gallery settings', 'canos-framework' ),
			'page' => 'post',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' =>  esc_html__( 'Gallery images', 'canos-framework' ),
					'id' => $prefix . 'format_gallery',
					'desc' => esc_html__( 'Upload/select the images you want to include in this gallery (hold down the CTRL/CMD key to select mutiple files).', 'canos-framework' ),
					'type' => 'upload-gallery',
					'std' => ''
				)
			)
		);
	}

	/**
	 * Meta boxes: gallery fields.
	 *
	 * @since    1.0.0
	 */
	public function meta_boxes_gallery_fields() {
		global $post;

		wp_nonce_field( 'canos_framework_meta_box_nonce', 'canos_meta_box_nonce' );

		echo '<div class="wrap-boxes">';

		foreach ( $this->meta_boxes_gallery[ 'fields' ] as $field ) {

			switch ( $field[ 'type' ] ) {

				case 'upload-gallery':
					$meta = get_post_meta( $post->ID, $field[ 'id' ], true );
					$this->meta_box_upload_gallery( $field[ 'type' ], $field[ 'id' ], $field[ 'std' ], $field[ 'name' ], $field[ 'desc' ], $meta );
				break;

			}
		}

		echo '</div>';
	}

	/**
	 * Meta boxes: video.
	 *
	 * @since    1.0.0
	 */
	public function add_meta_boxes_video() {

		$prefix = 'canos_meta_';

		$this->meta_boxes_video = array(
			'id' => 'canos-framework-meta-box-video',
			'title' => esc_html__('Video settings', 'canos-framework' ),
			'page' => 'post',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' =>  esc_html__( 'Video URL (oEmbed) or Embed Code', 'canos-framework' ),
					'id' => $prefix . 'format_video_embed',
					'type' => 'media',
					'std' => ''
				)
			)
		);
	}

	/**
	 * Meta boxes: video fields.
	 *
	 * @since    1.0.0
	 */
	public function meta_boxes_video_fields() {
		global $post;

		wp_nonce_field( 'canos_framework_meta_box_nonce', 'canos_meta_box_nonce' );

		echo '<div class="wrap-boxes">';

		foreach ( $this->meta_boxes_video[ 'fields' ] as $field ) {

			switch ( $field[ 'type' ] ) {

				case 'media':
					$meta = get_post_meta( $post->ID, $field[ 'id' ], true );
					$this->meta_box_media( $field[ 'type' ], $field[ 'id' ], $field[ 'std' ], $field[ 'name' ], $meta );
				break;

			}
		}

		echo '</div>';
	}

	/**
	 * Meta boxes: audio.
	 *
	 * @since    1.0.0
	 */
	public function add_meta_boxes_audio() {

		$prefix = 'canos_meta_';

		$this->meta_boxes_audio = array(
			'id' => 'canos-framework-meta-box-audio',
			'title' => esc_html__('Audio settings', 'canos-framework' ),
			'page' => 'post',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' =>  esc_html__( 'Audio URL (oEmbed) or Embed Code', 'canos-framework' ),
					'id' => $prefix . 'format_audio_embed',
					'type' => 'media',
					'std' => ''
				)
			)
		);
	}

	/**
	 * Meta boxes: audio fields.
	 *
	 * @since    1.0.0
	 */
	public function meta_boxes_audio_fields() {
		global $post;

		wp_nonce_field( 'canos_framework_meta_box_nonce', 'canos_meta_box_nonce' );

		echo '<div class="wrap-boxes">';

		foreach ( $this->meta_boxes_audio[ 'fields' ] as $field ) {

			switch ( $field[ 'type' ] ) {

				case 'media':
					$meta = get_post_meta( $post->ID, $field[ 'id' ], true );
					$this->meta_box_media( $field[ 'type' ], $field[ 'id' ], $field[ 'std' ], $field[ 'name' ], $meta );
				break;

			}
		}

		echo '</div>';
	}

	/**
	 * Meta boxes: display fields.
	 *
	 * @since    1.0.0
	 */
	public function display_meta_boxes() {

		add_meta_box( $this->meta_boxes_general['id'], $this->meta_boxes_general['title'], array( $this, 'meta_boxes_general_fields' ), $this->meta_boxes_general['page'], $this->meta_boxes_general['context'], $this->meta_boxes_general['priority'] );
		add_meta_box( $this->meta_boxes_gallery['id'], $this->meta_boxes_gallery['title'], array( $this, 'meta_boxes_gallery_fields' ), $this->meta_boxes_gallery['page'], $this->meta_boxes_gallery['context'], $this->meta_boxes_gallery['priority'] );
		add_meta_box( $this->meta_boxes_video['id'], $this->meta_boxes_video['title'], array( $this, 'meta_boxes_video_fields' ), $this->meta_boxes_video['page'], $this->meta_boxes_video['context'], $this->meta_boxes_video['priority'] );
		add_meta_box( $this->meta_boxes_audio['id'], $this->meta_boxes_audio['title'], array( $this, 'meta_boxes_audio_fields' ), $this->meta_boxes_audio['page'], $this->meta_boxes_audio['context'], $this->meta_boxes_audio['priority'] );

	}

	/**
	 * Meta boxes: save fields.
	 *
	 * @since    1.0.0
	 */
	public function save_meta_boxes( $post_id ) {

		if ( ! isset( $_POST[ 'canos_meta_box_nonce' ] ) ) {
			return $post_id;
		}

		$nonce = $_POST[ 'canos_meta_box_nonce' ];

		if ( ! wp_verify_nonce( $nonce, 'canos_framework_meta_box_nonce' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		foreach ( $this->meta_boxes_general[ 'fields' ] as $field ) {

			$data = sanitize_text_field( $_POST[ $field[ 'id' ] ] );
			update_post_meta( $post_id, $field[ 'id' ], $data );

		}

		foreach ( $this->meta_boxes_gallery[ 'fields' ] as $field ) {

			$data = sanitize_text_field( $_POST[ $field[ 'id' ] ] );
			update_post_meta( $post_id, $field[ 'id' ], $data );

		}

		foreach ( $this->meta_boxes_video[ 'fields' ] as $field ) {

			$data = esc_textarea( $_POST[ $field[ 'id' ] ] );
			update_post_meta( $post_id, $field[ 'id' ], $data );

		}

		foreach ( $this->meta_boxes_audio[ 'fields' ] as $field ) {

			$data = esc_textarea( $_POST[ $field[ 'id' ] ] );
			update_post_meta( $post_id, $field[ 'id' ], $data );

		}

	}

}
