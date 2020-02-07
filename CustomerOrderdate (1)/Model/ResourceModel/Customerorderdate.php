<?php
namespace Custom\CustomerOrderdate\Model\ResourceModel;

class Customerorderdate extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('sales_order_customer_last_order_date', 'entity_id');
    }
}
?>