<?php
/**
 * Copyright (c) 2018 MageWorkshop. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MageWorkshop\DetailedReview\Plugin\Review\Model\ResourceModel\Review;

use Magento\Review\Model\ResourceModel\Review\Collection;
use Magento\Framework\Db\Select;
use MageWorkshop\DetailedReview\Model\Details;

class CollectionPlugin
{
    /** @var \MageWorkshop\DetailedReview\Model\Indexer\TableBuilder $tableBuilder */
    protected $tableBuilder;

    /**
     * CollectionPlugin constructor.
     * @param \MageWorkshop\DetailedReview\Model\Indexer\TableBuilder $tableBuilder
     */
    public function __construct(\MageWorkshop\DetailedReview\Model\Indexer\TableBuilder $tableBuilder)
    {
        $this->tableBuilder = $tableBuilder;
    }

    /**
     * @param Collection $subject
     * @param Select $result
     * @return mixed
     * @throws \Zend_Db_Select_Exception
     */
    public function afterGetSelect(Collection $subject, Select $result)
    {
        $resource = $subject->getResource();
        $additionalDetailsTable = $resource->getTable($this->tableBuilder->getFlatTable(Details::ENTITY));

        if ($resource->getConnection()->isTableExists($additionalDetailsTable)) {
            $shouldJoinAdditionalTable = false;

            foreach ($result->getPart(Select::FROM) as $from) {
                if ($from['tableName'] === $additionalDetailsTable) {
                    $shouldJoinAdditionalTable = false;
                    break;
                }
                $shouldJoinAdditionalTable = true;
            }

            if ($shouldJoinAdditionalTable) {
                $columns = $resource->getConnection()->describeTable($additionalDetailsTable);
                unset($columns['review_id']);

                $result->joinLeft(
                    ['flat' => $additionalDetailsTable],
                    'flat.review_id = main_table.review_id',
                    array_keys($columns)
                );
            }
        }

        return $result;
    }
}
