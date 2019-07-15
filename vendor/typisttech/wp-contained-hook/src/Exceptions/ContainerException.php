<?php

declare(strict_types=1);

namespace TwisterMc\TWSearch\Vendor\TypistTech\WPContainedHook\Exceptions;

use TwisterMc\TWSearch\Vendor\Psr\Container\ContainerExceptionInterface;
use RuntimeException;

class ContainerException extends RuntimeException implements ContainerExceptionInterface
{
}
