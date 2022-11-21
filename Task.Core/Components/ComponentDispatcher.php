<?php

namespace Task\Core\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Task\Core\Exceptions\TaskException;
use Task\Services\Logger\ILoggerService;
use Task\Core\Components\CompomentContext;
use Task\Statics\Environment\EnvironmentName;
use Exception;


class ComponentDispatcher implements IComponentDispatcher
{
    /**
     * @var ILoggerService
     */
    private $loggerService;

    public function __construct(ILoggerService $loggerService)
    {
        $this->loggerService = $loggerService;
    }

    /**
     * @param string $componentName name of component to discover
     * @param string $model for discoverd component
     * @return CompomentContext component context
     */
    public function dispatch(string $componentName, $model = null): CompomentContext
    {
        $componentContext = new CompomentContext();
        
        try 
        {
            $component = resolve($componentName);         
        }
        catch (\Throwable $ex) 
        {
            if (App::environment() != EnvironmentName::PRODUCTION) {
        
                dd($ex);

                throw new \Exception('Given component name doesnt exists in current project, consider to add new one');
            }

            $this->loggerService->logError($ex);

            $componentContext->error = 'Wystąpił nieoczekiwany błąd. Spróbuj wykonać akcję ponownie.';

            return $componentContext;
        }
        
        try 
        {
            $componentContext->result = $component->execute($model);
        } 
        catch (TaskException $ex) 
        {
            if (App::environment() != EnvironmentName::PRODUCTION) {
        
                dd($ex);
            }

            $this->loggerService->logError($ex);
            
            $componentContext->error = $ex->getMessage();

            return $componentContext;
        }
        catch (\Throwable $ex) 
        {
            if (App::environment() != EnvironmentName::PRODUCTION) {
        
                dd($ex);
            }

            $this->loggerService->logError($ex);

            $componentContext->error = 'Wystąpił nieoczekiwany błąd. Spróbuj wykonać akcję ponownie.';

            return $componentContext;
        }

        return $componentContext;
    }

    /**
     * @param string $componentName name of component to discover
     * @param string $model for discoverd component
     * @return CompomentContext component context
     */
    public function dispatchTransaction(string $componentName, $model): CompomentContext
    {
        $componentContext = new CompomentContext();
        
        try 
        {
            $component = resolve($componentName);            
        }
        catch (\Throwable $ex) 
        {
            if (App::environment() != EnvironmentName::PRODUCTION) {
        
                dd($ex);
                
                throw new \Exception('Given component name doesnt exists in current project, consider to add new one');
            }

            $this->loggerService->logError($ex);

            $componentContext->error = 'Wystąpił nieoczekiwany błąd. Spróbuj wykonać akcję ponownie.';

            return $componentContext;
        }
        
        try 
        {
            DB::beginTransaction();

            $componentContext->result = $component->execute($model);

            DB::commit();
        } 
        catch (TaskException $ex) 
        {
            if (App::environment() != EnvironmentName::PRODUCTION) {
        
                dd($ex);
            }

            $this->loggerService->logError($ex);
            
            DB::rollBack();
            
            $componentContext->error = $ex->getMessage();

            return $componentContext;
        }
        catch (\Throwable $ex) 
        {
            if (App::environment() != EnvironmentName::PRODUCTION) {
        
                dd($ex);
            }
            
            $this->loggerService->logError($ex);

            $componentContext->error = 'Wystąpił nieoczekiwany błąd. Spróbuj wykonać akcję ponownie.';

            return $componentContext;
        }

        return $componentContext;
    }
}