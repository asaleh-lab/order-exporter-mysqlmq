<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Controller;

use Psr\Log\LoggerInterface;
use TheCandidate\OrderExporter\Model\Order;
use \Magento\Framework\App\ObjectManager;

abstract class AbstractExportCommand
{

    protected Order $order;
    protected LoggerInterface $logger;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->logger = ObjectManager::getInstance()->get(LoggerInterface::class);
    }

    /**
     * @return void
     */
    abstract public function performExport(): void;
}
