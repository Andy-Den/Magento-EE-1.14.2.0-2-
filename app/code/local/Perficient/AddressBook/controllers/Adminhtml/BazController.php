<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/16/2015
 * Time: 5:04 PM
 */
class Perficient_Addressbook_Adminhtml_BazController
    extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        //echo "Hi inside controller"; exit;
        /* Let's call our initAction method which will
          set some basic params for each action*/
        $this->_initAction()
            ->renderLayout();
    }

    public function newAction()
    {
        // We just forward the new action to a blank edit form
        $this->_forward('edit');
    }

    public function editAction()
    {

        $this->_initAction();

        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('perficient_addressbook/baz');

        if ($id) {
            // Load record
            $model->load($id);

            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')
                    ->addError($this->__('This contact no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($model->getId() ? $model->getName() :
            $this->__('New Address'));
        $data = Mage::getSingleton('adminhtml/session')->getBazData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('perficient_addressbook', $model);

        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Addess') : $this->__('New Addess'), $id ? $this->__('Edit Addess') : $this->__('New Addess'))
            ->_addContent($this->getLayout()->createBlock('perficient_addressbook/adminhtml_baz_edit')->setData('action', $this->getUrl('*/*/save')))
            ->renderLayout();
    }

    public function saveAction()
    {



        if ($postData = $this->getRequest()->getPost()) {

            if(isset($postData['stores'])) {
                if(in_array('0',$postData['stores'])){
                    $postData['store_id'] = '0';
                }
                else{
                    $postData['store_id'] = implode(",", $postData['stores']);
                }
                unset($postData['stores']);
            }
            $model = Mage::getSingleton('perficient_addressbook/baz');
            //unset($postData['form_key']);
            $model->setData($postData);


            // echo "<pre>";
            //print_r($postData); exit;
            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess($this->__('The contact has been saved.'));
                $this->_redirect('*/*/');

                return;
            }
            catch (Mage_Core_Exception $e) {
               //print_r($postData); die('IN side cash');
                Mage::getSingleton('adminhtml/session')
                    ->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this contact.'));
            }

            Mage::getSingleton('adminhtml/session')->setBazData($postData);
            $this->_redirectReferer();
        }
    }

    public function messageAction()
    {
        $data = Mage::getModel('perficient_addressbook/baz')
            ->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }

    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout()
            // Make the active menu match the menu config nodes
            // (without 'children' inbetween)
            ->_setActiveMenu('addressbook/perficient_addressbook_baz')
            ->_title($this->__('Address Book'))->_title($this->__('Address'))
            ->_addBreadcrumb($this->__('Address Book'),
                $this->__('Address Book'))
            ->_addBreadcrumb($this->__('Address'), $this->__('Address'));

        return $this;
    }

    /**
     * Check currently called action by permissions for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')
            ->isAllowed('sales/perficient_addressbook_baz');
    }

    public function deleteAction()
    {

        if($this->getRequest()->getParam('id') > 0)
        {
            try
            {
                $buzModel = Mage::getModel('perficient_addressbook/baz');
                $buzModel->setId($this->getRequest()
                    ->getParam('id'))
                    ->delete();
                //die('In side delete action try');
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess('Contact successfully deleted');
                $this->_redirect('*/*/');
            }
            catch (Exception $e)
            {
                Mage::getSingleton('adminhtml/session')
                    ->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()
                    ->getParam('id')));
                //die('In side delete action cach');
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $addressIds = $this->getRequest()->getParam('id');      // $this->getMassactionBlock()->setFormFieldName('tax_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid

        if(!is_array($addressIds)) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('tax')->__('Please select contact.'));
        } else {
            try {
                $bazModel = Mage::getModel('perficient_addressbook/baz');
                foreach ($addressIds as $addressId) {
                    $bazModel->load($addressId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('tax')->__(
                        'Total of %d record(s) were deleted.', count($addressId)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->
                addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
//    public function exportCsvAction()
//    {
//        $fileName   = 'addressbook.csv';
//        $content    = $this->getLayout()->
//        createBlock('perficient_addressbook/adminhtml_buzz_grid')
//            ->getCsv();
//
//        $this->_sendUploadResponse($fileName, $content);
//    }
//
//    public function exportXmlAction()
//    {
//        $fileName   = 'addressbook.xml';
//        $content    = $this->getLayout()
//            ->createBlock('perficient_addressbook/adminhtml_buzz_grid')
//            ->getXml();
//
//        $this->_sendUploadResponse($fileName, $content);
//    }

}