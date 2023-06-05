<?php

namespace App\Services\Logger;

trait Logger
{
    public function __construct(private LoggerDB $logger)
    {
    }

    public function loggerCreate(array $data)
    {
        $this->logger->create($data);
    }

    public function loggerGet()
    {
        $this->logger->get();
    }
}
