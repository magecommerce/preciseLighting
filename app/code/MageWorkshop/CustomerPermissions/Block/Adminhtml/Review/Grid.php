<?php
/**
 * Copyright (c) 2018 MageWorkshop. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MageWorkshop\CustomerPermissions\Block\Adminhtml\Review;

use MageWorkshop\CustomerPermissions\Model\Module\DetailsData;

/**
 * Class Grid
 * @package MageWorkshop\CustomerPermissions\Block\Adminhtml
 * @method setFormFieldName(string $value)
 */
class Grid extends \Magento\Review\Block\Adminhtml\Grid
{
    /** @var \MageWorkshop\CustomerPermissions\Helper\BanHelper  */
    protected $banHelper;

    /** @var \MageWorkshop\Core\Helper\Data  */
    protected $coreHelper;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magento\Review\Model\ReviewFactory $reviewFactory
     * @param \Magento\Review\Model\ResourceModel\Review\Product\CollectionFactory $productsFactory
     * @param \Magento\Review\Helper\Data $reviewData
     * @param \Magento\Review\Helper\Action\Pager $reviewActionPager
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \MageWorkshop\CustomerPermissions\Helper\BanHelper $banHelper
     * @param \MageWorkshop\Core\Helper\Data $coreHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magento\Review\Model\ReviewFactory $reviewFactory,
        \Magento\Review\Model\ResourceModel\Review\Product\CollectionFactory $productsFactory,
        \Magento\Review\Helper\Data $reviewData,
        \Magento\Review\Helper\Action\Pager $reviewActionPager,
        \Magento\Framework\Registry $coreRegistry,
        \MageWorkshop\CustomerPermissions\Helper\BanHelper $banHelper,
        \MageWorkshop\Core\Helper\Data $coreHelper,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $backendHelper,
            $reviewFactory,
            $productsFactory,
            $reviewData,
            $reviewActionPager,
            $coreRegistry,
            $data
        );

        $this->banHelper = $banHelper;
        $this->coreHelper = $coreHelper;
    }

    /**
     * Prepare grid mass actions
     *
     * @return void
     */
    protected function _prepareMassaction()
    {
        parent::_prepareMassaction();

        if (!$this->coreHelper->isModuleEnabledInDetailedReviewSection(DetailsData::MODULE_CODE)) {
            return;
        }

        $banPeriods = $this->banHelper->getBanPeriodsOptionArray();
        $this->getMassactionBlock()->addItem(
            'add_to_ban',
            [
                'label' => __('Ban review authors'),
                'url' => $this->getUrl(
                    'mageworkshop_customerpermissions/set/banByReview'
                ),
                'additional' => [
                    'status' => [
                        'name' => 'ban',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('For how long Author should be banned'),
                        'values' => $banPeriods,
                    ],
                ]
            ]
        );
    }
}