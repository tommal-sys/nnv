<?php

namespace Task\Services\Logger;

interface ILoggerService
{
    public function logError($context, $channel = null);
    
    public function logMessage(string $message);

    public function logInformation(string $message, $channel = null);
}