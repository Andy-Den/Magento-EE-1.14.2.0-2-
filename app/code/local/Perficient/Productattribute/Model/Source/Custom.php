<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 12/2/2015
 * Time: 2:52 PM
 */
class Perficient_Productattribute_Model_Source_Custom extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
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