<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Controller;

use TheCandidate\OrderExporter\Api\Data\OrderTopicDataInterface;

interface OrderBuilderInterface
{

    /**
     * @return OrderBuilderInterface
     */
    public function fillOrderBasicData(): OrderBuilderInterface;

    /**
     * @return OrderBuilderInterface
     */
    public function fillOrderItemsDetailsData(): OrderBuilderInterface;

    /**
     * @return void
     */
    public function getOrderForExport(): OrderTopicDataInterface;

}
