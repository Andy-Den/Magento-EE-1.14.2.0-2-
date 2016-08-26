<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/19/2015
 * Time: 6:10 PM

 * Our class name should follow the directory structure of
 * our Observer.php model, starting from the namespace,
 * replacing directory separators with underscores.
 * i.e. app/code/local/Perficient/
 *                     LogProductUpdate/Model/Observer.php
 */
class Perficient_LogProductUpdate_Model_Observer
{
    /**
     * Magento passes a Varien_Event_Observer object as
     * the first parameter of dispatched events.
     */
    public function logUpdate(Varien_Event_Observer $observer)
    {
        // Retrieve the product being updated from the event observer
        $product = $observer->getEvent()->getProduct();

        // Write a new line to var/log/product-updates.log
        $name = $product->getName();
        $sku = $product->getSku();
        Mage::log(
            "{$name} ({$sku}) updated",
            null,
            'product-updates.log'
        );
    }
}