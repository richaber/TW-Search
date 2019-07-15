<?php
/**
 * VersionUtility class file.
 *
 * @package TwisterMc\TWSearch\Utility
 */

namespace TwisterMc\TWSearch\Utility;

/**
 * Class VersionUtility
 *
 * @package TwisterMc\TWSearch\Utility
 */
class VersionUtility {

	/**
	 * Get the plugin version.
	 *
	 * The TWS_VERSION constant should be defined in the plugin bootstrap, else will fall back to '1.0.0'.
	 *
	 * @return string
	 */
	public static function get_plugin_version() {
		return \defined( 'TWS_VERSION' ) ? TWS_VERSION : '1.0.0';
	}
}
