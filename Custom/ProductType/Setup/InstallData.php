<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Custom\ProductType\Setup;

use Custom\ProductType\Model\Product\Type\Simple as CustomProduct;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var \Magento\Eav\Model\Entity\Type
     */
    protected $_entityTypeModel;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        \Magento\Eav\Model\Entity\Type $entityType
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->_entityTypeModel = $entityType;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $attributes = [
            'country_of_manufacture',
            'manufacturer',
            'minimal_price',
            'msrp',
            'msrp_display_actual_price_type',
            'price',
            'special_price',
            'special_from_date',
            'special_to_date',
            'tier_price',
            'weight',
            'color'
        ];
        foreach ($attributes as $attributeCode) {
            $applyTo = explode(
                ',',
                $eavSetup->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $attributeCode, 'apply_to')
            );

            if (!in_array(CustomProduct::TYPE_CODE, $applyTo)) {
                $applyTo[] = CustomProduct::TYPE_CODE;
                $eavSetup->updateAttribute(
                    \Magento\Catalog\Model\Product::ENTITY,
                    $attributeCode,
                    'apply_to',
                    implode(',', $applyTo)
                );
            }
        }



    }
}
