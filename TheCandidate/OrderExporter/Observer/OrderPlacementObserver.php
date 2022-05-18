<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Observer;


use Magento\Sales\Model\Order\Interceptor;
use TheCandidate\OrderExporter\Api\Data\OrderTopicDataInterface;
use TheCandidate\OrderExporter\Controller\OrderBuilder;
use TheCandidate\OrderExporter\Exceptions\InvalidOrderException;
use TheCandidate\OrderExporter\Publisher\OrderExportPublisher;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

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
            $orderInterceptor = $observer->getEvent()->getOrder();
            $this->tryPublishOrderInterceptorToQueue($orderInterceptor);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }


    /**
     * @param Interceptor $orderInterceptor
     * @return void
     * @throws InvalidOrderException
     */
    public function tryPublishOrderInterceptorToQueue(Interceptor $orderInterceptor): bool
    {
        $validInterceptor = $this->validateOrderInterceptor($orderInterceptor);
        if ($validInterceptor){
            $orderTopicData = $this->buildOrderTopicDataForQueue($orderInterceptor);
            $this->publisher->publish($orderTopicData);
            return true;
        }
        return false;
    }

    /**
     * @param Interceptor $orderInterceptor
     * @return bool
     * @throws InvalidOrderException
     */
    private function validateOrderInterceptor(Interceptor $orderInterceptor): bool
    {
        if ($orderInterceptor->getIncrementId() == null) {
            throw new InvalidOrderException();
        }
        return true;
    }

    /**
     * @param $orderInterceptor
     * @return OrderTopicDataInterface
     */
    private function buildOrderTopicDataForQueue($orderInterceptor): OrderTopicDataInterface
    {
        $orderExportBuilder = new OrderBuilder($orderInterceptor);
        $orderTopicData = $orderExportBuilder->getOrderForExport();
        return $orderTopicData;
    }

}
