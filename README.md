# Logout plugin

Automatically logout authenticated user after session timeout.

Currently after successful sign in into backend area, user is logged in permanently.

With this plugin you can specify how much time user can be logged in without performing any action.

> This plugin requires **Stable** version of OctoberCMS.

## Future plans

* Support for RainLab.User plugin

# Documentation

## [Usage](#usage) {#usage}

After installation plugin will register backend **User Session** settings position under **System** tab.

There you can specify session lifetime in minutes. Default is 15 minutes.

You can also enable/disable the counter located near user avatar image. This setting also allow plugin to logout user without refreshing the page.

## [Upgrade guide](#upgrade-guide) {#upgrade-guide}

**From 1.0.2 to 2.0.0** Plugin requires **Stable** version of OctoberCMS.

**From 2.0.0 to 2.0.1** Session lifetime setting was changed from seconds to minutes.

## [License](#license) {#license}

OctoberCMS Logout Plugin is open-sourced software licensed under the MIT license.