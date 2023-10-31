<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang.xlf:tx_authtoken_domain_model_token',
        'descriptionColumn' => 'note',
        'label' => 'note',
        'label_alt' => 'uid',
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
        '0' => ['showitem' => 'token, last_access, usage_counter, note, --div--; LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, starttime, endtime'],
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
            ],
        ],
        'note' => [
            'exclude' => true,
            'label' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang.xlf:tx_authtoken_domain_model_token.note',
            'config' => [
                'type' => 'text',
                'rows' => 10,
                'cols' => 48
            ],
        ],
        'token' => [
            'exclude' => true,
            'label' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang.xlf:tx_authtoken_domain_model_token.token',
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
            'label' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang.xlf:tx_authtoken_domain_model_token.last_access',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'readOnly' => 1
            ],
        ],
        'usage_counter' => [
            'exclude' => true,
            'label' => 'LLL:EXT:authtoken/Resources/Private/Language/locallang.xlf:tx_authtoken_domain_model_token.usage_counter',
            'config' => [
                'type' => 'input',
                'readOnly' => 1,
                'size' => 10
            ],
        ],
        'feuser_uid' => [
            'label' => 'feuser_uid',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
