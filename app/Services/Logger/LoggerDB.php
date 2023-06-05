<?php

namespace App\Services\Logger;

use App\Models\Log;

class LoggerDB implements LoggerInterface
{
    public function create(array $data)
    {
        Log::create([
            'user_id' => auth('web')->user()->id,
            'category' => $data['category'],
            'text' => $data['text']
        ]);
    }

    public function get()
    {

    }
}
