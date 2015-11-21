<?php

namespace Renatio\Logout;

use System\Classes\PluginBase;
use System\Classes\SettingsManager;

/**
 * Class Plugin
 * @package Renatio\Logout
 */
class Plugin extends PluginBase
{

    /**
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'renatio.logout::lang.plugin.name',
            'description' => 'renatio.logout::lang.plugin.description',
            'author'      => 'Renatio',
            'icon'        => 'icon-power-off',
        ];
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->addSessionTimeoutMiddleware();
    }

    /**
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'renatio.logout.access_settings' => [
                'label' => 'renatio.logout::lang.permissions.settings',
                'tab'   => 'renatio.logout::lang.permissions.tab'
            ]
        ];
    }

    /**
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'renatio.logout::lang.settings.label',
                'description' => 'renatio.logout::lang.settings.description',
                'category'    => SettingsManager::CATEGORY_SYSTEM,
                'icon'        => 'icon-power-off',
                'class'       => 'Renatio\Logout\Models\Settings',
                'order'       => 600,
                'keywords'    => 'session timeout logout user auth',
                'permissions' => ['renatio.logout.access_settings']
            ]
        ];
    }

    /**
     * @return void
     */
    private function addSessionTimeoutMiddleware()
    {
        $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
        $kernel->pushMiddleware('Renatio\Logout\Middleware\SessionTimeout');
    }

}
