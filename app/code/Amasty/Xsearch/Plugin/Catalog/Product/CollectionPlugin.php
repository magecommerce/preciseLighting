<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2018 Amasty (https://www.amasty.com)
 * @package Amasty_Xsearch
 */


namespace Amasty\Xsearch\Plugin\Catalog\Product;

use Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection as ProductCollection;
use Magento\Store\Model\ScopeInterface;

class CollectionPlugin
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    public function __construct(
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->request = $request;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param ProductCollection $subject
     * @param bool $printQuery
     * @param bool $logQuery
     */
    public function beforeLoad(ProductCollection $subject, $printQuery = false, $logQuery = false)
    {
        if (!$subject->isLoaded() && $this->isEnabled()) {
            $subject->getSelect()->order('stock_status_index.stock_status ' . ProductCollection::SORT_ORDER_DESC);
            $orders = $subject->getSelect()->getPart(\Zend_Db_Select::ORDER);
            // move from the last to the the first position
            array_unshift($orders, array_pop($orders));
            $subject->getSelect()->setPart(\Zend_Db_Select::ORDER, $orders);
        }

        return [$printQuery, $logQuery];
    }

    /**
     * @return bool
     */
    private function isEnabled()
    {
        return $this->scopeConfig->getValue(
            'amasty_xsearch/product/out_of_stock_last',
            ScopeInterface::SCOPE_STORE
        );
    }
}
