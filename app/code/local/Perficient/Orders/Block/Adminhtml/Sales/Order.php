<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/25/2015
 * Time: 5:00 PM
 */
class Perficient_Orders_Block_Adminhtml_Sales_Order extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'perficient_orders';
        $this->_controller = 'adminhtml_sales_order';
        $this->_headerText = Mage::helper('perficient_orders')->__('Orders - Perficient ');

        parent::__construct();
        $this->_removeButton('add');
    }
}