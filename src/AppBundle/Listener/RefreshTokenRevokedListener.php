<?php

declare(strict_types=1);

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2017 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace AppBundle\Listener;

use OAuth2Framework\Component\Server\Event\RefreshToken\RefreshTokenRevokedEvent;

final class RefreshTokenRevokedListener
{
    /**
     * @var RefreshTokenRevokedEvent[]
     */
    private $events = [];

    /**
     * @param RefreshTokenRevokedEvent $event
     */
    public function handle(RefreshTokenRevokedEvent $event)
    {
        $this->events[] = $event;
    }

    /**
     * @return RefreshTokenRevokedEvent[]
     */
    public function getEvents()
    {
        return $this->events;
    }
}
