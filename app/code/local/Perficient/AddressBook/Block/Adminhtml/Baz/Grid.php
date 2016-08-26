<?php

/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/16/2015
 * Time: 4:46 PM
 */
class Perficient_AddressBook_Block_Adminhtml_Baz_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        // Set some defaults for our grid
        $this->setDefaultSort('id');
        $this->setId('perficient_addressbook_baz_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        // This is the model we are using for the grid
        return 'perficient_addressbook/baz_collection';
    }

    protected function _prepareCollection()
    {
        // Get and set our collection for the grid
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        foreach($collection as $link){
            if($link->getStoreId() && $link->getStoreId() != 0 ){
                $link->setStoreId(explode(',',$link->getStoreId()));
            }
            else{
                $link->setStoreId(array('0'));
            }
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
       $this->addColumn('id',
            array(
                'header' => $this->__('ID'),
                'align' => 'right',
                'width' => '50px',
                'index' => 'id',
                'sortable' => true
            )
        );

        $this->addColumn('name',
            array(
                'header' => $this->__('Name'),
                'index' => 'name',
                'sortable' => true
            )
        );
        $this->addColumn('phone',
            array(
                'header' => $this->__('Phone'),
                'index' => 'phone',
                'sortable' => true
            )
        );
        $this->addColumn('address',
            array(
                'header' => $this->__('Address'),
                'index' => 'address',
                'sortable' => true
            )
        );

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => Mage::helper('checkout')->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => true,
                'filter_condition_callback' => array($this,
                    '_filterStoreCondition'),
            ));
        }
        $this->addColumn('is_enabled',
            array(
                'header' => $this->__('Status'),
                'align' => 'right',
                'width' => '50px',
                'index' => 'is_enabled',
                'type'=>'options',
                'options'=>array(1=>'Enabled',0=>'Desabled')
            )
        );
        $this->addColumn('action',
            array(
                'header'    =>$this->__('Action'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => $this->__('Edit'),
                        'url'     => array('base'=>'*/*/edit'),
                        'field'   => 'id'
                    ),
                    array(
                        'caption' => $this->__('Delete'),
                        'url'     => array('base'=>'*/*/delete'),
                        'confirm'  => $this->__('Are you sure?'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false
            )
        );


        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => $this->__('Delete'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'confirm'  => $this->__('Are you sure?')
        ));

        $statuses = array(0=>'Desabled','1'=>'Enabled');
        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
            'label'=> $this->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => $this->__('Status'),
                    'values' => $statuses
                )
            )
        ));

        return $this;
    }
}