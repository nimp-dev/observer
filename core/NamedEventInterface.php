<?php

namespace Nimp\Observer;

interface NamedEventInterface
{
    /**
     * @return string|null
     */
    public function eventName(): string|null;
}