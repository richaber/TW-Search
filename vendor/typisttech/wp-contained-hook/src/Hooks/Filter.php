<?php

declare(strict_types=1);

namespace TwisterMc\TWSearch\Vendor\TypistTech\WPContainedHook\Hooks;

class Filter extends AbstractHook
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        add_filter(
            $this->hook,
            [$this, 'run'],
            $this->priority,
            $this->acceptedArgs
        );
    }

    /**
     * The actual callback that WordPress going to fire.
     *
     * @param mixed ...$args Arguments which pass on to the actual instance.
     *
     * @return mixed
     */
    public function run(...$args)
    {
        $container = $this->getContainer();
        $instance = $container->get($this->classIdentifier);

        return $instance->{$this->callbackMethod}(...$args);
    }
}
