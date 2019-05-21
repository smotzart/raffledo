<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'privateResources' => [
        'tags' => [
            'edit',
            'create',
            'delete'
        ],
        'games' => [
            'edit',
            'create',
            'delete'
        ],
        'companies' => [
            'edit',
            'create',
            'delete'
        ],
        'users' => [
            'index',
            'search',
            'edit',
            'create',
            'delete'
        ],
        'profiles' => [
            'index',
            'search',
            'edit',
            'create',
            'delete'
        ],
        'permissions' => [
            'index'
        ]
    ]
]);
