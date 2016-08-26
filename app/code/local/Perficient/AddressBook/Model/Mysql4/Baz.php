<?php

/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/16/2015
 * Time: 4:36 PM
 */
class Perficient_AddressBook_Model_Mysql4_Baz extends
    Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('perficient_addressbook/baz', 'id');
    }
}