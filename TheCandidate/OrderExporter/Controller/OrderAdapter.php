<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Controller;

use TheCandidate\OrderExporter\Model\Order;
use Magento\Sales\Model\Order\Interceptor;

class OrderAdapter
{
    /**
     * @var Interceptor
     */
    protected Interceptor $orderInterceptor;

    public function __construct(Interceptor $orderInterceptor)
    {
        $this->orderInterceptor = $orderInterceptor;
    }

    /**
     * @return Order
     */
    public function extractOrder(): Order
    {
        $order = new Order();
        $order->setIncrementId($this->orderInterceptor->getRealOrderId());
        $order->setCustomerId($this->orderInterceptor->getCustomerId());
        $order->setTotalDue($this->orderInterceptor->getTotalDue());
        return $order;
    }
}
