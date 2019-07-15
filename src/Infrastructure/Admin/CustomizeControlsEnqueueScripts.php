<?php
/**
 * CustomizeControlsEnqueueScripts class file.
 *
 * @package TwisterMc\TWSearch\Infrastructure\Admin
 */

namespace TwisterMc\TWSearch\Infrastructure\Admin;

use TwisterMc\TWSearch\{
	Infrastructure\HookableInterface
};

use TwisterMc\TWSearch\Vendor\{
	TypistTech\WPContainedHook\Hooks\Action
};

/**
 * Class CustomizeControlsEnqueueScripts
 *
 * @package TwisterMc\TWSearch\Infrastructure\Admin
 */
class CustomizeControlsEnqueueScripts implements HookableInterface {

	/**
	 * CustomizeControlsEnqueueScripts constructor.
	 */
	public function __construct() {
	}

	/**
	 * Get hooks for the class.
	 *
	 * @return array|null
	 */
	public static function get_hooks(): ?array {
		return [
			new Action( 'customize_controls_enqueue_scripts', static::class, 'customize_controls_enqueue_scripts' ),
		];
	}

	/**
	 * Enqueue scripts and styles specifically for Customizer interface.
	 */
	public function customize_controls_enqueue_scripts() {
		\wp_enqueue_style( 'dashicons' );
	}
}
