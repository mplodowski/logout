<?php

namespace Renatio\Logout\Middleware;

use Backend\Facades\BackendAuth;
use Closure;
use Illuminate\Session\Store;
use Flash;
use Renatio\Logout\Models\Settings;

/**
 * Class SessionTimeout
 * @package Renatio\Logout\Middleware
 */
class SessionTimeout
{

    /**
     * @var Store
     */
    protected $session;

    /**
     * @var int
     */
    protected $timeout;

    /**
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
        $this->timeout = Settings::get('timeout');
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $redirect = null;

        if ($this->isBackendRequest($request)) {
            $redirect = $this->handleBackendRequest();
        }

        return $redirect ?: $next($request);
    }

    /**
     * @return bool
     */
    private function sessionEnded()
    {
        $lastActivityTime = $this->session->pull('lastActivityTime');

        return $lastActivityTime && $this->timeExceeded($lastActivityTime);
    }

    /**
     * @return void
     */
    private function setLastTimeActivity()
    {
        $this->session->put('lastActivityTime', time());
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function forceLogout()
    {
        $this->forgetLastActivityTime();
        BackendAuth::logout();
        Flash::warning(trans('renatio.logout::lang.message.logout'));

        return redirect($this->backendUri());
    }

    /**
     * @param $lastActivityTime
     * @return bool
     */
    private function timeExceeded($lastActivityTime)
    {
        return time() - $lastActivityTime > $this->timeout;
    }

    /**
     * @return void
     */
    private function forgetLastActivityTime()
    {
        $this->session->forget('lastActivityTime');
    }

    /**
     * @param $request
     * @return bool
     */
    private function isBackendRequest($request)
    {
        return str_contains($request->url(), $this->backendUri());
    }

    /**
     * @return mixed
     */
    private function backendUri()
    {
        return config('cms.backendUri');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function handleBackendRequest()
    {
        if (BackendAuth::check()) {
            if ($this->sessionEnded()) {
                return $this->forceLogout();
            }
            $this->setLastTimeActivity();
        } else {
            $this->forgetLastActivityTime();
        }
    }

}
