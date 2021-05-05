<?php
/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.comlicense
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   Landofcoder
 * @package    Lof_InstagramFeed
 * @copyright  Copyright (c) 2021 Landofcoder (https://landofcoder.com/)
 * @license    https://landofcoder.com/LICENSE-1.0.html
 */

namespace Lof\InstagramFeed\Helper;

/**
 * Class Data
 * @package Lof\InstagramFeed\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @type string
     */
    const CONFIG_MODULE_PATH = 'lofinstagramfeed';

    /**
     * Return brand config value by key and store
     *
     * @param string $key
     * @param \Magento\Store\Model\Store|int|string $store
     * @return string|null
     */
    public function getConfig($key, $store = null)
    {
       
        $store = $this->_storeManager->getStore($store);
        $result =  $this->scopeConfig->getValue(
            self::CONFIG_MODULE_PATH.'/'.$key,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store);
        return $result;
    }
    
    public function isEnabled($storeId = null){
        return $this->getConfig('general/enabled', $storeId);
    }
    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getAccessToken($storeId = null)
    {
        return $this->getConfig('general/access_token', $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getDisplayConfig($storeId = null)
    {
        return $this->getConfig('display', $storeId);
    }
}
