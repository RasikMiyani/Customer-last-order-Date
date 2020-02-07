<?php 
namespace Custom\CustomerOrderdate\Observer; 
use Magento\Framework\Event\ObserverInterface; 
use Custom\CustomerOrderdate\Model\Customerorderdate;

class LastOrderDateSave implements ObserverInterface { 

    protected $customerorderdate;

    public function __construct(
        Customerorderdate $customerorderdate
    )
    {
        $this->customerorderdate = $customerorderdate;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) { 
        
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/templog.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $lastCurrentdate = date('Y-m-d H:i:s');
        $order = $observer->getEvent()->getOrder();
        if ($order->getCustomerId()) {
            $customerId = $order->getCustomerId();
            $customerLastorderData = $this->customerorderdate->getCollection()->addFieldToSelect('*')->addFieldToFilter('customer_id',$customerId);
            if (!empty($customerLastorderData->getData())) {
                foreach ($customerLastorderData->getData() as $datavalue) {
                    $id = $datavalue['entity_id'];
                    $modalData = $this->customerorderdate->load($id);
                    $modalData->setData('customer_last_order_date',$lastCurrentdate);
                    $modalData->save();
                    $logger->info('Customer Updated');
                }
            } else {
                $this->customerorderdate->setData('customer_id', $customerId)
                                        ->setData('customer_last_order_date',$lastCurrentdate);
                $this->customerorderdate->save();
                $logger->info('Customer Added');
            }
        }
    }
}
