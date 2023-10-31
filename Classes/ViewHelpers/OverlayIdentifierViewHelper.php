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

        $item = $arguments['item'];

        $hidden = null;
        $disable = null;
        $starttime = null;
        $endtime = null;

        if (is_array($item)) {

            if (isset($item['hidden'])) {
                $hidden = $item['hidden'];
            }

            if (isset($item['disable'])) {
                $disable = $item['disable'];
            }

            if (isset($item['starttime'])) {
                $starttime  = $item['starttime'];
            }

            if (isset($item['endtime'])) {
                $endtime = $item['endtime'];
            }

        } else {

            if (method_exists($item, 'getHidden')) {
                $hidden = $item->getHidden();
            }

            if (method_exists($item, 'getDisable')) {
                $disable = $item->getDisable();
            }

            if (method_exists($item, 'getStarttime')) {
                $starttime = $item->getStarttime();
            }

            if (method_exists($item, 'getEndtime')) {
                $endtime = $item->getEndtime();
            }
        }

        if ($starttime instanceof \DateTime) {
            $starttime = $starttime->getTimestamp();
        }

        if ($endtime instanceof \DateTime) {
            $endtime = $endtime->getTimestamp();
        }

        if ($hidden || $disable) {
            return 'overlay-hidden';
        }

        $now = (new \DateTime())->getTimestamp();

        if ($endtime && $now > $endtime) {
            return 'overlay-endtime';
        }

        if (!$starttime) {
            return '';
        }

        if (
            ($starttime && $now < $starttime) ||
            ($endtime && $now < $endtime)
        ) {
            return 'overlay-scheduled';
        }

        return '';
   }
}