<?php
namespace Task\Services\Cache;

use Closure;

interface ICacheService
{
    /**
     * Determine if an item exists in the cache.
     *
     * @param  string  $key
     * @return bool
     */
    public function has($key);

    /**
     * Retrieve an item from the cache by key.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Remove an item from the cache.
     *
     * @param  string $key
     * @return bool
     */
    public function forget($key);

    /**
     * Get the cache store implementation.
     *
     * @return \Illuminate\Contracts\Cache\Store
     */
    public function getStore();

    /**
     * @param $name
     * @return mixed
     */
    public function connection($name);
    
    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForFewSecounds(string $key, Closure $callBack);

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForMinutes(string $key, Closure $callBack);

        /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForFiveMinutes(string $key, Closure $callBack);

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForOneMinute(string $key, Closure $callBack);
    
    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForOneHour(string $key, Closure $callBack);
    
    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForHours(string $key, Closure $callBack);

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForDay(string $key, Closure $callBack);

    /**
     * @param string $key
     * @param Closure $callBack
     * @return mixed
     */
    public function rememberForWeek(string $key, Closure $callBack);

    /**
     * @param $names
     * @return mixed
     */
    public function tags($names);

    /**
     * @param $name
     * @return mixed
     */
    public function del($name);
}