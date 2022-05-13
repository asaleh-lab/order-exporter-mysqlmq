<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Api\Data;


class OrderTopicData implements OrderTopicDataInterface
{
    protected $data;

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): void
    {
        $this->data = $data;
    }
}
