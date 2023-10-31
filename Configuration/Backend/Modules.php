<?php

return [
    'web_Authtoken' => [
        'parent' => 'web',
        'position' => ['after' => 'web_info'],
        'access' => 'admin',
        'iconIdentifier' => 'authtoken-token',
        'labels' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang.xlf:mod.feUsersToken.label',
        'extensionName' => 'Authtoken',
        'controllerActions' => [
            \Kuhschnappel\Authtoken\Controller\TokenController::class => [
                'list',
            ],
        ],
    ],
];
