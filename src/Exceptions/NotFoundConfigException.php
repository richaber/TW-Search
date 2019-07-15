<?php
/**
 * NotFoundConfigException class file.
 *
 * @package TwisterMc\TWSearch\Exceptions
 */

namespace TwisterMc\TWSearch\Exceptions;

use TwisterMc\TWSearch\NotFoundConfigExceptionInterface;

use \InvalidArgumentException;

/**
 * Class NotFoundConfigException
 *
 * @package TwisterMc\TWSearch\Exceptions
 */
class NotFoundConfigException extends InvalidArgumentException implements NotFoundConfigExceptionInterface {
}
