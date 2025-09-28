<?php

namespace Nimp\Observer\Tests\fixtures;

use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Event that can stop propagation.
 */
final class StoppableDummyEvent implements StoppableEventInterface
{
    private bool $stopped = false;

    public function isPropagationStopped(): bool
    {
        return $this->stopped;
    }

    public function stop(): void
    {
        $this->stopped = true;
    }
}
