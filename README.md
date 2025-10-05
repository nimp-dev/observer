# Nimp Observer

![Tests](https://github.com/nimp-dev/observer/actions/workflows/tests.yml/badge.svg)
![PHPStan](https://github.com/nimp-dev/observer/actions/workflows/phpstan.yml/badge.svg)
![Code Coverage](https://codecov.io/gh/nimp-dev/observer/branch/main/graph/badge.svg)
![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

Minimalistic implementation of event dispatching according to PSR-14: EventDispatcher + ListenerProvider.

## Installation

```BASH
composer require nimp/observer
```

## Quick start

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

## Tests
```BASH
composer install && composer test
```
