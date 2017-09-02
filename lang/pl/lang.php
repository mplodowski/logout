<?php

return [
    'plugin' => [
        'name' => 'Renatio Logout',
        'description' => 'Zarządzanie sesją użytkownika.'
    ],
    'field' => [
        'lifetime' => 'Czas trwania sesji w sekundach',
        'lifetime_comment' => 'Liczba sekund po której użytkownik zostanie automatycznie wylogowany z systemu.',
        'show_counter' => 'Pokaż licznik',
        'show_counter_comment' => 'Wyświetla licznik obok awatara użytkownika.',
    ],
    'message' => [
        'logout' => 'Zostałeś wylogowany!'
    ],
    'settings' => [
        'label' => 'Sesja użytkownika',
        'description' => 'Zarządzaj ustawieniami dla sesji użytkownika.'
    ],
    'permissions' => [
        'tab' => 'Sesja użytkownika',
        'settings' => 'Zarządzaj ustawieniami'
    ]
];