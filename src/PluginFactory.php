<?php
/**
 * PluginFactory class file.
 *
 * @package   TwisterMc\TWSearch
 */

namespace TwisterMc\TWSearch;

use TwisterMc\TWSearch\{
	Plugin
};

/**
 * Class PluginFactory
 *
 * The plugin factory is responsible for instantiating the plugin and returning that instance.
 *
 * @package TwisterMc\TWSearch
 */
class PluginFactory {

	/**
	 * PluginFactory constructor.
	 *
	 * @return void
	 */
	public function __construct() {
	}

	/**
	 * Create and return an instance of the plugin.
	 *
	 * This always returns a shared instance.
	 * This way, outside code can always get access to the object instance of the plugin.
	 *
	 * @return Plugin The plugin instance.
	 */
	public static function create(): Plugin {
		static $plugin = null;

		if ( null === $plugin ) {
			$plugin = new Plugin();
		}

		return $plugin;
	}
}
