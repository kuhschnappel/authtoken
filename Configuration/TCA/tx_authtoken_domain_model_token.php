<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang_db.xlf:tx_authtoken_domain_model_token',
        'label' => 'note',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'hideTable' => true,
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'note,token',
        'typeicon_classes' => [
            'default' => 'authtoken-token',
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'note, token, last_access, --div--; LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'note' => [
            'exclude' => true,
            'label' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang_db.xlf:tx_authtoken_domain_model_token.note',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
                'default' => ''
            ],
        ],
        'token' => [
            'exclude' => true,
            'label' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang_db.xlf:tx_authtoken_domain_model_token.token',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 100,
                'eval' => 'nospace,required,unique',
                'autocomplete' => false,
                'default' => uniqid('', true),
                'readOnly' => 1
            ],
        ],
        'last_access' => [
            'exclude' => true,
            'label' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang_db.xlf:tx_authtoken_domain_model_token.last_access',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'readOnly' => 1
            ],
        ],
    ],
];