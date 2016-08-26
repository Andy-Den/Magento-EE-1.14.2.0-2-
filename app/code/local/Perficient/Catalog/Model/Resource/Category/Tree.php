<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 12/4/2015
 * Time: 1:50 PM
 */
class Perficient_Catalog_Model_Resource_Category_Tree extends
    Mage_Catalog_Model_Resource_Category_Tree{

    const ID_FIELD    = 'id';
    const PATH_FIELD  = 'path';
    const ORDER_FIELD = 'order';
    const LEVEL_FIELD = 'level';

    /**
     * Categories resource collection
     *
     * @var Mage_Catalog_Model_Resource_Category_Collection
     */
    protected $_collection;

    /**
     * Id of 'is_active' category attribute
     *
     * @var int
     */
    protected $_isActiveAttributeId              = null;

    /**
     * Join URL rewrites data to collection flag
     *
     * @var boolean
     */
    protected $_joinUrlRewriteIntoCollection     = false;

    /**
     * Inactive categories ids
     *
     * @var array
     */
    protected $_inactiveCategoryIds              = null;

    /**
     * store id
     *
     * @var integer
     */
    protected $_storeId                          = null;
    /**
     * Enter description here...
     *
     * @param boolean $sorted
     * @return Mage_Catalog_Model_Resource_Category_Collection
     */
    protected function _getDefaultCollection($sorted = false)
    {
        $this->_joinUrlRewriteIntoCollection = true;
        //$collection = Mage::getModel('catalog/category')->getCollection();
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $customerType=$customer->getResource()
            ->getAttribute('customerattribute')
            ->getFrontend()
            ->getValue($customer);
        if($customerType=='ERP'){
            $collection = Mage::getModel('catalog/category')
                ->getCollection()
                ->addAttributeToFilter('shipping_category','1');
        }else if($customerType=='WEB'){
            $collection = Mage::getModel('catalog/category')
                ->getCollection()
                ->addAttributeToFilter('shipping_category','2');
        }else{
            $collection = Mage::getModel('catalog/category')
                ->getCollection();

        }
        /** @var $collection Mage_Catalog_Model_Resource_Category_Collection */

        $attributes = Mage::getConfig()->getNode('frontend/category/collection/attributes');
        if ($attributes) {
            $attributes = $attributes->asArray();
            $attributes = array_keys($attributes);
        }
        $collection->addAttributeToSelect($attributes);

        if ($sorted) {
            if (is_string($sorted)) {
                // $sorted is supposed to be attribute name
                $collection->addAttributeToSort($sorted);
            } else {
                $collection->addAttributeToSort('name');
            }
        }

        return $collection;
    }
}