<?php

namespace TheCandidate\OrderExporter\Controller;


use Magento\Framework\App\ObjectManager;
use TheCandidate\OrderExporter\Constants\ModuleConstants;
use TheCandidate\OrderExporter\Model\Order;

class FilesystemExportCommand extends AbstractExportCommand
{

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    /**
     * @return void
     */
    public function performExport(): void
    {
        try {
            $exported = $this->doExport();
            if ($exported == false) {
                $this->logger->critical('Error while exporting an order with No.' . $this->order->getIncrementId() . ' to the filesystem');
            }
        } catch (Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }

    private function doExport(): bool
    {
        $objectManager = ObjectManager::getInstance();
        $filesystem = $objectManager->get(\Magento\Framework\Filesystem::class);
        $media = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $contents = $this->order->getAsString();
        $media->writeFile(ModuleConstants::FILESYSTEM_EXPORT_PATH, $contents);
        return true;
    }
}
