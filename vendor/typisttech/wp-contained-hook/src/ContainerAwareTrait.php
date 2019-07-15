<?php

declare(strict_types=1);

namespace TwisterMc\TWSearch\Vendor\TypistTech\WPContainedHook;

use TwisterMc\TWSearch\Vendor\Psr\Container\ContainerInterface;
use TwisterMc\TWSearch\Vendor\TypistTech\WPContainedHook\Exceptions\ContainerException;

trait ContainerAwareTrait
{
    /**
     * The container instance.
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Get the container.
     *
     * @throws ContainerException If no container has been set.
     *
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        if ($this->container instanceof ContainerInterface) {
            return $this->container;
        }

        throw new ContainerException('No container has been set.');
    }

    /**
     * Set a container.
     *
     * @param ContainerInterface $container The container instance.
     *
     * @return void
     */
    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }
}
