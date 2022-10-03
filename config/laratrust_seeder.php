<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'complexes'    => 'c,r,u,d',
            'reservations'    => 'c,r,u,d',
            'units'    => 'c,r,u,d',
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'complexes'    => 'c,r,u,d',
            'reservations'    => 'c,r,u,d',
            'units'    => 'c,r,u,d',
        ],
        'user' => [
            'users' => 'r',
            'profile' => 'r,u',
            'complexes'    => 'c,r',
            'reservations'    => 'c,r,u',
            'units'    => 'c,r,u',
        ],
    ],
    'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
