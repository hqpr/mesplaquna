<?php
/**
 * About setup
 *
 * @package Perfect Magazine
 */

if ( ! function_exists( 'perfect_magazine_about_setup' ) ) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function perfect_magazine_about_setup() {

		$config = array(

			// Welcome content.
			'welcome_content' => sprintf( esc_html__( ' First off, We’d like to extend a warm welcome and thank you for choosing %1$s. %1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Again, Thanks for using our theme!', 'perfect-magazine' ), 'Perfect Magazine' ),

			// Tabs.
			'tabs' => array(
				'getting-started' => esc_html__( 'Getting Started', 'perfect-magazine' ),
				'support'         => esc_html__( 'Support', 'perfect-magazine' ),
				'useful-plugins'  => esc_html__( 'Useful Plugins', 'perfect-magazine' ),
				'demo-content'    => esc_html__( 'Demo Content', 'perfect-magazine' ),
				),

			// Quick links.
			'quick_links' => array(
				'theme_url' => array(
					'text' => esc_html__( 'Theme Details', 'perfect-magazine' ),
					'url'  => 'https://thememattic.com/theme/perfect-magazine/',
					),
				'demo_url' => array(
					'text' => esc_html__( 'View Demo', 'perfect-magazine' ),
					'url'  => 'https://thememattic.com/theme-demos/?demo=perfect-magazine',
					),
				'documentation_url' => array(
					'text'   => esc_html__( 'View Documentation', 'perfect-magazine' ),
					'url'    => 'https://docs.thememattic.com/themes/perfect-magazine/',
					'button' => 'primary',
					),
				),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'perfect-magazine' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'perfect-magazine' ),
					'button_text' => esc_html__( 'View Documentation', 'perfect-magazine' ),
					'button_url'  => 'https://docs.thememattic.com/themes/perfect-magazine/',
					'button_type' => 'primary',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Static Front Page', 'perfect-magazine' ),
					'icon'        => 'dashicons dashicons-admin-generic',
					'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'perfect-magazine' ),
					'button_text' => esc_html__( 'Static Front Page', 'perfect-magazine' ),
					'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Theme Options', 'perfect-magazine' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'perfect-magazine' ),
					'button_text' => esc_html__( 'Customize', 'perfect-magazine' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'four' => array(
					'title'       => esc_html__( 'Widget Ready', 'perfect-magazine' ),
					'icon'        => 'dashicons dashicons-admin-settings',
					'description' => esc_html__( 'Perfect Magazine is widget based Theme. Perfect Magazine has 7 predesigned custome additional layout.', 'perfect-magazine' ),
					'button_text' => esc_html__( 'View Widgets', 'perfect-magazine' ),
					'button_url'  => admin_url( 'widgets.php' ),
					'button_type' => 'secondary',
					),
				'five' => array(
					'title'       => esc_html__( 'Demo Content', 'perfect-magazine' ),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf( esc_html__( '%1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'perfect-magazine' ), esc_html__( 'One Click Demo Import', 'perfect-magazine' ) ),
					'button_text' => esc_html__( 'Demo Content', 'perfect-magazine' ),
					'button_url'  => admin_url( 'themes.php?page=perfect-magazine-about&tab=demo-content' ),
					'button_type' => 'secondary',
					),
				'six' => array(
					'title'       => esc_html__( 'Theme Preview', 'perfect-magazine' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'perfect-magazine' ),
					'button_text' => esc_html__( 'View Demo', 'perfect-magazine' ),
					'button_url'  => 'https://thememattic.com/theme-demos/?demo=perfect-magazine',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				),

			// Support.
			'support' => array(
				'one' => array(
					'title'       => esc_html__( 'Contact Support', 'perfect-magazine' ),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'perfect-magazine' ),
					'button_text' => esc_html__( 'Contact Support', 'perfect-magazine' ),
					'button_url'  => 'https://wordpress.org/support/theme/perfect-magazine/',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Theme Documentation', 'perfect-magazine' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'perfect-magazine' ),
					'button_text' => esc_html__( 'View Documentation', 'perfect-magazine' ),
					'button_url'  => 'https://docs.thememattic.com/themes/perfect-magazine/',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				'three' => array(
					'title'       => esc_html__( 'Child Theme', 'perfect-magazine' ),
					'icon'        => 'dashicons dashicons-admin-tools',
					'description' => esc_html__( 'For advanced theme customization, it is recommended to use child theme rather than modifying the theme file itself.', 'perfect-magazine' ),
					'button_text' => esc_html__( 'Learn More', 'perfect-magazine' ),
					'button_url'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
					'button_type' => 'secondary',
					'is_new_tab'  => true,
					),
				),

			// Useful plugins.
			'useful_plugins' => array(
				'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'perfect-magazine' ),
				),

			// Demo content.
			'demo_content' => array(
				'description' => sprintf( esc_html__( 'To import demo content for this theme, %1$s plugin is needed. Please make sure plugin is installed and activated. After plugin is activated, you will see Import Demo Data menu under Appearance.', 'perfect-magazine' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'perfect-magazine' ) . '</a>' ),
				),

			// Upgrade to pro.
			'upgrade_to_pro' => array(
				'description' => esc_html__( 'You can upgrade to pro version of the theme for more exciting features.', 'perfect-magazine' ),
				'button_text' => esc_html__( 'Upgrade to Pro','perfect-magazine' ),
				'button_url'  => 'https://thememattic.com/theme/perfect-magazine/',
				'button_type' => 'primary',
				'is_new_tab'  => true,
				),
			);

		Perfect_Magazine_About::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'perfect_magazine_about_setup' );
