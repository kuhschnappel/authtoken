<?php
namespace Kuhschnappel\Authtoken\Service;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Authentication\AbstractAuthenticationService;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DefaultRestrictionContainer;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\EndTimeRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\QueryRestrictionContainerInterface;
use TYPO3\CMS\Core\Database\Query\Restriction\RootLevelRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\StartTimeRestriction;
use TYPO3\CMS\Core\Http\ServerRequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AuthenticatorService extends AbstractAuthenticationService
{
    /**
     * Enable field columns of user table
     * @var array
     */
    public $enableColumns = [
        'rootLevel' => '',
        // Boolean: If TRUE, 'AND pid=0' will be a part of the query...
        'hidden_disabled' => true,
        'starttime' => true,
        'endtime' => true,
        'deleted' => true,
    ];

    /**
     * Table in database with user data
     * @var string
     */
    public $user_table = 'fe_users';

    /**
     * Table in database with user token data
     * @var string
     */
    public $token_table = 'tx_authtoken_domain_model_token';

    /**
     * Column name for last login timestamp
     * @var string
     */
    public $token_lastAccess_column = 'last_access';

    /**
     * Column name for usage counter
     * @var string
     */
    public $token_usageCounter_column = 'usage_counter';

    /**
     * Column for user-id
     * @var string
     */
    public $userid_column = 'feuser_uid';
    /**
     * @var ServerRequestInterface
     */
    protected $serverRequest;

    protected mixed $authenticatedUser = null;

    public function __construct()
    {
        $request = GeneralUtility::makeInstance(ServerRequestFactory::class)->fromGlobals();
        $this->serverRequest = $request;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    function authenticatedUser() : mixed
    {
        if ($this->authenticatedUser !== null)
            return $this->authenticatedUser;

        $this->authenticatedUser = false;

        $backendConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)
            ->get('authtoken');

        $tokenHeaderKey = isset($backendConfiguration['tokenKey']) && !empty($backendConfiguration['tokenKey']) ? $backendConfiguration['tokenKey'] : 'X-User-Token';

        $token = $this->serverRequest->getHeaderLine($tokenHeaderKey);

        if (empty($token))
            return $this->authenticatedUser;

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($this->user_table);
        $expressionBuilder = $queryBuilder->expr();

        $dbTokenSetup = [
            'check_pid_clause' => '',
            'enable_clause' => $this->restrictionConstraints()->buildExpression(
                [$this->token_table => $this->token_table],
                $expressionBuilder
            ),
            'username_column' => 'token',
            'table' => $this->token_table,
        ];

        $tokenRecord = $this->fetchUserRecord($token, '', $dbTokenSetup);

        if ($tokenRecord === false)
            return $this->authenticatedUser;

        $dbUserSetup = [
            'check_pid_clause' => '',
            'enable_clause' => '',
            'username_column' => 'uid',
            'table' => $this->user_table,
        ];
        $user = $this->fetchUserRecord($tokenRecord[$this->userid_column], '', $dbUserSetup);
        if ($user === false)
            return $this->authenticatedUser;

        // update token only on authUserFE subtype
        if ($this->info['requestedServiceSubType'] == 'authUserFE') 
            $this->updateUserToken($tokenRecord);

        $this->authenticatedUser = $user;

        return $this->authenticatedUser;
    }


    /**
     *
     * @param array $user
     * 
     * @return int
     * 
     */
    public function authUser(array $user): int
    {
        if ($this->authenticatedUser() !== false) {
            return 200;
        }
        return 100;
    }

    /**
     * returns false or the user array
     **/
    public function getUser(): mixed
    {
        return $this->authenticatedUser();
    }

    /*************************
     *
     * SQL Functions
     *
     *************************/
    /**
     * This returns the restrictions needed to select the user respecting
     * enable columns and flags like deleted, hidden, starttime, endtime
     * and rootLevel
     *
     * @return QueryRestrictionContainerInterface
     * @internal
     */
    protected function restrictionConstraints(): QueryRestrictionContainerInterface
    {
        $restrictionContainer = GeneralUtility::makeInstance(DefaultRestrictionContainer::class);

        if (empty($this->enableColumns['hidden_disabled'])) {
            $restrictionContainer->removeByType(HiddenRestriction::class);
        }

        if (empty($this->enableColumns['deleted'])) {
            $restrictionContainer->removeByType(DeletedRestriction::class);
        }

        if (empty($this->enableColumns['starttime'])) {
            $restrictionContainer->removeByType(StartTimeRestriction::class);
        }

        if (empty($this->enableColumns['endtime'])) {
            $restrictionContainer->removeByType(EndTimeRestriction::class);
        }

        if (!empty($this->enableColumns['rootLevel'])) {
            $restrictionContainer->add(GeneralUtility::makeInstance(RootLevelRestriction::class, [$this->user_table]));
        }

        return $restrictionContainer;
    }

    /**
     * Updates the last usage and counter in found user token with the given id
     *
     * @param array $tokenRecord
     * 
     * @return void
     * 
     */
    protected function updateUserToken(array $tokenRecord) : void
    {
        if ($this->token_lastAccess_column) {
            $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($this->token_table);
            $connection->update(
                $this->token_table,
                [
                    $this->token_lastAccess_column => $GLOBALS['EXEC_TIME'],
                    $this->token_usageCounter_column => $tokenRecord[$this->token_usageCounter_column] + 1
                ],
                [
                    'uid' => $tokenRecord['uid']
                ]
            );
            $this->user[$this->token_lastAccess_column] = $GLOBALS['EXEC_TIME'];
        }
    }

}
