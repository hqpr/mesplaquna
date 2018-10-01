<?php

/**
 * Plugin Name:       Canos Framework
 * Plugin URI:        http://demo.lollum.com/canos/
 * Description:       Extra functionality for the Canos theme.
 * Version:           1.2.0
 * Author:            Lollum
 * Author URI:        http://lollum.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       canos-framework
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-canos-framework.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_canos_framework() {

	$plugin = new Canos_Framework();
	$plugin->run();

}
run_canos_framework();
