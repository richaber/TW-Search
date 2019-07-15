<?php
/**
 * ConfigInterface interface file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

/**
 * Interface ConfigInterface
 *
 * Describes the interface of a config that exposes methods to read its entries.
 *
 * This is basically "like" a container, but meant just for configuration.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */
interface ConfigInterface {

	/**
	 * Finds an entry of the config by its identifier and returns it.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return mixed Entry.
	 * @throws ConfigExceptionInterface Error while retrieving the entry.
	 *
	 * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
	 */
	public function get( $id );

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
	public function has( $id );
}
