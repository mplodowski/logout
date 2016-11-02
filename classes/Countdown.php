<?php

namespace Renatio\Logout\Classes;

use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Renatio\Logout\Models\Settings;

/**
 * Class Countdown
 * @package Renatio\Logout\Classes
 */
class Countdown
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
     * Initialize the counter
     */
    public function make()
    {
        $this->extendController();
    }

    /**
     * @return void
     */
    protected function extendController()
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
        $controller->addDynamicMethod('onGetSessionData', function () {
            return [
                'lifetime' => $this->settings->lifetime,
                'redirect' => Backend::url(),
            ];
        });
    }

}