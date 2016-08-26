<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 12/2/2015
 * Time: 12:26 PM
 */
class Perficient_Customeraddressattribute_Model_Source_Custom extends
    Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        $options = array(
            1 => 'Apple',
            2 => 'Microsoft',
            3 => 'Samsung',
            4 => 'NIKE',
            5 => 'Hewlett-Packard',
            6 => 'Intel',
            7 => 'Sony'
        );

        return $options;
    }
}