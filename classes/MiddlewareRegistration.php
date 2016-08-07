<?php

namespace Renatio\Logout\Classes;

use Renatio\Logout\Middleware\ValidateSession;

/**
 * Class MiddlewareRegistration
 * @package Renatio\Logout\Classes
 */
class MiddlewareRegistration
{

    /**
     * Register ValidateSession Middleware
     */
    public function register()
    {
        $kernel = app()->make('Illuminate\Contracts\Http\Kernel');

        $kernel->pushMiddleware(ValidateSession::class);
    }

}