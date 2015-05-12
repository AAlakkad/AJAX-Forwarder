<?php
return [
    'route'           => [
        'verb'   => 'ajax',
        'action' => 'AAlakkad\AjaxForwarder\Controller@handleGet',
    ],
    'middleware'      => ['auth'],
    'timeout'         => 5,
    'connect_timeout' => 3,
    'servers'         => [
        'default' => [
            'host' => 'http://jsonplaceholder.typicode.com',
            'data' => [],
        ],
    ],
];
