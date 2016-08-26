<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/24/2015
 * Time: 12:49 PM
 */
class Perficient_Catalog_Block_Category_View
    extends Mage_Catalog_Block_Category_View
{


    public function getProductListHtml()
    {
        return "This block has overrided xx".$this->getChildHtml('product_list');;
    }


}
