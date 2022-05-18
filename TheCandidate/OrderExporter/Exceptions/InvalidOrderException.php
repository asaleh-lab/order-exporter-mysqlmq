<?php declare(strict_types=1);

namespace TheCandidate\OrderExporter\Exceptions;



class InvalidOrderException extends \Exception
{
    /**
     * @var string
     */
    protected $message;

    public function __construct()
    {
        parent::__construct($this->message);
    }

}
