<?php

namespace TheCandidate\OrderExporter\Model;

class OrderItem
{
    private $sku;
    private $qtyOrdered;

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @return mixed
     */
    public function getQtyOrdered()
    {
        return $this->qtyOrdered;
    }

    /**
     * @param mixed $qtyOrdered
     */
    public function setQtyOrdered($qtyOrdered): void
    {
        $this->qtyOrdered = $qtyOrdered;
    }


}
