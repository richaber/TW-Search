<?php
/**
 * EnqueueScripts class file.
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
 * Class EnqueueScripts
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
class EnqueueScripts implements ConfigurableInterface, HookableInterface {

	use ConfigAwareTrait;

	/**
	 * EnqueueScripts constructor.
	 */
	public function __construct() {
		$this->configure();
	}

	/**
	 * Configure this class.
	 */
	public function configure(): void {
		$this->set_config( new Config( require DirectoryUtility::get_plugin_config_path() . basename( __FILE__ ) ) );
	}

	/**
	 * Get hooks for the class.
	 *
	 * @return array|null
	 */
	public static function get_hooks(): ?array {
		return [
			new Action( 'wp_enqueue_scripts', static::class, 'enqueue_scripts', 20 ),
		];
	}

	/**
	 * Enqueue Scripts.
	 */
	public function enqueue_scripts() {
		if ( ! $this->config->has( static::class ) ) {
			return;
		}

		foreach ( $this->config->get( static::class ) as $script ) {
			if ( empty( $script['handle'] ) || \wp_script_is( $script['handle'], 'enqueued' ) ) {
				continue;
			}

			\wp_enqueue_script(
				$script['handle'],
				( isset( $script['src'] ) ) ? $script['src'] : '',
				( isset( $script['deps'] ) ) ? $script['deps'] : [],
				( isset( $script['ver'] ) ) ? $script['ver'] : false,
				( isset( $script['in_footer'] ) ) ? $script['in_footer'] : false
			);
		}
	}
}
