<?php

namespace Renatio\Logout\Middleware;

use Backend\Facades\Backend;
use Backend\Facades\BackendAuth;
use Closure;
use October\Rain\Support\Facades\Flash;
use October\Rain\Support\Facades\Schema;
use Renatio\Logout\Models\Settings;

/**
 * Class ValidateSession
 * @package Renatio\Logout\Middleware
 */
class ValidateSession
{

    /**
     * @var
     */
    protected $user;

    /**
     * @var
     */
    protected $settings;

    public function __construct($user = null)
    {
        $this->user = $user ?: BackendAuth::getUser();
        $this->settings = Settings::instance();
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! Schema::hasColumn('backend_users', 'last_activity')) {
            return $next($request);
        }

        if ( ! $this->user) {
            return $next($request);
        }

        if ($this->user->isActive()) {
            $this->user->updateLastActivity();
        } else {
            BackendAuth::logout();

            if ($this->isBackendRequest($request)) {
                return $this->forceLogout();
            }
        }

        return $next($request);
    }

    /**
     * @param $request
     * @return bool
     */
    protected function isBackendRequest($request)
    {
        return str_contains($request->url(), config('cms.backendUri'));
    }

    /**
     * @return mixed
     */
    protected function forceLogout()
    {
        Flash::info(e(trans('renatio.logout::lang.message.logout')));

        return Backend::redirectGuest('backend/auth');
    }

}