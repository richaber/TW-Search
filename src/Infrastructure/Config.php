<?php
/**
 * Config class file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

use TwisterMc\TWSearch\{
	Exceptions\ConfigException,
	Exceptions\NotFoundConfigException,
	Infrastructure\ConfigInterface
};

/**
 * Class Config
 *
 * Generic storage class to manage configuration data.
 *
 * Somewhat similar to a Container, but more like a registry.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
class Config extends \ArrayObject implements ConfigInterface {

	/**
	 * Finds an entry of the config by its identifier and returns it.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return mixed Entry.
	 *
	 * @throws NotFoundConfigException No entry was found for **this** identifier.
	 */
	public function get( $id ) {
		if ( true !== $this->offsetExists( $id ) ) {
			throw new NotFoundConfigException();
		}

		return $this->offsetGet( $id );
	}

	/**
	 * Returns true if the config can return an entry for the given identifier.
	 * Returns false otherwise.
	 *
	 * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
	 * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return bool
	 */
	public function has( $id ) {
		return $this->offsetExists( $id );
	}
}
