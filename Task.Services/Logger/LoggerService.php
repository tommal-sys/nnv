<?php

namespace Task\Services\Logger;

use Task\Services\Logger\ILoggerService;
use Illuminate\Support\Facades\Log;

class LoggerService implements ILoggerService
{
    public function logError($context, $channel = null)
    {
        if($channel == null)
        {
            Log::error($context);

            return;
        }

        Log::channel($channel)->error($context);
    }

    public function logMessage(string $message)
    {
        Log::error($message);
    }

    public function logInformation(string $message, $channel = null)
    {
        if($channel == null)
        {
            Log::info($message);

            return;
        }

        Log::channel($channel)->info($message);
    }
}