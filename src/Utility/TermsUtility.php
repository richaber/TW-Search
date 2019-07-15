<?php
/**
 * TermsUtility class file.
 *
 * @package TwisterMc\TWSearch\Utility
 */

namespace TwisterMc\TWSearch\Utility;

use \WP_Error;

/**
 * Class TermsUtility
 *
 * @package TwisterMc\TWSearch\Utility
 */
class TermsUtility {

	/**
	 * Retrieve the terms in a given taxonomy or list of taxonomies.
	 *
	 * This is a wrapper on get_terms which does not always return an array.
	 * If you really care about examining an int|\WP_Error return, use Core's get_terms directly.
	 *
	 * @param array $args Optional. Array of arguments.
	 *                    See \WP_Term_Query::__construct() for information on accepted arguments.
	 *                    Default empty.
	 *
	 * @return array
	 */
	public static function get_terms( $args = [] ): array {

		if ( empty( $args ) || ! \is_array( $args ) ) {
			return [];
		}

		/**
		 * List of \WP_Term instances and their children.
		 *
		 * Will return \WP_Error, if any of $taxonomies do not exist.
		 *
		 * @var \WP_Term[]|int|\WP_Error $terms
		 */
		$terms = \get_terms( $args );

		if ( ! \is_array( $terms ) ) {
			return [];
		}

		return $terms;
	}
}
