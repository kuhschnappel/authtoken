<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (!defined('TYPO3')) {
    die ('Access denied.');
}

$versionInformation = GeneralUtility::makeInstance(Typo3Version::class);

if ($versionInformation->getMajorVersion() < 12) {
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
}
