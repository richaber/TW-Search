<?php
/**
 * FileUtility class file.
 *
 * @package TwisterMc\TWSearch\Utility
 */

namespace TwisterMc\TWSearch\Utility;

/**
 * Class FileUtility
 *
 * @package TwisterMc\TWSearch\Utility
 */
class FileUtility {

	/**
	 * Gets the "bootstrap" file of the plugin.
	 *
	 * @return string|null
	 */
	public static function get_bootstrap_file(): ?string {
		return \defined( 'TWS_FILE' ) ? TWS_FILE : null;
	}

	/**
	 * Gets the basename of the plugin.
	 *
	 * Example: "richaber-bb-modules/richaber-bb-modules.php"
	 *
	 * @return string
	 */
	public static function get_plugin_basename(): string {
		return \plugin_basename( self::get_bootstrap_file() );
	}
}
