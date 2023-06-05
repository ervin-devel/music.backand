<?php

namespace App\Services\Logger;

interface LoggerInterface
{
    public function create(array $data);
    public function get();
}
