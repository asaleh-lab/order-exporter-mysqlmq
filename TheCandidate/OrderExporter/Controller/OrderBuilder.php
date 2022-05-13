<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Controller;

use TheCandidate\OrderExporter\Api\Data\OrderTopicData;
use TheCandidate\OrderExporter\Api\Data\OrderTopicDataInterface;
use TheCandidate\OrderExporter\Model\Order;
use Magento\Sales\Model\Order\Interceptor;

class OrderBuilder implements OrderBuilderInterface
{
    /**
     * @var Interceptor
     */
    protected Interceptor $orderInterceptor;

    /**
     * @var Order
     */
    protected Order $order;

    /**
     * @param Interceptor $orderInterceptor
     */
    public function __construct(Interceptor $orderInterceptor)
    {
        $this->orderInterceptor = $orderInterceptor;
        $this->order = new Order();
    }

    /**
     * @return OrderBuilderInterface
     */
    public function fillOrderBasicData(): OrderBuilderInterface
    {
        $orderAdapter = new OrderAdapter($this->orderInterceptor);
        $this->order = $orderAdapter->extractOrder();
        return $this;
    }

    /**
     * @return OrderBuilderInterface
     */
    public function fillOrderItemsDetailsData(): OrderBuilderInterface
    {
        $items = $this->orderInterceptor->getItems();
        $orderItemAdapter = new OrderItemsAdapter();
        $itemsForExport = $orderItemAdapter->extractOrderItems($items);
        $this->order->setItems($itemsForExport);
        return $this;
    }


    /**
     * @return OrderTopicDataInterface
     */
    public function getOrderForExport(): OrderTopicDataInterface
    {
        $orderTopicData = new OrderTopicData();
        $serializedOrder= serialize($this->order);
        $orderTopicData->setData($serializedOrder);
        return $orderTopicData;
    }
}
