<?php
return [
    'route'      => [
        'verb'   => 'ajax',
        'action' => 'AAlakkad\AjaxForwarder\Controller@handelGet',
    ],
    'middleware' => ['auth'],
    'timeout'    => 5,
    'servers'    => [
        'default' => [
            'host' => 'localhost',
            'base' => 'api',
        ],
    ],
];
