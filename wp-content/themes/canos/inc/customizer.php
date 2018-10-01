<?php
/**
 * Canos Theme Customizer
 *
 * @package Canos
 */

/**
 * Setup the Theme Customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function canos_customize_register( $wp_customize ) {

	/**
	 * Custom class for saving media data in an array. Only supports the 'theme_mod' type.
	 *
	 * @author     Justin Tadlock <justin@justintadlock.com>
	 * @copyright  Copyright (c) 2015, Justin Tadlock
	 * @link       http://themehybrid.com/hybrid-core
	 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
	 */
	class JT_Customize_Setting_Image_Data extends WP_Customize_Setting {

		/**
		* Overwrites the `update()` method so we can save some extra data.
		*/
		protected function update( $value ) {

			if ( $value ) {

				$post_id = attachment_url_to_postid( $value );

				if ( $post_id ) {

					$image = wp_get_attachment_image_src( $post_id, 'full' );

					if ( $image ) {

						/* Set up a custom array of data to save. */
						$data = array(
							'url'    => esc_url_raw( $image[0] ),
							'width'  => absint( $image[1] ),
							'height' => absint( $image[2] ),
							'id'     => absint( $post_id )
						);

						set_theme_mod( "{$this->id_data[ 'base' ]}_data", $data );
					}
				}
			}

			/* No media? Remove the data mod. */
			if ( empty( $value ) || empty( $post_id ) || empty( $image ) ) {
				remove_theme_mod( "{$this->id_data[ 'base' ]}_data" );
			}

			/* Let's send this back up and let the parent class do its thing. */
			return parent::update( $value );
		}
	}

	/*--------------------------------------------------------------
	Logo & Favicon
	--------------------------------------------------------------*/

	$wp_customize->add_section(
		'canos_new_section_logo_favicon',
		array(
			'title'      => esc_html__( 'Logo & Favicon', 'canos' ),
			'description'=> '',
			'priority'   => 50
	) );

		/*---- settings ----*/

		$wp_customize->add_setting(
			new JT_Customize_Setting_Image_Data(
				$wp_customize,
				'canos_opt_logo',
				array(
					'sanitize_callback' => 'esc_url_raw'
				)
			)
		);

		$wp_customize->add_setting(
			new JT_Customize_Setting_Image_Data(
				$wp_customize,
				'canos_opt_logo_retina',
				array(
					'sanitize_callback' => 'esc_url_raw'
				)
			)
		);

		$wp_customize->add_setting(
			'canos_opt_favicon',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		/*---- controls ----*/

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'desktop_logo',
				array(
					'label'       => esc_html__( 'Upload Logo', 'canos' ),
					'section'     => 'canos_new_section_logo_favicon',
					'settings'    => 'canos_opt_logo',
					'priority'	  => 1
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'retina_logo',
				array(
					'label'       => esc_html__( 'Upload Logo (retina)', 'canos' ),
					'description' => esc_html__( 'Upload a double-sized logo for retina displays.', 'canos' ),
					'section'     => 'canos_new_section_logo_favicon',
					'settings'    => 'canos_opt_logo_retina',
					'priority'	  => 2
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'favicon',
				array(
					'label'       => esc_html__( 'Upload Favicon', 'canos' ),
					'section'     => 'canos_new_section_logo_favicon',
					'settings'    => 'canos_opt_favicon',
					'priority'	  => 3
				)
			)
		);

	/*--------------------------------------------------------------
	General Settings
	--------------------------------------------------------------*/

	$wp_customize->add_section( 'canos_new_section_general',
		array(
			'title'      => esc_html__( 'General Settings', 'canos' ),
			'description'=> '',
			'priority'   => 51
	) );

		/*---- settings ----*/

		$wp_customize->add_setting(
			'canos_opt_hide_breadcrumbs',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_disable_views',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		/*---- controls ----*/

		$wp_customize->add_control(
			'hide_breadcrumbs',
			array(
				'label'       => esc_html__( 'Hide Breadcrumbs', 'canos' ),
				'section'     => 'canos_new_section_general',
				'settings'    => 'canos_opt_hide_breadcrumbs',
				'type'        => 'checkbox',
				'priority'	  => 2
			)
		);

		$wp_customize->add_control(
			'disable_views',
			array(
				'label'       => esc_html__( 'Disable Views', 'canos' ),
				'section'     => 'canos_new_section_general',
				'settings'    => 'canos_opt_disable_views',
				'type'        => 'checkbox',
				'priority'	  => 3
			)
		);

	/*--------------------------------------------------------------
	Blog Settings
	--------------------------------------------------------------*/

	$wp_customize->add_section( 'canos_new_section_blog',
		array(
			'title'      => esc_html__( 'Blog Settings', 'canos' ),
			'description'=> '',
			'priority'   => 52
	) );

		/*---- settings ----*/

		$wp_customize->add_setting(
			'canos_opt_home_slider',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_blog_layout',
			array(
				'default'           => 'right-sidebar full-modules',
				'sanitize_callback' => 'canos_sanitize_layout'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_blog_post_thumbnail',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_blog_post_date',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_blog_post_author',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_blog_post_excerpt',
			array(
				'default'           => 'content',
				'sanitize_callback' => 'canos_sanitize_excerpt'
			)
		);

		/*---- controls ----*/

		$wp_customize->add_control(
			'home_slider',
			array(
				'label'       => esc_html__( 'Show slider in home', 'canos' ),
				'section'     => 'canos_new_section_blog',
				'settings'    => 'canos_opt_home_slider',
				'type'        => 'checkbox',
				'priority'	  => 1
			)
		);

		$wp_customize->add_control(
			'blog_layout',
			array(
				'label'       => esc_html__( 'Blog layout', 'canos' ),
				'description' => esc_html__( 'Select the layout of the blog page', 'canos' ),
				'section'     => 'canos_new_section_blog',
				'settings'    => 'canos_opt_blog_layout',
				'priority'	  => 2,
				'type'        => 'radio',
				'choices' => array( 
					'right-sidebar grid-modules' => esc_html__( 'Grid - Right sidebar', 'canos' ),
					'left-sidebar grid-modules' => esc_html__( 'Grid - Left sidebar', 'canos' ),
					'no-sidebar grid-modules' => esc_html__( 'Grid - No sidebar', 'canos' ),
					'right-sidebar full-modules' => esc_html__( 'Full - Right sidebar', 'canos' ),
					'left-sidebar full-modules' => esc_html__( 'Full - Left sidebar', 'canos' ),
					'no-sidebar full-modules' => esc_html__( 'Full - No sidebar', 'canos' )
				)
			)
		);

		$wp_customize->add_control(
			'blog_post_excerpt',
			array(
				'label'       => esc_html__( 'Post content', 'canos' ),
				'description' => esc_html__( 'Select how to display the content of the post. You can display the regular content (and split the text with the more tag), the excerpt or the excerpt with a custom "read more" button.', 'canos' ),
				'section'     => 'canos_new_section_blog',
				'settings'    => 'canos_opt_blog_post_excerpt',
				'priority'	  => 3,
				'type'        => 'radio',
				'choices' => array( 
					'content' => esc_html__( 'Show content', 'canos' ),
					'excerpt' => esc_html__( 'Show excerpt', 'canos' ),
					'excerpt+more' => esc_html__( 'Show excerpt and more button', 'canos' )
				)
			)
		);

		$wp_customize->add_control(
			'blog_post_thumbnail',
			array(
				'label'       => esc_html__( 'Hide post thumbnail', 'canos' ),
				'section'     => 'canos_new_section_blog',
				'settings'    => 'canos_opt_blog_post_thumbnail',
				'type'        => 'checkbox',
				'priority'	  => 4
			)
		);

		$wp_customize->add_control(
			'blog_post_date',
			array(
				'label'       => esc_html__( 'Hide post date', 'canos' ),
				'section'     => 'canos_new_section_blog',
				'settings'    => 'canos_opt_blog_post_date',
				'type'        => 'checkbox',
				'priority'	  => 5
			)
		);

		$wp_customize->add_control(
			'blog_post_author',
			array(
				'label'       => esc_html__( 'Hide post author', 'canos' ),
				'section'     => 'canos_new_section_blog',
				'settings'    => 'canos_opt_blog_post_author',
				'type'        => 'checkbox',
				'priority'	  => 6
			)
		);

	/*--------------------------------------------------------------
	Archive Settings
	--------------------------------------------------------------*/

	$wp_customize->add_section( 'canos_new_section_archive',
		array(
			'title'      => esc_html__( 'Archive Settings', 'canos' ),
			'description'=> '',
			'priority'   => 53
	) );

		/*---- settings ----*/

		$wp_customize->add_setting(
			'canos_opt_archive_layout',
			array(
				'default'           => 'right-sidebar full-modules',
				'sanitize_callback' => 'canos_sanitize_layout'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_archive_post_thumbnail',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_archive_post_date',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_archive_post_author',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_archive_post_excerpt',
			array(
				'default'           => 'content',
				'sanitize_callback' => 'canos_sanitize_excerpt'
			)
		);

		/*---- controls ----*/

		$wp_customize->add_control(
			'archive_layout',
			array(
				'label'       => esc_html__( 'Archive layout', 'canos' ),
				'description' => esc_html__( 'Select the layout of the archive page', 'canos' ),
				'section'     => 'canos_new_section_archive',
				'settings'    => 'canos_opt_archive_layout',
				'priority'	  => 1,
				'type'        => 'radio',
				'choices' => array( 
					'right-sidebar grid-modules' => esc_html__( 'Grid - Right sidebar', 'canos' ),
					'left-sidebar grid-modules' => esc_html__( 'Grid - Left sidebar', 'canos' ),
					'no-sidebar grid-modules' => esc_html__( 'Grid - No sidebar', 'canos' ),
					'right-sidebar full-modules' => esc_html__( 'Full - Right sidebar', 'canos' ),
					'left-sidebar full-modules' => esc_html__( 'Full - Left sidebar', 'canos' ),
					'no-sidebar full-modules' => esc_html__( 'Full - No sidebar', 'canos' )
				)
			)
		);

		$wp_customize->add_control(
			'archive_post_excerpt',
			array(
				'label'       => esc_html__( 'Post content', 'canos' ),
				'description' => esc_html__( 'Select how to display the content of the post. You can display the regular content (and split the text with the more tag), the excerpt or the excerpt with a custom "read more" button.', 'canos' ),
				'section'     => 'canos_new_section_archive',
				'settings'    => 'canos_opt_archive_post_excerpt',
				'priority'	  => 2,
				'type'        => 'radio',
				'choices' => array( 
					'content' => esc_html__( 'Show content', 'canos' ),
					'excerpt' => esc_html__( 'Show excerpt', 'canos' ),
					'excerpt+more' => esc_html__( 'Show excerpt and more button', 'canos' )
				)
			)
		);

		$wp_customize->add_control(
			'archive_post_thumbnail',
			array(
				'label'       => esc_html__( 'Hide post thumbnail', 'canos' ),
				'section'     => 'canos_new_section_archive',
				'settings'    => 'canos_opt_archive_post_thumbnail',
				'type'        => 'checkbox',
				'priority'	  => 3
			)
		);

		$wp_customize->add_control(
			'archive_post_date',
			array(
				'label'       => esc_html__( 'Hide post date', 'canos' ),
				'section'     => 'canos_new_section_archive',
				'settings'    => 'canos_opt_archive_post_date',
				'type'        => 'checkbox',
				'priority'	  => 4
			)
		);

		$wp_customize->add_control(
			'archive_post_author',
			array(
				'label'       => esc_html__( 'Hide post author', 'canos' ),
				'section'     => 'canos_new_section_archive',
				'settings'    => 'canos_opt_archive_post_author',
				'type'        => 'checkbox',
				'priority'	  => 5
			)
		);

	/*--------------------------------------------------------------
	Post Settings
	--------------------------------------------------------------*/

	$wp_customize->add_section( 'canos_new_section_post',
		array(
			'title'      => esc_html__( 'Post Settings', 'canos' ),
			'description'=> '',
			'priority'   => 54
	) );

		/*---- settings ----*/

		$wp_customize->add_setting(
			'canos_opt_single_post_layout',
			array(
				'default'           => 'right-sidebar',
				'sanitize_callback' => 'canos_sanitize_layout_single'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_single_post_hide_author_bio',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_single_post_hide_related',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_hide_post_sharer',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_single_post_hide_post_nav',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		/*---- controls ----*/

		$wp_customize->add_control(
			'post_layout',
			array(
				'label'       => esc_html__( 'Post layout', 'canos' ),
				'description' => esc_html__( 'Select the layout of the post page', 'canos' ),
				'section'     => 'canos_new_section_post',
				'settings'    => 'canos_opt_single_post_layout',
				'priority'	  => 1,
				'type'        => 'radio',
				'choices' => array( 
					'right-sidebar' => esc_html__( 'Right sidebar', 'canos' ),
					'left-sidebar' => esc_html__( 'Left sidebar', 'canos' ),
					'no-sidebar' => esc_html__( 'No sidebar', 'canos' )
				)
			)
		);

		$wp_customize->add_control(
			'single_post_hide_author_bio',
			array(
				'label'       => esc_html__( 'Hide author bio', 'canos' ),
				'section'     => 'canos_new_section_post',
				'settings'    => 'canos_opt_single_post_hide_author_bio',
				'type'        => 'checkbox',
				'priority'	  => 2
			)
		);

		$wp_customize->add_control(
			'single_post_hide_related',
			array(
				'label'       => esc_html__( 'Hide related posts', 'canos' ),
				'section'     => 'canos_new_section_post',
				'settings'    => 'canos_opt_single_post_hide_related',
				'type'        => 'checkbox',
				'priority'	  => 3
			)
		);

		$wp_customize->add_control(
			'hide_post_sharer',
			array(
				'label'       => esc_html__( 'Hide social sharer', 'canos' ),
				'section'     => 'canos_new_section_post',
				'settings'    => 'canos_opt_hide_post_sharer',
				'type'        => 'checkbox',
				'priority'	  => 4
			)
		);

		$wp_customize->add_control(
			'single_post_hide_post_nav',
			array(
				'label'       => esc_html__( 'Hide post navigation', 'canos' ),
				'section'     => 'canos_new_section_post',
				'settings'    => 'canos_opt_single_post_hide_post_nav',
				'type'        => 'checkbox',
				'priority'	  => 5
			)
		);

	/*--------------------------------------------------------------
	Page Settings
	--------------------------------------------------------------*/

	$wp_customize->add_section( 'canos_new_section_page',
		array(
			'title'      => esc_html__( 'Page Settings', 'canos' ),
			'description'=> '',
			'priority'   => 55
	) );

		/*---- settings ----*/

		$wp_customize->add_setting(
			'canos_opt_single_page_layout',
			array(
				'default'           => 'no-sidebar',
				'sanitize_callback' => 'canos_sanitize_layout_single'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_single_page_show_comments',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		/*---- controls ----*/

		$wp_customize->add_control(
			'page_layout',
			array(
				'label'       => esc_html__( 'Page layout', 'canos' ),
				'description' => esc_html__( 'Select the layout of the single page', 'canos' ),
				'section'     => 'canos_new_section_page',
				'settings'    => 'canos_opt_single_page_layout',
				'priority'	  => 1,
				'type'        => 'radio',
				'choices' => array( 
					'right-sidebar' => esc_html__( 'Right sidebar', 'canos' ),
					'left-sidebar' => esc_html__( 'Left sidebar', 'canos' ),
					'no-sidebar' => esc_html__( 'No sidebar', 'canos' )
				)
			)
		);

		$wp_customize->add_control(
			'single_page_show_comments',
			array(
				'label'       => esc_html__( 'Show comments', 'canos' ),
				'section'     => 'canos_new_section_page',
				'settings'    => 'canos_opt_single_page_show_comments',
				'type'        => 'checkbox',
				'priority'	  => 2
			)
		);

	/*--------------------------------------------------------------
	Fonts
	--------------------------------------------------------------*/

	$wp_customize->add_section( 'canos_new_section_fonts',
		array(
			'title'      => esc_html__( 'Fonts', 'canos' ),
			'description'=> '',
			'priority'   => 56
	) );

		/*---- settings ----*/

		$wp_customize->add_setting(
			'canos_opt_site_google_font',
			array(
				'default'           => 'Inconsolata',
				'sanitize_callback' => 'canos_sanitize_font'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_site_custom_font',
			array(
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		/*---- controls ----*/

		$google_fonts = array(
			'Abel' => 'Abel',
			'Arimo' => 'Arimo',
			'Arvo' => 'Arvo',
			'Asap' => 'Asap',
			'Bitter' => 'Bitter',
			'Bree+Serif' => 'Bree Serif',
			'Cabin+Condensed' => 'Cabin Condensed',
			'Cabin' => 'Cabin',
			'Chivo' => 'Chivo',
			'Cuprum' => 'Cuprum',
			'Dosis' => 'Dosis',
			'Droid+Sans' => 'Droid Sans',
			'Droid+Serif' => 'Droid Serif',
			'Exo' => 'Exo',
			'Francois+One' => 'Francois One',
			'Inconsolata' => 'Inconsolata',
			'Josefin+Sans' => 'Josefin Sans',
			'Karla' => 'Karla',
			'Lato' => 'Lato',
			'Lora' => 'Lora',
			'Maven+Pro' => 'Maven Pro',
			'Merriweather' => 'Merriweather',
			'Montserrat' => 'Montserrat',
			'Muli' => 'Muli',
			'Nunito' => 'Nunito',
			'Open+Sans+Condensed' => 'Open Sans Condensed',
			'Open+Sans' => 'Open Sans',
			'Oswald' => 'Oswald',
			'Playfair+Display' => 'Playfair Display',
			'PT+Sans+Narrow' => 'PT Sans Narrow',
			'PT+Sans' => 'PT Sans',
			'PT+Serif+Caption' => 'PT Serif Caption',
			'PT+Serif' => 'PT Serif',
			'Questrial' => 'Questrial',
			'Quicksand' => 'Quicksand',
			'Raleway' => 'Raleway',
			'Roboto' => 'Roboto',
			'Roboto+Condensed' => 'Roboto Condensed',
			'Roboto+Slab' => 'Roboto Slab',
			'Rokkitt' => 'Rokkitt',
			'Signika' => 'Signika',
			'Slabo' => 'Slabo',
			'Source+Sans+Pro' => 'Source Sans Pro',
			'Ubuntu+Condensed' => 'Ubuntu Condensed',
			'Ubuntu' => 'Ubuntu',
			'Varela+Round' => 'Varela Round',
			'Vollkorn' => 'Vollkorn'
		);

		$wp_customize->add_control(
			'site_google_font',
			array(
				'label'       => esc_html__( 'Google font', 'canos' ),
				'section'     => 'canos_new_section_fonts',
				'settings'    => 'canos_opt_site_google_font',
				'priority'	  => 1,
				'type'        => 'select',
				'choices'     => $google_fonts
			)
		);

		$wp_customize->add_control(
			'site_custom_font',
			array(
				'label'       => esc_html__( 'Custom font family', 'canos' ),
				'description' => esc_html__( 'You can use a custom font instead of the default Google font family. Remember to load the font somewhere in your theme (if needed)', 'canos' ),
				'section'     => 'canos_new_section_fonts',
				'settings'    => 'canos_opt_site_custom_font',
				'type'        => 'text',
				'priority'	  => 2
			)
		);

	
	/*--------------------------------------------------------------
	Colors
	--------------------------------------------------------------*/

	$wp_customize->add_section( 'canos_new_section_colors',
		array(
		'title'      => esc_html__( 'Colors', 'canos' ),
		'description'=> '',
		'priority'   => 57
	) );

		/*---- settings ----*/

		$wp_customize->add_setting(
			'canos_opt_accent_color',
			array(
				'default'           => '#55cbe3',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		/*---- controls ----*/

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'accent_color',
				array(
					'label'       => esc_html__( 'Accent Color', 'canos' ),
					'section'     => 'canos_new_section_colors',
					'settings'    => 'canos_opt_accent_color',
					'priority'	  => 1
				)
			)
		);	
	
	/*--------------------------------------------------------------
	Social Header
	--------------------------------------------------------------*/

	$wp_customize->add_section( 'canos_new_section_social_header',
		array(
		'title'      => esc_html__( 'Social Header', 'canos' ),
		'description'=> '',
		'priority'   => 58
	) );

		/*---- settings ----*/

		$wp_customize->add_setting(
			'canos_opt_social_header',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_check_social_target',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_facebook',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_twitter',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_dribbble',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_linkedin',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_flickr',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_tumblr',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_vimeo',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_youtube',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_instagram',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_google',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_foursquare',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_github',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_pinterest',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_stackoverflow',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_deviantart',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_behance',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_delicious',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_soundcloud',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_spotify',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_stumbleupon',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_reddit',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_vine',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_digg',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_vk',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_rss',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		/*---- controls ----*/

		$wp_customize->add_control(
			'social_header',
			array(
				'label'       => esc_html__( 'Hide Social Header', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_social_header',
				'type'        => 'checkbox',
				'priority'	  => 1
			)
		);

		$wp_customize->add_control(
			'social_header_target',
			array(
				'label'       => esc_html__( 'Open social links in a new window/tab', 'canos' ),
				'section'     => 'canos_opt_check_social_target',
				'settings'    => 'canos_opt_social_header',
				'type'        => 'checkbox',
				'priority'	  => 1
			)
		);

		$wp_customize->add_control(
			'facebook',
			array(
				'label'       => esc_html__( 'Facebook URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_facebook',
				'type'        => 'text',
				'priority'	  => 2
			)
		);

		$wp_customize->add_control(
			'twitter',
			array(
				'label'       => esc_html__( 'Twitter URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_twitter',
				'type'        => 'text',
				'priority'	  => 3
			)
		);

		$wp_customize->add_control(
			'dribbble',
			array(
				'label'       => esc_html__( 'Dribbble URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_dribbble',
				'type'        => 'text',
				'priority'	  => 4
			)
		);

		$wp_customize->add_control(
			'linkedin',
			array(
				'label'       => esc_html__( 'LinkedIn URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_linkedin',
				'type'        => 'text',
				'priority'	  => 5
			)
		);

		$wp_customize->add_control(
			'flickr',
			array(
				'label'       => esc_html__( 'Flickr URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_flickr',
				'type'        => 'text',
				'priority'	  => 6
			)
		);

		$wp_customize->add_control(
			'tumblr',
			array(
				'label'       => esc_html__( 'Tumblr URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_tumblr',
				'type'        => 'text',
				'priority'	  => 7
			)
		);

		$wp_customize->add_control(
			'vimeo',
			array(
				'label'       => esc_html__( 'Vimeo URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_vimeo',
				'type'        => 'text',
				'priority'	  => 8
			)
		);

		$wp_customize->add_control(
			'youtube',
			array(
				'label'       => esc_html__( 'Youtube URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_youtube',
				'type'        => 'text',
				'priority'	  => 9
			)
		);

		$wp_customize->add_control(
			'instagram',
			array(
				'label'       => esc_html__( 'Instagram URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_instagram',
				'type'        => 'text',
				'priority'	  => 10
			)
		);

		$wp_customize->add_control(
			'google',
			array(
				'label'       => esc_html__( 'Google Plus URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_google',
				'type'        => 'text',
				'priority'	  => 11
			)
		);

		$wp_customize->add_control(
			'foursquare',
			array(
				'label'       => esc_html__( 'Foursquare URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_foursquare',
				'type'        => 'text',
				'priority'	  => 12
			)
		);

		$wp_customize->add_control(
			'github',
			array(
				'label'       => esc_html__( 'GitHub URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_github',
				'type'        => 'text',
				'priority'	  => 13
			)
		);

		$wp_customize->add_control(
			'pinterest',
			array(
				'label'       => esc_html__( 'Pinterest URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_pinterest',
				'type'        => 'text',
				'priority'	  => 14
			)
		);

		$wp_customize->add_control(
			'stackoverflow',
			array(
				'label'       => esc_html__( 'Stack Overflow URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_stackoverflow',
				'type'        => 'text',
				'priority'	  => 15
			)
		);

		$wp_customize->add_control(
			'deviantart',
			array(
				'label'       => esc_html__( 'DeviantART URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_deviantart',
				'type'        => 'text',
				'priority'	  => 16
			)
		);

		$wp_customize->add_control(
			'behance',
			array(
				'label'       => esc_html__( 'Behance URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_behance',
				'type'        => 'text',
				'priority'	  => 17
			)
		);

		$wp_customize->add_control(
			'delicious',
			array(
				'label'       => esc_html__( 'Delicious URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_delicious',
				'type'        => 'text',
				'priority'	  => 18
			)
		);

		$wp_customize->add_control(
			'soundcloud',
			array(
				'label'       => esc_html__( 'SoundCloud URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_soundcloud',
				'type'        => 'text',
				'priority'	  => 19
			)
		);

		$wp_customize->add_control(
			'spotify',
			array(
				'label'       => esc_html__( 'Spotify URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_spotify',
				'type'        => 'text',
				'priority'	  => 20
			)
		);

		$wp_customize->add_control(
			'stumbleupon',
			array(
				'label'       => esc_html__( 'StumbleUpon URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_stumbleupon',
				'type'        => 'text',
				'priority'	  => 21
			)
		);

		$wp_customize->add_control(
			'reddit',
			array(
				'label'       => esc_html__( 'Reddit URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_reddit',
				'type'        => 'text',
				'priority'	  => 22
			)
		);

		$wp_customize->add_control(
			'vine',
			array(
				'label'       => esc_html__( 'Vine URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_vine',
				'type'        => 'text',
				'priority'	  => 23
			)
		);

		$wp_customize->add_control(
			'digg',
			array(
				'label'       => esc_html__( 'Digg URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_digg',
				'type'        => 'text',
				'priority'	  => 24
			)
		);

		$wp_customize->add_control(
			'vk',
			array(
				'label'       => esc_html__( 'VK URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_vk',
				'type'        => 'text',
				'priority'	  => 25
			)
		);

		$wp_customize->add_control(
			'rss',
			array(
				'label'       => esc_html__( 'RSS URL:', 'canos' ),
				'section'     => 'canos_new_section_social_header',
				'settings'    => 'canos_opt_rss',
				'type'        => 'text',
				'priority'	  => 26
			)
		);

	/*--------------------------------------------------------------
	Footer Settings
	--------------------------------------------------------------*/

	$wp_customize->add_section( 'canos_new_section_footer',
		array(
		'title'      => esc_html__( 'Footer Settings', 'canos' ),
		'description'=> '',
		'priority'   => 59
	) );

		/*---- settings ----*/

		$wp_customize->add_setting(
			'canos_opt_footer_logo',
			array(
				'default'           => '1',
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_hide_footer_menu',
			array(
				'sanitize_callback' => 'canos_sanitize_checkbox'
			)
		);

		$wp_customize->add_setting(
			'canos_opt_footer_text',
			array(
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		/*---- controls ----*/

		$wp_customize->add_control(
			'footer_logo',
			array(
				'label'       => esc_html__( 'Display logo', 'canos' ),
				'section'     => 'canos_new_section_footer',
				'settings'    => 'canos_opt_footer_logo',
				'type'        => 'checkbox',
				'priority'	  => 1
			)
		);

		$wp_customize->add_control(
			'footer_menu',
			array(
				'label'       => esc_html__( 'Hide menu', 'canos' ),
				'section'     => 'canos_new_section_footer',
				'settings'    => 'canos_opt_hide_footer_menu',
				'type'        => 'checkbox',
				'priority'	  => 2
			)
		);

		$wp_customize->add_control(
			'footer_text',
			array(
				'label'       => esc_html__( 'Footer text', 'canos' ),
				'section'     => 'canos_new_section_footer',
				'settings'    => 'canos_opt_footer_text',
				'type'        => 'textarea',
				'priority'	  => 3
			)
		);

	/*--------------------------------------------------------------
	MailChimp
	--------------------------------------------------------------*/

	$wp_customize->add_section( 'canos_new_section_mailchimp',
		array(
			'title'      => esc_html__( 'MailChimp', 'canos' ),
			'description'=> '',
			'priority'   => 60
	) );

		/*---- settings ----*/

		$wp_customize->add_setting(
			'canos_opt_mailchimp_api',
			array(
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		/*---- controls ----*/

		$wp_customize->add_control(
			'mailchimp',
			array(
				'label'       => esc_html__( 'MailChimp API key', 'canos' ),
				'description' => sprintf( wp_kses( __( 'Enter your MailChimp API key here (<a href="%s" title="Where can I find my API key?">Where can I find my API key?</a>)', 'canos' ), array( 'a' => array( 'href' => array() ) ) ), 'http://kb.mailchimp.com/article/where-can-i-find-my-api-key' ),
				'section'     => 'canos_new_section_mailchimp',
				'settings'    => 'canos_opt_mailchimp_api',
				'type'        => 'text',
				'priority'	  => 1
			)
		);

}
add_action( 'customize_register', 'canos_customize_register' );

/**
 * Sanitize checkboxes
 */
function canos_sanitize_checkbox( $input ) {
	return ( 1 == $input ) ? 1 : '';
}

/**
 * Sanitize layout radio
 */
function canos_sanitize_layout( $input ) {
	$whitelist = array(
		'right-sidebar grid-modules',
		'left-sidebar grid-modules',
		'no-sidebar grid-modules',
		'right-sidebar full-modules',
		'left-sidebar full-modules',
		'no-sidebar full-modules'
	);

	if ( in_array( $input, $whitelist ) ) {
		return $input;
	} else {
		return 'right-sidebar full-modules';
	}
}

/**
 * Sanitize layout (post/page) radio
 */
function canos_sanitize_layout_single( $input ) {
	$whitelist = array(
		'right-sidebar',
		'left-sidebar',
		'no-sidebar'
	);

	if ( in_array( $input, $whitelist ) ) {
		return $input;
	} else {
		return 'right-sidebar';
	}
}

/**
 * Sanitize excerpt radio
 */
function canos_sanitize_excerpt( $input ) {
	$whitelist = array(
		'content',
		'excerpt',
		'excerpt+more'
	);

	if ( in_array( $input, $whitelist ) ) {
		return $input;
	} else {
		return 'content';
	}
}

/**
 * Sanitize font
 */
function canos_sanitize_font( $input ) {
	$whitelist = array(
		'Abel',
		'Arimo',
		'Arvo',
		'Asap',
		'Bitter',
		'Bree+Serif',
		'Cabin+Condensed',
		'Cabin',
		'Chivo',
		'Cuprum',
		'Dosis',
		'Droid+Sans',
		'Droid+Serif',
		'Exo',
		'Francois+One',
		'Inconsolata',
		'Josefin+Sans',
		'Karla',
		'Lato',
		'Lora',
		'Maven+Pro',
		'Merriweather',
		'Montserrat',
		'Muli',
		'Nunito',
		'Open+Sans+Condensed',
		'Open+Sans',
		'Oswald',
		'Playfair+Display',
		'PT+Sans+Narrow',
		'PT+Sans',
		'PT+Serif+Caption',
		'PT+Serif',
		'Questrial',
		'Quicksand',
		'Raleway',
		'Roboto',
		'Roboto+Condensed',
		'Roboto+Slab',
		'Rokkitt',
		'Signika',
		'Slabo',
		'Source+Sans+Pro',
		'Ubuntu+Condensed',
		'Ubuntu',
		'Varela+Round',
		'Vollkorn'
	);

	if ( in_array( $input, $whitelist ) ) {
		return $input;
	} else {
		return 'Inconsolata';
	}
}
