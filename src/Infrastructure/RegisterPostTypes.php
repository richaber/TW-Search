<?php
/**
 * RegisterPostTypes class file.
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
 * Class RegisterPostTypes
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
class RegisterPostTypes implements ConfigurableInterface, HookableInterface {

	use ConfigAwareTrait;

	/**
	 * RegisterPostTypes constructor.
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
			new Action( 'init', static::class, 'register_post_types', 0 ),
		];
	}

	/**
	 * Register post types.
	 */
	public function register_post_types() {
		if ( ! $this->config->has( static::class ) ) {
			return;
		}

		foreach ( $this->config->get( static::class ) as $register ) {
			if ( empty( $register['post_type'] ) || \post_type_exists( $register['post_type'] ) ) {
				continue;
			}

			\register_post_type(
				$register['post_type'],
				( isset( $register['args'] ) && ! empty( $register['args'] ) ) ? $register['args'] : []
			);
		}
	}
}
