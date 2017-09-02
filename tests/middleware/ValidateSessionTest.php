<?php

namespace Renatio\Logout\Tests\Middleware;

use Backend\Facades\BackendAuth;
use Backend\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PluginTestCase;
use Renatio\Logout\Middleware\ValidateSession;
use System\Classes\PluginManager;

/**
 * Class ValidateSessionTest
 * @package Renatio\Logout\Tests\Middleware
 */
class ValidateSessionTest extends PluginTestCase
{

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

        PluginManager::instance()->bootAll(true);
        PluginManager::instance()->registerAll(true);

        $this->app->useDatabasePath(plugins_path('renatio/logout/tests'));
    }

    /** @test */
    public function it_handles_next_request_if_user_is_not_sign_in()
    {
        BackendAuth::logout();

        $request = Request::create('/backend/backend', 'GET');
        $response = (new ValidateSession)->handle($request, function () {
            return 'next';
        });

        $this->assertEquals('next', $response);
    }

    /** @test */
    public function it_signs_out_and_redirect_inactive_user()
    {
        $user = factory(User::class)->make();

        BackendAuth::login($user);

        $user->last_activity = Carbon::now()->subMinutes(30);
        $user->forceSave();

        $request = Request::create('/backend/backend', 'GET');
        $response = (new ValidateSession($user))->handle($request, function () {
        });

        $this->assertNull(BackendAuth::getUser());
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertContains('backend/auth', $response->getTargetUrl());
    }

    /** @test */
    public function it_updates_active_user_last_activity()
    {
        $user = factory(User::class)->make();

        BackendAuth::login($user);

        $lastActivity = $user->last_activity;

        sleep(1);

        $request = Request::create('/backend/backend', 'GET');
        $response = (new ValidateSession($user))->handle($request, function () {
            return 'next';
        });

        $this->assertTrue(BackendAuth::getUser()->last_activity->gt($lastActivity));
        $this->assertEquals('next', $response);
    }

}