<?php
/**
 * Plugin class file.
 *
 * @package TwisterMc\TWSearch
 */

namespace TwisterMc\TWSearch;

use TwisterMc\TWSearch\{
	Infrastructure\ActivateableInterface,
	Infrastructure\Config,
	Infrastructure\ConfigAwareTrait,
	Infrastructure\ConfigurableInterface,
	Infrastructure\DeactivateableInterface,
	Infrastructure\LoaderAwareTrait,
	Infrastructure\RegisterableInterface,
	Utility\ConditionalUtility,
	Utility\DirectoryUtility
};

use TwisterMc\TWSearch\Vendor\{
	League\Container\Container,
	TypistTech\WPContainedHook\ContainerAwareTrait,
	TypistTech\WPContainedHook\Loader
};

/**
 * Class Plugin
 *
 * @package TwisterMc\TWSearch
 */
class Plugin implements ActivateableInterface, DeactivateableInterface, RegisterableInterface, ConfigurableInterface {

	use ContainerAwareTrait;
	use ConfigAwareTrait;
	use LoaderAwareTrait;

	/**
	 * Plugin constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->configure();
		$this->add_dependencies();
	}

	/**
	 * Add dependencies to the container.
	 *
	 * @return void
	 */
	public function add_dependencies() {
		$this->container = new Container();

		$this->hook_loader = new Loader( $this->container );

		if ( null === $this->config || ! $this->config->has( static::class ) ) {
			return;
		}

		$dependencies = $this->config->get( static::class )['dependencies'];

		foreach ( $dependencies as $dependency ) {
			$this->container->add( $dependency );
			if ( ConditionalUtility::is_hookable( $dependency ) ) {
				$this->hook_loader->add( ...$dependency::get_hooks() );
			}
		}
	}

	/**
	 * Configure the plugin.
	 *
	 * @return void
	 */
	public function configure(): void {
		$config_file = DirectoryUtility::get_plugin_config_path() . basename( __FILE__ );

		if ( ! is_readable( $config_file ) ) {
			return;
		}

		$this->set_config( new Config( require $config_file ) );
	}

	/**
	 * Activate the plugin.
	 *
	 * @return void
	 */
	public function activate(): void {
		\flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin.
	 *
	 * @return void
	 */
	public function deactivate(): void {
		\flush_rewrite_rules();
	}

	/**
	 * Hook the plugin into the WordPress request lifecycle.
	 *
	 * @return void
	 */
	public function register(): void {
		$this->hook_loader->run();
	}
}
