<?php
/**
 * Observer interface
 *
 * @category    Mhauri
 * @package     Mhauri_Slack
 * @author      Sander Mangel <https://github.com/sandermangel>
 */
interface Mhauri_Slack_Model_Observers_Interface
{
    /**
     * Send a notification to slack
     * @param $observer
     */
    public function notify($observer);
}