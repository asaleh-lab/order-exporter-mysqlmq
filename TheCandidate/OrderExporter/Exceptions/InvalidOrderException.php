<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Exceptions;



class InvalidOrderException extends \Exception
{
    protected $message = "Invalid order, the interceptor has no data";

    public function __construct()
    {
        parent::__construct($this->message, 0, null);
    }
}
