<?php
namespace Kuhschnappel\Authtoken\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Kuhschnappel\Authtoken\Domain\Repository\TokenRepository;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;

class TokenController extends ActionController
{
    /**
     * @param ModuleTemplateFactory $moduleTemplateFactory
     * @param TokenRepository $tokenRepository
     */
    public function __construct(
        protected ModuleTemplateFactory $moduleTemplateFactory,
        protected TokenRepository $tokenRepository
    ) {
    }

    public function listAction()
    {
        $this->view->assign("tokens", $this->tokenRepository->findAll());

        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        $moduleTemplate->setContent($this->view->render());
        return $this->htmlResponse($moduleTemplate->renderContent());
    }

}
