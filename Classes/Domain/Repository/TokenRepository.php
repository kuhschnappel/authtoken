<?php

declare(strict_types=1);

namespace Kuhschnappel\Authtoken\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface;

class TokenRepository extends Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = [
        'last_access' => QueryInterface::ORDER_DESCENDING
    ];

    public function initializeObject()
    {
        /** @var QuerySettingsInterface $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $querySettings->setIgnoreEnableFields(true);
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

}
