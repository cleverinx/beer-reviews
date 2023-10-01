<?php
/**
 * Plugin Name:       Untappd Beer Reviews
 * Plugin URI:        https://tbkcreative.com
 * Description:       Show beer information & latest beer reviews from untapped API
 * Version:           1.0
 * Author:            Dave Randhawa
 * Author URI:        http://tbkcreative.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       beer-reviews
 * Domain Path:       /languages
 */

namespace Beer_Reviews;

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// The class that contains the plugin info.
require_once plugin_dir_path(__FILE__) . 'includes/class-info.php';

/**
 * The code that runs during plugin activation.
 */
function activation() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-activator.php';
    Activator::activate();
}
register_activation_hook(__FILE__, __NAMESPACE__ . '\\activation');



/**
 * Run the plugin.
 */
function run() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-plugin.php';
    $plugin = new Plugin();
    $plugin->run();
}
run();
