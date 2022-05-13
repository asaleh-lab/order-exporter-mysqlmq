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
        return "ORDER NUMBER:" . $this->getIncrementId();
    }


}
