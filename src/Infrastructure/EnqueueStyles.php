<?php
/**
 * EnqueueStyles class file.
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
 * Class EnqueueStyles
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
class EnqueueStyles implements ConfigurableInterface, HookableInterface {

	use ConfigAwareTrait;

	/**
	 * EnqueueStyles constructor.
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

		$this->set_config( new Config( require $config_file ) );
	}

	/**
	 * Get hooks for the class.
	 *
	 * @return array|null
	 */
	public static function get_hooks(): ?array {
		return [
			new Action( 'wp_enqueue_scripts', static::class, 'enqueue_styles', 20 ),
		];
	}

	/**
	 * Enqueue Styles.
	 */
	public function enqueue_styles() {
		if ( null === $this->config || ! $this->config->has( static::class ) ) {
			return;
		}

		foreach ( $this->config->get( static::class ) as $style ) {
			if ( empty( $style['handle'] ) || \wp_style_is( $style['handle'], 'enqueued' ) ) {
				continue;
			}

			\wp_enqueue_style(
				$style['handle'],
				( isset( $style['src'] ) ) ? $style['src'] : '',
				( isset( $style['deps'] ) ) ? $style['deps'] : [],
				( isset( $style['ver'] ) ) ? $style['ver'] : false,
				( isset( $style['media'] ) ) ? $style['media'] : 'all'
			);
		}
	}
}
