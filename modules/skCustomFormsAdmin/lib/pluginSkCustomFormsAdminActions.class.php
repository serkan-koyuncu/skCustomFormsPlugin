<?php

require_once dirname(__FILE__).'/../lib/skCustomFormsAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/skCustomFormsAdminGeneratorHelper.class.php';

/**
 *
 * @package     skCustomFormsPlugin
 * @subpackage  skCustomFormsAdmin
 * @author      Serkan Koyuncu <serkan@koyuncu.org>
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
class pluginSkCustomFormsAdminActions extends autoSkCustomFormsAdminActions
{
    public function executeMembers_list(sfWebRequest $request)
    {
        $this->custom_form = $this->getRoute()->getObject();
        $this->members = $this->custom_form->getFormMembersOrdered();
    }

    public function executeMember_promote(sfWebRequest $request)
    {
        $object = Doctrine::getTable('skFormMember')->findOneById($this->getRequestParameter('member_id'));
        $this->forward404Unless($object);
        $object->promote();
        $this->redirect("@sk_custom_forms_admin_members_list?id=".$request->getParameter('id'));
    }

    public function executeMember_demote(sfWebRequest $request)
    {
        $object = Doctrine::getTable('skFormMember')->findOneById($this->getRequestParameter('member_id'));
        $this->forward404Unless($object);
        $object->demote();
        $this->redirect("@sk_custom_forms_admin_members_list?id=".$request->getParameter('id'));
    }

    public function executeMember_delete(sfWebRequest $request)
    {
        $object = Doctrine::getTable('skFormMember')->findOneById($this->getRequestParameter('member_id'));
        $this->forward404Unless($object);
        $object->delete();
        $this->redirect("@sk_custom_forms_admin_members_list?id=".$request->getParameter('id'));
    }

    public function executeMember_copy(sfWebRequest $request)
    {
        $object = Doctrine::getTable('skFormMember')->findOneById($this->getRequestParameter('member_id'));
        $this->forward404Unless($object);

        $object->copyToForm($request->getParameter('id'));

        $this->redirect("@sk_custom_forms_admin_members_list?id=".$request->getParameter('id'));
    }

    public function executeGetforms(sfWebRequest $request)
    {
        $this->getResponse()->setContentType('text/json');
        $data = skFormTable::getAllForms();

        $tmp = array();
        foreach ( $data as $form )
        {
            $tmp[] = array('id' => $form->id, 'title' => (string)$form);
        }

        return $this->renderText( json_encode( $tmp ) );
    }

}
