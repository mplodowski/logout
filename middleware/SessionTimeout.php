<?php

namespace Renatio\Logout\Middleware;

use Backend\Facades\BackendAuth;
use Closure;
use Illuminate\Session\Store;
use Config;
use Flash;
use Renatio\Logout\Models\Settings;
use Backend;

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
        if (BackendAuth::check()) {
            if ($this->sessionEnded()) {
                $this->forceLogout();

                return Backend::redirect('backend');
            }
            $this->setLastTimeActivity();
        } else {
            $this->forgetLastActivityTime();
        }

        return $next($request);
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
     * @return void
     */
    private function forceLogout()
    {
        $this->forgetLastActivityTime();
        Flash::warning(trans('renatio.logout::lang.message.logout'));
        BackendAuth::logout();
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

}
