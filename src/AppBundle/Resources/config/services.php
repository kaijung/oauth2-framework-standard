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

use AppBundle\Entity\ResourceRepository;
use AppBundle\Entity\UserManager;
use AppBundle\Entity\UserRepository;
use AppBundle\Service\EventStore;
use AppBundle\Service\UserProvider;
use AppBundle\Service\ResourceServerRepository;
use OAuth2Framework\Component\Server\Endpoint\UserInfo\Pairwise\EncryptedSubjectIdentifier;
use OAuth2Framework\Bundle\Server\Model\AccessTokenByReferenceRepository;
use OAuth2Framework\Component\Server\Model\Scope\ScopeRepository;
use function Fluent\autowire;
use function Fluent\create;
use function Fluent\get;
use Http\Client\Curl\Client;
use Http\Factory\Diactoros\RequestFactory;
use Http\Factory\Diactoros\ResponseFactory;
use Http\Factory\Diactoros\UriFactory;

return [
    Client::class => autowire(),
    RequestFactory::class => autowire(),
    ResponseFactory::class => autowire(),
    UriFactory::class => autowire(),

    'eventstore.client' => create(EventStore::class)
        ->arguments(
            '%kernel.cache_dir%',
            'client'
        ),

    'eventstore.authcode' => create(EventStore::class)
        ->arguments(
            '%kernel.cache_dir%',
            'authcode'
        ),

    'eventstore.refreshtoken' => create(EventStore::class)
        ->arguments(
            '%kernel.cache_dir%',
            'refreshtoken'
        ),

    'eventstore.preconfiguredauthorization' => create(EventStore::class)
        ->arguments(
            '%kernel.cache_dir%',
            'preconfiguredauthorization'
        ),

    'eventstore.initialaccesstoken' => create(EventStore::class)
        ->arguments(
            '%kernel.cache_dir%',
            'initialaccesstoken'
        ),

    'eventstore.accesstoken' => create(EventStore::class)
        ->arguments(
            '%kernel.cache_dir%',
            'initialaccesstoken'
        ),

    'MyAccessTokenRepository' => create(AccessTokenByReferenceRepository::class)
        ->arguments(
            100,
            120,
            1800,
            get('eventstore.accesstoken'),
            get('event_recorder'),
            get('cache.app')
        ),

    'MyUserAccountManager' => create(UserManager::class)
        ->arguments(
            get('fos_user.util.password_updater'),
            get('fos_user.util.canonical_fields_updater'),
            get('fos_user.object_manager'),
            '%fos_user.model.user.class%'
        ),
    'MyUserAccountRepository' => create(UserRepository::class),
    'MyResourceServerRepository' => create(ResourceServerRepository::class),
    'MyResourceRepository' => create(ResourceRepository::class),
    'MyUserProvider' => autowire(UserProvider::class),
    'MyScopeRepository' => create(ScopeRepository::class)
        ->arguments(
            ['openid', 'email', 'profile', 'address', 'phone', 'offline_access']
        ),

    'MyPairwiseSubjectIdentifier' => create(EncryptedSubjectIdentifier::class)
        ->arguments(
            'This is my secret Key !!!',
            'aes-128-cbc',
            mb_substr('This is my salt or my IV !!!', 0, 16, '8bit'),
            mb_substr('This is my salt or my IV !!!', 0, 16, '8bit')
        ),
];
