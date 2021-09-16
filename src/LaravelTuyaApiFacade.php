<?php

namespace Givenergy\LaravelTuyaApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Givenergy\LaravelTuyaApi\Skeleton\SkeletonClass
 */
class LaravelTuyaApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-tuya-api';
    }
}
