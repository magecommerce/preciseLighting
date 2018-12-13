<?php
/**
 * Copyright © 2018 x-mage2(Yosto). All rights reserved.
 * See README.md for details.
 */
namespace Yosto\Opc\Block\Order;

/**
 * Class Totals
 * @package Yosto\Opc\Block\Order
 */
class Totals extends \Magento\Framework\View\Element\AbstractBlock
{

    /**
     * Init totals
     *
     */
    public function initTotals()
    {
        $orderTotalsBlock = $this->getParentBlock();
        $order = $orderTotalsBlock->getOrder();
        if ($order->getYostoOpcGiftwrapAmount() > 0) {
            $orderTotalsBlock->addTotal(new \Magento\Framework\DataObject([
                'code'       => 'gift_wrap',
                'label'      => __('Gift Wrap'),
                'value'      => $order->getYostoOpcGiftwrapAmount(),
                'base_value' => $order->getYostoOpcBaseGiftwrapAmount(),
            ]), 'subtotal');
        }
    }

}
