<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

(function () {

    $GLOBALS['TYPO3_CONF_VARS']['SVCONF']['auth']['setup']['FE_fetchUserIfNoSession'] = true;
    $GLOBALS['TYPO3_CONF_VARS']['SVCONF']['auth']['setup']['FE_alwaysAuthUser'] = true;
    $GLOBALS['TYPO3_CONF_VARS']['SVCONF']['auth']['setup']['FE_alwaysFetchUser'] = true;

    ExtensionManagementUtility::addService(
        'kuhschnappel_authtoken',
        'auth',
        \Kuhschnappel\Authtoken\Service\AuthenticatorService::class,
        [
            'title' => 'Authentication',
            'description' => 'An alternative way to access restricted content by token',

            'subtype' => 'authUserFE,getUserFE',

            'available' => true,
            'priority' => 60,
            'quality' => 80,

            'os' => '',
            'exec' => '',

            'className' => \Kuhschnappel\Authtoken\Service\AuthenticatorService::class
        ]
    );

})();
