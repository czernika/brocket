# Changelog

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