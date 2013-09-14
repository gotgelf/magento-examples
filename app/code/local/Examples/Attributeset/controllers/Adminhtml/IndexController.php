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
 * @package     Examples_Attributeset
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

/**
 * Examples Index Admin Controller
 *
 * @category   Examples
 * @package    Examples_Attributeset
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class Examples_Attributeset_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @var array
     */
    protected $_fixAttributes = array(
        'sku',
        'name',
        'price',
        'category_ids',
        'required_options',
        'has_options',
        'created_at',
        'updated_at',
        'visibility',
        'status'
    );

    /**
     *
     */
    public function testAction()
    {
        $productIds = $this->getRequest()->getParam('product');
        $storeId = (int)$this->getRequest()->getParam('store', 0);

        if (!is_array($productIds)) {
            $this->_getSession()->addError($this->__('Please select product(s)'));
        }

        else {
            try {
                foreach ($productIds as $productId) {
                    $product = Mage::getSingleton('catalog/product')->load($productId);
                    $attributes = Mage::getModel('catalog/product_attribute_api')->items($product->getAttributeSetId());

                    $product
                        ->setStoreId($storeId)
                        ->setAttributeSetId($this->getRequest()->getParam('attribute_set'))
                        ->setIsMassupdate(true)
                        ->save();
                    $this->_cleanOldAttributeValues($product, $attributes);
                }

                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($productIds))
                );
            }
            catch (Exception $e) {
                $this->_getSession()->addException($e, $e->getMessage());
            }
        }

        $this->_redirect('adminhtml/catalog_product/index/', array());
    }

    /**
     * @param $product
     * @param $attributes
     * @return $this
     */
    protected function _cleanOldAttributeValues($product, $attributes)
    {
        $productResource = $product->getResource();
        foreach ($attributes as $attribute) {
            if (!in_array($attribute['code'], $this->_fixAttributes)) {
                $product->setData($attribute['code'], null);
                $productResource->saveAttribute($product, $attribute['code']);
            }
        }

        return $this;
    }
}
