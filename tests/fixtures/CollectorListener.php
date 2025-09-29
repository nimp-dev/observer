<?php

namespace Nimp\Observer\Tests\fixtures;

use Nimp\Observer\EventListenerInterface;

/**
 * Listener that collects handled events for testing
 *
 * The CollectorListener class implements the EventListenerInterface
 * and defines methods to process various types of events while keeping
 * track of the events it has handled.
 */
final class CollectorListener implements EventListenerInterface
{
    public array $handled = [];

    /**
     * @inheritdoc
     */
    public function events(): iterable
    {
        yield StoppableDummyEvent::class => $this->onStoppableEvent(...);
        yield DummyEvent::class => 'onDummyEvent';
        yield 'named.event' => $this->onNamedEvent(...);
        yield DummyEvent::class => fn (DummyEvent $e) => $this->onAnyCallable($e);
    }

    /**
     * Handles string the fake event.
     *
     * @param DummyEvent $e The event object to be handled.
     * @return void
     */
    public function onDummyEvent(DummyEvent $e): void
    {
        $this->handled[] = 'onDummyEvent';
    }

    /**
     * Handles the named fake event. (callable)
     *
     * @param NamedDummyEvent $e The event object to be processed.
     * @return void
     */
    public function onNamedEvent(NamedDummyEvent $e): void
    {
        $this->handled[] = 'onNamedEvent';
    }

    /**
     * Handles the specified event and tracks it as processed.
     *
     * @param DummyEvent $e The event instance to be handled.
     * @return void
     */
    public function onAnyCallable(DummyEvent $e): void
    {
        $this->handled[] = 'onAnyCallable';
    }

    /**
     * Processes the specified stoppable event, tracks it as handled, and stops further propagation of the event.
     *
     * @param StoppableDummyEvent $e The stoppable event instance to be handled.
     * @return void
     */
    public function onStoppableEvent(StoppableDummyEvent $e): void
    {
        $this->handled[] = 'onStoppableEvent';
        $e->stop();
    }
}