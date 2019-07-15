<?php
/**
 * UrlUtility class file.
 *
 * @package TwisterMc\TWSearch\Utility
 */

namespace TwisterMc\TWSearch\Utility;

use TwisterMc\TWSearch\{
	Utility\FileUtility
};

/**
 * Class UrlUtility
 *
 * @package TwisterMc\TWSearch\Utility
 */
class UrlUtility {

	/**
	 * Get the URL directory path (with trailing slash) for the plugin.
	 *
	 * @return string
	 */
	public static function get_plugin_dir_url(): string {
		return \plugin_dir_url( FileUtility::get_bootstrap_file() );
	}

	/**
	 * Get the URL directory path (with trailing slash) for the plugin resources directory.
	 *
	 * @return string
	 */
	public static function get_plugin_resources_url(): string {
		return \trailingslashit( self::get_plugin_dir_url() . 'resources' );
	}
}
