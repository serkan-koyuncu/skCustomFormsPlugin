<?php

/**
 *
 * @author Serkan
 *
 */
class skFormMemberTarihForm extends skFormMemberForm implements skCustomFormMemberWidget
{
    function configure()
    {
        $this->widgetSchema['is_date'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['is_date'] = new sfValidatorBoolean(array('required' => false));
        $this->widgetSchema['date_format'] = new sfWidgetFormInputText();
        $this->validatorSchema['date_format'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->widgetSchema['is_time'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['is_time'] = new sfValidatorBoolean(array('required' => false));
        $this->widgetSchema['time_format'] = new sfWidgetFormInputText();
        $this->validatorSchema['time_format'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->widgetSchema['is_range'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['is_range'] = new sfValidatorBoolean(array('required' => false));
        $this->widgetSchema['max_date'] = new sfWidgetFormDateTime();
        $this->validatorSchema['max_date'] = new sfValidatorDateTime(array('required' => false));
        $this->widgetSchema['max_error'] = new sfWidgetFormInputText();
        $this->validatorSchema['max_error'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
        $this->widgetSchema['min_date'] = new sfWidgetFormDateTime();
        $this->validatorSchema['min_date'] = new sfValidatorDateTime(array('required' => false));
        $this->widgetSchema['min_error'] = new sfWidgetFormInputText();
        $this->validatorSchema['min_error'] = new sfValidatorString(array('max_length' => 255, 'required' => false));


        $this->widgetSchema['required'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['required'] = new sfValidatorBoolean(array('required' => false));
        $this->widgetSchema['required_message'] = new sfWidgetFormInputText();
        $this->validatorSchema['required_message'] = new sfValidatorString(array('max_length' => 255, 'required' => false));

        $this->widgetSchema->setLabels(array(
            'max_date' => 'Max date',
            'min_date' => 'Min date',
        ));

        $this->widgetSchema->setHelps(array(
            'max_error' => 'Placeholder: %max% ; For example: "The date must be before %max%."',
            'min_error' => 'Placeholder: %min% ; For example: "The date must be after %min%."',
        ));

        $this->genisYap(array('min_error', 'max_error', 'required_message'));
        $this->widgetSchema->moveField('is_date', sfWidgetFormSchema::AFTER, 'varsayilan');
        $this->widgetSchema->moveField('date_format', sfWidgetFormSchema::AFTER, 'is_date');
        $this->widgetSchema->moveField('is_time', sfWidgetFormSchema::AFTER, 'date_format');
        $this->widgetSchema->moveField('time_format', sfWidgetFormSchema::AFTER, 'is_time');
        $this->widgetSchema->moveField('is_range', sfWidgetFormSchema::AFTER, 'time_format');
        $this->widgetSchema->moveField('min_date', sfWidgetFormSchema::AFTER, 'is_range');
        $this->widgetSchema->moveField('min_error', sfWidgetFormSchema::AFTER, 'min_date');
        $this->widgetSchema->moveField('max_date', sfWidgetFormSchema::AFTER, 'min_error');
        $this->widgetSchema->moveField('max_error', sfWidgetFormSchema::AFTER, 'max_date');
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
        $culture = sfContext::getInstance()->getUser()->getCulture();

        if ( $member->is_date && $member->is_time ) {
            $widget = new sfWidgetFormI18nDateTime(array('culture' => $culture, 'date' => array('format' => $member->date_format), 'time' => array('format_without_seconds' => $member->time_format)));
        } elseif ($member->is_time) {
            $widget = new sfWidgetFormI18nTime(array('culture' => $culture, 'format_without_seconds' => $member->time_format));
        } elseif ($member->is_date) {
            $widget = new sfWidgetFormI18nDate(array('culture' => $culture, 'format' => $member->date_format));
        } else {
            throw new sfException('Please set date or time or both');
        }

        $widget->setAttribute('class', 'narrow-select');

        return $widget;
    }

    /**
     *
     * @param skFormMember $member
     * @return sfValidator
     */
    public static function getCustomValidator($member)
    {
        if ( $member->is_date && $member->is_time ) {
            $validator = new sfValidatorDateTime(array('required' => $member->required));
        } elseif ($member->is_time) {
            $validator = new sfValidatorTime(array('required' => $member->required));
        } elseif ($member->is_date) {
            $validator = new sfValidatorDate(array('required' => $member->required));
        } else {
            throw new sfException('Please set date or time or both');
        }

        if ( $member->is_date )
        {
            if ( !is_null($member->min_date) )
            {
                $validator->setOption('min', $member->min_date);
                $validator->setMessage('min', $member->min_error);
            }

            if ( !is_null($member->max_date) )
            {
                $validator->setOption('max', $member->max_date);
                $validator->setMessage('max', $member->max_error);
            }
        }

        return $validator;
    }

}
