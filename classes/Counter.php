<?php

namespace Renatio\Logout\Classes;

use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Renatio\Logout\Models\Settings;

/**
 * Class Counter
 * @package Renatio\Logout\Classes
 */
class Counter
{

    const ASSETS_PATH = '/plugins/renatio/logout/assets/';

    /**
     * @var
     */
    protected $settings;

    public function __construct()
    {
        $this->settings = Settings::instance();
    }

    /**
     * @return void
     */
    public function boot()
    {
        if ($this->settings->show_counter) {
            Controller::extend(function ($controller) {
                $this->addAssets($controller);

                $this->addDynamicMethods($controller);
            });
        }
    }

    /**
     * @param $controller
     */
    protected function addAssets($controller)
    {
        $controller->addCss(self::ASSETS_PATH . 'css/main.css');

        $controller->addJs(self::ASSETS_PATH . 'js/jquery.countdown.min.js');
        $controller->addJs(self::ASSETS_PATH . 'js/main.js');
    }

    /**
     * @param $controller
     */
    protected function addDynamicMethods($controller)
    {
        $controller->addDynamicMethod('onGetLogoutSettings', function () {
            return [
                'lifetime' => $this->settings->lifetime,
                'redirect' => Backend::url(),
                'format' => $this->getFormat(),
            ];
        });
    }

    /**
     * @param null $lifetime
     * @return string
     */
    public function getFormat($lifetime = null)
    {
        $lifetime = $lifetime ?: $this->settings->lifetime;

        if ($lifetime >= 1 * 24 * 60 * 60) {
            return '%-d day%!d %H:%M:%S';
        } elseif ($lifetime >= 1 * 60 * 60) {
            return '%H:%M:%S';
        }

        return '%M:%S';
    }

}