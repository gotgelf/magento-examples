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
 * @category   Varien
 * @package    Varien_Data
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Form select element
 *
 * @category   Varien
 * @package    Varien_Data
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Examples_Customselect_Block_Renderer_Select extends Varien_Data_Form_Element_Select
{
    /**
     * @return string
     */
    public function getElementHtml()
    {
        $html = '
       <p>
            <input type="hidden"
                id = "test_attribute"
                name = "product[test_select]"
                value = ' . $this->getValue() .  '
                data-placeholder="-- Please select --" style="width:300px"/>
        </p>';

        $defaultOptionText = $this->getDefaultOptionText();

        $js = <<<EOF
<script type="text/javascript">
jQuery.noConflict()(document).ready(function() {
        jQuery.noConflict()('#test_attribute').select2({
            minimumInputLength: 4,
            placeholder: 'Search',
            ajax: {
                url: '{$this->getLink()}',
                dataType: 'json',
                data: function(term, page) {
                    return {
                        search: term,
                        attribute_code: '{$this->getId()}'
                    };
                },
                results: function (data, page) {
                    return { results: data };
                }
            },
            initSelection : function (element, callback) {
                var data = {id: '{$this->getValue()}', text: '{$defaultOptionText}'};
                callback(data);
            }
        });
    });
</script>
EOF;

        $html .= $js;
        return $html;
    }
    /**
     * @return string
     */
    public function getLink()
    {
        return Mage::helper("adminhtml")->getUrl("adminhtml/customselect/test/");
    }

    /**
     * @return mixed
     */
    public function getDefaultOptionText()
    {
        $storeId = Mage::app()->getStore()->getId();
        $data = Mage::getModel('examples_customselect/select')->getOptionText($this->getValue(), $storeId);
        return $data['value'];
    }
}