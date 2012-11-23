<?php

/**
 *
 * @author Serkan KOYUNCU <serkan@koyuncu.org>
 *
 */
class BaseskCustomFormsComponents extends sfComponents
{
    public function executeRender( $request ) {
        $form_values = $request->getParameter('sk_custom_form', array('form_id' => 0));
        $this->form_id = $form_values['form_id'] > 0 ? $form_values['form_id'] : $this->form_id;

        $this->sk_form = skFormTable::getInstance()->findOneById($this->form_id);

        if ( $this->sk_form ) {
            $this->form = $this->sk_form->initializeForm();
        }

        if ( $request->isMethod('post') && $request->hasParameter('sk_custom_form') )
        {
            $son_gonderme = $this->getUser()->getAttribute('son_gonderme', time()-300);
            $fark = time() - $son_gonderme;

            if ( $fark > 120 ) {

                $this->form->bind($request->getParameter('sk_custom_form'));
                if ($this->form->isValid())
                {
                    $form_data = $this->form->saveFormData();

                    $body = $this->getPartial('skCustomForms/form_content', array('form' => $this->form, 'form_data' => $form_data));
                    $from = sfConfig::get('app_mailer_username');

                    // @todo: formdaki kişilere alıcılara form içeriğini mail at
    				foreach( $this->sk_form->parseEmails() as $email )
    				{
    				    $message = $this->getMailer()->compose();
    				    $message->setSubject( $this->sk_form->subject_prefix );
    				    $message->setTo( $email );
    				    $message->setFrom( $from );
    				    $message->setBody($body, 'text/html');

    				    $this->getMailer()->send( $message );
    				}

    				$this->getUser()->setAttribute('son_gonderme', time());

                    //@todo: mesajı, form içeriğine göre düzenlenecek. %name% gibi form isimleri form değerleri ile değiştirilecek.
                    $this->getUser()->setFlash('notice', $this->sk_form->mesaj);

                    // redirect to referer
                    sfContext::getInstance()->getController()->redirect( $request->getReferer() );
                }
            } else {
                die();
                //sfContext::getInstance()->getController()->redirect( $request->getReferer() );
            }
        }
    }

    public function getPartial($templateName, $vars = null)
    {
        $this->getContext()->getConfiguration()->loadHelpers('Partial');

        $vars = null !== $vars ? $vars : $this->varHolder->getAll();

        return get_partial($templateName, $vars);
    }

}
