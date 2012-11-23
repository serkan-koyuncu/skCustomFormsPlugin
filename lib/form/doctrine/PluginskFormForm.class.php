<?php

/**
 * PluginskForm form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginskFormForm extends BaseskFormForm
{
    public function setupInheritance()
    {
        parent::setupInheritance();

        $this->useFields(array('title', 'emails', 'subject_prefix'));
        $this->cokluDil();

        //$this->widgetSchema['email'] = new sfWidgetFormTextarea();
        $this->validatorSchema['emails']->setOption('required', true);
        $this->genisYap(array('emails'));

        $this->validatorSchema['subject_prefix']->setOption('required', true);

        $idx = 1;
        $pForm = new sfForm();
        foreach ($this->getObject()->FormMembers as $form_member) {
            $class_name = 'skFormMember' . ucfirst($form_member->tip) . 'Form';
            if (!class_exists($class_name)) {
                $class_name = 'skFormMemberForm';
            }

            $pForm->embedForm('member_'.$form_member->id, new $class_name($form_member));
            $label = "Member " + $idx++;
            $pForm->widgetSchema->setLabel('member_'.$form_member->id, $label);
        }

        if ( $idx > 1 )
            $this->embedForm('form_members', $pForm);

        $newObj = new skFormMember();
        $newObj->doDefaults();
        $newObj->setForm($this->getObject());
        $newObjForm = new skFormMemberForm($newObj);
        $this->embedForm('new_eleman_1', $newObjForm);
        $this->widgetSchema->setLabel('new_eleman_1', 'New Member');



        $this->widgetSchema->setLabels(array(
            'title' => 'Form name',
            'emails' => 'E-Mails',
        ));
        $this->widgetSchema->setHelps(array(
            'title' => 'For internal use',
            'emails' => 'One email each line. You can use domain name like this: %domain%',
            'subject_prefix' => 'Example: [brokerage-form]: ',
        ));


    }

  protected function doSave($con = null) {
  	if (!$this->values['new_eleman_1']['title'])
  	  unset($this['new_eleman_1']);

    parent::doSave($con);
  }

}
