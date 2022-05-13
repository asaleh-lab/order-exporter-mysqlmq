<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Api\Data;


interface OrderTopicDataInterface
{

    /**
     * @return string
     */
    public function getData() :string;

    /**
     * @param string $data
     * @return void
     */
    public function setData(string $data): void;
}
