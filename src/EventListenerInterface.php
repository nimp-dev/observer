<?php

namespace Nimp\Observer;

interface EventListenerInterface
{
    /**
     * Returns a list of subscriptions:
     *  - key = event name (string)
     *  - value = callable|string (handler method)
     *
     * @return iterable<string, callable|string>
     */
    public function events(): iterable;
}