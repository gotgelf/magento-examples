<?php
/*/**
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


/* @var $installer Mage_Core_Model_Resource_Setup */

$installer=$this;

/*for ($i = 1; $i <= 1000; $i++) {
    $name = 'name_' . $i;
    $installer->addAttributeSet(Mage_Catalog_Model_Product::ENTITY, $name);
}*/
$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'test_attribute', array(
    'group'                      => 'General',
    'type'                       => 'varchar',
    'input'                      => 'select',
    'label'                      => 'Test Attribute' . $j,
    'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'required'                   => true,
    'input_renderer'             => 'examples_customselect/renderer_select',
));

$attributeId = $installer->getAttributeId('catalog_product', 'test_attribute_' . $j);

for ($i = 1; $i <= 2; $i++) {
    $data[] = 'Opt' . $i;
}

$option = array (
    'attribute_id' => $attributeId,
    'values' => $data
);

$this->addAttributeOption($option);
/*for ($j = 1; $j <= 20; $j++) {

    $installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'test_attribute_' . $j, array(
        'group'                      => 'General',
        'type'                       => 'varchar',
        'input'                      => 'select',
        'label'                      => 'Test Attribute' . $j,
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'required'                   => true,
        'input_renderer'             => 'examples_customselect/renderer_select',
    ));

    $attributeId = $installer->getAttributeId('catalog_product', 'test_attribute_' . $j);

    for ($i = 1; $i <= 2; $i++) {
        $data[] = 'Opt' . $i;
    }

    $option = array (
        'attribute_id' => $attributeId,
        'values' => $data
    );

    $this->addAttributeOption($option);

    $installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'test_attribute_new_' . $j, array(
        'group'                      => 'General',
        'type'                       => 'varchar',
        'input'                      => 'select',
        'label'                      => 'Test Attribute New' . $j,
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'required'                   => true,
    ));

    $attributeId = $installer->getAttributeId('catalog_product', 'test_attribute_new_' . $j);

    for ($i = 1; $i <= 2; $i++) {
        $data[] = 'Option' . $i;
    }

    $option = array (
        'attribute_id' => $attributeId,
        'values' => $data
    );

    $this->addAttributeOption($option);
}*/
$installer->endSetup();
