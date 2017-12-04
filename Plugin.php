<?php

namespace Renatio\Logout;

use Illuminate\Routing\Router;
use October\Rain\Support\Facades\Schema;
use Renatio\Logout\Classes\BackendUserExtension;
use Renatio\Logout\Classes\Counter;
use Renatio\Logout\Middleware\ValidateSession;
use Renatio\Logout\Models\Settings;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

/**
 * Class Plugin
 * @package Renatio\Logout
 */
class Plugin extends PluginBase
{

    /**
     * @var bool
     */
    public $elevated = true;

    /**
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'renatio.logout::lang.plugin.name',
            'description' => 'renatio.logout::lang.plugin.description',
            'author' => 'Renatio',
            'icon' => 'icon-power-off',
            'homepage' => 'https://octobercms.com/plugin/renatio-logout',
        ];
    }

    /**
     * @return void
     */
    public function boot()
    {
        if (Schema::hasColumn('backend_users', 'last_activity')) {
            (new BackendUserExtension)->boot();

            (new Counter)->boot();

            $router = resolve(Router::class);
            $router->pushMiddlewareToGroup('web', ValidateSession::class);
        }
    }

    /**
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'renatio.logout.access_settings' => [
                'label' => 'renatio.logout::lang.permissions.settings',
                'tab' => 'renatio.logout::lang.permissions.tab'
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
                'label' => 'renatio.logout::lang.settings.label',
                'description' => 'renatio.logout::lang.settings.description',
                'category' => SettingsManager::CATEGORY_SYSTEM,
                'icon' => 'icon-power-off',
                'class' => Settings::class,
                'order' => 600,
                'keywords' => 'session timeout logout user auth',
                'permissions' => ['renatio.logout.access_settings']
            ]
        ];
    }

}