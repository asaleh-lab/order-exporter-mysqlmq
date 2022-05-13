<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Consumer;


use TheCandidate\OrderExporter\Api\Data\OrderTopicDataInterface;
use Psr\Log\LoggerInterface;
use TheCandidate\OrderExporter\Controller\ExportCommandsWrapper;
use TheCandidate\OrderExporter\Controller\Exporter;

class Consumer
{
    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param OrderTopicDataInterface $data
     * @return void
     */
    public function processMessage(OrderTopicDataInterface $data): void
    {
        try {
            $this->exportOrder($data);
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }

    /**
     * @param $data
     * @return void
     */
    private function exportOrder($data): void
    {
        $order = unserialize($data->getData());

        $exporter = new ExportCommandsWrapper($order);
        $exporter->export();

        $this->logger->debug('Processing queue message is done!...');
    }
}
