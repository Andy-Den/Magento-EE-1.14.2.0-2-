<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 12/2/2015
 * Time: 3:10 PM
 */
$installer = $this;

$installer->startSetup();

$installer->addAttribute('catalog_product', 'customproductattribute', array(
    'group'             => 'Brands',
    'label'             => 'Brands',
    'note'              => '',
    'type'              => 'int',	//backend_type
    'input'             => 'select',	//frontend_input
    'frontend_class'	=> '',
    'source'			=> 'productattribute/source_custom',
    'required'          => true,
    'visible_on_front'  => false,
    'is_configurable'   => false,
    'used_in_product_listing'	=> false,
    'sort_order'        => 5,
));

$installer->endSetup();