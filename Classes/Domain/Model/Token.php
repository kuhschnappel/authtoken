<?php

declare(strict_types=1);

namespace Kuhschnappel\Authtoken\Domain\Model;

use Kuhschnappel\Authtoken\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Token extends AbstractEntity
{
    /**
     * frontendUserRepository
     *
     * @var FrontendUserRepository
     */
    private FrontendUserRepository $frontendUserRepository;

    /**
     * inject frontendUserRepository
     *
     * @param FrontendUserRepository $frontendUserRepository
     * @return void
     */
    public function injectRepositories(FrontendUserRepository $frontendUserRepository): void
    {
        $this->frontendUserRepository = $frontendUserRepository;
    }

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
     * Returns the feuser.
     *
     * @return \Kuhschnappel\Authtoken\Domain\Model\FrontendUser|null The user model or null if not found.
     */
    public function getFeuser()
    {
        return $this->frontendUserRepository->findByUid($this->feuserUid);
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
