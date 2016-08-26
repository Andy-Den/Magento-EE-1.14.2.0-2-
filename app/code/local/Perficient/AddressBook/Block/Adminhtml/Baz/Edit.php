<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/16/2015
 * Time: 4:49 PM
 */
class Perficient_AddressBook_Block_Adminhtml_Baz_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {
        $this->_blockGroup = 'perficient_addressbook';
        $this->_controller = 'adminhtml_baz';

        parent::__construct();

        $this->_updateButton('save', 'label', $this->__('Save Address'));
        $this->_updateButton('delete', 'label', $this->__('Delete Address'));
    }

    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('perficient_addressbook')->getId()) {
            return $this->__('Edit Address');
        }
        else {
            return $this->__('New Address');
        }
    }
}