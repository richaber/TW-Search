<?php
/**
 * CustomizeRegister class file.
 *
 * @package TwisterMc\TWSearch\Infrastructure\Admin
 */

namespace TwisterMc\TWSearch\Infrastructure\Admin;

use TwisterMc\TWSearch\{
	Infrastructure\HookableInterface,
	Utility\NavMenuUtility
};

use TwisterMc\TWSearch\Vendor\{
	TypistTech\WPContainedHook\Hooks\Action
};

use \WP_Customize_Manager;

/**
 * Class CustomizeRegister
 *
 * @package TwisterMc\TWSearch\Infrastructure\Admin
 */
class CustomizeRegister implements HookableInterface {

	/**
	 * CustomizeRegister constructor.
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
			new Action( 'customize_register', static::class, 'customize_register' ),
		];
	}

	/**
	 * Add plugin settings to the Customizer.
	 *
	 * Adds the individual sections, settings, and controls to the theme customizer.
	 *
	 * @param \WP_Customize_Manager $wp_customize WP_Customize_Manager instance.
	 */
	public function customize_register( $wp_customize ) {

		/**
		 * Add TW Search customize section.
		 */
		$wp_customize->add_section(
			'twSearch',
			array(
				'title'       => __( 'TW Search Settings', 'tw-search' ),
				'description' => __( 'Customize the search settings.', 'tw-search' ),
				'priority'    => 35,
			)
		);

		/**
		 * Add background appearance customize setting.
		 */
		$wp_customize->add_setting(
			'twSearch_color',
			array(
				'default' => 'dark',
			)
		);

		/**
		 * Add background appearance customize control.
		 */
		$wp_customize->add_control(
			'twSearch_color',
			array(
				'label'   => __( 'Overlay Background', 'tw-search' ),
				'section' => 'twSearch',
				'type'    => 'radio',
				'choices' => array(
					'dark'  => __( 'Dark', 'tw-search' ),
					'light' => __( 'Light', 'tw-search' ),
				),
			)
		);

		/**
		 * Add location customize setting.
		 */
		$wp_customize->add_setting(
			'twSearch_location',
			array(
				'default' => 'none',
			)
		);

		/**
		 * Add location customize control.
		 */
		$wp_customize->add_control(
			'twSearch_location',
			array(
				'label'   => __( 'Add To Menu', 'tw-search' ),
				'section' => 'twSearch',
				'type'    => 'radio',
				'choices' => $this->get_nav_menu_choices(),
			)
		);

		/**
		 * Add display customize setting.
		 */
		$wp_customize->add_setting(
			'twSearch_display',
			array(
				'default' => 'icon',
			)
		);

		/**
		 * Add display customize control.
		 *
		 * If you change the 'Magnifying Glass Icon' label text, it needs to be updated in tw_search_esc_html as well.
		 *
		 * @see tw_search_esc_html()
		 */
		$wp_customize->add_control(
			'twSearch_display',
			array(
				'label'   => __( 'Display As', 'tw-search' ),
				'section' => 'twSearch',
				'type'    => 'radio',
				'choices' => array(
					'icon' => __( 'Magnifying Glass Icon', 'tw-search' ),
					'word' => __( 'Search (word)', 'tw-search' ),
					'both' => __( 'Both', 'tw-search' ),
				),
			)
		);
	}

	/**
	 * Get registered navigation menus utility function.
	 *
	 * @return array
	 */
	public function get_nav_menu_choices() {

		$menus = NavMenuUtility::get_nav_menus();

		$nav_menus = [
			'none' => __( 'None (use .js-twSearch class)', 'tw-search' ),
		];

		foreach ( $menus as $key => $value ) {
			$nav_menus[ $value->slug ] = $value->name;
		}

		return $nav_menus;
	}
}
