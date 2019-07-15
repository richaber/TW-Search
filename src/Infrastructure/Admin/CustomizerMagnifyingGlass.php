<?php
/**
 * CustomizerMagnifyingGlass class file.
 *
 * @package TwisterMc\TWSearch\Infrastructure\Admin
 */

namespace TwisterMc\TWSearch\Infrastructure;

use TwisterMc\TWSearch\{
	Infrastructure\HookableInterface
};

use TwisterMc\TWSearch\Vendor\{
	TypistTech\WPContainedHook\Hooks\Filter
};

/**
 * Class CustomizerMagnifyingGlass
 *
 * @package TwisterMc\TWSearch\Infrastructure\Admin
 */
class CustomizerMagnifyingGlass implements HookableInterface {

	/**
	 * CustomizerMagnifyingGlass constructor.
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
			new Filter( 'esc_html', static::class, 'unescape_mangifying_glass_icon', 10, 2 ),
		];
	}

	/**
	 * Add dashicon to radio button label.
	 *
	 * The use of esc_html in Customizer is preventing us from using a dashicon on a radio button label,
	 * we can bypass that here. Be careful what you do with the esc_html filter.
	 *
	 * Filters a string cleaned and escaped for output in HTML.
	 *
	 * Text passed to esc_html() is stripped of invalid or special characters before output.
	 *
	 * @param string $safe_text The text after it has been escaped.
	 * @param string $text      The text prior to being escaped.
	 *
	 * @return string
	 */
	public function unescape_mangifying_glass_icon( $safe_text, $text ) {

		/**
		 * Only in the customizer.
		 */
		if ( ! \is_customize_preview() ) {
			return $safe_text;
		}

		/**
		 * If the original text is not what we're looking for, return the safe text.
		 */
		if ( __( 'Magnifying Glass Icon', 'tw-search' ) !== $text ) {
			return $safe_text;
		}

		return __( 'Magnifying Glass Icon', 'tw-search' ) . ' <span class="dashicons dashicons-search"></span>';
	}
}
