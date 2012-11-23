<?php

/**
 *
 * @author Serkan
 *
 */
class skFormMemberNumericForm extends skFormMemberForm implements skCustomFormMemberWidget
{
    function configure()
    {
        $this->widgetSchema['allow_float'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['allow_float'] = new sfValidatorBoolean(array('required' => false));
        $this->widgetSchema['class'] = new sfWidgetFormInputText();
        $this->validatorSchema['class'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->widgetSchema['min'] = new sfWidgetFormInputText();
        $this->validatorSchema['min'] = new sfValidatorInteger(array('required' => false));
        $this->widgetSchema['min_error'] = new sfWidgetFormInputText();
        $this->validatorSchema['min_error'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->widgetSchema['max'] = new sfWidgetFormInputText();
        $this->validatorSchema['max'] = new sfValidatorInteger(array('required' => false));
        $this->widgetSchema['max_error'] = new sfWidgetFormInputText();
        $this->validatorSchema['max_error'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->widgetSchema['required'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['required'] = new sfValidatorBoolean(array('required' => false));
        $this->widgetSchema['required_message'] = new sfWidgetFormInputText();
        $this->validatorSchema['required_message'] = new sfValidatorString(array('max_length' => 255, 'required' => false));

        $this->widgetSchema->setLabels(array(
            'max' => 'Max number',
            'min' => 'Min number',
            'allow_float' => 'Allow floats',
        ));

        $this->genisYap(array('max_error', 'required_message'));
        $this->widgetSchema->moveField('allow_float', sfWidgetFormSchema::AFTER, 'varsayilan');
        $this->widgetSchema->moveField('class', sfWidgetFormSchema::AFTER, 'allow_float');
        $this->widgetSchema->moveField('min', sfWidgetFormSchema::AFTER, 'class');
        $this->widgetSchema->moveField('min_error', sfWidgetFormSchema::AFTER, 'min');
        $this->widgetSchema->moveField('max', sfWidgetFormSchema::AFTER, 'min_error');
        $this->widgetSchema->moveField('max_error', sfWidgetFormSchema::AFTER, 'max');
        $this->widgetSchema->moveField('required', sfWidgetFormSchema::AFTER, 'max_error');
        $this->widgetSchema->moveField('required_message', sfWidgetFormSchema::AFTER, 'required');
    }

    /**
     *
     * @param skFormMember $member
     * @return sfWidgetForm
     */
    public static function getCustomWidget($member)
    {
        $widget = new sfWidgetFormInputText();

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
        $validator = $member->allow_float ? new sfValidatorNumber(array('required' => (boolean)$member->required)) : new sfValidatorInteger(array('required' => (boolean)$member->required));

        // Length check
        if ( $member->min ) {
            $validator->setOption('min_length', $member->min);
            if ( strlen($member->min_error) ) {
                $validator->setMessage('min_length', $member->min_error);
            }
        }

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