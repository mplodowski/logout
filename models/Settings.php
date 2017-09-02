<?php

namespace Renatio\Logout\Models;

use October\Rain\Database\Model;
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
    public $rules = [
        'lifetime' => 'required|min:1|integer'
    ];

    /**
     * @var array
     */
    public $attributeNames = [
        'lifetime' => 'renatio.logout::lang.field.lifetime'
    ];

    /**
     * @return void
     */
    public function initSettingsData()
    {
        // Default lifetime in seconds
        $this->lifetime = 900;

        $this->show_counter = true;
    }

}