<?php

declare(strict_types=1);

namespace Kuhschnappel\Authtoken\Domain\Model;

use Doctrine\DBAL\ParameterType;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Token extends AbstractEntity
{

    /**
     * @var int
     */
    protected $hidden = '';

    /**
     * Note
     *
     * @var string
     */
    protected $note = '';

    /**
     * Token
     *
     * @var string
     */
    protected $token = '';

    /**
     * Last time token used
     *
     * @var \DateTime
     */
    protected $lastAccess;

    /**
     * starttime
     *
     * @var \DateTime
     */
    protected $starttime;

    /**
     * endtime
     *
     * @var \DateTime
     */
    protected $endtime;

    /**
     * How often token used
     *
     * @var int
     */
    protected $usageCounter;

    /**
     * User of Token
     *
     * @var int
     */
    protected $feuserUid;

    /**
     * Get note
     *
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get token user
     *
     * @return int
     */
    public function getFeuserUid(): int
    {
        return $this->feuserUid;
    }

    /**
     * Get token usage
     *
     * @return int
     */
    public function getUsageCounter(): int
    {
        return $this->usageCounter;
    }

    /**
     * Get token last access
     *
     * @return \DateTime|null
     */
    public function getLastAccess(): ?\DateTime
    {
        return $this->lastAccess;
    }

    /**
     * Get starttime
     *
     * @return \DateTime|null
     */
    public function getStarttime(): ?\DateTime
    {
        return $this->starttime;
    }

    /**
     * Get endtime
     *
     * @return \DateTime|null
     */
    public function getEndtime(): ?\DateTime
    {
        return $this->endtime;
    }

    /**
     * Get specific user data based on feuser UID
     *
     * @return array
     */
    public function getFeuser(): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('fe_users');

        $queryBuilder->getRestrictions()->removeAll();

        $queryBuilder->select('uid', 'disable', 'starttime', 'endtime', 'username')
            ->from('fe_users')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($this->feuserUid, ParameterType::INTEGER))
            )
            ->setMaxResults(1);

        $statement = $queryBuilder->executeQuery();

        $result = $statement->fetch();

        return !empty($result) ? $result : [];
    }

    /**
     * Returns the hidden state
     *
     * @return int
     */
    public function getHidden()
    {
        return $this->hidden;
    }
}
