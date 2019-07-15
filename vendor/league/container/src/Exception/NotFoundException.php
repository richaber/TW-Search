<?php

namespace TwisterMc\TWSearch\Vendor\League\Container\Exception;

use TwisterMc\TWSearch\Vendor\Psr\Container\NotFoundExceptionInterface;
use InvalidArgumentException;

class NotFoundException extends InvalidArgumentException implements NotFoundExceptionInterface
{
}
