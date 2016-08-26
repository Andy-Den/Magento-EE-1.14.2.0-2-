<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 12/2/2015
 * Time: 4:47 PM
 */
class Perficient_Categoryattribute_Model_Source_Custom extends
                            Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        $options = array(
            1 => 'Group1',
            2 => 'Group2',
        );

        return $options;

    }
}