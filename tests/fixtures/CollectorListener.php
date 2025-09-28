<?php

namespace Nimp\Observer\Tests\fixtures;

use Nimp\Observer\EventListenerInterface;

/**
 * Listener that collects handled events for testing.
 */
final class CollectorListener implements EventListenerInterface
{
    public array $handled = [];

    public function events(): iterable
    {
        yield DummyEvent::class => 'onDummyEvent';
        yield 'named.event' => 'onNamedEvent';
        yield DummyEvent::class => fn (object $e) => $this->onAnyCallable($e);
    }

    public function onDummyEvent(object $e): void
    {
        $this->handled[] = 'onDummyEvent';
    }

    public function onNamedEvent(object $e): void
    {
        $this->handled[] = 'onNamedEvent';
    }

    public function onAnyCallable(object $e): void
    {
        $this->handled[] = 'onAnyCallable';
    }
}