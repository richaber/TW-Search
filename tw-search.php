<?php
/**
 * Plugin Name:       TW Search
 * Plugin URI:        https://www.twistermc.com/43150/tw-search-overlay-for-wordpress/
 * Description:       Adds a search icon to menu and displays search input in an overlay.
 * Version:           0.4
 * Author:            Thomas McMahon
 * Author URI:        http://www.twistermc.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tw-search
 * Domain Path:       /languages
 * GitHub Plugin URI: TwisterMc/TW-Search
 *
 * @package   TwisterMc\TWSearch
 */

namespace TwisterMc\TWSearch;

use TwisterMc\TWSearch\PluginFactory;

/**
 * Exit early if directly accessed via URL.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The plugin version.
 *
 * This should match the version string in the plugin bootstrap header.
 * If you update the version number in the plugin header, update this constant to match, and vice versa.
 *
 * @var string TWS_VERSION
 */
define( 'TWS_VERSION', '0.4' );

/**
 * The full path and filename of this plugin file with symlinks resolved.
 *
 * @var string TWS_FILE
 */
define( 'TWS_FILE', __FILE__ );


/**
 * Full path to the Composer generated autoloader.
 */
$tw_search_autoloader = __DIR__ . '/vendor/autoload.php';

/**
 * Return if the autoloader is not readable.
 */
if ( ! \is_readable( $tw_search_autoloader ) ) {
	return;
}

/**
 * Require the autoloader.
 */
require $tw_search_autoloader;

/**
 * Create the plugin.
 */
$tw_search_plugin = PluginFactory::create();

/**
 * Activation hook must be static.
 */
\register_activation_hook(
	__FILE__,
	function () use ( $tw_search_plugin ) {
		$tw_search_plugin->activate();
	}
);

/**
 * Deactivation hook must be static.
 */
\register_deactivation_hook(
	__FILE__,
	function () use ( $tw_search_plugin ) {
		$tw_search_plugin->deactivate();
	}
);

/**
 * Run the plugin.
 */
$tw_search_plugin->register();
