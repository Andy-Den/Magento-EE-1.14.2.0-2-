<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/25/2015
 * Time: 3:12 PM
 */
class Perficient_Contact_IndexController
            extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        //Get current layout state
        $this->loadLayout();

        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'perficient.contact',
            array(
                'template' => 'perficient/contact.phtml'
            )
        );

        $this->getLayout()->getBlock('content')->append($block);
        $this->_initLayoutMessages('core/session');

        $this->renderLayout();
    }

    public function sendemailAction()
    {
        //Fetch submited params
        $params = $this->getRequest()->getParams();

        $mail = new Zend_Mail();
        $mail->setBodyText($params['comment']);
        $mail->setFrom($params['email'], $params['name']);
        $mail->addTo('harishankar.malviya@perficient.com', 'Hari Shankar');
        $mail->setSubject('Perficient Contact Module for Magento');
        try {
            $mail->send();
        }
        catch(Exception $ex) {
            Mage::getSingleton('core/session')->addError('Unable to send email. Sample of a custom notification error from Inchoo_SimpleContact.');

        }

            $this->_redirect('pcontact/');
    }
}
