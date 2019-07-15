<?php
/**
 * DeactivateableInterface interface file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

/**
 * Interface DeactivateableInterface
 *
 * Something that can be deactivated.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
interface DeactivateableInterface {

	/**
	 * Deactivate the plugin.
	 *
	 * @return void
	 */
	public function deactivate(): void;
}
