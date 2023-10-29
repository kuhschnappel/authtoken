<?php

declare(strict_types=1);

namespace Kuhschnappel\Authtoken\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class FrontendUserRepository extends Repository
{
    /**
     * Overload Find by UID to also get hidden records
     *
     * @param int $uid fe_users UID
     * @return User
     */
    public function findByUid($uid)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
            ->setRespectSysLanguage(false)
            ->setRespectStoragePage(false)
            ->setIgnoreEnableFields(true);
        $and = [$query->equals('uid', $uid)];

        /** @var User $user */
        $user = $query->matching($query->logicalAnd($and))->execute()->getFirst();

        return $user;
    }
}
