<?php declare(strict_types=1);

namespace TwisterMc\TWSearch\Vendor\League\Container\Argument;

interface ClassNameInterface
{
    /**
     * Return the class name.
     *
     * @return string
     */
    public function getValue() : string;
}
