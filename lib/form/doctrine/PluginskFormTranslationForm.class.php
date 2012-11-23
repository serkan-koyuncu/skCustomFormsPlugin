<?php

/**
 * PluginskFormTranslation form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginskFormTranslationForm extends BaseskFormTranslationForm
{
    public function setupInheritance()
    {
        parent::setupInheritance();

        $this->useFields(array('baslik', 'description', 'button_text', 'mesaj'));
        $this->genisYap(array('baslik', 'description', 'button_text', 'mesaj'));

        $this->widgetSchema->setLabels(array(
            'baslik' => 'Title',
            'description' => 'Description',
            'button_text' => 'Button label',
            'mesaj' => 'Message',
        ));

        $this->widgetSchema->setHelps(array(
            'baslik' => 'Form title',
            'description' => 'Form description, will be placed next to title.',
            'button_text' => 'Form\'s submit button label',
            'mesaj' => 'This message will be shown after form submission. You can place form variables like %%name%%',
        ));

    }

}
