<?php

namespace Renatio\Logout\Middleware;

use Backend\Facades\Backend;
use Backend\Facades\BackendAuth;
use Closure;
use Flash;
use Illuminate\Session\Store;
use Renatio\Logout\Models\Settings;

/**
 * Class ValidateSession
 * @package Renatio\Logout\Middleware
 */
class ValidateSession
{

    /**
     * @var Store
     */
    protected $session;

    /**
     * @var
     */
    protected $settings;

    /**
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
        $this->settings = Settings::instance();
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->isBackendRequest($request) && ! $this->isValidSession()) {
            return $this->forceLogout();
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
     * @return bool
     */
    protected function isValidSession()
    {
        $bag = $this->session->getMetadataBag();

        $lifetime = $this->getSessionLifetimeInSeconds();

        return $bag && ($lifetime > time() - $bag->getLastUsed());
    }

    /**
     * @return mixed
     */
    protected function forceLogout()
    {
        BackendAuth::logout();

        Flash::warning(e(trans('renatio.logout::lang.message.logout')));

        return Backend::redirectGuest('backend/auth');
    }

    /**
     * @return int
     */
    protected function getSessionLifetimeInSeconds()
    {
        return $this->settings->lifetime * 60 - 1;
    }

}