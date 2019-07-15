<?php
/**
 * ConfigurableInterface interface file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

/**
 * Interface ConfigurableInterface
 *
 * Something that can be configured.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
interface ConfigurableInterface {

	/**
	 * Configure a component.
	 *
	 * @return void
	 */
	public function configure(): void;
}
