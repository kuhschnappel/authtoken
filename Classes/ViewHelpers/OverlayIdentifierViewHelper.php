<?php
namespace Kuhschnappel\Authtoken\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class OverlayIdentifierViewHelper extends AbstractViewHelper
{
   protected $escapeOutput = false;

   public function initializeArguments()
   {
       $this->registerArgument('item', 'string', 'The item object with enabled fields to calculate response', true);
   }

   /**
    * Overlay icon identifier for enabled fields
    * xmlns:authtoken="http://typo3.org/ns/Kuhschnappel/Authtoken/ViewHelpers"
    * {authtoken:overlayIdentifier(item: feuser)}
    *
    * @param array $arguments
    * @param \Closure $renderChildrenClosure
    * @param RenderingContextInterface $renderingContext
    * @return void
    */
   public static function renderStatic(
       array $arguments,
       \Closure $renderChildrenClosure,
       RenderingContextInterface $renderingContext
   ) {

        if (method_exists($arguments['item'], 'getHidden') && $arguments['item']->getHidden()) {
            return 'overlay-hidden';
        }

        if (method_exists($arguments['item'], 'getDisable') && $arguments['item']->getDisable()) {
            return 'overlay-hidden';
        }

        if (!method_exists($arguments['item'], 'getEndtime')) {
            return '';
        }

        $now = new \DateTime();

        if ($arguments['item']->getEndtime() && $now > $arguments['item']->getEndtime()) {
            return 'overlay-endtime';
        }

        if (!method_exists($arguments['item'], 'getEndtime')) {
            return '';
        }

        if (
            ($arguments['item']->getStarttime() && $now < $arguments['item']->getStarttime()) ||
            ($arguments['item']->getEndtime() && $now < $arguments['item']->getEndtime())
        ) {
            return 'overlay-scheduled';
        }

        return '';
   }
}