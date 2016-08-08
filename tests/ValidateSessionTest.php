<?php

namespace Renatio\Logout\Tests;

use Backend\Facades\BackendAuth;
use Backend\Models\User;
use Illuminate\Http\Request;
use PluginTestCase;
use Renatio\Logout\Classes\MiddlewareRegistration;
use Renatio\Logout\Middleware\ValidateSession;
use Renatio\Logout\Models\Settings;

/**
 * Class ValidateSessionTest
 * @package Renatio\Logout\Tests
 */
class ValidateSessionTest extends PluginTestCase
{

    /**
     * @var string
     */
    protected $baseUrl = 'http://oc-logout.app';

    /**
     * @var
     */
    protected $middleware;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        BackendAuth::login(User::first());

        (new MiddlewareRegistration)->register();

        $session = app()->make('Illuminate\Session\Store');
        $this->middleware = new ValidateSession($session);
    }

    /** @test */
    public function it_handles_request()
    {
        $request = new Request;

        $response = $this->middleware->handle($request, function () {
            return true;
        });

        $this->assertTrue($response);
    }

    /** @test */
    public function it_logout_authenticated_user_after_session_timeout()
    {
        $settings = Settings::instance();
        $settings->lifetime = 0;

        $response = $this->call('GET', 'backend');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals($this->baseUrl . '/backend/backend/auth', $response->getTargetUrl());
    }

}