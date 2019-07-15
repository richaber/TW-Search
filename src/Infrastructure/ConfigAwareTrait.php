<?php
/**
 * ConfigAwareTrait trait file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

/**
 * Trait ConfigAwareTrait
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
trait ConfigAwareTrait {

	/**
	 * The Config instance.
	 *
	 * @var ConfigInterface
	 */
	protected $config = null;

	/**
	 * Get the config.
	 *
	 * @return ConfigInterface
	 *
	 * @throws ConfigException If no Config has been set.
	 */
	public function get_config(): ConfigInterface {
		if ( $this->config instanceof ConfigInterface ) {
			return $this->config;
		}

		throw new ConfigException( 'No Config has been set.' );
	}

	/**
	 * Set the config.
	 *
	 * @param ConfigInterface|null $config The Config instance.
	 *
	 * @return void
	 */
	public function set_config( ?ConfigInterface $config ): void {
		$this->config = $config;
	}
}
