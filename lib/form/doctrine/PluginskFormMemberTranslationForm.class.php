<?php

/**
 * PluginskFormMemberTranslation form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginskFormMemberTranslationForm extends BaseskFormMemberTranslationForm
{
    public function setupInheritance()
    {
        parent::setupInheritance();

        $this->useFields(array('label', 'description'));
        $this->genisYap(array('label', 'description'));

    }

}
