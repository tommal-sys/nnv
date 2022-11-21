<?php

namespace Task\Core\Components;

use Task\Core\Components\CompomentContext;

/**
 * Interface IComponentDispatcher
 * @package Task\Core\Components
 */
interface IComponentDispatcher
{
    /**
     * @param string $componentName name of component to discover
     * @param string $model for discoverd component
     * @return CompomentContext component context
     */
    public function dispatch(string $componentName, $model = null): CompomentContext;

    /**
     * @param string $componentName name of component to discover
     * @param string $model for discoverd component
     * @return CompomentContext component context
     */
    public function dispatchTransaction(string $componentName, $model): CompomentContext;
}