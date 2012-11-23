<?php

/**
 *
 * @author Serkan KOYUNCU
 *
 */
class skCustomFormsMemberRenderer extends skCustomFormsMemberBaseRenderer
{
    /**
     *
     * @param skFormMember $member
     * @return void
     */
    public function addMember($member)
    {
        $class_name = 'skFormMember' . ucfirst($member->tip) . 'Form';
        if (!class_exists($class_name)) {
            $class_name = 'skFormMemberForm';
        }

        if ( is_callable($class_name . '::getCustomWidget') ) {
            $this->widgetSchema[$member->title] = call_user_func($class_name .'::getCustomWidget', $member);
            if ( strlen($member->description) ) {
                $this->widgetSchema->setHelp($member->title, $member->description);
            }
        }

        if ( is_callable($class_name . '::getCustomValidator') ) {
            $this->validatorSchema[$member->title] = call_user_func($class_name .'::getCustomValidator', $member);
        }
    }

}