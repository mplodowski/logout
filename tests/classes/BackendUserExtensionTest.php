<?php

namespace Renatio\Logout\Tests\Classes;

use Backend\Facades\BackendAuth;
use Backend\Models\User;
use Carbon\Carbon;
use PluginTestCase;
use System\Classes\PluginManager;

/**
 * Class BackendUserExtensionTest
 * @package Renatio\Logout\Tests\Classes
 */
class BackendUserExtensionTest extends PluginTestCase
{

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->app->useDatabasePath(plugins_path('renatio/logout/tests'));

        PluginManager::instance()->bootAll(true);
    }

    /** @test */
    public function it_adds_last_activity_column_to_dates_property()
    {
        $this->assertContains('last_activity', (new User)->getDates());
    }

    /** @test */
    public function it_adds_is_active_method_to_user_model()
    {
        $this->assertTrue((new User)->methodExists('isActive'));
    }

    /** @test */
    public function it_adds_update_last_activity_method_to_user_model()
    {
        $this->assertTrue((new User)->methodExists('updateLastActivity'));
    }

    /** @test */
    public function it_checks_if_user_is_active()
    {
        $user = factory(User::class)->make();

        $this->assertTrue($user->isActive());
    }

    /** @test */
    public function it_checks_if_user_is_inactive()
    {
        $user = factory(User::class)->make([
            'last_activity' => Carbon::now()->subMinutes(30)
        ]);

        $this->assertFalse($user->isActive());
    }

    /** @test */
    public function it_updates_last_activity_after_login()
    {
        $user = factory(User::class)->make([
            'last_activity' => null
        ]);

        BackendAuth::login($user);

        $this->assertNotNull($user->last_activity);
    }

}