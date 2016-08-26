<?php
/**
 * Created by PhpStorm.
 * User: Harishankar.Malviya
 * Date: 11/27/2015
 * Time: 12:17 PM
 */
class Perficient_Cronjob_Model_Adminhtml_System_Config_Backend_Cronjob_Cron extends Mage_Core_Model_Config_Data
{
    const CRON_MODEL_PATH = 'crontab/jobs/perficient_cronjob/run/model';
    const CRON_STRING_PATH = 'crontab/jobs/perficient_cronjob/schedule/cron_expr';

    protected function _afterSave()
    {

        $time = $this->getData(
            'groups/perficient_cron/fields/perficient_cron_time/value'
        );
        $frequncy = $this->getData(
            'groups/perficient_cron/fields/perficient_cron_frequency/value'
        );


       // $frequencyDaily = Mage_Adminhtml_Model_System_Config_Source_Cron_Frequency::CRON_DAILY;
        $frequencyWeekly = Mage_Adminhtml_Model_System_Config_Source_Cron_Frequency::CRON_WEEKLY;
        $frequencyMonthly = Mage_Adminhtml_Model_System_Config_Source_Cron_Frequency::CRON_MONTHLY;

        $cronDayOfWeek = date('N');

        $cronExprArray = array(
            intval($time[1]),
            # Minute
            intval($time[0]),
            # Hour
            ($frequncy == $frequencyMonthly) ? '1' : '*',
             # Day of the Month
            '*',
             # Month of the Year
            ($frequncy == $frequencyWeekly) ? '1' : '*',
            # Day of the Week
        );
        //print_r($cronExprArray); exit;
        $cronExprString = join(' ', $cronExprArray);
        if($this->_isEnabledCron()==0){
            $cronExprString=array('');
        }
        try {
            Mage::getModel('core/config_data')
                ->load(self::CRON_STRING_PATH, 'path')
                ->setValue($cronExprString)
                ->setPath(self::CRON_STRING_PATH)
                ->save();

            Mage::getModel('core/config_data')
                ->load(self::CRON_MODEL_PATH, 'path')
                ->setValue((string) Mage::getConfig()
                        ->getNode(self::CRON_MODEL_PATH))
                ->setPath(self::CRON_MODEL_PATH)
                ->save();
        } catch (Exception $e) {
            throw new Exception(Mage::helper('cron')
                ->__('Unable to save the cron expression.'));
        }
    }
    protected function _isEnabledCron(){
        $status = $this->getData(
            'groups/perficient_cron/fields/perficient_cron_status/value'
        );
        return $status;
    }
}