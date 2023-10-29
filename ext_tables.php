<?php
if (!defined('TYPO3')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
    'Authtoken',
    'web',
    'FeUsersToken',
    'bottom',
    [
        \Kuhschnappel\Authtoken\Controller\TokenController::class => 'list',
    ],
    [
        'access' => 'admin',
        'iconIdentifier' => 'authtoken-token',
        'labels' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang.xlf:mod.feUsersToken.label',
        'navigationComponentId' => 'TYPO3/CMS/Backend/PageTree/PageTreeElement',
    ]
);
