# Changelog

## Release 1.12.1

- [Feat] Added `env()` helper
- [Refactor] Removed `theme.json` file completely as causing extra queries

Release Date: Feb 23rd, 2022

## Release 1.12.0

- [Breaking] `Brocooly` main class renamed into `App`
- [Fix] Default `null` setting for `theme.json` file changed as it causes site crash since 5.9.1. See [here](https://core.trac.wordpress.org/ticket/55241#comment:1)
- [Feat] Added scripts localization
- [Feat] Added shortcuts for `DateQuery` builder
- [Feat] Added params into `Menu` initialization
- [Refactor] Refactored `.eslintr.js` file and Eslint webpack plugin
- [Refactor] Default WordPress models are now required
- [Refactor] Refactored assets and webpack.mix
- [Refactor] Some changes for IDE support for Models
- [Chore] Added empty route file `ajax.php` and `admin.php`
- [Chore] Added `.gitignore` to ignore all `twentysomething` themes 

Release Date: Mar 4th, 2022

## Release 1.11.3

- [Fix] Changed WPEmerge version (from `0.16.0` to `dev-master`)
- [Chore] Updated dependencies

Release Date: Feb 23rd, 2022

## Release 1.11.2

- [Fix] Fixed terms query - previously returning **ALL** terms no matter taxonomy
- [Feat] Added `ajax()` method for `Route` facade 
- [Refactor] Refactored `paginate()` method of query builder
- [Docs] Added warning for `Route::all()`

Release Date: Feb 23rd, 2022

## Release 1.11.1

- [Feat] Added `config:cache` and `config:clear` console commands
- [Feat] Added cached configuration file
- [Refactor] Refactored cache commands
- [Refactor] Refactored `Config` class
- [Refactor] Refactored `isCurrentEnv()` helper
- [Refactor] Changed cached views path

Release Date: Feb 20th, 2022

## Release 1.11.0

- [Breaking] `new:template` command renamed into `new:ui:template`
- [Revert] Downgrade to WordPress 5.7.5 by default (with 5.8.3 security release included)
- [Feat] Disabled core update notification within `functions.php` file (newest releases will be tested but I doubt WordPress will change its policy)
- [Feat] Added default theme model classes
- [Feat] Added `PrimaryMenu` class
- [Feat] Added `new:ui:menu` class
- [Refactor] Refactored metaboxes container
- [Docs] Updated `README.md`
- [Style] Updated default hello-world screen to show current WordPress version
- [Chore] Update dependencies

Release Date: Feb 19th, 2022

## Release 1.10.1

- [Fix] Added `php-error.php` file
- [Refactor] Renamed key for app commands

Release Date: Feb 18th, 2022

## Release 1.10.0

- [Breaking] `cache:flush` command renamed into `view:clear` as it is more correct
- [Breaking] `ThemeServiceProvider` is now required within app core therefore must exist
- [Fix] Fixed incorrect namespace for generated hooks
- [Feat] Added `new:command` console command to create custom theme commands
- [Feat] Disable global style transient hook
- [Feat] Disable emoji hook
- [Refactor] Refactored `Commands` object
- [Refactor] Refactored some providers

Release Date: Feb 18th, 2022

## Release 1.9.4

- [Feat] Added defaulted `theme.json` file

Release Date: Feb 17th, 2022

## Release 1.9.3

- [Refactor] Add fallback within `index.php`
- [Refactor] `when()` method of `QueryBuilder` now has a fallback third param
- [Feat] Added `ifelse()` method of `QueryBuilder` as `when` alias

Release Date: Feb 17th, 2022

## Release 1.9.2

- [Refactor] Refactored context

Release Date: Feb 14th, 2022

## Release 1.9.1

- [Fix] Fixed post type registration error

Release Date: Feb 11th, 2022

## Release 1.9.0

- [Feat] Added support for custom templates within models
- [Feat] Added `new:template` console command

Release Date: Feb 10th, 2022

## Release 1.8.10

- [Feat] Added WordPress babel preset
- [Feat] Added package to handle images and convert them into webp if needed

Release Date: Feb 10th, 2022

## Release 1.8.9

- [Fix] Fixed `SetAssetsPropertiesTrxait` error when asset file was not present
- [Feat] Added Russian language pack
- [Refactor] Refactored example page - added new link, check for user to be logged in and link to WPEmerge documentation

Release Date: Feb 9th, 2022

## Release 1.8.8

- [Revert] Added front-end files
- [Refactor] Removed `vendor:mix` command

Release Date: Feb 9th, 2022

## Release 1.8.7

- [Feat] Added hookable classes to fire hooks
- [Feat] Added `new:hook` console command
- [Refactor] Refactored hooks and ThemeProvider

Release Date: Feb 7th, 2022

## Release 1.8.6

- [Feat] Added `body_class` hook
- [Feat] Disabled emoji
- [Feat] Removed meta generator

Release Date: Feb 7th, 2022

## Release 1.8.5

- [Fix] Fixed fatal error for wp-cli because of incorrect `wp-cli.yml` syntax
- [Chore] Updated composer dependencies

Release Date: Feb 6th, 2022

## Release 1.8.4

- [Feat] Added default error handler page
- [Feat] Added 404-layout
- [Chore] Updated `.pot` file
- [Refactor] Refactored 404 handler

Release Date: Feb 6th, 2022

## Release 1.8.3

- [Fix] Fixed 404 page
- [Feat] Added `brocooly.twig` filter to extend main twig features
- [Refactor] Important app providers removed from a theme to be merged with custom config within app bootstrapper
- [Refactor] Refactored debuggers and helpers
- [Refactor] Added IDE helpers for `Route` facade
- [Refactor] Refactored 404 route

Release Date: Feb 6th, 2022

## Release 1.8.2

- [Revert] Back to original post install script

Release Date: Feb 4th, 2022

## Release 1.8.1

- [Fix] Fixed composer script to execute after package was installed

Release Date: Feb 4th, 2022

## Release 1.8.0

- [Feat] Added `vendor:docker` command to create docker environment
- [Feat] Added `.browserslistrc` file
- [Build] Added `stubs` folder with docker, mix and tests files. It will be separated in a near future within external core package with `core` folder
- [Refactor] Removed docker files by default
- [Refactor] Removed `DOMAIN` key from `.env`
- [Refactor] Removed `sass` and `js` folders within theme

Release Date: Feb 4th, 2022

## Release 1.7.7

- [Feat] Added `new:rule` and `new:request` commands
- [Feat] Added `is_page_template` routing condition
- [Fix] Fixed error for `new:model:taxonomy` command
- [Refactor] Refactored console commands

Release Date: Feb 4th, 2022

## Release 1.7.6

- [Refactor] Refactored console commands which creates classes. Required input option changed to optional but value will be prompted

Release Date: Feb 3rd, 2022

## Release 1.7.5

- [Fix] Removed `post-create-project-cmd` from `composer.json` 

Release Date: Feb 3rd, 2022

## Release 1.7.4

- [Feat] Added script to generate WordPress salts after package installation
- [Refactor] Added default value to a `config()` helper
- [Refactor] Refactored use of `config()` helper within core
- [Refactor] Refactored all console classes

Release Date: Feb 3rd, 2022

## Release 1.7.3

- [Feat] Added `BROCOOLY_THEME_PUBLIC_PATH` and `BROCOOLY_THEME_PUBLIC_URI` constants
- [Feat] Added `BROCOOLY_THEME_RESOURCES_PATH` and `BROCOOLY_THEME_RESOURCES_URI` constants
- [Feat] Added `manifest` key within `config/app.php` to have possibility to change manifest filename
- [Refactor] Refactored `Assets` class to split into `Style` and `Script`
- [Docs] Fixed some typos

Release Date: Feb 2nd, 2022

## Release 1.7.2

- [Feat] Added heme global context within `Brocooly` class
- [Refactor] Changed assets autoloader and regex for defining what is script and what is style
- [Refactor] Removed autoloader option and replaced with conditional `queue` for `assets`
- [Refactor] `Assets` loader removed from theme bootstrap

Release Date: Feb 2nd, 2022

## Release 1.7.1

- [Feat] Added configuration for `fonts` folder for `laravel-mix`
- [Docs] Fixed some typos and added extra description

Release Date: Feb 1st, 2022

## Release 1.7.0

- [Feat] Added `new:middleware` console command to create Middleware classes
- [Feat] Added `-m` flag for controller creation command to help with middleware
- [Feat] Added multilanguage support
- [Feat] Added `Mailable` class to send Emails

Release Date: Jan 31st, 2022

## Release 1.6.3

- [Feat] Added `asset()` helper function for PHP and twig templates both
- [Refactor] Refactored `Assets` class
- [Build] Added welcome screen and 404 templates

Release Date: Jan 30th, 2022

## Release 1.6.2

- [Feat] Added few extra features for webpack
- [Feat] Added support for [TailwindCSS](https://tailwindcss.com/)
- [Docs] Changed `README.md`

Release Date: Jan 30th, 2022

## Release 1.6.1

- [Fix] Fixed compiled taxonomy class when created by console command
- [Feat] Added `belongsToTaxonomy` relation for post types
- [Build] Updated to WordPress 5.9
- [Docs] Added description for `webpack.mix.js` file

Release Date: Jan 30th, 2022

## Release 1.6.0

- [Feat] Added assets autoloader
- [Feat] Added `laravel-mix` config file
- [Style] Fixed some minor typos

Release Date: Jan 25th, 2022

## Release 1.5.3

- [Fix] Cache was not set correctly and applied in a development mode
- [Refactor] Refactored `app()` helper function to use built-in WPEmerge container
- [Refactor] Refactored `AbstractFacade` class to have more functionality
- [Style] Fixed some typos

Release Date: Jan 25th, 2022

## Release 1.5.2

- [Feat] Added support for ssl certs for Docker
- [Refactor] Refactored `Bootstrapper` class to define theme constants within
- [Refactor] Removed `config.php` bootstrap file

Release Date: Jan 22nd, 2022

## Release 1.5.1

- [Feat] Added support for Docker

Release Date: Jan 21st, 2022

## Release 1.5.0

- [Fix] Fixed error for generated Customizer section
- [Fix] Fixed check for Kirki Framework to be present
- [Feat] Added `ValidatorFactory` and `Validator` facade to validate incoming request
- [Feat] Added validation rules file and validation methods to request object
- [Feat] Added `app.php` configuration file
- [Feat] Defined default theme language directory
- [Refactor] Changed `CustomizerFactory` namespace
- [Refactor] Facades accessor refactored to accept string values

Release Date: Jan 20th, 2022

## Release 1.4.3

- [Fix] Fixed WPEmerge custom resource path for PrettyPageHandler as it cause error
- [Style] Added `screenshot.png` file
- [Style] Added PHP version badge into repository

Release Date: Jan 20th, 2022

## Release 1.4.2

- [Fix] Fixed pagination issue
- [Feat] Added new query methods
- [Refactor] Refactored Query builders
- [Refactor] Refactored posts Collections to allow any [Collection](https://laravel.com/docs/8.x/collections) method
- [Refactor] `Timber::get_posts()` refactored to `new \Timber\PostQuery()` as it was needed for pagination
- [Refactor] Refactored `query.php` configuration file - added `limit` option which set `posts_per_page` ONLY within all method
- [Docs] Changed return type for `Route` facade to help IDE

Release Date: Jan 20th, 2022

## Release 1.4.1

- [Feat] `new:model` commands are now supports `-m` flag which will create methods to register metaboxes within generated class

Release Date: Jan 19th, 2022

## Release 1.4.0

- [Fix] Added `notAllowedInProduction()` method for `cache:flush` object as it caused error for any command
- [Feat] Added support for theme options with customizer settings
- [Feat] Added `new:customizer:panel` console command
- [Feat] Added `new:customizer:section --panel` console command
- [Feat] Added `CustomizerServiceProvider` provider
- [Docs] Minor description changes across all files 
- [Docs] Added conditional methods for `Mod` facade to help IDE to understand it
- [Docs] Updated `README.md`, added some badges and link to documentation

Release Date: Jan 19th, 2022

## Release 1.3.0

- [Feat] Added support for post types and terms metaboxes
- [Feat] Added `cache:flush` console command
- [Refactor] Removed `QM_DARK_MODE` constant 
- [Refactor] Removed duplicated `timber.limit` options as it was doing nothing
- [Refactor] Refactored `QueryBuilder` class
- [Refactor] Changed `wp-cli.yml` file to be more secure by default. Use `wp-cli.local.yml` file to override it for local development
- [Refactor] Removed "trash" code from testing
- [Docs] Minor description changes across all files 
- [Docs] Added conditional methods for `Route` facade to help IDE to understand it

Release Date: Jan 18th, 2022

## Release 1.2.0

- [Fix] **Breaking**: Timber` lib added as a main dependency of a `Bootstrapper` as not declared TImber caused issues
- [Fix] Removed duplicated `query()` method from `QueryBuilder` 
- [Feat] Added `query.php` configuration file for defining default query params
- [Feat] Added `withStatus()`, `withTrashed()` and `withDrafts()` query methods
- [Feat] Added `withStatus()`, `withTrashed()` and `withDrafts()` query methods
- [Refactor] Refactored `QueryBuilder` class
- [Docs] Added IDE helpers for model objects
- [Docs] Changed theme description

Release Date: Jan 17th, 2022

## Release 1.1.0

- [Feat] Added support for registering custom post types and taxonomies via `models` configuration file
- [Feat] Added `PostType` and `Taxonomy` models with simple query builders
- [Feat] Added `ModelServiceProvider` provider
- [Feat] Console commands for creating Controllers, Providers and some Models
- [Fix] Removed `filp/whoops` package as it was already set within WPEmerge

Release Date: Jan 15th, 2022

## Initial release 1.0.0

Initial setup

Release Date: Jan 14th, 2022