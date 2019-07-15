<?php
/**
 * TemplatedView class file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure\View;

use \Gamajo_Template_Loader;

/**
 * Class TemplatedView
 */
class TemplatedView extends Gamajo_Template_Loader {

	/**
	 * TemplatedView constructor.
	 *
	 * @param string $filter_prefix             Prefix for filter names.
	 * @param string $plugin_directory          Reference to the root directory path of this plugin.
	 * @param string $plugin_template_directory Directory name where templates are found in this plugin.
	 * @param string $theme_template_directory  Directory name where custom templates for this plugin should be found
	 *                                          in the theme.
	 */
	public function __construct( string $filter_prefix = '', string $plugin_directory = '', string $plugin_template_directory = 'template-parts', string $theme_template_directory = 'template-parts' ) {
		$this->set_filter_prefix( $filter_prefix );
		$this->set_theme_template_directory( $theme_template_directory );
		$this->set_plugin_directory( $plugin_directory );
		$this->set_plugin_template_directory( $plugin_template_directory );
	}

	/**
	 * Set the filter_prefix.
	 *
	 * @param string $filter_prefix The filter_prefix to set.
	 */
	protected function set_filter_prefix( string $filter_prefix = '' ) {
		$this->filter_prefix = $filter_prefix;
	}

	/**
	 * Get the filter_prefix.
	 *
	 * @return string
	 */
	protected function get_filter_prefix(): string {
		return $this->filter_prefix;
	}

	/**
	 * Set the plugin_directory.
	 *
	 * @param string $plugin_directory The plugin_directory to set.
	 */
	protected function set_plugin_directory( string $plugin_directory = '' ) {
		$this->plugin_directory = $plugin_directory;
	}

	/**
	 * Get the plugin_directory.
	 *
	 * @return string
	 */
	protected function get_plugin_directory(): string {
		return $this->plugin_directory;
	}

	/**
	 * Set the plugin_template_directory.
	 *
	 * @param string $plugin_template_directory The plugin_template_directory to set.
	 */
	protected function set_plugin_template_directory( string $plugin_template_directory = '' ) {
		$this->plugin_template_directory = $plugin_template_directory;
	}

	/**
	 * Get the plugin_template_directory.
	 *
	 * @return string
	 */
	protected function get_plugin_template_directory(): string {
		return $this->plugin_template_directory;
	}

	/**
	 * Set the theme_template_directory.
	 *
	 * @param string $theme_template_directory The theme_template_directory to set.
	 */
	protected function set_theme_template_directory( string $theme_template_directory = '' ) {
		$this->theme_template_directory = $theme_template_directory;
	}

	/**
	 * Get the theme_template_directory.
	 *
	 * @return string
	 */
	protected function get_theme_template_directory(): string {
		return $this->theme_template_directory;
	}
}
