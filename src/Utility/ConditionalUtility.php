<?php
/**
 * ConditionalUtility class file.
 *
 * @package TwisterMc\TWSearch\Utility
 */

namespace TwisterMc\TWSearch\Utility;

use TwisterMc\TWSearch\{
	Infrastructure\HookableInterface
};

use \ReflectionException;

/**
 * Class ConditionalUtility
 *
 * @package TwisterMc\TWSearch\Utility
 */
class ConditionalUtility {

	/**
	 * Determine if the given class or object is "hookable".
	 *
	 * @param string|object $class_or_object Either a string containing the name of the class to reflect, or an object.
	 *
	 * @return bool
	 */
	public static function is_hookable( $class_or_object ): bool {
		try {
			$reflection_class = new \ReflectionClass( $class_or_object );
		} catch ( ReflectionException $e ) {
			return false;
		}

		return $reflection_class->implementsInterface( HookableInterface::class );
	}
}
