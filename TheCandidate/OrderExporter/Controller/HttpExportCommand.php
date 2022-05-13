<?php

namespace TheCandidate\OrderExporter\Controller;


use Aws\Command;
use TheCandidate\OrderExporter\Model\Order;

class HttpExportCommand extends AbstractExportCommand
{

    /**
     * @return void
     */
    public function performExport(): void
    {
        throw new Exception('Not implemented yet');
    }
}
