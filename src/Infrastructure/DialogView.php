<?php
/**
 * DialogView class file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

use TwisterMc\TWSearch\{
	Infrastructure\HookableInterface,
	Infrastructure\View\TemplatedView,
	Utility\DirectoryUtility
};

use TwisterMc\TWSearch\Vendor\{
	TypistTech\WPContainedHook\Hooks\Action
};

/**
 * Class DialogView
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
class DialogView implements HookableInterface {

	/**
	 * DialogView constructor.
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
			new Action( 'wp_footer', static::class, 'print_dialog_view' ),
		];
	}

	/**
	 * Print the search dialog markup.
	 */
	public function print_dialog_view() {
		$view = new TemplatedView( 'tw_search_', DirectoryUtility::get_plugin_dir_path() );
		$view->get_template_part( 'tw-search-form' );
	}
}
