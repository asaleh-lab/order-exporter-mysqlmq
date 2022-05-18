<?php

namespace TheCandidate\OrderExporter\Test\Unit\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order\Interceptor;
use PHPUnit\Framework\TestCase;
use TheCandidate\OrderExporter\Exceptions\InvalidOrderException;
use TheCandidate\OrderExporter\Observer\OrderPlacementObserver;
use TheCandidate\OrderExporter\Publisher\OrderExportPublisher;
use Psr\Log\LoggerInterface;


class OrderPlacementObserverTest extends TestCase
{
    /**
     * @var OrderPlacementObserver
     */
    private OrderPlacementObserver $object;

    protected function setUp(): void
    {
        $orderExportPublisherMock = $this->getMockBuilder(OrderExportPublisher::class)
            ->disableOriginalConstructor()
            ->getMock();

        $loggerInterfaceMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = new OrderPlacementObserver($orderExportPublisherMock, $loggerInterfaceMock);
    }

    public function testOrderPlacementObserverInstance(): void
    {
        $this->assertInstanceOf(OrderPlacementObserver::class, $this->object);
    }

    public function testOrderPlacementObserverImplementObserverInterface(): void
    {
        $this->assertInstanceOf(ObserverInterface::class, $this->object);
    }

    /**
     @test
     */
    public function an_invalid_order_error_is_thrown_when_interceptor_has_no_order_data(): void
    {
        $this->expectException(InvalidOrderException::class);
        $orderInterceptor= $this->getMockBuilder(Interceptor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->object->tryPublishOrderInterceptorToQueue($orderInterceptor);
    }



}
