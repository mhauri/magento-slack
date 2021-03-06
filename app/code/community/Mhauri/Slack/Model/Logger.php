<?php


class Mhauri_Slack_Model_Logger extends Zend_Log_Writer_Abstract
{
    const XML_PATH_SLACK_LOG_EXCEPTION = "";

    /** @var Mage_Core_Model_Abstract|Mhauri_Slack_Model_Notification|null  */
    protected $_notificationModel = null;

    public function __construct()
    {
        $this->_notificationModel   = Mage::getSingleton('mhauri_slack/notification');
    }

    /**
     * @param array $event
     * @throws Zend_Log_Exception
     */
    protected function _write($event)
    {
        if (false ){
            $this->_notificationModel
                ->setMessage($event['message'])
                ->send();
        }else{
            $file = empty($file) ?
                (string) Mage::getConfig()->getNode('dev/log/file', Mage_Core_Model_Store::DEFAULT_CODE) : basename($file);
            $logDir = Mage::getBaseDir('var') . DS . 'log';
            $logFile = $logDir . DS . $file;
            $defaultLogger = new Zend_Log_Writer_Stream($logFile);
            $defaultLogger->write($event);
        }
    }

    /**
     * Satisfy newer Zend Framework
     *
     * @param  array|Zend_Config $config Configuration
     * @return void|Zend_Log_FactoryInterface
     */
    static public function factory($config)
    {
    }
}
