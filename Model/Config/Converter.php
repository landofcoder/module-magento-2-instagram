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

namespace Lof\InstagramFeed\Model\Config;

use DOMNode;
use LogicException;

/**
 * Class Converter
 * @package Lof\InstagramFeed\Model\Config
 */
class Converter extends \Magento\Widget\Model\Config\Converter
{
    /**
     * Convert dom Depends node to Magento array
     *
     * @param DOMNode $source
     *
     * @return array
     * @throws LogicException
     */
    protected function _convertDepends($source)
    {
        $depends = [];
        foreach ($source->childNodes as $childNode) {
            if ($childNode->nodeName === '#text') {
                continue;
            }
            if ($childNode->nodeName !== 'parameter') {
                throw new LogicException(
                    sprintf("Only 'parameter' node can be child of 'depends' node, %s found", $childNode->nodeName)
                );
            }
            $parameterAttributes = $childNode->attributes;
            $dependencyName = $parameterAttributes->getNamedItem('name')->nodeValue;
            $dependencyValue = $parameterAttributes->getNamedItem('value')->nodeValue;

            if (!isset($depends[$dependencyName])) {
                $depends[$dependencyName] = [
                    'value' => $dependencyValue,
                ];

                continue;
            }
            if (!isset($depends[$dependencyName]['values'])) {
                $depends[$dependencyName]['values'] = [$depends[$dependencyName]['value']];
                unset($depends[$dependencyName]['value']);
            }

            $depends[$dependencyName]['values'][] = $dependencyValue;
        }

        return $depends;
    }
}
