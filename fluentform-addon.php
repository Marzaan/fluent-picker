<?php

/**
 * The plugin bootstrap file
 * @link              https://#
 * @since             1.0.0
 * @package           fluentform-addon
 *
 * @wordpress-plugin
 * Plugin Name:       FF Addon
 * Plugin URI:        https://#
 * Description:       This is an addon of fluentform.
 * Version:           1.0.0
 * Author:            Raiyan Marzan
 * Author URI:        https://#
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fluentform-addon
 * Domain Path:       /languages
 */

use FF_Addon\FluentFormAddon;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

defined( 'FFA_DIR_PATH' ) or define( 'FFA_DIR_PATH', plugin_dir_path(__FILE__));

/**
 * Begins execution of the plugin.
*/
require FFA_DIR_PATH . 'includes/FluentFormAddon.php';

// Initialization
function run_fluent_form_addon() {
    $ff_addon = new FluentFormAddon();
}
add_action('fluentform/loaded', 'run_fluent_form_addon');

?>