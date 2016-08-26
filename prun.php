<?php
/**
 * Error reporting
 */
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
$timeStart = microtime(true);

$currentPath = '/var/www/magento-dev.local/app/Mage.php';
require_once  $currentPath;

Mage::app('admin')->setUseSessionInUrl(false);

Mage::log('Start time: ' . $timeStart, null, 'pim.log');

Mage::getModel('cronjob/observerx')->doSomething();

//$timeEnd = microtime(true);
//Mage::log('End time: ' . $timeEnd, null, 'pim.log');
//$time = $timeEnd - $timeStart;
//Mage::log('Total execution time for pim: ' . $time, null, 'pim.log');