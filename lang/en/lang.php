<?php

return [
    'plugin' => [
        'name' => 'Renatio Logout',
        'description' => 'Manage user session.'
    ],
    'field' => [
        'lifetime' => 'Session lifetime in seconds',
        'lifetime_comment' => 'Number of seconds that you wish the session to be allowed to remain idle for it is expired.',
        'show_counter' => 'Display counter',
        'show_counter_comment' => 'It will display counter next to user avatar.',
    ],
    'message' => [
        'logout' => 'You have been logged out!',
    ],
    'settings' => [
        'label' => 'User Session',
        'description' => 'Manage users session settings.',
    ],
    'permissions' => [
        'tab' => 'User Session',
        'settings' => 'Manage settings',
    ]
];