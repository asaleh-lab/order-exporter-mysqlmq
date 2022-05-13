# order-exporter-mysqlmq

The module exports a sales order to an external system(s) when the end user places an order

## Observing an Event
**OrderPlacementObserver** is an instance of `Magento\Framework\Event\ObserverInterface`that listens to the event `sales_order_place_after` and manipulates an instance of `Magento\Sales\Model\Order\Interceptor`

## Preparing the *Order* models for queuing 
*OrderPlacementObserver* uses **OrderBuilder** and **OrderAdapter** to build  instances of *Order* and *OrderItem* and  by extracting the desired properties from the *Interceptor* to be queued to **Magento Queue**. The method *getOrderForExport* produces a serialized version of the *Order* data to an instance of OrderTopicDataInterface which will be published to the queue

## Publishing to the queue
The module configures a topic, publisher and consumer in order to push a message to **MySQLQM**. The class **Publisher** is an instance of `Magento\Framework\MessageQueue\PublisherInterface` that pushes the *OrderTopicData* to the queue  

## Processing the queued *Order*
magento:cron invokes by default all * Queue Consumers*, the class **Consumer** is configured *etc/queue_consumer* as a *consumerInstance* so the method "processMessage" will be triggered for processing the message and send it to an instance of *ExportCommandsWrapper* which calls 3 commands for exporting to Filesystem, FTP or HTTP channels. 
**Filesystem** writes an individual file for each *Order* to: **pub/media/TheCandidate/OrderExporter/Orders**, the file will have the *Order->incrementId* 
**FTPExportCommand** and **HttpExportCommand**  are not implemented yet

 
