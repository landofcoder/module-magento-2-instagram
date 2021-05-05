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

namespace Lof\InstagramFeed\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Design
 * @package Lof\InstagramFeed\Model\Config\Source
 */
class Design implements ArrayInterface
{
    const CONFIG = 0;
    const CUSTOM = 1;

    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::CONFIG,
                'label' => __('Use Config')
            ],
            [
                'value' => self::CUSTOM,
                'label' => __('Custom')
            ]
        ];

        return $options;
    }
}
