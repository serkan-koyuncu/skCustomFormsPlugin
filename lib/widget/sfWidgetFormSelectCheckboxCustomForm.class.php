<?php

/**
 *
 * @author Serkan KOYUNCU <serkan@koyuncu.org>
 *
 */
class sfWidgetFormSelectCheckboxCustomForm extends sfWidgetFormSelectCheckbox
{
    protected function configure($options = array(), $attributes = array())
    {
        parent::configure($options, $attributes);

        $this->addOption('formatter', array($this, 'formatter_flat'));
        $this->addOption('label_separator', '');
    }

    protected function formatChoices($name, $value, $choices, $attributes)
    {
        $inputs = array();
        foreach ($choices as $key => $option)
        {
            $baseAttributes = array(
                    'name'  => $name,
                    'type'  => 'checkbox',
                    'value' => self::escapeOnce($key),
                    'id'    => $id = $this->generateId($name, self::escapeOnce($key)),
            );

            if ((is_array($value) && in_array(strval($key), $value)) || (is_string($value) && strval($key) == strval($value)))
            {
                $baseAttributes['checked'] = 'checked';
            }

            $inputs[$id] = array(
                    'input' => $this->renderTag('input', array_merge($baseAttributes, $attributes)),
                    'label' => self::escapeOnce($option),
            );
        }

        return call_user_func($this->getOption('formatter'), $this, $inputs);
    }

    public function formatter_flat($widget, $inputs)
    {
        $rows = array();
        foreach ($inputs as $input)
        {
            $rows[] = $this->renderContentTag('li', content_tag('label', $input['input'].$this->getOption('label_separator').content_tag('span', $input['label'])));
        }

        return !$rows ? '' : $this->renderContentTag('ul', implode($this->getOption('separator'), $rows), array('class' => $this->getOption('class')));
    }

}