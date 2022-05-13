<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Controller;

use TheCandidate\OrderExporter\Model\OrderItem;
use Magento\Sales\Model\Order\Interceptor;

class OrderItemsAdapter
{
    /**
     * @var Interceptor
     */
    protected Interceptor $orderInterceptor;

    /**
     * @param array $items
     * @return array
     */
    public function extractOrderItems(array $items): array
    {
        $itemsArray = array();
        foreach ($items as $item) {
            $itemsArray[] = $this->buildIndividualOrderItem($item);
        }
        return $itemsArray;
    }

    /**
     * @param $item
     * @return OrderItem
     */
    private function buildIndividualOrderItem($item): OrderItem
    {
        $orderItem = new OrderItem();
        $orderItem->setSku($item->getSku());
        $orderItem->setSku($item->getSku());
        $orderItem->setQtyOrdered($item->getQtyOrdered());
        return $orderItem;
    }

}
