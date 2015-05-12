<?php
return [
    'route'      => [
        'verb'   => 'ajax',
        'action' => 'AAlakkad\AjaxForwarder\Controller@handleGet',
    ],
    'middleware' => ['auth'],
    'timeout'    => 5,
    'servers'    => [
        'default' => [
            'host' => 'http://jsonplaceholder.typicode.com',
            'data' => [],
        ],
    ],
];
