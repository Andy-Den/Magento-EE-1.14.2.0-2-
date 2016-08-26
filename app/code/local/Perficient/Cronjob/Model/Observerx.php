<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/27/2015
 * Time: 12:19 PM
 */
class Perficient_Cronjob_Model_Observerx
{
    public function doSomething()
    {
        Mage::log("TEST success", null, "dev.log");

        $emailCronStatus= Mage::getStoreConfig(
            'system/perficient_cron/perficient_cron_status'
        );

        if($emailCronStatus==1) {
            $emailSender = Mage::getStoreConfig(
                'system/perficient_cron/perficient_cron_emailsender'
            );

            if ($emailSender == 'general') {
                $fromName = Mage::getStoreConfig(
                    'trans_email/ident_general/name'
                );
                $fromEmail = Mage::getStoreConfig(
                    'trans_email/ident_general/email'
                );
            } else if($emailSender=='sales'){

                $fromName= Mage::getStoreConfig(
                    'trans_email/ident_sales/name'
                );
                $fromEmail= Mage::getStoreConfig(
                    'trans_email/ident_sales/email'
                );
            }else if($emailSender=='support'){

                $fromName= Mage::getStoreConfig(
                    'trans_email/ident_support/name'
                );
                $fromEmail=  Mage::getStoreConfig(
                    'trans_email/ident_support/email'
                );
            }else if($emailSender=='custom1'){

                $fromName=  Mage::getStoreConfig(
                    'trans_email/ident_custom1/name'
                );
                $fromEmail=  Mage::getStoreConfig(
                    'trans_email/ident_custom1/email'
                );
            }else{

                $fromName= Mage::getStoreConfig(
                    'trans_email/ident_custom2/name'
                );
                $fromEmail= Mage::getStoreConfig(
                    'trans_email/ident_custom2/email'
                );
            }

            $emailTo = Mage::getStoreConfig(
                'system/perficient_cron/perficient_cron_emalsto'
            );
            $emailSubject = Mage::getStoreConfig(
                'system/perficient_cron/perficient_cron_subject'
            );
            $emailContant = Mage::getStoreConfig(
                'system/perficient_cron/perficient_cron_content'
            );
            $fromEmail = $fromEmail;
            $fromName = $fromName; // sender name

            $toEmail = $emailTo;
            $toName = "Mark Doe"; // recipient name

            $body =$emailContant; // body text
            $subject = $emailSubject; // subject text

           $emailTemplate  = Mage::getModel('core/email_template')
                ->loadDefault('cron_email');

            //Create an array of variables to assign to template
            $emailTemplateVariables = array();
            $emailTemplateVariables['fromName'] = $fromName;
            $emailTemplateVariables['fromEmail'] = $fromEmail;

            $emailTemplateVariables['toEmail'] = $toEmail;
            $emailTemplateVariables['toName'] = $toName;
            $emailTemplateVariables['subject'] = $emailSubject;
            $emailTemplateVariables['content'] = $body;

            $emailTemplate->setSenderName($fromName);
            $emailTemplate->setSenderEmail($fromEmail);
            $emailTemplate->setType('html');
            $emailTemplate->setTemplateSubject($subject);
//            setTemplateCode('email_template1')->save();
            //$processedTemplate = $emailTemplate->
           // getProcessedTemplate($emailTemplateVariables);
            //echo "<pre>sdsfsdfsd";
            //print_r($processedTemplate); exit;
            $emailTemplate->send($emailTemplateVariables['toEmail'],
                $emailTemplateVariables['toName'], $emailTemplateVariables);


            }

    }
}