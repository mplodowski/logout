<?php

namespace Renatio\Logout\Tests;

use Illuminate\Routing\Router;
use PluginTestCase;
use Renatio\Logout\Middleware\ValidateSession;
use System\Classes\PluginManager;

/**
 * Class PluginTest
 * @package Renatio\Logout\Tests
 */
class PluginTest extends PluginTestCase
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
    public function it_registers_validate_session_middleware()
    {
        $router = resolve(Router::class);

        $this->assertContains(ValidateSession::class, $router->getMiddlewareGroups()['web']);
    }

}