<?php

/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/20/2015
 * Time: 6:50 PM
 */
class Perficient_AddressBook_Model_Product extends Mage_Catalog_Model_Product
{
    public function validate()
    {
        //put your custom validation up here
        return parent::validate();
    }

    public function getName($param=false)
    {
        $original_return = "HARIS ".parent::getName();
        return $original_return;
    }
}