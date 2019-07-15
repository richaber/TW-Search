<?php
/**
 * ActivateableInterface interface file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

/**
 * Interface ActivateableInterface
 *
 * Something that can be activated.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
interface ActivateableInterface {

	/**
	 * Activate the plugin.
	 *
	 * @return void
	 */
	public function activate(): void;
}
