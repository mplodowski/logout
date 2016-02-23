<?php

return [
    'plugin' => [
        'name' => 'Renatio Logout',
        'description' => 'Automatické odhlášení uživatele po nastavené době nečinnosti.',
    ],
    'field' => [
        'timeout' => 'Časový limit vypršení v sekundách',
        'timeout_comment' => 'Počet sekund nečinnosti po kterých bude uživatel automaticky odhlášen.',
    ],
    'message' => [
        'logout' => 'Vaše přihlášení vypršelo, přihlašte se prosím znovu!',
    ],
    'settings' => [
        'label' => 'Přihlášení uživatelů',
        'description' => 'Správa přihlášení uživatelů',
    ],
    'permissions' => [
        'tab' => 'Přihlášení uživatelů',
        'settings' => 'Nastavení automatického odhlášení uživatelů',
    ]
];