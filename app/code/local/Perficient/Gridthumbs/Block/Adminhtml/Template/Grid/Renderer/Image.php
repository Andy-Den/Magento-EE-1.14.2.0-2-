<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/26/2015
 * Time: 5:24 PM
 */
class Perficient_Gridthumbs_Block_Adminhtml_Template_Grid_Renderer_Image
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $val = Mage::helper('catalog/image')->init($row, 'thumbnail')->resize(97);
        $out = "<img src=". $val ." width='97px'/>";
        return $out;
    }
}