<?php
namespace Custom\CustomerOrderdate\Model;

class Customerorderdate extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Custom\CustomerOrderdate\Model\ResourceModel\Customerorderdate');
    }
}
?>