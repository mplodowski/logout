# Logout plugin

Automatically logout authenticated user after session timeout.

Currently after successful sign in into backend area, user is logged in permanently.

With this plugin you can specify how much time user can be logged in without performing any action.

## Future plans
* Add javascript timer
* Logout without refreshing the page
* Support for RainLab.User plugin

# Documentation

## Usage

After installation plugin will register backend **User Session** settings position under **System** tab.

There you can specify timeout in seconds. Default is 900 seconds (15 minutes).