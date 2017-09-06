<?php

namespace Renatio\Logout\Tests\Classes;

use Backend\Classes\Controller;
use PluginTestCase;
use Renatio\Logout\Classes\Counter;
use System\Classes\PluginManager;

/**
 * Class CounterTest
 * @package Renatio\Logout\Tests\Classes
 */
class CounterTest extends PluginTestCase
{

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        PluginManager::instance()->bootAll(true);
    }

    /** @test */
    public function it_adds_on_get_logout_settings_method_to_backend_controller()
    {
        $this->assertTrue((new Controller)->methodExists('onGetLogoutSettings'));
    }

    /** @test */
    public function it_returns_format_for_counter_for_given_lifetime()
    {
        $counter = new Counter;

        // 1 day in seconds
        $lifetime = 1 * 24 * 60 * 60;
        $this->assertEquals('%-d day%!d %H:%M:%S', $counter->getFormat($lifetime));

        // 1 hour in seconds
        $lifetime = 1 * 60 * 60;
        $this->assertEquals('%H:%M:%S', $counter->getFormat($lifetime));

        // 15 minutes
        $lifetime = 15 * 60;
        $this->assertEquals('%M:%S', $counter->getFormat($lifetime));
    }

}