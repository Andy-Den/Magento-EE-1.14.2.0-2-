<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/18/2015
 * Time: 2:53 PM
 */
class Perficient_AddressBook_IndexController
    extends Mage_Core_Controller_Front_Action{

    public function indexAction(){
        //echo "In side index controller";
        $this->loadLayout();
        $this->renderLayout();

    }
    public function askpostAction(){

    }
}
