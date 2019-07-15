<?php
/**
 * RegisterableInterface interface file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

/**
 * Interface RegisterableInterface
 *
 * Something that can be registered.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
interface RegisterableInterface {

	/**
	 * Register the class.
	 *
	 * @return void
	 */
	public function register(): void;
}
