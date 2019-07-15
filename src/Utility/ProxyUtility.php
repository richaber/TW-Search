<?php
/**
 * ProxyUtility class file.
 *
 * @package TwisterMc\TWSearch\Utility
 */

namespace TwisterMc\TWSearch\Utility;

use TwisterMc\TWSearch\{
	Plugin,
	PluginFactory,
	Config,
	ConfigInterface
};

use TwisterMc\TWSearch\Vendor\{
	Psr\Container\ContainerInterface,
	League\Container\Container,
	TypistTech\WPContainedHook\Loader
};

/**
 * Class ProxyUtility
 *
 * @package TwisterMc\TWSearch\Utility
 */
class ProxyUtility {

	/**
	 * Get the plugin instance from the PluginFactory.
	 *
	 * @return Plugin
	 */
	public static function get_plugin(): Plugin {
		return PluginFactory::create();
	}

	/**
	 * Get the plugin's Config.
	 *
	 * @return ConfigInterface|null
	 */
	public static function get_plugin_config(): ?ConfigInterface {
		$plugin = self::get_plugin();

		return $plugin->get_config();
	}

	/**
	 * Get the plugin's Container.
	 *
	 * @throws ContainerException If no container has been set.
	 *
	 * @return ContainerInterface
	 */
	public static function get_plugin_container(): ContainerInterface {
		$plugin = self::get_plugin();

		return $plugin->getContainer();
	}

	/**
	 * Get the plugin's HookLoader.
	 *
	 * @return Loader|null
	 */
	public static function get_plugin_get_hook_loader(): ?Loader {
		$plugin = self::get_plugin();

		return $plugin->get_hook_loader();
	}
}
