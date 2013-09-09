<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Examples
 * @package     Examples_Customselect
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Examples Customselect model
 *
 *
 * @category   Examples
 * @package    Examples_Customselect
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Examples_Customselect_Model_Select extends Mage_Core_Model_Abstract
{
    /**
     * Init Resource Model
     */
    protected function _construct()
    {
        $this->_init('examples_customselect/select');
    }

    /**
     * @param $attributeId
     * @param $search
     * @return mixed
     */
    public function getAttributesLikeSearch($attributeId, $search)
    {
        return $this->getResource()->loadВAttributesBySearch($attributeId, $search);
    }

    /**
     * @param $optionId
     * @return mixed
     */
    public function getOptionText($optionId)
    {
        return $this->getResource()->loadDefaultOptionText($optionId);
    }
}
