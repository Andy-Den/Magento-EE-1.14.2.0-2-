<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 12/2/2015
 * Time: 4:40 PM
 */

$installer = $this;

$installer->startSetup();

$entityTypeId     = $installer->getEntityTypeId('catalog_category');
$attributeSetId   = $installer->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $installer->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$installer->addAttribute('catalog_category', 'shipping_category', array(
    'group'             => 'General',
    'label'             => 'Shipping Type',
    'note'              => '',
    'type'              => 'int',	//backend_type
    'input'             => 'select',	//frontend_input
    'frontend_class'	=> '',
    'source'			=> 'categoryattribute/source_custom',
    'required'          => true,
    'visible'           => true,
    'is_configurable'   => false,
    'used_in_product_listing'	=> false,
    'sort_order'        => 5,
));
/*$installer->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'new_cat_attrb',
    '11'					//last Magento's attribute position in General tab is 10
);

$attributeId = $installer->getAttributeId($entityTypeId, 'new_cat_attrb');

$installer->run("
INSERT INTO `{$installer->getTable('catalog_category_entity_int')}`
(`entity_type_id`, `attribute_id`, `entity_id`, `value`)
    SELECT '{$entityTypeId}', '{$attributeId}', `entity_id`, '1'
        FROM `{$installer->getTable('catalog_category_entity')}`;
");


//this will set data of your custom attribute for root category
Mage::getModel('catalog/category')
    ->load(1)
    ->setImportedCatId(0)
    ->setInitialSetupFlag(true)
    ->save();

//this will set data of your custom attribute for default category
Mage::getModel('catalog/category')
    ->load(2)
    ->setImportedCatId(0)
    ->setInitialSetupFlag(true)
    ->save();

$this->endSetup();
*/