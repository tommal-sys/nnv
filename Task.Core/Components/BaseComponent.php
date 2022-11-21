<?php

namespace Task\Core\Components;

use Closure;
use Illuminate\Support\Facades\DB;
use Task\Core\Exceptions\TaskException;
use Task\Services\Logger\ILoggerService;
use Exception;

abstract class BaseComponent
{
    public function __construct()
    {
    }

    protected function processTransaction(Closure $processFunc)
    {
        try
        {
            DB::beginTransaction();

            $processFunc();

            DB::commit();
        }
        catch(TaskException $ex)
        {
            DB::rollBack();

            $logger = resolve(ILoggerService::class);

            $logger->logError($ex);

            return $ex->getMessage();
        }
        catch(\Exception $ex)
        {
            $logger = resolve(ILoggerService::class);
            
            $logger->logError($ex);

            DB::rollBack();
        }

        return null;
    }
}