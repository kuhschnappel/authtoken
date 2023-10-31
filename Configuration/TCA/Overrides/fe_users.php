<?php
defined('TYPO3') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',
    [
        'tx_authtoken_domain_model_token' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang.xlf:tx_authtoken_domain_model_token',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_authtoken_domain_model_token',
                'foreign_field' => 'feuser_uid',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showPossibleRecordsSelector' => 1,
                    'showAddRecordSelector' => 1,
                ],
                'behaviour' => [
                    'disableCopyChildRecord' => true,
                ],
            ],
        ],
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'tx_authtoken_domain_model_token',
    '',
    'after:password'
);
