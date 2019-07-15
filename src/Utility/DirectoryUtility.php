<?php
/**
 * DirectoryUtility class file.
 *
 * @package TwisterMc\TWSearch\Utility
 */

namespace TwisterMc\TWSearch\Utility;

use TwisterMc\TWSearch\{
	Utility\FileUtility
};

/**
 * Class DirectoryUtility
 *
 * @package TwisterMc\TWSearch\Utility
 */
class DirectoryUtility {

	/**
	 * Get the filesystem directory path (with trailing slash) for the plugin.
	 *
	 * @return string
	 */
	public static function get_plugin_dir_path(): string {
		return \plugin_dir_path( FileUtility::get_bootstrap_file() );
	}

	/**
	 * Get the filesystem directory path (with trailing slash) for the plugin's config directory.
	 *
	 * @return string
	 */
	public static function get_plugin_config_path(): string {
		return \trailingslashit( self::get_plugin_dir_path() . 'config' );
	}

	/**
	 * Get the relative path to to this plugin's directory from the WP plugins directory.
	 *
	 * @return string
	 */
	public static function get_plugin_rel_path() {
		return trailingslashit( \dirname( FileUtility::get_plugin_basename() ) );
	}

	/**
	 * Get the relative path to the plugin's languages directory.
	 *
	 * @return string
	 */
	public static function get_plugin_languages_rel_path() {
		return \trailingslashit( self::get_plugin_rel_path() . 'languages' );
	}
}
