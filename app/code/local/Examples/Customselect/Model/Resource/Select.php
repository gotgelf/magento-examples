<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
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
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

/**
 * Custom Select Resource Model
 *
 * @category   Examples
 * @package    Examples_Customselect
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class Examples_Customselect_Model_Resource_Select extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('eav/attribute_option_value', 'value_id');
    }

    /**
     * @param $attributeId
     * @param $search
     * @return array
     */
    public function loadВAttributesBySearch($attributeId, $search)
    {
        $store  = Mage::app()->getStore();
        $select = $this->_getReadAdapter()->select()->from(array('a' => $this->getTable('eav/attribute_option_value')))
            ->joinLeft(
                array('b' => $this->getTable('eav/attribute_option')),
                'a.option_id = b.option_id',
                array()
            )
            ->where('a.store_id = ?', $store->getId())
            ->where('b.attribute_id = ?', $attributeId)
            ->where('a.value LIKE ?', $search .'%');

        $data = $this->_getReadAdapter()->fetchAll($select);
        $options = array();
        $i = 0;
        foreach ($data as $opt) {
            $options[$i]['id'] = $opt['option_id'];
            $options[$i]['text'] = $opt['value'];
            $i ++;
        }

        return $options;
    }

    /**
     * @param $optionId
     * @param $storeId
     * @return array
     */
    public function loadDefaultOptionText($optionId, $storeId)
    {
        $select = $this->_getReadAdapter()->select()->from(array('a' => $this->getTable('eav/attribute_option_value')))
            ->where('a.store_id = ?', $storeId)
            ->where('a.option_id = ?', $optionId);

        $data = $this->_getReadAdapter()->fetchRow($select);

        return $data;
    }
}
