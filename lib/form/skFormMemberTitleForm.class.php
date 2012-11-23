<?php

/**
 *
 * @author Serkan
 *
 */
class skFormMemberTitleForm extends skFormMemberForm
{
    function configure()
    {
        unset($this['varsayilan']);
    }
}