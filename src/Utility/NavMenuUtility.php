<?php
/**
 * NavMenuUtility class file.
 *
 * @package TwisterMc\TWSearch\Utility
 */

namespace TwisterMc\TWSearch\Utility;

use TwisterMc\TWSearch\Utility\TermsUtility;

/**
 * Class NavMenuUtility
 *
 * @package TwisterMc\TWSearch\Utility
 */
class NavMenuUtility {

	/**
	 * Get the nav menus.
	 *
	 * @param bool $hide_empty Whether to hide empty nav menus or not.
	 *
	 * @return array
	 */
	public static function get_nav_menus( bool $hide_empty = true ): array {
		return TermsUtility::get_terms(
			[
				'taxonomy'   => 'nav_menu',
				'hide_empty' => $hide_empty,
			]
		);
	}
}
