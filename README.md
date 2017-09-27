# Backend User Logout plugin

Automatically sign out authenticated backend user after specified time.

## Features

* Manage backend user idleness time
* Force sign out backend user after specified time
* Counter

## Requirements

> Plugin requires OctoberCMS build 420+ with Laravel 5.5 and PHP >=7.0.

## Installation

There are couple ways to install this plugin.

1. Use October [Marketplace](http://octobercms.com/help/site/marketplace) and __Add to project__ button. 
2. Use October backend area *Settings > System > Updates & Plugins > Install Plugins* and type __Renatio.Logout__.
3. Use `php artisan plugin:install Renatio.Logout` command.
4. Use `composer require renatio/logout-plugin` in project root. When you use this option you must run `php artisan october:up` after installation.

> Fourth option should be used only for advanced users.

## Settings

After installation plugin will register backend **User Session** settings position under **System** tab.

There you can specify session lifetime in seconds. Default is 900 seconds - 15 minutes.

You can also enable/disable the counter located near user avatar image. User will be automatically sign out after time runs out.

## Support

Please use [GitHub Issues Page](https://github.com/mplodowski/logout-plugin/issues) to report any issues with plugin.

> Reviews should not be used for getting support or reporting bugs, if you need support please use the Plugin support link.

## Like this plugin?

If you like this plugin, give this plugin a Like or Make donation with [PayPal](https://www.paypal.me/mplodowski).