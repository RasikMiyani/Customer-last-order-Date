<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Custom\CustomerOrderdate\Plugin;

use Magento\Framework\Data\Collection;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class CollectionPool
 */
class GridCustomerJoinCollection
{

    public static $table = 'customer_grid_flat';
    public static $leftJoinTable = 'sales_order_customer_last_order_date'; // My custom table
    /**
     * Get report collection
     *
     * @param string $requestName
     * @return Collection
     * @throws \Exception
     */
    public function afterGetReport(
     \Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory $subject,
     $collection,
     $requestName
 ) {
     if($requestName == 'customer_listing_data_source')
     {
         if ($collection->getMainTable() === $collection->getConnection()->getTableName(self::$table)) {
 
            $leftJoinTableName = $collection->getConnection()->getTableName(self::$leftJoinTable);
 
            $collection
                ->getSelect()
                ->joinLeft(
                    ['co'=>$leftJoinTableName],
                    "co.customer_id = main_table.entity_id",
                    [
                        'customer_id' => 'co.customer_id',
                        'customer_last_order_date'=> 'co.customer_last_order_date'
                    ]
                );
 
            $where = $collection->getSelect()->getPart(\Magento\Framework\DB\Select::WHERE);
 
            $collection->getSelect()->setPart(\Magento\Framework\DB\Select::WHERE, $where)->group('main_table.entity_id');;
 
            /*echo $collection->getSelect()->__toString();die;*/

        }

     }
     return $collection;
 }
}
