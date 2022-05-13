<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Controller;

use TheCandidate\OrderExporter\Model\Order;

class ExportCommandsWrapper
{
    private Order $order;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return void
     */
    public function export(){
        $logExportCommand = new FilesystemExportCommand($this->order);
        $logExportCommand->performExport();

        $ftpExportCommand = new FtpExportCommand($this->order);
        $ftpExportCommand->performExport();

        $httpExportCommand = new HttpExportCommand($this->order);
        $httpExportCommand->performExport();
    }
}
