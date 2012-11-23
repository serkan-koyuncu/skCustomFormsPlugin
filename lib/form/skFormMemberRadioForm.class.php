<?php

/**
 *
 * @author Serkan
 *
 */
class skFormMemberRadioForm extends skFormMemberForm implements skCustomFormMemberWidget
{
    function configure()
    {
        $this->widgetSchema['class'] = new sfWidgetFormInputText();
        $this->validatorSchema['class'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->widgetSchema['items'] = new sfWidgetFormTextarea();
        $this->validatorSchema['items'] = new sfValidatorString(array('max_length' => 40000, 'required' => false));
        $this->widgetSchema['item_values'] = new sfWidgetFormTextarea();
        $this->validatorSchema['item_values'] = new sfValidatorString(array('max_length' => 40000, 'required' => false));

        $this->widgetSchema['required'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['required'] = new sfValidatorBoolean(array('required' => false));
        $this->widgetSchema['required_message'] = new sfWidgetFormInputText();
        $this->validatorSchema['required_message'] = new sfValidatorString(array('max_length' => 255, 'required' => false));


        $this->genisYap(array('items', 'item_values', 'required_message'));
        $this->widgetSchema->moveField('class', sfWidgetFormSchema::AFTER, 'varsayilan');
        $this->widgetSchema->moveField('items', sfWidgetFormSchema::AFTER, 'class');
        $this->widgetSchema->moveField('item_values', sfWidgetFormSchema::AFTER, 'items');
        $this->widgetSchema->moveField('required', sfWidgetFormSchema::AFTER, 'item_values');
        $this->widgetSchema->moveField('required_message', sfWidgetFormSchema::AFTER, 'required');
            }

    /**
     *
     * @param skFormMember $member
     * @return sfWidgetForm
     */
    public static function getCustomWidget($member)
    {
        $items = self::getMemberItems($member);
        if ( 0 == count($items) )
        {
            throw new sfException('Please add some items for this member: ' . $member->title);
        }

        $widget = new sfWidgetFormChoiceCustomForm(array('choices' => $items, 'multiple' => false, 'expanded' => true));
        $widget->setLabel($member->label);

        // default value
        if ( strlen($member->varsayilan) ) {
            $widget->setDefault($member->varsayilan);
        }

        $widget->setOption('renderer_options', array('class' => 'inputs-list'));

        // css class
        if ( strlen($member->class) ) {
            $widget->setAttribute('class', $widget->getAttribute('class') . ' ' . $member->class);
        }

        return $widget;
    }

    /**
     *
     * @param skFormMember $member
     * @return sfValidator
     */
    public static function getCustomValidator($member)
    {
        $validator = new sfValidatorChoice(array('choices' => array_keys(self::getMemberItems($member))));

        // Required
        if ( $member->required ) {
            if ( strlen($member->required_message) ) {
                $validator->setMessage('required', $member->required_message);
            }
        }

        return $validator;
    }


}