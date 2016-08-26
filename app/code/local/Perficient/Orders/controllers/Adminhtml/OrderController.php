<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/25/2015
 * Time: 4:57 PM
 */
class Perficient_Orders_Adminhtml_OrderController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Sales'))->_title($this->__('Orders Perficient'));
        $this->loadLayout();
        $this->_setActiveMenu('sales/sales');
            $this->_addContent($this->getLayout()->createBlock('perficient_orders/adminhtml_sales_order'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('perficient_orders/adminhtml_sales_order_grid')->toHtml()
        );
    }

    public function exportPerficientCsvAction()
    {
        $fileName = 'orders_perficient.csv';
        $grid = $this->getLayout()->createBlock('perficient_orders/adminhtml_sales_order_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    public function exportPerficientExcelAction()
    {
        $fileName = 'orders_perficient.xml';
        $grid = $this->getLayout()->createBlock('perficient_orders/adminhtml_sales_order_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }
}