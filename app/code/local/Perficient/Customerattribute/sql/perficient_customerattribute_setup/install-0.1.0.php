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

$installer->addAttribute("customer", "customerattribute",  array(
    "type"     => "int",
    "backend"  => "",
    "label"    => "Type",
    "input"    => "select",
    "source"   => "customerattribute/source_custom",
    "visible"  => true,
    "required" => false,
    "default"  => "",
    "frontend" => "",
    "unique"   => false,
    "note"     => "Type"

));
$attribute   = Mage::getSingleton("eav/config")
    ->getAttribute("customer", "customerattribute");
$setup->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'customerattribute',
    '999'  //sort_order
);

$used_in_forms=array();

$used_in_forms[]="adminhtml_customer";
        $attribute->setData("used_in_forms", $used_in_forms)
            ->setData("is_used_for_customer_segment", true)
            ->setData("is_system", 0)
            ->setData("is_user_defined", 1)
            ->setData("is_visible", 1)
                ->setData("sort_order", 100)
        ;
        $attribute->save();



$installer->endSetup();