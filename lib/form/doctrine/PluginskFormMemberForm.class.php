<?php

/**
 * PluginskFormMember form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginskFormMemberForm extends BaseskFormMemberForm
{
    public function setupInheritance()
    {
        parent::setupInheritance();

        $this->widgetSchema['tip'] = new sfWidgetFormChoice(array('choices' => skFormMemberTable::getTypeChoices($this->isNew()) ));
        $this->validatorSchema['tip'] = new sfValidatorChoice(array('choices' => array_keys( skFormMemberTable::getTypeChoices($this->isNew()) )));


        $this->useFields(array('title', 'tip', 'varsayilan'));
        $this->genisYap(array('title', 'tip', 'varsayilan'));

        $this->cokluDil();

        $this->widgetSchema->setLabels(array(
            'title' => 'Name',
            'tip' => 'Type',
            'varsayilan' => 'Default',
        ));

    }

}
