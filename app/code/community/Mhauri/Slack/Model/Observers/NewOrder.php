<?php
/**
 * Copyright (c) 2015, Marcel Hauri
 * All rights reserved.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @copyright Copyright 2015, Marcel Hauri (https://github.com/mhauri/magento-slack/)
 *
 * @category Notification
 * @package mhauri-slack
 * @author Marcel Hauri <marcel@hauri.me>, Sander Mangel <https://github.com/sandermangel>
 */

class Mhauri_Slack_Model_Observers_NewOrder extends Mhauri_Slack_Model_Observers_Abstract
{

    private $_order_url = '';

    /**
     * Get customer name
     * @param Object $_order
     * @return String $customerName
     */
    public function getCustomerName($_order)
    {
        if ($_order->getCustomer()->getFirstname()) {
            $customerName = $_order->getCustomer()->getFirstname() . ' ' . $_order->getCustomer()->getLastname();
        }
        else {
            $customerName = $_order->getBillingAddress()->getFirstname() . ' ' . $_order->getBillingAddress()->getLastname() . ' (Guest)';
        }
        return $customerName;
    }

    /**
     * Send a notification when a new order was placed
     * @param $observer
     */
    public function notify($observer)
    {
        $_order = $observer->getOrder();
        $this->_order_url = Mage::helper('adminhtml')->getUrl('adminhtml/sales_order/view/order_id/',['order_id'=> $_order->getId()]);

        if($this->_getConfig(Mhauri_Slack_Model_Notification::NEW_ORDER_PATH)) {
            $message = $this->_helper->__("*A new order has been placed.* \n*Order ID:* <%s|%s>, *Name:* %s, *Amount:* %s %s",
                $this->_order_url,
                $_order->getIncrementId(),
                $this->getCustomerName($_order),
                $_order->getQuoteBaseGrandTotal(),
                $_order->getOrderCurrencyCode()
            );

            $this->_notificationModel
                ->setMessage($message)
                ->send();
        }
    }
}
