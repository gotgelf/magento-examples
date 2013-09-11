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
 * Examples_Customselect Admin Controller
 *
 * @category   Examples
 * @package    Examples_Customselect
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class Examples_Customselect_Adminhtml_CustomselectController extends Mage_Adminhtml_Controller_Action
{
    /**
     *
     */
    public function testAction()
    {
        if (!$this->getRequest()->isAjax()) {
            $this->_forward('noRoute');
            return;
        }
        $search = $this->getRequest()->getParam('search');
        $attributeCode = $this->getRequest()->getParam('attribute_code');
        $attribute = Mage::getModel('eav/entity_attribute')->
            loadByCode(Mage_Catalog_Model_Product::ENTITY, $attributeCode);
        $options = Mage::getModel('examples_customselect/select')->
            getAttributesLikeSearch($attribute->getId(), $search);

        $this->getResponse()->setBody(Mage::helper('core')->
            jsonEncode($options));
    }
}
