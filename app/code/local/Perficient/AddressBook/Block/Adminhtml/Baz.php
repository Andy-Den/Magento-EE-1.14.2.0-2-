<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/16/2015
 * Time: 4:43 PM
 */
class Perficient_AddressBook_Block_Adminhtml_Baz
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        /* The blockGroup must match the first half of how we call
           the block, and controller matches the second half
            ie. foo_bar/adminhtml_baz
        */
        $this->_blockGroup = 'perficient_addressbook';
        $this->_controller = 'adminhtml_baz';
        $this->_headerText = $this->__('Address');

        parent::__construct();
    }
}