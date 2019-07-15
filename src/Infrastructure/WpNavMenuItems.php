<?php
/**
 * WpNavMenuItems class file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

use TwisterMc\TWSearch\{
	Infrastructure\Config,
	Infrastructure\ConfigAwareTrait,
	Infrastructure\ConfigurableInterface,
	Infrastructure\HookableInterface,
	Infrastructure\View\TemplatedView,
	Utility\DirectoryUtility,
	Utility\NavMenuUtility
};

use TwisterMc\TWSearch\Vendor\{
	TypistTech\WPContainedHook\Hooks\Filter
};

use \stdClass;

/**
 * Class WpNavMenuItems
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
class WpNavMenuItems implements HookableInterface {

	/**
	 * WpNavMenuItems constructor.
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
			new Filter( 'wp_nav_menu_items', static::class, 'wp_nav_menu_items', 999, 2 ),
		];
	}

	/**
	 * Add search link menu item.
	 *
	 * @param string    $items The HTML list content for the menu items.
	 * @param \stdClass $args  An object containing wp_nav_menu() arguments.
	 *
	 * @return string
	 */
	public function wp_nav_menu_items( $items, $args ) {

		/**
		 * Don't affect in admin, unless it's customizer.
		 */
		if ( \is_admin() && ! \is_customize_preview() ) {
			return $items;
		}

		/**
		 * The "menu slug" that was chosen in Customizer.
		 *
		 * @var string $tw_search_location
		 */
		$tw_search_location = \get_theme_mod( 'twSearch_location' );

		if ( empty( $tw_search_location ) ) {
			return $items;
		}

		/**
		 * False if $menu param isn't supplied or term does not exist, menu object if successful.
		 *
		 * Example "nav menu object" (really just a WP_Term)...
		 *     $menu = WP_Term Object (
		 *         [term_id]          => 2
		 *         [name]             => Main Menu
		 *         [slug]             => main-menu
		 *         [term_group]       => 0
		 *         [term_taxonomy_id] => 2
		 *         [taxonomy]         => nav_menu
		 *         [description]      =>
		 *         [parent]           => 0
		 *         [count]            => 11
		 *         [filter]           => raw
		 *     )
		 *
		 * @var WP_Term|false $menu
		 */
		$menu = \wp_get_nav_menu_object( $args->menu );

		if ( false === $menu || empty( $menu->slug ) || $menu->slug !== $tw_search_location ) {
			return $items;
		}

		/**
		 * The "display setting" that was chosen in Customizer.
		 *
		 * @var string $tw_search_display
		 */
		$tw_search_display = \get_theme_mod( 'twSearch_display' );

		if ( empty( $tw_search_display ) ) {
			$tw_search_display = 'icon';
		}

		/**
		 * The opening wrapper element for the search nav menu item.
		 *
		 * @var string $item_opening_wrapper
		 */
		$item_opening_wrapper = '<li class="twSearch">';

		/**
		 * Filters the opening wrapper element.
		 *
		 * Not every walker uses <li> for an opening menu item wrapper.
		 *
		 * @param string    $item_opening_wrapper The opening HTML wrapper element.
		 * @param string    $items                The HTML list content for the menu items.
		 * @param \stdClass $args                 An object containing wp_nav_menu() arguments.
		 */
		$item_opening_wrapper = \apply_filters(
			'tw_search_menu_item_opening_wrapper',
			$item_opening_wrapper,
			$items,
			$args
		);

		/**
		 * The closing wrapper element for the search nav menu item.
		 *
		 * @var string $item_closing_wrapper
		 */
		$item_closing_wrapper = '</li>';

		/**
		 * Filters the closing wrapper element.
		 *
		 * Not every walker uses </li> for a closing menu item wrapper.
		 *
		 * @param string    $item_closing_wrapper The closing HTML wrapper element.
		 * @param string    $item_opening_wrapper The opening HTML wrapper element.
		 * @param string    $items                The HTML list content for the menu items.
		 * @param \stdClass $args                 An object containing wp_nav_menu() arguments.
		 */
		$item_closing_wrapper = \apply_filters(
			'tw_search_menu_item_closing_wrapper',
			$item_closing_wrapper,
			$item_opening_wrapper,
			$items,
			$args
		);

		switch ( $tw_search_display ) {
			case 'icon':
				$item = '<a href="#" class="js-twSearch twSearchIcon"><span class="dashicons dashicons-search"></span><span class="screen-reader-text">' . __( 'Search', 'tw-search' ) . '</span></a>';
				break;
			case 'word':
				$item = '<a href="#" class="js-twSearch">' . __( 'Search', 'tw-search' ) . '</a>';
				break;
			case 'both':
				$item = '<a href="#" class="js-twSearch twSearchIcon"><span class="dashicons dashicons-search"></span> ' . __( 'Search', 'tw-search' ) . '</a>';
				break;
		}

		/**
		 * Filters the search menu item element.
		 *
		 * @param string    $item                 The search menu item element.
		 * @param string    $item_opening_wrapper The opening HTML wrapper element.
		 * @param string    $item_closing_wrapper The closing HTML wrapper element.
		 * @param string    $items                The HTML list content for the menu items.
		 * @param \stdClass $args                 An object containing wp_nav_menu() arguments.
		 */
		$item = \apply_filters(
			'tw_search_menu_item',
			$item,
			$item_opening_wrapper,
			$item_closing_wrapper,
			$items,
			$args
		);

		$items .= $item_opening_wrapper . $item . $item_closing_wrapper;

		/**
		 * Filters the HTML list content for navigation menus after we've appended our search menu item.
		 *
		 * Last chance to alter the output before it's returned to wp_nav_menu.
		 *
		 * @param string    $items                The HTML list content for the menu items.
		 * @param \stdClass $args                 An object containing wp_nav_menu() arguments.
		 * @param string    $item_opening_wrapper The opening HTML wrapper element.
		 * @param string    $item                 The search menu item element.
		 * @param string    $item_closing_wrapper The closing HTML wrapper element.
		 */
		$items = \apply_filters(
			'tw_search_menu_items',
			$items,
			$args,
			$item_opening_wrapper,
			$item,
			$item_closing_wrapper
		);

		return $items;
	}
}
