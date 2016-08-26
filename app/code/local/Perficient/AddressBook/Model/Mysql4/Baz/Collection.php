<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/16/2015
 * Time: 4:37 PM
 */
class Perficient_AddressBook_Model_Mysql4_Baz_Collection
    extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {

       $this->_init('perficient_addressbook/baz');
    }
}