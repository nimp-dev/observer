# Nimp Observer

Minimalistic implementation of event dispatching according to PSR-14: EventDispatcher + ListenerProvider.

Installation

```BASH
bash composer require nimp/observer
```

Quick start

```PHP
final class MyListener implements EventListenerInterface
{
    public function events(): iterable
    {
        yield StartedEvent::class => $this->onStarted(...);
        yield MyEvent::class => 'onMyEvent';
        yield MyStoppableEvent::class => function (MyStoppableEvent $e): void {
                // handle and stop propagation if needed
                $e->stop();
            };
    }
    
    public function onStarted(StartedEvent $event): void
    {
        // handle StartedEvent
    }

    public function onMyEvent(object $event): void
    {
        // handle MyEvent
    }
}

$provider = new ListenerProvider();
$provider->addListeners(new MyListener());

$dispatcher = new EventDispatcher($provider);
```

Tests
```BASH
composer install && composer test
```
