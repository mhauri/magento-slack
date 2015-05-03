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

class Mhauri_Slack_Model_Observers_AdminUserLoginFailed
    extends Mhauri_Slack_Model_Observers_Abstract
{
    /**
     * Send a notification when admin user login failed
     * @param $observer
     */
    public function notify($observer)
    {
        if($this->_getConfig(Mhauri_Slack_Model_Notification::ADMIN_USER_LOGIN_FAILED_PATH)) {
            $this->_notificationModel
                ->setMessage($this->_helper->__("*Admin user login failed with username:* %s", $observer->getUserName()))
                ->send();
        }
    }
}
