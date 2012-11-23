<?php

/**
 *
 * @author Serkan KOYUNCU
 *
 */
abstract class skCustomFormsMemberBaseRenderer extends BaseForm
{
  private $_form_object;

  abstract public function addMember($member);

  /**
   * @return skForm
   */
  public function getFormObject()
  {
      return $this->_form_object;
  }

  /**
   *
   * @param skForm $obj
   */
  public function setFormObject($obj)
  {
      $this->_form_object = $obj;
  }

  public function setup()
  {
    $this->setFormObject($this->getOption('form_object'));

    $this->widgetSchema['form_id'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['form_id'] = new sfValidatorChoice(array('choices' => array($this->getFormObject()->get('id')), 'empty_value' => $this->getFormObject()->get('id'), 'required' => false));

    $this->widgetSchema->setDefault('form_id', $this->getFormObject()->get('id'));

    foreach($this->getOption('members', array()) as $member)
    {
        $this->addMember($member);
    }

    parent::setup();

    $this->widgetSchema->setNameFormat('sk_custom_form[%s]');
  }

  /**
   * @return skFormData
   */
  public function saveFormData()
  {
    $fd = new skFormData();
    $fd->setForm( $this->getFormObject() );
    $fd->save();

    foreach ( $this->getFormObject()->getFormMembersOrdered() as $member )
    {
        $form_member = new skFormMemberData();
        $form_member->FormData = $fd;
        $form_member->FormMember = $member;
        $form_member->value = serialize( $this->getValue( $member->title ) );

        $form_member->save();
    }

    return $fd;
  }

}