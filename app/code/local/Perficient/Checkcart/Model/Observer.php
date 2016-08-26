<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 12/4/2015
 * Time: 4:23 PM
 */
class Perficient_Checkcart_Model_Observer {

    public function addtocartEvent(Varien_Event_Observer $observer) {

        $customer = Mage::getSingleton('customer/session')->getCustomer();
//        print_r($customer);
//
//
//
//       exit;
       // $observermsg =  "The event triggered>>> <B>" . $event->getName() . "</B><br/> The added product>>> <B> " . $product->getName()."</B>";
        //Adds the message to the shopping cart
         Mage::getSingleton('checkout/session')->addSuccess($observermsg);
    }

    public function autoApproveReview(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();
        $reviewObjData = $event->getData();
        //print_r($reviewObjData);exit;

        $reviewData=$reviewObjData["data_object"];
        $reviewData->setStatusId(Mage_Review_Model_Review::STATUS_APPROVED);

        echo Mage::getSingleton('core/session')
            ->addSuccess("Thank you for your input!!");
    }
}