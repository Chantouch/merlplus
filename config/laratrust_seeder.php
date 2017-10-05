<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'refs' => 'c,r,u,d',
            'manages' => 'c,r,u,d',
            'ads' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'profile' => 'r,u',
            'dashboard' => 'r'
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'r,u',
            'refs' => 'c,r,u,d',
            'manages' => 'c,r,u,d',
            'ads' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'profile' => 'r,u',
            'dashboard' => 'r'
        ],
        'editor' => [
            'refs' => 'r,u',
            'manages' => 'r',
            'ads' => 'c,r,u,d',
            'settings' => 'r,u',
            'posts' => 'c,r,u',
            'profile' => 'r,u',
            'dashboard' => 'r'
        ],
        'supporter' => [
            'refs' => 'r,u',
            'manages' => 'r',
            'ads' => 'c,r,u,d',
            'settings' => 'r,u',
            'posts' => 'c,r,u',
            'profile' => 'r,u',
            'dashboard' => 'r'
        ],
        'subscriber' => [
            'profile' => 'r,u'
        ]
    ],
    'permission_structure' => [

    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
