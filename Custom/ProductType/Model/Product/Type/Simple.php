<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Custom\ProductType\Model\Product\Type;


/**
 * Simple product type implementation
 */
class Simple extends \Magento\ConfigurableProduct\Model\Product\Type\Configurable
{
    /**
     * Product type code
     */
    const TYPE_CODE = 'custom';

    /**
     * Delete data specific for Simple product type
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    public function deleteTypeSpecificData(\Magento\Catalog\Model\Product $product)
    {
    }
}
