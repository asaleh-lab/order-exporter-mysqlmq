<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Publisher;

use TheCandidate\OrderExporter\Api\Data\OrderTopicData;
use TheCandidate\OrderExporter\Constants\ModuleConstants;
use Magento\Framework\MessageQueue\PublisherInterface;

class OrderExportPublisher
{

    /**
     * @var PublisherInterface $publisher
     */
    protected PublisherInterface $publisher;

    /**
     * @param PublisherInterface $publisher
     */
    public function __construct(PublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    public function publish(OrderTopicData $orderTopicData): void
    {
        $this->publisher->publish(ModuleConstants::TOPIC_NAME, $orderTopicData);
    }
}
