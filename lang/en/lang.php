<?php

return [
    'plugin'   => [
        'name'        => 'Renatio Logout',
        'description' => 'Automatically logout authenticated user after session timeout.'
    ],
    'field'    => [
        'timeout'         => 'Timeout in seconds',
        'timeout_comment' => 'Number of seconds that you wish the session to be allowed to remain idle for it is expired.'
    ],
    'message'  => [
        'logout' => 'You have been logged out!'
    ],
    'settings' => [
        'label'       => 'User Session',
        'description' => 'Manage users session settings.'
    ]
];