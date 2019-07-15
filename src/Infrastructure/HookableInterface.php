<?php
/**
 * HookableInterface interface file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

/**
 * Interface HookableInterface
 *
 * Something that can be hooked.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
interface HookableInterface {

	/**
	 * Get hooks for the class.
	 *
	 * @return array|null
	 */
	public static function get_hooks(): ?array;
}
