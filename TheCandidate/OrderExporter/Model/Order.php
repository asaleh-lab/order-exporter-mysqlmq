<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Model;


use phpDocumentor\Reflection\Types\This;
use TheCandidate\OrderExporter\Controller\OrderStringFormatter;

class Order
{
    private string $incrementId;
    private float $totalDue;
    private array $items;
    private string $customerId;


    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getIncrementId(): string
    {
        return $this->incrementId;
    }

    /**
     * @param string $incrementId
     */
    public function setIncrementId(string $incrementId): void
    {
        $this->incrementId = $incrementId;
    }


    /**
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     */
    public function setCustomerId(string $customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @return float
     */
    public function getTotalDue(): float
    {
        return $this->totalDue;
    }

    /**
     * @param float $totalDue
     */
    public function setTotalDue(float $totalDue): void
    {
        $this->totalDue = $totalDue;
    }


    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @return string
     */
    public function getAsString(): string
    {
        $orderStringFormatter = new  OrderStringFormatter($this);
        $orderInStringFormat = $orderStringFormatter->format();
        return $orderInStringFormat;
    }
}
