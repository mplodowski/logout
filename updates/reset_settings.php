<?php

namespace Renatio\Logout\Updates;

use October\Rain\Database\Updates\Migration;
use Renatio\Logout\Models\Settings;

/**
 * Class ResetSettings
 * @package Renatio\Logout\Updates
 */
class ResetSettings extends Migration
{

    /**
     * @return void
     */
    public function up()
    {
        $settings = Settings::instance();

        if (empty($settings->lifetime)) {
            $settings->resetDefault();
        }
    }

    /**
     * @return void
     */
    public function down()
    {
    }

}