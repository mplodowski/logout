<?php

return [
    'plugin'      => [
        'name'        => 'Renatio Logout',
        'description' => 'Automatycznie wyloguj uwierzytelnionego użytkownika po wygaśnięciu sesji.'
    ],
    'field'       => [
        'timeout'         => 'Limit czasu w sekundach',
        'timeout_comment' => 'Liczba sekund po której użytkownik zostanie automatycznie wylogowany z systemu.'
    ],
    'message'     => [
        'logout' => 'Zostałeś wylogowany!'
    ],
    'settings'    => [
        'label'       => 'Sesja użytkownika',
        'description' => 'Zarządzaj ustawieniami dla sesji użytkownika.'
    ],
    'permissions' => [
        'tab'      => 'Sesja użytkownika',
        'settings' => 'Zarządzaj ustawieniami'
    ]
];