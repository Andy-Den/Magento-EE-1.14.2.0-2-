<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/16/2015
 * Time: 4:27 PM
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table 'foo_bar_baz'
 */
/**
 The following call to getTable('perficient_addressbook/baz') will lookup
 the resource for perficient_addressbook (perficient_addressbook_mysql4),
 and look for a corresponding entity called baz. The table name
 in the XML is perficient_addressbook_baz, so ths is what is created.
 **/
$table = $installer->getConnection()
    ->newTable($installer->getTable('perficient_addressbook/baz'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
        'nullable'  => false,
    ), 'Name')
    ->addColumn('address', Varien_Db_Ddl_Table::TYPE_CLOB, 0, array(
        'nullable'  => false,
    ), 'Address');

$installer->getConnection()->createTable($table);

$installer->endSetup();