<?php

namespace Custom\CustomerOrderdate\Model\ResourceModel\Customerorderdate;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Custom\CustomerOrderdate\Model\Customerorderdate', 'Custom\CustomerOrderdate\Model\ResourceModel\Customerorderdate');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>