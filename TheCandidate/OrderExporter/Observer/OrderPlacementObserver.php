<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Observer;


use Magento\Sales\Model\Order\Interceptor;
use TheCandidate\OrderExporter\Controller\OrderBuilder;
use TheCandidate\OrderExporter\Publisher\OrderExportPublisher;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use TheCandidate\OrderExporter\Publisher\OrderExport;
use Psr\Log\LoggerInterface;

class OrderPlacementObserver implements ObserverInterface
{


    /**
     * @var OrderExportPublisher
     */
    protected OrderExportPublisher $publisher;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param OrderExportPublisher $publisher
     * @param LoggerInterface $logger
     */
    public function __construct(OrderExportPublisher $publisher, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->publisher = $publisher;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        try {
            $this->queueOrder($observer->getEvent()->getOrder());
        } catch (\Exception $e) {
            $this->logger->info($e->getMessage());
        }
    }

    /**
     * @param Interceptor $orderInterceptor
     * @return void
     */
    public function queueOrder(Interceptor $orderInterceptor): void
    {
        $orderExportBuilder = new OrderBuilder($orderInterceptor);

        $orderTopicData = $orderExportBuilder
            ->fillOrderBasicData()
            ->fillOrderItemsDetailsData()
            ->getOrderForExport();

        $this->publisher->publish($orderTopicData);
    }




}
