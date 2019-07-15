<?php
/**
 * ConfigException class file.
 *
 * @package TwisterMc\TWSearch\Exceptions
 */

namespace TwisterMc\TWSearch\Exceptions;

use TwisterMc\TWSearch\Exceptions\ConfigExceptionInterface;

use \RuntimeException;

/**
 * Class ConfigException
 *
 * @package TwisterMc\TWSearch\Exceptions
 */
class ConfigException extends RuntimeException implements ConfigExceptionInterface {
}
