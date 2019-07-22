<?php
/**
 * LoadPluginTextDomain class file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

use TwisterMc\TWSearch\{
	Infrastructure\Config,
	Infrastructure\ConfigAwareTrait,
	Infrastructure\ConfigurableInterface,
	Infrastructure\HookableInterface,
	Infrastructure\View\TemplatedView,
	Utility\DirectoryUtility
};

use TwisterMc\TWSearch\Vendor\{
	TypistTech\WPContainedHook\Hooks\Action
};

/**
 * Class LoadPluginTextDomain
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
class LoadPluginTextDomain implements ConfigurableInterface, HookableInterface {

	use ConfigAwareTrait;

	/**
	 * LoadPluginTextDomain constructor.
	 */
	public function __construct() {
		$this->configure();
	}

	/**
	 * Configure this class.
	 */
	public function configure(): void {
		$config_file = DirectoryUtility::get_plugin_config_path() . basename( __FILE__ );

		if ( ! is_readable( $config_file ) ) {
			return;
		}

		$this->set_config( new Config( $config_file ) );
	}

	/**
	 * Get hooks for the class.
	 *
	 * @return array|null
	 */
	public static function get_hooks(): ?array {
		return [
			new Action( 'plugins_loaded', static::class, 'load_plugin_textdomain' ),
		];
	}

	/**
	 * Load plugin text domain.
	 */
	public function load_plugin_textdomain() {
		if ( null === $this->config || ! $this->config->has( static::class ) ) {
			return;
		}

		if ( empty( $this->config->get( static::class )['domain'] ) ) {
			return;
		}

		\load_plugin_textdomain(
			$this->config->get( static::class )['domain'],
			false,
			DirectoryUtility::get_plugin_languages_rel_path()
		);
	}
}
