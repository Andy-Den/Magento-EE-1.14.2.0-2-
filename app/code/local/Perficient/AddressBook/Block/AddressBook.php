<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/18/2015
 * Time: 5:13 PM
 */
class Perficient_AddressBook_Block_AddressBook extends Mage_Core_Block_Template{
    protected $_Collection=null;
    public function getCollection(){
        if(is_null($this->_Collection)){
            $this->_Collection=Mage::getModel('perficient_addressbook/baz')
                ->getCollection();
        }
        return $this->_Collection;
    }
    public function getStoreName($storeIds=null){
        $storeIdArr=explode(',',$storeIds);
        $count=0;
        foreach($storeIdArr as $storeId){
            //$store= Mage::getModel('core/store')->load($storeId);
            $store = Mage::getModel('core/store')->load($storeId);
            //echo $store->getWebsite()->getStore();
            if($count==0){
                $name= $store->getName();
            }else{
                $name .=", ".$store->getName();
            }

            $count++;
        }

        return $name;

    }
    public function getContactInfo(){

        $collection = Mage::getModel('perficient_addressbook/baz')
            ->getCollection()
            ->addFieldToFilter('is_enabled',1)
            ->addFieldToFilter('store_id',
                Mage::app()->getStore()->getStoreId());
        return $collection;
    }
}
