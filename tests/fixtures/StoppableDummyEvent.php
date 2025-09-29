<?php

namespace Nimp\Observer\Tests\fixtures;

use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Event that can stop propagation.
 */
final class StoppableDummyEvent implements StoppableEventInterface
{
    /**
     * Is propagation stopped?
     * @var bool
     */
    private bool $stopped = false;

    /**
     * @inheritdoc
     */
    public function isPropagationStopped(): bool
    {
        return $this->stopped;
    }

    /**
     * stop propagation
     * @return void
     */
    public function stop(): void
    {
        $this->stopped = true;
    }
}
