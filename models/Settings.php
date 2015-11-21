<?php

namespace Renatio\Logout\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Class Settings
 * @package Renatio\Logout\Models
 */
class Settings extends Model
{

    use Validation;

    /**
     * @var array
     */
    public $implement = ['System.Behaviors.SettingsModel'];

    /**
     * @var string
     */
    public $settingsCode = 'renatio_logout_settings';

    /**
     * @var string
     */
    public $settingsFields = 'fields.yaml';

    /**
     * @var array
     */
    public $attributeNames = [
        'timeout' => 'renatio.logout::lang.field.timeout'
    ];

    /**
     * @var array
     */
    public $rules = [
        'timeout' => 'required|integer'
    ];

    /**
     * @return void
     */
    public function initSettingsData()
    {
        $this->timeout = 900;
    }

}
