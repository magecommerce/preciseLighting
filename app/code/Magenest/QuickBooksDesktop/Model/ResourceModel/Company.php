<?php
/**
 * Copyright © 2017 Magenest. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Magenest_QuickBooksDesktop extension
 * NOTICE OF LICENSE
 */

namespace   Magenest\QuickBooksDesktop\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class User
 * @package Magenest\QuickBooksDesktop\Model\ResourceModel
 */
class Company extends AbstractDb
{
    /**
     * Init
     */
    protected function _construct()
    {
        $this->_init('magenest_qbd_company', 'company_id');
    }
}
