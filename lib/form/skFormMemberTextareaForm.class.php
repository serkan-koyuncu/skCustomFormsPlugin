<?php

/**
 *
 * @author Serkan
 *
 */
class skFormMemberTextareaForm extends skFormMemberForm implements skCustomFormMemberWidget
{
    function configure()
    {
        $this->widgetSchema['class'] = new sfWidgetFormInputText();
        $this->validatorSchema['class'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->widgetSchema['max'] = new sfWidgetFormInputText();
        $this->validatorSchema['max'] = new sfValidatorInteger(array('required' => false));
        $this->widgetSchema['max_error'] = new sfWidgetFormInputText();
        $this->validatorSchema['max_error'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->widgetSchema['required'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['required'] = new sfValidatorBoolean(array('required' => false));
        $this->widgetSchema['required_message'] = new sfWidgetFormInputText();
        $this->validatorSchema['required_message'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->widgetSchema['html'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['html'] = new sfValidatorBoolean(array('required' => false));
        $this->widgetSchema['html_options'] = new sfWidgetFormInputText();
        $this->validatorSchema['html_options'] = new sfValidatorString(array('max_length' => 255, 'required' => false));

        $this->widgetSchema->setLabels(array(
            'max' => 'Max characters',
        ));

        $this->genisYap(array('max_error', 'required_message'));
        $this->widgetSchema->moveField('class', sfWidgetFormSchema::AFTER, 'varsayilan');
        $this->widgetSchema->moveField('max', sfWidgetFormSchema::AFTER, 'class');
        $this->widgetSchema->moveField('max_error', sfWidgetFormSchema::AFTER, 'max');
        $this->widgetSchema->moveField('required', sfWidgetFormSchema::AFTER, 'max_error');
        $this->widgetSchema->moveField('required_message', sfWidgetFormSchema::AFTER, 'required');
        $this->widgetSchema->moveField('html', sfWidgetFormSchema::AFTER, 'required_message');
        $this->widgetSchema->moveField('html_options', sfWidgetFormSchema::AFTER, 'html');
    }

    /**
     *
     * @param skFormMember $member
     * @return sfWidgetForm
     */
    public static function getCustomWidget($member)
    {
        $widget = new sfWidgetFormTextarea();

        $widget->setLabel($member->label);

        // default value
        if ( strlen($member->varsayilan) ) {
            $widget->setDefault($member->varsayilan);
        }

        $widget->setAttribute('class', 'span8');
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
        $validator = new sfValidatorString(array('required' => (boolean)$member->required));

        // Length check
        if ( $member->max ) {
            $validator->setOption('max_length', $member->max);
            if ( strlen($member->max_error) ) {
                $validator->setMessage('max_length', $member->max_error);
            }
        }

        // Required
        if ( $member->required ) {
            if ( strlen($member->required_message) ) {
                $validator->setMessage('required', $member->required_message);
            } else {
                $validator->setMessage('required', 'Required');
            }
        }

        return $validator;
    }

}