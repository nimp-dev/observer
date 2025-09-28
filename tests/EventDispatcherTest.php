<?php

namespace Nimp\Observer\Tests;

use Nimp\Observer\EventDispatcher;
use Nimp\Observer\EventListenerInterface;
use Nimp\Observer\ListenerProvider;
use Nimp\Observer\Tests\Fixtures\CollectorListener;
use Nimp\Observer\Tests\Fixtures\DummyEvent;
use Nimp\Observer\Tests\Fixtures\NamedDummyEvent;
use Nimp\Observer\Tests\Fixtures\StoppableDummyEvent;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(EventDispatcher::class)]
#[CoversClass(ListenerProvider::class)]
final class EventDispatcherTest extends TestCase
{
    #[Test]
    public function testDispatchCallsAllListenersForClassAndNamedEvent(): void
    {
        $provider = new ListenerProvider();
        $collector = new CollectorListener();

        $provider->addListeners($collector);
        $dispatcher = new EventDispatcher($provider);

        $dispatcher->dispatch(new DummyEvent());

        $this->assertSame(
            ['onDummyEvent', 'onAnyCallable'],
            $collector->handled
        );
    }


    #[Test]
    public function testDispatchWorksWithNamedEventInterface(): void
    {
        $provider = new ListenerProvider();
        $collector = new CollectorListener();

        $provider->addListeners($collector);
        $dispatcher = new EventDispatcher($provider);

        $dispatcher->dispatch(new NamedDummyEvent());

        $this->assertContains('onNamedEvent', $collector->handled);
    }

    #[Test]
    public function testDispatchWithNoListenersDoesNothing(): void
    {
        $provider = new ListenerProvider();
        $dispatcher = new EventDispatcher($provider);

        $event = new DummyEvent();
        $result = $dispatcher->dispatch($event);

        $this->assertSame($event, $result);
    }
}
