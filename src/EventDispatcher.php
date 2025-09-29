<?php

namespace Nimp\Observer;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;

class EventDispatcher implements EventDispatcherInterface
{
    private ListenerProviderInterface $provider;

    public function __construct(ListenerProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @inheritdoc
     */
    public function dispatch(object $event): object
    {
        foreach ($this->provider->getListenersForEvent($event) as $listener) {
            $listener($event);

            if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
                break;
            }
        }

        return $event;
    }
}