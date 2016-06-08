<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2016 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace AppBundle\Entity;

use SpomkyLabs\OAuth2ServerBundle\Plugin\ClientManagerPlugin\Model\Client as BaseClient;

class Client extends BaseClient
{
    private $id;

    public function getId()
    {
        return $this->id;
    }
}