<?php
/**
 * LoaderAwareTrait trait file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

use TwisterMc\TWSearch\Vendor\{
	TypistTech\WPContainedHook\Loader
};

/**
 * Trait LoaderAwareTrait
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
trait LoaderAwareTrait {

	/**
	 * The Loader instance.
	 *
	 * @var Loader
	 */
	protected $hook_loader = null;


	/**
	 * Set the HookLoader for the plugin.
	 *
	 * @param Loader|null $hook_loader The Loader to set.
	 */
	public function set_hook_loader( ? Loader $hook_loader ) {
		$this->hook_loader = $hook_loader;
	}

	/**
	 * Get the HookLoader from the plugin.
	 *
	 * @return Loader|null
	 */
	public function get_hook_loader(): ?Loader {
		return $this->hook_loader;
	}
}
