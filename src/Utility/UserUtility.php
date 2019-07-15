<?php
/**
 * UserUtility class file.
 *
 * @package TwisterMc\TWSearch\Utility
 */

namespace TwisterMc\TWSearch\Utility;

/**
 * Class UserUtility
 *
 * @package TwisterMc\TWSearch\Utility
 */
class UserUtility {

	/**
	 * Get users for a select menu.
	 *
	 * @param array  $args             Array of arguments for get_users.
	 * @param string $show_option_none The text to use for the first empty "select" item.
	 *
	 * @return array
	 */
	public static function get_users_for_select_menu( $args = [], $show_option_none = '' ): array {
		if ( empty( $show_option_none ) ) {
			$show_option_none = __( '-- Select --', 'tw-search' );
		}

		$select_items = [
			'0' => $show_option_none,
		];


		/**
		 * Define the array of defaults
		 */
		$defaults = [
			'orderby'      => 'display_name',
			'order'        => 'ASC',
			'include'      => '',
			'exclude'      => '',
			'blog_id'      => \get_current_blog_id(),
			'who'          => '',
			'role'         => '',
			'role__in'     => [
				'administrator',
				'editor',
			],
			'role__not_in' => [],
		];

		/**
		 * Parse incoming $args into an array and merge it with $defaults
		 */
		$args = \wp_parse_args( $args, $defaults );

		$args['fields'] = [
			'ID',
			'display_name',
		];

		$users = \get_users( $args );

		if ( empty( $users ) ) {
			return $select_items;
		}

		$plucked = \wp_list_pluck( $users, 'display_name', 'ID' );

		return $select_items + $plucked;
	}
}
