<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

trait EloquentCacheTrait {

    /**
     * generate key cache
     *
     * @param $key
     * @return string
     */
    public function generateCacheKey($key)
    {
        return $key;
    }

    /**
     * get a cache item by key
     *
     * @param $key
     * @return mixed
     */
    public function getCacheByKey($key)
    {
        $cacheKey = $this->generateCacheKey($key);
        return Cache::tags(get_called_class())->get($cacheKey);

    }

    /**
     * set a cache item
     *
     * @param mixed $key
     * @param $value
     * @param bool $withCacheKeyGenertor
     */
    public function setCacheByKey($key, $value, $withCacheKeyGenertor = true)
    {
        $cacheKey = $withCacheKeyGenertor ? $this->generateCacheKey($key) : $key;
        Cache::tags(get_called_class())->put($cacheKey, $value);
    }

    /**
     * remove a cache item
     *
     * @param $key
     * @param $value
     */
    public function removeCache($key)
    {
        $cacheKey = $this->generateCacheKey($key);
        Cache::tags(get_called_class())->forget($cacheKey);
    }

    /**
     * remove all cache
     */
    public function removeThisClassCache()
    {

        Cache::tags(get_called_class())->flush();
    }
}
