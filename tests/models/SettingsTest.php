<?php

namespace Renatio\Logout\Tests\Models;

use PluginTestCase;
use Renatio\Logout\Models\Settings;

/**
 * Class SettingsTest
 * @package Renatio\Logout\Tests\Models
 */
class SettingsTest extends PluginTestCase
{

    /** @test */
    public function it_sets_default_settings()
    {
        $settings = Settings::instance();

        $this->assertEquals(900, $settings->lifetime);
        $this->assertTrue($settings->show_counter);
    }

}