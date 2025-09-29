<?php

namespace Nimp\Observer\Tests\fixtures;

use Nimp\Observer\NamedEventInterface;

/**
 * Event that implements NamedEventInterface.
 */
final class NamedDummyEvent implements NamedEventInterface
{
    /**
     * @inheritdoc
     */
    public function eventName(): ?string
    {
        return 'named.event';
    }
}