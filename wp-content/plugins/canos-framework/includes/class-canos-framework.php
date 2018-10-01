<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @since      1.0.0
 *
 * @package    Canos_Framework
 * @subpackage Canos_Framework/includes
 */

class Canos_Framework {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Canos_Framework_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $canos_framework    The string used to uniquely identify this plugin.
	 */
	protected $canos_framework;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->canos_framework = 'canos-framework';
		$this->version = '1.2.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Canos_Framework_Loader. Orchestrates the hooks of the plugin.
	 * - Canos_Framework_i18n. Defines internationalization functionality.
	 * - Canos_Framework_Admin. Defines all hooks for the dashboard.
	 * - Canos_Framework_Public. Defines all hooks for the public side of the site.
	 * - Drewm_MailChimp. MailChimp API v2 wrapper.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-canos-framework-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-canos-framework-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the Dashboard.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-canos-framework-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-canos-framework-public.php';

		/**
		 * MailChimp API v2 wrapper
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-canos-framework-mailchimp.php';

		$this->loader = new Canos_Framework_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Canos_Framework_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Canos_Framework_i18n();
		$plugin_i18n->set_domain( $this->get_canos_framework() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Canos_Framework_Admin( $this->get_canos_framework(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		if ( ! get_theme_mod( 'canos_opt_disable_views' ) ) {
			$this->loader->add_filter( 'manage_posts_columns', $plugin_admin, 'manage_posts_columns' );
			$this->loader->add_action( 'manage_posts_custom_column', $plugin_admin, 'manage_posts_custom_column', 10, 2 );
		}
		
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'display_meta_boxes', 10, 2 );
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_meta_boxes', 10, 2 );
		
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Canos_Framework_Public( $this->get_canos_framework(), $this->get_version() );

		$this->loader->add_action( 'canos_post_sharer', $plugin_public, 'sharer', 10, 2 );

		/* Check if the post view counter is enabled */
		if ( ! get_theme_mod( 'canos_opt_disable_views' ) ) {
			$this->loader->add_action( 'canos_update_post_views', $plugin_public, 'update_post_views', 10, 2 );
			$this->loader->add_action( 'canos_display_post_views', $plugin_public, 'show_post_views', 10, 2 );
		}

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_ajax_canos_framework_mailchimp_form', $plugin_public, 'mailchimp_form', 10, 2 );
		$this->loader->add_action( 'wp_ajax_nopriv_canos_framework_mailchimp_form', $plugin_public, 'mailchimp_form', 10, 2 );

		/* Column shortcode */

		$this->loader->add_shortcode( 'canos_column', $plugin_public, 'column', 10, 2 );
		$this->loader->add_filter( 'the_content', $plugin_public, 'clean_shortcodes', 10, 2 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_canos_framework() {
		return $this->canos_framework;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Canos_Framework_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
