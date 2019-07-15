<?php

declare(strict_types=1);

namespace TwisterMc\TWSearch\Vendor\TypistTech\WPContainedHook;

use TwisterMc\TWSearch\Vendor\Psr\Container\ContainerInterface;
use TwisterMc\TWSearch\Vendor\TypistTech\WPContainedHook\Exceptions\ContainerException;

interface ContainerAwareInterface
{
    /**
     * Set a container.
     *
     * @param ContainerInterface $container The container instance.
     *
     * @return void
     */
    public function setContainer(ContainerInterface $container): void;

    /**
     * Get the container.
     *
     * @throws ContainerException If no container implementation has been set.
     *
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface;
}
