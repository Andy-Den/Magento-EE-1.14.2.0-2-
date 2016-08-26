<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 12/2/2015
 * Time: 11:07 AM
 */
$installer = $this;

$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$entityTypeId     = $setup->getEntityTypeId('customer');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$installer->addAttribute("customer_address", "customer_brand",  array(
    "type"     => "int",
    "backend"  => "",
    "label"    => "Customer Brand",
    "input"    => "select",
//    "option"  =>array(
//        "value"=>array(
//        1 => 'Apple',
//        2 => 'Microsoft',
//        3 => 'Samsung',
//        4 => 'NIKE',
//        5 => 'Hewlett-Packard',
//        6 => 'Intel',
//        7 => 'Sony',
//        8 => 'HTC'
//    )),
    "source"   => "customeraddressattribute/source_custom",
    "visible"  => true,
    "required" => false,
    "visible_on_front"=>true,
    "default"  => "",
    "unique"   => false,
    "note"     => "Customer Brand(Samsung,Nokia etc)",
    "sort_order"=>100

));
Mage::getSingleton('eav/config')
    ->getAttribute('customer_address', 'customer_brand')
    ->setData('used_in_forms',
        array('customer_register_address',
            'customer_address_edit',
            'adminhtml_customer_address'))
    ->save();


//$used_in_forms=array();
//
//$used_in_forms[]="adminhtml_customer";
//        $attribute->setData("used_in_forms", $used_in_forms)
//            ->setData("is_used_for_customer_segment", true)
//            ->setData("is_system", 0)
//            ->setData("is_user_defined", 1)
//            ->setData("is_visible", 1)
//            ->setData("sort_order", 100)
//        ;
//        $attribute->save();



$installer->endSetup();