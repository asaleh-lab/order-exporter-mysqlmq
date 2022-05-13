<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Controller;


use TheCandidate\OrderExporter\Model\Order;

class OrderStringFormatter
{
    private Order $order;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function format(): string{
        $orderString = "Order No.:" . $this->order->getIncrementId() . PHP_EOL;
        $orderString .="Customer ID:" . $this->order->getCustomerId(). PHP_EOL;
        $orderString .="Total Due:" . $this->order->getTotalDue(). PHP_EOL;
        $orderString .="======= ITEMS ======= " . PHP_EOL;
        $orderString .= $this->getItemsString();
        $orderString .="======= END OF DATA ======= " . PHP_EOL;
        return $orderString;
    }

    /**
     * @return string
     */
    private function getItemsString():string
    {
        $itemsString= "";
        foreach ($this->order->getItems() as $item){
            $itemsString .=  "\tSKU:" . $item->getSku() ;
            $itemsString .=  "\tQTY:" . $item->getQtyOrdered() ;
            $itemsString .= PHP_EOL;
        }
        return $itemsString;
    }

}
