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

use OAuth2Framework\Component\Server\Event\Client\ClientOwnerChangedEvent;

final class ClientOwnerChangedListener
{
    /**
     * @var ClientOwnerChangedEvent[]
     */
    private $events = [];

    /**
     * @param ClientOwnerChangedEvent $event
     */
    public function handle(ClientOwnerChangedEvent $event)
    {
        $this->events[] = $event;
    }

    /**
     * @return ClientOwnerChangedEvent[]
     */
    public function getEvents()
    {
        return $this->events;
    }
}
