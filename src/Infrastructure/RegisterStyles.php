<?php
/**
 * RegisterStyles class file.
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
 * Class RegisterStyles
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
class RegisterStyles implements ConfigurableInterface, HookableInterface {

	use ConfigAwareTrait;

	/**
	 * RegisterStyles constructor.
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
			new Action( 'wp_enqueue_scripts', static::class, 'register_styles' ),
		];
	}

	/**
	 * Register Styles.
	 */
	public function register_styles() {
		if ( ! $this->config->has( static::class ) ) {
			return;
		}

		foreach ( $this->config->get( static::class ) as $style ) {
			if ( empty( $style['handle'] ) || \wp_style_is( $style['handle'], 'registered' ) ) {
				continue;
			}

			\wp_register_style(
				$style['handle'],
				( isset( $style['src'] ) ) ? $style['src'] : '',
				( isset( $style['deps'] ) ) ? $style['deps'] : [],
				( isset( $style['ver'] ) ) ? $style['ver'] : false,
				( isset( $style['media'] ) ) ? $style['media'] : 'all'
			);
		}
	}
}
