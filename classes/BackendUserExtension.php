<?php

namespace Renatio\Logout\Classes;

use Backend\Models\User;
use DateTime;
use Illuminate\Support\Facades\Event;
use Renatio\Logout\Models\Settings;

/**
 * Class BackendUserExtension
 * @package Renatio\Logout\Classes
 */
class BackendUserExtension
{

    /**
     * @return void
     */
    public function make()
    {
        $this->extendModel();

        $this->updateLastActivityAfterLogin();
    }

    /**
     * @return void
     */
    protected function extendModel()
    {
        User::extend(function ($model) {
            $model->addDateAttribute('last_activity');

            $model->addDynamicMethod('isActive', function () use ($model) {
                if (is_null($model->last_activity)) {
                    return false;
                }

                return Settings::get('lifetime') > time() - $model->last_activity->timestamp;
            });

            $model->addDynamicMethod('updateLastActivity', function () use ($model) {
                $model->last_activity = new DateTime;
                $model->forceSave();
            });
        });
    }

    /**
     * @return void
     */
    protected function updateLastActivityAfterLogin()
    {
        Event::listen('backend.user.login', function ($user) {
            $user->updateLastActivity();
        });
    }

}