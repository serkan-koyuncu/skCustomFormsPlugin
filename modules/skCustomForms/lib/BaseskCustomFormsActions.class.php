<?php

/**
 * Base actions for the skCustomFormsPlugin skCustomForms module.
 *
 * @package     skCustomFormsPlugin
 * @subpackage  skCustomForms
 * @author      Serkan Koyuncu <serkan@koyuncu.org>
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class BaseskCustomFormsActions extends sfActions
{
    public function executeSave($r)
    {
        $this->referer = $r->getReferer();
    }

}
