<?php
/**
 * ArrayUtility class file.
 *
 * @package TwisterMc\TWSearch\Utility
 */

namespace TwisterMc\TWSearch\Utility;

/**
 * Class ArrayUtility
 *
 * @package TwisterMc\TWSearch\Utility
 */
class ArrayUtility {

	/**
	 * Filter an array by a array key prefix.
	 *
	 * @param array  $array  The array to filter.
	 * @param string $prefix The prefix to filter by.
	 *
	 * @return array
	 */
	public static function array_filter_by_prefixed_key( $array = [], $prefix = '' ): array {

		if ( empty( $array ) || empty( $prefix ) ) {
			return [];
		}

		$filtered = array_filter(
			$array,
			function ( $key ) use ( $prefix ) {
				return 0 === strpos( $key, $prefix );
			},
			ARRAY_FILTER_USE_KEY
		);

		return $filtered;
	}
}
