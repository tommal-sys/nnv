<?php

namespace Task\Services\Cache;

use Closure;
use Exception;
use Illuminate\Cache\CacheManager;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Facades\Config;
use Task\Services\Logger\ILoggerService;

class RedisService implements ICacheService
{
    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * @var RedisManager
     */
    protected $redis;

    /**
     * @var ILoggerService
     */
    private $loggerService;

    private $debugMode;

    /**
     * RedisService constructor.
     * @param CacheManager $cacheManager
     * @param RedisManager $redis
     */
    public function __construct(CacheManager $cacheManager, RedisManager $redis, ILoggerService $loggerService)
    {
        $this->cache = $cacheManager->driver('redis');

        $this->redis = $redis;

        $this->loggerService = $loggerService;

        $this->debugMode = Config::get('app.debug');
    }

    /**
     * Determine if an item exists in the cache.
     *
     * @param  string $key
     * @return bool
     * @throws Exception
     */
    public function has($key)
    {
        if ($this->debugMode)
        {
            $key = 'dev' . $key;
        }

        try {
            return $this->cache->has($key);
        } catch (Exception $e) 
        { 
            $this->loggerService->logError($e);
        }
        return false;
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     * @throws Exception
     */
    public function get($key, $default = null)
    {
        if ($this->debugMode)
        {
            $key = 'dev' . $key;
        }

        try {
            return $this->cache->get($key, $default);
        } catch (Exception $e) 
        { 
            $this->loggerService->logError($e);
        }
        return false;
    }

    /**
     * Remove an item from the cache.
     *
     * @param  string $key
     * @return bool
     */
    public function forget($key)
    {
        if ($this->debugMode)
        {
            $key = 'dev' . $key;
        }

        try {
            return $this->cache->forget($key);
        } catch (Exception $e) 
        { 
            $this->loggerService->logError($e);
        }
        return false;
    }

    /**
     * Get the cache store implementation.
     *
     * @return bool|\Illuminate\Contracts\Cache\Store
     */
    public function getStore()
    {
        try {
            return $this->cache->getStore();
        } catch (Exception $e) 
        { 
            $this->loggerService->logError($e);
        }
        return false;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function connection($name)
    {
        try {
            return $this->cache->setConnection($name);
        } catch (Exception $e) 
        {
            $this->loggerService->logError($e);
        }
        return false;
    }

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForFewSecounds(string $key, Closure $callBack)
    {
        return $this->remember($key, 15, $callBack);
    }

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForMinutes(string $key, Closure $callBack)
    {
        return $this->remember($key, 1440, $callBack);
    }

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForOneHour(string $key, Closure $callBack)
    {
        return $this->remember($key, 3600, $callBack);
    }

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForFiveMinutes(string $key, Closure $callBack)
    {
        return $this->remember($key, 300, $callBack);
    }

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForOneMinute(string $key, Closure $callBack)
    {
        return $this->remember($key, 60, $callBack);
    }

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForHours(string $key, Closure $callBack)
    {
        return $this->remember($key, 25200, $callBack);
    }

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForDay(string $key, Closure $callBack)
    {
        return $this->remember($key, 86400, $callBack);
    }

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForWeek(string $key, Closure $callBack)
    {
        return $this->remember($key, 604800, $callBack);
    }

    /**
     * Get an item from the cache, or execute the given Closure and store the result.
     *
     * @param  string $key
     * @param  \DateTimeInterface|\DateInterval|float|int $minutes
     * @param  \Closure $callback
     * @return mixed
     */
    private function remember($key, $minutes, Closure $callback)
    {
        if ($this->debugMode)
        {
            $key = 'dev' . $key;
        }

        try {
            return $this->cache->remember($key, $minutes, $callback);
        } catch (Exception $e) 
        { 
            $this->loggerService->logError($e);
        }
        return $callback();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function del($name)
    {
        try {
            return $this->redis->del($name);
        } catch (Exception $e) 
        { 
            $this->loggerService->logError($e);
        }
        return false;
    }

    /**
     * @param $names
     * @return bool|mixed
     */
    public function tags($names)
    {
        try {
            return $this->cache->tags($names);
        } catch (Exception $e) 
        { 
            $this->loggerService->logError($e);
        }
        return false;
    }
}
