<?php

/**
 *
 * @package    skCustomFormsPlugin
 * @subpackage skCustomFormsAdmin
 * @author     Serkan Koyuncu <serkan@koyuncu.org>
 * @version    SVN: $Id: skCustomFormsAdminGeneratorHelper.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class skCustomFormsAdminGeneratorHelper extends BaseSkCustomFormsAdminGeneratorHelper
{
    public function linkToPromote($object, $params, $child)
    {
        return '<li class="sf_admin_action_promote">'.link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('member_promote') . '?id='.$object->id . '&member_id='.$child->id).'</li>';
    }

    public function linkToDemote($object, $params, $child)
    {
        return '<li class="sf_admin_action_demote">'.link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('member_demote') . '?id='.$object->id . '&member_id='.$child->id).'</li>';
    }

    public function linkToMemberDelete($object, $params, $child)
    {
        return '<li class="sf_admin_action_delete">'.link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('member_delete') . '?id='.$object->id . '&member_id='.$child->id).'</li>';
    }

    public function urlForMemberCopy($object)
    {
        return url_for('@'.$this->getUrlForAction('member_copy') . '?id='.$object->id);
    }

}
